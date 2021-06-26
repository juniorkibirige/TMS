<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant Management System : Manager</title>
    <link rel="icon" href="/images/favicon.png" type="image/png"/>
    <link rel="shortcut icon" href="/images/favicon.png" type="image/png"/>
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/man-custom.css" type="text/css"/>
    <link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/custom.css" type="text/css"/>
</head>

<body>
<?php session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['manager_logged_in'] == true) { ?>
<div id="header"></div>
<div id="dialog"></div>
<div class="container">
    <div id="verify"></div>
    <div id="ten_list"></div>
    <div id="processrent"></div>
    <div id="tendet"></div>
    <div id="Tenact"></div>
    <?php
    } else if ($_SESSION['manager_logged_in'] == false) {
        header('Location: /error/forbidden.html');
    } else {
        echo 'Your not logged in';
    }
    ?>
    <div id="LTContent"></div>
</div>
<script src="//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/jquery-2.1.3.min.js" crossorigin="anonymous"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/popper.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/bootstrap.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/jquery-2.1.3.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/ver.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/navigation.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/tenants.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/main.min.js"></script>
<script>
    loadprerequisites();
</script>
</body>

</html>