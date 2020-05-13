<?php
include_once(__DIR__."/../models/API.php");

function getUsers(){
    if($_SESSION['role']==2){
        $url = API::admin_getUsers($_SESSION['user'],$_SESSION['pass']);
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result = json_decode($response);
        curl_close($client);
        return $result;
    }
    else{
        die("Unauthorized Access");
    }
}

// function error($state,$msg){
//     $response = array("success"=>$state,"message"=>$msg);
//     return json_encode($response);
// }
// $id = $_POST["field"];
// echo json_encode($id);

?>