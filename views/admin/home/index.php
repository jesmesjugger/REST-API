<?php 
define("ROOT","../../../");
include(ROOT.'/include/api_auth.php');

if (!isAdmin()) {
	logout();
}

if (!isLoggedIn()) {
    header('location: ../../../');    
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
    <link rel="stylesheet" href="../../../res/vendors/DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../../res/vendors/DataTables/Buttons-1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../../../res/css/template.css">
    <link rel="stylesheet" href="../../../res/css/dash.css">
    
    <title>Rapid Portal</title>
</head>
<body>
    <div id="wrapper">
        <nav id="top-navbar" class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="?"><img src="../../../res/img/om_text_logo.png" alt="logo"></a>
            <a href="../../profile/" class="user-profile ml-auto"><i class="fa fa-user-circle"></i></a>
            <a href="index.php?logout_btn=true" id="logout_btn" class="logout-spn ml-3 mr-3">LOGOUT</a>
            <button id="navToggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target=".sidebar-collapse"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav><!-- END NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="active-link">
                        <a href="?">Home</a>
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
            <h3>Create User</h3>
            <hr>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" id="user_type" required>
                        <option value="1">User</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label>Confirm password</label>
                    <input type="password" class="form-control" name="confirmPass" required>
                </div>
                <button type="submit" class="btn btn-outline-success" name="register_btn"> + Create user</button>
            </form>
        </div><!-- END PAGE WRAPPER  -->

        <!-- <div class="footer">
            <div class="row">
                    <div class="col-lg-12">
                        &copy; 2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;"
                            target="_blank">www.binarytheme.com</a>
                    </div>
                </div>
        </div> -->
    </div><!-- /. WRAPPER  -->
</body>

<script src="../../../res/vendors/jquery/jquery-3.4.1.js"></script>
<script src="../../../res/vendors/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../../res/js/dash.js"></script>
</html>