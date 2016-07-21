<?php
include("dbconfig.php");
session_start();
$attendance_id = $_POST['attendanceid'];
$employee_id = $_SESSION['logsession'];
$logedit_reason = mysql_real_escape_string($_POST['reason']);
$logedit_date = date("Y-m-d",strtotime($_POST['date'])); 

$logedit_timein = $_POST['timein'];
$logedit_breakout = $_POST['breakout'];
$logedit_breakin = $_POST['breakin'];
$logedit_timeout = $_POST['timeout'];
$attend = $_POST['isabsent'];
$absentbool = $_POST['absentbool'];
$daytype = $_POST['daytype'];
$status = $_POST['status'];
$emptype = $_POST['emptype'];

if($logedit_timein != "") {
	$len = strlen($logedit_timein);
	if($len == 11){
		$logedit_timein = "0".$logedit_timein;
	}
	$logedit_timein = str_replace(' ', '', $logedit_timein);
	$logedit_timein = substr_replace($logedit_timein, '', 5, 1);
	$logedit_timein = date("H:i", strtotime($logedit_timein));
}

if($logedit_breakout != "") {
	$len = strlen($logedit_breakout);
	if($len == 11){
		$logedit_breakout = "0".$logedit_breakout;
	}
	$logedit_breakout = str_replace(' ', '', $logedit_breakout);
	$logedit_breakout = substr_replace($logedit_breakout, '', 5, 1);
	$logedit_breakout = date("H:i", strtotime($logedit_breakout));
}

if($logedit_breakin != "") {
	$len = strlen($logedit_breakin);
	if($len == 11){
		$logedit_breakin = "0".$logedit_breakin;
	}
	$logedit_breakin = str_replace(' ', '', $logedit_breakin);
	$logedit_breakin = substr_replace($logedit_breakin, '', 5, 1);
	$logedit_breakin = date("H:i", strtotime($logedit_breakin));
}

if($logedit_timeout != "") {
	$len = strlen($logedit_timeout);
	if($len == 11){
		$logedit_timeout = "0".$logedit_timeout;
	}
	$logedit_timeout = str_replace(' ', '', $logedit_timeout);
	$logedit_timeout = substr_replace($logedit_timeout, '', 5, 1);
	$logedit_timeout = date("H:i", strtotime($logedit_timeout));
}

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

// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO logedit (attendance_id, employee_id, logedit_date, logedit_timein, logedit_breakout, logedit_breakin, logedit_timeout, logedit_reason, logedit_status, attendance_status, attendance_daytype, attendance_absent, attendance_emptype) VALUES ('$attendance_id', '$employee_id', '$logedit_date', '$logedit_timein', '$logedit_breakout', '$logedit_breakin', '$logedit_timeout', '$logedit_reason', 'Pending', '$status', '$daytype', '$absentbool', '$emptype') ON DUPLICATE KEY UPDATE employee_id = '$employee_id', logedit_date = '$logedit_date', logedit_timein = '$logedit_timein', logedit_breakout = '$logedit_breakout', logedit_breakin = '$logedit_breakin', logedit_timeout = '$logedit_timeout', logedit_reason = '$logedit_reason', logedit_status = 'Pending', attendance_status='$status', attendance_daytype='$daytype', attendance_absent='$absentbool', attendance_emptype='$emptype'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}

header("Location: dtr2.php?submitted");

?>