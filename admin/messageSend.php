<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}


else {
  include("dbconfig.php");

  $admin_id = $_SESSION['id'];
  $admin_pass = $_SESSION['pass'];

  $sql = "SELECT * FROM admin_login WHERE id = '$admin_id' AND pass = '$admin_pass' ";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {
    session_unset();
    session_destroy();
    header('Location: ../loginprocess.php');
  }
}

if (isset($_POST['compose'])) {
    	$id = $_POST['id'];
    	$subject = $_POST['subject'];
    	$body = $_POST['msg'];
    	$type = $_POST['type'];

    	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
    	$sql1 = "SELECT * FROM stuff_email WHERE id = '$admin_id'";
		$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

		if (mysqli_num_rows($result1) > 0){
			while ($row = mysqli_fetch_assoc($result1)) {
				$mailFrom = $row['email'];
				$pass = $row['pass'];
			}
		} else {
			header('Location: setupEmail.php');
		}

    	if ($type == 'student') {
			$sql1 = "SELECT * FROM stu_email WHERE id = '$id'";
			$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

			if (mysqli_num_rows($result1) > 0){
			  while ($row = mysqli_fetch_assoc($result1)) {
			  	$mailTo = $row['email'];
			  }
			}
    	} else {
			$sql1 = "SELECT * FROM stuff_email WHERE id = '$id'";
			$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

			if (mysqli_num_rows($result1) > 0){
			  while ($row = mysqli_fetch_assoc($result1)) {
			  	$mailTo = $row['email'];
			  }
			}
    	}

    	require '../phpmailer/PHPMailerAutoload.php';

		$mailSubject = $subject;
		$mailFile = '';
		$mailBody = $body;

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $mailFrom;                 // SMTP username
		$mail->Password = $pass;                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom($mailFrom, 'Admin - ABC School');
		$mail->addAddress($mailTo);     // Add a recipient
		$mail->addReplyTo($mailFrom, 'Admin - ABC School');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		$mail->addAttachment($mailFile);         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $mailSubject;
		$mail->Body    = $mailBody;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
		$sql = "INSERT INTO messagebox(mail_id_from, mail_id_to, subject, attachment, body) VALUES ('$admin_id', '$id', '$mailSubject', '$mailFile', '$mailBody')";
		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . mysqli_error($conn);
		} else {
			header("Location: message.php?mail=send");
		}
	}
} else {
	echo "Error occured, <a href='dashboard.php'>Return to dashboard!</a>";
}

  ?>