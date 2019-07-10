<?php
session_start();
include_once('../db.inc.php');
$month = 'select (MONTHNAME(NOW())) limit 1';
$month = mysqli_query($con, $month);
$mth = mysqli_fetch_assoc($month);
$mths_pd = $mth['(MONTHNAME(NOW()))'];
$det = 'select * from tenant_details where ten_id = "' . $_SESSION['id'] . '"';
$det = mysqli_query($con, $det);
$details = mysqli_fetch_assoc($det);
$rentinfo = 'select * from house_info where house_id = (select house_id from rentals_info where rentedBy = "' . $_SESSION['id'] . '")';
$rentinfo = mysqli_query($con, $rentinfo);
echo mysqli_error($con);
$housenum = mysqli_fetch_assoc($rentinfo);
$house_num = $housenum['house_number'];
$house_loc = $housenum['house_location'];
$rpm = $housenum['amt_per_mth'];
?>
<div class="dashb-content">
    <div class="dashb-ten-img">
        <?php
        $img = 'select * from tenant_images where ten_img_id = "' . $details['ten_img_id'] . '"';
        $img = mysqli_query($con, $img);
        $image = mysqli_fetch_assoc($img);
        $image_view = $image['ten_img_location'] . $image['ten_img_name'];
        if (mysqli_num_rows($img) == 0) {
            ?>
            <img src="/images/img_avatar2.png" alt="Tests image" height="120px" width="130px" <?php if (mysqli_num_rows($img) > 0) echo 'style="display:none;"'; ?>>
            <div class="upload_btn">
                Upload Image
            </div>
        <?php
    } else if (mysqli_num_rows($img) > 0) {
        echo '<img src="' . $image_view . '" alt="' . $_SESSION['fName'] . '`s image" height="120px" width="130px">';
    }
    ?>
    </div>
    <div class="left">
        <div class="mths-pd">
            <label for="mths-pd" style="color:green">Months Paid for currently:</label><br>
            <input type="text" name="mths-pd" id="mths-pd" style="text-align:center;border:1px solid green;padding:5px;border-radius:5px;background-color:transparent" readonly="yes" value="<?php echo $mths_pd;?>">
        </div>
        <div class="outstanding-bal">
            <label for="outstanding-bal">Outstanding total balance:</label><br>
            <input type="text" name="outstanding-bal" id="outstanding-bal" style="text-align:center;border:1px solid crimson;padding:5px;border-radius:5px;background-color:transparent" readonly value="Test Sum">
        </div>
        <div class="days_left">
            <label for="days_left">Days left to end of paid period:</label><br>
            <input type="text" name="days_left" id="days_left" style="text-align:center;border:1px solid orange;padding:5px;border-radius:5px;background-color:transparent" readonly="yes" value="days left">
        </div>
    </div>
    <div class="right">
        <table class="house_details">
            <tr class="location">
                <td class="location labelt">House Location: </td>
                <td class="location value"><?php echo $house_loc;?></td>
            </tr>
            <tr style="padding:70px"></tr>
            <tr class="number">
                <td class="number labelt">House Number: </td>
                <td class="number value"><?php echo $house_num;?></td>
            </tr>
            <tr class="rnt-per-month">
                <td class="rnt-per-month labelt">Rent per month: </td>
                <td class="rnt-per-month value"><?php echo $rpm;?></td>
            </tr>
        </table>
    </div>
</div>