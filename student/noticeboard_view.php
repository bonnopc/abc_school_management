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
	<title>NoticeBoard View - ABC School</title>
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
if (isset($_GET['post'])) {
	$post = $_GET['post'];
	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
	$sql = "SELECT * FROM notice WHERE sl = $post";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['noticetype'] == 'academic') {
				echo "<h4><span class='label label-primary'>Academic</span></h4>";
			} else {
				echo "<h4><span class='label label-default'>Public</span></h4>";
			}

			echo "<div class='pull-right'>
						<p>Updated at - ".$row['updatetime']."</p>
					</div>";
			echo "<h3><strong>".$row['sl'].". ".$row['noticetitle']."</strong><br><small>Updated by - ".$row['updatedby']."</small></h3>";
			
			echo "<p>".$row['noticedesc']."</p><br><br><center><a href='noticeboard.php' class='btn btn-success not'>See all notices</a><br></center><br>";
		}
	}
} else {
	header("Location: noticeboard.php");
}

  ?>



</article>
</div>
<?php include('pageFooter.php'); ?>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>