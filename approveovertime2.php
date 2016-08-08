<?php 
include("dbconfig.php");
session_start();
$overtimeid = $_POST['otid1'];
$remarks = $_POST['remarks'];
$date_today = date("Y-m-d");
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
if(isset($_POST['approved'])){
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE overtime SET overtime_status = 'Approved', overtime_remarks = '$remarks', overtime_approvedby = '$approvedby', overtime_approvaldate = '$date_today' WHERE overtime_id = '$overtimeid'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: overtimeapproval2.php?approved");
}
else{
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE overtime SET overtime_status = 'Disapproved', overtime_remarks = '$remarks', overtime_approvedby = '$approvedby', overtime_approvaldate = '$date_today' WHERE overtime_id = '$overtimeid'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: overtimeapproval2.php?disapproved");

}




?>