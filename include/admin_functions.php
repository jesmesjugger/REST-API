<?php
include_once(__DIR__."/../models/API.php");
include_once(__DIR__."/../models/User.php");

$path = explode("/",$_SERVER['REQUEST_URI']);
$user = new User("","","","");

function getAllUsers(){
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

if($path[count($path)-2] == "update"){
    if($_SESSION['role']==2){
        $url = API::admin_getSingleUser($_GET['id'], $_SESSION['user'],$_SESSION['pass']);
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result = json_decode($response);
        $reqData = $result->response[0];
        curl_close($client);

        if($result->status_message == "OK"){
            $user->setName($reqData->name);
            $user->setUsername($reqData->username);
            $user->setEmail($reqData->email);
            $user->setRole($reqData->role);
        }
        
    }
    else{
        die("Unauthorized Access");
    }
}



?>