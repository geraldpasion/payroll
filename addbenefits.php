<?php
include("dbconfig.php");
$benefitname = $_POST['benefitname'];

$amount = $_POST['amount'];



// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO benefits (benefits_name, benefits_amount) VALUES ('$benefitname','$amount')"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
header("Location: benefits.php?edited");
?>