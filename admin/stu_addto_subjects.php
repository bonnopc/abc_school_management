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

$year = date("Y");
$add_names = array($firstname,$lastname);
$stu_full_name = implode(' ', $add_names);
$stu_full_name = ucfirst($stu_full_name);

switch ($chooseclass) {
		case 'c06':
			if (!mysqli_query($grade_conn,"INSERT INTO bng06 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO eng06 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO soc06 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO sci06 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO mat06 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}
			break;

		case 'c07':
			if (!mysqli_query($grade_conn,"INSERT INTO bng07 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO eng07 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO soc07 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO sci07 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO mat07 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}
			break;

		case 'c08':
			if (!mysqli_query($grade_conn,"INSERT INTO bng08 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO eng08 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO soc08 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO sci08 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO mat08 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}
			break;

		case 'c09':
			if (!mysqli_query($grade_conn,"INSERT INTO bng09 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO eng09 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO soc09 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO sci09 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO mat09 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}
			break;
		
		case 'c10':
			if (!mysqli_query($grade_conn,"INSERT INTO bng10 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO eng10 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO soc10 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO sci10 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}

			if (!mysqli_query($grade_conn,"INSERT INTO mat10 (year, stu_full_name, sid) VALUES ('$year', '$stu_full_name', '$id')"))
			{
			  echo("Error description: " . mysqli_error($grade_conn));
			}
    		break;
		
		default:
			echo "Nothing Happened!";
			break;
	}

mysqli_close($grade_conn);

  ?>