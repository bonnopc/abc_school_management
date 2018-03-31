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

    <title>Choose Contact - ABC School</title>

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
    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

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
                <h3>All Contacts <small>(Choose any one & click on Message button)</small></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Stuffs<small>Sorted by First Name</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name<br><small>with Details</small></th>
                          <th>Phone No</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>

                      <?php
                      $year = date("y");
                      $long_year = date("Y");

                      include("dbconfig.php");

                      //$sql = mysql_query("SELECT admission.*, present_student.* FROM admission, present_student WHERE year='$year' AND admission.email != present_student.email");
                      //$sql = "SELECT a.* , p.email FROM admission a, present_student p ON a.email != p.email WHERE a.year = '$year'";
                      $sql = "SELECT * FROM present_stuff ORDER BY fname ASC";
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
                                    <td><strong>".$row['fname']." ".$row['lname']."</strong> <small>(".$row['id'].")<br>".$row['designation']."</small><br>".$row['email']."</td>
                                    <td>".$row['phone']."</td>
                                    <td><center>
                                    <form action='compose.php' method='post'>
                                    <input type='hidden' value='".$row['id']."' name='id'>
                            <button type='submit' name='message' value='stuff' class='btn btn-round btn-primary btn-xs'>Message</button>
                                        </form></center></td>
                                  </tr>";

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

              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Students<small>Choose any class from the tab below</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="x-panel">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation"><strong>Class </strong> </li>
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">06</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">07</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">08</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">09</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">10</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <?php
                          function showStudentList($id) {
                            $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
                            
                            $sql = "SELECT * FROM present_student 
                                    WHERE chooseclass = '$id'
                                    ORDER BY sid ASC";
                            $result = mysqli_query($conn, $sql) or die(mysqli_error());

                            if (mysqli_num_rows($result) > 0) {
                              while($row = mysqli_fetch_assoc($result)){
                                echo "
                                <tr>
                                  <td>".$row['sid']."</td>
                                  <td><strong>".$row['fname']." ".$row['lname']."</strong><br>".$row['email']."
                                  <br>".$row['presentadrs']."
                                  </td>
                                  <td>".$row['phoneno']."</td>
                                  <td><center>
                                    <form action='compose.php' method='post'>
                                    <input type='hidden' value='".$row['sid']."' name='id'>
                                    <button type='submit' name='message' value='student' class='btn btn-round btn-primary btn-xs'>Message</button>
                                    </form></center></td>
                                </tr>";
                              }
                            }


                          }

                            ?>

                            <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Full Name<br><small>with Details</small></th>
                                  <th>Phone No</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              
                              <?php
                              showStudentList('c06');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <table id="datatable-responsive2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Full Name<br><small>with Details</small></th>
                                  <th>Phone No</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              showStudentList('c07');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                            <table id="datatable-responsive3" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Full Name<br><small>with Details</small></th>
                                  <th>Phone No</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              showStudentList('c08');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

                            <table id="datatable-responsive4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Full Name<br><small>with Details</small></th>
                                  <th>Phone No</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              showStudentList('c09');
                                ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">

                            <table id="datatable-responsive5" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Full Name<br><small>with Details</small></th>
                                  <th>Phone No</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              showStudentList('c10');
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
    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

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

        $('#datatable-responsive,#datatable-responsive1,#datatable-responsive2, #datatable-responsive3,#datatable-responsive4,#datatable-responsive5,#datatable-responsive6').DataTable();

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