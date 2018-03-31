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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['updatepass'])) {
		$oldPass = $_POST['oldPass'];
		$newPass = $_POST['newPass'];
		$conPass = $_POST['conPass'];

		$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
        $sql1 = "SELECT * FROM stu_login WHERE id = '$stu_id'";
        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

        if (mysqli_num_rows($result1) > 0){
            while($row = mysqli_fetch_assoc($result1)) {
            	$savedPass = $row['pass'];
            }
        }

        if ($savedPass == $oldPass) {
        	if ($newPass == $conPass) {
        		$sql = "UPDATE stu_login SET pass = '$newPass' WHERE id = '$stu_id'";
				if (mysqli_query($conn, $sql)) {
				    header("Location: profile_view.php?error=no");
				} else {
					header("Location: profile_view.php?error=1");
				}
        	} else {
        		header("Location: pass_update.php?error=2");
        	}
        } else {
        	header("Location: pass_update.php?error=3");
        }	
	}
}

mysqli_close($conn);
  ?>