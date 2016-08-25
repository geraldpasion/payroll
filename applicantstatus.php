<?php
include("dbconfig.php");
$id = $_POST['id'];
$status = $_POST['status'];
$comments = $_POST['comments'];
$commentsHr=$_POST['commentsHr'];
$interviewer = $_POST['interviewer'];
$interviewer = filter_var($interviewer, FILTER_SANITIZE_NUMBER_INT);
$time = $_POST['time'];
$time = str_replace(' ', '', $time);
$time = substr_replace($time, '', 5, 1);
$time = date("H:i", strtotime($time));
$date = date("Y-m-d",strtotime($_POST['date'])); 
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE emp_data SET applicant_status='$status', interview_date='$date', interviewer='$interviewer', interview_time='$time', comments='$comments', commentHR='$commentsHr' WHERE id = '$id'"))
{	
	$stmt->execute();
	$stmt->close();
	if($status=="Hired"){
		$sendsss="Location: addnew.php?id305=".$id."";
				header($sendsss);
	}
	else{
		header("Location: applicants.php?answered");
	}
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
//header("Location: applicants.php?answered");
?>
