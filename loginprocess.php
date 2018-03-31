<?php
session_start();
  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Invalid Login!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container index">
    <header>
        <center>
            <img class="img-responsive" src="files/abc_logo.png" alt="ABC School Logo" width="100" height="75">
            <h1><strong>ABC SCHOOL</strong></h1>
            <h4>School Management Application</h4>
        </center>
    </header>

    <article>

        <?php



    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /**
      if (empty($_POST["id"])) {
        $_SESSION['idErr'] = "* ID is required";
        header('Location: loginerror.php');

      }
      elseif (empty($_POST["pass"])) {
        $_SESSION['passErr'] = "* Password is required";
        header('Location: loginerror.php');

      }
      elseif (empty($_POST["category"])) {
        $_SESSION["categoryErr"] = "* Category is required";
        header('Location: loginerror.php');

      }

      else {
        */
        include("student/dbconfig.php");
        $id = test_input($_POST["id"]);
        $pass = test_input($_POST["pass"]);
        $category = test_input($_POST["category"]);

        

        switch ($category) {
            case 'student':
                $result = mysqli_query($conn, "SELECT * FROM stu_login WHERE id='$id' AND pass='$pass' ")
                        or die("Could not execute the select query.");
            
                $row = mysqli_fetch_assoc($result);
                    
                if(is_array($row) && !empty($row)) {
                        $validuser = $row['id'];
                        $_SESSION['valid'] = $validuser;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['pass'] = $row['pass'];
                        $_SESSION['category'] = $category;
                } else {
                        echo "<center><h1>Invalid ID or Password.</h1><br><a href='index.php'>Try Again</a>";
                    }

                if(isset($_SESSION['valid'])) {
                        header('Location: student/dashboard.php');          
                    }
                break;
            
            case 'admin':
                $result = mysqli_query($conn, "SELECT * FROM admin_login WHERE id='$id' AND pass='$pass' ")
                        or die("Could not execute the select query.");
            
                $row = mysqli_fetch_assoc($result);
                    
                if(is_array($row) && !empty($row)) {
                        $validuser = $row['id'];
                        $_SESSION['valid'] = $validuser;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['pass'] = $row['pass'];
                        $_SESSION['category'] = $category;
                } else {
                        echo "<center><h1>Invalid ID or Password.</h1><br><a href='index.php'>Try Again</a>";
                    }

                if(isset($_SESSION['valid'])) {
                        header('Location: admin/dashboard.php');          
                    }
                break;

            case 'teacher':
                $result = mysqli_query($conn, "SELECT * FROM stuff_login WHERE id='$id' AND pass='$pass' AND type = 'teacher'")
                        or die("Could not execute the select query.");
            
                $row = mysqli_fetch_assoc($result);
                    
                if(is_array($row) && !empty($row)) {
                        $validuser = $row['id'];
                        $_SESSION['valid'] = $validuser;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['pass'] = $row['pass'];
                        $_SESSION['category'] = $category;
                } else {
                        echo "<center><h1>Invalid ID or Password.</h1><br><a href='index.php' role='button'><span class='glyphicon glyphicon-chevron-left'></span> Try Again</a>";
                    }

                if(isset($_SESSION['valid'])) {
                        header('Location: teacher/dashboard.php');          
                    }
                break;

            case 'accounts':
                $result = "SELECT * FROM stuff_login WHERE id='$id' AND pass='$pass' AND type = 'accounts'"
                        or die("Could not execute the select query.");
                $sql = mysqli_query($conn, $result);
                    
                $row = mysqli_fetch_assoc($sql);
                    
                if(is_array($row) && !empty($row)) {
                        $validuser = $row['id'];
                        $_SESSION['valid'] = $validuser;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['pass'] = $row['pass'];
                        $_SESSION['category'] = $category;
                } else {
                        echo "<center><h1>Invalid ID or Password.</h1><br><a href='index.php' role='button'><span class='glyphicon glyphicon-chevron-left'></span> Try Again</a><br><br><br>";
                    }

                if(isset($_SESSION['valid'])) {
                        header('Location: accounts/dashboard.php');          
                    }
                break;

            default:
                echo "<center><h1>Your Login is invalid</h1><br><a href='index.php' role='button'><span class='glyphicon glyphicon-chevron-left'></span> Try Again</a><br><br><br>";
                break;

            $_SESSION['id'] = $id;
            $_SESSION['pass'] = $pass;
        }

        /**
        $_SESSION['id'] = $id;
        $_SESSION['pass'] = $pass;
        $_SESSION['category'] = $category;

        if (isset($_SESSION['id'])) {
            echo "Yes";
        }
        else{
            echo "No";
        }
        exit(); */
      }
    

    else {
        echo "<center><h1>You are not allowed to view this page.</h1><br><a href='index.php' type='button btn-lg' role='button'><span class='glyphicon glyphicon-chevron-left'></span> Home</a><br><br><br>";
        session_unset();
        session_destroy();
    }


    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }



      ?>

    </article>
    <footer>
    <p>Copyright 1999-2016. All Rights Reserved.</p>
    </footer>
</div>
</body>
</html>


