<div data-spy="affix" data-offset-top="160">
	    <nav class="navbar navbar-inverse">
	            <div class="collapse navbar-collapse" id="myNavbar">
	              <ul class="nav navbar-nav">
	                <li><a href="dashboard.php">Dashboard</a></li>
	                  <li><a href="noticeboard.php">Notice Board</a></li>
	                  <li><a href="payment_view.php">Payment History</a></li>
	                  <li class="dropdown">
	                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Academic <span class="caret"></span></a>
	                      <ul class="dropdown-menu">
	                        <li><a href="result.php">Results</a></li>
	                        <li><a href="assignment.php">Assignments</a></li>
	                        <li><a href="course_material.php">Resources</a></li>
	                      </ul>
	                  </li>
	                  <li><a href="contact.php">Contact</a></li>
	              </ul>
	              <ul class="nav navbar-nav navbar-right">
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