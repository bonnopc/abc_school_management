<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc_school_payments";

// Create connection
$grade_conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$grade_conn) {
    die("Connection failed: " . mysqli_connect_error($grade_conn));
}

$year = date("Y");
$add_names = array($firstname,$lastname);
$stu_full_name = implode(' ', $add_names);
$stu_full_name = ucfirst($stu_full_name);
$othercost = 0;
$status = 0;

$tableName = "stupayment_".$year;

$sql = "INSERT INTO $tableName(fullname, sid, class) VALUES ('$stu_full_name', '$id', '$chosseclass')";
$result = mysqli_query($grade_conn, $sql) or die(mysqli_error());

for($i = 1; $i <= 12; i++){

}

  ?>