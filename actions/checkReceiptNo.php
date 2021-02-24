<?php
include_once('../includes/db.inc.php');
$response = array();
sleep(2);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $r = mysqli_real_escape_string($con, $_POST['rNo']);
    $init = 'select receipt_no from payment_history';
    $init = mysqli_query($con, $init);
    if(mysqli_num_rows($init) > 0){
        while($init_data = mysqli_fetch_array($init)){
            if($r == $init_data['receipt_no']){
                $response['success'] = false;
                $response['msg'] = 'Exists';
                die(json_encode($response));
            }
        }
        $response['success'] = true;
        die(json_encode($response));
    } else {
        $response['success'] = true;
        die(json_encode($response));
    }
}