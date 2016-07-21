<?php 
include("dbconfig.php");
session_start();
$attendanceid = $_POST['attendance_id'];
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];

// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE logedit SET logedit_status = 'Disapproved', logedit_approvedby = '$approvedby' WHERE attendance_id = '$attendanceid'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
?>

