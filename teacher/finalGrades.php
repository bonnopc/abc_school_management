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

$check_year = date("Y");
$sql = "SELECT * FROM class_teacher WHERE teacher_id = '$stuff_id' AND year = '$check_year'";
$result = mysqli_query($conn, $sql) or die(mysqli_error());

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $gradeClass = $row['class_no'];
    if ($gradeClass == 'admission') {
      $gradeClassName = "Admission Test";
    } else {
      $gradeClassName = "Class 0".$gradeClass;
    }
  }
} else {
  die("Error!");
}


?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $gradeClassName; ?> - Final Grades - ABC School</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../bootbox.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<?php include('pageTitle.php'); ?>

<div class="container">
  
<?php include('navigation.php'); ?>
<article>

<p class='text-right'>You are logged in as <span class='glyphicon glyphicon-user'></span> <strong><?php echo $stuffName; ?></strong></p>

<?php
if (isset($_GET['marks'])) {
  echo "<div class='well'>
      <center><h4>Marks updated successfully!</h4></center>
      </div>";
}
  ?>

<div class="postTitle">
  <h3><?php echo $gradeClassName; ?></h3>
</div>
<br>
<p>You're assigned to check and submit the final marks of <?php echo $gradeClassName; ?>. Please submit it by reviewing all carefully. </p><br>
<div class="col-sm-12 col-md-12">

<?php

function passORfail($data1, $data2, $data3, $data4, $data5){
  $total = $data1 + $data2 + $data3 + $data4 + $data5;
  $total = $total * 0.2;

  if ($data1 > 40 || $data2 > 40 || $data3 > 40 || $data4 > 40 || $data5 > 40) {
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

function indPassORfail($marks){
  if ($marks < 40) {
    echo "<div class='progress'>
          <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='".$marks."' aria-valuemin='0' aria-valuemax='100' style='width:".$marks."%'>$marks</div>
        </div>";
    return;
  } else {
    echo "<div class='progress'>
          <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='".$marks."' aria-valuemin='0' aria-valuemax='100' style='width:".$marks."%'>$marks</div>
        </div>";
    return;
  }
}

function showResult($subcode) {
  $newyear = date("Y");
  $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

  mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");

  $sql = "SELECT * FROM $subcode WHERE year = '$newyear'";
  $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());;


  if(mysqli_num_rows($result) > 0){
    echo '<table class="table table-bordered table-responsive" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Assignment</th>
        <th>Class Test 01</th>
        <th>Mid Term</th>
        <th>Class Test 02</th>
        <th>Final</th>
        <th>Condition</th>
      </tr>
    </thead>
    <tbody>';
  while ($row = mysqli_fetch_assoc($result)) {
  echo "
    <tr>
      <td>".$row['sl']."</td>
      <td><strong>".$row['stu_full_name']."</strong><br><small>ID : ".$row['sid']."</small></td>
      <td>".$row['ct1']."</td>
      <td>".$row['ct2']."</td>
      <td>".$row['mid']."</td>
      <td>".$row['final']."</td>
      <td>".$row['assign']."</td>
      <td>";
      indPassORfail($row['total']);
      echo "</td>
    </tr>";
    }
    echo "</tbody></table>";
  } else {
    echo "<center>There is no data to show!</center>";
  }
  return;
}

$newyear = date("Y");
$grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 
mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");

if ($gradeClass == 'admission') {
  echo "<table class='table table-bordered dt-responsive nowrap' cellspacing='0' width='100%''>
    <thead>
      <tr>
        <th>#</th>
        <th>Name <small>with details</small></th>
        <th>Condition</th>
        <th>Total Marks</th>
      </tr>
    </thead>
    <tbody>";

    $sql = "SELECT * FROM admission_test WHERE year = '$newyear'";
    $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());

    if (mysqli_num_rows($result) > 0) {
      $sl = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td><center>$sl</center></td>
        <td>".$row['stu_full_name']." <small>(".$row['sl'].")<br><i>".$row['email']."</i></small></td>
        <td>";
        indPassORfail($row['total']);
        echo "</td><td>";
        if ($row['submit'] == "yes") {
          echo "<center>".$row['total']."<br><button type='button' class='submitClicked btn btn-info btn-xs' data-toggle='modal' data-target='#myModal' data-mark-type='$gradeClass' data-marks='".$row['total']."' data-id='".$row['sl']."'>Edit</button></center>";
        } else {
          echo "<center>Marks Not Submitted<br><button type='button' class='submitClicked btn btn-warning btn-xs' data-toggle='modal' data-target='#myModal' data-mark-type='$gradeClass' data-id='".$row['sl']."'>Submit Now</button></center>";

        }
        echo "</td>
        </tr>";
        $sl++;
      }
      echo "</tbody>
          </table>";
    } else {
      echo "<tr><td colspan='4'><center>There is no data to display!</center></td></tr></tbody></table>";

    }
} else {


  echo '<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#all">All Subjects</a></li>
    <li><a data-toggle="tab" href="#menu1">BNG0'.$gradeClass.'</a></li>
    <li><a data-toggle="tab" href="#menu2">ENG0'.$gradeClass.'</a></li>
    <li><a data-toggle="tab" href="#menu3">MAT0'.$gradeClass.'</a></li>
    <li><a data-toggle="tab" href="#menu4">SCI0'.$gradeClass.'</a></li>
    <li><a data-toggle="tab" href="#menu5">SOC0'.$gradeClass.'</a></li>
  </ul>

  <div class="tab-content">
    <div id="all" class="tab-pane fade in active">
      <h3>All Students</h3>';
  $bng = "bng0".$gradeClass;    
  $eng = "eng0".$gradeClass;
  $mat = "mat0".$gradeClass;
  $sci = "sci0".$gradeClass;
  $soc = "soc0".$gradeClass;

  $sql = "
        SELECT bng.stu_full_name as fullname, bng.sid as id, bng.total as bngTotal, eng.total as engTotal, mat.total as matTotal, soc.total as socTotal, sci.total as sciTotal
        FROM bng06 bng
        LEFT JOIN eng06 eng ON bng.sid = eng.sid
        LEFT JOIN mat06 mat ON bng.sid = mat.sid
        LEFT JOIN soc06 soc ON bng.sid = soc.sid
        LEFT JOIN sci06 sci ON bng.sid = sci.sid
        WHERE bng.year = '$newyear'";
        $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());


        if(mysqli_num_rows($result) > 0){
          echo '<table class="table table-bordered table-responsive" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>'.strtoupper($bng).'</th>
                    <th>'.strtoupper($eng).'</th>
                    <th>'.strtoupper($mat).'</th>
                    <th>'.strtoupper($sci).'</th>
                    <th>'.strtoupper($soc).'</th>
                    <th>Condition</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';
          $sl = 1;
          while ($row = mysqli_fetch_assoc($result)) {
          echo "
          <tr>
            <td>$sl</td>
            <td><strong>".$row['fullname']."</strong><br><small>ID : ".$row['id']."</small></td>
            <td><center>".$row['bngTotal']."</center></td>
            <td><center>".$row['engTotal']."</center></td>
            <td><center>".$row['matTotal']."</center></td>
            <td><center>".$row['sciTotal']."</center></td>
            <td><center>".$row['socTotal']."</center></td>
            <td>";
            passORfail($row['bngTotal'], $row['engTotal'], $row['matTotal'], $row['socTotal'], $row['sciTotal']);
            echo "</td>
            <td><center>
            <button type='button' class='promoteClicked btn btn-primary btn-xs' data-toggle='modal' data-target='#confirm-promote' data-mark-type='$gradeClass' data-id='".$row['id']."'>Promote</button>
            
            </td>
          </tr>";
          $sl++;
        }
        echo "</tbody></table>";
      } else {
        echo "<center>There is no data to show!</center>";
      }

  echo '</div>
    <div id="menu1" class="tab-pane fade"><h3>';
  echo strtoupper($bng).'</h3>';
  showResult($bng);
    echo '</div>
    <div id="menu2" class="tab-pane fade"><h3>';
  echo strtoupper($eng).'</h3>';
  showResult($eng);
    echo '</div>
    <div id="menu3" class="tab-pane fade"><h3>';
  echo strtoupper($mat).'</h3>';
  showResult($mat);
    echo '</div>
    <div id="menu4" class="tab-pane fade"><h3>';
  echo strtoupper($sci).'</h3>';
  showResult($sci);
    echo '</div>
    <div id="menu5" class="tab-pane fade"><h3>';
  echo strtoupper($soc).'</h3>';
  showResult($soc);
    echo '</div>
  </div>';
  
  echo '<div class="col-sm-12 col-md-6">
    <p>Note :</p>
    <ul>
      <li>You can not promote a student if he does not have pass mark in all subjects.</li>
      <li>Please check if marks of all exams and others are added before you try to promote a student.</li>
      <li>After the due date of final marks submission, contact to the Assigned Teacher if you encountered any problem regarding the submitted marks of of corresponding subjects.</li>
      <li>If you face any technical problem make sure to report it immediately to the Admin Panel.</li>
    </ul>
  </div>
  <div class="pull-right">
  <div class="col-sm-12 col-md-6">
  <table class="table table-bordered table-responsive">
    <thead>
      <tr>
        <th>Subject Name</th>
        <th>Code</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Bangla</td>
        <td>'.strtoupper($bng).'</td>
      </tr>
      <tr>
        <td>English</td>
        <td>'.strtoupper($eng).'</td>
      </tr>
      <tr>
        <td>Mathematics</td>
        <td>'.strtoupper($mat).'</td>
      </tr>
      <tr>
        <td>Genaral Science</td>
        <td>'.strtoupper($sci).'</td>
      </tr>
      <tr>
        <td>Social Science</td>
        <td>'.strtoupper($soc).'</td>
      </tr>
    </tbody>
  </table>
  </div>
  </div>';

}

  ?>
      
