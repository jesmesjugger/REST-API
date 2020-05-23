<?php
include_once(__DIR__."/../models/API.php");
include_once("admin_functions.php");

if(!isset($_SESSION)){ session_start(); }
$username = $_SESSION['user'];
$pass = $_SESSION['pass'];

if(isset($_GET["key"])){
    if($_GET["key"] == "d3"){
        $transaction_link = API::getRequestURL($username,$pass,"transaction");
        $inquiry_link = API::getRequestURL($username,$pass,"inquiry");

        $data = ["trans_link"=>$transaction_link, "inquiry_link"=>$inquiry_link ];
        echo json_encode($data);
    }
}

if(isset($_POST["deleteID"])){
    $id = $_POST["deleteID"];
    deleteUser($id, $username, $pass);
}