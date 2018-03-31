<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc_school_grades";

// Create connection
$grade_conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$grade_conn) {
    die("Connection failed: " . mysqli_connect_error($grade_conn));
}
?>