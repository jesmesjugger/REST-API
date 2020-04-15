<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500&family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="res/css/login.css">
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<div class="container-fluid">
		<div class="logo-overlay">
			<img src="res/img/om_logo.png" class="brand-logo" alt="logo">
		</div>
		<div class="card mx-auto my-5">
			<h2 class="card-header text-center">OM Portal</h2>
			<div class="card-body">
				<form action="index.php" method="post">
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


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>