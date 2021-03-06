<?php
include_once(__DIR__."/../models/API.php");

$profile_errors = array();
$success_message = "";

if(isset($_POST['updatePasswordBtn'])){
    $currentPass = $_POST['currentPassword'];
    $newPass = $_POST['newPassword'];
    $confirmNewPass = $_POST['confirmPassword'];

    updatePassword($currentPass, $newPass, $confirmNewPass);
}


function updatePassword($currentPass, $newPass, $confirmNewPass){
    global $profile_errors, $success_message;
    
    //validation
    if(empty($currentPass)) {
        array_push($profile_errors, "Current password is required");
    }
    else if(empty($newPass)) {
        array_push($profile_errors, "New password is required");
    }
    else if(empty($confirmNewPass)) {
        array_push($profile_errors, "Password not confirmed");
    }
    else if(strlen($newPass)<6){
        array_push($profile_errors, "Password length should be at least 6 characters");
    }
    else if($newPass != $confirmNewPass) {
        array_push($profile_errors, "Passwords do not match");
    }

    if (count($profile_errors) == 0) {
        $data = array(PASSWORD=>$newPass, 'password_confirmation'=>$confirmNewPass);
        $url = API::getUpdatePasswordApi($_SESSION['role'],$_SESSION['user'],$_SESSION['pass']);

        $ch = curl_init($url);
        curl_setopt_array($ch,array(
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_CUSTOMREQUEST=>'PUT',
            CURLOPT_POSTFIELDS=>http_build_query($data),
            CURLOPT_HTTPHEADER=>API::getHeaders()
        ));
        $result_json = curl_exec($ch);
        $response = json_decode($result_json,true);
        curl_close($ch);

        if($response == null){
            array_push($profile_errors, "Something went wrong, try again later");
        }
        else if(isset($response["message"])){
            $custom_errors = $response["errors"];
            if(isset($custom_errors[PASSWORD])){
                for($i = 0; $i < count($custom_errors[PASSWORD]); $i++){
                    array_push($profile_errors,$custom_errors[PASSWORD][$i]);
                }
            }
        }
        else if($response[STATUS_MESS] !="OK"){
            array_push($profile_errors, $response[STATUS_MESS]);
        }
        else if($response[STATUS_MESS] == "OK"){
            $success_message = "Password updated successfully!";
            $_SESSION['pass'] = $newPass;
        }

    }
}


function show_profile_errors() {
    global $profile_errors;
    if (count($profile_errors) > 0){
        echo '<div class="alert alert-danger alert-dismissible fade show">';
        echo '<h6>';
        foreach ($profile_errors as $error){
            echo $error." ";
        }
        echo '</h6>';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}

function show_profile_success() {
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