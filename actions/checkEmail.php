<?php
session_start();
include_once('../includes/db.inc.php');
$det = 'select * from tenant_details where ten_id = "' . $_SESSION['id'] . '"';
$det = mysqli_query($con, $det);
$details = mysqli_fetch_assoc($det);
if (isset($_POST['user'])) {
    if (!empty($_POST['user'])) {
        $query = "select NIN from accounts where username='" . $_POST['user'] . "'";
        $query = mysqli_query($con, $query);
        $num = mysqli_num_rows($query);
        if ($num != 0) {
            $result = mysqli_fetch_assoc($query);
            $action = "SHOW_SUCCESS";
            $sql = "select NIN, fName, lName from NINS where NIN = '" . $result['NIN'] . "'";
            $sql = mysqli_query($con, $sql);
            if (!$sql) echo '<br>Error: ' . mysqli_error($con);
            else {
                $results = mysqli_fetch_assoc($sql);
                $nin = $result['NIN'];
                $fName = $results['fName'];
                $lName = $results['lName'];
                $ten_data = "select ten_img_id,ten_email from tenant_details where ten_nin = '" . $nin . "'";
                $ten_data = mysqli_query($con, $ten_data);
                if (!$sql) echo '<br>Error: ' . mysqli_error($con);
                else {
                    $img_id = mysqli_fetch_assoc($ten_data);
                    $email = $img_id['ten_email'];
                    $img = 'select * from tenant_images where ten_img_id = "' . $img_id['ten_img_id'] . '"';
                    $img = mysqli_query($con, $img);
                    $imgs = mysqli_fetch_assoc($img);
                    $imagepath = $imgs['ten_img_location'] . $imgs['ten_img_name'];
                    $image = "<img src='" . $imagepath . "' alt='" . $fName . "`s_profile_picture' class='image-container avatar' height='100'>";
                }
                echo json_encode(
                    array(
                        'action' => $action,
                        'nin' => $nin,
                        'fName' => $fName,
                        'lName' => $lName,
                        'email' => $email,
                        'image' => $image
                    )
                );
            }
        } else {
            $action = "SHOW_ERROR";
            $error_msg = "Sorry, we don't recognize " . $_POST['user'];
            echo json_encode(
                array(
                    'action' => $action,
                    'error_msg' => $error_msg
                )
            );
        }
    } else {
        $action = "SHOW_ERROR";
        $error_msg = "Please enter your email address in the format ?*?@olympia.lan.";
        echo json_encode(
            array(
                'action' => $action,
                'error_msg' => $error_msg
            )
        );
    }
}
