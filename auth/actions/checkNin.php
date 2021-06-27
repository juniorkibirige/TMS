<?php
session_start();
include_once('../../includes/db.inc.php');
global$con;
if (isset($_POST['nin'])) {
    if (!empty($_POST['nin'])) {
        $nin = mysqli_real_escape_string($con, $_POST['nin']);
        $query = "select * from NINS where NIN = '" . $nin . "'";
        $query = mysqli_query($con, $query);
        $num = mysqli_num_rows($query);
        if ($num == 0) {
            $action = "SHOW_SUCCESS";
            echo json_encode(
                array(
                    'action' => $action
                )
            );
        } else {
            $action = "SHOW_ERROR";
            $error_msg = "Sorry, the NIN " . $_POST['nin'] . " already exists!";
            echo json_encode(
                array(
                    'action' => $action,
                    'error_msg' => $error_msg
                )
            );
        }
    } else {
        $action = "SHOW_ERROR";
        $error_msg = "An error occured. Please Provide your nin";
        echo json_encode(
            array(
                'action' => $action,
                'error_msg' => $error_msg
            )
        );
    }
} else if (isset($_POST['hno'])) {
    if (!empty($_POST['hno'])) {
        $hno = mysqli_real_escape_string($con, $_POST['hno']);
        $init = "select house_id from house_info where house_number = '$hno'";
        $init = mysqli_fetch_assoc(mysqli_query($con, $init))['house_id'];
        $ir = "select isRented from rentals_info where house_id = '$init'";
        $ir = mysqli_query($con, $ir);
        if (mysqli_num_rows($ir) != 0) {
            if (mysqli_fetch_assoc($ir)['isRented'] == 0) {
                $action = 'SHOW_SUCCESS';
                echo json_encode(
                    array(
                        'action' => $action
                    )
                );
            } else {
                $action = 'SHOW_ERROR';
                $msg = 'Rental is taken';
                echo json_encode(
                    array(
                        'action' => $action,
                        'error_msg' => $msg
                    )
                );
            }
        } else {
            $action = 'SHOW_ERROR';
            $msg = 'Rental doesnot exist';
            echo json_encode(
                array(
                    'action' => $action,
                    'error_msg' => $msg
                )
            );
        }
    }
}
