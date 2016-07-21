<?php

if(isset($_POST['adleavesub'])){
	include("dbconfig.php");
	$leavetype = $_POST['leavetype'];
	$reason = $_POST['reason'];
	$empid = $_POST['empid'];
	$length = $_POST['length'];
	if($length == "Full") { 
		$hours = 8.00; 
		$halfBool = 0;
	}
	else {
		$hours = 4.00;
		$halfBool = 1;
	}

	if($_POST['daterange2']==""){
		unset($_POST['daterange2']);
	}
	if($_POST['daterange3']==""){
		unset($_POST['daterange3']);
	}
	if($_POST['daterange4']==""){
		unset($_POST['daterange4']);
	}
	if(isset($_POST['daterange1'])){
		$date = $_POST['daterange1'];
		$constart = substr($date, 0,10);
		$conend = substr($date, 13,22);
		$startdate = date("Y-m-d",strtotime($constart));
		$enddate = date("Y-m-d",strtotime($conend));

		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication.php?able");
		}
	}

	if(isset($_POST['daterange2'])){
		$date1 = $_POST['daterange2'];
		$constart1 = substr($date1, 0,10);
		$conend1 = substr($date1, 13,22);
		$startdate1 = date("Y-m-d",strtotime($constart1));
		$enddate1 = date("Y-m-d",strtotime($conend1));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate1'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate1', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication.php?able");
		}
	}

	if(isset($_POST['daterange3'])){
		$date2 = $_POST['daterange3'];
		$constart2 = substr($date2, 0,10);
		$conend2 = substr($date2, 13,22);
		$startdate2 = date("Y-m-d",strtotime($constart2));
		$enddate2 = date("Y-m-d",strtotime($conend2));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate2'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate2', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication.php?able");
		}
	}


	if(isset($_POST['daterange4'])){
		$date3 = $_POST['daterange4'];
		$constart3 = substr($date3, 0,10);
		$conend3 = substr($date3, 13,22);
		$startdate3 = date("Y-m-d",strtotime($constart3));
		$enddate3 = date("Y-m-d",strtotime($conend3));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate3'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate3', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication.php?able");
		}
	}
}

if(isset($_POST['adleavesub2'])){
	include("dbconfig.php");
	$leavetype = $_POST['leavetype'];
	$reason = $_POST['reason'];
	$empid = $_POST['empid'];
	$length = $_POST['length'];
	if($length == "Full") { 
		$hours = 8.00; 
		$halfBool = 0;
	}
	else {
		$hours = 4.00;
		$halfBool = 1;
	}

	if($_POST['daterange2']==""){
		unset($_POST['daterange2']);
	}
	if($_POST['daterange3']==""){
		unset($_POST['daterange3']);
	}
	if($_POST['daterange4']==""){
		unset($_POST['daterange4']);
	}
	if(isset($_POST['daterange1'])){
		$date = $_POST['daterange1'];
		$constart = substr($date, 0,10);
		$conend = substr($date, 13,22);
		$startdate = date("Y-m-d",strtotime($constart));
		$enddate = date("Y-m-d",strtotime($conend));

		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication2.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication2.php?able");
		}
	}

	if(isset($_POST['daterange2'])){
		$date1 = $_POST['daterange2'];
		$constart1 = substr($date1, 0,10);
		$conend1 = substr($date1, 13,22);
		$startdate1 = date("Y-m-d",strtotime($constart1));
		$enddate1 = date("Y-m-d",strtotime($conend1));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate1'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication2.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate1', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication2.php?able");
		}
	}

	if(isset($_POST['daterange3'])){
		$date2 = $_POST['daterange3'];
		$constart2 = substr($date2, 0,10);
		$conend2 = substr($date2, 13,22);
		$startdate2 = date("Y-m-d",strtotime($constart2));
		$enddate2 = date("Y-m-d",strtotime($conend2));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate2'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication2.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate2', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication2.php?able");
		}
	}


	if(isset($_POST['daterange4'])){
		$date3 = $_POST['daterange4'];
		$constart3 = substr($date3, 0,10);
		$conend3 = substr($date3, 13,22);
		$startdate3 = date("Y-m-d",strtotime($constart3));
		$enddate3 = date("Y-m-d",strtotime($conend3));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate3'");
		if($leavedb->num_rows > 0) {
			header("Location: adminleaveapplication2.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate3', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: adminleaveapplication2.php?able");
		}
	}
}

if(isset($_POST['empleavesub'])){
	include("dbconfig.php");
	$leavetype = $_POST['leavetype'];
	$reason = $_POST['reason'];
	$empid = $_POST['empid'];
	$length = $_POST['length'];
	if($length == "Full") { 
		$hours = 8.00; 
		$halfBool = 0;
	}
	else {
		$hours = 4.00;
		$halfBool = 1;
	}

	if($_POST['daterange2']==""){
		unset($_POST['daterange2']);
	}
	if($_POST['daterange3']==""){
		unset($_POST['daterange3']);
	}
	if($_POST['daterange4']==""){
		unset($_POST['daterange4']);
	}
	if(isset($_POST['daterange1'])){
		$date = $_POST['daterange1'];
		$constart = substr($date, 0,10);
		$conend = substr($date, 13,22);
		$startdate = date("Y-m-d",strtotime($constart));
		$enddate = date("Y-m-d",strtotime($conend));

		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate'");
		if($leavedb->num_rows > 0) {
			header("Location: leaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: leaveapplication.php?able");
		}
	}

	if(isset($_POST['daterange2'])){
		$date1 = $_POST['daterange2'];
		$constart1 = substr($date1, 0,10);
		$conend1 = substr($date1, 13,22);
		$startdate1 = date("Y-m-d",strtotime($constart1));
		$enddate1 = date("Y-m-d",strtotime($conend1));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate1'");
		if($leavedb->num_rows > 0) {
			header("Location: leaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate1', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: leaveapplication.php?able");
		}
	}

	if(isset($_POST['daterange3'])){
		$date2 = $_POST['daterange3'];
		$constart2 = substr($date2, 0,10);
		$conend2 = substr($date2, 13,22);
		$startdate2 = date("Y-m-d",strtotime($constart2));
		$enddate2 = date("Y-m-d",strtotime($conend2));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate2'");
		if($leavedb->num_rows > 0) {
			header("Location: leaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate2', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: leaveapplication.php?able");
		}
	}


	if(isset($_POST['daterange4'])){
		$date3 = $_POST['daterange4'];
		$constart3 = substr($date3, 0,10);
		$conend3 = substr($date3, 13,22);
		$startdate3 = date("Y-m-d",strtotime($constart3));
		$enddate3 = date("Y-m-d",strtotime($conend3));
		
		$leavedb = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = '$empid' AND leave_start = '$startdate3'");
		if($leavedb->num_rows > 0) {
			header("Location: leaveapplication.php?error");
		}
		else{
			$stmt = $mysqli->query("INSERT INTO tbl_leave (employee_id, leave_start, leave_reason, leave_type, leave_halfday, leave_hours) VALUES ('$empid','$startdate3', '$reason', '$leavetype', '$halfBool', '$hours')");
			header("Location: leaveapplication.php?able");
		}
	}
}

?>