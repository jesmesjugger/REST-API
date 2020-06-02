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
        <nav id="top-navbar" class="navbar navbar-dark bg-dark" aria-label="top-navbar">
        <?php if($_SESSION["role"]=="1"): ?>
                <a class="navbar-brand" href="../dashboard/">Old <strong>Mutual</strong></a>
            <?php elseif($_SESSION["role"]=="2"): ?>
                <a class="navbar-brand" href="../admin/home/">Old <strong>Mutual</strong></a>
            <?php endif; ?>
            <div class="spacer"></div>
            <div class="dropdown mr-1">
                <a class="nav-link dropdown-toggle py-0" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['name'];?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../profile/"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>
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
                        <a href="#">Inbound Transactions</a>
                    </li>
                </ul>
            </div>
        </nav><!-- END NAV SIDE  -->

        <div id="page-wrapper">
            <div class="card py-2 px-3">
                <h4><strong>Inbound Transactions</strong></h4>
                <div class="table-responsive">
                    <table id="transactionTable" class="table data-table">
                        <thead>
                            <tr class="thead-light">
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
                                $td = "td";                       
                                
                                foreach($info_array as $transaction){
                                    echo "<tr>";
                                    echo "<$td>".$transaction->id."</$td>";
                                    echo "<$td>".$transaction->transaction_type_description."</$td>";
                                    echo "<$td>".$transaction->requester_id_number."</$td>";
                                    echo "<$td>".$transaction->requester_customer_name."</$td>";
                                    echo "<$td>".$transaction->requester_mobile_number."</$td>";
                                    echo "<$td>".$transaction->bank_acount_name."</$td>";
                                    echo "<$td>".$transaction->bank_acount_number."</$td>";
                                    echo "<$td>".$transaction->bank_acount_type."</$td>";
                                    echo "<$td>".$transaction->insurance_policy_number."</$td>";
                                    echo "<$td>".$transaction->withdrawal_type."</$td>";
                                    echo "<$td>".$transaction->withdrawal_amount."</$td>";
                                    echo "<$td>".$transaction->withdrawal_fund_type."</$td>";
                                    echo "<$td>".$transaction->deceased_id_number."</$td>";
                                    echo "<$td>".$transaction->channel."</$td>";
                                    echo "<$td>".$transaction->requester_terms_conditions."</$td>";
                                    echo "<$td>".date('d M, Y',strtotime($transaction->created_at))."</$td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- END PAGE WRAPPER  -->

    </div><!-- /. WRAPPER  -->
</body>

<script src="../../res/vendors/jquery/jquery-3.4.1.js"></script>
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
<script src="../../res/js/dataTables.js"></script>
<script src="../../res/js/dash.js"></script>
</html>