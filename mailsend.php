<?php
require 'phpmailer/PHPMailerAutoload.php';

$user = 'ABC School';
$mailFrom = 'lesveriafashion@gmail.com';
$mailTo = 'pc.chy007@gmail.com';
$mailSubject = 'Welcome to ABC School';
$mailBody = "Congratulation! You have been successfully passed in the Admission Test'2017 of ABC School.";


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $mailFrom;                 // SMTP username
$mail->Password = 'Guaamaraakhaa.';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($mailFrom, $user);
$mail->addAddress($mailTo, 'Mail PHP');     // Add a recipient
$mail->addReplyTo($mailFrom, 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $mailSubject;
$mail->Body    = $mailBody;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

  ?>