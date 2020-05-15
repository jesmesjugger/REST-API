<?php 
define("ROOT","../../../../");
include(ROOT.'/include/api_auth.php');
include(ROOT.'/include/admin_functions.php');

if (!isAdmin()) {
	logout();
}

if (!isLoggedIn()) {
    header('location:'.ROOT);    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../../../res/vendors/bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../res/vendors/fontawesome-5.13.0/css/all.css">
    <link rel="stylesheet" href="../../../../res/css/template.css">
    <link rel="stylesheet" href="../../../../res/css/dash.css">
    
    <title>Rapid Portal</title>
</head>
<body>
    <div id="wrapper">
        <nav id="top-navbar" class="navbar navbar-dark bg-dark" aria-label="top-navbar">
            <a class="navbar-brand" href="?"><img src="../../../../res/img/om_text_logo.png" alt="logo"></a>
            <a href="../../../profile/" class="user-profile ml-auto"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
            <a href="index.php?logout_btn=true" id="logout_btn" class="logout-spn ml-3 mr-3">LOGOUT</a>
            <button id="navToggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target=".sidebar-collapse"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav><!-- END NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation" aria-label="sidebar">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="../../home">Home</a>
                    </li>
                    <li>
                        <a href="../../../inbound-inquiry/">Inbound Inquiry</a>
                    </li>
                    <li>
                        <a href="../../../inbound-transaction/">Inbound Transactions</a>
                    </li>
                </ul>
            </div>
        </nav><!-- END NAV SIDE  -->

        <div id="page-wrapper">
            <?php echo display_error(); ?>
            <?php echo display_success(); ?>
            <h4>Update User</h4>
            <hr>
            <div class="row">
                <div class="col-md-3 py-2" >
                    <div class="card">
                        <ul class="list-group list-group-flush" >
                            <li id="detailsPill" class="list-group-item active">Account details</li>
                            <li id="rolesPill" class="list-group-item">Roles</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 py-3" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 8px">
                    <div class="card" style="border:none;">
                        <div id="detailsForm" class="form-content-div">
                            <form action="" method="POST">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Full names</label>
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
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success" name="update_details_btn">Save</button>
                            </form>
                        </div>
                        <div id="rolesForm" class="form-content-div hidden">
                            <form action="">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control" id="user_type" required>
                                        <option value="1">User</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-outline-success" name="update_role_btn">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div><!-- END PAGE WRAPPER  -->

    </div><!-- /. WRAPPER  -->
</body>

<script src="../../../../res/vendors/jquery/jquery-3.4.1.js"></script>
<script src="../../../../res/vendors/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../../../res/js/dash.js"></script>
</html>