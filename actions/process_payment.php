<?php
require_once('../includes/db.inc.php');
$month = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = array();
    $response['success'] = false;
    $response['error'] = 'Just for testing issues';
    $receiptNo = $_POST['rNo'];
    $datePd = strval($_POST['date']);
    $ten_nin = $_POST['tNIN'];
    $admin = $_POST['admin'];
    $amtPd = intval($_POST['amtPd']);
    $rpm = intval($_POST['rpm']);
    $tenDet = json_decode($_POST['tenDetails']);
    $cm = (mysqli_fetch_assoc(mysqli_query($con, 'select MONTH(NOW()) limit 1')))['MONTH(NOW())'];
    $cy = mysqli_fetch_assoc(mysqli_query($con, 'select YEAR(NOW()) limit 1'))['YEAR(NOW())'];

    $init = 'insert into payment_history (receipt_no, ten_nin, amt_pd, ProcessedBy) values (' . $receiptNo . ', "' . $ten_nin . '", ' . $amtPd . ', "' . $admin . '")';
    $init = mysqli_query($con, $init);
    if (!$init) {
        $err = mysqli_error($con);
        $dat = explode(' ', $err);
        if (str_replace('rNo', '', $err)) {
            $response['success'] = false;
            unset($response['error']);
            $response['msg'] = 'Receipt Number: ' . $dat[2] . ' already exists.';
        }
        die(json_encode($response));
    }
    curlpost('https://www.tmsystem.live/actions/updateDefAmount.php', 'POST', ['tNIN' => $ten_nin, 'date' => $datePd, 'ad' => $amtPd, 'rNo' => $receiptNo, 'type' => 'pay_hist']);
    if ($tenDet->rent_info->rent_credit > 0) {
        $amtPd += $tenDet->rent_info->rent_credit;
        curlpost('https://www.tmsystem.live/actions/updateDefAmount.php', 'POST', ['tNIN' => $ten_nin, 'type' => 'credit', 'action' => 'del']);
    }
    if ($tenDet->rent_info->defaulted_amt > $amtPd) {
        $tenDet->rent_info->defaulted_amt -= $amtPd;
        curlpost('https://www.tmsystem.live/actions/updateDefAmount.php', 'POST', ['tNIN' => $ten_nin, 'did' => $tenDet->rent_info->d_id, 'ad' => $tenDet->rent_info->defaulted_amt, 'type' => 'def']);
        $response['success'] = true;
        unset($response['error']);
        $response['info'] = 'The paid rent is used to clear part of the defaulted Amount. Your Current rent arrears are: ' . $tenDet->rent_info->defaulted_amt . '/=';
    } else if ($tenDet->rent_info->defaulted_amt < $amtPd) {
        if ($tenDet->rent_info->defaulted_amt !== 0) {
            $amtPd -= $tenDet->rent_info->defaulted_amt;
            curlpost('https://www.tmsystem.live/actions/updateDefAmount.php', 'POST', ['tNIN' => $ten_nin, 'did' => $tenDet->rent_info->d_id, 'ad' => 0, 'type' => 'def', 'action' => 'del']);
            $response['success'] = true;
            $response['info'] = 'All rent arrears have been cleared';
        }
        if ($amtPd < $rpm) {
            $response['success'] = true;
            $response['info'] = 'The paid amount is not enough to clear a month thus it has been stored as credit now ' . $amtPd . '/=';
            curlpost('https://www.tmsystem.live/actions/updateDefAmount.php', 'POST', ['tNIN' => $ten_nin, 'ad' => $amtPd, 'type' => 'credit', 'action' => 'ins']);
        } else if ($amtPd > $rpm || $amtPd == $rpm) {
            $response['success'] = true;
            unset($response['error']);
            curlpost('https://www.tmsystem.live/actions/updateDefAmount.php', 'POST', ['tNIN' => $ten_nin, 'rNo' => $receiptNo, 'ad' => intval($_POST['amtPd']), 'pB' => $admin, 'mlp' => datetime($datePd, 'm'), 'type' => 'pdet']);
            $numMths = intval($amtPd / $rpm);
            $amtPd -= ($numMths * $rpm);
            if (isset($tenDet->pay_info->lmpf) && $tenDet->pay_info->lmpf)
                if ($tenDet->pay_info->lmpf)
                    $lmpf = $tenDet->pay_info->lmpf;
                else
                    $lmpf = $cm;
            else $lmpf = $cm;
            $nm = $numMths;
            $y = 0;
            while ($nm > 0) {
                if ($lmpf == 12) {
                    $lmpf = 1;
                    $y = +1;
                } else
                    $lmpf += 1;
                $nm -= 1;
            }
            if ($tenDet->pay_info->ylpf)
                $cy = $tenDet->pay_info->ylpf;
            $cy += $y;
            curlpost('https://www.tmsystem.live/actions/updateDefAmount.php', 'POST', ['tNIN' => $ten_nin, 'ad' => $amtPd, 'type' => 'credit', 'action' => 'ins']);
            if (count($tenDet->pay_info) == 0)
                curlpost(
                    'https://www.tmsystem.live/actions/updateDefAmount.php',
                    'POST',
                    [
                        'tNIN' => $ten_nin,
                        'cm' => $cm,
                        'ylp' => $cy,
                        'mlp' => datetime($datePd, 'm'),
                        'mpl' => $numMths,
                        'lmpf' => $lmpf,
                        'ylpf' => $cy,
                        'type' => 'pinfo',
                        'action' => 'ins'
                    ]
                );
            else
                curlpost(
                    'https://www.tmsystem.live/actions/updateDefAmount.php',
                    'POST',
                    [
                        'tNIN' => $ten_nin,
                        'cm' => $cm,
                        'ylp' => $cy,
                        'mlp' => datetime($datePd, 'm'),
                        'mpl' => $numMths,
                        'lmpf' => $lmpf,
                        'ylpf' => $cy,
                        'type' => 'pinfo',
                        'action' => 'upd'
                    ]
                );
            $response['info'] = 'Rent paid period ends in ' . $month[--$lmpf] . ' ' . $cy . '!';
        }
    }
    echo json_encode($response);
} else {
    echo 'Direct Script access denied!';
}

function datetime($date, $ts)
{
    if ($ts == "ts")
        return (new DateTime($date))->format('Y-m-d H:i:s.u');
    else if ($ts == "m") {
        return intval(explode('/', explode(' ', $date)[0])[0]);
    } else if ($ts == 'y') {
        return intval(explode('/', explode(' ', $date)[0])[2]);
    } else return null;
}

function curlpost($url = '', $type = 'POST', $data = NULL)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    $response = curl_exec($ch);
    if (curl_error($ch)) {
        trigger_error('Curl Error: ' . curl_error($ch));
    }

    curl_close($ch);
    // print_r($response);
    return $response;
}