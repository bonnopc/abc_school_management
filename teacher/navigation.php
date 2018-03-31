<?php


// Echo the user's Full Name by providing their ID.
function knowName ($id) {

	$full_name = "N/A";
	$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
	$idLength = strlen($id);
	if ($idLength < 2) {
	$sql = "SELECT * FROM admin_login WHERE id = '$id'";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if (mysqli_num_rows($result) > 0) {
	  while ($row = mysqli_fetch_assoc($result)) {
	    $full_name = $row['adminname'];
	  }
	}
	} else if ($idLength < 6) {
	$sql = "SELECT * FROM present_stuff WHERE id = '$id'";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if (mysqli_num_rows($result) > 0) {
	  while ($row = mysqli_fetch_assoc($result)) {
	    $full_name = $row['fname']." ".$row['lname'];
	  }
	} 
	} else {
	$sql = "SELECT * FROM present_student WHERE sid = '$id'";
	$result = mysqli_query($conn, $sql) or die(mysqli_error());

	if (mysqli_num_rows($result) > 0) {
	  while ($row = mysqli_fetch_assoc($result)) {
	    $full_name = $row['fname']." ".$row['lname'];
	  }
	}
	}
	echo $full_name;
	return;
}

$conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
$sql1 = "SELECT * FROM stuff_email WHERE id = '$stuff_id'";
$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

if (mysqli_num_rows($result1) > 0){
	while ($row = mysqli_fetch_assoc($result1)) {
	    $stuff_email = $row['email'];
	    $stuff_pass = $row['pass'];
	    $emailServer = 1;
	}
} else {
	$emailServer = 0;
}

?>

<div data-spy="affix" data-offset-top="160">
	<nav class="navbar navbar-inverse">
	    <div class="collapse navbar-collapse" id="myNavbar">
	        <ul class="nav navbar-nav">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Academic <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    	<li><a href="noticeboard.php">NoticeBoard</a></li>
                       	<li><a href="student_all.php">All Students</a></li>
                       	<?php
                       	
                       	$sql = "SELECT * FROM subject_list WHERE teacher_id = '$stuff_id'";
                       	$result = mysqli_query($conn, $sql) or die(mysqli_error());

                       	if(mysqli_num_rows($result) > 0){
                       		echo "<li><a href='assignedSubjects.php'>Assigned Subjects</a></li>
                       		<li><a href='assignment.php'>Assignments</a></li>";
                       	}

		                $check_year = date("Y");
		                $sql = "SELECT * FROM class_teacher WHERE teacher_id = '$stuff_id' AND year = '$check_year'";
		                $result = mysqli_query($conn, $sql);

		                if (mysqli_num_rows($result) > 0) {
		                	echo "<li class='divider'></li>
		                	<li><a href='finalGrades.php'>Final Grades</a></li>";
		                }

		                  ?>
                    </ul>
                </li>
                
                <li><a href="payment_view.php">Payment History</a></li>
                
                <li><a href="contactList.php">Contact</a></li>
                
	        </ul>
	        <ul class="nav navbar-nav navbar-right">
                <li class="dropdown messageBox">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-envelope"></span>
                    <?php
                    if ($emailServer == 0) {
                    	echo "<span class='label label-danger label-as-badge'>!</span></a>
		                    <ul class='dropdown-menu'>
		                      <p class='notify'><small>This application requires your Google Account info to setup a Message Box for you.</small></p>
		                      <div class='whiteSpace'><a type='btn btn-primary' href='setupMail.php'><center>Set up Message box <span class='glyphicon glyphicon-chevron-right'></span></center></a></div>
		                    </ul>
		                    ";
                    } else {
                    	$sql = "SELECT * FROM messagebox WHERE mail_id_to = '$stuff_id' ORDER BY fulltime DESC";
						$result = mysqli_query($conn, $sql) or die(mysqli_error());

						if (mysqli_num_rows($result) > 0) {
						echo "<span class='label label-primary label-as-badge'>".mysqli_num_rows($result)."</span></a>
								<ul class='dropdown-menu'>";
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<li>
								<a href='message.php?sl=".$row['sl']."'>";
								knowName($row['mail_id_from']);
								
								echo "<br><strong>".$row['subject']."</strong><br>";
								// Read More Break
								// strip tags to avoid breaking any html
								$string = strip_tags($row['body']);

								if (strlen($string) > 30) {
								// truncate string
								$stringCut = substr($string, 0, 30);

								// make sure it ends in a word so assassinate doesn't become ass...
								$string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
								}
								echo $string."</a>
								</li>";
							}
			            			
						echo "<li class='divider'></li><li>
		                    	<a href='message.php'>
						              <strong>See All Messages</strong>
						              <span class='glyphicon glyphicon-chevron-right'></span>
						          </a>
					        </li></ul>";
						} else {
							echo "</a>";
						}
					}

                      ?>

                  
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="profile_view.php">View Profile</a></li>
                      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </li>
	        </ul>
    </nav>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		// get current URL path and assign 'active' class
		var pathname = window.location.pathname;
		$('.nav > li > a[href="'+pathname+'"]').parent().addClass('active');
	})
</script>