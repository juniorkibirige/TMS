<script src="//cdn.tms-dist.lan:433/styles/js/popper.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/bootstrap.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/font-awesome/js/all.min.js"></script>

<head>
	<?php include_once("../actions/gtag.php"); ?>
</head>
<div class="container">
	<nav class="navbar navbar-inverse navbar-sticky navbar-expand-md bg-light">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Tenant Management System</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav" style="float:left;">
					<?php session_start();
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
							<a href="#tenants" class="nav-link" id="ten_det">Tenants Details</a>
						</li>
						<li class="nav-item">
							<a href="#addtenant" onclick="addTen()" class="nav-link" id="add_ten">New Tenant</a>
						</li>
						<li class="dropdown" style="padding: 0px 25px">
							<a href="#more" x-placement="bottom-start" class="dropdown-toggle" data-menu="more-navs" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="more_nav">
								<i class="fa fa-arrow-circle-down"></i><span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-content" aria-labelledby="move_nav">
								<li class="nav-item">
									<a href="#remtenant" onclick="remTen()" class="nav-link" id="rem_ten">Remove Tenant</a>
								</li>
								<span class="divider" style="background-color: black;height: 1px;width: 100%;display: block;"></span>
								<li class="nav-item">
									<a href="#housedet" onclick="houseDet()" class="nav-link" id="rem_ten">House Details</a>
								</li>
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
				<ul class="nav navbar-nav navbar-right" style="float:right;">
					<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) { ?>
						<li>
							<button style="margin-top: 15px;background:transparent;border:none;color:darkgrey" onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'"><span class="glyphicon glyphicon-user"></span> Sign Up</button>
						</li>
						<li>
							<button style="margin-top: 15px;background:transparent;border:none;color:darkgrey" onclick="document.getElementById('id01').style.display='block'; document.getElementById('id02').style.display='none'"><span class="glyphicon glyphicon-log-in"></span> Login</button>
						</li>
					<?php } else if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
						<li>
							<a class="navbar-item" href="/actions/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout <?php echo $_SESSION['fName']; ?></a>
						</li>
					<?php } else { ?>
						<li>
							<button style="margin-top: 15px;background:transparent;border:none;color:darkgrey" onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'"><span class="glyphicon glyphicon-user"></span> Sign Up</button>
						</li>
						<li>
							<button style="margin-top: 15px;background:transparent;border:none;color:darkgrey" onclick="document.getElementById('id01').style.display='block'; document.getElementById('id02').style.display='none'"><span class="glyphicon glyphicon-log-in"></span> Login</button>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
</div>
<script>
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
	$('#more_nav').on('click', ()=>{
		$('#more_nav').parent('.dropdown').toggleClass('show');
		$('#more_nav').next('.dropdown-content').toggleClass('show');
	})
	if (window.location.pathname == '/man/' || location.pathname == '/man')
		tendet()
</script>
<style>
	[data-menu="more-navs"]:hover,
	[data-toggle="more-navs"]:focus {
		background-color: #2980B9;
	}

	.dropdown-content {
		display: none;
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
</style>