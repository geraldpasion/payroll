<?php
include("dbconfig.php");
$start = $_POST['start'];
$start = str_replace(' ', '', $start);
$start = substr_replace($start, '', 5, 1);
$start = date("H:i", strtotime($start));
$end = $_POST['end'];
$end = str_replace(' ', '', $end);
$end = substr_replace($end, '', 5, 1);
$end = date("H:i", strtotime($end));



// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO shift (shift_start, shift_end) VALUES ('$start','$end')"))
{
	$stmt->execute();
	$stmt->close();
	
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
header("Location: schedtest.php?edited");
?>