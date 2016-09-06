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

	//include("dbconfig.php");
	$dateToday = date("Y-m-d");
	$hasdate = $_POST['hasdate'];
	$restday = $_POST['rest1']."/".$_POST['rest2'];
	$count = count($_POST['id']);

	//07/01/2016 - 07/19/2016
	$range = $_POST['daterange'];
	$cutarray = array();
	$cutarray = split(" - ", $range);
	$start = $cutarray[0];
	$start = date("Y-m-d", strtotime($start));
	$end = $cutarray[1];
	$end = date("Y-m-d", strtotime($end));

	$tom = strtotime("tomorrow");
	$dateTomorrow=date("Y-m-d", $tom);

	session_start();
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	for ($i=0; $i <$count ; $i++) { 
		// if ($stmt = $mysqli->prepare("UPDATE employee SET employee_restday = '$restday' WHERE employee_id = '".$_POST["id"][$i]."'")) {	
		// 	$stmt->execute();
		// 	$stmt->close();
		// }
		if($hasdate == "with") {
			//echo"haha";
				$sql_up ="INSERT INTO restday_logs (employee_id, restday_date, restday_startdate, restday_enddate, restday_schedule, restday_createdby) VALUES ('".$_POST["id"][$i]."', '$dateToday', '$start' ,'$end', '$restday', '$approvedby')";
				if ($conn->query($sql_up) === TRUE) {
				    echo $hasdate." Record updated successfully employee <br>";
				    //header("Location: editrestday.php?edited");
				} else {
				    echo $hasdate." Error updating record <br>";
				}
				if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_restday = '$restday' WHERE employee_id = '".$_POST["id"][$i]."' AND attendance_date BETWEEN '$start' AND '$end'")) {
				$stmt2->execute();
				$stmt2->close();
				//echo"<script>alert('update with date range');</script>";
				}
				header("Location: editrestday.php?edited");
		} else {
			$sql_up ="INSERT INTO restday_logs (employee_id, restday_date, restday_startdate, restday_enddate, restday_schedule, restday_createdby) VALUES ('".$_POST["id"][$i]."', '$dateToday', '$dateTomorrow', 'NULL', '$restday', '$approvedby')";
				if ($conn->query($sql_up) === TRUE) {
				    echo $hasdate." Record updated successfully employee <br>";
				    //header("Location: editrestday.php?edited");
				 //   echo"<script>alert('insert without');</script>";
				} else {
				    echo $hasdate." Error updating record <br>";
				}

			if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_restday = '$restday' WHERE attendance_date > '$dateToday' AND employee_id = '".$_POST["id"][$i]."'")) {
				$stmt2->execute();
				$stmt2->close();
				//echo"<script>alert('update without');</script>";
			}
		}
	}

	if($hasdate == "with") {
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

		for($i=0; $i<$count; $i++) {
			$emp = $_POST['id'][$i];
			for($j=0; $j<$datectr; $j++) {
				$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$emp'")->fetch_array();
				$username = $employeeData['employee_id'];
				$password = $employeeData['employee_password'];

				$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
				$run_user = mysqli_query($mysqli, $sel_user);
				$fetch_emp = mysqli_fetch_array($run_user);

				$currentdate = $array[$j];
				$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$emp' AND attendance_date = '$currentdate' AND status='Done'")->fetch_array();
				$maxes2 = $attendanceData['attendance_id'];
				$from = "edit";
				include("updateattendance2.php");
				//unset("computeHours");
				//unset("computeND");
			}
		}
	}
	// redirec the user
header("Location: editrestday.php?edited");

?>