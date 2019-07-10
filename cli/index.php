<?php 
session_start();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false){
    $url = 
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https":"http")
    ."://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $loc = "Location: /redirectlogin.php?_rdr&cont=".$url;
    header($loc);
}else if(!isset($_SESSION['logged_in'])){
    $url = 
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https":"http")
    ."://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $loc = "Location: /redirectlogin.php?_rdr&cont=".$url;
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
	<script src="https://cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js"
	crossorigin="anonymous"></script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/tenants.min.js"
	crossorigin="anonymous"></script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/main.js" 
	crossorigin="anonymous"
	></script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/ver.js" 
	crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/bootstrap.min.css" 
	crossorigin="anonymous" type="text/css" />
	<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/custom.css" 
	crossorigin="anonymous" type="text/css" />
	<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/style.css"
    crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/client.min.css" 
    crossorigin="anonymous">
    </head>
    <body>
        <div id="header"></div>
        <div id="dialog"></div>
        <div class="container">
            <div id="LTContent"></div>
        </div>
        <script>
            LTL();
            loadprerequisites();
        </script>
    </body>
</html>