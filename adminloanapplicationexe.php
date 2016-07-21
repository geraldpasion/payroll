<?php
include("dbconfig.php");
$empid1 = $_POST['empid1'];
$id = filter_var($empid1, FILTER_SANITIZE_NUMBER_INT);
$date = date("Y-m-d",strtotime($_POST['date1']));



// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO loan (employee_id, loanDate) VALUES ('$id','$date')"))
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