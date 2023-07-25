<?php session_start();
require_once('../../includes/db.inc.php');
global $con;
if($_SESSION['manager_logged_in'] == true){
    $_SESSION['manager_logged_in'] = false;
} else if($_SESSION['cashier_logged_in'] == true){
    $_SESSION['cashier_logged_in'] = false;
} else if($_SESSION['trainer_logged_in'] == true){
    $_SESSION['trainer_logged_in'] = false;
} else if($_SESSION['client_logged_in'] == true){
    $_SESSION['client_logged_in'] = false;
}
$sqls = 'select NIN from accounts where username = "'.$email.'"';
$sqls = mysqli_query($con,$sqls);
$resultn = mysqli_fetch_assoc($sqls);
$online = 'update accounts set status = 0 where NIN = "'.$resultn['NIN'].'"';
$sql = mysqli_query($con, $online);
$_SESSION['logged_in'] = false;
setcookie("login","login",time()-60*60*2,'/', 'tms.lan',true,true);
setcookie('user','',time()-60*60*24*2,'/', 'tms.lan',true,true);
setcookie('passwd','',time()-60*60*24*2,'/', 'tms.lan',true,true);
unset($_SESSION['fName']);
unset($_SESSION['lName']);
session_destroy();
header('Location: /');
?>
