<?php
session_start();
require_once('../includes/db.inc.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_real_escape_string($con, $_POST['user']);
    $password = mysqli_real_escape_string($con, $_POST['passwd']);
    $sql = 'select pass, level from accounts where username = "'.$email.'"';
    $sql = mysqli_query($con,$sql);
    if(!$sql) die('Error: 1'.mysqli_error($con));
    $result = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql) == 0){
        setcookie('msg','Specified user does not exist, please try creating an account.',time()+10,'/','.tmsystem.live',true,true);
        setcookie('user',base64_encode($email),time()+10,'/', 'tms.lan',true,true);
        header('Location: /');
    } else {
        if(md5($password) == $result['pass']){
            if(isset($_POST['remember'])) {
                setcookie('user',base64_encode($email),time()+60*60*24*7,'/', 'tms.lan',true,true);
                setcookie('passwd',base64_encode($password),time()+60*60*24*7,'/', 'tms.lan',true,true);
            }
            setcookie('msg','',time()-60*60*24*2,'/', 'tms.lan',true,true);
            $sqls = 'select NIN from accounts where username = "'.$email.'"';
            $sqls = mysqli_query($con,$sqls);
            $resultn = mysqli_fetch_assoc($sqls);
            $sql = 'select fName, lName from NINS where NIN = "'.$resultn['NIN'].'"';
            $sql = mysqli_query($con,$sql);
	        echo mysqli_error($con);
            if(!$sql) die('Error: 2'.mysqli_error($sql));
            $id = 'select ten_id from tenant_details where ten_nin = "'.$resultn['NIN'].'"';
            $id = mysqli_query($con,$id);
            if(!$id) die('Error: 3'.mysqli_error($con));
            $ten_id = mysqli_fetch_assoc($id);
            $results = mysqli_fetch_assoc($sql);
	        $online = 'update accounts set status = 1 where NIN = "'.$resultn['NIN'].'"';
    	    $sql = mysqli_query($con, $online);
            if($result['level'] == 1){
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $resultn['NIN'];
                $_SESSION['fName'] = $results['fName'];
                $_SESSION['lName'] = $results['lName'];
                setcookie("login","login",time()+60*60*24*7,'/', 'tms.lan',true,true);
                $header = 'Location: /man/';
                echo $header;
                header('Location: /man/');
            } else if($result['level'] == 2){
                $_SESSION['cashier_logged_in'] = true;
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $resultn['NIN'];
                $_SESSION['fName'] = $results['fName'];
                $_SESSION['lName'] = $results['lName'];
                setcookie("login","login",time()+60*60*24*7,'/', 'tms.lan',true,true);
                $header = 'Location: /csh/';
                echo $header;
                header('Location: /csh/');
            } else if($result['level'] == 4){
                $_SESSION['client_logged_in'] = true;
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $resultn['NIN'];
                $_SESSION['fName'] = $results['fName'];
                $_SESSION['lName'] = $results['lName'];
                setcookie("login","login",time()+60*60*24*7,'/', 'tms.lan',true,true);
                $header = 'Location: /cli/';
                echo $header;;
                header('Location: /cli/');
            }
            
        }else if($result['pass'] == NULL) {
            setcookie('msg','You need to verify your account. Check your email!',time()+10,'/', 'tms.lan',true,true);
            $header = 'Location: /';
            echo $header;
            header('Location: /');
        }
        else {
            setcookie('msg','Invalid password',time()+10,'/','.tmsystem.live',true,true);
            setcookie('user',base64_encode($email),time()+10,'/', 'tms.lan',true,true);
            setcookie('passwd',base64_encode($password),time()+10,'/', 'tms.lan',true,true);
            $header = 'Location: /';
            echo $header;
            header('Location: /');
        }
    }
} 
else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['token']) && !empty($_GET['token'])) {
        $t = base64_decode($_GET['token']);
        $email = base64_decode(mysqli_real_escape_string($con, explode('!&@', $t)[0]));
        $password = base64_decode(mysqli_real_escape_string($con, explode('!&@', $t)[1]));
    } else {
        $email = base64_decode(mysqli_real_escape_string($con, $_GET['user']));
        $password = base64_decode(mysqli_real_escape_string($con, $_GET['passwd']));
    }
    $sql = 'select pass, level from accounts where username = "'.$email.'"';
    $sql = mysqli_query($con,$sql);
    if(!$sql) die('Error: '.mysqli_error($con));
    $result = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql) == 0){
        setcookie('msg','Specified user does not exist, please try creating an account.',time()+10,'/','.tmsystem.live',true,true);
        setcookie('user',base64_encode($email),time()+10,'/', 'tms.lan',true,true);
        header('Location: /');
    } else {
        if(md5($password) == $result['pass']){
            $sqls = 'select NIN from accounts where username = "'.$email.'"';
            $sqls = mysqli_query($con,$sqls);
            $resultn = mysqli_fetch_assoc($sqls);
            $sql = 'select fName, lName from NINS where NIN = "'.$resultn['NIN'].'"';
            $sql = mysqli_query($con,$sql);
            if(!$sql) die('Error: '.mysqli_error($sql));
            $id = 'select ten_id from tenant_details where ten_nin = "'.$resultn['NIN'].'"';
            $id = mysqli_query($con,$id);
            if(!$id) die('Error: '.mysqli_error($con));
            $ten_id = mysqli_fetch_assoc($id);
            $results = mysqli_fetch_assoc($sql);
	    $online = 'update accounts set status = 1 where NIN = "'.$resultn['NIN'].'"';
    	    $sql = mysqli_query($con, $online);
            if($result['level'] == 1){
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $resultn['NIN'];
                $_SESSION['fName'] = $results['fName'];
                $_SESSION['lName'] = $results['lName'];
                setcookie("return", 1,time()+60*60*10,'/', 'tms.lan',true,true);
                header('Location: /man/');
            } else if($result['level'] == 2){
                $_SESSION['cashier_logged_in'] = true;
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $resultn['NIN'];
                $_SESSION['fName'] = $results['fName'];
                $_SESSION['lName'] = $results['lName'];
                setcookie("return", 1,time()+60*60*10,'/', 'tms.lan',true,true);
                header('Location: /csh/');
            } else if($result['level'] == 4){
                $_SESSION['client_logged_in'] = true;
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $resultn['NIN'];
                $_SESSION['fName'] = $results['fName'];
                $_SESSION['lName'] = $results['lName'];
                setcookie("return", 1,time()+60*60*10,'/', 'tms.lan',true,true);
                header('Location: /cli/');
            }
            
        }else if($result['pass'] == NULL) {
            setcookie('msg','You need to verify your account. Check your email!',time()+10,'/', 'tms.lan',true,true);
            echo "FAILED";
            header('Location: /');
        }
        else {
            setcookie('msg','Invalid password',time()+10,'/','.tmsystem.live',true,true);
            setcookie('user',base64_encode($email),time()+60*60*24*2,'/', 'tms.lan',true,true);
            setcookie('passwd',base64_encode($password),time()+60*60*24*2,'/', 'tms.lan',true,true);
            echo "Failed";
            header('Location: /');
        }
    }
}
else {
    echo '<head><title>Access Error</title><div class="jumbotron">You don\'t have access rights to this page.</div>';
}
