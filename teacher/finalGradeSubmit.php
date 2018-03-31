<?php
if (isset($_POST['submitMarks'])) {
	$stuID = $_POST['stuID'];
	$marks = $_POST['marks'];
	$gradeClass = $_POST['gradeClass'];
	
	if ($gradeClass == 'admission') {
		$conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 
		mysqli_select_db($conn, "abc_school_grades") or die ("no Database");

		$sql = "UPDATE admission_test SET total = $marks, submit = 'yes' WHERE sl = '$stuID'";

		if (mysqli_query($conn, $sql)) {
		    header("Location: finalGrades.php?marks=submitted");
		} else {
		    echo "Error updating record: " . mysqli_error($conn);
		}

		mysqli_close($conn);
	} 
}

elseif (isset($_POST['promoteStu'])) {
	$stuID = $_POST['stuID'];
	$gradeClass = $_POST['gradeClass'];

	if (is_numeric($gradeClass)) {
		echo $gradeClass;
		echo "<br>".$stuID;
	}
}


  ?>