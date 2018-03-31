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
	<title><?php echo $stuName; ?> - Results - ABC School</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
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
            <h4>School Management Web Application</h4>
        </a>
        </center>
    </span>
</div>
<?php 
function passORfail($total) {
	if ($total < 40) {
		echo "<div class='progress'>
			    <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='$total' aria-valuemin='0' aria-valuemax='100' style='width:".$total."%'>$total%</div>
			  </div>";
		return;
	} elseif (40 <= $total && $total <= 50) {
		echo "<div class='progress'>
			    <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='$total' aria-valuemin='0' aria-valuemax='100' style='width:".$total."%'>$total%</div>
			  </div>";
		return;
	} else {
		echo "<div class='progress'>
			    <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='$total' aria-valuemin='0' aria-valuemax='100' style='width:".$total."%'>$total%</div>
			  </div>";
		return;
	}
}

function getGrades($subCode, $class){
	$stu_id = $_SESSION['id'];
	$subOnly = $subCode;
	$subCode .= $class;
	switch ($subOnly) {
		case 'bng':
			$subName = "Bangla";
			break;
		case 'eng':
			$subName = "English";
			break;
		case 'mat':
			$subName = "Mathematics";
			break;
		case 'sci':
			$subName = "Genaral Science";
			break;
		case 'soc':
			$subName = "Social Science";
			break;
	}
	$conn = mysqli_connect("localhost", "root", "", "abc_school_grades") or die(mysqli_error());
	$sql = "SELECT * FROM $subCode WHERE sid = '$stu_id'";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>
				<td>$subCode</td>
				<td><strong>$subName</strong><br><small>T.name</small></td>
				<td>".$row['assign']."</td>
				<td>".$row['ct1']."</td>
				<td>".$row['mid']."</td>
				<td>".$row['ct2']."</td>
				<td>".$row['final']."</td>
				<td>";
			$total = $row['assign'] + $row['ct1'] + $row['mid'] + $row['ct2'] + $row['final'];
			passORfail($total);
			echo "</td>
				</tr>";
			return;
		}
	}
}

 ?>

<div class="container">
	<?php include('navigation.php'); ?>
	<article>
	<div class="postTitle">
		<h2>Result Sheet : <?php echo date('Y'); ?></h2>
	</div>
	
	<?php 
	echo "<h4>$stuName</h4><p>ID : $stu_id</p>";
	 ?>
	<p><small>This is your updated result table so far. Please wait some time if you can't see updated marks or GPA in this sheet. Otherwise contact to your <a>Class Teacher</a> or <a>Admin</a> regarding this issue.</small></p>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Code</th>
					<th>Subject<br><small>(with Teacher's Name)</small></th>
					<th>Assignments</th>
					<th>CT01</th>
					<th>Mid Term</th>
					<th>CT02</th>
					<th>Final Term</th>
					<th>Condition</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
				$sql = "SELECT * FROM present_student WHERE sid = $stu_id";
				$result = mysqli_query($conn, $sql) or die(mysqli_error());
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						$prClass = $row['chooseclass'];
					}
				}
				$prClass = substr($prClass, 1);
				mysqli_close($conn);

				getGrades('bng', $prClass);
				getGrades('eng', $prClass);
				getGrades('mat', $prClass);
				getGrades('sci', $prClass);
				getGrades('soc', $prClass);

				 ?>
			</tbody>
		</table>
	</div>
	<div class="pull-right">
		<button class="btn btn-default" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Print</button>
	</div>
	<p><small>If you want to save this as a .PDF file, click the Print button.<br>Then again click Print on the next window, choose your directory & Save the file.<br>No written signature is required as this is an online copy of your grade sheet.</small></p>
		
	</article>
</div>
<?php include('pageFooter.php'); ?>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>