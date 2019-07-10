<?php session_start();
include('../includes/db.inc.php');
if (isset($_POST['user']) && (isset($_POST['passwd']))) {
    if (!empty($_POST['passwd'])) {
        $query = "select * from accounts where pass ='" . md5($_POST['passwd']) . "' and username = '" . $_POST['user'] . "' limit 1";
        $query = mysqli_query($con, $query);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            if (isset($_POST['remember'])) {
                setcookie('user', base64_encode($_POST['user']), time() + 60 * 60 * 24 * 2, '/', 'tms.lan', true, true);
                setcookie('passwd', base64_encode($_POST['passwd']), time() + 60 * 60 * 24 * 2, '/', 'tms.lan', true, true);
            }
            $result = mysqli_fetch_assoc($query);
            $action = "SHOW_SUCCESS";
            $sql = "select fName, lName from NINS where NIN = '" . $result['NIN'] . "'";
            $sql = mysqli_query($con, $sql);
            if (!$sql) echo '<br>Error: ' . mysqli_error($con);
            else {
                $results = mysqli_fetch_assoc($sql);
                $nin = $result['NIN'];
                $id = 'select ten_id from tenant_details where ten_nin = "' . $nin . '"';
                $id = mysqli_query($con, $id);
                if (!$id) die('Error: ' . mysqli_error($con));
                $ten_id = mysqli_fetch_assoc($id);
                $level = $result['level'];
                if ($result['level'] == 1) {
                    $_SESSION['manager_logged_in'] = true;
                    setcookie('mlogin', true, time() + 60 * 60 * 24 * 2, '/', 'tms.lan', true, true);
                    $_SESSION['logged_in'] = true;
                    $_SESSION['fName'] = $results['fName'];
                    $_SESSION['lName'] = $results['lName'];
                    $_SESSION['id'] = $ten_id['ten_id'];
                    setcookie("return", 1, time() + 60 * 60 * 10, '/', 'tms.lan', true, true);
                    setcookie("login", "login", time() + 60 * 60 * 24 * 7, '/', 'tms.lan', true, true);
                } else if ($result['level'] == 2) {
                    $_SESSION['cashier_logged_in'] = true;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['fName'] = $results['fName'];
                    $_SESSION['lName'] = $results['lName'];
                    $_SESSION['id'] = $ten_id['ten_id'];
                    setcookie("return", 1, time() + 60 * 60 * 10, '/', 'tms.lan', true, true);
                    setcookie("login", "login", time() + 60 * 60 * 24 * 7, '/', 'tms.lan', true, true);
                } else if ($result['level'] == 3) {
                    $_SESSION['trainer_logged_in'] == true;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['fName'] = $results['fName'];
                    $_SESSION['lName'] = $results['lName'];
                    $_SESSION['id'] = $ten_id['ten_id'];
                    setcookie("return", 1, time() + 60 * 60 * 10, '/', 'tms.lan', true, true);
                    setcookie("login", "login", time() + 60 * 60 * 24 * 7, '/', 'tms.lan', true, true);
                } else if ($result['level'] == 4) {
                    $_SESSION['client_logged_in'] = true;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['fName'] = $results['fName'];
                    $_SESSION['lName'] = $results['lName'];
                    $_SESSION['id'] = $ten_id['ten_id'];
                    setcookie("return", 1, time() + 60 * 60 * 10, '/', 'tms.lan', true, true);
                    setcookie("login", "login", time() + 60 * 60 * 24 * 7, '/', 'tms.lan', true, true);
                }
            }
            $msg = "Successfully Logged in. Thank you ...";
            echo json_encode(
                array(
                    'action' => $action,
                    'msg' => $msg,
                    'level' => $level
                )
            );
        } else {
            $action = "SHOW_ERROR";
            $msg = "The password doesn't match the email provided.";
            echo json_encode(
                array(
                    'action' => $action,
                    'msg' => $msg
                )
            );
        }
    } else {
        $action = "SHOW_ERROR";
        $msg = "Please enter your password.";
        echo json_encode(
            array(
                'action' => $action,
                'msg' => $msg
            )
        );
    }
}
