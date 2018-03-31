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

    <title>Add Stuff - ABC School</title>

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
        <?php include("navigation.php") ?>
        <!-- /page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
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
              die("<center><form action='setupEmail.php' method='post'>
        <button type='submit' name='setup' value='email' class='btn btn-danger btn-lg'>Setup Email</button>
        </form></center>");
            }

              ?>
              <div class="title_left">
                <h3>Add Stuff</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <form action="addStuffAction.php" method="post" class="form-horizontal form-label-left" novalidate>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fname">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="fname" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lname">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="lname" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Designation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="designation" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Gender <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="col-sm-4">
                                <label><input type="radio" name="gender" value="male"> Male</label>
                              </div>
                              <div class="col-sm-4">
                                <label><input type="radio" name="gender" value="female"> Female</label>
                              </div>
                              <div class="col-sm-4">
                                <label><input type="radio" name="gender" value="other"> Other</label>
                              </div>
                              </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="phone" required="required" data-validate-length-range="11" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="type" class="control-label col-md-3">Type <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="type" required="required" class="form-control col-md-7 col-xs-12">
                            <option value="">Choose a type</option>
                            <option value="teacher">Teacher</option>
                            <option value="accounts">Accounts</option>
                            <option value="genaral">Genaral</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="type" class="control-label col-md-3">Joining Month <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="joinmonth" required="required" class="form-control col-md-7 col-xs-12">
                            <option value="">Choose a month</option>
                            <?php
                            $prMonth = date('n');
                            for($i = $prMonth; $i <= 12; $i++){
                              $dateObj   = DateTime::createFromFormat('!m', $i);
                              $monthName = $dateObj->format('F');
                              echo "<option value='".$i."'>$monthName</option>";
                            }

                              ?>
                          </select>
                        </div>
                      </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" name="insert" value="stuff" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
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