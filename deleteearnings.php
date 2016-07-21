<?php 
include("dbconfig.php");
$earnings_id = $_POST['earnings_id1'];
$fetch = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_id='$earnings_id'")->fetch_object();

$name = $fetch->earnings_name;
// insert the new record into the database
if ($stmt = $mysqli->prepare("DELETE from earnings_setting WHERE earnings_id = '$earnings_id'"))
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

<!-- delete FROM `earnings_setting` WHERE earnings_id= 4; -->