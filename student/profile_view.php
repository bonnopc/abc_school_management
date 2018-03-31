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
    mysqli_close($conn);
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
	<title><?php  echo $stuName;?> - Profile - ABC School</title>
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
<center>
  <?php 
  if (isset($_GET['error'])) {
    if ($_GET['error'] == 1) {
      echo "<div class='well'>
              <center><h4>MySQL Error! Try again later...</h4></center>
            </div>";
    }
    else {
      echo "<div class='well'>
              <center><h4>Record updated successfully...!</p></center>
            </div>";
    }
  }
   ?>
  <img class="img-responsive img-circle" src="<?php  echo "getImage.php";?>" alt="Avatar" width="304" height="403">
  <h3><strong><?php  echo $stuName;?></strong></h3>

  <?php
  $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
  $sql = "SELECT * FROM present_student WHERE sid = '$stu_id'";
  $result = mysqli_query($conn, $sql) or die(mysqli_error());


  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
      switch ($row['chooseclass']) {
      case 'c06':
        $className = "Class 06";
        break;
      case 'c07':
        $className = "Class 07";
        break;
      case 'c08':
        $className = "Class 08";
        break;
      case 'c09':
        $className = "Class 09";
        break;
      case 'c10':
        $className = "Class 10";
        break;
      }
      echo "<p>".$className." | ".$row['sid']."<br><br>";
      echo "<a href='pass_update.php'><span class='glyphicon glyphicon-pencil'></span> Change Password</a></center>";
      echo "<div class='table-responsive'>
              <table class='table table-bordered'>
                <tbody>
                <tr>
                <th>Email</th>
                <td>".$row['email']."</td>
                </tr>
                <tr>
                <th>Phone No.</th>
                <td>".$row['phoneno']."</td>
                </tr>
                <tr>
                <th>Gender</th>
                <td>".$row['gender']."</td>
                </tr>
                <tr>
                <th>Birthday</th>
                <td>".$row['birthday']."</td>
                </tr>
                <tr>
                <th>Father's Name</th>
                <td>".$row['fathersname']."</td>
                </tr>
                <tr>
                <th>Mother's Name</th>
                <td>".$row['mothersname']."</td>
                </tr>
                <tr>
                <th>Permanent Address</th>
                <td>".$row['permanentadrs']."</td>
                </tr>
                <tr>
                <th>Present Address</th>
                <td>".$row['presentadrs']."</td>
                </tr>
                </tbody></table></div>";

    }
  }

    ?>

<p><small>Note: If you want to change any of the informations showing above, please contact our Registrar Office. Remember, providing misleading or inappropriate information will violate the <a href="terms.php">Terms</a> of ABC School & management can take any decision against you.</small></p>
</article>
<br>
</div>
<?php include('pageFooter.php'); ?>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>