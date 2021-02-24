<?php
require_once('./../includes/db.inc.php');
$resp = array();
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = file_get_contents('php://input');
    parse_str($data, $_DELETE);
    $tn = $_DELETE['tNIN'];
    $hno = $_DELETE['hId'];
    $hno = mysqli_fetch_assoc(mysqli_query($con, "select house_id from house_info where house_number = $hno"))['house_id'];
    $init = "update tenant_details set house_id = NULL where ten_nin = '{$tn}'";
    $init2 = "update rentals_info set isRented = 0 where house_id = {$hno}";
    $dl = datetime(str_replace('T', ' ', date('d-m-Y\TH:i:s')), 'ts');
    $de = datetime('09-05-2018 14:24:00', 'ts');
    $c3 = "select * from tenant_info where ten_id = '$tn'";
    if (mysqli_num_rows(mysqli_query($con, $c3)) != 0)
        $init3 = "update tenant_info set date_left = '$dl' where ten_id = '$tn'";
    else {
        $init3 = "insert into tenant_info (ten_id, date_entered, date_left, house_id) values('$tn', '$de', '$dl', $hno)";
    }
    $init4 = "delete from accounts where NIN = '$tn'";
    $init = mysqli_query($con, $init);
    if (!$init) {
        $resp['err1'] = mysqli_error($con);
        die(json_encode($resp));
    }
    $init = mysqli_query($con, $init2);
    if (!$init) {
        $resp['init2'] = $init2;
        $resp['err2'] = mysqli_error($con);
        die(json_encode($resp));
    }
    $init = mysqli_query($con, $init3);
    if (!$init) {
        $resp['init3'] = $init3;
        $resp['err3'] = mysqli_error($con);
        die(json_encode($resp));
    }
    $init = mysqli_query($con, $init4);
    if (!$init) {
        $resp['init4'] = $init4;
        $resp['err4'] = mysqli_error($con);
        die(json_encode($resp));
    }
    $resp['status'] = 'OK';
    $resp['msg'] = 'Tenant Successfully removed';
    echo json_encode($resp);
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nin = mysqli_real_escape_string($con, $_POST['nin']);
    $fN = mysqli_real_escape_string($con, $_POST['fName']);
    $lN = mysqli_real_escape_string($con, $_POST['lName']);
    $user = mysqli_real_escape_string($con, $_POST['user']);
    $hNo = mysqli_real_escape_string($con, $_POST['hno']);
    $cont_1 = mysqli_real_escape_string($con, $_POST['cont_1']);
    if (isset($_POST['cont_2']) && !empty($_POST['cont_2']))
        $cont_2 = mysqli_real_escape_string($con, $_POST['cont_2']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $padd = mysqli_real_escape_string($con, $_POST['prev_add']);
    $dateE = mysqli_real_escape_string($con, $_POST['datePd']);
    $insert0 = "insert into NINS(NIN, fName, lName) values ('$nin','$fN', '$lN')";
    $delete0 = "delete from NINS where NIN = '$nin'";
    $insert1 = "insert into accounts(NIN, username, pass, level, authkey) values('$nin','$user','" . md5('P@ss1234') . "',4,'" . md5($_POST['user'] . Date('Y-M-d H:i:s.u')) . "')";
    $delete1 = "delete from accounts where NIN = '$nin'";
    $hid = mysqli_fetch_assoc(mysqli_query($con, "select house_id from house_info where house_number = $hNo"))['house_id'];
    if (isset($cont_2))
        $insert2 = "insert into tenant_details(ten_nin,ten_contact,ten_email,ten_pAdd,house_id) values('$nin','$cont_1, $cont_2', '$email', '$padd', '$hid')";
    $insert2 = "insert into tenant_details(ten_nin,ten_contact,ten_email,ten_pAdd,house_id) values('$nin','$cont_1', '$email', '$padd', '$hid')";
    $delete2 = "delete from tenant_details where ten_nin = '$nin'";
    $insert3 = "insert into tenant_info(ten_id,date_entered,house_id) values('$nin','" . datetime($dateE, 'ts') . "', $hid)";
    $delete3 = "delete from tenant_info where ten_id = '$nin'";
    $insert4 = "update rentals_info set rentedBy = '$nin' where house_id = $hid";
    $delete4 = "update rentals_info set rentedBy = 'null' where house_id = $hid";
    $insert5 = "update rentals_info set isRented = 1 where house_id = $hid";
    $delete5 = "update rentals_info set isRented = 0 where house_id = $hid";
    $tii = "select ten_img_id from tenant_details where ten_nin = '$nin'";
    $img_up = $_FILES['addten_img'];
    $res = array(
        'status' => 200,
        'ins0' => $insert0,
        'del0' => $delete0,
        'ins1' => $insert1,
        'del1' => $delete1,
        'ins2' => $insert2,
        'del2' => $delete2,
        'ins3' => $insert3,
        'del3' => $delete3,
        'ins4' => $insert4,
        'del4' => $delete4,
        'ins5' => $insert5,
        'del5' => $delete5,
        'pp' => $img_up
    );
    dataProcess($res);
    setcookie('resetOnError', json_encode($res));
    if (!$err) {
        $dat = uploadImage();
        if ($dat['success']) {
            echo json_encode(
                array(
                    'success' => true,
                    'error' => ''
                )
            );
        } else {
            $e_err = array();
            foreach ($res as $key => $value) {
                if (strchr($key, 'del')) {
                    // $init = false;
                    $init = mysqli_query($con, $value);
                    if (!$init) {
                        $e_err[$key] = mysqli_error($con);
                    }
                }
            }
            echo json_encode(
                array(
                    'success' => false,
                    'error' => $dat['error'],
                    'errors' => unlink($_FILES['tfn'])
                )
            );
        }
    } else {
        echo json_encode(
            array(
                'success' => false,
                'error' => 'Please refresh the page, timed parameters are missing!'
            )
        );
    }
} else {
    echo json_encode(
        array(
            'status' => 403,
            'advice' => 'Illegal access method!'
        )
    );
}
$err = null;
function uploadImage()
{
    global $con, $ROOT, $nin;
    $dates = DateTime::createFromFormat('U.u', microtime(true));
    $datename = $dates->format('Y-m-d H:i:s.u');
    $date = new DateTime();
    $date = implode('', explode('-', $date->format('Y-m-d-H-i-s')));
    if (!empty($_FILES['addten_img'])) {
        $files = $_FILES['addten_img'];
        $_POST['user_id'] = $nin;
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        $target_dir = $ROOT . "includes/img/";
        $img_dir = "/includes/img/";
        $target_file_name = $date . '_' . basename($files['name']);
        $target_file = $target_dir . $target_file_name;
        $_FILES['tfn'] = $target_file;
        $upOk = 1;
        $file_size = $files['size'];
        if ($file_size > 5 * MB) {
            $response['success'] = false;
            $response['error'] = "The image size is too big to upload as profile image!";
        } else {
            if (move_uploaded_file($files['tmp_name'], $target_file)) {
                $try = "select ten_img_id from tenant_details where ten_nin = '" . $user_id . "'";
                $try = mysqli_query($con, $try);
                $tii = mysqli_fetch_assoc($try)['ten_img_id'];
                $check = 'select ten_img_id, ten_img_location, ten_img_name from tenant_images where ten_img_id = "' . $tii . '"';
                $check = mysqli_query($con, $check);
                if (mysqli_num_rows($check) == 0) {
                    $update = 'update tenant_details set ten_img_id = "' . $datename . '" where ten_nin = "' . $user_id . '"';
                    $update = mysqli_query($con, $update);
                    if ($update) {
                        $upload = 'insert into tenant_images values("' . $datename . '","' . $img_dir . '","' . $target_file_name . '")';
                        $upload = mysqli_query($con, $upload);
                        if ($upload) {
                            $response['success'] = true;
                            $response['error'] = "";
                        } else {
                            $response['success'] = false;
                            $response['error'] = mysqli_error($con);
                        }
                    } else {
                        $response['success'] = false;
                        $response['error'] = mysqli_error($con);
                    }
                } else {
                    $i = mysqli_fetch_assoc($check)['ten_img_id'];
                    $upload = 'update tenant_images set ten_img_location = "' . $img_dir . '" where ten_img_id = "' . $i . '"';
                    $upload = mysqli_query($con, $upload);
                    if ($upload) {
                        $upload = 'update tenant_images set ten_img_name = "' . $target_file_name . '" where ten_img_id = "' . $i . '"';
                        $upload = mysqli_query($con, $upload);
                        if ($upload) {
                            $update = "update tenant_details set ten_img_id = '" . $datename . '"';
                            $update = mysqli_query($con, $update);
                            if ($update) {
                                $response['success'] = true;
                                $response['error'] = "";
                            } else {
                                $response['success'] = false;
                                $response['error'] = mysqli_error($con);
                            }
                        } else {
                            $response['success'] = false;
                            $response['error'] = mysqli_error($con);
                        }
                    } else {
                        $response['success'] = false;
                        $response['error'] = mysqli_error($con);
                    }
                }
            } else {
                http_response_code(500);
                $response['success'] = false;
                $response['error'] = "Check your internet connection! Then try again!";
            }
        }
    } else {
        $response['success'] = false;
        $response['error'] = "Please select an Image and try again!";
    }
    return $response;
}
function dataProcess($_req = [])
{
    global $con, $err;
    $errors = array();
    $e_err = array();
    foreach ($_req as $key => $value) {
        if (strchr($key, 'ins')) {
            // $init = false;
            $init = mysqli_query($con, $value);
            if (!$init) {
                $errors[$key] = mysqli_error($con);
                // $err = true;
            }
        }
    }
    $_req = array_reverse($_req);
    while (!empty($errors)) {
        foreach ($errors as $k => $v) {
            $e_err[$k] = $v;
            foreach ($_req as $key => $value) {
                if (strchr($key, 'del')) {
                    // $init = false;
                    $init = mysqli_query($con, $value);
                    if (!$init) {
                        $e_err[$key] = mysqli_error($con);
                    }
                }
            }
            array_shift($errors);
        }
    }
}
function datetime($date, $ts)
{
    if ($ts == "ts")
        return (new DateTime($date))->format('Y-m-d H:i:s');
    else if ($ts == "m") {
        return intval(explode('/', explode(' ', $date)[0])[0]);
    } else if ($ts == 'y') {
        return intval(explode('/', explode(' ', $date)[0])[2]);
    } else return null;
}