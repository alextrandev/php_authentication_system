<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// send verification mail
$link = BASE_URL . $_SERVER['PHP_SELF'] . "?email=$email&token=$token";
$email_msg = 'Please click this link to verify your account <br>';
$email_msg .= '<a href="' . $link . '">Click here</a>';

require './vendor/autoload.php';
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = '5dce458b8033d8';
    $mail->Password   = '3e7f627df5b510';
    $mail->Port       = 2525;
    //Recipients
    $mail->setFrom('contact@example.com');
    $mail->addAddress($email);
    $mail->addReplyTo('contact@example.com', 'Information');
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Account verification';
    $mail->Body    = $email_msg;
    $mail->send();

    $success_msg = 'Registration is completed. A verification email is sent to your email address.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
