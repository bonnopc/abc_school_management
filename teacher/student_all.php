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
  <title>All Students - ABC School</title>
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
function passORfail($sub1,$sub2,$sub3,$sub4,$sub5) {
  $sub1 = floatval($sub1);
  $sub2 = floatval($sub2);
  $sub3 = floatval($sub3);
  $sub4 = floatval($sub4);
  $sub5 = floatval($sub5);

  $total = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;
  $totalpercentage = $total * 0.2;
  if ($sub1 >= 40 && $sub2 >= 40 && $sub3 >= 40 && $sub4 >= 40 && $sub5 >= 40) {
    echo "<div class='progress'>
          <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='".$totalpercentage."' aria-valuemin='0' aria-valuemax='100' style='width:".$totalpercentage."%'>$total ($totalpercentage %)</div>
        </div>";
    return;
  } else {
    echo "<div class='progress'>
          <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='".$totalpercentage."' aria-valuemin='0' aria-valuemax='100' style='width:".$totalpercentage."%'>$total ($totalpercentage %)</div>
        </div>";
    return;
  }
}

function checkDataLimit($data){
  switch ($data) {
    case 'c10':
      echo "<option value='student_all.php?cl=c10'>Class 10</option>
          <option value='student_all.php?cl=c09'>Class 09</option>
          <option value='student_all.php?cl=c08'>Class 08</option>
          <option value='student_all.php?cl=c07'>Class 07</option>
          <option value='student_all.php?cl=c06'>Class 06</option>";
      return;

    case 'c09':
      echo "<option value='student_all.php?cl=c09'>Class 09</option>
          <option value='student_all.php?cl=c10'>Class 10</option>
          <option value='student_all.php?cl=c08'>Class 08</option>
          <option value='student_all.php?cl=c07'>Class 07</option>
          <option value='student_all.php?cl=c06'>Class 06</option>";
      return;
    
    case 'c08':
      echo "<option value='student_all.php?cl=c08'>Class 08</option>
          <option value='student_all.php?cl=c09'>Class 09</option>
          <option value='student_all.php?cl=c10'>Class 10</option>          
          <option value='student_all.php?cl=c07'>Class 07</option>
          <option value='student_all.php?cl=c06'>Class 06</option>";
      return;

    case 'c07':
      echo "<option value='student_all.php?cl=c07'>Class 07</option>
          <option value='student_all.php?cl=c08'>Class 08</option>
          <option value='student_all.php?cl=c09'>Class 09</option>
          <option value='student_all.php?cl=c10'>Class 10</option>                    
          <option value='student_all.php?cl=c06'>Class 06</option>";
      return;

    case 'c06':
      echo "<option value='student_all.php?cl=06'>Class 06</option>
          <option value='student_all.php?cl=c07'>Class 07</option>
          <option value='student_all.php?cl=c08'>Class 08</option>
          <option value='student_all.php?cl=c09'>Class 09</option>
          <option value='student_all.php?cl=c10'>Class 10</option>";
      return;
  }
}

  ?>
<p class='text-right'>You are logged in as <span class='glyphicon glyphicon-user'></span> <strong><?php echo $stuffName; ?></strong></p>


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
<h2>All Students</h2>

  <table class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>Full Name</th>
        <th>ID</th>
        <th>Bangla</th>
        <th>English</th>
        <th>Mathematics</th>
        <th>Social Science</th>
        <th>Genaral Science</th>
        <th>Condition</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php

    $onlyClass = substr($cl, 1);
    $bng = "bng".$onlyClass;
    $eng = "eng".$onlyClass;
    $mat = "mat".$onlyClass;
    $soc = "soc".$onlyClass;
    $sci = "sci".$onlyClass;

    $newyear = date("Y");
    $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

    mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");

    $sql = "
            SELECT bng.stu_full_name as fullname, bng.sid as id, bng.total as bngTotal, eng.total as engTotal, mat.total as matTotal, soc.total as socTotal, sci.total as sciTotal
            FROM $bng bng
            LEFT JOIN $eng eng ON bng.sid = eng.sid
            LEFT JOIN $mat mat ON bng.sid = mat.sid
            LEFT JOIN $soc soc ON bng.sid = soc.sid
            LEFT JOIN $sci sci ON bng.sid = sci.sid
            WHERE bng.year = '$newyear'";
    $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());


    if(mysqli_num_rows($result) > 0){
      $sl = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "
          <tr>
          <td>$sl</td>
          <td>".$row['fullname']."</td>
          <td>".$row['id']."</td>
          <td>".$row['bngTotal']."</td>
          <td>".$row['engTotal']."</td>
          <td>".$row['matTotal']."</td>
          <td>".$row['socTotal']."</td>
          <td>".$row['sciTotal']."</td>
          <td class='vertical-align-mid'>
            <div class='progress progress_sm'>
              <div ";
          passORfail($row['bngTotal'], $row['engTotal'], $row['matTotal'], $row['socTotal'], $row['sciTotal']);
          echo "</td>
          <td><center>
          <a href='contact.php?id=".$row['id']."' class='btn btn-primary btn-sm not'>Message</a></center>
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