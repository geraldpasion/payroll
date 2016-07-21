<?php 
include("dbconfig.php");
if(!isset($_SESSION)) session_start();
$othersid = $_POST['othersid'];
$remarks = $_POST['othersremarks'];
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
$from = $_POST['from']; // 'from' post variable is used so that different things can be made if the approval came from additionalpayablerequests.php or
 						// or if it came from additionalpayablestatus.php so that only one php file can be used for others approval

if(isset($_POST['approved'])) { // if application is approved (if approve button was clicked)
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("UPDATE others SET app_status = 'Approved', others_remarks = '$remarks', others_approvedby = '$approvedby' WHERE others_id = '$othersid'")) {
		$stmt->execute();
		$stmt->close();
	} // show an error if the query has an error
	else {
		echo "ERROR: Could not prepare SQL statement.";
	}
	// redirec the user
	if($from == "req") { // if from *requests.php
		header("Location: additionalpayablerequests.php?approved");
	} else { // if from *status.php
		header("Location: additionalpayablestatus.php?approved");
	}
} else { // if application is disapproved (if disapprove button was clicked)
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("UPDATE others SET app_status = 'Disapproved', others_remarks = '$remarks', others_approvedby = '$approvedby' WHERE others_id = '$othersid'")) {
		$stmt->execute();
		$stmt->close();
	} // show an error if the query has an error
	else {
		echo "ERROR: Could not prepare SQL statement.";
	}
	// redirec the user
	if($from == "req") { // if from *requests.php
		header("Location: additionalpayablerequests.php?disapproved");
	} else { // if from *status.php
		header("Location: additionalpayablestatus.php?disapproved");
	}
}
?>