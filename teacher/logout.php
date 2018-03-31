<?php
session_start();
?>
<?php
	session_unset();
	session_destroy();
	/**
	$myfile = fopen("files/login_info.txt","w") or die("unable to open file!");
	fwrite($myfile,"");
	fclose($myfile); */
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