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
$name = $_POST['name'];
//$date = $_POST['date'];//date("Y-m-d",strtotime($_POST['date'])); 
$type = $_POST['type'];
$rate = $_POST['rate'];
$holiday_id = $_POST['holidayid'];
$dateRow = $mysqli->query("SELECT * FROM holiday where holiday_id = '$holiday_id'")->fetch_array();
$date = $dateRow['holiday_date'];

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
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
//header("Location: legalholiday.php?edited");
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
	//header("Location: legalholiday.php");	
}

$employeeIDs = array();
$newtype = $type;

if($result = $mysqli->query("SELECT * FROM attendance where attendance_date = '$date' AND status='Done'")) {
	if($result->num_rows > 0) {
		while ($row = $result->fetch_object()) {
			$type = $row->attendance_daytype;
			$employeeIDs[] = $row->employee_id;
			if($newtype == "Special") {
				if($type = "Regular" || $type = "Legal Holiday" || $type == "Special Holiday") {
					if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Special Holiday' WHERE attendance_id = '$row->attendance_id'")) {
						$stmt2->execute();
						$stmt2->close();
					}
				} else if($type = "Rest Day" || $type = "Rest and Legal Holiday" || $type = "Rest and Special Holiday") {
					if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Rest and Special Holiday' WHERE attendance_id = '$row->attendance_id'")) {
						$stmt2->execute();
						$stmt2->close();
					}
				}
			} else {
				if($type = "Regular" || $type = "Legal Holiday" || $type == "Special Holiday") {
					if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Legal Holiday' WHERE attendance_id = '$row->attendance_id'")) {
						$stmt2->execute();
						$stmt2->close();
					}
				} else if($type = "Rest Day" || $type = "Rest and Legal Holiday" || $type = "Rest and Special Holiday") {
					if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Rest and Legal Holiday' WHERE attendance_id = '$row->attendance_id'")) {
						$stmt2->execute();
						$stmt2->close();
					}
				}
			}
		}
	}
}

foreach($employeeIDs as $emp) {
	$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$emp'")->fetch_array();
	$username = $employeeData['employee_id'];
	$password = $employeeData['employee_password'];

	$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
	$run_user = mysqli_query($mysqli, $sel_user);
	$fetch_emp = mysqli_fetch_array($run_user);

	$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$emp' AND attendance_date = '$date' AND status='Done'")->fetch_array();
	$maxes2 = $attendanceData['attendance_id'];
	$from = "edit";
	include("updateattendance2.php");
}

header("Location: legalholiday.php?edited");
?>