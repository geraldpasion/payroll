<?php 
include("dbconfig.php");
$overtimeid = $_POST['otid1'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE overtime SET overtime_status = 'Disapproved' WHERE overtime_id = '$overtimeid'"))
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
header("Location: overtimeapproval2.php");
?>