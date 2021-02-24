<?php
require_once('../includes/db.inc.php');
$response = array();
$fName = mysqli_real_escape_string($con, $_POST['fName']);
$lName = mysqli_real_escape_string($con, $_POST['lName']);
$getnin = 'select NIN from NINS where fName = "' . $fName . '" and lName = "' . $lName . '" limit 1';
$getnin = mysqli_query($con, $getnin);
if (mysqli_num_rows($getnin) != 0) {
    $nin = mysqli_fetch_assoc($getnin)['NIN'];
    $gethouse_num = 'select house_id from rentals_info where rentedBy = "' . $nin . '" and isRented = 1 limit 1';
    $gethouse_num = mysqli_query($con, $gethouse_num);
    if (mysqli_num_rows($gethouse_num) != 0) {
        $house_id = mysqli_fetch_assoc($gethouse_num)['house_id'];
        $ghn = 'select house_number, house_location, amt_per_mth from house_info where house_id = "' . $house_id . '"';
        $ghn = mysqli_query($con, $ghn);
        if (mysqli_num_rows($ghn) != 0) {
            $data = mysqli_fetch_assoc($ghn);
            $house_num = $data['house_number'];
            $house_loc = $data['house_location'];
            $rpm = $data['amt_per_mth'];
            $response['success'] = true;
            $response['HNo'] = $house_num;
            $response['loc'] = $house_loc;
            $response['rpm'] = $rpm;
            $response['NIN'] = $nin;
            $response['error'] = '';
        } else {
            $response['success'] = false;
            $response['stage'] = 'HNo failed';
            $response['error'] = mysqli_error($con);
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Tenant has not yet started renting!';
    }
} else {
    $getnin = 'select NIN from NINS where fName = "' . $lName . '" and lName = "' . $fName . '" limit 1';
    $getnin = mysqli_query($con, $getnin);
    if (mysqli_num_rows($getnin) != 0) {
        $nin = mysqli_fetch_assoc($getnin)['NIN'];
        $gethouse_num = 'select house_id from rentals_info where rentedBy = "' . $nin . '" and isRented = 1 limit 1';
        $gethouse_num = mysqli_query($con, $gethouse_num);
        if (mysqli_num_rows($gethouse_num) != 0) {
            $house_id = mysqli_fetch_assoc($gethouse_num)['house_id'];
            $ghn = 'select house_number, house_location, amt_per_mth from house_info where house_id = "' . $house_id . '"';
            $ghn = mysqli_query($con, $ghn);
            if (mysqli_num_rows($ghn) != 0) {
                $data = mysqli_fetch_assoc($ghn);
                $house_num = $data['house_number'];
                $house_loc = $data['house_location'];
                $rpm = $data['amt_per_mth'];
                $response['success'] = true;
                $response['HNo'] = $house_num;
                $response['loc'] = $house_loc;
                $response['rpm'] = $rpm;
                $response['NIN'] = $nin;
                $response['error'] = '';
            } else {
                $response['success'] = false;
                $response['stage'] = 'HNo failed';
                $response['error'] = mysqli_error($con);
            }
        } else {
            $response['success'] = false;
            $response['error'] = 'Tenant has not yet started renting!';
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Tenant not found in database!';
    }
}
sleep(2);
echo json_encode($response);
