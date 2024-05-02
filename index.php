<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require "vendor/autoload.php";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = "smtp.gmail.com"; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = "example@email.com"; //SMTP username
    $mail->Password = "yourPssword"; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("nizagenda5@gmail.com", "Niz");
    // $mail->addAddress('');     //Add a recipient
    $mail->addAddress("cegiro7981@lewenbo.com"); //Add a recipient

    // $mail->addAttachment('./images/foto.jpg', 'fotoXD');    //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = "Here is the subject";
    // $mail->AddEmbeddedImage('images/foto.jpg', 'logoimg', 'foto.jpg', 'base64', 'image/jpg');
    // $mail->AddEmbeddedImage("images/foto.jpg", "foto");
    $mail->msgHTML(file_get_contents("mail.html"), __DIR__);
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    $mail->send();
    echo "Mail sent";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
