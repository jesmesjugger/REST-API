<?php
include_once(__DIR__."/../models/API.php");
include_once(__DIR__."/../models/User.php");

if(!isset($_SESSION)){ session_start(); }
$username = $_SESSION['user'];
$password = $_SESSION['pass'];

$transaction_link = API::getRequestURL($username,$password,"transaction");
$inquiry_link = API::getRequestURL($username,$password,"inquiry");

$data = [
    "trans_link"=>$transaction_link,
    "inquiry_link"=>$inquiry_link
];

echo json_encode($data);
?>