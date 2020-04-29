<?php 
include('../../include/api_auth.php');
include('../../include/api_call.php');

if (!isLoggedIn()) {
    header('location: ../../');    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../res/vendors/bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../res/vendors/fontawesome-5.13.0/css/all.css">
    <link rel="stylesheet" href="../../res/css/template.css">
    <link rel="stylesheet" href="../../res/css/dash.css">
    
    <title>Rapid Portal</title>
</head>
<body>
    <div id="wrapper">
        <nav id="top-navbar" class="navbar navbar-dark bg-dark">
        <?php if($_SESSION["role"]=="1"): ?>
                <a class="navbar-brand" href="../dashboard/"><img src="../../res/img/om_text_logo.png" alt="logo"></a>
            <?php elseif($_SESSION["role"]=="2"): ?>
                <a class="navbar-brand" href="../admin/home/"><img src="../../res/img/om_text_logo.png" alt="logo"></a>
            <?php endif; ?> 
            <a href="?" class="user-profile ml-auto"><i class="fa fa-user-circle"></i></a>
            <a href="index.php?logout_btn=true" id="logout_btn" class="logout-spn ml-3 mr-3">LOGOUT</a>
            <button id="navToggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target=".sidebar-collapse"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav><!-- END NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <?php if($_SESSION["role"]=="1"): ?>
                    <li>
                        <a href="../dashboard/">Dashboard</a>
                    </li>
                <?php elseif($_SESSION["role"]=="2"): ?>
                    <li>
                        <a href="../admin/home/">Home</a>
                    </li>
                <?php endif; ?>  
                    <li>
                        <a href="../inbound-inquiry/">Inbound Inquiry</a>
                    </li>
                    <li>
                        <a href="../inbound-transaction/">Inbound Transactions</a>
                    </li>
                </ul>
            </div>
        </nav><!-- END NAV SIDE  -->

        <div id="page-wrapper">
            <div id="profile-section" class="text-center">
                <p><i id="profile-section-icon" class="fa fa-user-circle"></i></p>
                <h5><b><?php echo $_SESSION['name']?></b></h5>
            </div>

            <form action="#" method="POST">
                <div class="form-group">
                    <label for="oldpassword">Current Password</label>
                    <input type="password" name="oldPassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="newpassword">New Password</label>
                    <input type="password" name="newPassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirm New Password</label>
                    <input type="password" name="confirmPassword" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mx-auto" style="display:block;">Update</button>
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

<script src="../../res/vendors/jquery/jquery-3.5.0.js"></script>
<script src="../../res/vendors/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="../../res/js/dash.js"></script>
</html>