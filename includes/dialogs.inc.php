<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/dialogs.inc.css">
<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/style.css">
<div class="tms-modal" id="id02" style="cursor:pointer;
		<?php
		if (isset($_COOKIE['info'])) { ?>
																display:block;<?php
																		} ?>">
	<div class="tms-modal-content animate tms-card-4" style="max-width:600px; cursor:auto;">
		<form method="post" action="/actions/signup.php" autocomplete="off">
			<div class="tms-center"><br>
				<h2>Register</h2>
				<?php
				if (isset($_COOKIE['info'])) {
					echo '<br><br><span class="alert alert-danger">' . $_COOKIE['info'] . '</span>';
				} ?>
				<span onclick="document.getElementById('id02').style.display='none'" class="tms-button tms-hover-text-grey tms-container tms-display-topright tms-xxlarge" title="Close Modal">x</span>
			</div>
			<div class="tms-container">
				<div class="tms-section">
					<label for="fName"><b>First name</b></label>
					<input class="tms-input tms-border tms-margin-bottom form-control" type="text" placeholder="First Name" name="fName" required <?php if (isset($_COOKIE['fName'])) {
																																						echo 'value=' . base64_decode($_COOKIE['fName']) . ' style="border 1px red"';
																																					}
																																					?>>

					<label for="lName"><b>Last name</b></label>
					<input class="tms-input tms-border tms-margin-bottom form-control" type="text" placeholder="Last Name" name="lName" required <?php if (isset($_COOKIE['lName'])) {
																																						echo 'value=' . base64_decode($_COOKIE['lName']);
																																					}
																																					?>>

					<label for="email"><b>Email</b></label>
					<input class="tms-input tms-border tms-margin-bottom form-control" type="email" placeholder="E-mail Address" name="email" required <?php if (isset($_COOKIE['email'])) {
																																							echo 'value=' . base64_decode($_COOKIE['email']);
																																						}
																																						?>>

					<label for="NIN"><b>NIN</b></label>
					<input class="tms-input tms-border tms-margin-bottom form-control" type="text" placeholder="NIN" name="NIN" required <?php if (isset($_COOKIE['nin'])) {
																																				echo 'value=' . base64_decode($_COOKIE['nin']);
																																			}
																																			?>>

					<label for="user"><b>Username</b></label>
					<input class="tms-input tms-border tms-margin-bottom form-control" type="text" placeholder="Enter Username" name="user" required <?php if (isset($_COOKIE['uname'])) {
																																							echo 'value=' . base64_decode($_COOKIE['uname']);
																																						}
																																						?>>
					Select account type:<br>
					<div class="check">
						<input type="checkbox" name="acc_man" />&nbsp;
						<label for="acc_man">
							<b>
								Manager
							</b>
						</label>
					</div>

					<div class="check">
						<input type="checkbox" name="acc_cash" />&nbsp;
						<label for="acc_cash">
							<b>
								Cashier
							</b>
						</label>
					</div>

					<div class="check">
						<input type="checkbox" name="acc_train" />&nbsp;
						<label for="acc_train">
							<b>
								Trainer
							</b>
						</label>
					</div>

					<div class="check">
						<input type="checkbox" name="acc_cli" />&nbsp;
						<label for="acc_cli">
							<b>
								Clientele
							</b>
						</label>
					</div>

					<button class="tms-button tms-block tms-green tms-section tms-padding" type="submit">Send for verification</button>

				</div>
			</div>
			<div class="tms-container tms-border-top tms-padding-16 tms-light-grey" style="background-color:#f1f1f1">
				<button type="button" class="tms-btn tms-red" onclick="document.getElementById('id02').style.display='none'">Cancel</button>
			</div>
		</form>
	</div>
</div>
<div class="tms-modal" id="id01" style="cursor:pointer; 
		<?php
		if (isset($_COOKIE['msg'])) { ?>
								display:block;<?php
										} ?>">
	<div class="tms-modal-content animate tms-card-4" style="max-width:600px; cursor:auto;">
		<form method="post" action="/actions/login.php" autocomplete="off" >
			<div class="tms-center"><br>
				<span onclick="document.getElementById('id01').style.display='none'" class="tms-button tms-hover-text-grey tms-container tms-display-topright tms-xxlarge" title="Close Modal">x</span>
				<img src="\../images/img_avatar2.png" alt="Avatar" class="avatar tms-margin-top">
				<?php
				if (isset($_COOKIE['msg'])) {
					echo '<br><br><span class="alert alert-danger">' . $_COOKIE['msg'] . '</span>';
				} ?>
			</div>

			<div class="tms-container">
				<div class="tms-section">
					<label for="user"><b>Email</b></label>
					<input class="tms-input tms-border tms-margin-bottom form-control" type="text" placeholder="Enter Email" name="user" required <?php if (isset($_COOKIE['user'])) {
																																						echo 'value=' . base64_decode($_COOKIE['user']);
																																					}
																																					?> autofocus>

					<label for="passwd"><b>Password</b></label>
					<input class="tms-input tms-border form-control" type="password" placeholder="Enter Password" name="passwd" <?php if (isset($_COOKIE['passwd']) && !empty($_COOKIE['passwd'])) {
																																	echo 'value=' . base64_decode($_COOKIE['passwd']);
																																}
																																?>>

					<button class="tms-button tms-block tms-green tms-section tms-padding" type="submit">Login</button>
					<label>
						<input type="checkbox" checked="checked" name="remember"> Remember me
					</label>
				</div>
			</div>

			<div class="tms-container tms-border-top tms-padding-16 tms-light-grey" style="background-color:#f1f1f1">
				<span class="tms-right tms-padding small"><a href="#">Forgot password?</a></span>
				<button type="button" class="tms-btn tms-red" onclick="document.getElementById('id01').style.display='none'">Cancel</button>

			</div>
		</form>
	</div>
</div>
<div class="tms-modal" id="id03" style="cursor:pointer"></div>