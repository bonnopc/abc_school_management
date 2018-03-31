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
	<title>Notice Board - ABC School</title>
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
function checkDataLimit($data){
  switch ($data) {
    case '500':
      echo "<option value='noticeboard.php?l=500'>500</option>
          <option value='noticeboard.php?l=100'>100</option>
          <option value='noticeboard.php?l=50'>50</option>
          <option value='noticeboard.php?l=10'>10</option>";
      return;

    case '100':
      echo "<option value='noticeboard.php?l=100'>100</option>
          <option value='noticeboard.php?l=50'>50</option>
          <option value='noticeboard.php?l=10'>10</option>
          <option value='noticeboard.php?l=500'>500</option>";
      return;
    
    case '50':
      echo "<option value='noticeboard.php?l=50'>50</option>
          <option value='noticeboard.php?l=10'>10</option>
          <option value='noticeboard.php?l=100'>100</option>
          <option value='noticeboard.php?l=500'>500</option>";
      return;

    case '10':
      echo "<option value='noticeboard.php?l=10'>10</option>
          <option value='noticeboard.php?l=50'>50</option>
          <option value='noticeboard.php?l=100'>100</option>
          <option value='noticeboard.php?l=500'>500</option>";
      return;
  }
}

  ?>
<div class="col-md-7">
  <h3>Notice Board</h3>
</div>
<div class="col-md-5">
  <div class="pull-right">
    <form>
      <div class="input-group">
        <p>Showing (max.)&nbsp;&nbsp;</p> 
        <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none; padding-bottom: 5px;"></span>
        <select class="form-control input-sm" onchange="location = this.options[this.selectedIndex].value;">
          <?php
          $l = 10;
          if (isset($_GET['l'])) {
            $l = $_GET['l'];
          }
          checkDataLimit($l);
          ?>
        </select>
        <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span> 
        <p>&nbsp;&nbsp; Notices</p>
      </div>
    </form>
  </div>
</div>
<div class="col-md-12 col-sm-12">
  <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Notice</th>
        <th>Updated By</th>
        <th>Type</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
        <?php

        function calculateLimit($data){
          $data = intval($data);
          $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
          $sql1 = "SELECT * FROM notice ORDER BY updatetime DESC LIMIT $data";
          $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());


          if (mysqli_num_rows($result1) > 0){
            $serial_no = 01;
            while($row = mysqli_fetch_assoc($result1)) {
              $post = $row['sl'];
              echo "<tr>
              <td>$serial_no</td>
              <td><b>".$row['noticetitle']."</b><br>";


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
              <td>".$row['updatedby']."</td>
              <td>".$row['noticetype']."</td>
              <td>".$row['updatetime']."</td></tr>";
              $serial_no++;
            }
          }
          else {
            echo "There is no notice to show";
          }
          return;
        }

        if (isset($_GET['l'])) {
          $l = $_GET['l'];
        }
        else {
          $l = 10;
        }
        calculateLimit($l);
          ?>
    </tbody>
  </table>
  </div>
</div>
  
</article>
</div>
<br>
<?php include('pageFooter.php'); ?>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>