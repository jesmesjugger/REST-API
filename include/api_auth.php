<?php
    $username = "";
    $email    = "";
    $errors   = array(); 

    if (isset($_POST['login_btn'])) {
        login();
    }

    function login(){
        global $db, $username, $errors;

        // grap form values
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // make sure form is filled properly
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        // attempt login if no errors on form
        if (count($errors) == 0) {
            $json_obj = '{
                "username": "'.$username.'",
                "password": "'.$password.'" 
            }';
            $data = json_decode($json_obj,true);

            $url = 'http://18.185.59.70/api/login';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response=json_decode($response_json, true);
            
            if($response == null){
                array_push($errors, "An error occured, try again later");
            }
            else {

                if(!$response["status_message"] == "OK"){
                    array_push($errors, $response["status_message"]);
                }
                else {
                    session_start();
                    $user = $response["Profile"];
                    $_SESSION['user'] = $user->username;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['password'] = $password;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['role'] = $user->role;
    
                    if($user->role == "2"){
                        header("Location: home.php");
                    }
                    else {
                        header("Location: views/dashboard/");
                    }
                }

            }
            

            // $url = 'http://18.185.59.70/api/login';
            // $options = array(
            //     'http' => array(
            //         'header'  => "Content-type: application/json",
            //         'method'  => 'POST',
            //         'content' => json_encode($data)
            //     )
            // );

            // $context  = stream_context_create($options);
            // $result = file_get_contents($url, false, $context);
            // if ($result === FALSE){
            //     array_push($errors,"An error occured. Try again later");
            // }
            // else {
            //     var_dump($result);
            // }

        }
    }

    function isLoggedIn()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }else{
            return false;
        }
    }

    function display_error() {
        global $errors;
    
        if (count($errors) > 0){
            echo '<div class="error">';
                foreach ($errors as $error){
                    echo $error .'<br>';
                }
            echo '</div>';
        }
    }


?>