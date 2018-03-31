<?php
session_start();
/*
$file = fopen("files/admission.txt","r") or die("unable to open file!");
    $i = 1;
    while(!feof($file)){
        if($i==1){
        $_SESSION["id"] = fgets($file);
        }
        $i++;
        }
    fclose($file);
    */
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admission - ABC School</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../style.css">
    
    
</head>

<body>
<div class="pagetitle">
    <span>
        <center>
        <a href="../index.php">
            <img class="img-responsive" src="../files/abc_logo.png" alt="ABC School Logo" width="100" height="75">
            <h1><strong>ABC SCHOOL</strong></h1>
            <h4>School Management Application</h4>
        </a>
        </center>
    </span>
</div>

<div class="container">
<article>
<br>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $uploadOk = 1;
        if($_POST['captcha'] != $_SESSION['digit']) die("<h3><center>Sorry, the CAPTCHA code entered was incorrect! <br><br><a href='../index.php' role='button'><span class='glyphicon glyphicon-chevron-left'></span> Try Again</a></center></h3><br><br><br>");

        echo "<div class='well'><center>";

        // Photo Varification
        //$photofile = $_POST['photofile'];
        //$photofile = basename($_FILES['photofile']['tmp_name']);
       // $photofile = addslashes(file_get_contents($_FILES['photofile']['tmp_name']));

        $check = getimagesize($_FILES["photofile"]["tmp_name"]);
        if($check == false) {
            echo "<p>You have uploaded an invalid image file.</p>";
            $uploadOk = 0;
        }

        if ($_FILES["photofile"]["size"] > 200000000) {
            echo "<p>Sorry, your file is too large. Please upload a image file less than 2MB.</p>";
            $uploadOk = 0;
        }

        $imagename = $_FILES["photofile"]["name"];
        $ext = end((explode(".", $imagename)));
        $ext = strtolower($ext);

        if ($ext != "jpeg" && $ext != "jpg") {
            echo $ext;
            echo "<p>Sorry, only JPG or JPEG files are allowed.</p>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your image file was not uploaded! Check the issues are mentioned above & Try again...<br><br><br><a href='../index.php' class='btn btn-default'>Go Back</a>";
        }
        else {
            echo "<h2>Congrats!</h2></center><br><br><p>You'll be informed through your mail about the schedule of Admission Test & next procedure to get admitted at ABC School.</p>";
            $year = $_SESSION['year'];
            $fname = ucfirst($_SESSION['fname']);
            $lname = ucfirst($_SESSION['lname']);
            $chooseclass = $_SESSION['chooseclass'];
            $email = $_SESSION['email'];
            $phoneno = $_SESSION['phoneno'];
            $gender = $_SESSION['gender'];
            $birthday = $_SESSION['birthday'];
            $termsagreed = $_SESSION['termsagreed'];
            $photofile = addslashes(file_get_contents($_FILES['photofile']['tmp_name']));
            $fathersname = $_POST['fathersname'];
            $mothersname = $_POST['mothersname'];
            $presentadrs = $_POST['presentadrs'];
            $permanentadrs = $_POST['permanentadrs'];
            $paperfile = addslashes(file_get_contents($_FILES['paperfile']['tmp_name']));
            $finalterms = $_POST['finalterms'];


            include("../student/dbconfig.php");
            
            $result = "INSERT INTO admission(year, fname, lname, chooseclass, email, phoneno, gender, birthday, photofile, termsagreed, fathersname, mothersname, presentadrs, permanentadrs, paperfile, finalterms) VALUES('$year','$fname','$lname', '$chooseclass' ,'$email', '$phoneno','$gender','$birthday','{$photofile}','$termsagreed','$fathersname','$mothersname','$presentadrs','$permanentadrs','{$paperfile}','$finalterms')";
            $result = mysqli_query($conn, $result) or die(mysqli_error());
            mysqli_close($conn);

            $grade_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 
            mysqli_select_db($grade_conn, "abc_school_grades") or die ("no Database");
            $year = date("Y");
            $fullName = $fname." ".$lname;
            $result = "INSERT INTO admission_test (year, stu_full_name, email) VALUES('$year', '$fullName', '$email')";
            $result = mysqli_query($grade_conn, $result) or die(mysqli_error());

            mysqli_close($grade_conn);
        }

        echo "</center></div>";
    }
}
else {
    echo "<center><h2>You are not allowed to view this page!</h2><br><br>
    <a href='../index.php'>Register Now!</a></center><br><br>";
    

    /*
    $id = $_SESSION['id'];
    echo "Your Serial is -".$id.".";
    echo "<br><a href='index.php'>Home</a>";


    include_once("dbconfig.php");
    //$fathersname = $mothersname = $presentadrs = $permanentadrs = $paperfile = $finalterms = "";
    //$fnameErr = $lnameErr = $chooseclassErr = $emailErr = $phonenoErr = $genderErr = $birthdayErr = $photofileErr = $termsagreedErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            $fathersname = $_POST['fathersname'];
            $mothersname = $_POST['mothersname'];
            $presentadrs = $_POST['presentadrs'];
            $permanentadrs = $_POST['permanentadrs'];
            $paperfile = $_POST['paperfile'];
            $finalterms = $_POST['finalterms'];
        }

        

        $result = "UPDATE admission SET fathersname = '$fathersname', mothersname = $mothersname, presentadrs = '$presentadrs', permanentadrs = '$permanentadrs', paperfile = '$paperfile', finalterms = '$finalterms' WHERE sl = '$id' ";
        $result = mysqli_query($conn, $result);
        
*/
    }



?>

<br>
</article>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>

<script>
function goBack() {
    window.history.back();
}
</script>

</div>
<div class="pagefooter">
    <center>
    <p></p>
    <small><a href="public/terms.php">Terms & Services</a> - <a>About</a> - <a>Cookies</a> - <a>Privacy Policy</a><br><span class="glyphicon glyphicon-copyright-mark"></span> Copyright 1999-<?php echo $year; ?>. All Rights Reserved.<br>Developed by Prosenjit Chowdhury</small>
    </center>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("input, select").focus(function(){
            $(this).css("background-color","#acecca");
        });
        $("input, select").blur(function(){
            $(this).css("background-color","#ffffff")
        });

        $(".container, .imgslider").css("box-shadow","0 4px 8px 0 rgba(0, 0, 0, 0.35), 0 6px 20px 0 rgba(0, 0, 0, 0.31)");

        $("button, input, select, nav").mouseenter(function(){
            $(this).css("box-shadow","0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)");
        });
        $("button, input, select").mouseleave(function(){
            $(this).css("box-shadow","2px 2px 2px #229156");
        });
    });
</script>
</body>
</html>