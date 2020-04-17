<?php 
include('../../include/functions.php');
include('../../include/api_call.php');

if (!isLoggedIn()) {
    header('location: ../../index.php');    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../res/css/template.css">
    <link rel="stylesheet" href="../../res/css/dash.css">
    
    <title>Rapid Portal</title>
</head>
<body>
    <div id="wrapper">
        <nav id="top-navbar" class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php"><img src="../../res/img/om_text_logo.png" alt="logo"></a>
            <a href="profile.php" class="user-profile ml-auto mr-3"><i class="fa fa-user-circle"></i></a>
            <form action="../../index.php" method="get">
                <button id="logout_btn" class=".logout-spn ml-auto mr-3" name="logout_btn">LOGOUT</a>
            </form>
            <button id="navToggler" class="navbar-toggler" type="button" data-toggle="collapse"
                data-target=".sidebar-collapse" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav><!-- END NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="../dashboard/">Dashboard</a>
                    </li>
                    <li class="active-link">
                        <a href="#">Inbound Inquiry</a>
                    </li>
                    <li>
                        <a href="../inbound-transaction/">Inbound Transactions</a>
                    </li>
                </ul>
            </div>
        </nav><!-- END NAV SIDE  -->

        <div id="page-wrapper">
            <div class="table-container">
                <h3><b>Inbound Inquiries</b></h3>
                <div class="tableDiv">
                    <table id="inquiryTable" class="table data-table">
                        <thead>
                            <tr class="thead-dark">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Inquiry Type</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Form ID</th>
                                <th scope="col">Status ID</th>
                                <th scope="col">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = getResultObject("inquiry");
                                $info_array = ($result->RequestData);                      
                                for($i = 0; $i < count($info_array); $i++){
                                    echo "<tr>";
                                    echo "<th>".$info_array[$i]->id."</th>";
                                    echo "<th>".$info_array[$i]->name."</th>";
                                    echo "<th>".$info_array[$i]->telephone_number."</th>";
                                    echo "<th>".$info_array[$i]->inquiry_type."</th>";
                                    echo "<th>".$info_array[$i]->product_name."</th>";
                                    echo "<th>".$info_array[$i]->form_id."</th>";
                                    echo "<th>".$info_array[$i]->status_id."</th>";
                                    echo "<th>".date('d M, Y',strtotime($info_array[$i]->created_at))."</th>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- end #tableDiv w/ inquiry -->
            </div> <!-- end .Table-Container div -->
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

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="../../res/js/dash.js"></script>
</html>