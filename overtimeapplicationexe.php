<?php
include("dbconfig.php");
$end = $_POST['end1'];
$end = str_replace(' ', '', $end);
$end = substr_replace($end, '', 5, 1);
$end = date("H:i", strtotime($end));
$reason = $_POST['reason1'];
$start = $_POST['start1'];
$start = str_replace(' ', '', $start);
$start = substr_replace($start, '', 5, 1);
$start = date("H:i", strtotime($start));
$empid = $_POST['empid1'];
$empid = str_replace(' ', '', $empid);
$date = date("Y-m-d",strtotime($_POST['date1']));
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO overtime (employee_id, overtime_date, overtime_start, overtime_end, overtime_reason) VALUES ('$empid','$date','$start','$end', '$reason')"))
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