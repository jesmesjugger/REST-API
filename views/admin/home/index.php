<?php 
include('../../../include/api_auth.php');
include('../../../include/admin_functions.php');

if (!isAdmin()) {logout();}
if (!isLoggedIn()) {header('location: ../../../');    }
removeSelectedUser();
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
            <div class="spacer"></div>
            <div class="dropdown mr-1">
                <a class="nav-link dropdown-toggle py-0" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['name'];?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../../profile/"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>
                    <a class="dropdown-item" href="index.php?logout_btn=true"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                </div>
            </div>
            <button id="navToggler" class="navbar-toggler hidden" type="button" data-toggle="collapse"
                data-target=".sidebar-collapse" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav><!-- END NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation" aria-label="sidebar">
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
            <div class="table-container">
                <a id="newUserBtn" href="../users/create.php" class="btn btn-outline-success mb-2">Create new user</a>
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
                                <th scope="col">Updated at</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = getAllUsers();
                                $info_array = ($result->RequestData);
                                $td = "td";

                                foreach($info_array as $user){
                                    $id=$user->id;
                                    $create_date = date('d-m-Y',strtotime($user->created_at));
                                    $create_time = date('H:i:s',strtotime($user->created_at));
                                    $update_date = date('d-m-Y',strtotime($user->updated_at));
                                    $update_time = date('H:i:s',strtotime($user->updated_at));
                                    echo "<tr>";
                                    echo "<$td class=\"id\">".$id."</$td>";
                                    echo "<$td>".$user->username."</$td>";
                                    echo "<$td>".$user->email."</$td>";
                                    echo "<$td>".$user->name."</$td>";
                                    echo $user->role==1? "<$td>User</$td>" : "<$td>Admin</$td>";
                                    echo "<$td>$create_date $create_time</$td>";
                                    echo "<$td>$update_date $update_time</$td>";
                                    echo "<$td>".'<a href="../users/update.php?id='.$id.'"><i class="fas fa-user-edit"></i></a> <a href="#"><i class="fas fa-trash-alt"></i></a>'."</$td>";
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
<script src="../../../res/js/dataTables.js"></script>
<script src="../../../res/js/dash.js"></script>
</html>