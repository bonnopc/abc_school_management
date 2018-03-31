<?php
session_start();

/**

if(!isset($_SESSION['categoryErr']) || !isset($_SESSION['categoryErr']) || !isset($_SESSION['categoryErr'])) {
    $_SESSION['idErr'] = $_SESSION['passErr'] = $_SESSION["categoryErr"] = "";
}
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to ABC School</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/datepicker.css">
    <script type="text/javascript" src='bootstrap/js/bootstrap-datepicker.js'></script>
    <script type="text/javascript" src="loginvalidation.js"></script>
    <script src="bootbox.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<div class="pagetitle">
    <span>
        <center>
        <a href="index.php">
            <img class="img-responsive" src="files/abc_logo.png" alt="ABC School Logo" width="100" height="75">
            <h1><strong>ABC SCHOOL</strong></h1>
            <h4>School Management Application</h4>
        </a>
        </center>
    </span>
    <br>
    <div class="imgslider">
        <div class="carousel slide" data-ride="carousel" id="slider">

            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="item active"><img src="files/img01.jpg"></div>
                <div class="item"><img src="files/img02.jpg"></div>
                <div class="item"><img src="files/img03.jpg"></div>
            </div>
            <a href="#slider" data-slide="prev" class="left carousel-control"></a>
            <a href="#slider" data-slide="next" class="right carousel-control"></a>
        </div>
    </div>
    
</div>
<!--
<?php
$fname = $lname = $chooseclass = $email = $phoneno = $gender = $birthday = $photofile = $termsagreed = "";
$fnameErr = $lnameErr = $chooseclassErr = $emailErr = $phonenoErr = $genderErr = $birthdayErr = $photofileErr = $termsagreedErr = "";
?>
-->
<div class="container">

<article>
<br>

  

<!--            Student Registration           -->
<?php
    $year = date("Y");
    $newyear = $year + 1;
?>
<div class="col-sm-7">
    <center><h2>Admission Going On<br><strong>For <?php echo "$newyear";?></strong></h2></center>
    <br>
    <p>This is an online admission form of ABC School. You can put your valid information here to get admitted in this school. Remember, by submitting invalid or false information you'll miss the chance to take part in our admission test.<br><br>To know more about the admission process & regulations, please read our <a href="public/terms.php">Terms and Conditions</a>.</p>
    <?php
        $str=date("y");
      ?>
    
    <form action="public/admission.php" method="POST" id="admission" enctype="multipart/form-data">
        <input type="hidden" name="year" value='<?php echo "$str";?>' />
        <div class="form-group">
            <input type="text" class="form-control" name="fname" placeholder="First Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="lname" placeholder="Last Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="birthday" placeholder="Date of Birth (YYYY-MM-DD)" id="pickyDate">
        </div>
        <div class="form-group">
        	<div class="row">
        		<div class="col-sm-3">
        			<strong>Gender </strong>
        		</div>
        		<div class="col-sm-3">
        			<label><input type="radio" name="gender" value="male"> Male</label>
        		</div>
        		<div class="col-sm-3">
        			<label><input type="radio" name="gender" value="female"> Female</label>
        		</div>
        		<div class="col-sm-3">
        			<label><input type="radio" name="gender" value="other"> Other</label>
        		</div>
        	</div>
		</div>
        <div class="form-group">
            <select class="form-control" name="chooseclass">
                <option value="">Choose a Class</option>
                <option value="c06">Class 06</option>
                <option value="c07">Class 07</option>
                <option value="c08">Class 08</option>
                <option value="c09">Class 09</option>
                <option value="c10">Class 10</option>
            </select>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" onkeyup="showHint(this.value)">
        </div>
        <p><small><span id="txtHint"></span></small></p>
        <div class="form-group">
            <input type="text" class="form-control" name="phoneno" placeholder="Phone Number">
        </div>
        
        
        
        
        <div class="checkbox">
            <label><input type="checkbox" name="termsagreed" required> By clicking next you are agreed to our <a href="public/terms.php">Terms & Conditions</a>.</label>
        </div>
        <br>
        <center><button id="admitBtn" type="submit" name="admissionsubmit" class="btn btn-primary admission">Next</button></center>
        <br>
    </form>
    <div class = "progress progress-striped active">
   <div class = "progress-bar progress-bar-success" role = "progressbar" 
      aria-valuenow = "50" aria-valuemin = "0" aria-valuemax = "100" style = "width: 50%;">
      
      <span class = "sr-only">50% Complete</span>
   </div>
</div>
    </div>

    <!--          Log In            -->



<div class="col-sm-5">
<br><br><br><br><br>
    <form action="loginprocess.php" method="post" id="login">
        <div class="form-group">
            <input type="text" class="form-control" name="id" placeholder="Enter ID">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Enter Password">
        </div>
        <div>
            <select class="form-control" name="category">
                <option value="">Choose a category</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Administrator</option>
                <option value="accounts">Accounts</option>
            </select>

        </div>
        <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
        </div>
        <center>
            <button type="submit" class="btn btn-default" id="loginBtn" value="login" data-toggle="modal" data-target="#confirm-login"><span class="glyphicon glyphicon-log-in"></span>  Login</button>
            <br>
            <br>
        </center>
        
    </form>
    <br><br>
    <div>
    <h3><center>Login (Demo)</center></h3>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>User</th>
                <th>ID</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Administrator</td>
                <td>7</td>
                <td>iub</td>
            </tr>
            <tr>
                <td>Accounts</td>
                <td>170001</td>
                <td>170001</td>
            </tr>
            <tr>
                <td>Teacher</td>
                <td>1719</td>
                <td>1719</td>
            </tr>
            <tr>
                <td>Student</td>
                <td>170032</td>
                <td>170032</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>

</article>
<script type="text/javascript">

$(document).ready(function(){
    $('#pickyDate').datepicker({
            format: "yyyy-mm-dd"
        });

    $('.carousel').carousel({
      interval: 1000 * 2
    });

    $('#loginBtn').click(function() {
    var x = document.forms["login"]["id"].value;
    var y = document.forms["login"]["pass"].value;
    var z = document.forms["login"]["category"].value;


    if (x == "") {
        bootbox.alert({ 
          size: "small",
          title: "Error!",
          message: "ID must be filled out",
        });
        return false;
    }

    else if (y == "") {
        bootbox.alert({ 
          size: "small",
          title: "Error!",
          message: "Password must be filled out",
        });
        return false;
    }

    else if (z == "") {
        bootbox.alert({ 
          size: "small",
          title: "Error!",
          message: "Choose a category!",
        });
        return false;
    }
    else{
        return true;
    }
    });

    $('#admitBtn').click(function(){
        var fnameck = document.forms["admission"]["fname"].value;
        var lnameck = document.forms["admission"]["lname"].value;
        var birthdayck = document.forms["admission"]["birthday"].value;
        var genderck = document.forms["admission"]["gender"].value;
        var chooseclassck = document.forms["admission"]["chooseclass"].value;
        var emailck = document.forms["admission"]["email"].value;
        var phonenock = document.forms["admission"]["phoneno"].value;
        var termsagreedck = document.forms["admission"]["termsagreed"].value;

        if (fnameck == "") {
            bootbox.alert({ 
              size: "small",
              title: "Error!",
              message: "First Name must be filled out!",
            });
        return false;
        }

        else if (lnameck == "") {
            bootbox.alert({ 
              size: "small",
              title: "Error!",
              message: "Last Name must be filled out!",
            });
        return false;
        }

        else if (birthdayck == "") {
            bootbox.alert({ 
              size: "small",
              title: "Error!",
              message: "Pick your Birthday!",
            });
        return false;
        }

        else if (genderck == "") {
            bootbox.alert({ 
              size: "small",
              title: "Error!",
              message: "Gender must be filled out!",
            });
        return false;
        }

        else if (chooseclassck == "") {
            bootbox.alert({ 
              size: "small",
              title: "Error!",
              message: "You have to choose a Class to admit!",
            });
        return false;
        }

        else if (emailck == "") {
            bootbox.alert({ 
              size: "small",
              title: "Error!",
              message: "Enter your Email address!",
            });
        return false;
        }

        else if (phonenock == "") {
            bootbox.alert({ 
              size: "small",
              title: "Error!",
              message: "Provide a Phone number!",
            });
        return false;
        }

        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 404) {
                        bootbox.alert({ 
                            size: "small",
                            title: "Error!",
                            message: "This Email Address is associated with another student profile! Please try a new one...",
                        });
                    }
                }
            };
            xmlhttp.open("GET", "gethint.php?q=" + emailck, true);
            xmlhttp.send();

            return true;
        }
    });
});

    

</script>



</div>
<div class="pagefooter">
    <center>
    <p></p>
    <small><a href="public/terms.php">Terms & Services</a> - <a>About</a> - <a>Cookies</a> - <a>Privacy Policy</a><br><span class="glyphicon glyphicon-copyright-mark"></span> Copyright 1999-<?php echo $year; ?>. All Rights Reserved.<br>Developed by Prosenjit Chowdhury</small>
    </center>
</div>

<!-- Carousel -->
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
        
        $(function showHint(str) {
        if (str.length == 0) { 
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 404) {
                        document.getElementByClassName("admission").disabled = true;
                        document.getElementById("txtHint").innerHTML = "This email address is associated with another student profile.";
                    }
                    else {
                        document.getElementByClassName("admission").disabled = false;
                    }
                }
            };
            xmlhttp.open("GET", "gethint.php?q=" + str, true);
            xmlhttp.send();
        }
    });

});

    
</script>
</body>
</html>