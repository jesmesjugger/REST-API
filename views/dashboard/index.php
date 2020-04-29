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
    <link rel="stylesheet" href="../../res/vendors/DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../res/vendors/DataTables/Buttons-1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../../res/css/template.css">
    <link rel="stylesheet" href="../../res/css/dash.css">
    
    <title>Rapid Portal</title>
</head>
<body>
    <div id="wrapper">
        <nav id="top-navbar" class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="?"><img src="../../res/img/om_text_logo.png" alt="logo"></a>
            <a href="../profile/" class="user-profile ml-auto"><i class="fa fa-user-circle"></i></a>
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
                        <a href="?">Dashboard</a>
                    </li>
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
            <h3>Graph 1</h3>
                <div id="graph-1">
                </div>
        </div><!-- END PAGE WRAPPER  -->

    </div><!-- /. WRAPPER  -->




<script src="../../res/vendors/jquery/jquery-3.5.0.js"></script>
<script src="../../res/vendors/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../res/vendors/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
<script src="../../res/vendors/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
<script src="../../res/vendors/DataTables/Buttons-1.6.1/js/buttons.flash.min.js"></script>
<script src="../../res/vendors/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../../res/vendors/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../../res/vendors/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="../../res/vendors/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
<script src="../../res/vendors/DataTables/Buttons-1.6.1/js/buttons.print.min.js"></script>
<script src="../../res/vendors/d3/d3.min.js"></script>
<script src="../../res/js/dash.js"></script>

</body>
</html>