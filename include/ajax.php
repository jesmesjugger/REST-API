<?php
include_once("admin_functions.php");

if($_POST["deleteID"]){
    $id = $_POST["deleteID"];
    deleteUser($id);
}