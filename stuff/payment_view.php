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
$stu_id = 170023;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Payments - ABC School</title>
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
  $conn = mysqli_connect("localhost","root","") or die ("could not connect to MySQL!");
  mysqli_select_db($conn, "abc_school") or die ("no Database");
  $sql = "SELECT * FROM present_student WHERE sid = '$stu_id'";
  $result = mysqli_query($conn, $sql) or die(mysqli_error());

  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $presentClass = $row['chooseclass'];
      $presentClass = intval(substr($presentClass, 1));
    }
  }

  $monthlyAmount = $presentClass * 100;
   ?>
  <div class="pull-right">
    <h4><center>To be Paid</center></h4>
    <ul>
      <li>Fees (monthly) - <?php echo $monthlyAmount ?></li>
      <li>Others (yearly) - 5000</li>
    </ul>
  </div>
  <h2>Payments</h2>
  <p>Here are the payment info of your academic & other fees. Please contact to <a>Accounts</a> if you've faced any problem regarding payments info displayed here.</p>
  <br>
  
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Month</th>
          <th>Amount Paid</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $others = 5000;
      $newyear = date("Y");
      $measureTable = "stupayment_".$newyear;
      $presentMonth = date('n');
      //$monthlyAmount = floatval(measureMonth($presentClass));

      $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

      mysqli_select_db($grade_conn, "abc_school_payments") or die ("no Database");

      $sql = "SELECT * FROM $measureTable WHERE sid = '$fake_id'";
      $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());


      if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
          for ($i=1; $i <= 12; $i++) { 
            $dateObj   = DateTime::createFromFormat('!m', $i);
            $monthName = $dateObj->format('F');
            $monthCol = "m".$i;

            echo "<tr><td>".$i."</td><td>".$monthName."</td><td><center>".$row[$monthCol]."</center></td></tr>";
          }
          echo "<tr><td>13</td><td>Others</td><td><center>".$row['othercost']."</center></td></tr>";
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