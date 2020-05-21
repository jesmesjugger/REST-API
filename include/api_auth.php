<?php
include_once(__DIR__."/../models/API.php");
include_once(__DIR__."/../models/User.php");
define("USERNAME","username");
define("PASSWORD","password");
define("EMAIL","email");

session_start();
const STATUS_MESS = "status_message";
$success_message = null;
$username = $password = "";
$errors   = array();

if (isset($_POST['login_btn'])) {
    $username = trim($_POST[USERNAME]);
    $password = $_POST[PASSWORD];
    login($username, $password);
}
if (isset($_POST['register_btn'])) {
    $name = trim($_POST['name']);
    $username = trim($_POST[USERNAME]);
    $email = trim($_POST[EMAIL]);
    $role = trim($_POST['role']);
    $password = trim($_POST[PASSWORD]);
    $confirmPass = trim($_POST['confirmPass']);

    create_user($name, $username, $email, $role, $password, $confirmPass);
}
if (isset($_GET['logout_btn'])) {
    logout();
}

function login($username, $password){
    global $errors;

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
            USERNAME => urlencode($username),
            PASSWORD => urlencode($password)
        );
        $data_string = http_build_query($data);
        
        $ch = curl_init($url);
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, API::getHeaders());
        $result_json = curl_exec($ch);
        $response = json_decode($result_json,true);
        curl_close($ch);
        
        if($response == null){
            array_push($errors, "Invalid username/password");
        }
        else {
            //If connection is established
            if($response[STATUS_MESS] != "OK"){
                array_push($errors, $response[STATUS_MESS]);
            }
            else {
                $profile = "Profile";
                $_SESSION['id'] = $response[$profile]["id"];
                $_SESSION['user'] = $response[$profile]["username"];
                $_SESSION['name'] = $response[$profile]["name"];
                $_SESSION[EMAIL] = $response[$profile][EMAIL];
                $_SESSION['role'] = $response[$profile]["role"];
                $_SESSION['pass'] = $password;
                if($response[$profile]["role"] == "2"){
                    header("Location: views/admin/home/");
                }
                else {
                    header("Location: views/dashboard/");
                }
            }
        }
    }
}

function create_user($name, $username, $email, $role, $password, $confirmPass){
    global $errors, $success_message;
    
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
            USERNAME => $username,
            EMAIL => $email,
            'role' => $role,
            PASSWORD => $password
        );
        
        $ch = curl_init($url);
        curl_setopt_array($ch,array(
            CURLOPT_POST=> true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => API::getHeaders()
        ));
        $result_json = curl_exec($ch);
        $response = json_decode($result_json,true);
        curl_close($ch);

        if($response == null){
            array_push($errors, "User cannot be created, try again later.");
        }
        else {
            //Connection Successful but request has errors
            if(isset($response["message"])){
                $error_fields = ["name",USERNAME,EMAIL,"role",PASSWORD];
                $custom_errors = $response["errors"];

                foreach($error_fields as $fields){
                    if(isset($custom_errors[$fields])){
                        for($i = 0; $i < count($custom_errors[$fields]); $i++){
                            array_push($errors,$custom_errors[$fields][$i]);
                        }
                    }
                }
            }
            else{
                //IF connection successful and no errors
                if($response[STATUS_MESS]=="OK"){
                    $success_message = "User creation success!";
                    include_once("secure_email_code.php");
                }
            }
        }  
    }
}

function display_error() {
    global $errors;
    if (count($errors) > 0){
        echo '<div class="alert alert-danger alert-dismissible fade show">';
        echo '<h6>';
        foreach ($errors as $error){
            echo $error." ";
        }
        echo    '</h6>';
        echo    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
}

function display_success() {
    global $success_message;
    if (!empty($success_message)){
        echo '<div class="alert alert-success alert-dismissible fade show">';
        echo    '<h6>'.$success_message.'</h6>';
        echo    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}

function isLoggedIn(){
    return (isset($_SESSION['user']));
}

function isAdmin(){
	return (isset($_SESSION['user']) && $_SESSION['role'] == '2');
}

function logout(){
    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['name']);
    unset($_SESSION['pass']);
    unset($_SESSION[EMAIL]);
    unset($_SESSION['role']);
    echo $_SERVER['REQUEST_URI'];
    header("location: ");
}

?>