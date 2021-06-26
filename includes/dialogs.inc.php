<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/dialogs.inc.css">
<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/style.css">
<style>
	.ty-ajax-overlay {
		position: absolute;
		top: 0px;
		bottom: 0px;
		left: 0px;
		right: 0px;
		z-index: 10000;
		display: none;
        background-color: #1c1818ab;
	}

	.ty-ajax-loading-box {
		position: fixed;
		top: 50%;
		right: 50%;
		left: 50%;
		z-index: 100001;
		display: none;
		overflow: visible;
		margin-top: -26px;
		margin-left: -26px;
		padding: 0px;
		min-height: 52px;
		width: 52px;
		background: url('/images/icons/ajax_loadereaef.gif?1493401512') no-repeat 10px 10px #0d0d0d;
		opacity: 0.8;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
</style>
<div class="tms-modal" id="id01" style="cursor:pointer; 
		<?php
		session_start();
		if (isset($_COOKIE['msg'])) { ?>
								display:block;<?php
											} ?>">
	<div class="tms-modal-content animate tms-card-4" style="max-width:600px; cursor:auto;">
		<form method="post" action="/actions/login.php" autocomplete="off">
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
<div class="tms-modal" id="id03" style="cursor:pointer">
	<div class="tms-modal-content animate tms-card-4" style="max-width:600px; cursor:auto;">
		<form id="#msform" class="img_upload" method="post" autocomplete="off" enctype="multipart/form-data" onsubmit="uploadData(this)">
			<div class="tms-center"><br>
				<h2>Upload Image</h2>
				<small>The image for upload must be less than 5MB in size!</small>
				<?php
				if (isset($_COOKIE['info'])) {
					echo '<br><br><span class="alert alert-danger">' . $_COOKIE['info'] . '</span>';
				} ?>
				<span onclick="document.getElementById('id03').style.display='none'" class="tms-button tms-hover-text-grey tms-container tms-display-topright tms-xxlarge" title="Close Modal">x</span>
			</div>
			<div class="tms-container">
				<div class="tms-section">
					<div class="alert alert-danger tms-center disabled error"></div>
					<label for="img_upload_area"><b>Image upload box below:&nbsp;</b></label>
					<div class="tms-border tms-margin-bottom form-control" style='width:100%; height:max-content; padding: 0px !important'>
						<input type="file" accept="image/*" name="file" id="file" onchange="showMyImage(this)">
						<div class="upload-area" id="uploadfile">
							<h1>Drag and Drop image here<br />Or<br />Click to select file</h1>
						</div>
					</div>

					<button class="tms-button tms-block tms-green tms-section tms-padding" type="submit" id="up2server" onclick="clear()" style="font-size:15px; display: flex; justify-content: center">
						<span class="before enabled">Upload Image</span>
						<span class="uploading disabled" style="height: 22px"><iframe src="../includes/loader.html" frameborder="0" width="18px" height="18px" style></iframe> &nbsp;&nbsp; Uploading image</span>
					</button>
					<button class="tms-button tms-block tms-green tms-section tms-padding tms-red" type="reset" onclick="clear()" id="action2clear" style="display:none" title="Reset and Change image">Reset</button>
				</div>
			</div>
			<div class="tms-container tms-border-top tms-padding-16 tms-light-grey" style="background-color:#f1f1f1">
				<button id="cancel" type="button" class="tms-btn tms-red" onclick="document.getElementById('id03').style.display='none'">Cancel</button>
			</div>
		</form>
	</div>
</div>
<div id="ajax_overlay" class="ty-ajax-overlay"></div>
<div id="ajax_loading_box" class="ty-ajax-loading-box"></div>
<script>
	window.id = "<?php echo $_SESSION['id']; ?>"
	$form = $('#msform');
	var droppedFiles = false;
	$(() => {
		$('html').on("dragover", (e) => {
			e.preventDefault()
			e.stopPropagation()
			$('h1').text("Drag here")
		})
		$('html').on('drop', (e) => {
			e.preventDefault()
			e.stopPropagation()
			$('h1').text("Drag and Drop image here Or Click to select file")
		})
		$('.upload-area').on('dragenter', (e) => {
			e.stopPropagation()
			e.preventDefault()
			$('h1').text('Drop')
		})
		$('.upload-area').on('dragover', (e) => {
			e.stopPropagation()
			e.preventDefault()
			$('h1').text('Drop')
		})
		$('.upload-area').on('drop', (e) => {
			e.stopPropagation()
			e.preventDefault()
			droppedFiles = e.originalEvent.dataTransfer.files
			filer = droppedFiles[0]
			dat = {}
			dat.name = filer['name']
			dat.size = filer['size']
			$('#uploadfile h1').remove()
			$('#uploadfile').append('<div id="thumbnail_1" class="thumbnail"></div>')
			$('#thumbnail_1').append('<img id="img2up" src="" width="45%">')
			$("#thumbnail_1").append('<span class="size"></span>')
			if (window.dp_set == true) {
				var img = document.getElementById("addten_img")
				img.files = droppedFiles
			}
			var img = document.getElementById("file")
			img.files = droppedFiles
			addThumbnail(filer, dat)
			$('h1').text('Upload')
		})
		$('#up2server').on('click', (e) => {
			e.preventDefault()
			if ($('.img_upload').hasClass('is-uploading')) return false
			$('.img_upload').removeClass('is-error')
			$('.error').text('')
			$('.error').removeClass('enabled')
			$('.error').addClass('disabled')
			$('.before').removeClass('enabled')
			$('.before').addClass('disabled')
			$('.uploading').removeClass('disabled')
			$('.uploading').addClass('enabled')
			$('.img_upload').addClass('is-uploading')
			let ajaxData = new FormData($('.img_upload').get(0));
			var $input = $('.img_upload').find('input[type="file"]');
			$.each(droppedFiles, function(i, file) {
				ajaxData.append('files', file)
			});
			ajaxData.append('user_id', window.id);
			if (window.dp_set != true)
				$.ajax({
					url: "/includes/cli/image_upload.php",
					type: 'post',
					data: ajaxData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					complete: () => {
						$('.before').removeClass('disabled')
						$('.before').addClass('enabled')
						$('.uploading').removeClass('enabled')
						$('.uploading').addClass('disabled')
						$('.img_upload').removeClass('is-uploading');
					},
					success: (data) => {
						$('.img_upload').addClass(data.success == true ? 'is-success' : 'is-error');
						if (!data.success) {
							$('.error').text(data.error)
							$('.error').removeClass('disabled')
							$('.error').addClass('enabled')
						} else {
							LD()
							document.getElementById('id03').style.display = 'none';
						}
					},
					error: (e) => {
						$('.img_upload').addClass('is-error')
						$('.before').removeClass('disabled')
						$('.before').addClass('enabled')
						$('.uploading').removeClass('enabled')
						$('.uploading').addClass('disabled')
						log(e.responseText)
						alert("Oops something has gone wrong!")
					}
				})
			else {
				window.dp_set = file
				$('.before').removeClass('disabled')
				$('.before').addClass('enabled')
				$('.uploading').removeClass('enabled')
				$('.uploading').addClass('disabled')
				$('.img_upload').removeClass('is-uploading');
				$('#cancel').click()
			}
		});
		$('#uploadfile').on('click', _ => {
			$('#file').click()
		})

		createThumbDiv = _ => {
			$('#uploadfile h1').remove()
			$('#uploadfile').append('<div id="thumbnail_1" class="thumbnail"></div>')
			$('#thumbnail_1').append('<img id="thumbnil" style="width:45%"  src="" alt="image"/>')
			$("#thumbnail_1").append('<span id="size" class="size">Size</span>')
		}

		showMyImage = (fileInput) => {
			var files = fileInput.files
			droppedFiles = files
			if (window.dp_set == true) {
				var img = document.getElementById("addten_img")
				img.files = droppedFiles
			}
			createThumbDiv()
			for (var i = 0; i < files.length; i++) {
				filer = files[i];
				var imageType = /image.*/;
				if (!filer.type.match(imageType)) {
					continue;
				}
				if (window.dp_set === true) {
					var img = $('.dashb-ten-img.empty').find('img')[0]
					img.file = filer;
					var reader = new FileReader();
					reader.onload = ((aImg) => {
						return function(e) {
							aImg.src = e.target.result;
						};
					})(img);
					reader.readAsDataURL(filer);
					$('.upload_btn').text('Change')
						.css({
							color: 'grey',
							backgroundColor: 'white'
						})
				}
				var img = document.getElementById("thumbnil");
				img.file = filer;
				var reader = new FileReader();
				reader.onload = ((aImg) => {
					return function(e) {
						aImg.src = e.target.result;
					};
				})(img);
				reader.readAsDataURL(filer);
				var size = document.getElementById('size')
				size.innerHTML = convertSize(filer['size'])

			}
			$('#action2clear').css({
				display: 'block'
			})
		}

		addThumbnail = (files, data) => {
			if (window.dp_set == true) {
				var len = $('.dashb-ten-img.empty').find('img').length
				var num = Number(len)
				num = num + 1
				var name = data.name
				var size = convertSize(data.size)
				var reader = new FileReader()
				var img = $('.dashb-ten-img.empty').find('img')[0]
				img.file = files
				var reader = new FileReader();
				reader.onload = ((aImg) => {
					return (a) => {
						aImg.src = a.target.result
					}
				})(img)
				reader.readAsDataURL(files)
			} else {
				var len = $('#uploadfile div.thumbnail').length
				var num = Number(len)
				num = num + 1
				var name = data.name
				var size = convertSize(data.size)
				var reader = new FileReader()
				var img = document.getElementById("img2up")
				img.file = files
				var reader = new FileReader();
				reader.onload = ((aImg) => {
					return (a) => {
						aImg.src = a.target.result
					}
				})(img)
				reader.readAsDataURL(files)
				var size = document.getElementsByClassName('size')[0]
				size.innerHTML = convertSize(files['size'])
				$('#action2clear').css({
					display: 'block'
				})
			}
		}

		convertSize = (size) => {
			var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
			if (size == 0) return '0 Bytes'
			var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)))
			return Math.round(size / Math.pow(1024, i), 2) + 1 + ' ' + sizes[i];
		}
		$('#action2clear').on('click', _ => clear());
		$('#cancel').on('click', _ => clear());

		function clear() {
			$('#thumbnail_1').remove()
			$('#uploadfile').append('<h1>Drag and Drop image here<br />Or<br />Click to select file</h1>')
			$('#action2clear').css({
				display: 'none'
			})
		}
	})
</script>
<style>
	.upload-area {
		width: 100%;
		height: 100%;
		border: 2px solid lightgray;
		border-radius: 3px;
		text-align: center;
		overflow: hidden;
	}

	.disabled {
		display: none !important;
	}

	.enabled {
		display: block !important;
	}

	#msform.is-error .form-control {
		border: 2px solid red !important;
	}

	.upload-area:hover {
		cursor: pointer;
	}

	.upload-area h1 {
		text-align: center;
		font-weight: normal;
		font-family: sans-serif;
		line-height: 50px;
		color: darkslategray;
	}

	#file {
		display: none;
	}

	/* Thumbnail */
	.thumbnail {
		width: 100%;
		height: max-content;
		padding: 2px;
		border: 2px none lightgray;
		border-radius: 3px;
		align-content: center;
		-webkit-box-align: center;
		/* float: left; */
	}

	.size {
		font-size: 12px;
	}
</style>