<?php
    session_start();
    $username = "";
    $email    = "";
    $errors   = array(); 

    if (isset($_POST['login_btn'])) {
        login();
    }

    if (isset($_GET['logout_btn'])) {
        logout();
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
        if (strlen($password)<4) {
            array_push($errors, "Password length should be at least 4 characters");
        }

        // attempt login if no errors on form
        if (count($errors) == 0) {
            $url = 'http://18.185.59.70/api/login';

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
            echo '<div class="error">';
                foreach ($errors as $error){
                    echo $error .'<br>';
                }
            echo '</div>';
        }
    }

    function logout(){
        session_destroy();
        unset($_SESSION['user']);
        unset($_SESSION['name']);
        unset($_SESSION['pass']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);

        header("location: index.php");
    }


?>