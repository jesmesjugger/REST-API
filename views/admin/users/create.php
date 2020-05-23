<?php 
define("ROOT","../../../");
include(ROOT.'/include/api_auth.php');

if (!isAdmin()) {
	logout();
}

if (!isLoggedIn()) {
    header('location: '.ROOT);    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../../res/vendors/bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../res/vendors/fontawesome-5.13.0/css/all.css">
    <link rel="stylesheet" href="../../../res/css/template.css">
    <link rel="stylesheet" href="../../../res/css/dash.css">
    
    <title>Rapid Portal</title>
</head>
<body>
    <div id="wrapper">
        <nav id="top-navbar" class="navbar navbar-dark bg-dark" aria-label="top-navbar">
            <a class="navbar-brand" href="?"><img src="../../../res/img/om_text_logo.png" alt="logo"></a>
            <div class="spacer"></div>
            <div class="dropdown mr-1">
                <a class="nav-link dropdown-toggle py-0" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['name'];?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../../profile/"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>
                    <a class="dropdown-item" href="create.php?logout_btn=true"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                </div>
            </div>
            <button id="navToggler" class="navbar-toggler hidden" type="button" data-toggle="collapse" data-target=".sidebar-collapse"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav><!-- END NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation" aria-label="sidebar">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="../home">Home</a>
                    </li>
                    <li>
                        <a href="../../inbound-inquiry/">Inbound Inquiry</a>
                    </li>
                    <li>
                        <a href="../../inbound-transaction/">Inbound Transactions</a>
                    </li>
                </ul>
            </div>
        </nav><!-- END NAV SIDE  -->

        <div id="page-wrapper">
            <?php echo display_error(); ?>
            <?php echo display_success(); ?>
            <h4>Create User</h4>
            <hr>
            <form action="create.php" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role" class="form-control" id="user_type" required>
                            <option value="1">User</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="confirmPass" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success mx-auto" name="register_btn" style="display:block;"> + Create user</button>
            </form>
        </div><!-- END PAGE WRAPPER  -->

    </div><!-- /. WRAPPER  -->
</body>

<script src="../../../res/vendors/jquery/jquery-3.4.1.js"></script>
<script src="../../../res/vendors/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../../res/js/dash.js"></script>
</html>