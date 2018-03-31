<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc_school_payments";

// Create connection
$pay_conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$pay_conn) {
    die("Connection failed: " . mysqli_connect_error($pay_conn));
}
?>