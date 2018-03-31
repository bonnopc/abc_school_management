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
	<title>Dashboard - Student - ABC School</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  
</head>

<body>
<div class="pagetitle">
  <span>
        <center>
        <a href="dashboard.php">
            <img class="img-responsive" src="files/abc_logo.png" alt="ABC School Logo" width="100" height="75">
            <h1><strong>ABC SCHOOL</strong></h1>
            <h4>School Management Application</h4>
        </a>
        </center>
    </span>
</div>

<div class="container">
	
<?php include('navigation.php'); ?>

<article>
<div class="postTitle">
  <h4>Teacher's Dashboard</h4>
</div>

<div class="col-md-6 col-sm-12">
<br>
  <h3>Welcome back, <br><strong><?php echo $stuffName; ?></strong></h3><br>

  <ul>
    <li><h4>See Your Latest <a href='payment_view.php'>Payments</a>.</h4></li>
    <li><h4><a href='result.php'>Result Sheet</a>.</h4></li>
    <li><a href='report_submit_student.php'><h4>Submit your assignment.</a></h4></li>
    <li><a href='course_material_download.php'><h4>Download Resources</h4></a></li>
  </ul>
</div>

<div class="col-md-6 col-sm-12">
<br>
<center><h4>Recent Notices</h4></center>
  <table class="table table-bordered">
    <tbody>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
    $sql1 = "SELECT * FROM notice ORDER BY updatetime DESC LIMIT 5";
    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());


    if (mysqli_num_rows($result1) > 0){
      while($row = mysqli_fetch_assoc($result1)) {
        $post = $row['sl'];
        echo "<tr>
        <td><strong>".$row['noticetitle']." </strong>";
        if ($row['noticetype'] == 'academic') {
          echo "<span class='badge'>Academic</span><br>";
        } else {
          echo "<span class='badge'>Public</span><br>";
        }
        echo "<small>Updated by <strong>".$row['updatedby']."</strong> at ".$row['updatetime']."</small><br>";
        // Read More Break
        // strip tags to avoid breaking any html
        $string = strip_tags($row['noticedesc']);

        if (strlen($string) > 50) {
        // truncate string
        $stringCut = substr($string, 0, 50);

        // make sure it ends in a word so assassinate doesn't become ass...
        $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...<a href='noticeboard_view.php?post=$post'>Read More</a>";
        }
        echo $string."</td>

        </tr>";
      }
    }

      ?>
    </tbody>
  </table>
  <br>
  <center>
  <a href="noticeboard.php" class="btn btn-success not">All Notices</a>  
  </center>
  <br>
</div>
</article>
</div>
<?php include('pageFooter.php'); ?>

<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>