<?php
	include("dbconfig.php");
	date_default_timezone_set("Asia/Hong_Kong");
	$date = date("Y-m-d");
	$yesterday = date('Y-m-d',strtotime("-1 days"));
	$timein2 = date("G:i");
	$logtime = date("Y-m-d H:i:s");
	$nxtAvailableLogin = date("G:i", strtotime($timein2) + 72000);
	$username = $_POST['username'];
	//for time in
	$resultb = $mysqli->query("SELECT * FROM attendance WHERE employee_id = '$username' AND (status = 'Not Done' OR attendance_status = 'inactive') AND attendance_date = '$yesterday'")->fetch_array();
	$maxes = $resultb['attendance_id'];
	$result = $mysqli->query("SELECT * FROM attendance WHERE attendance_id = '$maxes'")->fetch_array();
	$status = $result['attendance_status'];
	$statusd = $result['status'];
	//$restrict = $result['attendance_restrict'];
	$attendanceid = $result['attendance_id'];
	
	//for processes after time in
	$resultc = $mysqli->query("SELECT * FROM attendance WHERE employee_id = '$username' AND status = 'Not Done' AND attendance_date = '$date'")->fetch_array();
	$maxes2 = $resultc['attendance_id'];
	$result2 = $mysqli->query("SELECT * FROM attendance WHERE attendance_id = '$maxes2'")->fetch_array();
	$status2 = $result2['attendance_status'];
	//$restrict2 = $result2['attendance_restrict'];
	$attendanceid2 = $result2['attendance_id'];

	//for processes after time in 2
	$resultd = $mysqli->query("SELECT * FROM attendance WHERE employee_id = '$username' AND status = 'Not Done' AND (attendance_status = 'active' OR attendance_status = 'outforbreak' OR attendance_status = 'infrombreak') ORDER BY attendance_id DESC LIMIT 1")->fetch_array();
	$maxes3 = $resultd['attendance_id'];
	$result3 = $mysqli->query("SELECT * FROM attendance WHERE attendance_id = '$maxes3'")->fetch_array();
	$status3 = $result3['attendance_status'];
	//$restrict3 = $result3['attendance_restrict'];
	$attendanceid3 = $result3['attendance_id'];

	$from = "index";
	$empty = "";
	
	// insert the new record into the database
	
	$username = mysqli_real_escape_string($mysqli,$_POST['username']);

	$password = mysqli_real_escape_string($mysqli,$_POST['password']);

	$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";

	$run_user = mysqli_query($mysqli, $sel_user);

	$fetch_emp = mysqli_fetch_array($run_user);
	$emp_shift = $fetch_emp['employee_shift'];
	$emp_restday = $fetch_emp['employee_restday'];
	$check_user = mysqli_num_rows($run_user);

	if($check_user>0){
	
	if(isset($_POST['login'])){
		if($status3 == 'active' || $status3 == 'outforbreak' || $status3 == 'infrombreak'){
			header("location:index.php?doubletime");
		}
		else if(($status == 'timeout' || empty($status) || $statusd == 'Not Done') && $status2 == 'inactive'){
			// if($timein < date("G:i", strtotime($restrict))){
			// 	header("Location: index.php?restrict");
			// }else if($timein >= date("G:i", strtotime($restrict)) || empty($restrict)){
			// 	if ($stmt = $mysqli->prepare("INSERT INTO attendance (attendance_id, employee_id, attendance_shift, attendance_restday, attendance_date, attendance_timein, attendance_breakout, attendance_breakin, attendance_timeout, attendance_status, attendance_restrict) VALUES (NULL, '$username', '$emp_shift', '$emp_restday', '$date', '$timein', '', '', '', 'active', '$nxtAvailableLogin')"))
			// 	{
			// 		$stmt->execute();
			// 		$stmt->close();
			// 		header("Location: index.php?timedin");
			// 	}
			// 	// show an error if the query has an error
			// 	else
			// 	{
			// 		echo "ERROR: Could not prepare SQL statement.";
			// 	}
			// }

			function isRestDay($dateWithDayArr, $restArr) {
				if(($restArr[0] == $dateWithDayArr[1]) || ($restArr[1] == $dateWithDayArr[1])) {
					return TRUE;
				} return FALSE;
			}

			if($status == 'inactive'){
				$sql = $mysqli->query("SELECT MIN(attendance_date) FROM attendance");
				$mindate = mysqli_fetch_array($sql);
				if ($sql2 = $mysqli->query("SELECT * FROM attendance WHERE employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive'")){
					if ($sql2->num_rows > 0){
						while ($row = $sql2->fetch_object()){
							$maxes2 = $row->attendance_id;
							$attendance_date = $row->attendance_date;
							
							$restday = $row->attendance_restday;
							$restdayArray = array();
							$restdayArray = split('/', $restday);
							
							$dateWithDay = date('Y-m-d:l', strtotime($attendance_date));
							$dateWithDayArray = array();
							$dateWithDayArray = split(':', $dateWithDay);
							$dateArray = split('-', $dateWithDayArray[0]);

							if($dateRow = $mysqli->query("SELECT * FROM holiday where holiday_date = '$dateWithDayArray[0]'")->fetch_array()) {
								if($dateRow['holiday_type'] == "Regular" || $dateRow['holiday_type'] == "Legal") {
									if(isRestDay($dateWithDayArray, $restdayArray)) {
										$mysqli->query("UPDATE attendance SET attendance_daytype='Rest and Legal Holiday' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive'");	
									} else {
										$mysqli->query("UPDATE attendance SET attendance_daytype='Legal Holiday' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive'");	
									}
								} else {
									if(isRestDay($dateWithDayArray, $restdayArray)) {
										$mysqli->query("UPDATE attendance SET attendance_daytype='Rest and Special Holiday' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive'");	
									} else {
										$mysqli->query("UPDATE attendance SET attendance_daytype='Special Holiday' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive'");	
									}
								}
							} else if(isRestDay($dateWithDayArray, $restdayArray)) {
								$mysqli->query("UPDATE attendance SET attendance_daytype='Rest Day' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive'");	
							} else {
								$mysqli->query("UPDATE attendance SET attendance_daytype='Regular' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive'");	
							}

							if ($e_type = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$username' AND employee_type = 'Fixed'")){
								if ($e_type->num_rows > 0){
									if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_absent = '1', status = 'Done', attendance_late = '0', attendance_undertime = '0', attendance_overbreak = '0' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive' AND attendance_daytype='Regular'"))
									{
										$stmt->execute();
										$stmt->close();
									}
									if ($stmt = $mysqli->prepare("UPDATE attendance SET status = 'Done', attendance_late = '0', attendance_undertime = '0', attendance_overbreak = '0' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive' AND (attendance_daytype='Rest Day' OR attendance_daytype='Special Holiday' OR attendance_daytype='Rest and Special Holiday' OR attendance_daytype='Legal Holiday' OR attendance_daytype='Rest and Legal Holiday')"))
									{
										$stmt->execute();
										$stmt->close();
									}
								}
							}

							if ($e_type2 = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$username' AND employee_type = 'Flexi'")){
								if ($e_type2->num_rows > 0){
									if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_absent = '1', status = 'Done', attendance_late = '0', attendance_undertime = '0', attendance_overbreak = '0' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive' AND (attendance_daytype='Regular' OR attendance_daytype='Special Holiday')"))
									{
										$stmt->execute();
										$stmt->close();
									}
									if ($stmt = $mysqli->prepare("UPDATE attendance SET status = 'Done', attendance_late = '0', attendance_undertime = '0', attendance_overbreak = '0' WHERE attendance_id = '$maxes2' AND employee_id = '$username' AND attendance_date BETWEEN '$mindate[0]' AND '$yesterday' AND attendance_status = 'inactive' AND (attendance_daytype='Rest Day' OR attendance_daytype='Rest and Special Holiday' OR attendance_daytype='Legal Holiday' OR attendance_daytype='Rest and Legal Holiday')"))
									{
										$stmt->execute();
										$stmt->close();
									}
								}
							}
						}
					}
				}
			}

			if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_timein = '$timein2',  attendance_status ='active', attendance_shift = '$emp_shift', attendance_restday = '$emp_restday' WHERE employee_id = '$username' AND attendance_date = '$date'"))
			{
				$stmt->execute();
				$stmt->close();
				header("Location: index.php?timedin");

				$restdayArray = array();
				$restdayArray = split('/', $emp_restday);
							
				$dateWithDay = date('Y-m-d:l');
				$dateWithDayArray = array();
				$dateWithDayArray = split(':', $dateWithDay);
				$dateArray = split('-', $dateWithDayArray[0]);

				if($dateRow = $mysqli->query("SELECT * FROM holiday where holiday_date = '$dateWithDayArray[0]'")->fetch_array()) {
					if($dateRow['holiday_type'] == "Regular" || $dateRow['holiday_type'] == "Legal") {
						if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
							$typeOfDay = "rstlh";
							$mysqli->query("UPDATE attendance SET attendance_daytype='Rest and Legal Holiday' WHERE employee_id = '$username' AND attendance_date = '$date'");	
						} else {
							$typeOfDay = "lh";
							$mysqli->query("UPDATE attendance SET attendance_daytype='Legal Holiday' WHERE employee_id = '$username' AND attendance_date = '$date'");	
						}
					} else {
						if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
							$typeOfDay = "rstsh";
							$mysqli->query("UPDATE attendance SET attendance_daytype='Rest and Special Holiday' WHERE employee_id = '$username' AND attendance_date = '$date'");	
						} else {
							$typeOfDay = "sh";
							$mysqli->query("UPDATE attendance SET attendance_daytype='Special Holiday' WHERE employee_id = '$username' AND attendance_date = '$date'");	
						}
					}
				} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
					$typeOfDay = "rst";
					$mysqli->query("UPDATE attendance SET attendance_daytype='Rest Day' WHERE employee_id = '$username' AND attendance_date = '$date''");	
				} else {
					$mysqli->query("UPDATE attendance SET attendance_daytype='Regular' WHERE employee_id = '$username' AND attendance_date = '$date'");	
				}
				
				include("indexlate.php");
			}
			// show an error if the query has an error
			else
			{
				echo "ERROR: Could not prepare SQL statement.";
			}
	//		}else if ($status == 'break'){
