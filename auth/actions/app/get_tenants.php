<?php
session_start();
require_once('../../includes/db.inc.php');
$ten_det = array();
$ten_num = 0;
$init = 'select * from tenant_details';
$init = mysqli_query($con, $init);
while(($init_data = mysqli_fetch_assoc($init)) != null){
    $ten_num += 1;
    $names = 'select fName, lName from NINS where NIN = "'.$init_data['ten_nin'].'"';
    $names = mysqli_query($con, $names);
    $names_data = mysqli_fetch_assoc($names);
    $img = 'select ten_img_location, ten_img_name from tenant_images where ten_img_id = "'.$init_data['ten_img_id'].'"';
    $img = mysqli_query($con, $img);
    if(mysqli_num_rows($img)!=0){
        $img_data = mysqli_fetch_assoc($img);
        $image = "http://".$_SERVER['SERVER_ADDR']."/".$img_data['ten_img_location'].$img_data['ten_img_name'];
    } else {
        $image = "http://".$_SERVER['SERVER_ADDR']."/images/img_avatar2.png";
    }
    $response['user'] = $names_data['fName'].' '.$names_data['lName'];
    $response['id'] = $init_data['ten_nin'];
    $response['status'] = 0;
    $response['photoUrl'] = $image;
    $response['source'] = 'Tenant Details';
    $ten_det['ten_'.$ten_num] = $response;
}
// $response['id'] = '1';
// $response['status'] = 0;
// $response['user'] = "Tenat Test";
// $response['photoUrl'] = "http://192.168.61.1/includes/man/images/landlord.jpeg";
// $response['rights'] = '4';
// $response['source'] = "Tenant Details";
// $ten_det['ten_1'] = $response;
// $response['id'] = '1';
// $response['status'] = 0;
// $response['user'] = "Tenant Test";
// $response['photoUrl'] = "URL";
// $response['rights'] = '4';
// $response['source'] = "Tenant Detail";
// $ten_det['ten_2'] = $response;
echo json_encode($ten_det);
?>