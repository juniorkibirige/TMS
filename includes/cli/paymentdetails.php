<?php
session_start();
include_once('../db.inc.php');
$det = 'select * from tenant_details where ten_id = "' . $_SESSION['id'] . '"';
$det = mysqli_query($con, $det);
$details = mysqli_fetch_assoc($det);
?>
<div class="payment_details">
    <table width="100%" style="border:1px solid green" class="heading">
        <tr style="text-align:center">
            <td colspan="2" rowspan="5">
            <?php
            if($details['ten_img_id'] > 0){
                $img = "select * from tenant_images where ten_img_id='".$details['ten_img_id']."'";
                $img = mysqli_query($con, $img);
                $image = mysqli_fetch_assoc($img);
                $image_view = $image['ten_img_location'].$image['ten_img_name'];
                ?>
                <img src="<?php echo $image_view;?>" height="170px" width="160px">
                <?php
            } else{
                echo '<img src="/images/img_avatar2.png" height="170px" width="160px">';
            }
            ?>
            </td>
            <th colspan="10">Tenant Management System</th>
        </tr>
        <tr>
            <td colspan="10" style="border:0;vertical-align:top;padding-top:10px;font-size:22px;font-style:oblique"><sub>Payment Details<sub></td>
        </tr>
        <tr>
            <b>
                <td colspan="2">First Name:</td>
            </b>
            <td colspan="2" style="text-align:left;padding-left:10px"><?php echo $details['ten_f_name']; ?></td>
            <td colspan="2">Last Name:</td>
            <td colspan="3" style="text-align:left;padding-left:10px"><?php echo $details['ten_l_name']; ?></td>
        </tr>
        <tr>
            <td colspan="2">Contact:</td>
            <td colspan="2" style="text-align:left;padding-left:10px"><?php echo $details['ten_contact']; ?></td>
            <td colspan="2">Previous Address:</td>
            <td colspan="3" style="text-align:left;padding-left:10px"><?php echo $details['ten_pAdd']; ?></td>
        </tr>
        <tr>
            <td colspan="2">Email Address:</td>
            <td colspan="5" style="text-align:left;padding-left:10px"><?php echo $details['ten_email']; ?></td>
            <td colspan="2" class="edit_btn"><a href="javascript:ed()">Edit Details</a></td>
        </tr>
        <tr>
            <td colspan="11" style="padding:10px;">
                <div class="sidebar-separator"></div>
            </td>
        </tr>
    </table>
    <div class="pDContent">
        <table border="1" width="100%">
            <?php
            echo '<tr style="border:0 solid transparent"><th colspan="3">' . $_SESSION['fName'] . '`s Payment Details</th></tr>';
            echo '<tr class="header">
                       <th>Payment ID</th>
                       <th>Amount Paid</th>
                       <th>Date Paid</th>
                   </tr>';
            $mysql = 'select * from payment_details where ten_id = "' . $_SESSION['id'] . '"';
            $mysql = mysqli_query($con, $mysql);
            if (!$mysql) die('Error. ' . mysqli_error($con));
            while($data = mysqli_fetch_assoc($mysql)){
                echo '<tr>
                          <td>'.$data['det_id'].'</td>
                          <td>'.$data['amt_pd'].'</td>
                          <td>'.$data['date_pd'].'</td>
                      </tr>';
            }
            ?>
        </table>
    </div>
</div>