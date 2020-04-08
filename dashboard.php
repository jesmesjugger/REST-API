<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="res/css/template.css">
    <link rel="stylesheet" href="res/css/dash.css">
    
    <title>Rapid Portal</title>
</head>
<body>
        <div id="wrapper">
            <nav id="top-navbar" class="navbar navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Navbar</a>
                <a href="#" class=".logout-spn ml-auto mr-3" style="color:#fff;">LOGOUT</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".sidebar-collapse"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li>
                            <a href="index.html"><i class="fa fa-desktop "></i>Dashboard <span
                                    class="badge">Included</span></a>
                        </li>
                        <li>
                            <a href="ui.html"><i class="fa fa-table "></i>UI Elements <span
                                    class="badge">Included</span></a>
                        </li>
                        <li class="active-link">
                            <a href="blank.html"><i class="fa fa-edit "></i>Blank Page <span
                                    class="badge">Included</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-qrcode "></i>My Link One</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o"></i>My Link Two</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit "></i>My Link Three </a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table "></i>My Link Four</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit "></i>My Link Five </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>BLANK PAGE </h2>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="container table-container">
                        <h3>Inbound Transactions</h3>
                        <div id="inboundTableDiv">
                            <table id="inboundTable" class="table">
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
                        $api = "http://15.188.147.46/api/";
                        $endpoint = "get_all_inbound_transactions";
                        $url = $api.$endpoint;

                        $client = curl_init($url);
                        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
                        $response = curl_exec($client);
                        $result = json_decode($response);
                        $info_array = ($result->response);                        
                        
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
                            echo "<th>".$info_array[$i]->created_at."</th>";
                            echo "</tr>";
                        }
                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end table div -->
                </div><!-- /. ROW  -->
            </div><!-- /. PAGE INNER  -->
        </div><!-- /. PAGE WRAPPER  -->

        <div class="footer">
            <div class="row">
                <div class="col-lg-12">
                    &copy; 2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;"
                        target="_blank">www.binarytheme.com</a>
                </div>
            </div>
        </div><!-- /. WRAPPER  -->
</body>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="res/js/template.js"></script>
<script src="res/js/dash.js"></script>
</html>