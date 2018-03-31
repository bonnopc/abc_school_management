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
$sql1 = "SELECT * FROM stuff_email WHERE id = '$admin_id'";
$result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

if (mysqli_num_rows($result1) <= 0){
  header('Location: setupEmail.php');
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

    <title>Messages - ABC School</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

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

            <div class="page-title">
              <div class="title_left">
                <h3>All Messages <small></small></h3>
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
              <div class="col-md-12">
                <div class="x_panel">
                <?php
                  if (isset($_GET['mail'])) {
                    if ($_GET['mail'] == 'send') {
                      echo "<div class='well'>
                              <center>
                              <h1>Your message has been sent successfully!</h1></center>
                          </div>";
                    }
                  }

                ?>
                  <div class="x_title">
                    <h2>Latest Conversation(s)</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-3 mail_list_column menu_fixed">
                        <button class="btn btn-sm btn-success btn-block" type="button" onclick="location.href='composeChoose.php'">COMPOSE</button>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
                        $sql1 = "SELECT * FROM messagebox WHERE mail_id_from = '$admin_id' OR mail_id_to = '$admin_id' ORDER BY fulltime DESC";
                        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

                        if (mysqli_num_rows($result1) > 0){
                          while ($row = mysqli_fetch_assoc($result1)) {
                            $msgTime = $row['fulltime'];
                            $msgFromID = $row['mail_id_from'];
                            $msgToID = $row['mail_id_to'];
                            $msgSubject = $row['subject'];
                            $msgBody = $row['body'];

                            echo "<a href='message.php?sl=".$row['sl']."'>
                          <div class='mail_list'>";

                          if ($row['mail_id_from'] == $admin_id) {
                            echo "<div class='left'>
                                    <i class='fa fa-circle'></i>
                                  </div>
                                  <div class='right'>
                                    <h3>".knowName($row['mail_id_to'])." <small>".substr($row['fulltime'], 0, -9)."</small></h3>
                                    <p><strong>".$row['subject']."</strong> - ";

                                    // Read More Break
                                    $string = strip_tags($row['body']);

                                    if (strlen($string) > 50) {
                                      $stringCut = substr($string, 0, 50);

                                      $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
                                    }
                                    echo $string."</p>
                                  </div>";
                          } else {
                            echo "<div class='left'>
                                    <i class='fa fa-circle-o'></i>
                                  </div>
                                  <div class='right'>
                                    <h3>".knowName($row['mail_id_from'])." <small>".substr($row['fulltime'], 0, -9)."</small></h3>
                                      <p><strong>".$row['subject']."</strong> - ";

                                    // Read More Break
                                    $string = strip_tags($row['body']);

                                    if (strlen($string) > 50) {
                                      $stringCut = substr($string, 0, 50);

                                      $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
                                    }
                                    echo $string."</p>
                                  </div>";
                          }
                        echo  "</div>
                              </a>";
                          }
                        }

                          ?>
                          
                      </div>

                      <?php

                      if (isset($_GET['sl'])) {
                        $getSl = stripcslashes($_GET['sl']);
                        $getSl = mysqli_real_escape_string($conn, $_GET['sl']);

                        if (ctype_digit($getSl)) {
                          $sql = "SELECT * FROM messagebox WHERE sl = '$getSl'";
                          $result = mysqli_query($conn, $sql) or die(mysqli_error());
                        }
                      } else {
                        $sql = "SELECT * FROM messagebox WHERE mail_id_from = '$admin_id' OR mail_id_to = '$admin_id' ORDER BY fulltime DESC LIMIT 1";
                        $result = mysqli_query($conn, $sql) or die(mysqli_error());
                      }
                      if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              $msgTime = $row['fulltime'];
                              $msgFromID = $row['mail_id_from'];
                              $msgToID = $row['mail_id_to'];
                              $msgSubject = $row['subject'];
                              $msgBody = $row['body'];
                            }
                          }

                      if ($msgToID == $admin_id) {
                        $replyTo = $msgFromID;
                      } else {
                        $replyTo = $msgToID;
                      }


                        ?>

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                <button id="compose" class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date"> <?php echo $msgTime; ?></p>
                            </div>
                            <div class="col-md-12">
                              <h4> <?php echo $msgSubject; ?></h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                                <strong><?php knowName($msgFromID); ?> </strong> to
                                <strong><?php knowName($msgToID); ?></strong>
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                            <?php echo $msgBody; ?>
                          </div>
                          <div class="clearfix"></div><br><br>
                          <div class="btn-group">
                            <button id="compose" class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                            
                          </div>
                        </div>

                      </div>
                      <!-- /CONTENT MAIL -->
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

    <!-- compose -->
    <div class="compose col-md-6 col-xs-12">
      <form method="post">
      <div class="compose-header">
        Reply
        <button type="button" class="close compose-close">
          <span>×</span>
        </button>
      </div>

      <div class="compose-body">
        <input type="hidden" class="form-control" placeholder="Enter ID" name="id" value="<?php echo $replyTo; ?>" disabled>
        <?php echo "<h3> To : <strong>";
        knowName($replyTo);
        echo "</strong><br> ID : <strong>$replyTo</strong></h3>"; ?>
        <input type="text" class="form-control" placeholder="Pick a title" name="subject" required="required">
        <div id="alerts"></div>

        <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
          <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
            <ul class="dropdown-menu">
            </ul>
          </div>

          <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <a data-edit="fontSize 5">
                  <p style="font-size:17px">Huge</p>
                </a>
              </li>
              <li>
                <a data-edit="fontSize 3">
                  <p style="font-size:14px">Normal</p>
                </a>
              </li>
              <li>
                <a data-edit="fontSize 1">
                  <p style="font-size:11px">Small</p>
                </a>
              </li>
            </ul>
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
            <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
            <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
            <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
            <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
            <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
            <div class="dropdown-menu input-append">
              <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
              <button class="btn" type="button">Add</button>
            </div>
            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
          </div>
        </div>

        <div class="editor-wrapper">
        <textarea id="editor" class="form-control" name="body" placeholder="Enter your message..." required></textarea>
        </div>
      </div>

      <div class="compose-footer">
        <button id="send" class="btn btn-sm btn-success" type="submit">Send</button>
      </div>
      </form>
    </div>
    <!-- /compose -->

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- bootstrap-wysiwyg -->
    <script>
      $(document).ready(function() {
        function initToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
              'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
              'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          });
          $('a[title]').tooltip({
            container: 'body'
          });
          $('.dropdown-menu input').click(function() {
              return false;
            })
            .change(function() {
              $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function() {
              this.value = '';
              $(this).change();
            });

          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this),
              target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          });

          if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top,
              left: editorOffset.left + $('#editor').innerWidth() - 35
            });
          } else {
            $('.voiceBtn').hide();
          }
        }

        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        $('#editor').wysiwyg({
          fileUploadError: showErrorAlert
        });

        prettyPrint();
      });
    </script>
    <!-- /bootstrap-wysiwyg -->

    <!-- compose -->
    <script>
      $('#compose, .compose-close').click(function(){
        $('.compose').slideToggle();
      });
    </script>>
    <!-- /compose -->
  </body>
</html>