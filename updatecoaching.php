<?php 
include("dbconfig.php");

$coachingid = $_POST['id'];
$result = $_POST['result'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE coaching SET coaching_status = 'Completed', coaching_result = '$result' WHERE coaching_id = '$coachingid'"))
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
header("Location: coachingresult.php?approved");

?>