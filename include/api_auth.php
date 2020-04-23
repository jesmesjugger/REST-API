<?php
include_once(__DIR__."/../models/API.php");

session_start();
$success_message = null;
$username = "";
$password = "";
$errors   = array();
$headers = [
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

if (isset($_POST['login_btn'])) {
    login();
}
if (isset($_POST['register_btn'])) {
    create_user();
}
if (isset($_GET['logout_btn'])) {
    logout();
}

function login(){
        global $username, $password, $headers, $errors, $testapi;
        // grab form values
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        echo $testapi;

        // make sure form is filled properly
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        if (strlen($password)<4) {
            array_push($errors, "Password length should be at least 4 characters");
        }
        // attempt login if no errors on form
        if (count($errors) == 0) {
            $url = API::getLoginApi();
            $data = array(
                'username' => urlencode($username),
                'password' => urlencode($password)
            );
            $data_string = http_build_query($data);
            
            $ch = curl_init($url);
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result_json = curl_exec($ch);
            $response = json_decode($result_json,true);
            curl_close($ch);
            
            if($response == null){
                array_push($errors, "Invalid username/password");
            }
            else {
                //If connection is established
                if($response["status_message"] != "OK"){
                    array_push($errors, $response["status_message"]);
                }
                else {
                    $_SESSION['user'] = $response["Profile"]["username"];
                    $_SESSION['name'] = $response["Profile"]["name"];
                    $_SESSION['pass'] = $password;
                    $_SESSION['email'] = $response["Profile"]["email"];
                    $_SESSION['role'] = $response["Profile"]["role"];

                    if($response["Profile"]["role"] == "2"){
                        header("Location: home.php");
                    }
                    else {
                        header("Location: views/dashboard/");
                    }
                    
                }
            }
        }
}

function create_user(){
    global $username, $headers, $password, $errors, $success_message;
    // grab form values
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);
    $confirmPass = trim($_POST['confirmPass']);


    // make sure form is filled properly
    if (empty($name)) {
        array_push($errors, "Name is required");
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($role)) {
        array_push($errors, "User role has not been specified");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($confirmPass)) {
        array_push($errors, "Password has not been confirmed");
    }
    if (strlen($password)<4) {
        array_push($errors, "Password length should be at least 4 characters");
    }
    if ($password != $confirmPass) {
		array_push($errors, "The two passwords do not match");
	}
    
    //Proceed if there are no errors
    if(count($errors)==0){
        $url = API::getCreateApi();
        $data = array(
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'password' => $password
        );
        $data_string = http_build_query($data);
        
        $ch = curl_init($url);
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result_json = curl_exec($ch);
        $response = json_decode($result_json,true);
        curl_close($ch);

        if($response == null){
            array_push($errors, "User cannot be created, try again later.");
        }
        else {
            //Connection Successful but request has errors
            if(isset($response["message"])){
                $custom_errors = $response["errors"];
                
                if(isset($custom_errors["name"])){
                    for($i = 0; $i < count($custom_errors["name"]); $i++){
                        array_push($errors,$custom_errors["name"][$i]);
                    }
                }
                if(isset($custom_errors["username"])){
                    for($i = 0; $i < count($custom_errors["username"]); $i++){
                        array_push($errors,$custom_errors["username"][$i]);
                    }
                }
                if(isset($custom_errors["email"])){
                    for($i = 0; $i < count($custom_errors["email"]); $i++){
                        array_push($errors,$custom_errors["email"][$i]);
                    }
                }
                if(isset($custom_errors["role"])){
                    for($i = 0; $i < count($custom_errors["role"]); $i++){
                        array_push($errors,$custom_errors["role"][$i]);
                    }
                }
                if(isset($custom_errors["password"])){
                    for($i = 0; $i < count($custom_errors["password"]); $i++){
                        array_push($errors,$custom_errors["password"][$i]);
                    }
                }
            }
            else{
                //IF connection successful and no errors
                if($response["status_message"]=="OK"){
                    $success_message = "User creation success!";
                }
            }
        }
    }

}

function isLoggedIn(){
    if (isset($_SESSION['user'])) {
        return true;
    }else{
        return false;
    }
}

function display_error() {
    global $errors;
    if (count($errors) > 0){
        echo '<div class="text-center mt-3 text-danger">';
            foreach ($errors as $error){
                echo $error .'<br>';
            }
        echo '</div>';
    }
}

function display_success() {
    global $success_message;
    if (!empty($success_message)){
        echo '<div class="text-center mt-3 text-success">'.$success_message.'</div>';
    }
}

function logout(){
    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['name']);
    unset($_SESSION['pass']);
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    header("location: ./");
}


?>