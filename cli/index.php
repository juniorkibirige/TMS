<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https" : "http")
        . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $loc = "Location: /redirectlogin.php?_rdr&cont=" . $url;
    header($loc);
} else if (!isset($_SESSION['logged_in'])) {
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https" : "http")
        . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $loc = "Location: /redirectlogin.php?_rdr&cont=" . $url;
    header($loc);
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TMS->Client Dashboard</title>
    <link rel="icon" href="/images/favicon.png" type="image/png" />
    <link rel="shortcut icon" href="/images/favicon.png" type="image/png" />
    <script src="//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.tms-dist.lan:433/styles/js/tenants.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.tms-dist.lan:433/styles/js/main.js" crossorigin="anonymous" async></script>
    <script src="//cdn.tms-dist.lan:433/styles/js/ver.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/bootstrap.min.css" crossorigin="anonymous" type="text/css" />
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/custom.css" crossorigin="anonymous" type="text/css" />
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/style.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/client.min.css" crossorigin="anonymous">
    <style>
        .lactive {
            background-color: darkgrey !important;
            color: black !important;
        }
    </style>
</head>

<body>
    <div id="header"></div>
    <div id="dialog"></div>
    <div class="container" style="min-height: 40rem">
        <div class="container topbar" style="padding: 0px 15px !important;">
            <nav class="navbar navbar-inverse navbar-sticky bg-light" style="min-height:10px !important;width:100%;border-radius:5px 5px 0 0;margin-bottom:0px;">
                <div class="container-fluid" style="height:30px !important">
                    <div id="navbar" style="height:30px !important">
                        <ul class="nav navbar-nav" style="height:30px !important;margin:0px 0px 0px 0px;display: flex;justify-content: space-around; width: 100%; display:-webkit-flex;-webkit-justify-content:space-around">
                            <li class="nav-item" style="display:inline-block; margin-right:8px">
                                <a href="#launchpad" class="nav-link s-text" data-target="dashboard" onclick="select(this)" style="padding-top: 3px;padding-bottom: 5px">
                                    <span id="icon">
                                        DBrd
                                    </span>
                                    <span id="text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item" style="display:inline-block; margin-right:8px">
                                <a href="#paymentdetails" class="nav-link s-text" data-target="paydet" onclick="select(this)" style="padding-top: 3px;padding-bottom: 5px">
                                    <span id="icon">
                                        Pay Det
                                    </span>
                                    <span id="text">Payment Details</span>
                                </a>
                            </li>
                            <li class="nav-item" style="display:inline-block; margin-right:8px">
                                <a href="#rentarrears" class="nav-link s-text" data-target="rentarr" onclick="select(this)" style="padding-top: 3px;padding-bottom: 5px">
                                    <span id="icon">
                                        Arrears
                                    </span>
                                    <span id="text">Rent Arrears</span>
                                </a>
                            </li>
                            <li class="nav-item" style="display:inline-block;">
                                <a href="#complaints" class="nav-link s-text" data-target="complaint" onclick="select(this)" style="padding-top: 3px;padding-bottom: 5px">
                                    <span id="icon">
                                        C
                                    </span>
                                    <span id="text">Complaints</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div id="LTContent" class="container" style="padding: 0px 15px !important;"></div>
    </div>
    <div id="footer"></div>
    <script>
        LTL();
        loadprerequisites();
        select = (e) => {
            $('.lactive').removeClass('lactive');
            $(e.parentNode).addClass('lactive');
            e.dataset['target'] == 'dashboard' ?
                dboard() :
                e.dataset['target'] == 'paydet' ?
                paydet() :
                e.dataset['target'] == 'rentarr' ?
                rentarrears() :
                e.dataset['target'] == 'complaint' ?
                compnts() :
                null
        }
        compnts = () => {
            // CP()
            $(".rentarrears").css({
                "display": "none"
            });
            $(".dashboard").css({
                "display": "none"
            });
            $(".paydet").css({
                "display": "none"
            });
            $('.complnts').css({
                "display": "block"
            });
        }
        rentarrears = () => {
            // RA()
            $(".rentarrears").css({
                "display": "block"
            });
            $(".dashboard").css({
                "display": "none"
            });
            $(".paydet").css({
                "display": "none"
            });
            $('.complnts').css({
                "display": "none"
            });
        }
        paydet = () => {
            PD()
            $(".paydet").css({
                "display": "block"
            });
            $(".dashboard").css({
                "display": "none"
            });
            $(".rentarrears").css({
                "display": "none"
            });
            $('.complnts').css({
                "display": "none"
            });
        }
        dboard = () => {
            LD()
            $(".dashboard").css({
                "display": "block"
            });
            $(".paydet").css({
                "display": "none"
            });
            $(".rentarrears").css({
                "display": "none"
            });
            $('.complnts').css({
                "display": "none"
            });
        }
    </script>
</body>

</html>