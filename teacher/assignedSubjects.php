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
  <title>Assigned Subjects - ABC School</title>
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


<div class="col-sm-12 col-md-12">

<div class="postTitle">
  <h3>Assigned Subjects</h3>
</div><br>




  <table class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>Subject Code</th>
        <th>Total Students</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
    $sql = "SELECT * FROM subject_list WHERE teacher_id = '$stuff_id'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error());

    if (mysqli_num_rows($result) > 0) {
      $serial_no = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
              <td>$serial_no</td>
              <td>".strtoupper($row['sub_id'])."</td><td>";
        getTotalStudents($row['sub_id']);
        echo "</td>
              <td><form action='grade_view.php' method='post' style='float:left; width:auto; padding:5px;'>
            <input type='hidden' name='sub_id' value='".$row['sub_id']."'>
            <button type='submit' name='show' value='grade' class='btn btn-success btn-xs'>Grades</button>
            </form><form action='assignment.php' method='post' style='width:auto; padding:5px;'>
            <input type='hidden' name='sub_id' value='".$row['sub_id']."'>
            <button type='submit' name='show' value='assignment' class='btn btn-primary btn-xs'>Assignments</button></form>
          </td></tr>";
        $serial_no++;
      }
    }

    function getTotalStudents($id){
      $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 
      mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");
      $sql = "SELECT * FROM $id";
      $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());

      $totalStudent = mysqli_num_rows($result);
      echo $totalStudent;
      return;
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