<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}

else {
  include("dbconfig.php");

  $id = $_SESSION['id'];
  $pass = $_SESSION['pass'];

  $sql = "SELECT * FROM stuff_login WHERE id = '$id' AND pass = '$pass' AND type = 'accounts' ";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {
    session_unset();
    session_destroy();
    header('Location: ../loginprocess.php');
  }
}

mysqli_close($conn);
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
                <h3>Fees Collection <small>Students</small></h3>
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
            <?php
            function ClassName($data){
              switch ($data) {
                case 'c06':
                  echo "Class 06";
                  return;
                
                case 'c07':
                  echo "Class 07";
                  return;

                case 'c08':
                  echo "Class 08";
                  return;

                case 'c09':
                  echo "Class 09";
                  return;

                case 'c10':
                  echo "Class 10";
                  return;
              }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if (isset($_POST['stufees'])) {
                $sid = $_POST['id'];

                include('dbconfig.php');

                $sql = "SELECT * FROM present_student WHERE sid = '$sid'";
                $result = mysqli_query($conn, $sql) or die(mysqli_error());

                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                    $stu_full_name = $row['fname']." ".$row['lname'];
                    $presentClass = $row['chooseclass'];
                    $presentAddress = $row['presentadrs'];
                  }
                  mysqli_close($conn);
                }
                else {
                  die("<h2>Invalid ID! <small><a href='collect_fees.php'>Go Back</a></small></h2>");
                } 
              }
            } else {
              die("<h2>Invalid User! <small><a href='collect_fees.php'>Go Back</a></small></h2>");
            }

              ?>

            <div class="row">
              <span class="section">2. Insert Transaction Info</span>
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2>Student Info</h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php
                  function paidORdue($data){
                    if ($data == 2) {
                      echo "";
                      return;
                    }
                    elseif ($data == 0) {
                      echo "<span class='label label-danger'>Fees Due</span>";
                      return;
                    }
                    else {
                      echo "<span class='label label-success'>Paid</span>";
                      return;
                    }
                  }
                  function measureMonth($data){
                    switch ($data) {
                      case 'c06':
                        $monthlyAmount = 600;
                        return $monthlyAmount;
                      
                      case 'c07':
                        $monthlyAmount = 700;
                        return $monthlyAmount;

                      case 'c08':
                        $monthlyAmount = 800;
                        return $monthlyAmount;

                      case 'c09':
                        $monthlyAmount = 900;
                        return $monthlyAmount;

                      case 'c10':
                        $monthlyAmount = 1000;
                        return $monthlyAmount;

                    }
                  }
                  $fake_id = 1;
                  $others = 5000;
                  $newyear = date("Y");
                  $measureTable = "stupayment_".$newyear;
                  $presentMonth = date('n');
                  $monthlyAmount = floatval(measureMonth($presentClass));

                  $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

                  mysqli_select_db($grade_conn, "abc_school_payments") or die ("no Database");

                  $sql = "SELECT * FROM $measureTable WHERE sid = '$fake_id'";
                  $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());


                  if(mysqli_num_rows($result) > 0){
                    
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-6 col-sm-12 col-xs-12'>
                              <h3><strong>$stu_full_name</strong><br></h3>
                              <h4>$sid<br>";
                            
                            
                            ClassName($presentClass);
                    echo "</h4>
                            </div>
                            <div class='col-md-6 col-sm-12 col-xs-12'>
                              <center><h4>To Be Paid</h4></center>
                              <table class='data table no-margin'>
                                <tbody>
                                  <tr>
                                    <td>Fees (Monthly)</td>
                                    <td>$monthlyAmount BDT</td>
                                  </tr>
                                  <tr>
                                    <td>Others (Annually)</td>
                                    <td>$others BDT</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class='x_title'>
                              <h2>Paid Fees</h2>
                            </div>
                            <table class='data table table-striped no-margin'>
                              <tbody>";
                              $totalDue = 0;
                              for ($i=1; $i <= 12 ; $i++) { 
                                $dateObj   = DateTime::createFromFormat('!m', $i);
                                $monthName = $dateObj->format('F');
                                $monthCol = "m".$i;
                                $condition = 2;
                                

                                if ($i <= $presentMonth) {
                                  $paidAmount = floatval($row[$monthCol]);
                                  if ($paidAmount < $monthlyAmount) {
                                    $condition = 0;
                                    $totalDue = $totalDue + ($monthlyAmount - $paidAmount);
                                  }
                                  else {
                                    $condition = 1;
                                  }
                                }
                                echo "<tr>
                                        <th>$monthName</th>
                                        <td>".$row[$monthCol]."</td><td><center>";
                                        paidORdue($condition);
                                echo "</center></td></tr>";
                              } 
                                
                                if ($row['othercost'] < $others) {
                                  $condition = 0;
                                  $totalDue = $totalDue + ($others - $row['othercost']);
                                }
                                else {
                                  $condition = 1;
                                } 
                                echo "<tr>
                                        <th>Others</th>
                                        <td>".$row['othercost']."</td><td><center>";
                                        paidORdue($condition);
                                echo "</center></td>
                                      </tr><tr>
                                      <th>Total Amount Due</th>
                                      <th>$totalDue</th><th><center>";
                                      paidORdue($condition);
                                echo "</center></th></tr></tbody>";

                                }
                              }


                    ?>
                      
                    </table>
                </div>
              </div>

              <div class="col-md-6 col-sm-12 col-xs-12">
              
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Enter New Transaction info</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="collect_fees_final.php" method="post" novalidate>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="number" name="amount" required="required" data-validate-minmax="1,<?php echo $totalDue; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <input type="hidden" name="fullname" value="<?php echo $stu_full_name; ?>">
                      <input type="hidden" name="sid" value="<?php echo $sid; ?>">
                      <input type="hidden" name="class" value="<?php echo $presentClass; ?>">
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
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
        <footer>
          <div class="pull-right">
            ABC School Web Application - Developed by Prosenjit Chowdhury.
          </div>
          <div class="clearfix"></div>
        </footer>
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