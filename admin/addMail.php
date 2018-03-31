<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}

else {
  $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());

  $admin_id = $_SESSION['id'];
  $admin_pass = $_SESSION['pass'];

  $sql = "SELECT * FROM admin_login WHERE id = '$admin_id' AND pass = '$admin_pass' ";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {
    session_unset();
    session_destroy();
  }
}


	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	$sql = "INSERT INTO stuff_email(id, email, pass) VALUES ('$admin_id', '$email', '$pass')";

	if (mysqli_query($conn, $sql)) {
	    header("Location: dashboard.php?gmail=set");
	} else {
	    echo "Error: " . mysqli_error($conn);
	}

  ?>