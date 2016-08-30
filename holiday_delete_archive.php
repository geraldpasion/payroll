<?php 
include("dbconfig.php");

function computeHours($timein, $timeout) { // computes the difference in time
	$timeinArray = array();
	$timeinArray = split(":", $timein);
	$timeinArrayMin = sprintf("%.2f", $timeinArray[1]/60);
	$timeinArrayDec = sprintf("%.2f", $timeinArray[0] + $timeinArrayMin);
	$newRegHrs = date("H:i", (strtotime($timeout) - 60*60*$timeinArrayDec));
	//$newRegHrs = date("H:i", (strtotime($timeout) - strtotime($timein)));
	$newRegHrsArray = array();
	$newRegHrsArray = split(":", $newRegHrs);
	$newRegHrsArrayMin = sprintf("%.2f", $newRegHrsArray[1]/60);
	$newRegHrsArrayDec = sprintf("%.2f", $newRegHrsArray[0] + $newRegHrsArrayMin);
	return $newRegHrsArrayDec;
}

function computeND($timein, $timeout) { // computes the night differential in a given time range
	$res= "00:00";
	if($timein == $timeout) {
		$res = "00:00";
	} else if($timein <= "22:00" && $timeout >= "22:00") {
		if($timein >= "06:00" && $timein <= "22:00") {
			$res = date("H:i", strtotime($timeout) - strtotime("22:00"));
		} else if($timein <= "06:00") {
			$res = date("H:i", (strtotime("06:00") - strtotime($timein)) + (strtotime($timeout) - strtotime("22:00")));
		} else {
			$res = date("H:i", strtotime("06:00") - strtotime($timein));
		}
	} else if($timein <= "22:00" && $timeout <= "22:00") {
		if($timein <= "06:00" && $timeout >= "06:00") {
			$res = date("H:i", strtotime("06:00") - strtotime($timein));
		} else if($timein <= "06:00" && $timeout <= "06:00") {
			$res = date("H:i", strtotime($timeout) - strtotime($timein));
		} else if($timein >= "06:00" && $timeout <= "06:00") {
			$res = date("H:i", strtotime($timeout) - strtotime("22:00"));
		} else if($timein >= "06:00" && $timeout >= "06:00") {
			if($timeout >= $timein) {
				$res = "00:00";
				// if($timein >= "00:00") {
				// 	$res = date("H:i", strtotime("06:00") - strtotime($timein));	
				// } else {
				// 	$res = date("H:i", strtotime("06:00") - strtotime("22:00"));
				// }
			} else {
				$res = date("H:i", strtotime("06:00") - strtotime("22:00"));
			}
		} else {
			$res = "00:00";				
		}
	} else if($timein >= "22:00" && $timeout >= "22:00") {
		$res = date("H:i", strtotime($timeout) - strtotime($timein));
	} else if($timein >= "22:00" && $timeout <= "22:00") {
		$res = date("H:i", strtotime($timeout) - strtotime($timein));
	}
	$resArr = array();
	$resArr = split(":", $res);
	$resMin = sprintf("%.2f", $resArr[1]/60);
	// if($res != "00:00") {
	// 	$resArr[0] = $resArr[0] - 1;	
	// }
	return sprintf("%.2f", $resArr[0] + $resMin);
}

$holidayid = $_POST['announcement_id'];
$dateRow = $mysqli->query("SELECT * FROM holiday where holiday_id = '$holidayid'")->fetch_array();
$date = $dateRow['holiday_date'];
$employeeIDs = array();

if($result = $mysqli->query("SELECT * FROM attendance where attendance_date = '$date' AND status='Done'")) {
	if($result->num_rows > 0) {
		while ($row = $result->fetch_object()) {
			$type = $row->attendance_daytype;
			$employeeIDs[] = $row->employee_id;
			if($type == "Rest and Legal Holiday" || $type == "Rest and Special Holiday") {
				if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Rest Day' WHERE attendance_id = '$row->attendance_id'")) {
					$stmt2->execute();
					$stmt2->close();
				}
			} else {
				if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Regular' WHERE attendance_id = '$row->attendance_id'")) {
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
	}
}

// insert the new record into the database
if ($stmt = $mysqli->prepare("DELETE FROM holiday WHERE holiday_id = '$holidayid'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}

foreach($employeeIDs as $emp) {
	$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$emp'")->fetch_array();
	$username = $employeeData['employee_id'];
	$password = $employeeData['employee_password'];

	$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
	$run_user = mysqli_query($mysqli, $sel_user);
	$fetch_emp = mysqli_fetch_array($run_user);

	$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$emp' AND attendance_date = '$date'")->fetch_array();
	$maxes2 = $attendanceData['attendance_id'];
	$from = "edit";
	include("updateattendance2.php");
}
	header("Location: legalholiday.php");

?>