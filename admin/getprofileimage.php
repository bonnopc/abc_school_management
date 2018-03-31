<?php
if (isset($_GET['id'])) {

	$id = $_GET['id'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "abc_school";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error($conn));
	}

	$sql = "SELECT * FROM present_student WHERE sid = '$id' ";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	while ($row = mysqli_fetch_assoc($result)) {
		$imageData = $row['photofile'];
	}

	header("content-type: image/jpeg");
	echo $imageData;

	mysqli_close($conn);
}

else {
	echo "Error!";
  }
?>