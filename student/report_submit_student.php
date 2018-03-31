<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}
/**
if(isset($_REQUEST["id"]) && isset($_REQUEST["pwd"])){
  $file = fopen("files/login_info.txt","w") or die("unable to open file!");
  fwrite($file,$_REQUEST["id"].PHP_EOL.$_REQUEST["pwd"]);
  fclose($file);
  }

$file = fopen("files/login_info.txt","r") or die("unable to open file!");
$i = 1;
while(!feof($file)){
  if($i==1){
  $_SESSION["id"] = fgets($file);
  }
  else{
  $_SESSION["pwd"] = fgets($file);
  }
  $i++;
  }
fclose($file); */
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
		echo "<p class='text-right'>You are logged in as <strong><span class='glyphicon glyphicon-user'></span> ".$_SESSION["id"]."</strong></p>";
    echo "
	<h2>SUBMIT YOUR ASSIGNMENT</h2>
  <div class='col-md-6'>
	<form id='reportsubmit' method='post'>
        <div class='form-group'>
            <input type='text' class='form-control' id='id' value='".$_SESSION["id"]."' disabled>
        </div>";
?>        
        <div class='form-group'>
            <input type='text' class='form-control' id='name' placeholder='Name'>
        </div>
        <div class='form-group'>
            <input type='text' class='form-control' id='subname' placeholder='Course Name'>
        </div>
        <div class='form-group'>
            <input type='text' class='form-control' id='subid' placeholder='Course ID'>
        </div>
        <div class='form-group'>
            <input type='number' class='form-control' id='reportno' placeholder='Assignment Number'>
        </div>
        <label>Upload You Attachment</label>
        <div class='form-group'>
            <input type='file' class='form-control'>
        </div>
        <div>
           	<textarea class='form-control' rows='5' id='reportdesc' placeholder='Enter your message...'></textarea>
        </div>
        <br>
        <center><button type='submit' class='btn btn-primary'>Submit</button></center>
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