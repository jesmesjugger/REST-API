<?php

function getResultObject($payload){
   $username = $_SESSION['user'];
   $password = $_SESSION['pass'];
   $url = "http://18.185.59.70/api/request?username=\"$username\"&pass=\"$password\"&payload=\"$payload\"";

   $client = curl_init($url);
   curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
   $response = curl_exec($client);
   $result = json_decode($response);
   curl_close($client);
   return $result;
 }