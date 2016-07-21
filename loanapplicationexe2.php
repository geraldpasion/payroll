<?php
include("dbconfig.php");

$reason = $_POST['reason1'];
$empid = $_POST['empid1'];
$date = date("Y-m-d",strtotime($_POST['date1']));
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO loan (employee_id, loanDate) VALUES ('$empid','$date')"))
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