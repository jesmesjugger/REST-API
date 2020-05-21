<?php
class API{
    private static $api = "http://35.174.107.26/api/";
    private static $headers = [
        'X-Apple-Tz: 0',
        'X-Apple-Store-Front: 143444,12',
        'Accept: application/json',
        'Accept-Encoding: gzip, deflate',
        'Accept-Language: en-US,en;q=0.5',
        'Cache-Control: no-cache',
        'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'X-MicrosoftAjax: Delta=true'
    ];

    public static function getHeaders(){
        return self::$headers;
    }

    public static function getCreateApi(){
        return self::$api.'create';
    }

    public static function getLoginApi(){
        return self::$api.'login';
    }

    public static function getRequestURL($username,$password,$payload){
        return self::$api."request?username=\"$username\"&pass=\"$password\"&payload=\"$payload\"";
    }

    public static function getUpdatePasswordApi($role,$username,$password){
        return self::$api."update/".$role."?username=\"$username\"&pass=\"$password\"";
    }

    public static function admin_getUsers($username,$password){
        return self::$api."users?username=\"$username\"&pass=\"$password\"";
    }

    public static function admin_getSingleUser($id,$username,$password){
        return self::$api."user/$id?username=\"$username\"&pass=\"$password\"";
    }

    public static function admin_getUpdateUser($id,$username,$password){
        return self::$api."update_user/$id?username=\"$username\"&pass=\"$password\"";
    }
    

    
}