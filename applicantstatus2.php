<?php
include("dbconfig.php");
$id = $_POST['id'];
$status = $_POST['status'];
$comments = $_POST['comments'];
$interviewer = $_POST['interviewer'];
$interviewer = filter_var($interviewer, FILTER_SANITIZE_NUMBER_INT);
$time = $_POST['time'];
$time = str_replace(' ', '', $time);
$time = substr_replace($time, '', 5, 1);
$time = date("H:i", strtotime($time));
$date = date("Y-m-d",strtotime($_POST['date'])); 
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE emp_data SET applicant_status='$status', interview_date='$date', interviewer='$interviewer', interview_time='$time', comments='$comments' WHERE id = '$id'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
header("Location: applicants2.php?answered");
?>