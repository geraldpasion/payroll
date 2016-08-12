<?php 
include("dbconfig.php");
include 'payroll_compute.php'; //include this to get the function update_retro($comp_id, $employee_id);

$cutoff = $_POST['cutoff'];
$cutarray = split(" - ", $cutoff);
$initial = $cutarray[0];
$end = $cutarray[1];
$employeeIDs = array();
$compIDs = array();

if($result = $mysqli->query("SELECT * FROM total_comp_salary where cutoff = '$cutoff' AND process_status='Approved'")) {
	if($result->num_rows > 0) {
		while ($row = $result->fetch_object()) {
			$employeeIDs[] = $row->employee_id;
			$compIDs[] = $row->comp_id;
		}
	}
}

$count=0;
foreach($employeeIDs as $empid) {
	//$mysqli->query("UPDATE others SET others_status='paid'");
	$mysqli->query("UPDATE total_comp SET process_status='Submitted' WHERE cutoff = '$cutoff' AND employee_id='$empid'");
	$mysqli->query("UPDATE total_comp_salary SET process_status='Submitted' WHERE cutoff = '$cutoff' AND employee_id='$empid'");
	$mysqli->query("UPDATE totalcomputation SET process_status='Submitted' WHERE CutoffID = '$cutoff' AND EmployeeID='$empid'");

	$comp_id=$compIDs[$count];

	//update retro here
	update_retro($comp_id, $empid);

	$count++;
}

$mysqli->query("UPDATE cutoff SET process_submission='Submitted' WHERE cutoff_initial = '$initial' AND cutoff_end = '$end' AND cutoff_submission='Submitted'");

?>