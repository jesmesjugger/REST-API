<?php include('include/api_auth.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500&family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="res/vendors/bootstrap-4.0.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="res/css/login.css">
	<title>OM Portal</title>
</head>
<body>
	<div class="container-fluid">
		<div class="logo-overlay">
			<img src="res/img/om_logo.png" class="brand-logo" alt="logo">
		</div>
		<div class="card mx-auto my-5">
			<h5 class="card-header text-left">Login</h5>
			<div class="card-body">
			
				<form action="index.php" method="POST">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>

					<button type="submit" class="btn btn-outline-success form_btn" name="login_btn">Login</button>
				</form>
				<?php echo display_error(); ?>
			</div>
		</div>
	</div>
</body>

<script src="res/vendors/jquery/jquery-3.4.1.js"></script>
<script src="res/vendors/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
</html>