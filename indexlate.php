<?php

include("dbconfig.php");
$result = $mysqli->query("SELECT * FROM attendance WHERE employee_id = '$username' AND attendance_status = 'active' ORDER BY attendance_id DESC LIMIT 1")->fetch_array();
$maxes = $result['attendance_id'];
$zero = "0.00";
$s_zero = "0";

//late 

$attendance_date = $result['attendance_date'];
$restday = $result['attendance_restday'];
$shifting = $result['attendance_shift'];
$timein = $result['attendance_timein'];

$dateWithDay = date('Y-m-d:l', strtotime($attendance_date));
$dateWithDayArray = array();
$dateWithDayArray = split(':', $dateWithDay);
$dateArray = split('-', $dateWithDayArray[0]);

$restdayArray = array();
$restdayArray = split('/', $restday);

$shiftArray = array();
$shiftArray = split('-', $shifting);

if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])){
	$final = $s_zero;
}else if($fetch_emp['employee_type'] == "Fixed" || $fetch_emp['employee_type'] == "Shifting"){
	if(date('H:i', strtotime($timein)) < $shiftArray[0]){
		$totalLate = "00:00";
		$final = $s_zero;
	}else if($timein > $shiftArray[0]){
		$late = date('H:i', strtotime($timein) - strtotime($shiftArray[0]) - strtotime('16:00'));
		$lateArray = array();
		$lateArray = split(':', $late);
		$hoursTominutes1 = $lateArray[0]*60;
		$totalLate = $hoursTominutes1 + $lateArray[1];
		if($totalLate == "00"){
			$final = $s_zero;
		}else{
			$final = $totalLate;
		}
	}else{
		$final = $s_zero;
	}
}else{//FLEXI
	$final = $s_zero;
}
 $mysqli->query("UPDATE attendance SET attendance_late='$final' WHERE attendance_id='$maxes'");
				//if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_hours='$zero',attendance_late='$late',attendance_undertime='$s_zero',attendance_overbreak,attendance_overtime='$zero',attendance_nightdiff='$zero',REG_OT_ND='$zero',RST_OT='$zero',RST_OT_GRT8='$zero',RST_ND='$zero',RST_ND_GRT8='$zero',LH_OT='$zero',LH_OT_GRT8='$zero',LH_ND='$zero',LH_ND_GRT8='$zero',SH_OT='$zero',SH_OT_GRT8='$zero',SH_ND='$zero',SH_ND_GRT8='$zero',RST_LH_OT='$zero',RST_LH_OT_GRT8='$zero',RST_LH_ND='$zero',RST_LH_ND_GRT8='$zero',RST_SH_OT='$zero',RST_SH_OT_GRT8='$zero',RST_SH_ND='$zero',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'")) {
				//	$stmt2->execute();
				//	$stmt2->close();
				//}

?>