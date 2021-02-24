<!DOCTYPE html>
<html lang="en" class="no-js">
<?php
$ret;
if (isset($_COOKIE['login']) && $_COOKIE['login'] == "login" && isset($_COOKIE['user']) && isset($_COOKIE['passwd'])) {
	echo '<script>
		window.location = "https://www.tms.lan/actions/login.php?user='.$_COOKIE['user'].'&passwd='.$_COOKIE['passwd'].'";
	</script>';
}
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include_once("../actions/gtag.php"); ?>
	<title>TMS : Home</title>
	<link href="//cdn.tms-dist.lan:433/styles/fonts/Heebo_Googlefont.css" rel="stylesheet">
	<link href="//cdn.tms-dist.lan:433/styles/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	</link>
	<link rel="stylesheet" href="dist/css/style.css">
	<style>
		@font-face {
			font-family: Poppins-Regular;
			src: url('fonts/poppins/Poppins-Regular.ttf');
		}

		@font-face {
			font-family: Poppins-Medium;
			src: url('fonts/poppins/Poppins-Medium.ttf');
		}

		@font-face {
			font-family: Poppins-Bold;
			src: url('fonts/poppins/Poppins-Bold.ttf');
		}

		@font-face {
			font-family: Poppins-SemiBold;
			src: url('fonts/poppins/Poppins-SemiBold.ttf');
		}

		body {
			padding-top: 40px;
		}

		[data-menu="more-navs"]:hover,
		[data-toggle="more-navs"]:focus {
			background-color: #2980B9;
		}

		.dropdown-content {
			position: absolute;
			background-color: #f1f1f1;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

		@media (max-width: 752px) {
			.more-navs {
				display: block !important;
			}

			#more_nav {
				display: none !important;
			}
		}

		@media (min-width: 753px) {
			#more_nav {
				display: block !important;
			}

			.more-navs {
				display: none !important;
			}
		}

		body.lights-off div.fixed-bottom-right {
			border: 1px solid gray;
			background-color: cadetblue !important;
			color: wheat !important;
		}

		.fixed-bottom-right {
			outline: none !important;
			visibility: visible !important;
			resize: none !important;
			box-shadow: none !important;
			overflow: visible !important;
			background: none !important;
			opacity: 1 !important;
			filter: alpha(opacity=100) !important;
			-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity1) !important;
			-moz-opacity: 1 !important;
			-khtml-opacity: 1 !important;
			top: auto !important;
			right: 10px !important;
			bottom: 0px !important;
			left: auto !important;
			position: fixed !important;
			border: 1px solid black;
			border-bottom: 0 none !important;
			min-height: 0 !important;
			max-height: none !important;
			max-width: 50% !important;
			margin: 0 !important;
			transition-property: none !important;
			-moz-transition-property: none !important;
			-webkit-transition-property: none !important;
			-o-transition-property: none !important;
			transform: none !important;
			-webkit-transform: none !important;
			-ms-transform: none !important;
			-moz-transform: none !important;
			width: 25% !important;
			height: auto !important;
			display: block !important;
			z-index: 20000000 !important;
			background-color: beige !important;
			cursor: pointer !important;
			float: none !important;
			border-radius: 10px 10px 0 0 !important;
			pointer-events: auto !important;
		}

		header.contact_title {
			padding: 0 1.7rem !important;
			text-align: center !important;
		}

		.lights-off main.contact_body {
			background-color: #808080 !important;
		}

		main.contact_body {
			background-color: white !important;
			width: 120% !important;
			margin-left: -20% !important;
			border: 1px solid gray;
			border-bottom: 0 none !important;
			border-right: 0 none !important;
			display: none;
			border-top-left-radius: 10px !important;
		}

		.lights-off .container-contact100 {
			background-color: #b2b2b2 !important;
		}

		.container-contact100 {
			width: 100%;
			min-height: 70vh;
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			padding: 15px;
			/* background: transparent; */
			position: relative;
			border-top-left-radius: 10px !important;
			padding-bottom: 0 !important;
			z-index: 1;
		}

		.wrap-contact100 {
			width: 100%;
			background: #fff;
			border-radius: 10px 10px 0 0;
			overflow: hidden;
			position: relative;
		}

		.contact100-form-title {
			width: 100%;
			position: relative;
			z-index: 1;
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			flex-direction: column;
			align-items: center;

			background-repeat: no-repeat;
			background-size: cover;
			background-position: top;

			padding: 20px 5px 20px 5px;
		}

		.contact100-form-title-1 {
			font-family: Poppins-Bold;
			font-size: 20px;
			color: #fff;
			line-height: 1.2;
			text-align: center;
			padding-bottom: 7px;
		}

		.contact100-form-title-2 {
			font-family: Poppins-Regular;
			font-size: 15px;
			color: #fff;
			line-height: 1.5;
			text-align: center;
		}

		.contact100-form-title::before {
			content: "";
			display: block;
			position: absolute;
			z-index: -1;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			background-color: rgba(54, 84, 99, 0.7);
		}

		.contact100-form {
			width: 100%;
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
			padding: 4.3px 8.8px 5.7px 19px;
		}

		.wrap-input100 {
			width: 100%;
			position: relative;
			border-bottom: 1px solid #b2b2b2;
			margin-bottom: 26px;
		}

		.label-input100 {
			font-family: Poppins-Regular;
			font-size: 15px;
			color: #808080;
			line-height: 1.2;
			text-align: right;

			position: absolute;
			top: 14px;
			left: -95px;
			width: 40px;

		}

		.input100 {
			font-family: Poppins-Regular;
			font-size: 15px;
			color: #555555;
			line-height: 1.2;

			display: block;
			width: 100%;
			background: transparent;
			padding: 0 5px;
		}

		.focus-input100 {
			position: absolute;
			display: block;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			pointer-events: none;
		}

		.focus-input100::before {
			content: "";
			display: block;
			position: absolute;
			bottom: -1px;
			left: 0;
			width: 0;
			height: 1px;

			-webkit-transition: all 0.6s;
			-o-transition: all 0.6s;
			-moz-transition: all 0.6s;
			transition: all 0.6s;

			background: #57b846;
		}

		input.input100 {
			height: 45px;
		}

		textarea.input100 {
			min-height: 80px;
			padding-top: 9px;
			padding-bottom: 7px;
		}

		.input100:focus+.focus-input100::before {
			width: 100%;
		}

		.has-val.input100+.focus-input100::before {
			width: 100%;
		}

		.container-contact100-form-btn {
			width: 100%;
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			padding-top: 2px;
		}

		.contact100-form-btn {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			justify-content: center;
			align-items: center;
			padding: 0 12px;
			min-width: 100%;
			height: 50px;
			background-color: #57b846;
			border-radius: 2.5px;

			font-family: Poppins-Regular;
			font-size: 12px;
			color: #fff;
			line-height: 1.2;

			-webkit-transition: all 0.4s;
			-o-transition: all 0.4s;
			-moz-transition: all 0.4s;
			transition: all 0.4s;
		}

		.contact100-form-btn i {
			-webkit-transition: all 0.4s;
			-o-transition: all 0.4s;
			-moz-transition: all 0.4s;
			transition: all 0.4s;
		}

		.contact100-form-btn:hover {
			background-color: #333333;
		}

		.contact100-form-btn:hover i {
			-webkit-transform: translateX(10px);
			-moz-transform: translateX(10px);
			-ms-transform: translateX(10px);
			-o-transform: translateX(10px);
			transform: translateX(10px);
		}

		@media (max-width: 576px) {
			.contact100-form {
				padding: 4.3px 1.5px 5.7px 1.17px;
			}
		}

		@media (max-width: 480px) {
			.contact100-form {
				padding: 4.3px 1.5px 5.7px 1.5px;
			}

			.label-input100 {
				text-align: left;
				position: unset;
				top: unset;
				left: unset;
				width: 100%;
				padding: 0 5px;
			}
		}

		.validate-input {
			position: relative;
		}

		.alert-validate::before {
			content: attr(data-validate);
			position: absolute;
			max-width: 70%;
			background-color: #fff;
			border: 1px solid #c80000;
			border-radius: .2px;
			padding: .4px 2.5px .4px 1.0px;
			top: 50%;
			-webkit-transform: translateY(-50%);
			-moz-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			-o-transform: translateY(-50%);
			transform: translateY(-50%);
			right: .2px;
			pointer-events: none;

			font-family: Poppins-Medium;
			color: #c80000;
			font-size: 10px;
			line-height: 1.4;
			text-align: left;

			visibility: hidden;
			opacity: 0;

			-webkit-transition: opacity 0.4s;
			-o-transition: opacity 0.4s;
			-moz-transition: opacity 0.4s;
			transition: opacity 0.4s;
		}

		.alert-validate::after {
			content: "\f06a";
			font-family: FontAwesome;
			display: block;
			position: absolute;
			color: #c80000;
			font-size: 10px;
			top: 50%;
			-webkit-transform: translateY(-50%);
			-moz-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			-o-transform: translateY(-50%);
			transform: translateY(-50%);
			right: 8px;
		}

		.alert-validate:hover:before {
			visibility: visible;
			opacity: 1;
		}

		@media (max-width: 992px) {
			.alert-validate::before {
				visibility: visible;
				opacity: 1;
			}
		}
	</style>
