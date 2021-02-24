<?php
session_start();
include_once('../db.inc.php');
$det = 'select * from tenant_details where ten_nin = "' . $_SESSION['id'] . '"';
$det = mysqli_query($con, $det);
$details = mysqli_fetch_assoc($det);
$name = 'select fName, lName from NINS where NIN = "' . $details['ten_nin'] . '"';
$name = mysqli_query($con, $name);
$names = mysqli_fetch_assoc($name);
?>
<script>
    $('.upload_btn').on('click', _ => {
        $('.tms-modal#id03').css({
            display: 'block'
        })
    })
</script>
<style>
    .upload_btn:hover,
    .empty:hover {
        background-color: grey;
        opacity: 0.5;
        transition: ease 1s;
        color: white;
        cursor: pointer;
    }

    .upload_btn span.text_btn {
        border: 2px double beige;
        padding: 5px;
        border-radius: 30px;
        cursor: pointer;
    }

    .upload_btn span.text_btn:hover {
        background-color: #FAFAFA;
        color: #0F0F0F;
        cursor: pointer;
        opacity: 0.8 !important;
        transition: all 1s;
    }
</style>
<div class="payment_details">
    <table width="100%" style="border:1px solid green" class="heading">
        <tr style="text-align:center;">
            <td colspan="2" rowspan="5">
                <?php
                $img = "select * from tenant_images where ten_img_id='" . $details['ten_img_id'] . "'";
                $img = mysqli_query($con, $img);
                if (mysqli_num_rows($img) == 0) {
                    ?>
                    <img src="/images/img_avatar2.png" alt="Tests image" height="170px" width="160px" <?php if (mysqli_num_rows($img) > 0) echo 'style="display:none;"'; ?>>
                    <div class="upload_btn" style="z-index:9999;height:170px;width:160px;margin-top: -170px;padding-top: 80px !important;margin-left: 25px;">
                        <span class="text_btn">Upload Image</span>
                    </div>
                <?php
                } else if (mysqli_num_rows($img) > 0) {
                    $image = mysqli_fetch_assoc($img);
                    $image_view = $image['ten_img_location'] . $image['ten_img_name'];
                    echo '<img src="' . $image_view . '" alt="' . $_SESSION['fName'] . '`s image" height="170px" width="160px">';
                }
                ?>
            </td>
            <th colspan="10" style="border-bottom: 1px solid black">Tenant Management System</th>
        </tr>
        <tr>
            <td colspan="10" style="border:0;vertical-align:top;padding-top:10px;font-size:22px;font-style:oblique;text-decoration:underline"><sub>Payment Details</sub></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;">First Name:</td>
            <td colspan="2" style="text-align:left;padding-left:10px"><?php echo $names['fName']; ?></td>
            <td colspan="2" style="text-align: right;">Last Name:</td>
            <td colspan="3" style="text-align:left;padding-left:10px"><?php echo $names['lName']; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;">Contact:</td>
            <td colspan="2" style="text-align:left;padding-left:10px"><?php echo $details['ten_contact']; ?></td>
            <td colspan="2" style="text-align: right;">Previous Address:</td>
            <td colspan="3" style="text-align:left;padding-left:10px"><?php echo $details['ten_pAdd']; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;">Email Address:</td>
            <td colspan="5" style="text-align:left;padding-left:10px"><?php echo $details['ten_email']; ?></td>
            <td colspan="2" class="edit_btn"><a href="#edit_det" onclick="ed()" data-usage="edit">Edit Details</a></td>
        </tr>
        <tr>
            <td colspan="11" style="padding:10px;">
                <div class="sidebar-separator"></div>
            </td>
        </tr>
    </table>
    <div class="pDContent">
        <div id="#edit_det" class="edit_det"></div>
        <table border="1" class="pay_dte" width="100%">
            <?php
            echo '<tr style="border:0 solid transparent"><th colspan="3">' . $_SESSION['fName'] . '`s Payment Details</th></tr>';
            echo '<tr class="header">
                       <th>Payment ID</th>
                       <th>Amount Paid</th>
                       <th>Date Paid</th>
                   </tr>';
            $mysql = 'select * from payment_details where ten_nin = "' . $_SESSION['id'] . '"';
            $mysql = mysqli_query($con, $mysql);
            if (!$mysql) die('Error. ' . mysqli_error($con));
            while ($data = mysqli_fetch_assoc($mysql)) {
                echo '<tr>
                          <td>' . $data['det_id'] . '</td>
                          <td>' . $data['amt_pd'] . '</td>
                          <td>' . $data['date_pd'] . '</td>
                      </tr>';
            }
            ?>
        </table>
    </div>
</div>