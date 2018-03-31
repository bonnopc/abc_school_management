<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}
else {
  include("dbconfig.php");

  $stuff_id = $_SESSION['id'];
  $sql = "SELECT * FROM stuff_login WHERE id = '$stuff_id' AND type = 'teacher'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {
    session_unset();
    session_destroy();
    mysqli_close($conn);
    header('Location: ../loginprocess.php');
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
      $stuffName = $row['fname']." ".$row['lname'];
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages - ABC School</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<?php include('pageTitle.php'); ?>

<div class="container">
<?php include('navigation.php'); ?>
  
  
<article>
<?php
function checkDataLimit($data){
  switch ($data) {
    case '100':
      echo "<option value='message.php?l=100'>100</option>
          <option value='message.php?l=50'>50</option>
          <option value='message.php?l=30'>30</option>
          <option value='message.php?l=10'>10</option>";
      return;

    case '50':
      echo "<option value='message.php?l=50'>50</option>
          <option value='message.php?l=30'>30</option>
          <option value='message.php?l=10'>10</option>
          <option value='message.php?l=100'>100</option>";
      return;
    
    case '30':
      echo "<option value='message.php?l=30'>30</option>
          <option value='message.php?l=10'>10</option>
          <option value='message.php?l=50'>50</option>
          <option value='message.php?l=100'>100</option>";
      return;

    case '10':
      echo "<option value='message.php?l=10'>10</option>
          <option value='message.php?l=30'>30</option>
          <option value='message.php?l=50'>50</option>
          <option value='message.php?l=100'>100</option>";
      return;
  }
}

  ?>
<br>
<button onclick="window.location.href='contactList.php';" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-edit"></span> Compose</button><br><br>
<form>
  <div class="input-group">
    <p>Showing &nbsp;&nbsp;</p> 
    <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none; padding-bottom: 5px;"></span>
    <select class="form-control input-sm" onchange="location = this.options[this.selectedIndex].value;">
      <?php
      $l = 10;
      if (isset($_GET['l'])) {
        $l = $_GET['l'];
      }
      checkDataLimit($l);
      ?>
    </select>
    <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span> 
    <p>&nbsp;&nbsp; Messages</p>
  </div>
</form>


<div class="col-md-4 col-sm-12">


  <div class="table-responsive">          
  <table class="table table-bordered table-condensed message-row">
    
    <tbody>
        <?php

          
          $conn = mysqli_connect("localhost", "root", "", "abc_school") or die(mysqli_error());
          $sql1 = "SELECT * FROM messagebox WHERE mail_id_from = '$stuff_id' OR mail_id_to = '$stuff_id' ORDER BY fulltime DESC LIMIT $l";
          $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

          if (mysqli_num_rows($result1) > 0){

            while($row = mysqli_fetch_assoc($result1)) {
              echo "<tr><td>
              <a href='message.php?sl=".$row['sl']."'>";

              if ($row['mail_id_from'] == $stuff_id) {
                echo "<span class='glyphicon glyphicon-circle-arrow-left'></span> ";
                knowName($row['mail_id_to']);
              } else {
                echo "<span class='glyphicon glyphicon-circle-arrow-right'></span> ";
                knowName($row['mail_id_from']);
              } 
              echo "<br><strong>".$row['subject']."</strong><br><small>".$row['fulltime']."</small><br>";
              // Read More Break
              // strip tags to avoid breaking any html
              $string = strip_tags($row['body']);

              if (strlen($string) > 30) {
                // truncate string
                $stringCut = substr($string, 0, 30);

                // make sure it ends in a word so assassinate doesn't become ass...
                $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
              }
              echo $string."</a></td></tr>"; 
            }
          }
          else {
            echo "<tr><td colspan='5'><center>There is no message to show</center></td></tr>";
          }

        
          ?>
    </tbody>
  </table>
  </div>
</div>
<div class="col-md-8 col-sm-12">
  <table class="table table-bordered">
    <tbody>
      <?php
      if (isset($_GET['sl'])) {
        $sl = $_GET['sl'];
        $sql = "SELECT * FROM messagebox WHERE sl = '$sl' AND mail_id_from = '$stuff_id' OR mail_id_to = '$stuff_id'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        
      } else {
        $sql = "SELECT * FROM messagebox WHERE mail_id_from = '$stuff_id' OR mail_id_to = '$stuff_id' ORDER BY fulltime DESC LIMIT 1";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
      }

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $msgFromID = $row['mail_id_from'];
          $msgToID = $row['mail_id_to'];
          $msgSubject = $row['subject'];
          $msgBody = $row['body'];
          $msgTime = $row['fulltime'];
        }
      }

      if ($msgFromID == $stuff_id) {
        $replyTo = $msgToID;
      } else {
        $replyTo = $msgFromID;
      }

        ?>
      <tr>
        <td>
          <h3><strong><?php echo $msgSubject; ?></strong></h3>
          <div class="pull-right"><?php echo $msgTime; ?></div>
          <p><strong><?php knowName($msgFromID); ?></strong> to <strong><?php knowName($msgToID); ?></strong></p>
          <br>
          <p><?php echo $msgBody; ?></p>

        </td>
      </tr>

    </tbody>
  </table>
      <div class="pull-right">
        <a href="contact.php?id=<?php echo $replyTo; ?>" class="btn btn-primary not"><span class="glyphicon glyphicon-send"></span> Reply</a><br><br>
      </div>
</div>
  
</article>
</div>
<br>
<?php include('pageFooter.php'); ?>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>