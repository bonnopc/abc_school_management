

<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}


else {
  include("dbconfig.php");

  $admin_id = $_SESSION['id'];
  $admin_pass = $_SESSION['pass'];

  $sql = "SELECT * FROM admin_login WHERE id = '$admin_id' AND pass = '$admin_pass' ";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {
    session_unset();
    session_destroy();
    header('Location: ../loginprocess.php');
  }
}
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add Student - ABC School</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('navigation.php'); ?>
        
        <!-- /page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Update Notice</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update your (published) Notice</h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php
                  	include_once("dbconfig.php");


					if (isset($_GET['submit'])) {
						$serial = $_GET['serial'];
						$submitaction = $_GET['submit'];
						if ($submitaction == 'delete') {
							$sql = "DELETE FROM notice WHERE sl = '$serial'";
                      		$result = mysqli_query($conn, $sql);
                      		if (mysqli_query($conn, $sql)) {
							    header('Location: notice_view.php');
							    exit();
							} else {
							    echo "Error deleting record: " . mysqli_error($conn);
							}
						}

						elseif ($submitaction == 'edit') {
							$sql = "SELECT * FROM notice WHERE sl = '$serial'";
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) > 0) {
							    
							    while($row = mysqli_fetch_assoc($result)) {
							        echo "<div class='x_content'>

                    <form class='form-horizontal form-label-left' action='noticeaction.php' method='POST' novalidate>
                    <center>
                      <h3>You are going to update the notice no:".$row['sl']."</h3>
                      </center><br><br>
                      <input type='hidden' name='serial' value='".$row['sl']."'>
                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='noticetitle'>Title <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input id='name' class='form-control col-md-7 col-xs-12' data-validate-length-range='6' data-validate-minmax='0,100' name='noticetitle' value='".$row['noticetitle']."' placeholder='Must be between 100 words' required='required' type='text'>
                        </div>
                      </div>

                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='noticedesc'>Description <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <textarea id='textarea' required='required' name='noticedesc' rows= '6' data-validate-minmax='0,5000' placeholder='Must be between 5000 words' class='form-control col-md-7 col-xs-12'>".$row['noticedesc']."</textarea>
                        </div>
                      </div>

                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='attachedfile'>Attach a File
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input id='file' class='form-control col-md-7 col-xs-12' name='attachedfile' type='file'>
                        </div>
                      </div>
                      
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-md-offset-3'>
                          <button id='send' type='submit' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>";
							    }
							} else {
							    header('Location: notice.php');
							    exit();
							}
							
						}
					}
					  ?>

                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include('footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->
  </body>
</html>