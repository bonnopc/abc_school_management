<?php
	session_unset();
	session_destroy();
	header("Location:../index.php");
	mysqli_close($conn);
?>

<!doctype html>
<html>
<head>	
<title>Logout</title>

</head>

<body>
</body>
</html>