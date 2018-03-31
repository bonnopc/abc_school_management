<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}
else {
  include("dbconfig.php");

  $stuff_id = $_SESSION['id'];
  $sql = "SELECT * FROM stuff_login WHERE id = '$stuff_id' AND type = 'teacher'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {
    session_unset();
    session_destroy();
    mysqli_close($conn);
    header('Location: ../loginprocess.php');
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
      $stuffName = $row['fname']." ".$row['lname'];
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

  <div class="formcontainer">
  <form action="profile_view.php" method="post">
        <div class="form-group">
            <input type="email" class="form-control" id="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="phoneno" placeholder="Phone Number" required>
        </div>
        <label>Update your Student Profile Picture</label>
        <div class="form-group">
            <input type="file" class="form-control" required>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" required> By clicking next you are agreed to our <a href="terms.php">Terms & Conditions</a>.</label>
        </div>
        <br>
        <center><button type="submit" class="btn btn-primary">Next</button></center>
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