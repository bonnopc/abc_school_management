<?php
if (isset($_POST['final'])) {
	$sub_id = $_POST['sub_id'];
	$stuff_id = $_POST['stuff_id'];

	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
	$sql = "UPDATE subject_list SET teacher_id = '$stuff_id' WHERE sub_id = '$sub_id'";

	if (mysqli_query($conn, $sql)) {
	    header("Location: stuff_teacher.php");
	} else {
	    echo "Error updating record: " . mysqli_error($conn);
	}
}

  ?>