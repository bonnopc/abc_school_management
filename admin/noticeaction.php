<!DOCTYPE html>
<html>
<head>
	<title>Update Your Notice</title>
</head>
<body>
<?php
include("dbconfig.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$sl = $_POST['serial'];
	$noticetitle = $_POST['noticetitle'];
	$noticedesc = $_POST['noticedesc'];
	$attachedfile = $_POST['attachedfile'];

	$sql = "UPDATE notice SET noticetitle='$noticetitle', noticedesc='$noticedesc', attachedfile='$attachedfile' WHERE sl='$sl'";

	if (mysqli_query($conn, $sql)) {
	    echo "Record updated successfully";
	    header('Location: notice_view.php');
	} else {
	    echo "Error updating record: " . mysqli_error($conn);
	}
}

  ?>
</body>
</html>