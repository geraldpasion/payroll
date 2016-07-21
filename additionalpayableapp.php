<?php
include("dbconfig.php");

// post data from the form in additionalpayable.php 
$end = $_POST['end1'];
$isAbsent = $_POST['isabsent'];
$reason = $_POST['reason1'];
$start = $_POST['start1'];
$breakin = $_POST['breakin1'];
$breakout = $_POST['breakout1'];

$end = str_replace(' ', '', $end);
$end = substr_replace($end, '', 5, 1);
$end = date("H:i", strtotime($end));

$start = str_replace(' ', '', $start);
$start = substr_replace($start, '', 5, 1);
$start = date("H:i", strtotime($start));

$breakin = str_replace(' ', '', $breakin);
$breakin = substr_replace($breakin, '', 5, 1);
$breakin = date("H:i", strtotime($breakin));

$breakout = str_replace(' ', '', $breakout);
$breakout = substr_replace($breakout, '', 5, 1);
$breakout = date("H:i", strtotime($breakout));

//$empid = $_POST['empid1'];
$name = $_POST['name1'];
$date = date("Y-m-d",strtotime($_POST['date1']));

$id = filter_var($name, FILTER_SANITIZE_NUMBER_INT);
$id = str_replace(' ', '', $id);

// res counts the number of application (from the others table) with the same date and employee id that is currently being applied
// this is to avoid duplicate applications
$res = $mysqli->query("SELECT count(*) as total FROM others WHERE attendance_date = '$date' AND employee_id = '$id'");
$data = $res->fetch_assoc();
$count = $data['total'];

if($count > 0) { // if there is at least 1 application, return false
	echo 'Error';
	return false;
} else { // else save to database
	$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE attendance_date = '$date' AND employee_id = '$id'")->fetch_array();
	$shift = $attendanceData['attendance_shift'];
	$restday = $attendanceData['attendance_restday'];

	// insert the new record into the database
	if($isAbsent == "Present") { // for applications that are present, the hours and pay should be computed 
		$end = str_replace(' ', '', $end);
		$end = substr_replace($end, '', 5, 1);
		$end = date("H:i", strtotime($end));

		$start = str_replace(' ', '', $start);
		$start = substr_replace($start, '', 5, 1);
		$start = date("H:i", strtotime($start));

		$breakin = str_replace(' ', '', $breakin);
		$breakin = substr_replace($breakin, '', 5, 1);
		$breakin = date("H:i", strtotime($breakin));

		$breakout = str_replace(' ', '', $breakout);
		$breakout = substr_replace($breakout, '', 5, 1);
		$breakout = date("H:i", strtotime($breakout));
		//$empid = $_POST['empid1'];

		// insert the new record into the database
		if ($stmt = $mysqli->prepare("INSERT INTO others (employee_id, attendance_shift, attendance_restday, attendance_date, attendance_timein, attendance_breakout, attendance_breakin, attendance_timeout,  attendance_absent, attendance_status, others_reason) VALUES ('$id','$shift','$restday','$date','$start','$breakout','$breakin','$end','0','timeout','$reason')")) {
			$stmt->execute();
			$stmt->close();

			include("dbconfig.php");
			$othersData = $mysqli->query("SELECT * FROM others WHERE attendance_date = '$date' AND employee_id = '$id'")->fetch_array();
			$maxes2 = $othersData['others_id'];
			$from = "edit";
			$sel_user = "SELECT * from employee where employee_id='$id' AND employee_status = 'active'";
			$run_user = mysqli_query($mysqli, $sel_user);	
			$fetch_emp = mysqli_fetch_array($run_user);
			include("updateothers.php");
		}
		// show an error if the query has an error
		else {
			echo "ERROR: Could not prepare SQL statement.";
		}
	} else if($isAbsent == "Absent") { // for absent applications, hours and pay need not be computed
		// insert the new record into the database
		if ($stmt = $mysqli->prepare("INSERT INTO others (employee_id, attendance_shift, attendance_restday, attendance_date, attendance_absent, attendance_status, status, others_reason) VALUES ('$id','$shift','$restday','$date','1','inactive','Done','$reason')")) {
			$stmt->execute();
			$stmt->close();

			include("dbconfig.php");
			$othersData = $mysqli->query("SELECT * FROM others WHERE attendance_date = '$date' AND employee_id = '$id'")->fetch_array();
			$maxes2 = $othersData['others_id'];
			$result = $mysqli->query("SELECT * FROM others WHERE others_id = '$maxes2'")->fetch_array();
			$others_id = $result['others_id'];

			$attendance_date = $result['attendance_date'];
			$dateWithDay = date('Y-m-d:l', strtotime($attendance_date));
			$dateWithDayArray = array();
			$dateWithDayArray = split(':', $dateWithDay);
			$dateArray = split('-', $dateWithDayArray[0]);

			$restday = $result['attendance_restday'];
			$restdayArray = array();
			$restdayArray = split('/', $restday);

			// determine the type of day to be saved to the database
			$typeOfDay = "reg";
			if($dateRow = $mysqli->query("SELECT * FROM holiday where holiday_date = '$dateWithDayArray[1]'")->fetch_array()) {
				if($dateRow['holiday_type'] == "Regular" || $dateRow['holiday_type'] == "Legal") {
					if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
						$typeOfDay = "rstlh";
						$mysqli->query("UPDATE others SET attendance_daytype='Rest and Legal Holiday' WHERE others_id='$others_id'");	
					} else {
						$typeOfDay = "lh";
						$mysqli->query("UPDATE others SET attendance_daytype='Legal Holiday' WHERE others_id='$others_id'");	
					}
				} else {
					if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
						$typeOfDay = "rstsh";
						$mysqli->query("UPDATE others SET attendance_daytype='Rest and Special Holiday' WHERE others_id='$others_id'");	
					} else {
						$typeOfDay = "sh";
						$mysqli->query("UPDATE others SET attendance_daytype='Special Holiday' WHERE others_id='$others_id'");	
					}
				}
			} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
				$typeOfDay = "rst";
				$mysqli->query("UPDATE others SET attendance_daytype='Rest Day' WHERE others_id='$others_id'");	
			} else {
				$mysqli->query("UPDATE others SET attendance_daytype='Regular' WHERE others_id='$others_id'");	
			}
		}
		// show an error if the query has an error
		else {
			echo "ERROR: Could not prepare SQL statement.";
		}
	}
	echo "Form Submitted Succesfully";
}
?>