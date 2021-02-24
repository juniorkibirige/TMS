<?php
require_once('../db.inc.php');
$files = null;
$user_id = null;
$response = array();
$dates = DateTime::createFromFormat('U.u', microtime(true));
$datename = $dates->format('Y-m-d H:i:s.u');
$date = new DateTime();
$date = implode('', explode('-', $date->format('Y-m-d-H-i-s')));
if (empty($_FILES))
    $_FILES['file'] = $_POST['files'];
if (!empty($_FILES['file']) && !empty($_POST['user_id'])) {
    $files = $_FILES['file'];
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $target_dir = $ROOT."includes/img/";
    $img_dir = "/includes/img/";
    $target_file_name = $date . '_' . basename($files['name']);
    $target_file = $target_dir . $target_file_name;
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
sleep(2);
echo json_encode($response);