</div>

</article>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Submit Marks</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="finalGradeSubmit.php">
            <input type="hidden" name="stuID" value="" id="stuID">
            <input type="hidden" name="gradeClass" value="" id="markType">
            <div class="form-group">
              <input type="number" class="form-control" name="marks" placeholder="Enter Marks" min="0" max="100" required id="marks">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submitMarks" value="done" class="btn btn-primary boltu">Save Changes</button>
          <button type="button" class="btn btn-default boltu" data-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="confirm-promote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
              
        <div class="modal-body">
          <p>Are you sure! Want to promote?</p>
          <form method="post" action="finalGradeSubmit.php">
            <input type="hidden" name="stuID" value="" id="stuID">
            <input type="hidden" name="gradeClass" value="" id="markType">
        </div>
                  
        <div class="modal-footer">
          <button type="submit" name="promoteStu" value="done" class="btn btn-primary">Promote</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
          </form>
        </div>
      </div>
    </div>
  </div>



</div>



<?php include('pageFooter.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
<script type="text/javascript">
  $(function () {
    $(".submitClicked, .promoteClicked").click(function () {
      var my_id_value = $(this).data('id');
      $(".modal-body #stuID").val(my_id_value);

      var marks = $(this).data('marks');
      $(".modal-body #marks").val(marks);

      var markType = $(this).data('mark-type');
      $(".modal-body #markType").val(markType);
    })

    $('.modal').on('hidden.bs.modal', function(e){ 
        $(".modal-body input").val("");
    }) ;


  });
  
</script>

</body>
</html>