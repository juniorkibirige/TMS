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
						<li class="nav-item dropdown">
							<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/man-custom.css" type="text/css" />
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="actions" href="#">Actions</a>
							<div class="dropdown-menu" style="background-color:#222;border-color:#080808;" aria-labelledby="actions" style="background-color:#f0f0fff0;">
								<a class="dropdown-item" id="verifier" href="#verifyusers">
									<div>Verify Users</div>
								</a>
								<div class="dropdown-divider" style="border: 1px solid black"></div>
							</div>
						</li>
						<li class="nav-item">
							<a onclick="LTL()" href="#tenants" class="nav-link">Tenants</a>
						</li>
					<?php
				} else if ($_SESSION['client_logged_in'] == true) {
					?>
						<li class="nav-item">
							<a href="javascript:void(0)">No links to show.</a>
						</li>
					<?php
				} else{
					?>
					<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="services" href="#">Services</a>
							<div class="dropdown-menu" style="background-color:#222;border-color:#080808;" aria-labelledby="services" style="background-color:#f0f0fff0;">
								<a class="dropdown-item" href="/svcs/accd.html">
									<div>Accomodation</div>
								</a>
							</div>
						</li>
					<?php
				}
				?>
				</ul>
				<ul class="nav navbar-nav navbar-right" style="float:right;">
					<?php if ($_SESSION['logged_in'] == false) { ?>
						<li>
							<button style="margin-top: 15px;background:transparent;border:none;color:darkgrey" onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'"><span class="glyphicon glyphicon-user"></span> Sign Up</button>
						</li>
						<li>
							<button style="margin-top: 15px;background:transparent;border:none;color:darkgrey" onclick="document.getElementById('id01').style.display='block'; document.getElementById('id02').style.display='none'"><span class="glyphicon glyphicon-log-in"></span> Login</button>
						</li>
					<?php } else if ($_SESSION['logged_in'] == true) { ?>
						<li>
							<a class="navbar-item" href="/actions/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout <?php echo $_SESSION['fName']; ?></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
</div>
<script>
var verifier = document.getElementById("verifier");
verifier.addEventListener("click",function(){
	$("#LTContent").css({
		display:"none"
	});
    $("#verify").load("/includes/ver.php"); 
});
</script>