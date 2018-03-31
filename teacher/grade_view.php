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
if (isset($_POST['sub_id'])) {
  $sub_id = $_POST['sub_id'];
} else {
  die("Go Back!");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo strtoupper($sub_id); ?> Grades - ABC School</title>
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

<div class="postTitle">
  <h3><?php echo strtoupper($sub_id); ?> Grades</h3>
</div><br>
<div class="col-sm-12 col-md-12">
<?php
function passORfail($data1, $data2, $data3, $data4, $data5){
  $total = $data1 + $data2 + $data3 + $data4 + $data5;

  if ($total > 40) {
    echo "<div class='progress'>
          <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='".$total."' aria-valuemin='0' aria-valuemax='100' style='width:".$total."%'>$total</div>
        </div>";
    return;
  } else {
    echo "<div class='progress'>
          <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='".$total."' aria-valuemin='0' aria-valuemax='100' style='width:".$total."%'>$total</div>
        </div>";
    return;
  }
}

  ?>


  <table class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>Full Name</th>
        <th>ID</th>
        <th>Assignment</th>
        <th>Class Test 01</th>
        <th>Mid Term</th>
        <th>Class Test 02</th>
        <th>Final</th>
        <th>Condition</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php

    $newyear = date("Y");
    $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

    mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");

    $sql = "SELECT * FROM $sub_id WHERE year = '$newyear'";
    $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());


    if(mysqli_num_rows($result) > 0){
      $sl = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "
          <tr>
          <td>$sl</td>
          <td>".$row['stu_full_name']."</td>
          <td>".$row['sid']."</td>
          <td>".$row['assign']."</td>
          <td>".$row['ct1']."</td>
          <td>".$row['mid']."</td>
          <td>".$row['ct2']."</td>
          <td>".$row['final']."</td>
          <td>";
          passORfail($row['ct1'],$row['ct2'],$row['mid'],$row['assign'],$row['final']);
        echo "</td>
          <td><center>
          <form action='stu_promote.php' method='post'>
            <input type='hidden' name='id' value='".$row['sid']."'>
            <button type='submit' name='admitsubmit' value='admitted' class='btn btn-success btn-xs'>Promote</button>
          </form></center>
          </td>
          </tr>";
          $sl++;
          }
        }

      ?>
    </tbody>
  </table>  
</div>



</article>
</div>
<?php include('pageFooter.php'); ?>

<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>