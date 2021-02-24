<style>
    .dashb-ten-img img {
        border-radius: 40%;
        margin: -16px -40% -10px -40%;
    }

    .dashb-ten-img {
        background-color: #ffffff;
        fill-opacity: 0.1;
        margin: 20px 0 10px 20%;
        border-radius: 40%;
        height: 120px;
        width: 130px;
        padding: 15px;
        border: 1px solid chocolate;
        text-align: center;
    }

    .upload_btn {
        z-index: 9999;
        height: 120px;
        width: 130px;
        margin-top: -110px;
        margin-left: -16px;
        border-radius: 40%;
        padding: 50px 0px;
    }

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

    #mths-pd:hover,
    #outstanding-bal:hover,
    #days_left:hover {
        cursor: default;
    }

    .tms-addclient_main-body {
        background-color: beige;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        width: 100%;
        height: max-content;
        padding: 10px;
    }

    .tms-addclient_main-title {
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        background-color: black;
        color: whitesmoke;
        text-align: center;
        font-size: 26px;
        padding: 10px;
    }

    .tms-addclient_main-body-content {
        padding: 10px;
        border: 1px dashed darkred;
    }

    .form-signin {
        max-width: 330px;
        padding: 10px;
        margin: 0 auto;
        padding-top: 5px;
    }

    .form-signin {
        margin-bottom: 10px;
    }

    .msform .addClient_form-body {
        max-width: 330px;
        padding: 10px;
        margin: 0 auto;
        padding-top: 5px;
    }

    .msform {
        margin-bottom: 10px;
    }

    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        box-sizing: border-box;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .msform .addClient_form-body .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 16px;
        box-sizing: border-box;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .msform .addClient_form-body .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type=password] {
        margin-bottom: 10px;
    }

    .msform .addClient_form-body input {
        margin-bottom: 10px;
    }

    .addClient_form-body-title {
        color: #555;
        font-size: 18px;
        font-weight: 400;
        display: block;
    }

    .account-wall {
        margin-top: 20px;
        padding: 40px 20px 20px;
        background-color: ghostwhite;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.3);
    }

    .bckgrd {
        margin-top: 20px;
        padding: 40px 20px 20px;
        background-color: ghostwhite;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.3);
        opacity: 0.8;
        z-index: 1;
        display: none;
    }

    .tms-modal#id03 {
        background-color: #000;
        opacity: 0.8;
        width: 100%;
    }

    input[img_up_area] {
        content: none;
    }

    .container {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    .form-wrapper-outer {
        padding: 40px;
        border-radius: 8px;
        margin: auto;
        width: 460px;
        border: 1px solid #DADCE0;
        margin-top: 7%;
    }

    .form-button {
        text-align: right;
    }

    .field-wrapper {
        position: relative;
    }

    .field-wrapper input {
        border: 1px solid #DADCE0;
        padding: 15px;
        border-radius: 4px;
        width: 100%;
        margin: 15px 0 10px 0;
    }

    .field-wrapper .field-placeholder {
        font-size: 16px;
        position: absolute;
        /* background: #fff; */
        bottom: 10px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        color: #80868b;
        left: 5px;
        padding: 0 8px;
        -webkit-transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
        transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1;
        text-align: left;
        width: 100%;
    }

    .field-wrapper .field-placeholder span {
        background: #ffffff;
        padding: 0px 8px;
    }

    .field-wrapper input:not([disabled]):focus~.field-placeholder {
        color: #1A73E8;
    }

    .field-wrapper input:not([disabled]):focus~.field-placeholder,
    .field-wrapper.hasValue input:not([disabled])~.field-placeholder {
        -webkit-transform: scale(.80) translateY(-30px) translateX(-30px);
        transform: scale(.80) translateY(-30px) translateX(-30px);

    }

    .field-wrapper input:not([disabled]):focus~.field-placeholder span,
    .field-wrapper.hasValue input:not([disabled])~.field-placeholder span {
        background-color: ghostwhite;
    }

    #addClient_form fieldset:not(:first-of-type) {
        display: none;
    }

    #addClient_form span #msg {
        float: left !important;
    }

    #msg {
        font-size: 12px;
        margin: 5px 0px;
        width: 250px;
    }

    .stay {
        font-size: 13px;
        color: #404040;
    }

    #addClient_form fieldset {
        background-color: transparent;
        border: 0 none;
        padding: 40px;
        position: relative;
        width: 330px;
    }

    #addClient_form .addClient_form-body {
        background-color: #f7f7f7;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        border-radius: 2px;
        padding-bottom: 15px;
        height: max-content;
        width: 330px;
    }

    @media screen and (min-width:992px) {
        #addClient_form .addClient_form-body {
            margin-left: 5px !important;
        }

        .back {
            max-width: 100%;
            width: max-content !important
        }
    }

    @media screen and (min-width:1200px) {
        #addClient_form .addClient_form-body {
            margin-left: 5px !important;
        }

        span.pull-left.previous img {
            margin-top: -15px !important;
        }
    }

    @media screen and (min-width:768px) {
        #addClient_form .addClient_form-body {
            margin-left: 12px !important;
        }
    }

    @media screen and (min-width:360px) {
        span.pull-left.previous {
            margin-top: 10px !important;
            margin-left: -20px !important;
        }

        #addClient_form .addClient_form-body {
            width: 290px !important;
        }

        #addClient_form .addClient_form-body fieldset {
            width: 360px !important;
            padding: 0px 20px !important;
        }

        .field-wrapper {
            width: 250px !important;
        }

        fieldset img.img-circle {
            margin-left: -60px !important;
            margin-top: 20px !important;
        }

        fieldset input.btn-block {
            width: 250px !important;
        }

        .pull-right {
            margin-right: 70px !important;
            margin-top: 10px !important;
        }

        .error_msg {
            width: 250px;
        }
    }

    .progressbar {
        background-color: slateblue;
        width: 290px;
        height: 5px;
    }

    .bar {
        background-color: aqua;
        display: block;
        height: 5px;
        width: 1%;
    }

    .info {
        text-align: left;
    }

    /* Custom Navigator CSS controller */
    @media screen and (min-width:0px) {
        #icon {
            display: block;
        }

        #text {
            display: none;
        }
    }

    @media screen and (min-width:768px) {
        #icon {
            display: block;
        }

        #text {
            display: none;
        }
    }

    @media screen and (min-width: 721px) {
        .topbar {
            display: none;
        }
    }

    @media screen and (min-width:992px) {
        #text {
            display: block;
        }

        #text {
            display: none;
        }

        .topbar {
            display: none;
        }
    }

    @media screen and (min-width:1200px) {
        #text {
            display: block;
        }
    }
