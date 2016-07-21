<?php 
include("dbconfig.php");

$usersCount = count($_POST["id"]);
for($i=0;$i<$usersCount;$i++) {

if ($stmt = $mysqli->prepare("UPDATE employee set employee_team='" . $_POST["teamname"] ."'  WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
}
?>

