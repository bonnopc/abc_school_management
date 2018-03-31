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
    header('Location: ../error_404.php');
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

    <title>Admin Panel - ABC School</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- FullCalendar -->
    <link href="../vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('navigation.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <?php
          if (isset($_GET['gmail'])) {
            if ($_GET['gmail'] == 'set') {
              echo "<div class='well'>
                      <center>
                      <h1>Congrats!</h1>
                      <p>Your email server has been set successfully!</p></center>
                  </div>";
            }
          }

            ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Dashboard <small>ABC School Management Application</small></h3>
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
                    <h2>Results</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="row">

                      <div class="col-md-12">

                        <!-- element -->
                        <div class="col-md-1 col-sm-6 col-xs-12" style="width: 19.999999995%">
                          <div class="pricing">
                            <div class="title">
                              <h1>Class 06</h1>
                              <h7>
                                <?php
                                  include("dbconfig.php");
                                  $year = date("Y");
                                  $sql1 = "SELECT * FROM class06 WHERE year = '$year' ";
                                  $result1 = mysqli_query($conn, $sql1);

                                  if (mysqli_num_rows($result1) > 0)
                                  {
                                    $allstu06 = mysqli_num_rows($result1);
                                    echo "Total Students : $allstu06";
                                  }
                                  else {
                                    echo("Error description: " . mysqli_error($conn));
                                  }

                                    ?>
                              </h7>
                            </div>
                            <div class="pricing_footer">
                                <p>
                                  <a href="javascript:void(0);">Payments</a>
                                </p>
                                <a href="stu_result_c06.php" class="btn btn-success btn-block" role="button">View Results</a>
                                
                            </div>
                          </div>
                        </div>
                        <!-- element -->
                        <!-- element -->
                        <div class="col-md-1 col-sm-6 col-xs-12" style="width: 19.999999995%">
                          <div class="pricing">
                            <div class="title">
                              <h1>Class 07</h1>
                              <h7>
                                <?php
                                $sql2 = "SELECT * FROM class07 WHERE year = '$year' ";
                                  $result2 = mysqli_query($conn, $sql2);

                                  if (mysqli_num_rows($result2) > 0)
                                  {
                                    $allstu07 = mysqli_num_rows($result2);
                                    echo "Total Students : $allstu07";
                                  }
                                  else {
                                    echo("Error description: " . mysqli_error($conn));
                                  }
                                  ?>
                              </h7>
                            </div>
                            <div class="pricing_footer">
                                <p>
                                  <a href="javascript:void(0);">Payments</a>
                                </p>
                                <a href="stu_result_c07.php" class="btn btn-success btn-block" role="button">View Results</a>
                                
                            </div>
                          </div>
                        </div>
                        <!-- element -->

                        <!-- element -->
                        <div class="col-md-1 col-sm-6 col-xs-12" style="width: 19.999999995%">
                          <div class="pricing">
                            <div class="title">
                              <h1>Class 08</h1>
                              <h7>
                                <?php
                                $sql3 = "SELECT * FROM class08 WHERE year = '$year' ";
                                $result3 = mysqli_query($conn, $sql3);

                                if (mysqli_num_rows($result3) > 0)
                                {
                                  $allstu08 = mysqli_num_rows($result3);
                                  echo "Total Students : $allstu08";
                                }
                                else {
                                  echo("Error description: " . mysqli_error($conn));
                                }
                                  ?>
                              </h7>
                            </div>
                            <div class="pricing_footer">
                                <p>
                                  <a href="javascript:void(0);">Payments</a>
                                </p>
                                <a href="stu_result_c08.php" class="btn btn-success btn-block" role="button">View Results</a>
                                
                            </div>
                          </div>
                        </div>
                        <!-- element -->

                        <!-- element -->
                        <div class="col-md-1 col-sm-6 col-xs-12" style="width: 19.999999995%">
                          <div class="pricing">
                            <div class="title">
                              <h1>Class 09</h1>
                              <h7>
                                <?php
                                $sql4 = "SELECT * FROM class09 WHERE year = '$year' ";
                                $result4 = mysqli_query($conn, $sql4);

                                if (mysqli_num_rows($result4) > 0)
                                {
                                  $allstu09 = mysqli_num_rows($result4);
                                  echo "Total Students : $allstu09";
                                }
                                else {
                                  echo("Error description: " . mysqli_error($conn));
                                }
                                ?>
                              </h7>
                            </div>
                            <div class="pricing_footer">
                                <p>
                                  <a href="javascript:void(0);">Payments</a>
                                </p>
                                <a href="stu_result_c09.php" class="btn btn-success btn-block" role="button">View Results</a>
                                
                            </div>
                          </div>
                        </div>
                        <!-- element -->

                        <!-- element -->
                        <div class="col-md-1 col-sm-6 col-xs-12" style="width: 19.999999995%">
                          <div class="pricing">
                            <div class="title">
                              <h1>Class 10</h1>
                              <h7>
                                <?php
                                $sql5 = "SELECT * FROM class10 WHERE year = '$year' ";
                                $result5 = mysqli_query($conn, $sql5);

                                if (mysqli_num_rows($result5) > 0)
                                {
                                  $allstu10 = mysqli_num_rows($result5);
                                  echo "Total Students : $allstu10";
                                }
                                else {
                                  echo("Error description: " . mysqli_error($conn));
                                }
                                ?>
                              </h7>
                            </div>
                            <div class="pricing_footer">
                                <p>
                                  <a href="javascript:void(0);">Payments</a>
                                </p>
                                <a href="stu_result_c10.php" class="btn btn-success btn-block" role="button">View Results</a>
                                
                            </div>
                          </div>
                        </div>
                        <!-- element -->


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <h4>Latest News</h4>
              <div class="well">Hooo</div>

              <h4>Quick Links</h4>
              <ul>
                <li><a href="notice.php">See all Notices</a></li>
                <li><a href="applied_students.php">All Aplicants</a></li>
                <li><b>Payments</b><ul>
                  <li><a href="stuff_payment.php">Stuffs</a></li>
                  <li><a href="stu_payment.php">Students</a></li>
                </ul></li>
              </ul>
            </div>

              <div class="col-md-4 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Calendar <small>Mark Your Day</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id='calendar'></div>

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

    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title2" name="title2">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->
        
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- FullCalendar -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- FullCalendar -->
    <script>
      $(window).load(function() {
        var date = new Date(),
            d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
            started,
            categoryClass;

        var calendar = $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          selectable: true,
          selectHelper: true,
          select: function(start, end, allDay) {
            $('#fc_create').click();

            started = start;
            ended = end;

            $(".antosubmit").on("click", function() {
              var title = $("#title").val();
              if (end) {
                ended = end;
              }

              categoryClass = $("#event_type").val();

              if (title) {
                calendar.fullCalendar('renderEvent', {
                    title: title,
                    start: started,
                    end: end,
                    allDay: allDay
                  },
                  true // make the event "stick"
                );
              }

              $('#title').val('');

              calendar.fullCalendar('unselect');

              $('.antoclose').click();

              return false;
            });
          },
          eventClick: function(calEvent, jsEvent, view) {
            $('#fc_edit').click();
            $('#title2').val(calEvent.title);

            categoryClass = $("#event_type").val();

            $(".antosubmit2").on("click", function() {
              calEvent.title = $("#title2").val();

              calendar.fullCalendar('updateEvent', calEvent);
              $('.antoclose2').click();
            });

            calendar.fullCalendar('unselect');
          },
          
          editable: true,
          events: [{
            title: 'All Day Event',
            start: new Date(y, m, 1)
          }, {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2)
          }, {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: false
          }, {
            title: 'Lunch',
            start: new Date(y, m, d + 14, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false
          }, {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false
          }, {
            title: 'Click for Google',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/'
          }]
        });
      });
    </script>
    <!-- /FullCalendar -->

    <!-- Today's applied students -->
    <script>
      Chart.defaults.global.legend = {
        enabled: false
      };

      // Line chart
      var ctx = document.getElementById("lineChart");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "My First dataset",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [31, 74, 6, 39, 20, 85, 7]
          }, {
            label: "My Second dataset",
            backgroundColor: "rgba(3, 88, 106, 0.3)",
            borderColor: "rgba(3, 88, 106, 0.70)",
            pointBorderColor: "rgba(3, 88, 106, 0.70)",
            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(151,187,205,1)",
            pointBorderWidth: 1,
            data: [82, 23, 66, 9, 99, 4, 2]
          }]
        },
      });

      // Bar chart
      var ctx = document.getElementById("mybarChart");
      var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: '# of Votes',
            backgroundColor: "#26B99A",
            data: [51, 30, 40, 28, 92, 50, 45]
          }, {
            label: '# of Votes',
            backgroundColor: "#03586A",
            data: [41, 56, 25, 48, 72, 34, 12]
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });

      // Doughnut chart
      var ctx = document.getElementById("canvasDoughnut");
      var data = {
        labels: [
          "Dark Grey",
          "Purple Color",
          "Gray Color",
          "Green Color",
          "Blue Color"
        ],
        datasets: [{
          data: [120, 50, 140, 180, 100],
          backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
          ],
          hoverBackgroundColor: [
            "#34495E",
            "#B370CF",
            "#CFD4D8",
            "#36CAAB",
            "#49A9EA"
          ]

        }]
      };

      var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data
      });

      // Radar chart
      var ctx = document.getElementById("canvasRadar");
      var data = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [{
          label: "My First dataset",
          backgroundColor: "rgba(3, 88, 106, 0.2)",
          borderColor: "rgba(3, 88, 106, 0.80)",
          pointBorderColor: "rgba(3, 88, 106, 0.80)",
          pointBackgroundColor: "rgba(3, 88, 106, 0.80)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          data: [65, 59, 90, 81, 56, 55, 40]
        }, {
          label: "My Second dataset",
          backgroundColor: "rgba(38, 185, 154, 0.2)",
          borderColor: "rgba(38, 185, 154, 0.85)",
          pointColor: "rgba(38, 185, 154, 0.85)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [28, 48, 40, 19, 96, 27, 100]
        }]
      };

      var canvasRadar = new Chart(ctx, {
        type: 'radar',
        data: data,
      });

      // Pie chart
      var ctx = document.getElementById("pieChart");
      var data = {
        datasets: [{
          data: [120, 50, 140, 180, 100],
          backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
          ],
          label: 'My dataset' // for legend
        }],
        labels: [
          "Dark Gray",
          "Purple",
          "Gray",
          "Green",
          "Blue"
        ]
      };

      var pieChart = new Chart(ctx, {
        data: data,
        type: 'pie',
        otpions: {
          legend: false
        }
      });

      // PolarArea chart
      var ctx = document.getElementById("polarArea");
      var data = {
        datasets: [{
          data: [120, 50, 140, 180, 100],
          backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
          ],
          label: 'My dataset'
        }],
        labels: [
          "Dark Gray",
          "Purple",
          "Gray",
          "Green",
          "Blue"
        ]
      };

      var polarArea = new Chart(ctx, {
        data: data,
        type: 'polarArea',
        options: {
          scale: {
            ticks: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
    <!-- Custom Notification -->
    <script>
      $(document).ready(function() {
        var cnt = 10;

        TabbedNotification = function(options) {
          var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title +
            "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

          if (!document.getElementById('custom_notifications')) {
            alert('doesnt exists');
          } else {
            $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
            $('#custom_notifications #notif-group').append(message);
            cnt++;
            CustomTabs(options);
          }
        };

        CustomTabs = function(options) {
          $('.tabbed_notifications > div').hide();
          $('.tabbed_notifications > div:first-of-type').show();
          $('#custom_notifications').removeClass('dsp_none');
          $('.notifications a').click(function(e) {
            e.preventDefault();
            var $this = $(this),
              tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
              others = $this.closest('li').siblings().children('a'),
              target = $this.attr('href');
            others.removeClass('active');
            $this.addClass('active');
            $(tabbed_notifications).children('div').hide();
            $(target).show();
          });
        };

        CustomTabs();

        var tabid = idname = '';

        $(document).on('click', '.notification_close', function(e) {
          idname = $(this).parent().parent().attr("id");
          tabid = idname.substr(-2);
          $('#ntf' + tabid).remove();
          $('#ntlink' + tabid).parent().remove();
          $('.notifications a').first().addClass('active');
          $('#notif-group div').first().css('display', 'block');
        });
      });
    </script>
    <!-- /Custom Notification -->
  </body>
</html>