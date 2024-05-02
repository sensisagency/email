<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

$mail = new PHPMailer(true);

$sender = '';

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "example@gmail.com";
    $mail->Password = "secret";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom("example@gmail.com", "Name");
    $mail->addAddress($sender);

    $mail->isHTML(true);
    $mail->Subject = "Here is the subject";

    $mail->AddEmbeddedImage("images/foto.jpg", "foto", "foto.jpg", "base64", "image/jpg");
    $mail->AddEmbeddedImage("images/flossing.jpg", "flossing", "flossing.jpg", "base64", "image/jpg");
    $mail->AddEmbeddedImage("images/x-icon.png", "x-icon", "x-icon.png", "base64", "image/png");
    $mail->AddEmbeddedImage("images/facebook-icon.png", "facebook-icon", "facebook-icon.png", "base64", "image/png");
    $mail->AddEmbeddedImage("images/mail-icon.png", "mail-icon", "mail-icon.png", "base64", "image/png");

    $mail->msgHTML(file_get_contents("mail.html"), __DIR__);

    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    $mail->send();
    echo "Mail sent to: " . $sender;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
