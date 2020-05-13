<?php
function error($state,$msg){
    $response = array("success"=>$state,"message"=>$msg);
    return json_encode($response);
}

$id = $_POST["field"];

echo json_encode($id);
?>