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
mysqli_close($conn);
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

    <title>Results- Class 06 - ABC School</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
        
<?php
include('navigation.php');

function passORfail($data){
  $data = floatval($data);
  if ($data >= 40) {
    $passed = "class = 'progress-bar progress-bar-success'  data-transitiongoal = $data";
    echo $passed;
    return;
  }
  else {
    $failed = "class='progress-bar progress-bar-danger'  data-transitiongoal = $data";
    echo $failed;
    return;
  }
}

function subjectGrades($subcode){
  $newyear = date("Y");
  $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

  mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");

  $sql = "SELECT * FROM $subcode WHERE year = '$newyear'";
  $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());;


  if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
  echo "
    <tr>
      <td>".$row['sl']."</td>
      <td>".$row['stu_full_name']."</td>
      <td>".$row['sid']."</td>
      <td>".$row['ct1']."</td>
      <td>".$row['ct2']."</td>
      <td>".$row['mid']."</td>
      <td>".$row['final']."</td>
      <td>".$row['assign']."</td>
      <td class='vertical-align-mid'>
        <div class='progress progress_sm'>
          <div ";
      passORfail($row['total']);
      echo "></div>
        </div>
        <small>Total Marks :".$row['total']."</small>
      </td>
      <td><center>
        <form action='stu_promote.php' method='post'>
          <input type='hidden' name='id' value='".$row['sid']."'>
          <button type='submit' name='admitsubmit' value='admitted' class='btn btn-success btn-xs'>Promote</button>
        </form></center>
      </td>
    </tr>";
    }
  }
  return;
}
  ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          
            <div class="page-title">
              <div class="title_left">
                <h3>Result Tables <small>Class 06</small></h3>
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

                    <h2><center>Class Teacher</center></h2>
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

                    $class_no = 6;
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
                <div class="x-panel">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Bangla (BNG06)</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">English (ENG06)</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Mathematics (MAT06)</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Genaral Science (SCI06)</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Social Science (SOC06)</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">All Subjects</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Full Name</th>
                                  <th>ID</th>
                                  <th>CT01</th>
                                  <th>CT02</th>
                                  <th>Mid Term</th>
                                  <th>Final Term</th>
                                  <th>Assignments</th>
                                  <th>Condition</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              subjectGrades('bng06');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <table id="datatable-responsive2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Full Name</th>
                                  <th>ID</th>
                                  <th>CT01</th>
                                  <th>CT02</th>
                                  <th>Mid Term</th>
                                  <th>Final Term</th>
                                  <th>Assignments</th>
                                  <th>Condition</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              subjectGrades('eng06');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                            <table id="datatable-responsive3" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Full Name</th>
                                  <th>ID</th>
                                  <th>CT01</th>
                                  <th>CT02</th>
                                  <th>Mid Term</th>
                                  <th>Final Term</th>
                                  <th>Assignments</th>
                                  <th>Condition</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              subjectGrades('mat06');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

                            <table id="datatable-responsive4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Full Name</th>
                                  <th>ID</th>
                                  <th>CT01</th>
                                  <th>CT02</th>
                                  <th>Mid Term</th>
                                  <th>Final Term</th>
                                  <th>Assignments</th>
                                  <th>Condition</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              subjectGrades('sci06');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">

                            <table id="datatable-responsive5" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Full Name</th>
                                  <th>ID</th>
                                  <th>CT01</th>
                                  <th>CT02</th>
                                  <th>Mid Term</th>
                                  <th>Final Term</th>
                                  <th>Assignments</th>
                                  <th>Condition</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              subjectGrades('soc06');
                                ?>
                              </tbody>
                            </table>

                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">

                            <table id="datatable-responsive6" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Full Name</th>
                                  <th>ID</th>
                                  <th>Bangla</th>
                                  <th>English</th>
                                  <th>Mathematics</th>
                                  <th>Social Science</th>
                                  <th>Genaral Science</th>
                                  <th>Condition</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              function stuCondition($sub1,$sub2,$sub3,$sub4,$sub5){
                                $sub1 = floatval($sub1);
                                $sub2 = floatval($sub2);
                                $sub3 = floatval($sub3);
                                $sub4 = floatval($sub4);
                                $sub5 = floatval($sub5);

                                $total = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;
                                $totalpercentage = $total * 0.2;

                                if ($sub1 >= 40 && $sub2 >= 40 && $sub3 >= 40 && $sub4 >= 40 && $sub5 >= 40) {
                                  echo "class = 'progress-bar progress-bar-success'  data-transitiongoal = $totalpercentage></div>
                                  </div>
                                  <small>Total Marks : $total ($totalpercentage %)</small>";
                                }

                                else {
                                  echo "class = 'progress-bar progress-bar-danger'  data-transitiongoal = $totalpercentage></div>
                                  </div>
                                  <small>Total Marks : $total ($totalpercentage %)</small>";
                                }
                              }

                              $newyear = date("Y");
                              $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

                              mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");

                              $sql = "
                              SELECT bng.stu_full_name as fullname, bng.sid as id, bng.total as bngTotal, eng.total as engTotal, mat.total as matTotal, soc.total as socTotal, sci.total as sciTotal
                              FROM bng06 bng
                              LEFT JOIN eng06 eng ON bng.sid = eng.sid
                              LEFT JOIN mat06 mat ON bng.sid = mat.sid
                              LEFT JOIN soc06 soc ON bng.sid = soc.sid
                              LEFT JOIN sci06 sci ON bng.sid = sci.sid
                              WHERE bng.year = '$newyear'";
                              $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());


                              if(mysqli_num_rows($result) > 0){
                                $sl = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <tr>
                                  <td>$sl</td>
                                  <td>".$row['fullname']."</td>
                                  <td>".$row['id']."</td>
                                  <td>".$row['bngTotal']."</td>
                                  <td>".$row['engTotal']."</td>
                                  <td>".$row['matTotal']."</td>
                                  <td>".$row['socTotal']."</td>
                                  <td>".$row['sciTotal']."</td>
                                  <td class='vertical-align-mid'>
                                    <div class='progress progress_sm'>
                                      <div ";
                                  stuCondition($row['bngTotal'], $row['engTotal'], $row['matTotal'], $row['socTotal'], $row['sciTotal']);
                                  echo "</td>
                                  <td><center>
                                    <form action='stu_promote.php' method='post'>
                                      <input type='hidden' name='id' value='".$row['id']."'>
                                      <button type='submit' name='admitsubmit' value='admitted' class='btn btn-success btn-xs'>Promote</button>
                                    </form></center>
                                  </td>
                                </tr>";
                                $sl++;
                              }
                            }

                                ?>
                              </tbody>
                            </table>

                          </div>
                        </div>
                      </div>
                </div>
                
              </div>
            </div>

            
          </div>
        </div>
        <!-- /page content -->
        <div class="clearfix"></div>

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
    <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
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

        $('#datatable-responsive1,#datatable-responsive2, #datatable-responsive3,#datatable-responsive4,#datatable-responsive5,#datatable-responsive6').DataTable();

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