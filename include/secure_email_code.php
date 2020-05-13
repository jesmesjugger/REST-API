<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'C:\Users\MMkolwe\vendor\autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if(isset($_POST["register_btn"])){
// Checking For Blank Fields..
if($_POST["username"]==""||$_POST["email"]==""||$_POST["password"]==""){
//echo "Fill All Fields..";
}else{
// Check if the "Sender's Email" input field is filled out
$email=$_POST['email'];
// Sanitize E-mail Address
$email =filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate E-mail Address
$email= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email){
echo "Invalid Sender's Email";
}
else{
try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'testinfooml@gmail.com';                     // SMTP username
    $mail->Password   = '0779446509';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('testinfooml@gmail.com');
    $mail->addAddress($_POST["email"], $_POST["username"]);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $msg ="Dear [email], here are the credentials for your the new account created.";
     
    //Use it to log in and remember to change your password after the initial login"
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $msg ="Dear $email, here are the credentials for your new account created.\n";
    $mail->Subject = ('New account created');
    $mail->Body    = ("$msg<br>Username:\t$username<br>Password:\t$password");
    $mail->addReplyTo('no-reply@gmail.com','Updates');
    $mail->AltBody = ("$msg.Username.$username.Password.$password");

    $mail->send();
   // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}




}
}
}
?>