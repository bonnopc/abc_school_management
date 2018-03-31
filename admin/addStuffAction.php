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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require '../phpmailer/PHPMailerAutoload.php';

	$fname = ucfirst($_POST['fname']);
	$lname = ucfirst($_POST['lname']);
	$designation = $_POST['designation'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$type = $_POST['type'];
	$gender = $_POST['gender'];
	$joinmonth = $_POST['joinmonth'];
	$joinmonth++;

	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
	$sql = "SELECT * FROM stuff_login";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$sl = $row['sl'];
			$sl++;
		}
	}


	function makeID($data){
		$year = date('y');
		$data = strval($data);
		$data = sprintf('%s%s',$year,$data);
		return $data;
	}

	$id = makeID($sl);
	$long_year = date('Y');
	$join_time = date('r');



	$user = '';
	$mailFrom = '';
	$mailTo = '';
	$mailSubject = '';
	$mailBody = "";

	$sql1 = "SELECT * FROM stuff_email WHERE id = '$admin_id'";
	$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

	if (mysqli_num_rows($result1) > 0){
		while ($row = mysqli_fetch_assoc($result1)) {
		  	$stuff_email = $row['email'];
		  	$stuff_pass = $row['pass'];
		}
	}

	$mailFrom = $stuff_email;
	$mailTo = $email;
	$mailSubject = 'Welcome to ABC School';
	$mailFile = '';
	$mailBody = "Congratulation ".$fname." ".$lname."!<br>You have been recruited as ".$designation." in ABC School. Your 'Stuff Account' has been created in ABC School Web Application. Please login to your account by providing the informations shown below -
		<br><br>ID : ".$id."<br>Password : ".$id."<br><br>Please change your password after logging into your account.";
	$mailBody .= '<br><br><b>Admin Panel, ABC School.</b><br>';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $mailFrom;                 // SMTP username
	$mail->Password = $stuff_pass;                           // SMTP password
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
		}
	}
	

	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());

	$sql = "INSERT INTO present_stuff (id, join_time, fname, lname, designation, email, phone, gender, type)
			VALUES ('$id', '$join_time', '$fname', '$lname', '$designation', '$email', '$phone', '$gender', '$type')";
	$sql = mysqli_query($conn, $sql) or die(mysqli_error());

	$sql = "INSERT INTO stuff_login (id, pass, type, fname, lname)
			VALUES ('$id', '$id', '$type', '$fname', '$lname')";
	$sql = mysqli_query($conn, $sql) or die(mysqli_error());

	$pay_conn = mysqli_connect("localhost", "root", "", "abc_school_payments") or die(mysqli_error());
	$tableName = "employeepayment".$long_year;
	$fullName = sprintf('%s %s',$fname,$lname);

	$salary = 20000;

	$sql = "INSERT INTO $tableName (stuff_id, stuff_name, stuff_designation, month_no, type, salary)
			VALUES ('$id', '$fullName', '$designation', '$joinmonth' , '$type', $salary)";
	$sql = mysqli_query($pay_conn, $sql) or die(mysqli_error($pay_conn));

	if ($type == 'teacher') {
		header("Location: stuff_teacher.php");
	} else {
		header("Location: stuff_genaral.php");
	} 
} 

  ?>