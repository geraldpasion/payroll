<?php 
include("dbconfig.php");
$from = $_POST['from'];
$id = $_POST['id'];
$to = $_POST['to'];
$er = $_POST['er'];
$ee = $_POST['ee'];
$total = $_POST['total'];


// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE sss_contribution SET Range_Of_Compensation_From = '$from', Range_Of_Compensation_To = '$to', Social_Security_ER = '$er', Social_Security_EE = '$ee', Social_Security_Total = '$total' WHERE SSS_ID = '$id'"))
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
header("Location: ssstable.php?edited");
?>