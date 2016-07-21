<?php
include("dbconfig.php");
$announcement = $_POST['announcement1'];
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d', time());
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO announcement (announcement_details, announcement_date) VALUES ('$announcement','$date')"))
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