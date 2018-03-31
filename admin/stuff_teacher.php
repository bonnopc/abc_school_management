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

    <title>Teaching Stuffs - ABC School</title>

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
  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Teaching Stuffs <small>sorted by first name</small></h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <button onclick="location.href='assignSubject.php'" class='btn btn-round btn-primary btn-lg'>List of Assigned Teachers <i class='fa fa-angle-right'></i></button>
                </div>
              </div>
              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Email</th>
                          <th>Phone No</th>
                          <th>Gender</th>
                          <th>Birthday</th>
                          <th>Present Address</th>
                          <th>Assigned Subjects</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>

                      <?php
                      function assignedSubjects ($id){
                        $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
                        $sql = "SELECT * FROM subject_list WHERE teacher_id = '$id'";
                        $result = mysqli_query($conn, $sql) or die(mysqli_error());

                        if (mysqli_num_rows($result) > 0){
                          $allSubjects = "";
                          while($row = mysqli_fetch_assoc($result)){
                            $allSubjects .= $row['sub_id'].", ";
                          }
                        } else {
                          $allSubjects = "N/A";
                        }

                        echo $allSubjects;
                        return;
                      }

                      $year = date("y");
                      $long_year = date("Y");

                      include_once("dbconfig.php");

                      //$sql = mysql_query("SELECT admission.*, present_student.* FROM admission, present_student WHERE year='$year' AND admission.email != present_student.email");
                      //$sql = "SELECT a.* , p.email FROM admission a, present_student p ON a.email != p.email WHERE a.year = '$year'";
                      $sql = "SELECT * FROM present_stuff WHERE type = 'teacher' ORDER BY fname ASC";
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
                                    <td>".$row['id']."</td>
                                    <td>".$row['fname']." ".$row['lname']."</td>
                                    <td>".$row['designation']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['phone']."</td>
                                    <td>".$row['gender']."</td>
                                    <td>".$row['birthday']."</td>
                                    <td>".$row['presentadrs']."</td><td><center>";
                                    assignedSubjects($row['id']);
                              echo "<br><br>
                                      <form action='assignSubject.php' method='post'>
                                    <input type='hidden' value='".$row['id']."' name='id'>
                            <button type='submit' name='assign' value='subject' class='btn btn-success btn-xs'>Assign</button>
                                        </form></center></td><td><center>
                                    <form action='compose.php' method='post'>
                                    <input type='hidden' value='".$row['id']."' name='id'>
                            <button type='submit' name='message' value='stuff' class='btn btn-round btn-primary btn-xs'>Message</button>
                                        </form></center></td>
                                        </tr>
                                    ";

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