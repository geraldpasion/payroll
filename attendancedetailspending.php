<?php 
include('dbconfig.php');
$empid = $_REQUEST['empid'];
// if(isset($_POST['approved'])){
// insert the new record into the database
$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
if ($attstatus->num_rows > 0) {
$row101 = mysqli_fetch_object($attstatus);
$attendance_status = $row101->attendance_status;
}else{
	$attendance_status='';
}
if ($attendance_status=='Approved') {
	if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
	{
		echo "<script></script>";
		// $stmt->execute();
		// $stmt->close();
	}
	if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empid'"))
	{
		echo "<script></script>";
	}
}
// show an error if the query has an error
// redirec the user
// header("Location: attendancedetailsapproval.php?approved");
// }
// else{
// // insert the new record into the database
// if ($stmt = $mysqli->prepare("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
// {
// 	$stmt->execute();
// 	$stmt->close();
// }
// // show an error if the query has an error
// else
// {
// 	echo "ERROR: Could not prepare SQL statement.";
// }
// // redirec the user
// header("Location: attendancedetailsapproval.php?pending");

// }




?>