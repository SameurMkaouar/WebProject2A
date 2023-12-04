<?php

//$name = $_POST["name"];
//$email = $_POST["email"];



if(isset($_GET['success'])){
    $message="Votre rendez-vous est confirmé";
    $subject = "Email de confirmation";
}
else{
    $message="Votre rendez-vous est annulé";
    $subject = "Email d'annulation";
    
}


require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "karim.kebaili@esprit.tn";
$mail->Password = "ohbt ffqr jlfi ddhg";

//$mail->setFrom($email, $name);
$mail->addAddress("karim.kebaili@esprit.tn", "karim");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.html");