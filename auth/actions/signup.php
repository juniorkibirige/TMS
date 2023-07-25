<?php session_start();
require_once('../../includes/db.inc.php');
global $con;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = mysqli_real_escape_string($con, $_POST['user']);
    $fName = mysqli_real_escape_string($con, $_POST['fName']);
    $lName = mysqli_real_escape_string($con, $_POST['lName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $nin = mysqli_real_escape_string($con, $_POST['NIN']);
    $level = 1;
    $authkey = md5($_POST['user'].Date(U));
    if($_POST['acc_man'] == 'on'){
        $level = 1;
        $nin = 'insert into NINS(NIN,fName, lName) values("'.$nin.'","'.$fName.'","'.$lName.'")';
        $sql = 'insert into manager(NIN,Tel,Email) values ("'.$nin.'","0","'.$email.'");';
    } else if($_POST['acc_cash'] == 'on'){
        $level = 2;
        $nin = 'insert into NINS(NIN,fName, lName) values("'.$nin.'","'.$fName.'","'.$lName.'")';
        $sql = 'insert into cashier(NIN,fName,lName,Tel,Email) values ("'.$nin.'","'.$fName.'","'.$lName.'","0","'.$email.'");';
    } else if($_POST['acc_train'] == 'on'){
        $level = 3;
        $nin = 'insert into NINS(NIN,fName, lName) values("'.$nin.'","'.$fName.'","'.$lName.'")';
        $sql = 'insert into trainer(NIN,fName,lName,Tel,Email) values ("'.$nin.'","'.$fName.'","'.$lName.'","0","'.$email.'");';
    } else if($_POST['acc_cli'] == 'on'){
        $level = 4;
        $nin = 'insert into NINS(NIN,fName, lName) values("'.$nin.'","'.$fName.'","'.$lName.'")';
        $sql = 'insert into clientele(NIN,fName,lName,Tel,Email) values ("'.$nin.'","'.$fName.'","'.$lName.'","0","'.$email.'");';
    } else {
        setcookie('info','User account specification not set.',time()+10,'/','.tmsystem.live',true,true);
        setcookie('uname',base64_encode($username),time()+10,'/','.tmsystem.live',true,true);
        setcookie('fName',base64_encode($fName),time()+10,'/','.tmsystem.live',true,true);
        setcookie('lName',base64_encode($lName),time()+10,'/','.tmsystem.live',true,true);
        setcookie('email',base64_encode($email),time()+10,'/','.tmsystem.live',true,true);
        setcookie('nin',base64_encode($nin),time()+10,'/','.tmsystem.live',true,true);
        header('Location: /');
    }
    $userdata = 'insert into accounts(NIN,username,level,authkey) values ("'.$nin.'","'.$username.'","'.$level.'","'.$authkey.'");';
    $man = mysqli_query($con, $sql);
    $nins = mysqli_query($con, $nin);
    $user = mysqli_query($con, $userdata);
    if(!$man && !$user){
        die('Error: '.mysqli_error($con));
    }
    else {
        echo 'Account created pending verification.';
    }

} else {
    echo 'Direct script access is not granted.';
}