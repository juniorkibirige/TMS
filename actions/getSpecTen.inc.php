<?php

require_once('../includes/db.inc.php');
function getTenImg($id)
{
    global $con;
    $init = 'select * from tenant_images where ten_img_id = "' . $id . '"';
    $init = mysqli_query($con, $init);
    if (!$init) die('Error: ' . mysqli_error($con));
    $init_data = mysqli_fetch_assoc($init);
    if (mysqli_num_rows($init) > 0)
        return $init_data['ten_img_location'] . $init_data['ten_img_name'];
    return '';
}
function getHouseDetails($id)
{
    global $con;
    $details = array();
    $init = 'select * from house_info where house_id = "' . $id . '"';
    $init = mysqli_query($con, $init);
    if (!$init) die('Error: ' . mysqli_error($con));
    $init_data = mysqli_fetch_assoc($init);
    if ($init_data != null) {
        $details['hNo'] = $init_data['house_number'];
        $details['hLoc'] = $init_data['house_location'];
        $details['hDesc'] = $init_data['Description'];
        $details['hApm'] = $init_data['amt_per_mth'];
        return $details;
    } else {
        return null;
    }
}
function getServiceInfo($id)
{
    global $con;
    $details = array();
    $init = 'select * from Services where service_id = "' . $id . '"';
    $init = mysqli_query($con, $init);
    if (!$init) die('Error: ' . mysqli_error($con));
    $init_data = mysqli_fetch_assoc($init);
    $details['H2O_m'] = $init_data['water_meter_no'] == null ? 'Shared' : $init_data['water_meter_no'];
    $details['H2O_c'] = $init_data['water_cust_no'] == null ? 'Shared' : $init_data['water_cust_no'];
    $details['yaka'] = $init_data['Umeme_no'] == null ? 'Shared' : $init_data['Umeme_no'];
    return $details;
}
function getDetails($id = 0)
{
    global $con;
    $details = array();
    $init = 'select * from tenant_details where ten_nin = "' . $id . '"';
    $init = mysqli_query($con, $init);
    if (!$init) die('Error: ' . mysqli_error($con));
    $init_data = mysqli_fetch_assoc($init);
    $details['tc'] = $init_data['ten_contact'];
    if (count($cont = explode(',', $init_data['ten_contact'])) > 1) {
        $details['contact_1'] = $cont[0];
        $details['contact_2'] = $cont[1];
    } else {
        $details['contact'] = $init_data['ten_contact'];
    }
    if ($init_data['ten_email'] == "") {
        $details['email'] = "Placeholder: Not Given";
    } else
        $details['email'] = $init_data['ten_email'];
    $timg = $init_data['ten_img_id'];
    $details['img'] = getTenImg($timg);
    $hid = $init_data['house_id'];
    $details['data'] = var_export($init_data, true);
    $details['house'] = getHouseDetails($hid);
    $details['services'] = getServiceInfo($hid);
    return $details;
}
function getPayInfo($id)
{
    global $con;
    $details = array();
    $init = 'select * from pay_info where ten_nin = "' . $id . '"';
    $init = mysqli_query($con, $init);
    if (!$init) die('Error: ' . mysqli_error($con));
    if (mysqli_num_rows($init) > 0) {
        $init_data = mysqli_fetch_assoc($init);
        $details['cm'] = $init_data['current_month'];
        $details['mlp'] = $init_data['month_last_paid'];
        $details['ylp'] = $init_data['year_last_paid'];
        $details['mpl'] = $init_data['mths_paid_left'];
        $details['lmpf'] = $init_data['last_mth_pd_for'];
        $details['ylpf'] = $init_data['year_last_pd_for'];
    }
    return $details;
}
function getRentDetails($id)
{
    global $con;
    $details = array();
    $init = 'select * from defaulters_rent where ten_nin = "' . $id . '"';
    $init = mysqli_query($con, $init);
    if (!$init) die('Error: ' . mysqli_error($con));
    $init_data = mysqli_fetch_assoc($init);
    if (mysqli_num_rows($init) > 0) {
        $details['d_id'] = $init_data['defaulters_id'] == null ? 0 : $init_data['defaulters_id'];
        $details['defaulted_amt'] = $init_data['amt_defaulted'] == null ? 0 : $init_data['amt_defaulted'];
        $details['month'] = $init_data['for_mth'] == null ? 'OK' : $init_data['for_mth'];
        $init = 'select * from payment_details where ten_nin = "' . $id . '"';
        $init = mysqli_query($con, $init);
        if (!$init) die('Error: ' . mysqli_error($con));
        $count = 0;
        while (($init_data = mysqli_fetch_assoc($init)) !== null) {
            $details['payments']['payment_' . ++$count]['rNo'] = $init_data['receiptNo'];
            $details['payments']['payment_' . $count]['amt_pd'] = $init_data['amt_pd'];
            $details['payments']['payment_' . $count]['date_pd'] = $init_data['date_pd'];
            $details['payments']['payment_' . $count]['processedBy'] = $init_data['processedBy'];
        }
        $init = 'select * from rent_credit where ten_nin = "' . $id . '"';
        $init = mysqli_query($con, $init);
        if (!$init) die('Error: ' . mysqli_error($con));
        $init_data = mysqli_fetch_assoc($init);
        $details['rent_credit'] = $init_data['credit'] == null ? 0 : $init_data['credit'];
        $init = 'select * from tenant_info where ten_id = "' . $id . '"';
        $init = mysqli_query($con, $init);
        if (!$init) die('Error: ' . mysqli_error($con));
        $init_data = mysqli_fetch_assoc($init);
        $details['date_entered'] = $init_data['date_entered'] == null ? 'Not recorded' : $init_data['date_entered'];
        $details['date_left'] = $init_data['date_left'] == null ? 'Still letted' : $init_data['days_left'];
    }
    return $details;
}
header('Content-Type: application/json');
$response = array();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    $response['status'] = 403;
    $response['msg'] = 'Unknown request submitted!';
} else {
    http_response_code(200);
    $response['status'] = 302;
    $nin = $_POST['tNIN'];
    $init = 'select * from NINS where NIN = "' . $nin . '"';
    $init = mysqli_query($con, $init);
    if (!$init) {
        http_response_code(404);
        $response['status'] = 404;
        $response['msg'] = mysqli_error($con);
    } else {
        if (mysqli_num_rows($init) === 0) {
            http_response_code(404);
            $response['status'] = 404;
            $response['msg'] = 'User doesn\'t exist in the system';
        } else {
            $init_data = mysqli_fetch_assoc($init);
            $response['names'] = array();
            $response['names']['nin'] = $init_data['NIN'];
            $response['names']['fName'] = $init_data['fName'];
            $response['names']['lName'] = $init_data['lName'];
            $response['dets'] = getDetails($nin);
            $response['rent_info'] = getRentDetails($nin);
            $response['pay_info'] = getPayInfo($nin);
        }
    }
}
echo json_encode($response);
