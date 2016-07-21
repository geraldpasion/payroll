<?php 
include("dbconfig.php");
$cutoffid = $_POST['cutoff_id1'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE cutoff SET cutoff_status = 'Active' WHERE cutoff_id = '$cutoffid'"))
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
header("Location: cutoff.php?activated");
?>