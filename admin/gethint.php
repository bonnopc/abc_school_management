<?php
if (isset($_REQUEST["q"])) {
	$year = date("y");
	$q = $_REQUEST["q"];

	include('dbconfig.php');

	$sql = "SELECT * FROM admission WHERE email = '$q' AND year = '$year' ";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if (mysqli_num_rows($result) > 0) {
		$error = 404;
		echo $error;
		//echo "This email address is associated with another student profile.";
	}

	else {
		echo "<h1><center>Nothing Found!</center></h1>";
	}
}

else {
	echo "<h1><center>Invalid!</center></h1>";
}


  ?>