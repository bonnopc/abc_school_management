<?php
if (isset($_REQUEST["q"])) {
	$year = date("y");
	$q = $_REQUEST["q"];

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

	$sql = "SELECT * FROM admission WHERE email = '$q' AND year = '$year' ";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if (mysqli_num_rows($result) > 0) {
		$error = 404;
		echo $error;
		//echo "This email address is associated with another student profile.";
	}

	mysqli_close($conn);
}

else {
	echo "Invalid!";
}


  ?>