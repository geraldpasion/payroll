<?php 
include("dbconfig.php");
$employeeid = $_POST['employee_id1'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE employee SET employee_status = 'active' WHERE employee_id = '$employeeid'"))
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
header("Location: inactiveemployeelist.php?activate");
?>