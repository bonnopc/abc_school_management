        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><img src="images/abc_logo.png" alt="ABC School" style="width:67px;height:45px;"><span>ABC School</span></a>
            </div>

            <div class="clearfix"></div>


            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="dashboard.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-user"></i> Stuffs <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="stuff_teacher.php">Teaching Stuffs</a></li>
                      <li><a href="stuff_genaral.php">Genaral Stuffs</a></li>
                      <li><a href="stuff_add.php">Stuff Registration</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-mortar-board"></i> Students <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a>Present Students<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="stu_c06_view.php">Class 06</a>
                            </li>
                            <li><a href="stu_c07_view.php">Class 07</a>
                            </li>
                            <li><a href="stu_c08_view.php">Class 08</a>
                            </li>
                            <li><a href="stu_c09_view.php">Class 09</a></li>
                            <li><a href="stu_c10_view.php">Class 10</a></li>
                          </ul>
                        </li>
                        <li><a href="applied_students.php">Applied Students</span></a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-calculator"></i> Payments <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="payments.php">Overview</a></li>
                      <li><a href="stuff_payment.php">Stuffs</a></li>
                      <li><a href="stu_payment.php">Students</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart"></i> Results <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="stu_result_c06.php">Class 06</a></li>
                      <li><a href="stu_result_c07.php">Class 07</a></li>
                      <li><a href="stu_result_c08.php">Class 08</a></li>
                      <li><a href="stu_result_c09.php">Class 09</a></li>
                      <li><a href="stu_result_c10.php">Class 10</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="notice_view.php"><i class="fa fa-bullhorn"></i> All Notices</a></li>
                  <li><a href="notice_add.php"><i class="fa fa-plus"></i> Publish Notice</a>
                  </li>
                  <li><a href="composeChoose.php"><i class="fa fa-pencil-square-o"></i> Send Message</a>
                  </li>
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="notice_view.php" data-toggle="tooltip" data-placement="top" title="All Notices">
                <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
              </a>
              <a href="composeChoose.php" data-toggle="tooltip" data-placement="top" title="Send Message">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              </a>
              <a href="message.php" data-toggle="tooltip" data-placement="top" title="Inbox">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
              </a>
              <a href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <?php
        
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

          ?>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/user.png" alt="">Admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
                $sql1 = "SELECT * FROM stuff_email WHERE id = '$admin_id'";
                $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

                if (mysqli_num_rows($result1) > 0){
                  while ($row = mysqli_fetch_assoc($result1)) {
                    $stuff_email = $row['email'];
                    $stuff_pass = $row['pass'];
                    $emailServer = 1;
                  }
                } else {
                  $emailServer = 0;
                  /*
                  die("<center><form action='setupEmail.php' method='post'>
            <button type='submit' name='setup' value='email' class='btn btn-danger btn-lg'>Setup Email</button>
            </form></center>"); */
                }

                  ?>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <?php
                    if ($emailServer == 0) {
                      echo "<span class='badge bg-red'>!</span></a>";
                      echo "<ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>
                              <li>
                                <div class='text-center'>
                                  <a href='setupEmail.php'>
                                    <i class='fa fa-info-circle'></i> To use our mail-messaging service, you have to setup your mail server by entering your Google account information.<br><br>
                                    <strong>Setup Mail Server Now</strong>
                                    <i class='fa fa-angle-right'></i>
                                  </a>
                                </div>
                              </li>
                            </ul>";
                    } else {
                      $sql = "SELECT * FROM messagebox WHERE mail_id_to = '$admin_id' ORDER BY fulltime DESC";
                      $result = mysqli_query($conn, $sql) or die(mysqli_error());

                      if (mysqli_num_rows($result) > 0) {
                        echo "<span class='badge bg-green'>".mysqli_num_rows($result)."</span></a>";
                        echo "<ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>";
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "<li>
                                  <a href='message.php?sl=".$row['sl']."'>
                                    <span>
                                      <span>";
                          knowName($row['mail_id_from']);
                          echo "</span>
                                      <span class='time'>".$row['fulltime']."</span>
                                    </span>
                                    <span class='message'>
                                      <strong>".$row['subject']."</strong><br>";

                                      // Read More Break
                                    $string = strip_tags($row['body']);

                                    if (strlen($string) > 50) {
                                      $stringCut = substr($string, 0, 50);

                                      $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
                                    }
                                    echo $string."
                                    </span>
                                  </a>
                                </li>";
                          
                        }
                        echo  "<li>
                                  <div class='text-center'>
                                    <a href='message.php'>
                                      <strong>See All Messages</strong>
                                      <i class='fa fa-angle-right'></i>
                                    </a>
                                  </div>
                                </li>
                              </ul>";
                      }

                      
                      

                    }

                      ?>
                    
                  
                  
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function toggleFullScreen() {
            if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
             (!document.mozFullScreen && !document.webkitIsFullScreen)) {
              if (document.documentElement.requestFullScreen) {  
                document.documentElement.requestFullScreen();  
              } else if (document.documentElement.mozRequestFullScreen) {  
                document.documentElement.mozRequestFullScreen();  
              } else if (document.documentElement.webkitRequestFullScreen) {  
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
              }  
            } else {  
              if (document.cancelFullScreen) {  
                document.cancelFullScreen();  
              } else if (document.mozCancelFullScreen) {  
                document.mozCancelFullScreen();  
              } else if (document.webkitCancelFullScreen) {  
                document.webkitCancelFullScreen();  
              }  
            }  
          })
        </script>