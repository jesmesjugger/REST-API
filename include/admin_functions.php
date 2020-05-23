<?php
include_once(__DIR__."/../models/API.php");
include_once(__DIR__."/../models/User.php");
define("UNAUTHORIZED","Unauthorized Access");

$path = explode("/",$_SERVER['REQUEST_URI']);
$file = $path[count($path)-2] == "users"? explode("?",$path[count($path)-1])[0] : null;
$user = new User("","","","");
$admin_errors = array();
$success_message = "";


if($file == "update.php"){
    if(isUserAdmin()){
        getSingleUser();
    }
    else{
        die(UNAUTHORIZED);
    }
}

if(isset($_POST['update_details_btn'])){
    $data = array();
    $tableUsr = unserialize($_SESSION['selectedUser']);
    $updt_username = trim($_POST[USERNAME]);
    $updt_fullname = trim($_POST["name"]);
    $updt_email = trim($_POST[EMAIL]);
    $updt_role = $_POST["role"];
    $updt_password = $_POST[PASSWORD];

    if($updt_username != $tableUsr->getUsername()){
        if(strlen($updt_username) == 0){array_push($admin_errors,"Username field cannot be empty");}
        else{array_push($data,"user=>$updt_username");}
    }
    if($updt_fullname != $tableUsr->getName()){
        if(strlen($updt_fullname) == 0){array_push($admin_errors,"Full names cannot be empty");}
        else{array_push($data,"name=>$updt_fullname");} 
    }
    if($updt_email != $tableUsr->getEmail()){
        if(strlen($updt_fullname) == 0){array_push($admin_errors,"Email cannot be empty");}
        else{array_push($data,"email=>$updt_email");} 
    }
    if($updt_password != 0){
        if(strlen($updt_password) < 4 ){array_push($admin_errors,"Minimum password length is 4 characters");}
        else {array_push($data,"password=>$updt_username");}
    }
    if($updt_role != 0){
        array_push($data,"role=>$updt_role");
    }


    if(count($admin_errors) == 0){updateUser($data);}
}


function isUserAdmin(){ 
    return $_SESSION['role']==2;
}

function getAllUsers(){
    if(isUserAdmin()){
        $url = API::admin_getUsers($_SESSION['user'],$_SESSION['pass']);
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result = json_decode($response);
        curl_close($client);
        return $result;
    }
    else{
        die(UNAUTHORIZED);
    }
}

function getSingleUser(){
    global $user;
    $url = API::admin_getSingleUser($_GET['id'], $_SESSION['user'],$_SESSION['pass']);
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result = json_decode($response);
    $reqData = $result->response[0];
    curl_close($client);

    if($result->status_message == "OK"){
        $user->setName($reqData->name);
        $user->setUsername($reqData->username);
        $user->setEmail($reqData->email);
        $user->setRole($reqData->role);
        $user->setId($reqData->id);
        $_SESSION['selectedUser'] = serialize($user);
    } 
}

function updateUser($data){
    global $success_message,$admin_errors;
    if(isUserAdmin()){
        $url = API::admin_getUserOperationsURL($_GET['id'],$_SESSION['user'],$_SESSION['pass']);
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_CUSTOMREQUEST=>'PUT',
            CURLOPT_POSTFIELDS=>http_build_query($data),
            CURLOPT_HTTPHEADER=>API::getHeaders()
        ));
        $result_json = curl_exec($ch);
        $response = json_decode($result_json,true);
        curl_close($ch);
        var_dump($response);

        if(isset($response["message"])){
            $custom_errors = $response["errors"];
            $error_fields = ["name",USERNAME,EMAIL,"role"];
            foreach($error_fields as $field){
                if(isset($custom_errors[$field])){
                    for($i = 0; $i < count($custom_errors[$field]); $i++){
                        array_push($admin_errors,$custom_errors[$field][$i]);
                    }
                }
            }
        }
        else if($response[STATUS_MESS] != "OK"){
            array_push($admin_errors, $response[STATUS_MESS]);
        }
        else if($response[STATUS_MESS] == "OK"){
            $success_message = "User details updated";
            getSingleUser();
        }

    }
    else{
        die(UNAUTHORIZED);
    }
}

function show_admin_errors() {
    global $admin_errors;
    if (count($admin_errors) > 0){
        echo '<div class="alert alert-danger alert-dismissible fade show py-2">';
        echo    '<h6>';
        foreach ($admin_errors as $error){
            echo $error." ";
        }
        echo'</h6>';
        echo    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
}

function show_admin_success() {
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

function removeSelectedUser(){
    //removes selected user as a session variable
    if($_SESSION['selectedUser']){
        unset($_SESSION['selectedUser']);
    }
}

function deleteUser($id){
    echo $id;
}

?>