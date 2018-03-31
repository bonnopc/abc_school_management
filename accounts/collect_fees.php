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

    <title>Fees - Student - ABC School</title>

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
    echo "<span class='label label-danger'>Fees Due</span>";
    return;
  }
  else {
    echo "<span class='label label-success'>Paid</span>";
    return;
  }
}

function paymentTable($classcode, $monthlyAmount){
  $newyear = date("Y");
  $measureTable = "stupayment_".$newyear;
  $presentMonth = date('n');
  $monthlyAmount = floatval($monthlyAmount);
  echo "<tr>
        <th>ID</th>
        <th>Full Name</th>";
    for($i = 1; $i <= $presentMonth; $i++){
    $dateObj   = DateTime::createFromFormat('!m', $i);
    $monthName = $dateObj->format('M');
    echo "<th>$monthName</th>";
    }
    echo "<th>Others</th>
          <th>Status</th>
          <th>Action</th>
          </tr>
          </thead>
          <tbody>";

  $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

  mysqli_select_db($grade_conn, "abc_school_payments") or die ("no Database");

  $sql = "SELECT * FROM $measureTable WHERE class = '$classcode'";
  $result = mysqli_query($grade_conn, $sql) or die(mysqli_error());;


  if(mysqli_num_rows($result) > 0){
    $sid = 170023;
  while ($row = mysqli_fetch_assoc($result)) {
  echo "
    <tr>
      <td>$sid</td>
      <td>".$row['fullname']."</td>";
  
  $totalDue = 0;
  for($i = 1; $i <= $presentMonth; $i++){
    $monthNo = "m".$i;
    echo "<td>".$row[$monthNo]."</td>";
    $paidAmount = floatval($row[$monthNo]);
    if ($paidAmount < $monthlyAmount) {
      $condition = 0;
      $totalDue = $totalDue + ($monthlyAmount - $paidAmount);
    }
    else {
      $condition = 1;
    }
  }

  echo "<td>".$row['othercost']."</td>
      <td class='vertical-align-mid'><center>";
      paidORdue($condition);
  echo "<br><small>Total amount due : BDT ".$totalDue."</small>
      </center></td>
      <td><center>
        <form action='collect_fees_form.php' method='post'>
          <input type='hidden' name='condition' value='$condition'>
          <input type='hidden' name='totalDue' value='$totalDue'>
          <input type='hidden' name='id' value='$sid'>
          <button type='submit' name='stufees' value='paynow' class='btn btn-success btn-xs'>Collect</button>
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
                <h3>Fees Collection <small>Students</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <span class="section">1. Explore Students Table</span>
                <div class="x-panel">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Class 06</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Class 07</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Class 08</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Class 09</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Class 10</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <?php
                              paymentTable('c06','600');
                                ?>
                            </table>
                              <div class="col-lg-12 col-xs-6">
                                <div class="col-lg-3 col-lg-push-9 col-md-2 col-md-push-0 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                                  <div class="pull-right">
                                    <center>
                                      <h3>To be Paid</h3>
                                      <ul>
                                        <li>Fees (monthly) - 1000 BDT</li>
                                        <li>Others (annually) - 5000 BDT</li>
                                      </ul>
                                    </center>
                                  </div>
                                </div>
                              </div>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <table id="datatable-responsive2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              
                              <?php
                              paymentTable('c07','700');
                                ?>
                            </table>
                            <div class="col-lg-12 col-xs-6">
                                <div class="col-lg-3 col-lg-push-9 col-md-2 col-md-push-0 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                                  <div class="pull-right">
                                    <center>
                                      <h3>To be Paid</h3>
                                      <ul>
                                        <li>Fees (monthly) - 1000 BDT</li>
                                        <li>Others (annually) - 5000 BDT</li>
                                      </ul>
                                    </center>
                                  </div>
                                </div>
                              </div>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                            <table id="datatable-responsive3" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                              <?php
                              paymentTable('c08','800');
                                ?>
                            
                            </table>
                            <div class="col-lg-12 col-xs-6">
                                <div class="col-lg-3 col-lg-push-9 col-md-2 col-md-push-0 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                                  <div class="pull-right">
                                    <center>
                                      <h3>To be Paid</h3>
                                      <ul>
                                        <li>Fees (monthly) - 1000 BDT</li>
                                        <li>Others (annually) - 5000 BDT</li>
                                      </ul>
                                    </center>
                                  </div>
                                </div>
                              </div>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

                            <table id="datatable-responsive4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              
                              <?php
                              paymentTable('c09','900');
                                ?>
                            
                            </table>
                            <div class="col-lg-12 col-xs-6">
                                <div class="col-lg-3 col-lg-push-9 col-md-2 col-md-push-0 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                                  <div class="pull-right">
                                    <center>
                                      <h3>To be Paid</h3>
                                      <ul>
                                        <li>Fees (monthly) - 1000 BDT</li>
                                        <li>Others (annually) - 5000 BDT</li>
                                      </ul>
                                    </center>
                                  </div>
                                </div>
                              </div>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">

                            <table id="datatable-responsive5" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              
                              <?php
                              paymentTable('c10','1000');
                                ?>
                           
                            </table>
                            <div class="col-lg-12 col-xs-6">
                                <div class="col-lg-3 col-lg-push-9 col-md-2 col-md-push-0 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                                  <div class="pull-right">
                                    <center>
                                      <h3>To be Paid</h3>
                                      <ul>
                                        <li>Fees (monthly) - 1000 BDT</li>
                                        <li>Others (annually) - 5000 BDT</li>
                                      </ul>
                                    </center>
                                  </div>
                                </div>
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