//			if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_breakin = '$timein', attendance_status = 'break' WHERE employee_id = '$username' AND attendance_date = '$date'"))
//				{
//					$stmt->execute();
//					$stmt->close();
//					header("Location: index.php?breaksuccess");
//				}
//				// show an error if the query has an error
//				else
//				{
//					echo "ERROR: Could not prepare SQL statement.";
//				}

		}		
		else if($status2 == 'infrombreak' || $status3 == 'infrombreak'){
			header("location:index.php?infrombreak");
		}
		else {
			header("location:index.php?doubletime");
		}
	}else if (isset($_POST['breakout'])){
			if($status2 == 'active' || $status3 == 'active'){
			$last = $mysqli->insert_id;
				if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_breakout = '$timein2', attendance_status = 'outforbreak' WHERE employee_id = '$username' AND attendance_breakout = '$empty' AND attendance_status = 'active' ORDER BY attendance_id DESC LIMIT 1"))
				{
					$stmt->execute();
					$stmt->close();
					header("Location: index.php?breaksuccess");
				}
				// show an error if the query has an error
				else
				{
					echo "ERROR: Could not prepare SQL statement.";
				}
			}else if($status2 == 'outforbreak' || $status3 == 'outforbreak'){
				header("location:index.php?timedoutforbreak");
			}else if ($status2 == 'infrombreak' || $status3 == 'infrombreak'){
				header("location:index.php?alreadyhadyourbreak");
			}
			else{
				header("location:index.php?alreadyactive");
			}
	}else if (isset($_POST['breakin'])){
			if($status2 == 'outforbreak' || $status3 == 'outforbreak'){
				if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_breakin = '$timein2', attendance_status = 'infrombreak' WHERE employee_id = '$username' AND attendance_breakin = '$empty'  AND attendance_status = 'outforbreak' ORDER BY attendance_id DESC LIMIT 1"))
				{
					$stmt->execute();
					$stmt->close();
					header("Location: index.php?breakinsuccess");
				}
			// show an error if the query has an error
				else
				{
					echo "ERROR: Could not prepare SQL statement.";
				}
			}else if($status2 == 'active' || $status3 == 'active'){
				header("location:index.php?youneedtobreakout");
			}else if($status2 == 'infrombreak' || $status3 == 'infrombreak'){
				header("location:index.php?infrombreak");
			}
			else{
				header("location:index.php?alreadyactive");
			}
	}else if (isset($_POST['out'])) {
		 if ($status2 == 'infrombreak' || $status3 == 'infrombreak') {
			if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_timeout = '$timein2', attendance_status = 'timeout' WHERE employee_id = '$username' AND attendance_timeout = '$empty'  AND attendance_status = 'infrombreak' ORDER BY attendance_id DESC LIMIT 1")) {
				$stmt->execute();
				$stmt->close();
				header("Location: index.php?timedout"); // original limit edit LOIS

				include("updateattendance.php");
			}
			// show an error if the query has an error
			else {
				echo "ERROR: Could not prepare SQL statement.";
			}
		}
		else {
			header("location:index.php?alreadyactive");
			}
		}
	}
		else {
			header('location:index.php?denied');
		}

?>