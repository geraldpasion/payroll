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

	//change the status of the employee in the attendance approval to pending
	$attstatus = $mysqli->query("SELECT * FROM total_comp");
	if ($attstatus->num_rows > 0) {
		while ($row = $attstatus->fetch_object()){
			$attendance_status = $row->attendance_status;
			$empid = $row->employee_id;
			$cutoffdate = $row->cutoff;
			$cutarray = array();
			$cutarray = split(" - ", $cutoffdate);
			$keydatefrom = $cutarray[0];
			$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
			$keydateto = $cutarray[1];
			$keydateto = date("Y-m-d", strtotime($keydateto));
			if ($attendance_status=='Approved' && $keydatefrom <= $date && $start <= $date) {
				if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
				{
					echo "<script></script>";
				}
				if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empid'"))
				{
					echo "<script></script>";
				}
			}
		}
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

	//change the status of the employee in the attendance approval to pending
	$attstatus = $mysqli->query("SELECT * FROM total_comp");
	if ($attstatus->num_rows > 0) {
		while ($row = $attstatus->fetch_object()){
			$attendance_status = $row->attendance_status;
			$empid = $row->employee_id;
			$cutoffdate = $row->cutoff;
			$cutarray = array();
			$cutarray = split(" - ", $cutoffdate);
			$keydatefrom = $cutarray[0];
			$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
			$keydateto = $cutarray[1];
			$keydateto = date("Y-m-d", strtotime($keydateto));
			if ($attendance_status=='Approved' && $keydatefrom <= $date && $start <= $date) {
				if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
				{
					echo "<script></script>";
				}
				if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empid'"))
				{
					echo "<script></script>";
				}
			}
		}
	}else{
		$attendance_status='';
	}
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: legalholiday.php");	
}
}
?>