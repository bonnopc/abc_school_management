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
	<title>Contact</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<?php include('pageTitle.php'); ?>

<div class="container">
  
<?php include('navigation.php'); ?>
<article>
<p class='text-right'>You are logged in as <span class='glyphicon glyphicon-user'></span> <strong><?php echo $stuffName; ?></strong></p>
<div>
  <center>
	<h2>Please provide your Google Account info here:</h2>
  </center>
</div>


<div class='formcontainer'>
<?php
$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
$sql1 = "SELECT * FROM stuff_email WHERE id = '$stuff_id'";
$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

if (mysqli_num_rows($result1) <= 0){
  echo "<form method='post' action='saveEmail.php'>
      <br>
      <div class='form-group'>
        <input type='text' class='form-control' id='name' name='email' placeholder='Your Email' required>
      </div>
      <div class='form-group'>
        <input type='password' class='form-control' id='name' name='pass' placeholder='Password of your email account' required>
      </div>
      <input type='hidden' name='stuff_id' value='$stuff_id'>
      <center><button type='submit' name='saveemail' value='save' class='btn btn-primary'>Submit</button></center><br>
      </form>";
} else {
  header("Location: dashboard.php");
}

  ?>


        </div>
        <br>
</article>
</div>
<?php include('pageFooter.php'); ?>

<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>