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
        <?php if($_SESSION["role"]=="1"): ?>
                <a class="navbar-brand" href="../dashboard/"><img src="../../res/img/om_text_logo.png" alt="logo"></a>
            <?php elseif($_SESSION["role"]=="2"): ?>
                <a class="navbar-brand" href="../admin/home/"><img src="../../res/img/om_text_logo.png" alt="logo"></a>
            <?php endif; ?> 
            <a href="../profile/" class="user-profile ml-auto"><i class="fa fa-user-circle"></i></a>
            <a href="index.php?logout_btn=true" id="logout_btn" class="logout-spn ml-3 mr-3">LOGOUT</a>
            <button id="navToggler" class="navbar-toggler" type="button" data-toggle="collapse"
                data-target=".sidebar-collapse" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
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
                    <li class="active-link">
                        <a href="?">Inbound Transactions</a>
                    </li>
                </ul>
            </div>
        </nav><!-- END NAV SIDE  -->

        <div id="page-wrapper">
            <div class="table-container">
                <h3><b>Inbound Transactions</b></h3>
                <div class="tableDiv">
                    <table id="inboundTable" class="table data-table">
                        <thead>
                            <tr class="thead-dark">
                                <th scope="col">#</th>
                                <th scope="col">Transaction Type</th>
                                <th scope="col">ID Number Type</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col">Bank Account Name</th>
                                <th scope="col">Bank Account No</th>
                                <th scope="col">Bank Account Type</th>
                                <th scope="col">Insurance Policy No</th>
                                <th scope="col">Withdrawal Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Fund Type</th>
                                <th scope="col">Deceased ID No</th>
                                <th scope="col">Channel</th>
                                <th scope="col">Accepted T&C</th>
                                <th scope="col">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = getResultObject("transaction");
                                $info_array = ($result->RequestData);                        
                                
                                for($i = 0; $i < count($info_array); $i++){
                                    echo "<tr>";
                                    echo "<th>".$info_array[$i]->id."</th>";
                                    echo "<th>".$info_array[$i]->transaction_type_description."</th>";
                                    echo "<th>".$info_array[$i]->requester_id_number."</th>";
                                    echo "<th>".$info_array[$i]->requester_customer_name."</th>";
                                    echo "<th>".$info_array[$i]->requester_mobile_number."</th>";
                                    echo "<th>".$info_array[$i]->bank_acount_name."</th>";
                                    echo "<th>".$info_array[$i]->bank_acount_number."</th>";
                                    echo "<th>".$info_array[$i]->bank_acount_type."</th>";
                                    echo "<th>".$info_array[$i]->insurance_policy_number."</th>";
                                    echo "<th>".$info_array[$i]->withdrawal_type."</th>";
                                    echo "<th>".$info_array[$i]->withdrawal_amount."</th>";
                                    echo "<th>".$info_array[$i]->withdrawal_fund_type."</th>";
                                    echo "<th>".$info_array[$i]->deceased_id_number."</th>";
                                    echo "<th>".$info_array[$i]->channel."</th>";
                                    echo "<th>".$info_array[$i]->requester_terms_conditions."</th>";
                                    echo "<th>".date('d M, Y',strtotime($info_array[$i]->created_at))."</th>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- end #tableDiv w/ claims -->
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