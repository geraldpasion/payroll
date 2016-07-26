<?php 
include('dbconfig.php');
$empid = $_REQUEST['empid'];
$status = $_REQUEST['status'];
$cutoff = $_REQUEST['cutoff'];

if($status == "pending") {
	$mysqli->query("UPDATE total_comp SET process_status='Pending' WHERE cutoff = '$cutoff' AND employee_id='$empid'");
	$mysqli->query("UPDATE total_comp_salary SET process_status='Pending' WHERE cutoff = '$cutoff' AND employee_id='$empid'");
	$mysqli->query("UPDATE totalcomputation SET process_status='Pending' WHERE CutoffID = '$cutoff' AND EmployeeID='$empid'");
	echo '<script></script>';

} else if($status == "approve") {
	$mysqli->query("UPDATE total_comp SET process_status='Approved' WHERE cutoff = '$cutoff' AND employee_id='$empid'");
	$mysqli->query("UPDATE total_comp_salary SET process_status='Approved' WHERE cutoff = '$cutoff' AND employee_id='$empid'");
	$mysqli->query("UPDATE totalcomputation SET process_status='Approved' WHERE CutoffID = '$cutoff' AND EmployeeID='$empid'");
	echo '<script></script>';
} else {
	echo '<script>alert("Error updating");</script>';
}





?>