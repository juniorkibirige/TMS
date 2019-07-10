<?php
$ret;
if (isset($_COOKIE['login']) && $_COOKIE['login'] == "login") {
	echo '<script>
		window.location = "https://www.tms.lan/actions/login.php?user='.base64_decode($_COOKIE['user']).'&passwd='.base64_decode($_COOKIE['passwd']).'";
	</script>';
}
?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tenant Management System</title>
	<link rel="icon" href="/images/favicon.png" type="image/png" />
	<link rel="shortcut icon" href="/images/favicon.png" type="image/png" />
	<script src="https://cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/tenants.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/main.js" crossorigin="anonymous"></script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/ver.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/bootstrap.min.css" crossorigin="anonymous" type="text/css" />
	<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/custom.css" crossorigin="anonymous" type="text/css" />
	<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/style.css" crossorigin="anonymous" />
</head>

<body>
	<div id="header"></div>
	<div id="dialog"></div>
	<div class="container">
		<div id="content" class="content col-xs-12"></div>
		<div id="photo" class="content col-xs-12" style="display:none"></div>
		<div id="verify" class="content col-xs-12"></div>
		<div id="LTContent"></div>
	</div>

	<script>
		loadprerequisites();
	</script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.tms-dist.lan:433/styles/js/jquery-2.1.3.min.js" crossorigin="anonymous"></script>
</body>

</html>