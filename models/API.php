<?php
class API{
    private static $api = "http://18.209.60.131/api/";

    public static function getCreateApi(){
        return API::$api.'create';
    }

    public static function getLoginApi(){
        return API::$api.'login';
    }

    public static function getRequestURL($username,$password,$payload){
        return API::$api."request?username=\"$username\"&pass=\"$password\"&payload=\"$payload\"";
    }
}