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
<div class="ed_det">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <form id="msform" class="ed" method="POST" enctype="multipart/form-data">
                    <div class="login">
                        <div class="progressbar">
                            <div class="bar"></div>
                        </div>
                        <fieldset>
                            <span class="clearfix"></span>
                            <div class="field-wrapper hasValue">
                                <input type="text" name="user" id="fName" value="<?php echo $names['fName']; ?>" class="form-control input-lg">
                                <div class="field-placeholder">
                                    <span>First Name</span>
                                </div>
                            </div>
                            <div class="field-wrapper hasValue">
                                <input type="text" name="user" id="email" class="form-control input-lg" value="<?php echo $names['lName']; ?>">
                                <div class="field-placeholder">
                                    <span>Last Name</span>
                                </div>
                            </div>
                            <span class="error_msg" id="error_msg"></span>
                            <input type="submit" class="btn btn-block btn-info action-button" name="next" value="Update details">
                        </fieldset>
                        <div class="tms-container tms-border-top tms-padding-16 tms-light-grey" style="background-color:#f1f1f1">
                            <button type="button" class="tms-btn tms-red" onclick="closes()">Cancel</button>
                        </div>
                    </div>
                </form>
                <span class="clearfix"></span>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    @media (min-width: 768px) {
        .login {
            margin-left: 200px !important;
        }
    }
</style>
<script>
    $(function() {
        $(".field-wrapper .field-placeholder").on("click", function() {
            $(this).closest(".field-wrapper").find("input").focus();
        });
        $(".field-wrapper input").on("keyup", function() {
            var value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
    });
</script>
<script>
    $('.ed').on('submit', e => {
        e.preventDefault()
        $.ajax({
            url: '/actions/ed_details.php',
            method: "POST",
            dataType: 'json',
            data: {
                fName: e.target[1].value,
                lName: e.target[2].value
            },
            success: e => {
                log( atob(e.result))
            }
        })
    })
</script>