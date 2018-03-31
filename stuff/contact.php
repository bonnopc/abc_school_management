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
<p class='text-right'>You are logged in as <span class='glyphicon glyphicon-user'></span> <strong><?php echo $stuffName; ?></strong></p>
<div>
	<h2>Contact</h2>
</div>
<div class='col-sm-7'>
<form id='contact' method='post'>
		<div class='form-group'>
            <input type='text' class='form-control' id='id' placeholder="ID">
        </div>
		<div class='form-group'>
            <input type='text' class='form-control' id='name' name='name' placeholder='Name'>
        </div>
        <div>
            <select class='form-control' name="category" required>
                <option value=''>Choose a category</option>
                <option value='student'>Student</option>
                <option value='teacher'>Teacher</option>
                <option value='admin'>Administrator</option>
            </select>
        </div>
        <div class='form-group'>
        <label>Attach your file (optional)</label>
            <input type='file' class='form-control' id='file' name="file">
        </div>
        <div>
        <textarea class='form-control' rows='5' id='reportdesc' placeholder='Enter your message...'></textarea>
        </div>
        <br>
        <center><button type="submit" class="btn btn-primary">Submit</button></center>
        <br>

        </form>
        </div>
        <br>
		


</article>
</div>
<?php include('pageFooter.php'); ?>

<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>