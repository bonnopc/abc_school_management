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

if (isset($_POST['clsteach']) && isset($_POST['teacher'])) {
  $teacher_id = $_POST['teacher'];
  $class_no = $_POST['class'];
  if ($teacher_id == "") {
    switch ($class_no) {
      case '6':
        header("Location: stu_result_c06.php?error=empty");
        break;

      case '7':
        header("Location: stu_result_c07.php?error=empty");
        break;

      case '8':
        header("Location: stu_result_c08.php?error=empty");
        break;
      
      case '9':
        header("Location: stu_result_c09.php?error=empty");
        break;

      case '10':
        header("Location: stu_result_c10.php?error=empty");
        break;

      case 'admission':
        header("Location: applied_students.php?error=empty");
        break;
    }
  } else {
    $year = date("Y");
    include("dbconfig.php");
    $sql = "UPDATE class_teacher SET teacher_id = '$teacher_id' WHERE class_no = '$class_no' AND year = '$year'";
    if (mysqli_query($conn, $sql)) {
      switch ($class_no) {
        case '6':
          header("Location: stu_result_c06.php?success=added");
          break;

        case '7':
          header("Location: stu_result_c07.php?success=added");
          break;

        case '8':
          header("Location: stu_result_c08.php?success=added");
          break;
        
        case '9':
          header("Location: stu_result_c09.php?success=added");
          break;

        case '10':
          header("Location: stu_result_c10.php?success=added");
          break;

        case 'admission':
          header("Location: applied_students.php?success=added");
          break;
      }
    } else {
      die(mysqli_error());
    }
  }


}

  ?>

