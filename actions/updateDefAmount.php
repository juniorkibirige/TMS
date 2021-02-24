<?php
require_once('../includes/db.inc.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nin = mysqli_real_escape_string($con, $_POST['tNIN']);
    if ($_POST['type'] == 'def') {
        $ad = mysqli_real_escape_string($con, $_POST['ad']);
        $did = mysqli_real_escape_string($con, $_POST['did']);
        if ($_POST['action'] == 'del') {
            $init = 'delete from defaulters_rent where ten_nin = "'.$nin.'" and defaulters_id = '.$did.'';
        } else
            $init = 'update defaulters_rent set amt_defaulted = ' . $ad . ' where defaulters_id = ' . $did . ' and ten_nin = "' . $nin . '"';
        $init = mysqli_query($con, $init);
    } else if ($_POST['type'] == 'credit') {
        if ($_POST['action'] == 'del')
            $init = 'delete from rent_credit where ten_nin = "' . $nin . '"';
        else if ($_POST['action'] == 'ins') {
            $ad = mysqli_real_escape_string($con, $_POST['ad']);
            $init = 'insert into rent_credit (ten_nin, credit) values("' . $nin . '", ' . $ad . ')';
        }
        $init = mysqli_query($con, $init);
    } else if ($_POST['type'] == 'pay_hist') {
        $ad = mysqli_real_escape_string($con, $_POST['ad']);
        $dp = mysqli_real_escape_string($con, $_POST['date']);
        $rn = mysqli_real_escape_string($con, $_POST['rNo']);
        $init = 'insert into payment_history (receipt_no, ten_nin, amt_pd) values (' . $rn . ', "' . $nin . '", ' . $ad . ')';
        $init = mysqli_query($con, $init);
    } else if($_POST['type'] == 'pdet'){
        $ad = mysqli_real_escape_string($con, $_POST['ad']);
        $rn = mysqli_real_escape_string($con, $_POST['rNo']);
        $pb = mysqli_real_escape_string($con, $_POST['pB']);
        $init = 'insert into payment_details (ten_nin, receiptNo, amt_pd, processedBy) values ("' . $nin . '", ' . $rn . ', ' . $ad . ', "'.$pb.'")';
        $init = mysqli_query($con, $init);
    } else if($_POST['type'] == 'pinfo') {
        $mpl = mysqli_real_escape_string($con, $_POST['mpl']);
        $cm = mysqli_real_escape_string($con, $_POST['cm']);
        $ylp = mysqli_real_escape_string($con, $_POST['ylp']);
        $mlp = mysqli_real_escape_string($con, $_POST['mlp']);
        $ylpf = mysqli_real_escape_string($con, $_POST['ylpf']);
        $tn = mysqli_real_escape_string($con, $_POST['tNIN']);
        $lmpf = mysqli_real_escape_string($con, $_POST['lmpf']);
        if($_POST['action'] == 'ins'){
            $init = 'insert into pay_info (ten_nin, current_month, year_last_paid, month_last_paid, mths_paid_left, last_mth_pd_for, year_last_pd_for) values("'.$tn.'", '.$cm.', '.$ylp.', '.$mlp.', '.$mpl.', '.$lmpf.', '.$ylpf.')';
        } else if($_POST['action'] == 'upd'){
            $init = 'delete from pay_info where ten_nin = "'.$tn.'"';
            $init = mysqli_query($con, $init);
            $init = 'insert into pay_info (ten_nin, current_month, year_last_paid, month_last_paid, mths_paid_left, last_mth_pd_for, year_last_pd_for) values("'.$tn.'", '.$cm.', '.$ylp.', '.$mlp.', '.$mpl.', '.$lmpf.', '.$ylpf.')';
        }
        $init = mysqli_query($con, $init);
    }
    if (!$init) die('Error: ' . mysqli_error($con));
}
