<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}

else {
  include("dbconfig.php");

  $stu_id = $_SESSION['id'];
  $sql = "SELECT * FROM stu_login WHERE id = '$stu_id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {
    session_unset();
    session_destroy();
    mysqli_close($conn);
    header('Location: ../loginprocess.php');
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
      $stuName = $row['fname']." ".$row['lname'];
    }
  }
}


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

$sql = "SELECT * FROM present_student WHERE sid = '$stu_id' ";
$result = mysqli_query($conn, $sql) or die(mysqli_error());

while ($row = mysqli_fetch_assoc($result)) {
	$imageData = $row['photofile'];
}

header("content-type: image/jpeg");
echo $imageData;

mysqli_close($conn);

?>