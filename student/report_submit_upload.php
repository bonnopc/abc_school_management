<!DOCTYPE html>
<html>
<head>
	<title>Assignment Submission - ABC School</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<div class="container">
	<header>
		<h1>ABC School</h1>
		<h4>School Management Application</h4>
	</header>

<article>
<div>
	<h2>Assignment Submission Confirmation</h2>
</div>

<?php
$target_dir = "projects/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 25000000) {
    echo "Sorry, your file is too large.<br><h3>Remember, Your file size must be less than 25 MB</h3>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<h3>Please Try Again...</h3>";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>


</article>
</div>
<?php
$y = date('Y');
  ?>

<div class="clearfix"></div>
<div class="pagefooter">
    <center>
    <p></p>
    <small><a href="public/terms.php">Terms & Services</a> - <a>About</a> - <a>Cookies</a> - <a>Privacy Policy</a><br><span class="glyphicon glyphicon-copyright-mark"></span> 1999-<?php echo $y;?>. All Rights Reserved.<br>Developed by Prosenjit Chowdhury</small>
    </center>
</div>
<script type="text/javascript" src="files/js/shadow.js"></script>
<script type="text/javascript" src = "files/js/navactive.js"></script>
</body>
</html>