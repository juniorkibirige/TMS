<?php
$month_name = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$month_days = ['31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31'];
session_start();
include_once('../db.inc.php');
require_once('../tenant_functions.min.php');
$def_amt = 0;
$det = 'select * from tenant_details where ten_nin = "' . $_SESSION['id'] . '"';
$det = mysqli_query($con, $det);
$details = mysqli_fetch_assoc($det);
$rentinfo = 'select * from house_info where house_id = (select house_id from rentals_info where rentedBy = "' . $_SESSION['id'] . '")';
$rentinfo = mysqli_query($con, $rentinfo);
$housenum = mysqli_fetch_assoc($rentinfo);
$house_num = $housenum['house_number'];
$house_loc = $housenum['house_location'];
$rpm = intval($housenum['amt_per_mth']);
echo '
<script>
    $("#mths-pd").text('.$mths_pd.');
    document.getElementById("days_left").value = "'.$days_left.'";
    document.getElementById("outstanding-bal").value = "'.$def_amt.'";
</script>
';
?>
<!-- <script>
    document.g
</script> -->
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
    #mths-pd:hover, #outstanding-bal:hover, #days_left:hover {
        cursor: default;
    }
</style>
<script>
    $('.empty').on('click', _ => {
        $('.tms-modal#id03').css({
            display: 'block'
        })
    })
</script>
<div class="dashb-content">
    <?php
    $img = 'select * from tenant_images where ten_img_id = "' . $details['ten_img_id'] . '"';
    $img = mysqli_query($con, $img);
    $image = mysqli_fetch_assoc($img);
    $image_view = $image['ten_img_location'] . $image['ten_img_name'];
    ?>
    <div class="dashb-ten-img <?php echo mysqli_num_rows($img) == 0 ? "empty" : null; ?>">
        <?php
        $img = 'select * from tenant_images where ten_img_id = "' . $details['ten_img_id'] . '"';
        $img = mysqli_query($con, $img);
        $image = mysqli_fetch_assoc($img);
        $image_view = $image['ten_img_location'] . $image['ten_img_name'];
        if (mysqli_num_rows($img) == 0) {
            ?>
            <img src="/images/img_avatar2.png" alt="Tests image" height="120px" width="130px" <?php if (mysqli_num_rows($img) > 0) echo 'style="display:none;"'; ?>>
            <div class="upload_btn" style="z-index:9999;height:120px;width:130px;margin-top: -110px;margin-left: -16px;border-radius: 40%;padding: 50px 0px;">
                <span class="text_btn">Upload Image</span>
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
            <textarea type="text" word-break="" name="mths-pd" id="mths-pd" style="text-align:center;border:1px solid green;padding:5px;border-radius:5px;background-color:transparent;" readonly="yes" cols="19" rows="2"></textarea>
        </div>
        <div class="outstanding-bal">
            <label for="outstanding-bal">Outstanding total balance:</label><br>
            <input type="text" name="outstanding-bal" id="outstanding-bal" style="text-align:center;border:1px solid crimson;padding:5px;border-radius:5px;background-color:transparent" readonly value="">
        </div>
        <div class="days_left">
            <label for="days_left">Days left to end of paid period:</label><br>
            <input type="text" name="days_left" id="days_left" style="text-align:center;border:1px solid orange;padding:5px;border-radius:5px;background-color:transparent" readonly="yes" value="">
        </div>
    </div>
    <div class="right">
        <table class="house_details">
            <tr class="location">
                <td class="location labelt">House Location: </td>
                <td class="location value"><?php echo $house_loc; ?></td>
            </tr>
            <tr style="padding:70px"></tr>
            <tr class="number">
                <td class="number labelt">House Number: </td>
                <td class="number value"><?php echo $house_num; ?></td>
            </tr>
            <tr class="rnt-per-month">
                <td class="rnt-per-month labelt">Rent per month: </td>
                <td class="rnt-per-month value"><?php echo $rpm; ?></td>
            </tr>
        </table>
        <div class="house_details_small_scr">
            <div class="location l">
                <div class="location labelt">House Location</div>
            </div>
            <div class="location v">
                <div class="location value"><?php echo $house_loc; ?></div>
            </div>
            <div class="sep">&nbsp;</div>
            <div class="number l">
                <div class="number labelt">House Number</div>
            </div>
            <div class="number v">
                <div class="number value"><?php echo $house_num; ?></div>
            </div>
            <div class="sep">&nbsp;</div>
            <div class="rnt-per-month l">
                <div class="rnt-per-month labelt">Rent per month</div>
            </div>
            <div class="rnt-per-month v">
                <div class="rnt-per-month value"><?php echo $rpm; ?></div>
            </div>
        </div>
    </div>
</div>
<style>
    #mths-pd {
        resize: none;
    }
</style>