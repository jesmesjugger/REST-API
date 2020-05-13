<?php 
include('../../../include/api_auth.php');
include('../../../include/admin_functions.php');

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
        <nav id="top-navbar" class="navbar navbar-dark bg-dark" aria-label="top-navbar">
            <?php if($_SESSION["role"]=="1"): ?>
                <a class="navbar-brand" href="../dashboard/"><img src="../../../res/img/om_text_logo.png" alt="logo"></a>
            <?php elseif($_SESSION["role"]=="2"): ?>
                <a class="navbar-brand" href="../home/"><img src="../../../res/img/om_text_logo.png" alt="logo"></a>
            <?php endif; ?>
            <a href="../../profile/" class="user-profile ml-auto"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
            <a href="index.php?logout_btn=true" id="logout_btn" class="logout-spn ml-3 mr-3">LOGOUT</a>
            <button id="navToggler" class="navbar-toggler" type="button" data-toggle="collapse"
                data-target=".sidebar-collapse" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav><!-- END NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation" aria-label="sidebar">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="../home">Home</a>
                    </li>
                    <li class="active-link">
                        <a href="?">Users</a>
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
            <div class="table-container">
                <h3><strong>Users</strong></h3>
                <div class="tableDiv">
                    <table id="usersTable" class="table cell-border table-hover data-table">
                        <thead>
                            <tr class="thead-dark">
                                <th scope="col">id</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = getUsers();
                                $info_array = ($result->RequestData);
                                $th = "th";

                                foreach($info_array as $user){
                                    echo "<tr>";
                                    echo "<$th>".$user->id."</$th>";
                                    echo "<$th>".$user->username."</$th>";
                                    echo "<$th>".$user->email."</$th>";
                                    echo "<$th>".$user->name."</$th>";
                                    echo $user->role==1? "<$th>User</$th>" : "<$th>Admin</$th>";
                                    echo "<$th>".date('d M, Y',strtotime($user->created_at))."</$th>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- end #tableDiv w/ inquiry -->
            </div> <!-- end .Table-Container div -->
        </div><!-- END PAGE WRAPPER  -->

    </div><!-- /. WRAPPER  -->
</body>

<script src="../../../res/vendors/jquery/jquery-3.4.1.js"></script>
<script src="../../../res/vendors/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../../res/vendors/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
<script src="../../../res/vendors/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
<script src="../../../res/vendors/DataTables/Buttons-1.6.1/js/buttons.flash.min.js"></script>
<script src="../../../res/vendors/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../../../res/vendors/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../../../res/vendors/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="../../../res/vendors/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
<script src="../../../res/vendors/DataTables/Buttons-1.6.1/js/buttons.print.min.js"></script>
<script src="../../../res/vendors/d3/d3.min.js"></script>
<script src="../../../res/js/dash.js"></script>
</html>