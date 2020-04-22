<?php
include_once(__DIR__."/../models/API.php");

function getResultObject($payload){
   $url = API::getRequestURL($_SESSION['user'], $_SESSION['pass'], $payload);

   $client = curl_init($url);
   curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
   $response = curl_exec($client);
   $result = json_decode($response);
   curl_close($client);
   return $result;
 }