<?php
include("dbconfig.php");
$holidayname = ucfirst($_POST['holidayname1']);
$date = date("Y-m-d",strtotime($_POST['date1'])); 
$type = $_POST['type1'];
$rate = $_POST['rate1'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO holiday (holiday_name, holiday_date, holiday_type, holiday_rate) VALUES ('$holidayname', '$date', '$type', '$rate')"))
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
echo "Form Submitted Succesfully";
?>