<?php
include("dbconfig.php");
$date = date("Y-m-d",strtotime($_POST['date1'])); 
$subject = $_POST['subject1'];
$trainer = $_POST['trainer1'];
$trainee = $_POST['trainee1'];
$time = $_POST['time1'];
$time = str_replace(' ', '', $time);
$time = substr_replace($time, '', 5, 1);
$time = date("H:i", strtotime($time));
$traineeid = filter_var($trainee, FILTER_SANITIZE_NUMBER_INT);
$trainerid = filter_var($trainer, FILTER_SANITIZE_NUMBER_INT);
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO coaching (coaching_date, coaching_time, coaching_subject, coaching_coachemployeeid, coaching_trainee, employee_id, coaching_trainerid) VALUES ('$date', '$time', '$subject', '$trainer', '$trainee', '$traineeid', '$trainerid')"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
//echo "Form Submitted Succesfully";
?>