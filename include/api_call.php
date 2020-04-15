<?php

function getResultObject($payload){
   $username = "tsmith";
   $password = "1234";
   $url = "http://3.123.17.25/api/request?username=\"$username\"&pass=\"$password\"&payload=\"$payload\"";

   $client = curl_init($url);
   curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
   $response = curl_exec($client);
   $result = json_decode($response);
   curl_close($client);
   return $result;
 }