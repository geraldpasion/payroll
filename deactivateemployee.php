<?php 
include("dbconfig.php");
$employeeid = $_POST['employee_id1'];
$cutoff = $_POST['cutoff1'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE employee SET employee_status = 'Inactive' WHERE employee_id = '$employeeid'"))
{
	$stmt->execute();
	$stmt->close();
	$mysqli->query("UPDATE totalcomputation SET process_status='Final' WHERE CutoffID = '$cutoff' AND EmployeeID='$employeeid'");
	$mysqli->query("UPDATE total_comp SET process_status='Final' WHERE cutoff = '$cutoff' AND employee_id='$employeeid'");
	$mysqli->query("UPDATE total_comp_salary SET process_status='Final' WHERE cutoff = '$cutoff' AND employee_id='$employeeid'");
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: employeelist.php?deactivated");
?>