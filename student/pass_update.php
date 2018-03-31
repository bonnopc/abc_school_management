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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Assignment Submission - ABC School</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<div class="pagetitle">
  <center>
        <img class="img-responsive" src="files/abc_logo.png" alt="ABC School Logo" width="100" height="75">
        <h1><strong>ABC SCHOOL</strong></h1>
        <h4>School Management Web Application</h4>
  </center>
</div>

<div class="container">
  
<?php include('navigation.php'); ?>
<article>

<?php
	//if($_SESSION["id"]!="" && $_SESSION["pwd"]!=""){
		echo "<p class='text-right'>You are logged in as <strong><span class='glyphicon glyphicon-user'></span> $stuName</strong></p>";
    echo "
		"; /**
  }
  else{
    echo "<h2>You are not allowed to view this page!</h2><br><br>
  <a href='index.php'>Register or LogIn</a><br><br>";
  } */
	?>
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 2){
    echo "<div class='well'>
          <center><h4>Password didn't match! Try again...</h4></center>
          </div>";
  } else {
    echo "<div class='well'>
          <center><h4>You've entered a Wrong Password! Try again..</h4></center>
          </div>";
    }
}



  ?>
  <div class="formcontainer">
  <br>
  <form action="passAction.php" method="post">
        <div class="form-group">
            <input type="password" class="form-control" name="oldPass" placeholder="Your Current password" required>
        </div>
        <br>
        <div class="form-group">
            <input type="password" class="form-control" name="newPass" placeholder="New Password" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="conPass" placeholder="Confirm Password" required>
        </div>
        <br>
        <center><button type="submit" name="updatepass" value="done" class="btn btn-primary">Update</button></center>
        <br>
    </form>
    </div>

</article>
<br>
</div>
<?php include('pageFooter.php'); ?>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>