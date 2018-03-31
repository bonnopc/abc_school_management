<!DOCTYPE html>
<html>
<head>
	<title>Adding</title>
</head>
<body>
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
include("dbconfig.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$sl = $_POST['sl'];
	$chooseclass = $_POST['chooseclass'];

	$sql2 = "SELECT fname, lname FROM admission WHERE sl = '$sl' ";
	$poo = mysqli_query($conn, $sql2) or die('could not Select!');

	if (mysqli_num_rows($poo) > 0) {
		while ($row = mysqli_fetch_assoc($poo)) {
			$firstname = $row['fname'];
			$lastname = $row['lname'];
		}
	}
/*
	$sql1 = "SELECT * FROM admission WHERE sl = '$sl' ";
	$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

	if (mysqli_num_rows($result1) > 0) {
		while ($row = mysqli_fetch_assoc($result1)) {
			$smyear = $row['year'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$chooseclass = $row['chooseclass'];
			$email = $row['email'];
			$phoneno = $row['phoneno'];
			$gender = $row['gender'];
			$birthday = $row['birthday'];
			$termsagreed = $row['termsagreed'];
			$photofile = $row['photofile'];
			$fathersname = $row['fathersname'];
			$mothersname = $row['mothersname'];
			$presentadrs = $row['presentadrs'];
			$permanentadrs = $row['permanentadrs'];
			$paperfile = $row['paperfile'];
			$finalterms = $row['finalterms'];

		}
	}
*/
	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
	$result = "SELECT * FROM admission WHERE sl = '$sl'";
	$result = mysqli_query($conn, $result);
	if (mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			$stu_email = $row['email'];
			$stu_full_name = $row['fname']." ".$row['lname'];
			$prClass = $row['chooseclass'];
		}
	}


	$smyear = date("y");
	$id = make_id($smyear, $sl);
	$year = date("Y");

	$result = "INSERT INTO stu_login(id, pass, fname, lname) SELECT '$id', '$id', fname, lname FROM admission WHERE sl = '$sl' " or die("Nothing Happened!");
    $result = mysqli_query($conn, $result);

    require '../phpmailer/PHPMailerAutoload.php';

	$user = '';
	$mailFrom = '';
	$mailTo = '';
	$mailSubject = '';
	$mailBody = "";

		$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
		$sql1 = "SELECT * FROM stuff_email WHERE id = '$admin_id'";
		$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

		if (mysqli_num_rows($result1) > 0){
		  while ($row = mysqli_fetch_assoc($result1)) {
		  	$stuff_email = $row['email'];
		  	$stuff_pass = $row['pass'];
		  }
		}

		$mailFrom = $stuff_email;
		$mailTo = $stu_email;
		$mailSubject = 'Welcome to ABC School';
		$mailFile = '';
		$mailBody = "Congratulation! You have been successfully passed in our admission test. Your student id has been created.<br><br><div class='well'>ID : ".$id."<br>Password : ".$id."</div><br><br>Please change your password after logging into your student profile of ABC School.";
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
	    $sql = "INSERT INTO messagebox(mail_id_form, mail_id_to, subject, attachment, body) VALUES ('$admin_id', '$id', '$mailSubject', '$mailFile', '$mailBody')";
	    if (!mysqli_query($conn, $sql)) {
		    echo "Error: " . mysqli_error($conn);
		}
	}


	switch ($chooseclass) {
		case 'c06':
			$result = "INSERT INTO class06(sid, year, fname, lname, email, class) SELECT '$id', '$year', fname, lname, email, chooseclass FROM admission WHERE sl = '$sl' " or die("Nothing Happened!");
    		$result = mysqli_query($conn, $result);
			break;

		case 'c07':
			$result = "INSERT INTO class07(sid, year, fname, lname, email, class) SELECT '$id', '$year', fname, lname, email, chooseclass FROM admission WHERE sl = '$sl' " or die("Nothing Happened!");
    		$result = mysqli_query($conn, $result);
			break;

		case 'c08':
			$result = "INSERT INTO class08(sid, year, fname, lname, email, class) SELECT '$id', '$year', fname, lname, email, chooseclass FROM admission WHERE sl = '$sl' " or die("Nothing Happened!");
    		$result = mysqli_query($conn, $result);
			break;

		case 'c09':
			$result = "INSERT INTO class09(sid, year, fname, lname, email, class) SELECT '$id', '$year', fname, lname, email, chooseclass FROM admission WHERE sl = '$sl' " or die("Nothing Happened!");
    		$result = mysqli_query($conn, $result);
			break;
		
		case 'c10':
			$result = "INSERT INTO class10(sid, year, fname, lname, email, class) SELECT '$id', '$year', fname, lname, email, chooseclass FROM admission WHERE sl = '$sl' " or die("Nothing Happened!");
    		$result = mysqli_query($conn, $result);
    		break;
		
		default:
			echo "Nothing Happened!";
			break;
	}


	$sql = "INSERT INTO present_student(year, sid, fname, lname, chooseclass, email, phoneno, gender, birthday, photofile, termsagreed, fathersname, mothersname, presentadrs, permanentadrs, paperfile, finalterms) SELECT '$year', '$id', fname, lname, chooseclass, email, phoneno, gender, birthday, photofile, termsagreed, fathersname, mothersname, presentadrs, permanentadrs, paperfile, finalterms FROM admission WHERE sl = '$sl' ";
	$result1 = mysqli_query($conn, $sql) or die(mysqli_error());

    mysqli_close($conn);

    include('stu_addto_subjects.php');

    $longYear = date('Y');
    $payTable = "stupayment_".$longYear;

    $pay_conn = mysqli_connect("localhost", "root", "", "abc_school_payments") or die(mysqli_error());
    $sql = "INSERT INTO $payTable(sid, fullname, class) VALUES('$id', '$stu_full_name', '$prClass')";
    $sql = mysqli_query($pay_conn, $sql) or die(mysqli_error($pay_conn));

    header("Location: applied_students.php");
	exit();

}

else {
	echo "No Permission";
}

//Making Student ID
function make_id ($data1, $data2) {
	$data2 = str_pad($data2, 4, "0", STR_PAD_LEFT);
	$data1 = sprintf("%u%s",$data1,$data2);
	return $data1;
}


  ?>

</body>
</html>