</style>
<div class="tms-addclient_main-title">Add new Client</div>
<div class="tms-addclient_main-body">
    <div class="tms-addclient_main-body-content row" style="margin-right: unset; margin-left: unset;">
        <div class="col-sm-6 col-md-4 col-xs-offset-0 col-md-offset-4 text-center col-sm-offset-3">
            <div class="back">
                <h1 class="text-center login-title" style="width: 290px; padding: 5px ">Please provide the required data in order for us to process the client's information</strong>
                </h1>
                <form id="addClient_form" method="POST" enctype="multipart/form-data">
                    <div class="addClient_form-body">
                        <div class="progressbar">
                            <div class="bar"></div>
                        </div>
                        <fieldset>
                            <span class="clearfix"></span>
                            <div class="tms-logo"></div>
                            <div class="field-wrapper">
                                <input type="text" name="nin" id="nin" class="form-control input-lg" maxlength="14" required>
                                <div class="field-placeholder">
                                    <span>Enter your Client NIN</span>
                                </div>
                            </div>
                            <div class="field-wrapper">
                                <input type="text" name="fName" id="fName" class="form-control input-lg" required>
                                <div class="field-placeholder">
                                    <span>Enter your Client First Name</span>
                                </div>
                            </div>
                            <div class="field-wrapper">
                                <input type="text" name="lName" id="lName" class="form-control input-lg" required>
                                <div class="field-placeholder">
                                    <span>Enter your Client Last Name</span>
                                </div>
                            </div>
                            <span class="error_msg 0" id="error_msg"></span>
                            <input type="button" class="btn btn-block btn-info next action-button" name="next" value="Proceed">
                        </fieldset>
                        <fieldset disabled="disabled">
                            <span class="pull-left previous" style="cursor:pointer" name="previous">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="clearfix"></span>
                            <div class="tms-logo"></div>
                            <div class="field-wrapper">
                                <input type="text" name="user" id="user" class="form-control input-lg" required>
                                <div class="field-placeholder">
                                    <span>Enter your Client Username</span>
                                </div>
                            </div>
                            <div class="info">
                                <span class="info-title">Username Suggestions:</span>
                                <table>
                                    <tbody class="usugs" data-get='sugs'></tbody>
                                </table>
                            </div>
                            <div class="field-wrapper">
                                <input type="text" name="hno" id="hno" class="form-control input-lg" required>
                                <div class="field-placeholder">
                                    <span>Enter your Client House No</span>
                                </div>
                            </div>
                            <div class="error_msg 1" id="error_msg"></div>
                            <input type="button" class="btn btn-block btn-info next action-button" name="next" value="Proceed">
                        </fieldset>
                        <fieldset disabled="disabled">
                            <span class="pull-left previous" style="cursor:pointer" name="previous">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="clearfix"></span>
                            <div class="tms-logo"></div>
                            <div class="field-wrapper">
                                <input type="text" name="cont_1" id="cont" class="form-control input-lg" required>
                                <div class="field-placeholder">
                                    <span>Enter your Client Contact</span>
                                </div>
                            </div>
                            <div style="text-align:right; padding-right: 75px">
                                <input type="checkbox" name="oc" id="oc"> If more contacts
                            </div>
                            <div class="field-wrapper">
                                <input type="email" name="email" id="email" class="form-control input-lg" required>
                                <div class="field-placeholder">
                                    <span>Enter your Client Email</span>
                                </div>
                            </div>
                            <div class="field-wrapper">
                                <input type="text" name="prev_add" id="prev_add" class="form-control input-lg" required>
                                <div class="field-placeholder">
                                    <span>Enter Client Previous Add.</span>
                                </div>
                            </div>
                            <div class="input-group date" id="dtp" style="width: 250px">
                                <input type="text" name="datePd" class="form-control" autocomplete="date" required="required">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <div class="error_msg 2" id="error_msg"></div>
                            <input type="button" class="btn btn-block btn-info next action-button" name="next" value="Proceed">
                        </fieldset>
                        <fieldset disabled="disabled">
                            <span class="pull-left previous" style="cursor:pointer" name="previous">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="clearfix"></span>
                            <div class="dashb-ten-img empty">
                                <input type="file" name="addten_img" id="addten_img" hidden="hidden" style="display: none">
                                <img src="/images/img_avatar2.png" alt="Tests image" height="120px" width="130px" <?php if (mysqli_num_rows($img) > 0) echo 'style="display:none;"'; ?>>
                                <div class="upload_btn" style="z-index:9999;height:120px;width:130px;margin-top: -110px;margin-left: -16px;border-radius: 40%;padding: 50px 0px;">
                                    <span class="text_btn">Upload Image</span>
                                </div>
                            </div>
                            <div class="tca" style="max-width: 90%; display: flex;text-align: center; font-size:10px">
                                <div><input type="checkbox" name="tca" id="tca"></div>&MediumSpace;<div style="top: 7px; height: 16px; position:relative; left: 7px">Accept the <a href="//tms.lan/tests/tca">Terms and Conditions</a> of <a href="//tms.lan">TMSystem</a></div>
                            </div>
                            <div class="appr" style="max-width: 90%; display: flex;text-align: left; font-size:10px; margin-bottom: 10px">
                                <div><input type="checkbox" name="appr" id="appr"></div>&MediumSpace;<div style="top: 7px; height: 16px; position:relative; left: 7px; width: 80%" ;>I certify that the information provided is correct to the best of my knowledge</div>
                            </div>
                            <span class="error_msg 3" id="error_msg"></span>
                            <input type="submit" class="btn btn-block btn-info submit action-button" name="submit" value="Process Data" style="background-color: green;">
                            <input type="reset" hidden class="reset_btn">
                        </fieldset>
                    </div>
                </form>
                <span class="clearfix"></span>
            </div>
        </div>
    </div>
