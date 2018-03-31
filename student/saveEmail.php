<?php
if (isset($_POST['saveemail'])) {
	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());

	$stu_id = mysqli_real_escape_string($conn, $_POST['stu_id']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	$sql = "INSERT INTO stu_email(id, email, pass) VALUES ('$stu_id', '$email', '$pass')";

	if (mysqli_query($conn, $sql)) {
	    header("Location: contactList.php");
	} else {
	    echo "Error: " . mysqli_error($conn);
	}
}

  ?>