<?php
session_start();

include("student/dbconfig.php");

if (isset($_SESSION["categoryErr"])) {
        header('Location: index.php');;
    }
    else{
        echo "No";
    }


  ?>
