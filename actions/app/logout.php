<?php session_start();
require_once('../../includes/db.inc.php');
$email = mysqli_real_escape_string($con, $_GET['nin']);
$sqls = 'select NIN from accounts where NIN = "'.$email.'"';
$sqls = mysqli_query($con,$sqls);
$resultn = mysqli_fetch_assoc($sqls);
$online = 'update accounts set status = 0 where NIN = "'.$resultn['NIN'].'"';
$sql = mysqli_query($con, $online);
?>
