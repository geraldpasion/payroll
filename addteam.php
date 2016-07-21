<?php
include("dbconfig.php");
$team = $_POST['team'];


// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO team (team_name) VALUES ('$team')"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
header("Location: teammanagement.php?edited");
?>