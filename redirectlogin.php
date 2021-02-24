<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TMS : Redirect Login</title>
    <script src="//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/custom.css">
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/style.css">
    <script src="//cdn.tms-dist.lan:433/styles/js/main.js" async></script>
</head>
<style>
    body {
        background-color: blueviolet !important;
    }
</style>

<body>
    <?php
    if(isset($_GET['cont']) && $_GET['cont'] !== null){
        echo '<script>window.cont="'.$_GET['cont'].'".concat(location.hash)</script>';
    }
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 text-center">
                <div class="back">
                    <h1 class="text-center login-title">Sign in to continue to <br><strong>Tenant Management
                            System</strong>
                    </h1>
                    <form id="msform" method="POST" enctype="multipart/form-data">
                        <div class="login">
                            <div class="progressbar">
                                <div class="bar"></div>
                            </div>
                            <fieldset>
                                <span class="clearfix"></span>
                                <img src="/images/img_avatar2.png" alt="Default" height="100" class="img-circle">
                                <div class="field-wrapper">
                                    <input type="email" name="user" id="email" class="form-control input-lg">
                                    <div class="field-placeholder">
                                        <span>Enter your Email or Username</span>
                                    </div>
                                </div>
                                <span class="error_msg" id="error_msg"></span>
                                <input type="button" class="btn btn-block btn-info next action-button" name="next" value="Next">
                                <span class="help">
                                    <a href="#" class="pull-right">Need help?</a>
                                </span>
                            </fieldset>
                            <fieldset>
                                <span class="pull-left previous" style="cursor:pointer" name="previous">
                                    <img src="/images/arrow_back.png" alt="Back">
                                </span>
                                <span class="img" id="img">
                                    <img src="/images/img_avatar2.png" alt="" height="100" class="img-circle">
                                </span>
                                <div class="clearfix"></div>
                                <strong>
                                    <span id="userName"></span>
                                </strong>
                                <br>
                                <span id="userEmail"></span>
                                <div class="field-wrapper">
                                    <input type="password" name="passwd" id="password" class="form-control input-lg">
                                    <div class="field-placeholder">
                                        <span>Password</span>
                                    </div>
                                </div>
                                <span class="pull-left tms-center" id="msg"></span>
                                <input type="submit" class="btn btn-block btn-info submit action-button" name="submit" value="Sign In">
                                <div class="clearfix">
                                    <p></p>
                                </div>
                                <div class="pull-left stay">
                                    <input type="checkbox" name="remember" id="remember" value="1" checked="">
                                    Stay signed in
                                </div>
                                <span class="help">
                                    <a href="#" class="pull-right">Forgot Password?</a>
                                </span>
                                <span class="clearfix"></span>
                                <a href="#" class="new-account">Sign in with a different account</a>
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
        });
    </script>
    <script src="//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js"></script>
    <script src="//cdn.tms-dist.lan:433/styles/js/bootstrap.min.js"></script>
    <script src="//cdn.tms-dist.lan:433/styles/js/jquery.easing.min.js"></script>
    <script src="//cdn.tms-dist.lan:433/styles/js/loginvalidation.js"></script>
    <script src="//cdn.tms-dist.lan:433/styles/js/control.js"></script>
</body>

</html>