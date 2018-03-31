<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['pass'])){
  header('Location: ../index.php');
}
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

<div class="container">
	<header>
		<center>
        <img class="img-responsive" src="../files/abc_logo.png" alt="ABC School Logo" width="100" height="75">
        <h1>ABC SCHOOL</h1>
        <h4>School Management Application</h4></center>
	</header>

<article>
<div class="col-sm-7">
    <center><h2>Admission Form</h2></center>
    <form>
        <div>
            <center>
            <a href="index.php" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
        </center>
        </div>
        <br>
        <div class="form-group">
            <input type="text" class="form-control" id="fathersname" placeholder="Father's Name" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="mothersname" placeholder="Mother's Name" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" cols="3" placeholder="Permanent Address" required></textarea>
        </div>
        <div class="form-group">
        <label>Upload Your Papers</label>
            <input class="form-control" type="file" name="" required>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" required> I am declaring that, I have read & agree with the given <a href="terms.php">Terms & Conditions</a> of ABC School.</label>
        </div>
        <div>
            <center>
            <button type="submit" class="btn btn-warning">Submit</button>
        </center>
        </div>
        <br>
        <div class = "progress progress-striped active">
   <div class = "progress-bar progress-bar-success" role = "progressbar" 
      aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100" style = "width: 100%;">
      
      <span class = "sr-only">100% Complete</span>
   </div>
</div>
        
        
    </form>
    <br><br>
        <div class="well">
        <ul>
            <li>After submitting each complete application, our admin panel will review the information & contact through your mail address.</li>
            <br>
            <li>For each applicant our administrator will provide an unique student ID and password.</li>
            <br>
            <li>Check your mail time to time to be updated with us.</li>
        </ul>	
        </div>
    </div>

    <div class="col-sm-5">
    <br><br><br>
            <h4>INSTRUCTIONS</h4>
            <p>Every applicants should fill up all the required fields of this application.
            After submitting this application, everyone have to pay 500 BDT through Bkash.</p>

            <h4>PAYMENT METHOD</h4>
            <ol>
                <li>To pay application fees pick your mobile phone.</li>
                <li>Dial *247#, Then select option ‘3’ for payment.</li>
                <li>Pay at 017XXXXXXXX.</li>
                <li>Enter your Bkash transaction no in the next page of this online application.</li>
                <li>Finally, submit your application!</li>
            </ol>
    </div>
    <br>
</article>
<footer>
	<p>Copyright 1999-2016. All Rights Reserved.</p>
</footer>



</div>
</body>
</html>