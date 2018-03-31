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

    <title>All Notices - ABC School</title>

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

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>NOTICES <small>UPDATED</small></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              

              

              

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>All Notices <small>Choose your action (Edit or Delete)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                      
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Updated Notices</th>
                          <th>Type</th>
                          <th>Updated By</th>
                          <th>Timestamp</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>

                      <?php
                      include_once("dbconfig.php");

                      $sql = "SELECT * FROM notice ORDER BY updatetime DESC";
                      $result = mysqli_query($conn, $sql);

                      $sql1 = "SELECT * FROM ";
                      $result1 = mysqli_query($conn, $sql1);

                      if (mysqli_num_rows($result) > 0)
                      {
                        while($row = mysqli_fetch_assoc($result))
                          {
                           //   foreach($row as $key => $value)
                            //  {
                                  echo "
                                  <tr>
                                    <td>".$row['sl']."</td>
                                    <td><b>".$row['noticetitle']."</b><br>";
                                    // Read More Break
                                    // strip tags to avoid breaking any html
                                    $string = strip_tags($row['noticedesc']);

                                    if (strlen($string) > 50) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 50);

                                        // make sure it ends in a word so assassinate doesn't become ass...
                                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a>Read More</a>'; 
                                    }
                                    echo $string."</td>
                                    <td>".$row['noticetype']."</td>
                                    <td>".$row['updatedby']."</td>
                                    <td>".$row['updatetime']."</td>
                                    <td>
                                    <form method='GET' action='notice_update.php'><center>
            <input type='hidden' name='serial' value='".$row['sl']."'>
            <button type='submit' name='submit' value='edit' class='btn btn-success btn-xs'>Edit</button>
            <button type='submit' name='submit' value='delete' class='btn btn-danger btn-xs'>Delete</button>
                                    </form></center>
                                    </td>
                                  
                                  </tr>";
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
    <script type="text/javascript">
      var sort_by = function(field, reverse, primer){

      var key = primer ? 
           function(x) {return primer(x[field])} : 
           function(x) {return x[field]};

      reverse = !reverse ? 1 : -1;

      return function (a, b) {
          return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
        } 
      }

      
    </script>
    <script type="text/javascript">
    row.sort(sort_by('$row['updatetime']', true, parseInt));
    </script>
  </body>
</html>