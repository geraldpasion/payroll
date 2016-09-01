<?php
include("dbconfig.php");


function HourlyRate($BaseSalary, $PayrollFactor){
	$HourlyRatePay=$BaseSalary*12/$PayrollFactor/8;
	return $HourlyRatePay;
}

function reg_hrs($HoursAttended, $HourlyRatePay){
	$RegularPay=$HoursAttended*$HourlyRatePay;
	return $RegularPay;
}

function reg_ot($HoursOT, $HourlyRatePay){
	$OTPay=$HoursOT*$HourlyRatePay*1.25; //125%
	return $OTPay;
}

function reg_nd($HoursAttended, $HourlyRatePay){
	//additional 10% for night dif
	$NightDiffPay=$HoursAttended*$HourlyRatePay*0.1;
	return $NightDiffPay;
}

function reg_ot_nd($HoursOT, $HourlyRatePay){
	$RegularOTNDPay= $HoursOT*$HourlyRatePay*1.35;
	return $RegularOTNDPay;
}

function rst_ot($HoursAttended, $HourlyRatePay){
	$RDPay = $HoursAttended*$HourlyRatePay*1.3;
	return $RDPay;
}

//more than 8 hours on regular RD
function rst_ot_grt8($HoursOT, $HourlyRatePay){
	$RDOTPay = $HoursOT*$HourlyRatePay*1.6;
	return $RDOTPay;
}

function rst_nd($HoursAttended, $HourlyRatePay){
	$RDNDPay = $HoursAttended*$HourlyRatePay*1.4;
	return $RDNDPay;
}

//*****************************************************note this
function rst_nd_grt8($HoursAttended, $HourlyRatePay){
	$RDNDPayOT = $HoursAttended*$HourlyRatePay*1.7;
	return $RDNDPayOT;
}
//***********************************************

function lh_ot($HoursAttended, $HourlyRatePay){
	$LegalHolidayPay = $HoursAttended * $HourlyRatePay * 1; //200%
	return $LegalHolidayPay;
}

function lh_ot_grt8($HoursOT, $HourlyRatePay){
	$LHOTPay = $HoursOT*$HourlyRatePay*2.6; //100% regular, 100% LH, 130% OT
	return $LHOTPay;
}

function lh_nd($HoursAttended, $HourlyRatePay){
	$LegalHolidayNDPay = $HoursAttended * $HourlyRatePay * 1.1; //200%
	return $LegalHolidayNDPay;
}

function lh_nd_grt8($HoursOT, $HourlyRatePay){
	$LegalHolidayNDOTPay = $HoursOT * $HourlyRatePay * 2.86; //200%
	return $LegalHolidayNDOTPay;
}

function sh_ot($HoursAttended, $HourlyRatePay){
	$SHPay =  $HoursAttended * $HourlyRatePay * 0.3;
	return $SHPay;
}

function sh_ot_grt8($HoursOT, $HourlyRatePay){
	$SHPayOT =  $HoursOT * $HourlyRatePay * 1.69;
	return $SHPayOT;
}

function sh_nd($HoursAttended, $HourlyRatePay){
	//1.53xy - simplified formula
	$SHNDPay =  ($HoursAttended * $HourlyRatePay)* 0.43;
	return $SHNDPay;
}

function sh_nd_grt8($HoursOT, $HourlyRatePay){
	//2.53xy - simplified formula
	$SHNDOTPay =  ($HoursOT * $HourlyRatePay) * 1.86;
	return $SHNDOTPay;
}

function rst_lh_ot($HoursAttended, $HourlyRatePay){
	$RDLHPay = reg_hrs($HoursAttended, $HourlyRatePay) * 2.6;
	return $RDLHPay;
}

//same computation above
function rst_lh_ot_grt8($HoursOT, $HourlyRatePay){
   	$RDLHOTPay = reg_hrs($HoursOT, $HourlyRatePay) * 3.38;
    return $RDLHOTPay;
}

//same computation above * 110%
function rst_lh_nd($HoursAttended, $HourlyRatePay){
  	$RDLHOTNDPay = reg_hrs($HoursAttended, $HourlyRatePay) * 2.86;
   	return $RDLHOTNDPay;
}

 //same computation above * 110%
