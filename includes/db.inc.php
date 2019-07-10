<?php
$DB_HOST = 'localhost';
$DB_USER = 'admin.olympia.lan';
$DB_PASSWD = 'Computer!@#4';
$DB_BASE = 'olympia_RSD';

$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWD);
if(!$con){
    echo 'Error: '.mysqli_error($con);
} else {
    $db = mysqli_select_db($con, $DB_BASE);
    if(!$db){
        echo 'Failed to connect to the Database with Error: '.mysqli_error($con);
    }
}
?>