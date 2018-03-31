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
	<title>Contact List - ABC School</title>
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

<?php

function checkDataLimit($data){
  switch ($data) {
    case 'c10':
      echo "<option value='contactList.php?cl=c10'>Class 10</option>
          <option value='contactList.php?cl=c09'>Class 09</option>
          <option value='contactList.php?cl=c08'>Class 08</option>
          <option value='contactList.php?cl=c07'>Class 07</option>
          <option value='contactList.php?cl=06'>Class 06</option>";
      return;

    case 'c09':
      echo "<option value='contactList.php?cl=c09'>Class 09</option>
          <option value='contactList.php?cl=c10'>Class 10</option>
          <option value='contactList.php?cl=c08'>Class 08</option>
          <option value='contactList.php?cl=c07'>Class 07</option>
          <option value='contactList.php?cl=06'>Class 06</option>";
      return;
    
    case 'c08':
      echo "<option value='contactList.php?cl=c08'>Class 08</option>
          <option value='contactList.php?cl=c09'>Class 09</option>
          <option value='contactList.php?cl=c10'>Class 10</option>          
          <option value='contactList.php?cl=c07'>Class 07</option>
          <option value='contactList.php?cl=06'>Class 06</option>";
      return;

    case 'c07':
      echo "<option value='contactList.php?cl=c07'>Class 07</option>
          <option value='contactList.php?cl=c08'>Class 08</option>
          <option value='contactList.php?cl=c09'>Class 09</option>
          <option value='contactList.php?cl=c10'>Class 10</option>                    
          <option value='contactList.php?cl=06'>Class 06</option>";
      return;

    case 'c06':
      echo "<option value='contactList.php?cl=06'>Class 06</option>
          <option value='contactList.php?cl=c07'>Class 07</option>
          <option value='contactList.php?cl=c08'>Class 08</option>
          <option value='contactList.php?cl=c09'>Class 09</option>
          <option value='contactList.php?cl=c10'>Class 10</option>";
      return;
  }
}

  ?>
<p class='text-right'>You are logged in as <span class='glyphicon glyphicon-user'></span> <strong><?php echo $stuffName; ?></strong></p>

<?php
if (isset($_GET['msg'])) {
  switch ($_GET['msg']) {
    case 'success':
      echo "<div class='well'>
            <center><h4>Your message has been sent successfully!</h4></center>
          </div>";
      break;

    case 'updated':
      echo "<div class='well'>
            <center><h4>Your Email server has been successfully updated!</h4></center>
          </div>";
      break;

    default:
      echo "<div class='well'>
            <center><h4>There is a problem occured!<br></h4><p>Please check the issues and try again later...</p></center>
          </div>";
      break;
  }
}
  ?>


<div class="col-sm-12 col-md-12">
<div class="pull-right">
      <form>
      <div class="input-group">
        <p>Showing students of&nbsp;&nbsp;</p> 
        <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none; padding-bottom: 5px;"></span>
        <select class="form-control input-sm" onchange="location = this.options[this.selectedIndex].value;">
          <?php
          $cl = 'c06';
          if (isset($_GET['cl'])) {
            $cl = $_GET['cl'];
          }
          checkDataLimit($cl);
          ?>
        </select>
      </div>
    </form>
  </div>
<h2>Contact List</h2>

    
  <p>(Please choose a contact to send your message)</p>
  <table class="table table-bordered">
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>Phone No</th>
      <th>Email</th>
      <th>Action</th>
    </thead>
    <tbody>
    <?php
    $year = date('Y');
    $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
    $sql1 = "SELECT * FROM present_student WHERE chooseclass = '$cl' AND year = '$year'";
    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

    if (mysqli_num_rows($result1) > 0){
      while($row = mysqli_fetch_assoc($result1)) {
        echo "<tr>
            <td>".$row['sid']."</td>
            <td>".$row['fname']." ".$row['lname']."</td>
            <td>".$row['phoneno']."</td>
            <td>".$row['email']."</td>
            <td><center><a href='contact.php?id=".$row['sid']."' class='btn btn-primary btn-sm not'>Message</a></center></td>
            </tr>";
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