</head>

<body class="is-boxed has-animations">
	<div class="body-wrap boxed-container">
		<header class="site-header">
			<div class="container">
				<div class="container">
					<nav class="navbar navbar-default navbar-sticky navbar-expand-md bg-dark navbar-fixed-top">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="/">
									<img src="/favicon.ico" alt="Brand" width="50">
								</a>
							</div>
							<div id="navbar" class="navbar-collapse collapse">
								<ul class="nav navbar-nav navbar-left" style="font-size: medium;">
									<?php
									if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] == true) { ?>
										<li class="nav-item">
											<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/man-custom.css" type="text/css" />
											<a class="nav-link" id="verifier" href="#verifyusers">
												Verify Users
											</a>
										</li>
										<li class="nav-item">
											<a onclick="ten()" href="#tenants" class="nav-link">Tenants</a>
										</li>
										<li class="nav-item">
											<a href="#processpayments" class="nav-link" onclick="process()">Process Rent Payments</a>
										</li>
										<li class="nav-item">
											<a href="#tenants" class="nav-link more-navs" id="ten_det">Tenants Details</a>
										</li>
										<li class="nav-item">
											<a href="#addtenant" onclick="addTen()" class="nav-link more-navs" id="add_ten">New Tenant</a>
										</li>
										<li class="dropdown" role="presentation" style="padding: 0px 25px">
											<a href="#more" class="dropdown-toggle" data-menu="more-navs" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="more_nav"><i class="fa fa-arrow-circle-down"></i><span class="caret"></span></a>
											<ul class="dropdown-menu dropdown-content">
												<li class="nav-item"><a href="#remtenant" onclick="remTen()" class="nav-link" id="rem_ten">Remove Tenant</a></li>
												<span class="divider" style="background-color: black;height: 1px;width: 100%;display: block;"></span>
												<li class="nav-item"><a href="#housedet" onclick="houseDet()" class="nav-link" id="rem_ten">House Details</a></li>
												<span class="divider" style="background-color: black;height: 1px;width: 100%;display: block;"></span>
												<li class="nav-item"><a href="#tenants" class="nav-link" id="ten_det">Tenants Details</a></li>
												<span class="divider" style="background-color: black;height: 1px;width: 100%;display: block;"></span>
												<li class="nav-item"><a href="#addtenant" onclick="addTen()" class="nav-link" id="add_ten">New Tenant</a></li>
											</ul>
										</li>
										<li class="nav-item">
											<a href="#remtenant" onclick="remTen()" class="nav-link more-navs" id="rem_ten">Remove Tenant</a>
										</li>
										<li class="nav-item"><a href="#housedet" onclick="houseDet()" class="nav-link more-navs" id="rem_ten">House Details</a></li>
									<?php
									} else if (isset($_SESSION['client_logged_in']) && $_SESSION['client_logged_in'] == true) {
									?>
										<li class="nav-item">
											<a href="javascript:void(0)">No content to navigate to.</a>
										</li>
									<?php
									} ?>
								</ul>
								<div id="account">
									<div id="account_no-login">
										<form action="javascript:void(0)" method="post" class="nav navbar-form navbar-right" role="login">
											<div class="form-group">
												<input type="text" name="user" class="form-control" aria-label="Username" autocomplete="FALSE" aria-labelledby="Username" title="Username" placeholder="Username" value="">
												<input type="password" name="passwd" class="form-control" aria-label="Password" autocomplete="FALSE" aria-labelledby="Password" title="Password" placeholder="Password" value="">
												<button id="nav-btn" type="submit" class="btn btn-default">Login</button>
											</div>
										</form>
									</div>
									<div id="account_login" class="nav navbar-nav navbar-right hidden">
										<li class="nav-item">
											<a class="navbar-item" href="/actions/logout.php" style="font-size: small;"><span class="glyphicon glyphicon-log-out"></span> Logout <?php echo $_SESSION['fName']; ?></a>
										</li>
									</div>
								</div>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>

		<main>
			<section class="hero">
				<div class="container">
					<div class="hero-inner">
						<div class="hero-copy">
							<h1 class="hero-title mt-0">Tenant Management System</h1>
							<p class="hero-paragraph">Our all new home page and more coming new features.</p>
							<p class="hero-paragraph">We have included a dark mode feature for the homepage and more is coming</p>
							<div class="hero-cta">
								<div class="lights-toggle">
									<input id="lights-toggle" type="checkbox" name="lights-toggle" class="switch" checked="checked">
									<label for="lights-toggle" class="text-xs"><span>Turn <span class="label-text">on</span> Dark Mode</span></label>
								</div>
							</div>
						</div>
						<div class="hero-media">
							<div class="header-illustration">
								<img class="header-illustration-image asset-light" src="dist/images/header-illustration-light.svg" alt="Header illustration">
								<img class="header-illustration-image asset-dark" src="dist/images/header-illustration-dark.svg" alt="Header illustration">
							</div>
							<div class="hero-media-illustration">
								<img class="hero-media-illustration-image asset-light" src="dist/images/hero-media-illustration-light.svg" alt="Hero media illustration">
								<img class="hero-media-illustration-image asset-dark" src="dist/images/hero-media-illustration-dark.svg" alt="Hero media illustration">
							</div>
							<div class="hero-media-container">
								<img class="hero-media-image asset-light" src="/images/home_page/Rentals 5.png" alt="Hero media">
								<img class="hero-media-image asset-dark" src="/images/home_page/Rentals 5.png" alt="Hero media">
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="features section">
				<div class="container">
					<div class="features-inner section-inner has-bottom-divider">
						<div class="features-header text-center">
							<div class="container-sm">
								<h2 class="section-title mt-0">Nantongo Estates</h2>
								<p class="section-paragraph">The premium estate in our collection located in Masanda Zone, Kyengera Parish, Wakiso, Uganda.</p>
								<div class="features-image">
									<img class="features-illustration asset-dark" src="dist/images/features-illustration-dark.svg" alt="Feature illustration">
									<img class="features-box asset-dark" src="/images/home_page/Rentals 5.png" height="370" width="540" alt="Feature box">
									<img class="features-illustration asset-dark" src="dist/images/features-illustration-top-dark.svg" alt="Feature illustration top">
									<img class="features-illustration asset-light" src="dist/images/features-illustration-light.svg" alt="Feature illustration">
									<img class="features-box asset-light" src="/images/home_page/Rentals 5.png" height="370" width="540" alt="Feature box">
									<img class="features-illustration asset-light" src="dist/images/features-illustration-top-light.svg" alt="Feature illustration top">
									<div class="hero-paragraph">One of the 3 Blocks</div>
								</div>
							</div>
						</div>
						<div class="features-wrap">
							<div class="feature is-revealing">
								<div class="feature-inner">
									<div class="feature-icon">
										<img class="asset-light" src="dist/images/feature-01-light.svg" alt="Feature 01">
										<img class="asset-dark" src="dist/images/feature-01-dark.svg" alt="Feature 01">
									</div>
									<div class="feature-content">
										<h3 class="feature-title mt-0">Discover</h3>
										<p class="text-sm mb-0">The essence that comes with living atop a hill, with the thrill of the cool breeze day in day out.</p>
									</div>
								</div>
							</div>
							<div class="feature is-revealing">
								<div class="feature-inner">
									<div class="feature-icon">
										<img class="asset-light" src="dist/images/feature-02-light.svg" alt="Feature 02">
										<img class="asset-dark" src="dist/images/feature-02-dark.svg" alt="Feature 02">
									</div>
									<div class="feature-content">
										<h3 class="feature-title mt-0">Discover</h3>
										<p class="text-sm mb-0">The hospitable conditions and the beautiful people that reside in the area, without prejudice you will feel loved on moving here.</p>
									</div>
								</div>
							</div>
							<div class="feature is-revealing">
								<div class="feature-inner">
									<div class="feature-icon">
										<img class="asset-light" src="dist/images/feature-03-light.svg" alt="Feature 03">
										<img class="asset-dark" src="dist/images/feature-03-dark.svg" alt="Feature 03">
									</div>
									<div class="feature-content">
										<h3 class="feature-title mt-0">Discover the Beautiful Geology</h3>
										<p class="text-sm mb-0">For exercise lovers, there exists different kinds of sports in the area. Including but not limited to a gymnasium, Soccer fields et cetera.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="cta section">
				<div class="container-sm">
					<div class="cta-inner section-inner">
						<div class="cta-header text-center">
							<h2 class="section-title mt-0">Get it and Switch Conditions</h2>
							<p class="section-paragraph">Leave us a message, comment, and we will get back to you for all your needs and questions.</p>
							<div class="cta-cta">
								<a class="button button-primary" href="javascript:b()">Leave feedback</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>

		<footer class="site-footer has-top-divider">
			<div class="container">
				<div class="site-footer-inner">
					<div class="brand footer-brand">
						<a href="#">
							<img class="asset-light" src="/favicon.ico" alt="Logo">
							<img class="asset-dark" src="/favicon.ico" alt="Logo">
						</a>
					</div>
					<ul class="footer-links list-reset">
						<li>
							<a href="/aboutus">About us</a>
						</li>
						<li>
							<a href="/faq">FAQ's</a>
						</li>
						<li>
							<a href="support">Support</a>
						</li>
					</ul>
					<ul class="footer-social-links list-reset">
						<li>
							<a href="//www.facebook.com/tmsystem.live">
								<span class="screen-reader-text">Facebook</span>
								<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
									<path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z" fill="#FFF" />
								</svg>
							</a>
						</li>
						<li>
							<a href="//www.twitter.com/tmsystem.live">
								<span class="screen-reader-text">Twitter</span>
								<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z" fill="#FFF" />
								</svg>
							</a>
						</li>
					</ul>
					<div class="footer-copyright">&copy; 2020 Jarvaang Enterprises, all rights reserved</div>
				</div>
			</div>
		</footer>

		<div class="fixed-bottom-right">
			<header class="contact_title" aria-haspopup="true" aria-expanded="false">
				Contact Us
			</header>
			<main class="contact_body" style="height: 0 !important;">
				<div class="container-contact100">
					<div class="wrap-contact100">
						<div class="contact100-form-title" style="background-image:url(images/bg-01.jpg);">
							<span class="contact100-form-title-1">Feedback</span>
							<span class="contact100-form-title-2">Feel free to drop us a line below</span>
						</div>
						<form action="/feedback" class="contact100-form validate-form">
							<div class="wrap-input100 validate-input" data-validate="Name is required">
								<span class="label-input100">Full Name:</span>
								<input type="text" class="input100" name="name" placeholder="Enter full name">
								<span class="focus-input100"></span>
							</div>
							<div class="wrap-input100 validate-input" data-validate="Email is required">
								<span class="label-input100">Email:</span>
								<input type="email" class="input100" name="email" placeholder="Enter email address">
								<span class="focus-input100"></span>
							</div>
							<div class="wrap-input100 validate-input" data-validate="Phone is required">
								<span class="label-input100">Phone Number:</span>
								<input type="email" class="input100" name="phone" placeholder="Enter phone number">
								<span class="focus-input100"></span>
							</div>
							<div class="wrap-input100 validate-input" data-validate="Message is required">
								<span class="label-input100">Full Name:</span>
								<textarea class="input100" name="message" placeholder="Your feedback ..."></textarea>
								<span class="focus-input100"></span>
							</div>
							<div class="container-contact100-form-btn">
								<button class="contact100-form-btn">
									<span>
										Submit
										<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
									</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script src="//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js"></script>
	<script src="//cdn.tms-dist.lan:433/styles/js/bootstrap.js"></script>
	<script src="//cdn.tms-dist.lan:433/styles/js/scrollreveal.min.js"></script>
	<script src="dist/js/main.min.js" async></script>
	<script src="dist/js/main.js" async></script>
	<script>
		function b(){
			if ($('header.contact_title').attr('aria-expanded') == 'false') {
				$('header.contact_title').attr('aria-expanded', 'true')
				$('main.contact_body').css({
					display: 'block'
				})
				$('main.contact_body').animate({
					height: '494px'
				}, 2000)
			} else {
				$('header.contact_title').attr('aria-expanded', 'false')
				$('main.contact_body').animate({
					height: '0px'
				}, 2000)
				setTimeout(_ => {
					$('main.contact_body').css({
						display: 'none'
					})
				}, 2000)
			}
		}
		$('header.contact_title').on('click', _ => {
			b()
		})
		$('header.contact_title').on('focusout', function() {
			$('header.contact_title').attr('aria-expanded', 'false')
			$('main.contact_body').animate({
				height: '0px'
			}, 2000)
			setTimeout(_ => {
				$('main.contact_body').css({
					display: 'none'
				})
			}, 2000)
		})
		if (loggedIn) {
			$('#account_no-login').css({
				display: 'none'
			})
			$('#account_login').removeClass('hidden')
		}
		var loginForm = $('[role="login"]');
		loginForm.on('submit', _ => {
			_.preventDefault()
			$.ajax({
				url: "/actions/checkAuth.php",
				type: "POST",
				data: new FormData(loginForm.get(0)),
				contentType: false,
				cache: true,
				dataType: "JSON",
				processData: false,
				success: function(data) {
					if (data.action == "SHOW_ERROR") {
						$(".login").animate({
							height: "410px"
						});
						$('#password').css({
							'border-color': '#dd4b39'
						});
						$('#password').focus();
						$('#msg').css({
							'color': '#dd4b39',
							'text-align': 'left'
						});
						$('#msg').text(data.msg);
					} else if (data.action == "SHOW_SUCCESS") {
						window.location.reload()
					}
				},
				error: function(_) {
					console.log(_)
					console.log("Errors occured: In authentication.");
					console.log("window.location.href ='" + ref + "'");
				}
			});
		})
		var verifier = document.getElementById("verifier");
		if (verifier != null) {
			verifier.addEventListener("click", function() {
				$("#LTContent").css({
					display: "none"
				});
				$("#ten_list").css({
					display: "none"
				});
				$('#processrent').css({
					display: 'none'
				});
				$('#tendet').css({
					display: 'none'
				});
				$('#newten').css({
					display: 'none'
				})
				$('#Tenact').hide()
				$("#verify").load("/includes/ver.php");
			});
		}
		$('li.nav-item').on('click', () => {
			$('.navbar-collapse').removeClass('collapse')
			$('.navbar-collapse').addClass('collapsing')
			$('.navbar-collapse').animate({
				height: '0px',
			})
			$('.navbar-collapse').removeClass('collapsing')
			$('.navbar-collapse').removeClass('show')
			$('.navbar-collapse').addClass('collapse')
		})
		if (window.location.pathname == '/man/' || location.pathname == '/man')
			tendet()
	</script>
	<?php
	if ($_COOKIE['darkmode'] && $_COOKIE['darkmode'] == '1') {
		echo "<script>$('#lights-toggle').get(0).checked = true</script>";
	}
	?>
</body>

</html>