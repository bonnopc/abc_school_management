<!DOCTYPE html>
<html>
<head>
	<title>Mail Action</title>
</head>
<body>

<?php
$headers = "The mail message has been sent using following mail:<br>";
$message = "From: prosenbhalo@gmail.com";

mail('pc.chy007@gmail.com', "First mail using PHP", $message);


echo "<br><br><h1>Mail has been SENT!</h1>";
  ?>
</body>
</html>