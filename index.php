<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Rapid Portal</title>
</head>
<body>
    <div class="container-fluid">
    <div>Inbound Transactions</div>
        <?php
            $api = "http://15.188.147.46/api/";
            $endpoint = "get_all_inbound_transactions";
            $url = $api.$endpoint;

            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);
            $result = json_decode($response);
            $info_array = ($result->response);


            echo "
                <div class=\"container-fluid\">
                <table class=\"table\">
                <thead>
                    <tr class=\"thead-dark\">
                    <th scope=\"col\">#</th>
                    <th scope=\"col\">Transaction Type</th>
                    <th scope=\"col\">ID Number Type</th>
                    <th scope=\"col\">Customer Name</th>
                    <th scope=\"col\">Mobile Number</th>
                    <th scope=\"col\">Bank Account Name</th>
                    <th scope=\"col\">Bank Account No</th>
                    <th scope=\"col\">Bank Account Type</th>
                    <th scope=\"col\">Insurance Policy No</th>
                    <th scope=\"col\">Withdrawal Type</th>
                    <th scope=\"col\">Amount</th>
                    <th scope=\"col\">Fund Type</th>
                    <th scope=\"col\">Channel</th>
                    <th scope=\"col\">Accepted T&C</th>
                    <th scope=\"col\">Created at</th>
                </tr>
            </thead>
            <tbody>
                ";
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
                echo "<th>".$info_array[$i]->channel."</th>";
                echo "<th>".$info_array[$i]->requester_terms_conditions."</th>";
                echo "<th>".$info_array[$i]->created_at."</th>";
                echo "</tr>";
            }
            echo 
            "
                </tbody>
                </table>
            </div>
            "
    ?>
    </div>
</body>




<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src=""></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</html>