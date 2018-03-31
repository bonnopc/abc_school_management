<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$sid = $_POST['sid'];
	$full_name = $_POST['fullname'];
	$amount = $_POST['amount'];
	$remAmount = $amount;
	$prclass = $_POST['class'];

	$others = 5000;
	$classNo = intval(substr($prclass, 2));
	$monthlyFees = $classNo * 100;

	echo "<h2>$sid<br>$amount</h2>";

	$fake_id = 1;
	$newyear = date("Y");
    $measureTable = "stupayment_".$newyear;

	$pay_conn= mysqli_connect("localhost","root","") or die ("could not connect to MySQL!"); 

    mysqli_select_db($pay_conn, "abc_school_payments") or die ("no Database");

    $sql = "SELECT * FROM $measureTable WHERE sid = '$fake_id'";
    $result = mysqli_query($pay_conn, $sql) or die(mysqli_error());


    if(mysqli_num_rows($result) > 0){
    	while ($row = mysqli_fetch_assoc($result)) {
    		$othersPaid = $row['othercost'];
    		$monthlyFees = $classNo * 100;
			$othersRem = $others - $othersPaid;
    	}
    }

    if ($othersPaid < $others) {
    	if ($othersRem > $remAmount) {
    		$othersTotal = $othersRem + $remAmount;
    		$sql = "UPDATE $measureTable SET othercost = '$othersTotal' WHERE sid = '$fake_id'";
			$result = mysqli_query($pay_conn, $sql) or die(mysqli_error());
			$remAmount = 0;
    	} else {
    		$sql = "UPDATE $measureTable SET othercost = '$others' WHERE sid = '$fake_id'";
			$result = mysqli_query($pay_conn, $sql) or die(mysqli_error());
			$remAmount -= $othersRem; 
    	}
    }
    
    if ($remAmount > 0) {

    $sql = "SELECT * FROM $measureTable WHERE sid = '$fake_id'";
    $result = mysqli_query($pay_conn, $sql) or die(mysqli_error());

   	if(mysqli_num_rows($result) > 0){
   		while ($row = mysqli_fetch_assoc($result)) {
    		for ($i=1; $i < 12; $i++) {

    				$colNo = "m".$i;
	    			$colValue = $row[$colNo];
	    			echo $colValue;
	    			$colRem = $monthlyFees - $colValue;
	    			if ($colValue < $monthlyFees) {
	    				if ($remAmount < $colRem) {
	    					$colTotal = $colRem + $remAmount;
	    					$sql = "UPDATE $measureTable SET $colNo = '$colTotal' WHERE sid = '$fake_id'";
							$result = mysqli_query($pay_conn, $sql) or die(mysqli_error());
							$remAmount = 0;
	    				} else {
	    					$sql = "UPDATE $measureTable SET $colNo = '$monthlyFees' WHERE sid = '$fake_id'";
							$result = mysqli_query($pay_conn, $sql) or die(mysqli_error());
							$remAmount -= $monthlyFees;
	    				}	
	    			}	
    			}
			}
			echo $row[$colNo];
    	}
	}   	
}


  ?>