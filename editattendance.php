<?php 
include("dbconfig.php");
$fromAttendance = $_POST['urlfrom'];
$id = $_POST['urlid'];
$datef = $_POST['urldatef'];
$datet = $_POST['urldatet'];
$attendanceid = $_POST['attendanceid'];
$maxes2 = $_POST['attendanceid'];
$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE attendance_id = '$maxes2'")->fetch_array();
$employeeid = $attendanceData['employee_id'];
$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employeeid'")->fetch_array();
$username = $employeeData['employee_id'];
$password = $employeeData['employee_password'];

$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
$run_user = mysqli_query($mysqli, $sel_user);
$fetch_emp = mysqli_fetch_array($run_user);

$date = date("Y-m-d",strtotime($_POST['daterange'])); 
$from = "edit";

$timein = $_POST['timein'];
$outfrombreak = $_POST['outfrombreak'];
$infrombreak = $_POST['infrombreak'];
$timeout = $_POST['timeout'];
$attend = $_POST['isabsent'];
$absentbool = $_POST['absentbool'];
$daytype = $_POST['daytype'];
$status = $_POST['status'];
$emptype = $_POST['emptype'];

if($emptype == "Flexi") {
	if($daytype == "Regular" || $daytype == "Special Holiday") {
		if($attend == "Present") {
			$absentbool = 0;
			$status = "timeout";
		} else if($attend == "Absent") {
			$absentbool = 1;
			$status = "inactive";
		}
	} else {
		$absentbool = 0;
		if($attend == "Present") {
			$status = "timeout";
		} else if($attend == "Absent") {
			$status = "inactive";
		}
	}
} else {
	if($daytype == "Regular") {
		if($attend == "Present") {
			$absentbool = 0;
			$status = "timeout";
		} else if($attend == "Absent") {
			$absentbool = 1;
			$status = "inactive";
		}
	} else {
		$absentbool = 0;
		if($attend == "Present") {
			$status = "timeout";
		} else if($attend == "Absent") {
			$status = "inactive";
		}
	}
}

if($timein != "") {
	$len = strlen($timein);
	if($len == 11){
		$timein = "0".$timein;
	}
	$timein = str_replace(' ', '', $timein);
	$timein = substr_replace($timein, '', 5, 1);
	$timein = date("H:i", strtotime($timein));
}

if($outfrombreak != "") {
	$len = strlen($outfrombreak);
	if($len == 11){
		$outfrombreak = "0".$outfrombreak;
	}
	$outfrombreak = str_replace(' ', '', $outfrombreak);
	$outfrombreak = substr_replace($outfrombreak, '', 5, 1);
	$outfrombreak = date("H:i", strtotime($outfrombreak));
}

if($infrombreak != "") {
	$len = strlen($infrombreak);
	if($len == 11){
		$infrombreak = "0".$infrombreak;
	}
	$infrombreak = str_replace(' ', '', $infrombreak);
	$infrombreak = substr_replace($infrombreak, '', 5, 1);
	$infrombreak = date("H:i", strtotime($infrombreak));
}

if($timeout != "") {
	$len = strlen($timeout);
	if($len == 11){
		$timeout = "0".$timeout;
	}
	$timeout = str_replace(' ', '', $timeout);
	$timeout = substr_replace($timeout, '', 5, 1);
	$timeout = date("H:i", strtotime($timeout));
}


// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_timein = '$timein', attendance_breakout = '$outfrombreak', attendance_breakin = '$infrombreak', attendance_timeout = '$timeout', attendance_absent = '$absentbool', attendance_status = '$status' WHERE attendance_id = '$attendanceid'")) {
	$stmt->execute();
	$stmt->close();

	//change the status of the employee in the attendance approval to pending
	$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$employeeid'");
	if ($attstatus->num_rows > 0) {
		$row101 = mysqli_fetch_object($attstatus);
		$attendance_status = $row101->attendance_status;
		$cutoffdate = $row101->cutoff;
		$cutarray = array();
		$cutarray = split(" - ", $cutoffdate);
		$keydatefrom = $cutarray[0];
		$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
		$keydateto = $cutarray[1];
		$keydateto = date("Y-m-d", strtotime($keydateto));
		if ($attendance_status=='Approved' && $keydatefrom <= $date && $date <= $keydateto) {
			if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$employeeid'"))
			{
				echo "<script></script>";
			}
			if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$employeeid'"))
			{
				echo "<script></script>";
			}
		}
	}else{
		$attendance_status='';
	}

	include("updateattendance.php");
}
// show an error if the query has an error
else {
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: getEmpDetails.php?from=".$fromAttendance."&id=".$id."&datef=".$datef."&datet=".$datet."&edited");

?>