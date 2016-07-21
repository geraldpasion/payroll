<?php 
include("dbconfig.php");
$leaveid = $_POST['leave_id1'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved' WHERE leave_id = '$leaveid'"))
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
header("Location: leaveapproval.php");
?>