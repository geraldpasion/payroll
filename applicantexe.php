<?php 
include("dbconfig.php");
$name = $_POST['name'];
$date = date("Y-m-d",strtotime($_POST['daterange'])); 
$type = $_POST['type'];
$rate = $_POST['rate'];
$holiday_id = $_POST['holidayid'];

if(isset($_POST['edit'])){
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE holiday SET holiday_name = '$name', holiday_date = '$date', holiday_type = '$type', holiday_rate = '$rate' WHERE holiday_id = '$holiday_id'"))
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
header("Location: legalholiday.php?edited");
}else{
// insert the new record into the database
if ($stmt = $mysqli->prepare("DELETE FROM holiday WHERE holiday_id = '$holiday_id'"))
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
header("Location: legalholiday.php");	
}
?>