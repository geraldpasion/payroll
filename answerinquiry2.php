<?php
include("dbconfig.php");
session_start();
$answer = mysql_real_escape_string($_POST['answer1']);
$inqid = $_POST['inqid1'];
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d', time());
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE inquiry SET inquiry_answer='$answer', inquiry_answerdate='$date', inquiry_status='answered', inquiry_answeredby = '$approvedby' WHERE inquiry_id = '$inqid'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
header("Location: inquiry2.php?answered");
?>