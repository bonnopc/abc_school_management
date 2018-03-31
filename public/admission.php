<?php
session_start();
if(!isset($_POST['admissionsubmit'])){
  header('Location: ../index.php');
}
/*
session_register(fname);
session_register(lname);
session_register(chooseclass);
session_register(email);
session_register(phoneno);
session_register(gender);
session_register(birthday);
session_register(termsagreed);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        
    }
}

include_once("dbconfig.php");
$fname = $lname = $chooseclass = $email = $phoneno = $gender = $birthday = $photofile = $termsagreed = "";
$fnameErr = $lnameErr = $chooseclassErr = $emailErr = $phonenoErr = $genderErr = $birthdayErr = $photofileErr = $termsagreedErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['admissionsubmit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $chooseclass = $_POST['chooseclass'];
        $email = $_POST['email'];
        $phoneno = $_POST['phoneno'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $photofile = $_POST['photofile'];
        $termsagreed = $_POST['termsagreed'];
    }

    
    $result = "INSERT INTO admission(fname, lname, chooseclass, email, phoneno, gender, birthday, photofile, termsagreed) VALUES('$fname','$lname', '$chooseclass' ,'$email', '$phoneno','$gender','$birthday','$photofile','$termsagreed')";
    $result = mysqli_query($conn, $result);
    $last_id = mysqli_insert_id($conn);
    echo "<center>.$last_id.</center>";
    //$_SESSION['$last_id'] = $last_id;

    $file = fopen("files/admission.txt","w") or die("unable to open file!");
    fwrite($file,$last_id);
    fclose($file);

    $file = fopen("files/admission.txt","r") or die("unable to open file!");
    $i = 1;
    while(!feof($file)){
        if($i==1){
        $_SESSION["id"] = fgets($file);
        }
        $i++;
        }
    fclose($file);
}
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
    <script type="text/javascript">

      function checkForm(form)
      {if(!form.captcha.value.match(/^\d{5}$/)) {
          alert('Please enter the CAPTCHA digits in the box provided');
          form.captcha.focus();
          return false;
        }
        return true;
      }

    </script>
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
<div class="col-sm-7">
    <div>
        <center>
            <a href='index.php' role='button'><span class='glyphicon glyphicon-chevron-left'></span> Back</a>
        </center>
    </div>
    <br>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['admissionsubmit'])) {
        $_SESSION['year'] = $_POST['year'];
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['chooseclass'] = $_POST['chooseclass'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phoneno'] = $_POST['phoneno'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['birthday'] = $_POST['birthday'];
        //$_SESSION['photofile'] = $_POST['photofile'];
        $_SESSION['termsagreed'] = $_POST['termsagreed'];

    echo "<center><h2>Admission Form</h2></center>
    <form method='POST' action='admissionaction.php'  enctype='multipart/form-data'>
        
        <label>Upload Your Photo</label>
        <div class='form-group'>
            <input type='file' class='form-control' name='photofile' required>
        </div>
        <div class='form-group'>
            <input type='text' class='form-control' id='fathersname' name='fathersname' placeholder='Father's Name' required>
        </div>
        <div class='form-group'>
            <input type='text' class='form-control' id='mothersname' name='mothersname' placeholder='Mother's Name' required>
        </div>
        <div class='form-group'>
            <textarea class='form-control' cols='3' id='presentadrs' name='presentadrs' placeholder='Present Address' required></textarea>
        </div>
        <div class='form-group'>
            <textarea class='form-control' cols='3' id='permanentadrs' name='permanentadrs' placeholder='Permanent Address' required></textarea>
        </div>
        <div class='form-group'>
        <label>Upload Your Papers</label>
            <input class='form-control' type='file' id='paperfile' name='paperfile' required>
        </div>
        <div class='form-group'>
            <center>
            <p><img src='captcha.php' width='360' height='90' border='1' alt='CAPTCHA'></p>
            <p><input type='text' size='6' maxlength='5' name='captcha' value=''><br>
            <small>Type the digits from the image into this box</small></p>
            </center>
        </div>
        <div class='alert alert-danger'>
            <div class='checkbox'>
                <label><input type='checkbox' id='finalterms' name='finalterms' required> I am declaring that, I have read &amp agreed with the given <a href='terms.php'>Terms & Conditions</a> of ABC School.</label>
            </div>
        </div>
        
        <div>
            <center>
            <button type='submit' class='btn btn-warning' name='submit'>Submit</button>
        </center>
        </div>
        <br>
        <div class = 'progress progress-striped active'>
   <div class = 'progress-bar progress-bar-success' role = 'progressbar' 
      aria-valuenow = '100' aria-valuemin = 0' aria-valuemax = '100' style = 'width: 100%;'>
      
      <span class = 'sr-only'>100% Complete</span>
   </div>
</div>
        
        
    </form>
    <br><br>
        <div class='alert alert-info'>
        <ul>
            <li>After submitting each complete application, our admin panel will review the information &amp contact through your mail address.</li>
            <br>
            <li>For each applicant our administrator will provide an unique student ID and password.</li>
            <br>
            <li>Check your mail time to time to be updated with us.</li>
        </ul>   
        </div>";
    }
}
else {
    echo "<br><br><center><h2>You are not allowed to<br>view this page!</h2><br><br>
    <a href='../index.php'><h4>Register Now!</h4></a></center><br><br>";
}
?>
    
    </div>

    <div class="col-sm-5">
    <br><br><br>
            <h4>INSTRUCTIONS</h4>
            <ul>
                <li>Please upload a passport size photo of 413 x 413 pixels. File size should be less than 2 MB. Only .jpeg or .jpg image files are allowed to submit this form.</li>
                <li>You have to submit all of your academic certificates and marksheets.</li>
            	<li>Every applicants have to fill up all the required fields of this application.</li>
            	<li>Before submitting this application form, you have to pay 500 BDT through Bkash.</li>
            	<li>You have to have a Mobile Phone with a SIM which have a (Personal, Agent or, Marchant) bKash account</li>

            </ul>

            <br>

            <h4>PAYMENT METHOD</h4>
            <ol>
                <li>Dial *247#,</li>
                <li>Select option ‘3’ for Payment</li>
                <li>Pay BDT 500 at 017XXXXXXXX.</li>
                <li>Enter your Bkash transaction no. in this page.</li>
                <li>Finally, submit your application!</li>
            </ol>
    </div>
    <br>
</article>

</div>
<?php $year = date('Y');  ?>
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