function rst_lh_nd_grt8($HoursAttended, $HourlyRatePay){
  	$RDLHOTNDOTPay =reg_hrs($HoursAttended, $HourlyRatePay)*2.7; //with * 110%;
   	return $RDLHOTNDOTPay;
}

 function rst_sh_ot($HoursAttended, $HourlyRatePay){
 	$RDSHPay = reg_hrs($HoursAttended, $HourlyRatePay) * 1.5; //150%
 	return $RDSHPay;
}

function rst_sh_ot_grt8($HoursAttended, $HourlyRatePay){
 	$RDSHOTPay = reg_hrs($HoursAttended, $HourlyRatePay) * 1.95; //150%
 	return $RDSHOTPay;
}

//RD SH night differential
function rst_sh_nd($HoursAttended, $HourlyRatePay){
	$RDSHNDPay = reg_hrs($HoursAttended, $HourlyRatePay) * 1.65; //150% SH, 110% ND
	return $RDSHNDPay;
}

function rst_sh_nd_grt8($HoursAttended, $HourlyRatePay){
	$RDSHNDOTPay = reg_hrs($HoursAttended, $HourlyRatePay) * 2.145; //150% SH, 110% ND
	return $RDSHNDOTPay;
}

// post data from the form in additionalpayable.php 
$end = $_POST['end1'];
$isAbsent = $_POST['isabsent'];
$reason = $_POST['reason1'];
$start = $_POST['start1'];
$breakin = $_POST['breakin1'];
$breakout = $_POST['breakout1'];

 $end = str_replace(' ', '', $end);
 $count=strlen($end);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
 $end = substr_replace($end, '', $replace_count, 1);
 $end = date("G:i", strtotime($end));

$start = str_replace(' ', '', $start);
 $count=strlen($start);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
$start = substr_replace($start, '', $replace_count, 1);
$start = date("G:i", strtotime($start));

$breakin = str_replace(' ', '', $breakin);
 $count=strlen($breakin);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
$breakin = substr_replace($breakin, '', $replace_count, 1);
$breakin = date("G:i", strtotime($breakin));

$breakout = str_replace(' ', '', $breakout);
 $count=strlen($breakout);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
$breakout = substr_replace($breakout, '', $replace_count, 1);
$breakout = date("G:i", strtotime($breakout));

echo 'start: '.$start."<br>";
echo 'breakout: '.$breakout."<br>";
echo 'breakin: '.$breakin."<br>";
echo 'end: '.$end."<br>";

