<?php session_start();
if($_SESSION['manager_logged_in'] == true){
    $_SESSION['manager_logged_in'] = false;
} else if($_SESSION['cashier_logged_in'] == true){
    $_SESSION['cashier_logged_in'] = false;
} else if($_SESSION['trainer_logged_in'] == true){
    $_SESSION['trainer_logged_in'] = false;
} else if($_SESSION['client_logged_in'] == true){
    $_SESSION['client_logged_in'] = false;
}
$_SESSION['logged_in'] = false;
setcookie("login","login",time()-60*60*2,'/','tms.lan',true,true);
setcookie('user','',time()-60*60*24*2,'/','tms.lan',true,true);
setcookie('passwd','',time()-60*60*24*2,'/','tms.lan',true,true);
unset($_SESSION['fName']);
unset($_SESSION['lName']);
header('Location: /');
?>