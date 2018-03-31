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
	<title>Contact - ABC School</title>
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
	<h2>Compose</h2>
  </center>
</div>
<div class="col-md-5 col-sm-12">
<center>
  <?php
  function getFullClassName($data){
  switch ($data) {
    case 'c06':
      echo "Class 06";
      return;
    case 'c07':
      echo "Class 07";
      return;
    case 'c08':
      echo "Class 08";
      return;
    case 'c09':
      echo "Class 09";
      return;
    case 'c10':
      echo "Class 10";
      return;
    }
  }
  

  if (isset($_GET['id'])) {
    $idlength = strlen($_GET['id']);
    $id = intval($_GET['id']);
    $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());

    if ($idlength == 6) {
      $sql1 = "SELECT * FROM present_student WHERE sid = '$id'";
      $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

      if (mysqli_num_rows($result1) > 0){
        while ($row = mysqli_fetch_assoc($result1)) {
          echo "Send message to :<br><strong>";
          knowName($row['sid']);
          echo "</strong><br>";
          getFullClassName($row['chooseclass']);
          echo "<br>";
          $stu_id = $row['sid']; 
        }
      } else {
        echo "<h3>Invalid Student ID!</h3><p>Please select a <strong>valid recipient</strong><br> from <a href='contactList.php'>this list.</a></p>";
      }
    } else {
      $sql1 = "SELECT * FROM present_stuff WHERE id = '$id'";
      $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

      if (mysqli_num_rows($result1) > 0){
        while ($row = mysqli_fetch_assoc($result1)) {
          echo "Send message to :<br><strong>";
          knowName($row['id']);
          echo "</strong><br>".$row['designation'].",<br>ABC School.";
          $stu_id = $row['id']; 
        }
      } else {
        echo "<h3>Invalid Stuff ID!</h3><p>Please select a <strong>valid recipient</strong><br> from <a href='contactList.php'>this list.</a></p>";
      }
    }

    
  } else {
    echo "<h3>No user specified!</h3><p>Please select a recipient from <a href='contactList.php'>this list.</a></p>";
  }

   ?>
</center>
</div>

<div class='col-md-7 col-sm-12'>
<?php
$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
$sql1 = "SELECT * FROM stuff_email WHERE id = '$stuff_id'";
$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

if (mysqli_num_rows($result1) > 0){
  while ($row = mysqli_fetch_assoc($result1)) {
    $stuff_email = $row['email'];
    $stuff_pass = $row['pass'];
    echo "<form id='contact' method='post' action='sendMessage.php'>
    <div class='form-group'>
            <input type='text' class='form-control' id='name' name='title' placeholder='Pick a Title' required>
        </div>
        <div>
        <textarea class='form-control' rows='5' name='desc' placeholder='Enter your message...' required></textarea>
        </div>
        <div class='form-group'>
        <label>Attach your file (optional)</label>
            <input type='file' class='form-control' id='file' name='file'>
        </div>
        <br>
        <input type='hidden' name='stu_id' value='$stu_id'>
        <center><button type='submit' name='sendmessage' value='send' class='btn btn-primary'>Submit</button></center>
        <br>
        </form>";
  }
} else {
  echo "<h3>Please setup your Gmail server</h3>";
  echo "<form method='post' action='saveEmail.php'>
      <div class='form-group'>
        <input type='text' class='form-control' id='name' name='email' placeholder='Your Email' required>
      </div>
      <div class='form-group'>
        <input type='password' class='form-control' id='name' name='pass' placeholder='Password of your email account' required>
      </div>
      <input type='hidden' name='stuff_id' value='$stuff_id'>
      <center><button type='submit' name='saveemail' value='save' class='btn btn-primary'>Submit</button></center><br>
      </form>";
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