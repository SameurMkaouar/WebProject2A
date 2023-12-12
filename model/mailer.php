<?php 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;

 require __DIR__ ."/../vendor/autoload.php";

 $mail= new PHPMailer(true);
 $mail->isSMTP();
 $mail->SMTPAuth=true  ;

 $mail->Host = 'smtp.gmail.com';
 $mail->Port = 587;
 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 $mail->Username = 'mohamedkhalil.tanfous@esprit.tn';
 $mail->Password = '221JMT3769';

 $mail->isHTML(true);
 return $mail;
?>