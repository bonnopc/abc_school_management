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

    <title>Applied Students - ABC School</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('navigation.php'); ?>
        
<?php
$newYear = date("Y");
$newYear+=1;

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
}

  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
            <?php
              if ($emailServer == 0) {
                die("<center><form action='setupEmail.php' method='post'>
        <button type='submit' name='setup' value='email' class='btn btn-danger btn-lg'>Setup Email</button>
        </form></center>");
              }

                ?>
              <div class="title_left">
                <h3>Applicants <small>Applied for Admission Test'<?php echo $newYear;?></small></h3>
              </div>



              
            </div>
            <div class="clearfix"></div>
            <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == 'empty') {
              echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Error!</strong> Please select any specific teacher to assign as a Class Teacher.
                  </div>";
            }
          }

          if (isset($_GET['success'])) {
            if ($_GET['success'] == 'added') {
              echo "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Done!</strong> You changes have been saved.
                  </div>";
            }
          }

            ?>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <h2><center>Assigned Teacher</center></h2>
                    <?php
                    function getTeacherName() {
                      $year = date("Y");
                      include("dbconfig.php");
                      $sql = "SELECT * FROM present_stuff WHERE id NOT IN (SELECT teacher_id FROM class_teacher WHERE year = '$year') AND type = 'teacher' ORDER BY fname ASC";
                      $result = mysqli_query($conn, $sql) or die(mysqli_error());

                      if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                          $id = $row['id'];
                          echo "<option value='$id'>".$row['fname']." ".$row['lname']." ($id)</option>";
                        }
                        return;
                      }
                    }

                    $class_no = 'admission';
                    include_once("dbconfig.php");
                    $sql = "SELECT * FROM class_teacher WHERE class_no = '$class_no'";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error());

                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)){
                        $teacher_id = $row['teacher_id'];
                        if ($teacher_id == 0 || $teacher_id == "") {
                          echo "<h3><center>Not Assigned</center></h3>";
                          echo "<form method='post' action='assignClassteacher.php' class='form-horizontal form-label-left' novalidate>
                          <div class='item form-group'>
                        <input type='hidden' name='class' value='$class_no'>
                        <label for='teacher' class='control-label col-md-3 col-sm-3 col-xs-12'>Assign a Class Teacher <span class='required'>*</span></label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select name='teacher' required='required' class='form-control col-md-7 col-xs-12'>
                            <option value=''>Choose a Teacher</option>";
                            getTeacherName();
                          echo "</select>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-12'>
                          <button id='send' type='submit' name='clsteach' value='assign' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                          </form>";
                        } else {
                          echo "<center><h3>";
                          knowName($teacher_id);
                          echo "<br><small>Stuff ID : $teacher_id</small></h3>
                          <button type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='.bs-example-modal-lg'>Change</button>
                            
                          </center>

                          <div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-hidden='true'>
                    <div class='modal-dialog modal-lg'>
                      <div class='modal-content'>

                        <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span>
                          </button>
                          <h4 class='modal-title' id='myModalLabel'>Change Class Teacher</h4>
                        </div>
                        <div class='modal-body'>
                          <h4>You're going to change the present class teacher of Class $class_no</h4>
                          <form method='post' action='assignClassteacher.php' class='form-horizontal form-label-left' novalidate>
                          <div class='item form-group'>
                        <input type='hidden' name='class' value='$class_no'>
                        <label for='teacher' class='control-label col-md-3 col-sm-3 col-xs-12'>Assign a Class Teacher <span class='required'>*</span></label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select name='teacher' required='required' class='form-control col-md-7 col-xs-12'>
                            <option value=''>Choose a Teacher</option>";
                            getTeacherName();
                          echo "</select>
                        </div>
                      </div>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                          <button type='submit' class='btn btn-primary' name='clsteach' value='assign'>Save changes</button>
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>";
                        }
                      }
                    }

                      ?>

                  </div>
                </div>
                <div class="x_panel">
                  
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Choosen Class</th>
                          <th>Email</th>
                          <th>Phone No</th>
                          <th>Gender</th>
                          <th>Birthday</th>
                          <th>Present Address</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>

                      <?php
                      $year = date("y");
                      $long_year = date("Y");

                      /*
                      function isSubmited($data) {
                        $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 
                        mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");

                        $sql = "SELECT * FROM admission_test WHERE email NOT IN (SELECT email FROM present_student) AND year='$year' ";
                        $result = mysqli_query($conn, $sql) or die(mysqli_error());

                      } */

                      include_once("dbconfig.php");

                      //$sql = mysql_query("SELECT admission.*, present_student.* FROM admission, present_student WHERE year='$year' AND admission.email != present_student.email");
                      //$sql = "SELECT a.* , p.email FROM admission a, present_student p ON a.email != p.email WHERE a.year = '$year'";
                      $sql = "SELECT * FROM admission WHERE email NOT IN (SELECT email FROM present_student) AND year='$year' ";
                      $result = mysqli_query($conn, $sql) or die(mysqli_error());

                      //$sql1 = "SELECT * FROM present_student WHERE year = '$long_year' ";
                      //$result1 = mysqli_query($conn, $sql1);

                      if (mysqli_num_rows($result) > 0)
                      {
                        $serial_no = 01;

                        //while($newrow = mysqli_fetch_assoc($result1)){
                        while($row = mysqli_fetch_assoc($result))
                          {
                            //if ($newrow['email'] != $row['email']) {
                              echo "
                                  <tr>
                                    <td>$serial_no</td>
                                    <td>".$row['fname']." ".$row['lname']."</td>
                                    <td>".$row['chooseclass']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['phoneno']."</td>
                                    <td>".$row['gender']."</td>
                                    <td>".$row['birthday']."</td>
                                    <td>".$row['presentadrs']."</td>
                                    <td><center>";

                                    if ($emailServer < 1) {
                                      echo "<form action='setupEmail.php' method='post'>
                                      <button type='submit' name='setup' value='email' class='btn btn-success btn-xs'>Setup Email</button>
                                      </form>";
                                    } else {
                                      echo "<form action='admitstudent.php' method='post'>
                                    <input type='hidden' value='".$row['chooseclass']."' name='chooseclass'>
                                    <input type='hidden' value='".$row['sl']."' name='sl'>
                            <button type='submit' name='admitsubmit' value='admitted' class='btn btn-success btn-xs'>Admit</button>
                                        </form>";
                                    }
                            
                            echo "</center></td>
                                  </tr>";

                                  /*
                                  if (isset($_POST['admitsubmit'])) {
                                    $_SESSION['sl'] = $row['sl'];
                                    $_SESSION['fname'] = $row['fname'];
                                    $_SESSION['lname'] = $row['lname'];
                                    $_SESSION['chooseclass'] = $row['chooseclass'];
                                    $_SESSION['email'] = $row['email'];
                                    $_SESSION['phoneno'] = $row['phoneno'];
                                    $_SESSION['gender'] = $row['gender'];
                                    $_SESSION['birthday'] = $row['birthday'];
                                    $_SESSION['fathersname'] = $row['fathersname'];
                                    $_SESSION['mothersname'] = $row['mothersname'];
                                    $_SESSION['presentadrs'] = $row['presentadrs'];
                                    $_SESSION['permanentadrs'] = $row['permanentadrs'];
                                    $_SESSION['photofile'] = $row['photofile'];
                                    $_SESSION['termsagreed'] = $row['termsagreed'];
                                    $_SESSION['paperfile'] = $row['paperfile'];
                                    $_SESSION['finalterms'] = $row['finalterms'];
                                    $_SESSION['year'] = $year;
                                  }
                                      */
                            $serial_no++;
                            }
                           //   foreach($row as $key => $value)
                            //  {
                                  
                        //  }
                      }
                    //}
                        ?>
                      </tbody>
                    </table>
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>