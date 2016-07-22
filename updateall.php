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

$fromAttendance = $_POST['urlfrom'];
$id = $_POST['urlid'];
$datef = $_POST['urldatef'];
$datet = $_POST['urldatet'];
$datefArr = split('/', $datef);
$start = sprintf("%04d", $datefArr[0]) . "-".sprintf("%02d", $datefArr[1]) . "-" . sprintf("%02d", $datefArr[2]);
$datetArr = split('/', $datet);
$end = sprintf("%04d", $datetArr[0]) ."-". sprintf("%02d", $datetArr[1]) . "-" . sprintf("%02d", $datetArr[2]);
//$attendanceid = $_POST['attendanceid'];
$format = 'Y-m-d';
$array = array();
$interval = new DateInterval('P1D');

$realEnd = new DateTime($end);
$realEnd->add($interval);

$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
$datectr = 0;
foreach($period as $date) { 
    $array[] = $date->format($format); 
    $datectr++;
}

$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$id'")->fetch_array();
$username = $employeeData['employee_id'];
$password = $employeeData['employee_password'];

$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
$run_user = mysqli_query($mysqli, $sel_user);
$fetch_emp = mysqli_fetch_array($run_user);

for($j=0; $j<$datectr; $j++) {
	
	$currentdate = $array[$j];
	$attendanceQuery = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$id' AND attendance_date = '$currentdate'");
	if($attendanceQuery->num_rows > 0) {
	$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$id' AND attendance_date = '$currentdate'")->fetch_array();
	$maxes2 = $attendanceData['attendance_id'];
	$from = "edit";
	include("updateattendance2.php");
}
	//unset("computeHours");
	//unset("computeND");
}


// redirec the user
header("Location: getEmpDetails.php?from=".$fromAttendance."&id=".$id."&datef=".$datef."&datet=".$datet."&edited&".$maxes2);

?>