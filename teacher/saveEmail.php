<?php
if (isset($_POST['saveemail'])) {
	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());

	$stuff_id = mysqli_real_escape_string($conn, $_POST['stuff_id']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	$sql = "INSERT INTO stuff_email(id, email, pass) VALUES ('$stuff_id', '$email', '$pass')";

	if (mysqli_query($conn, $sql)) {
	    header("Location: contactList.php?msg=updated");
	} else {
	    echo "Error: " . mysqli_error($conn);
	}
}

  ?>