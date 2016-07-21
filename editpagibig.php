<?php 
include("dbconfig.php");
$compensation = $_POST['compensation'];
$id = $_POST['id'];
$employee = $_POST['employee'];
$employer = $_POST['employer'];



// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE pagibig SET hdmf_compensation = '$compensation', hdmf_employer = '$employer', hdmf_employee = '$employee' WHERE hdmf_id = '$id'"))
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
header("Location: pagibig.php?edited");
?>