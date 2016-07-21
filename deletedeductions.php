<?php 
include("dbconfig.php");
$deduction_id = $_POST['deduction_id1'];
$fetch = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_id='$deduction_id'")->fetch_object();

$name = $fetch->deduction_name;
// insert the new record into the database
if ($stmt = $mysqli->prepare("DELETE from deduction_settings WHERE deduction_id = '$deduction_id'"))
{
	$mysqli->query("ALTER TABLE employee DROP COLUMN ".$name.",
					DROP COLUMN ".$name."_idate,
					DROP COLUMN ".$name."_edate");
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: employeelist.php?deactivated");
?>

delete FROM `deduction_setting` WHERE deduction_id= 4;