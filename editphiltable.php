<?php 
include("dbconfig.php");
$from = $_POST['from'];
$id = $_POST['id'];
$to = $_POST['to'];
$total = $_POST['total'];
$employee = $_POST['employee'];
$employer = $_POST['employer'];


// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE philhealth_contribution SET Salary_RangeFrom = '$from', Salary_Range_To = '$to', Total_Monthly_Contribution = '$total', Employee_Share = '$employee', Employer_Share = '$employer' WHERE PhilHealth_ID = '$id'"))
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
header("Location: philhealthtable.php?edited");
?>