</div>
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
        $('.upload_btn').on('click', _ => {
            window.dp_set = true
            $('#id03').show()
        })
    });
</script>
<script src="//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/bootstrap.min.js"></script>
</script>
<script>
    $.getScript('//cdn.tms-dist.lan:433:433/styles/js/jquery.easing.min.js', () => {
        $.getScript('//cdn.tms-dist.lan:433:433/styles/js/jquery.easing.min.js')
        $.getScript('//cdn.tms-dist.lan:433:433/styles/font-awesome/js/all.js')
        $.getScript('//cdn.tms-dist.lan:433:433/styles/js/development/client.min.js')
    })
    $.getScript("//cdn.tms-dist.lan:433/styles/js/moment.min.js", () => {
        $.getScript('//cdn.tms-dist.lan:433/styles/bdtp/js/bootstrap-datetimepicker.min.js', () => {
            dtp = () => {
                if (typeof moment == 'undefined') {
                    setTimeout(dtp, 1000)
                } else {
                    $('#dtp').datetimepicker({
                        viewMode: 'years',
                    })
                }
            }
            dtp()
        })
    })
</script>
<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/bdtp/css/bootstrap-datetimepicker.min.css">
<?php
                    // TODO Required Fields to add user
                    //TODO Accounts username, pass, level, confirm, authkey DONE
                    // NINS NIN, fName, lName DONE
                    // house_info house_num DONE
                    // tenant_details ten_nin, ten_contact, ten_email, ten_pAdd, house_id, ten_img_id
                    // tenant_images ten_img_id, ten_img_location, ten_img_name
                    // tenant_info  ten_id, date_entered, house_id
