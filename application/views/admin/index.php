<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/style-admin.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/font-awesome/css/font-awesome.min.css" />

		<link rel="shortcut icon" href="<?=base_url()?>image/fav.png">
	</head>
	<body>
	<!--Container-->
	<div class="container">
		<div class="col-md-4 col-md-offset-4 custom-form">
			<div class="login-img">
				<h1 style="font-family: Pacifico;">Tour N Travel</h1>
			</div>

			<h4 align="center">Admin Login Here!</h4>
			<hr class="uline">

			<?php echo form_open("Admin/login"); ?>
			<div class="form-group">
				<div class="input-group">
					<input type="text" name="username" class="form-control form1" placeholder="Username">
					<span class="input-group-addon igd"><i class="fa fa-user"></i></span>
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<input type="password" name="password" class="form-control form1" placeholder="Password">
					<span class="input-group-addon igd"><i class="fa fa-lock"></i></span>
				</div>
			</div>

			<div class="form-group">
				<input type="submit" class="btn-block btn-login" name="submit" value="LOGIN" />
			</div>
			</form>
		</div>
	</div>
</body>
</html>