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
	<title>Contact List</title>
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
function getInfo($data){
  $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
  $sql1 = "SELECT * FROM present_stuff WHERE id = '$data'";
  $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

  if (mysqli_num_rows($result1) > 0){
    while($row = mysqli_fetch_assoc($result1)) {
      $fullName = $row['fname']." ".$row['lname'];
      $designation = $row['designation'];

      echo "<strong>$fullName</strong><br><small>$designation</small></td>";
      return;
    }
  }
}

  ?>
<p class='text-right'>You are logged in as <span class='glyphicon glyphicon-user'></span> <strong><?php echo $stuName; ?></strong></p>

<?php 
if (isset($_GET['msg'])) {
  if ($_GET['msg'] = 'success') {
    echo "<div class='well'>
            <center><h4>Your message has been sent successfully!</h4></center>
          </div>";
            }
  elseif ($_GET['msg'] = 'updated'){
    echo "<div class='well'>
            <center><h4>Your Email server has been successfully updated!</h4></center>
          </div>";
  }
  else {
    echo "<div class='well'>
            <center><h4>There is a problem occured sending your message!<br></h4><p>Please check the issues and try again later...</p></center>
          </div>";
  }
}
 ?>



<div class="col-md-6 col-sm-12">
  <h2>Contact List</h2>
  <p>(Please choose a contact to send your message)</p>
  <table class="table table-bordered">
    <tbody>
      <?php
      $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
      $sql1 = "SELECT * FROM stuff_email";
      $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

      if (mysqli_num_rows($result1) > 0){
        while($row = mysqli_fetch_assoc($result1)) {
          echo "<tr>
          <td>Teacher ID : ".$row['id']."<br>";
          getInfo($row['id']);
          echo "<td><center><a href='contact.php?id=".$row['id']."' class='btn btn-default not'>Message</a></center></td>
          </tr>";
        }
      }

        ?>

    </tbody>
  </table>  
</div>
<div class="col-md-6 col-sm-12">
  <h4><center>Instructions</center></h4>
  <ul>
    <li>You have to have a gmail account to use this messaging feature of ABC School</li>
    <li>You must have to save your gmail account's email address & password in the next page (If you've not did it already)</li>
    <li>You can send message only to the specified Teachers displayed in this 'Contact List'.</li>
  </ul>
</div>


</article>
</div>
<?php include('pageFooter.php'); ?>

<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>