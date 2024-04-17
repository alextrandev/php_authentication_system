<?php

use PHPMailer\PHPMailer\PHPMailer;
// send verification mail

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
    $mail->Subject = $email_subject;
    $mail->Body    = $email_msg;
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
