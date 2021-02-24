<?php
require_once('./../includes/db.inc.php');
$response = array();
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['status'] = 403;
    $response['msg'] = 'Direct Script Access Denied!';
} else {
    if (isset($_POST['ver']))
        $response['status'] = 200;
    else $response['status'] = 403;
    $type = base64_decode(mysqli_real_escape_string($con, $_POST['t']));
    $sp = base64_decode(mysqli_real_escape_string($con, $_POST['sp']));
    if ($type == 'ten_name') {
        $init = "select * from NINS where fName like '{$sp}%'";
        $init = mysqli_query($con, $init);
        if (!$init) {
            $response['err'] = mysqli_error($con);
        } else {
            if (mysqli_num_rows($init) == 0) {
                $init = "select * from NINS where lName like '{$sp}%'";
                $init = mysqli_query($con, $init);
                if (!$init) {
                    $response['err'] = mysqli_error($con);
                } else {
                    if (mysqli_num_rows($init) == 0) {
                        $response['err'] = 'Not Exist';
                    } else {
                        while (($init_data = mysqli_fetch_assoc($init)) != NULL) {
                            $i_d[] = $init_data;
                        }
                    }
                }
            } else
                while (($init_data = mysqli_fetch_assoc($init)) != NULL) {
                    $i_d[] = $init_data;
                }
        }

        if (isset($i_d)) {
            foreach ($i_d as $key => $value) {
                $tn = $value['NIN'];
                $conf = "select * from tenant_details where ten_nin = '$tn'";
                $conf = mysqli_query($con, $conf);
                if ($conf) {
                    if (mysqli_num_rows($conf) > 0) {
                        $tenDet = json_decode(curlpost('https://www.tmsystem.live/actions/getSpecTen.inc.php', 'POST', ['tNIN' => $tn]));
                        if ($tenDet->dets->img == '') {
                            $tenDet->dets->img = '/images/img_avatar2.png';
                        }
                        $response['hints']['ten_' . $key] = $tenDet;
                    }
                }
            }
        }
    } else if ($type == 'ten_nin') {
    } else if ($type == 'house_num') {
    }
}
echo json_encode($response);
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
    return $response;
}
