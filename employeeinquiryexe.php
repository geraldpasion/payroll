<?php
include("dbconfig.php");
$empid = $_POST['empid1'];
$question = mysql_real_escape_string($_POST['question1']);
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d', time());
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO inquiry (employee_id, inquiry_question, inquiry_date) VALUES ('$empid', '$question', '$date')"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
echo "Form Submitted Succesfully";
?>