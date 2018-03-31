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

    <title>Payments - Stuff - ABC School</title>

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

function paidORdue($data){
  if ($data == 0) {
    echo "<span class='label label-danger'>Payment Due</span>";
    return;
  }
  else {
    echo "<span class='label label-success'>Paid</span>";
    return;
  }
}

function paymentTable($type){
  $newyear = date("Y");
  $measureTable = "employeepayment".$newyear;
  $presentMonth = date('n');
  echo "<tr>
        <th>ID</th>
        <th>Full Name<br><small>with Designation</small></th>";
    for($i = 1; $i <= $presentMonth; $i++){
    $dateObj   = DateTime::createFromFormat('!m', $i);
    $monthName = $dateObj->format('M');
    echo "<td>$monthName</td>";
    }
    echo "<th>Other Cost</th>
          <th>Status</th>
          <th>Action</th>
          </tr>
          </thead>
          <tbody>";

  $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

  mysqli_select_db($grade_conn, "abc_school_payments") or die ("no Database");

  $sql = "SELECT * FROM $measureTable WHERE type = '$type'";
  $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());


  if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
  echo "
    <tr>
      <td>".$row['stuff_id']."</td>
      <td>".$row['stuff_name']."<br><small>".$row['stuff_designation']."</small></td>";
  
  $totalDue = 0;
  for($i = 1; $i <= $presentMonth; $i++){
    $monthNo = "m".$i;
    echo "<td>".$row[$monthNo]."</td>";
    $paidAmount = floatval($row[$monthNo]);
    if ($paidAmount < $row['salary']) {
      $condition = 0;
      $totalDue = $totalDue + ($row['salary'] - $paidAmount);
    }
    else {
      $condition = 1;
    }
  }

  echo "<td>".$row['others']."</td>
      <td class='vertical-align-mid'><center>";
      paidORdue($condition);
  echo "<br><small>Total amount due : BDT ".$totalDue."</small>
      </center></td>
      <td><center>
        <form action='stu_promote.php' method='post'>
          <input type='hidden' name='id' value='".$row['stuff_id']."'>
          <button type='submit' name='admitsubmit' value='admitted' class='btn btn-success btn-xs'>Message</button>
        </form></center>
      </td>
    </tr></tbody>";
    }
  }
  else {
    echo "<center>No data available</center><br>";
  }
  return;
}
  ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Payments <small>Students</small></h3>
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
                <div class="x-panel">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Teaching Stuff</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Genaral Stuff</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <?php
                              paymentTable('teaching');
                                ?>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <table id="datatable-responsive2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              
                              <?php
                              paymentTable('genaral');
                                ?>
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