//**************************************************

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
		// $end = str_replace(' ', '', $end);
		// $end = substr_replace($end, '', 5, 1);
		// $end = date("H:i", strtotime($end));

		// $start = str_replace(' ', '', $start);
		// $start = substr_replace($start, '', 5, 1);
		// $start = date("H:i", strtotime($start));

		// $breakin = str_replace(' ', '', $breakin);
		// $breakin = substr_replace($breakin, '', 5, 1);
		// $breakin = date("H:i", strtotime($breakin));

		// $breakout = str_replace(' ', '', $breakout);
		// $breakout = substr_replace($breakout, '', 5, 1);
		// $breakout = date("H:i", strtotime($breakout));
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

	$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE attendance_date = '$date' AND employee_id = '$id'")->fetch_array();
	$othersData = $mysqli->query("SELECT * FROM others WHERE attendance_date = '$date' AND employee_id = '$id'")->fetch_array();
	$others_id = $othersData['others_id'];
	$pfactorData = $mysqli->query("SELECT * FROM payrollfactor WHERE id = '1'")->fetch_array();
	$empData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$id'")->fetch_array();
	$payrollfactor = $pfactorData['factor'];
	$rate = $empData['employee_rate'];
	$totalAtt = 0.00;
	$totalOthers = 0.00;
	$hourlypay = HourlyRate($rate,$payrollfactor);

	$totalAtt = $totalAtt + reg_hrs($attendanceData['attendance_hours'], $hourlypay);
	$totalAtt = $totalAtt + reg_ot($attendanceData['attendance_overtime'], $hourlypay);
	$totalAtt = $totalAtt + reg_nd($attendanceData['attendance_nightdiff'], $hourlypay);
	$totalAtt = $totalAtt + reg_ot_nd($attendanceData['REG_OT_ND'], $hourlypay);
	$totalAtt = $totalAtt + rst_ot($attendanceData['RST_OT'], $hourlypay);
	$totalAtt = $totalAtt + rst_ot_grt8($attendanceData['RST_OT_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + rst_nd($attendanceData['RST_ND'], $hourlypay);
	$totalAtt = $totalAtt + rst_nd_grt8($attendanceData['RST_ND_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + lh_ot($attendanceData['LH_OT'], $hourlypay);
	$totalAtt = $totalAtt + lh_ot_grt8($attendanceData['LH_OT_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + lh_nd($attendanceData['LH_ND'], $hourlypay);
	$totalAtt = $totalAtt + lh_nd_grt8($attendanceData['LH_ND_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + sh_ot($attendanceData['SH_OT'], $hourlypay);
	$totalAtt = $totalAtt + sh_ot_grt8($attendanceData['SH_OT_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + sh_nd($attendanceData['SH_ND'], $hourlypay);
	$totalAtt = $totalAtt + sh_nd_grt8($attendanceData['SH_ND_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + rst_lh_ot($attendanceData['RST_LH_OT'], $hourlypay);
	$totalAtt = $totalAtt + rst_lh_ot_grt8($attendanceData['RST_LH_OT_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + rst_lh_nd($attendanceData['RST_LH_ND'], $hourlypay);
	$totalAtt = $totalAtt + rst_lh_nd_grt8($attendanceData['RST_LH_ND_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + rst_sh_ot($attendanceData['RST_SH_OT'], $hourlypay);
	$totalAtt = $totalAtt + rst_sh_ot_grt8($attendanceData['RST_SH_OT_GRT8'], $hourlypay);
	$totalAtt = $totalAtt + rst_sh_nd($attendanceData['RST_SH_ND'], $hourlypay);
	$totalAtt = $totalAtt + rst_sh_nd_grt8($attendanceData['RST_SH_ND_GRT8'], $hourlypay);

	$totalOthers = $totalOthers + reg_hrs($othersData['attendance_hours'], $hourlypay);
	$totalOthers = $totalOthers + reg_ot($othersData['attendance_overtime'], $hourlypay);
	$totalOthers = $totalOthers + reg_nd($othersData['attendance_nightdiff'], $hourlypay);
	$totalOthers = $totalOthers + reg_ot_nd($othersData['REG_OT_ND'], $hourlypay);
	$totalOthers = $totalOthers + rst_ot($othersData['RST_OT'], $hourlypay);
	$totalOthers = $totalOthers + rst_ot_grt8($othersData['RST_OT_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + rst_nd($othersData['RST_ND'], $hourlypay);
	$totalOthers = $totalOthers + rst_nd_grt8($othersData['RST_ND_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + lh_ot($othersData['LH_OT'], $hourlypay);
	$totalOthers = $totalOthers + lh_ot_grt8($othersData['LH_OT_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + lh_nd($othersData['LH_ND'], $hourlypay);
	$totalOthers = $totalOthers + lh_nd_grt8($othersData['LH_ND_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + sh_ot($othersData['SH_OT'], $hourlypay);
	$totalOthers = $totalOthers + sh_ot_grt8($othersData['SH_OT_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + sh_nd($othersData['SH_ND'], $hourlypay);
	$totalOthers = $totalOthers + sh_nd_grt8($othersData['SH_ND_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + rst_lh_ot($othersData['RST_LH_OT'], $hourlypay);
	$totalOthers = $totalOthers + rst_lh_ot_grt8($othersData['RST_LH_OT_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + rst_lh_nd($othersData['RST_LH_ND'], $hourlypay);
	$totalOthers = $totalOthers + rst_lh_nd_grt8($othersData['RST_LH_ND_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + rst_sh_ot($othersData['RST_SH_OT'], $hourlypay);
	$totalOthers = $totalOthers + rst_sh_ot_grt8($othersData['RST_SH_OT_GRT8'], $hourlypay);
	$totalOthers = $totalOthers + rst_sh_nd($othersData['RST_SH_ND'], $hourlypay);
	$totalOthers = $totalOthers + rst_sh_nd_grt8($othersData['RST_SH_ND_GRT8'], $hourlypay);

	$retro = $totalOthers - $totalAtt;

	$mysqli->query("UPDATE others SET others_paid='$totalAtt',others_payable='$totalOthers',others_retro='$retro' WHERE others_id='$others_id'");

	echo "Form Submitted xxx Succesfully";
}
?>