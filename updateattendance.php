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

	if($from == "index") {
		$logArray = array();
		$logArray = split(' ', $logtime);
		$logDateArray = split('-', $logArray[0]);
		$logTimeArray = split(':', $logArray[1]);
		$logyear = $logDateArray[0];
		$logmonth = $logDateArray[1];
		$logday = $logDateArray[2];
		$loghour = $logTimeArray[0];
		$logmin = $logTimeArray[1];
		$result = $mysqli->query("SELECT * FROM attendance WHERE employee_id = '$username' AND attendance_status = 'timeout' ORDER BY attendance_id DESC LIMIT 1")->fetch_array();
	} else {
		$logday = 0;
		$result = $mysqli->query("SELECT * FROM attendance WHERE attendance_id = '$maxes2'")->fetch_array();
	}

	$timein = $result['attendance_timein'];
	$timeout = $result['attendance_timeout'];
	$breakin = $result['attendance_breakin'];
	$breakout = $result['attendance_breakout'];

	$attendance_date = $result['attendance_date'];
	$employee_id = $result['employee_id'];
	$attendance_id = $result['attendance_id'];
	$restday = $result['attendance_restday'];
	$restdayArray = array();
	$restdayArray = split('/', $restday);
	$shifting = $result['attendance_shift'];
	$shiftArray = array();
	$shiftArray = split('-', $shifting);
	$isNightShift = 0;
	$attend = $result['attendance_status'];
	$hasApprovedOT = 0;

	$zero = "0.00";
	$s_zero = "0";

	$dateWithDay = date('Y-m-d:l', strtotime($attendance_date));
	$dateWithDayArray = array();
	$dateWithDayArray = split(':', $dateWithDay);
	$dateArray = split('-', $dateWithDayArray[0]);

	$ndStart = "22:00"; // night diff sched
	$ndEnd = "06:00";

	// checks type of day given the attendance date
	$typeOfDay = "reg";
	if($dateRow = $mysqli->query("SELECT * FROM holiday where holiday_date = '$dateWithDayArray[0]'")->fetch_array()) {
		if($dateRow['holiday_type'] == "Regular" || $dateRow['holiday_type'] == "Legal") {
			if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
				$typeOfDay = "rstlh";
				$mysqli->query("UPDATE attendance SET attendance_daytype='Rest and Legal Holiday' WHERE attendance_id='$attendance_id'");	
			} else {
				$typeOfDay = "lh";
				$mysqli->query("UPDATE attendance SET attendance_daytype='Legal Holiday' WHERE attendance_id='$attendance_id'");	
			}
		} else {
			if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
				$typeOfDay = "rstsh";
				$mysqli->query("UPDATE attendance SET attendance_daytype='Rest and Special Holiday' WHERE attendance_id='$attendance_id'");	
			} else {
				$typeOfDay = "sh";
				$mysqli->query("UPDATE attendance SET attendance_daytype='Special Holiday' WHERE attendance_id='$attendance_id'");	
			}
		}
	} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
		$typeOfDay = "rst";
		$mysqli->query("UPDATE attendance SET attendance_daytype='Rest Day' WHERE attendance_id='$attendance_id'");	
	} else {
		$mysqli->query("UPDATE attendance SET attendance_daytype='Regular' WHERE attendance_id='$attendance_id'");	
	}

	// UPDATE ATTENDANCE BOOL
	if($fetch_emp['employee_type'] == "Flexi") {
		if($typeOfDay == "reg" || $typeOfDay == "sh") {
			if($attend == "inactive"){
				$mysqli->query("UPDATE attendance SET attendance_absent='1' WHERE attendance_id='$attendance_id'");
				$isAbsent = 1;
			} else {
				$mysqli->query("UPDATE attendance SET attendance_absent='0' WHERE attendance_id='$attendance_id'");
				$isAbsent = 0;
			}
		} else {
			$mysqli->query("UPDATE attendance SET attendance_absent='0' WHERE attendance_id='$attendance_id'");
			$isAbsent = 0;
		}
	} else {
		if($typeOfDay == "reg") {
			if($attend == "inactive"){
				$mysqli->query("UPDATE attendance SET attendance_absent='1' WHERE attendance_id='$attendance_id'");
				$isAbsent = 1;
			} else {
				$mysqli->query("UPDATE attendance SET attendance_absent='0' WHERE attendance_id='$attendance_id'");
				$isAbsent = 0;
			}
		} else {
			$mysqli->query("UPDATE attendance SET attendance_absent='0' WHERE attendance_id='$attendance_id'");
			$isAbsent = 0;
		}
	}

	if($shiftArray[0] >= $ndStart) {
		$isNightShift = 1; // checks if night shift
	}

	$OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'");
	if($OT->num_rows > 0) {
		$hasApprovedOT = 1; // checks if employee has an approved overtime for that date
	}

	$prevWorkingDay = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$employee_id' AND attendance_date < '$attendance_date' AND attendance_daytype='Regular' ORDER BY attendance_date DESC LIMIT 1");
	if($prevWorkingDay->num_rows > 0) {
		while($prevWorkDayResult = $prevWorkingDay->fetch_object()) {
			$isAbsentPrevWorkingDay = $prevWorkDayResult->attendance_status; // checks if absent previous regular day
		}
	}

	// COMPUTE LATE
	if($attend == "inactive") {
		$mysqli->query("UPDATE attendance SET attendance_late='8' WHERE attendance_id='$attendance_id'");
	} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])){
		$mysqli->query("UPDATE attendance SET attendance_late='6' WHERE attendance_id='$attendance_id'");
	}else if($fetch_emp['employee_type'] == "Fixed" || $fetch_emp['employee_type'] == "Shifting"){
		if(date('H:i', strtotime($timein)) < $shiftArray[0]){
			if($isNightShift == 0) {
				$totalLate = "00:00";
				$mysqli->query("UPDATE attendance SET attendance_late='1' WHERE attendance_id='$attendance_id'");
			}
		}else if(($timein > $shiftArray[0]) || ($isNightShift == 1 && date('H:i', strtotime($timein)) < $shiftArray[0])){
			if($from == "index") {
				$late = date('H:i', strtotime($timein) - strtotime($shiftArray[0]) - strtotime('16:00'));
			} else {
				$late = date('H:i', strtotime($timein) - strtotime($shiftArray[0]) - strtotime('03:00'));
			}
			$lateArray = array();
			$lateArray = split(':', $late);
			$hoursTominutes1 = $lateArray[0]*60;
			$totalLate = $hoursTominutes1 + $lateArray[1];
			if($totalLate == "00"){
				$mysqli->query("UPDATE attendance SET attendance_late='12' WHERE attendance_id='$attendance_id'");
			}else{
				$mysqli->query("UPDATE attendance SET attendance_late='5' WHERE attendance_id='$attendance_id'");
			}
		}else{
			$mysqli->query("UPDATE attendance SET attendance_late='14' WHERE attendance_id='$attendance_id'");
		}
	}else{//FLEXI
		$mysqli->query("UPDATE attendance SET attendance_late='13' WHERE attendance_id='$attendance_id'");
	}

	// COMPUTE UNDERTIME
	if($attend == "inactive") {
		$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
	} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])){
		$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
	}else if($fetch_emp['employee_type'] == "Fixed" || $fetch_emp['employee_type'] == "Shifting"){
		if($timeout < $shiftArray[1]){
			if($from == "index") {
				if(($logday > $dateWithDayArray[2]) && ($isNightShift == 0)) {
					$undertime = date('H:i', strtotime('00:00'));
				} else {
					$undertime = date('H:i', strtotime($shiftArray[1]) - strtotime($timeout) - strtotime('16:00'));
				}
			} else {
				// if($isNightShift == 1 && $timeout < "07:00") {
				// 	$undertime = date('H:i', strtotime($shiftArray[1]) - strtotime($timeout));
				// } else 
				if($isNightShift == 1 && $timeout > "07:00") {
					$undertime = "00:00";
				} else {
					$undertime = date('H:i', strtotime($shiftArray[1]) - strtotime($timeout) - 3600);
				}
			}
			$undertimeArray = array();
			$undertimeArray = split(':', $undertime);
			$hoursTominutes2 = $undertimeArray[0]*60;
			$totalUndertime = $hoursTominutes2 + $undertimeArray[1];
			if($totalUndertime == "00"){
				$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
			}else{
				$mysqli->query("UPDATE attendance SET attendance_undertime='$totalUndertime' WHERE attendance_id='$attendance_id'");
			}
		}else{
			$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
		}
	}else{//FLEXI
		$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
	}

	$out = date('H:i', strtotime($breakout));
	$breaktimeArray = array();
	$breaktimeArray = split(':', $out);
	$breaktimehr = $breaktimeArray[0] + 1;
	$hoursTominutes2 = $breaktimehr*60;
	$totalbreaktime = $hoursTominutes2 + $breaktimeArray[1];
	$btime = mktime($breaktimehr, $breaktimeArray[1]);
	$breaktime = date('H:i', $btime);

	//get break in time
	$in = date('H:i', strtotime($breakin));
	$breakinArray = array();
	$breakinArray = split(':', $in);
	$hoursTominutes2 = $breakinArray[0]*60;
	$totalbreakin = $hoursTominutes2 + $breakinArray[1];

	// COMPUTE OVERBREAK
	if($attend == "inactive") {
		$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
	} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
		$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
		$ob = 0;
	}else if($fetch_emp['employee_type'] == "Fixed" || $fetch_emp['employee_type'] == "Shifting") {
		if ($totalbreaktime < $totalbreakin){
			if($totalbreakin == ""){
				$totalbreakin = $totalbreaktime;
			}
			$overbreak = date('H:i', strtotime($breakin) - strtotime($breaktime) - strtotime('03:00'));
			$totalOverbreak = $totalbreakin - $totalbreaktime;


			if($totalOverbreak == "00"){
				$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
				$ob = 0;
			}else{
				$mysqli->query("UPDATE attendance SET attendance_overbreak='$totalOverbreak' WHERE attendance_id='$attendance_id'");
				$ob = $totalOverbreak;
			}
		}else{
			$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
			$ob = 0;
		}
	}else {//FLEXI
		$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
		$ob = 0;
	}
	
	// END of compute late, undertime, overtime
	

	$regHours = "0.00";
	$overtime = "0.00";
	$nightdiff = "0.00";
	$reg_ot_nd = "0.00";
	$rst_ot = "0.00";
	$rst_ot_grt8 = "0.00";
	$rst_nd = "0.00";
	$rst_nd_grt8 = "0.00";
	$lh_ot = "0.00"; 
	$lh_ot_grt8 = "0.00";
	$lh_nd = "0.00";
	$lh_nd_grt8 = "0.00";
	$sh_ot = "0.00";
	$sh_ot_grt8 = "0.00";
	$sh_nd = "0.00";
	$sh_nd_grt8 = "0.00";
	$rst_lh_ot = "0.00";
	$rst_lh_ot_grt8 = "0.00";
	$rst_lh_nd = "0.00";
	$rst_lh_nd_grt8 = "0.00";
	$rst_sh_ot = "0.00";
	$rst_sh_ot_grt8 = "0.00";
	$rst_sh_nd = "0.00";
	$rst_sh_nd_grt8 = "0.00";

	// compute hours of work (based on day)
	// only computes columns that should be updated for the type of day
	// all columns are initialized to zero

	if($fetch_emp['employee_type'] == "Fixed" || $fetch_emp['employee_type'] == "Shifting") { // computation for fixed/shifting
		if($typeOfDay == "reg") { // if regular day
			if($attend == "timeout") { // not absent
				$regHours = computeHours($timein, $timeout);
				if($isNightShift == 1) {
					$tempTimeout = $timeout;
					if($timeout < $timein && $timeout > $shiftArray[1]) $timeout = $shiftArray[1];
					if($tempTimeout < $timein && $timein < $shiftArray[0]) $timein = $shiftArray[0];
				} else {
					$tempTimeout = $timeout;
					if($timein > $timeout) $timeout = $shiftArray[1];
					else if($timeout > $timein && $timeout > $shiftArray[1]) $timeout = $shiftArray[1];
					if($tempTimeout > $timein && $timein < $shiftArray[0]) $timein = $shiftArray[0];
				}
				$regHours = computeHours($timein, $timeout);
				if($timein == $timeout) $regHours = 0.00;
				if($regHours >= 5.00) {
					$regHours = $regHours - 1.00;
				}
				if($regHours > 8.00) {
					$regHours = 8.00;
				}
				if($isNightShift == 1) {
					$nightdiff = computeND($timein, $timeout);
					if($nightdiff > 1.00) {
						$nightdiff = $nightdiff - 1.00;
					} else {
						$nightdiff = 0.00;
					}

					if($nightdiff > 7.00) {
						$nightdiff = 7.00;
					}
				}
				if($hasApprovedOT == 1) {
					if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
						if($OT->num_rows > 0){
							while($OTResult = $OT->fetch_object()){
								$overtimeStart = $OTResult->overtime_start;
								$overtimeStart = substr($overtimeStart, 0, -3);
								$overtimeEnd = $OTResult->overtime_end;
								$overtimeEnd = substr($overtimeEnd, 0, -3);
								//$overtime = $OTResult->overtime_duration;
								$totalOT = computeHours($overtimeStart, $overtimeEnd);
								if($totalOT >= 5.00) {
									$totalOT = $totalOT - 1.00;
								}
								if($isNightShift == 0) {
									$nd = computeND($overtimeStart, $overtimeEnd);
									if($nd >= 1.00) {
										$reg_ot_nd = $nd - 1.00;
									} else {
										$reg_ot_nd = 0.00;
									}
									$overtime = $totalOT - $reg_ot_nd;
								} else if($isNightShift == 1) {
									$overtime = $totalOT;
								}
							}
						}
					}
				}
			}
		} else if($typeOfDay == "rst") { // if rest day only
			if($attend == "timeout") { // not absent
				if($hasApprovedOT == 1) {
					if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
						if($OT->num_rows > 0){
							$rst_ot = 0.00;
							$rst_ot_grt8 = 0.00;
							$rst_nd = 0.00;
							$rst_nd_grt8 = 0.00;
							while($OTResult = $OT->fetch_object()){
								$overtimeStart = $OTResult->overtime_start;
								$overtimeStart = substr($overtimeStart, 0, -3);
								$overtimeEnd = $OTResult->overtime_end;
								$overtimeEnd = substr($overtimeEnd, 0, -3);
								$regHours = computeHours($overtimeStart, $overtimeEnd);
								if($regHours >= 5.00) {
									$regHours = $regHours - 1.00;
								}
								if($isNightShift == 0) {
									$nd = computeND($overtimeStart, $overtimeEnd);
									if($nd >= 1.00) {
										$rst_nd_grt8 = $nd - 1.00;
									} else {
										$rst_nd_grt8 = 0.00;
									}
									$rst_ot = $regHours - $rst_nd_grt8;
									if($rst_ot > 8.0) {
										$rst_ot_grt8 = $rst_ot - 8.00;
										$rst_ot = 8.00;
									}
								} else if($isNightShift == 1) {
									$rst_nd = computeND($overtimeStart, $overtimeEnd);
									
									if($rst_nd >= 1.00) $rst_nd = $rst_nd - 1.00;
									else $rst_nd = 0.00;

									if($rst_nd > 7.00) {
										$rst_ot = $regHours - 7.00;
										$rst_nd = 7.00;
										if($rst_ot > 1.00) {
											$rst_ot_grt8 = $rst_ot - 1.00;
											$rst_ot = 1.00;
										}
									}
								}
							}
						}
						$overtime = 0.00;
					}
					$regHours = $zero;
				}
			}
		} else if($typeOfDay == "lh") { // if legal holiday only
			if($attend == "timeout" && $isAbsentPrevWorkingDay != "inactive") { // not absent
				$regHours = computeHours($timein, $timeout);
				if($regHours >= 5.00) {
					$regHours = $regHours - 1.00;
				}

				if($isNightShift == 0) {
					//$lh_nd_grt8 = computeND($timein, $timeout) - 1.00;
					$nd = computeND($timein, $timeout);
					$lh_ot = $regHours;
					if($nd >= 1.00) {
						$lh_nd_grt8 = $nd - 1.00;
						if($lh_nd_grt8 > 7.00) {
							$lh_ot = $regHours - 7.00;
							$lh_nd_grt8 = 7.00;
							if($lh_ot > 1.00) {
								$lh_ot_grt8 = $lh_ot - 1.00;
								$lh_ot = 1.00;
							}
						}
					} else {
						$lh_nd_grt8 = 0.00;
						if($lh_ot > 8.00) {
							$lh_ot_grt8 = $lh_ot - 8.00;
							$lh_ot = 8.00;
						}
					}
					$regHours = $regHours - $lh_ot_grt8;
				} else if($isNightShift == 1) {
					$nd = computeND($timein, $timeout);
					$lh_ot = $regHours;
					if($nd >= 1.00) {
						$lh_nd = $nd - 1.00;
						if($lh_nd > 7.00) {
							$lh_ot = $regHours - 7.00;
							$lh_nd = 7.00;
							if($lh_ot > 1.00) {
								$lh_ot_grt8 = $lh_ot - 1.00;
								$lh_ot = 1.00;
							}
						}
					} else {
						$lh_nd = 0.00;
						if($lh_ot > 8.00) {
							$lh_ot_grt8 = $lh_ot - 8.00;
							$lh_ot = 8.00;
						}
					}
					$regHours = $regHours - $lh_ot_grt8;
				}
			} else if($attend == "inactive") { // absent; per law there is bonus lh_ot
				$lh_ot = "8.00";
			} else if($isAbsentPrevWorkingDay == "inactive") {
				if($attend == "timeout") { // not absent
					$regHours = computeHours($timein, $timeout);
					if($isNightShift == 1) {
						$tempTimeout = $timeout;
						if($timeout < $timein && $timeout > $shiftArray[1]) $timeout = $shiftArray[1];
						if($tempTimeout < $timein && $timein < $shiftArray[0]) $timein = $shiftArray[0];
					} else {
						$tempTimeout = $timeout;
						if($timein > $timeout) $timeout = $shiftArray[1];
						else if($timeout > $timein && $timeout > $shiftArray[1]) $timeout = $shiftArray[1];
						if($tempTimeout > $timein && $timein < $shiftArray[0]) $timein = $shiftArray[0];
					}
					$regHours = computeHours($timein, $timeout);
					if($timein == $timeout) $regHours = 0.00;
					if($regHours >= 5.00) {
						$regHours = $regHours - 1.00;
					}
					if($regHours > 8.00) {
						$regHours = 8.00;
					}
					if($isNightShift == 1) {
						$nightdiff = computeND($timein, $timeout);
						if($nightdiff > 1.00) {
							$nightdiff = $nightdiff - 1.00;
						} else {
							$nightdiff = 0.00;
						}

						if($nightdiff > 7.00) {
							$nightdiff = 7.00;
						}
					}
					if($hasApprovedOT == 1) {
						if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
							if($OT->num_rows > 0){
								while($OTResult = $OT->fetch_object()){
									$overtimeStart = $OTResult->overtime_start;
									$overtimeStart = substr($overtimeStart, 0, -3);
									$overtimeEnd = $OTResult->overtime_end;
									$overtimeEnd = substr($overtimeEnd, 0, -3);
									//$overtime = $OTResult->overtime_duration;
									$totalOT = computeHours($overtimeStart, $overtimeEnd);
									if($totalOT >= 5.00) {
										$totalOT = $totalOT - 1.00;
									}
									if($isNightShift == 0) {
										$nd = computeND($overtimeStart, $overtimeEnd);
										if($nd >= 1.00) {
											$reg_ot_nd = $nd - 1.00;
										} else {
											$reg_ot_nd = 0.00;
										}
										$overtime = $totalOT - $reg_ot_nd;
									} else if($isNightShift == 1) {
										$overtime = $totalOT;
									}
								}
							}
						}
					}
				}
			}
		} else if($typeOfDay == "sh") { // if special holiday only
			if($attend == "timeout" && $isAbsentPrevWorkingDay != "inactive") { // not absent
				$regHours = computeHours($timein, $timeout);
				if($regHours >= 5.00) {
					$regHours = $regHours - 1.00;
				}
				if($isNightShift == 0) {
					//$lh_nd_grt8 = computeND($timein, $timeout) - 1.00;
					$nd = computeND($timein, $timeout);
					$sh_ot = $regHours;
					if($nd >= 1.00) {
						$sh_nd_grt8 = $nd - 1.00;
						if($sh_nd_grt8 > 7.00) {
							$sh_ot = $regHours - 7.00;
							$sh_nd_grt8 = 7.00;
							if($sh_ot > 1.00) {
								$sh_ot_grt8 = $sh_ot - 1.00;
								$sh_ot = 1.00;
							}
						}
					} else {
						$sh_nd_grt8 = 0.00;
						if($sh_ot > 8.00) {
							$sh_ot_grt8 = $sh_ot - 8.00;
							$sh_ot = 8.00;
						}
					}
					$regHours = $regHours - $sh_ot_grt8;
				} else if($isNightShift == 1) {
					$nd = computeND($timein, $timeout);
					$sh_ot = $regHours;
					if($nd >= 1.00) {
						$sh_nd = $nd - 1.00;
						if($sh_nd > 7.00) {
							$sh_ot = $regHours - 7.00;
							$sh_nd = 7.00;
							if($sh_ot > 1.00) {
								$sh_ot_grt8 = $sh_ot - 1.00;
								$sh_ot = 1.00;
							}
						}
					} else {
						$sh_nd = 0.00;
						if($sh_ot > 8.00) {
							$sh_ot_grt8 = $sh_ot - 8.00;
							$sh_ot = 8.00;
						}
					}
					$regHours = $regHours - $sh_ot_grt8;
				}
			} else if($isAbsentPrevWorkingDay == "inactive") {
				if($attend == "timeout") { // not absent
					$regHours = computeHours($timein, $timeout);
					if($isNightShift == 1) {
						$tempTimeout = $timeout;
						if($timeout < $timein && $timeout > $shiftArray[1]) $timeout = $shiftArray[1];
						if($tempTimeout < $timein && $timein < $shiftArray[0]) $timein = $shiftArray[0];
					} else {
						$tempTimeout = $timeout;
						if($timein > $timeout) $timeout = $shiftArray[1];
						else if($timeout > $timein && $timeout > $shiftArray[1]) $timeout = $shiftArray[1];
						if($tempTimeout > $timein && $timein < $shiftArray[0]) $timein = $shiftArray[0];
					}
					$regHours = computeHours($timein, $timeout);
					if($timein == $timeout) $regHours = 0.00;
					if($regHours >= 5.00) {
						$regHours = $regHours - 1.00;
					}
					if($regHours > 8.00) {
						$regHours = 8.00;
					}
					if($isNightShift == 1) {
						$nightdiff = computeND($timein, $timeout);
						if($nightdiff > 1.00) {
							$nightdiff = $nightdiff - 1.00;
						} else {
							$nightdiff = 0.00;
						}

						if($nightdiff > 7.00) {
							$nightdiff = 7.00;
						}
					}
					if($hasApprovedOT == 1) {
						if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
							if($OT->num_rows > 0){
								while($OTResult = $OT->fetch_object()){
									$overtimeStart = $OTResult->overtime_start;
									$overtimeStart = substr($overtimeStart, 0, -3);
									$overtimeEnd = $OTResult->overtime_end;
									$overtimeEnd = substr($overtimeEnd, 0, -3);
									//$overtime = $OTResult->overtime_duration;
									$totalOT = computeHours($overtimeStart, $overtimeEnd);
									if($totalOT >= 5.00) {
										$totalOT = $totalOT - 1.00;
									}
									if($isNightShift == 0) {
										$nd = computeND($overtimeStart, $overtimeEnd);
										if($nd >= 1.00) {
											$reg_ot_nd = $nd - 1.00;
										} else {
											$reg_ot_nd = 0.00;
										}
										$overtime = $totalOT - $reg_ot_nd;
									} else if($isNightShift == 1) {
										$overtime = $totalOT;
									}
								}
							}
						}
					}
				}
			}
		} else if($typeOfDay == "rstlh") { // if rest && legal holiday
			$rst_lh_ot = 0.00;
			$rst_lh_ot_grt8 = 0.00;
			$rst_lh_nd = 0.00;
			$rst_lh_nd_grt8 = 0.00;
			if($attend == "timeout" && $isAbsentPrevWorkingDay != "inactive") {
				if($hasApprovedOT == 1) {
					if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
						if($OT->num_rows > 0){
							while($OTResult = $OT->fetch_object()){
								$overtimeStart = $OTResult->overtime_start;
								$overtimeStart = substr($overtimeStart, 0, -3);
								$overtimeEnd = $OTResult->overtime_end;
								$overtimeEnd = substr($overtimeEnd, 0, -3);
								//$overtime = $OTResult->overtime_duration;
								$regHours = computeHours($overtimeStart, $overtimeEnd);
								if($regHours >= 5.00) {
									$regHours = $regHours - 1.00;
								}
								if($isNightShift == 0) {
									$rst_lh_nd_grt8 = computeND($overtimeStart, $overtimeEnd) - 1.00;
									$rst_lh_ot = $regHours - $rst_lh_nd_grt8;
									if($rst_lh_ot > 8.0) {
										$rst_lh_ot_grt8 = $rst_lh_ot - 8.00;
										$rst_lh_ot = 8.00;
									}
								} else if($isNightShift == 1) {
									$rst_lh_nd = computeND($overtimeStart, $overtimeEnd) - 1.00;
									if($rst_lh_nd > 7.00) {
										$rst_lh_ot = $regHours - 7.00;
										$rst_lh_nd = 7.00;
										if($rst_lh_ot > 1.00) {
											$rst_lh_ot_grt8 = $rst_lh_ot - 1.00;
											$rst_lh_ot = 1.00;
										}
									}
								}
							}
						}
						$overtime = 0.00;
					}
					$regHours = $zero;
				}
			} else if($isAbsentPrevWorkingDay == "inactive") {
				if($attend == "timeout") { // not absent
					if($hasApprovedOT == 1) {
						if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
							if($OT->num_rows > 0){
								$rst_ot = 0.00;
								$rst_ot_grt8 = 0.00;
								$rst_nd = 0.00;
								$rst_nd_grt8 = 0.00;
								while($OTResult = $OT->fetch_object()){
									$overtimeStart = $OTResult->overtime_start;
									$overtimeStart = substr($overtimeStart, 0, -3);
									$overtimeEnd = $OTResult->overtime_end;
									$overtimeEnd = substr($overtimeEnd, 0, -3);
									$regHours = computeHours($overtimeStart, $overtimeEnd);
									if($regHours >= 5.00) {
										$regHours = $regHours - 1.00;
									}
									if($isNightShift == 0) {
										$nd = computeND($overtimeStart, $overtimeEnd);
										if($nd >= 1.00) {
											$rst_nd_grt8 = $nd - 1.00;
										} else {
											$rst_nd_grt8 = 0.00;
										}
										$rst_ot = $regHours - $rst_nd_grt8;
										if($rst_ot > 8.0) {
											$rst_ot_grt8 = $rst_ot - 8.00;
											$rst_ot = 8.00;
										}
									} else if($isNightShift == 1) {
										$rst_nd = computeND($overtimeStart, $overtimeEnd);
										
										if($rst_nd >= 1.00) $rst_nd = $rst_nd - 1.00;
										else $rst_nd = 0.00;

										if($rst_nd > 7.00) {
											$rst_ot = $regHours - 7.00;
											$rst_nd = 7.00;
											if($rst_ot > 1.00) {
												$rst_ot_grt8 = $rst_ot - 1.00;
												$rst_ot = 1.00;
											}
										}
									}
								}
							}
							$overtime = 0.00;
						}
						$regHours = $zero;
					}
				}
			}
		} else if($typeOfDay == "rstsh") { // if rest && special holiday
			if($attend == "timeout") {
				if($hasApprovedOT == 1) {
					if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
						if($OT->num_rows > 0){
							while($OTResult = $OT->fetch_object()){
								$overtimeStart = $OTResult->overtime_start;
								$overtimeStart = substr($overtimeStart, 0, -3);
								$overtimeEnd = $OTResult->overtime_end;
								$overtimeEnd = substr($overtimeEnd, 0, -3);
								//$overtime = $OTResult->overtime_duration;
								$regHours = computeHours($overtimeStart, $overtimeEnd);
								if($regHours >= 5.00) {
									$regHours = $regHours - 1.00;
								}
								if($isNightShift == 0) {
									$rst_sh_nd_grt8 = computeND($overtimeStart, $overtimeEnd) - 1.00;
									$rst_sh_ot = $regHours - $rst_sh_nd_grt8;
									if($rst_sh_ot > 8.0) {
										$rst_sh_ot_grt8 = $rst_sh_ot - 8.00;
										$rst_sh_ot = 8.00;
									}
								} else if($isNightShift == 1) {
									$rst_sh_nd = computeND($overtimeStart, $overtimeEnd) - 1.00;
									if($rst_sh_nd > 7.00) {
										$rst_sh_ot = $regHours - 7.00;
										$rst_sh_nd = 7.00;
										if($rst_sh_ot > 1.00) {
											$rst_sh_ot_grt8 = $rst_sh_ot - 1.00;
											$rst_sh_ot = 1.00;
										}
									}
								}
							}
						}
						$overtime = 0.00;
					}
					$regHours = $zero;
				}
			} else if($isAbsentPrevWorkingDay == "inactive") {
				if($attend == "timeout") { // not absent
					if($hasApprovedOT == 1) {
						if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$employee_id' AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
							if($OT->num_rows > 0){
								$rst_ot = 0.00;
								$rst_ot_grt8 = 0.00;
								$rst_nd = 0.00;
								$rst_nd_grt8 = 0.00;
								while($OTResult = $OT->fetch_object()){
									$overtimeStart = $OTResult->overtime_start;
									$overtimeStart = substr($overtimeStart, 0, -3);
									$overtimeEnd = $OTResult->overtime_end;
									$overtimeEnd = substr($overtimeEnd, 0, -3);
									$regHours = computeHours($overtimeStart, $overtimeEnd);
									if($regHours >= 5.00) {
										$regHours = $regHours - 1.00;
									}
									if($isNightShift == 0) {
										$nd = computeND($overtimeStart, $overtimeEnd);
										if($nd >= 1.00) {
											$rst_nd_grt8 = $nd - 1.00;
										} else {
											$rst_nd_grt8 = 0.00;
										}
										$rst_ot = $regHours - $rst_nd_grt8;
										if($rst_ot > 8.0) {
											$rst_ot_grt8 = $rst_ot - 8.00;
											$rst_ot = 8.00;
										}
									} else if($isNightShift == 1) {
										$rst_nd = computeND($overtimeStart, $overtimeEnd);
										
										if($rst_nd >= 1.00) $rst_nd = $rst_nd - 1.00;
										else $rst_nd = 0.00;

										if($rst_nd > 7.00) {
											$rst_ot = $regHours - 7.00;
											$rst_nd = 7.00;
											if($rst_ot > 1.00) {
												$rst_ot_grt8 = $rst_ot - 1.00;
												$rst_ot = 1.00;
											}
										}
									}
								}
							}
							$overtime = 0.00;
						}
						$regHours = $zero;
					}
				}
			}
		}
	} else { //computation for flexi
		if($attend == "timeout") { // not absent
			$regHours = computeHours($timein, $timeout);
			if($timein == $timeout) $regHours = 0.00;
			if($regHours >= 5.00) {
				$regHours = $regHours - 1.00;
			} else if($regHours > 4.00 && $regHours < 5.00) {
				$regHours = 4.00;
			}
		}
	}

	//update all
	$mysqli->query("UPDATE attendance SET attendance_hours='$regHours' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET attendance_overtime='$overtime' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET REG_OT_ND='$reg_ot_nd' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET attendance_nightdiff='$nightdiff' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET RST_OT='$rst_ot',RST_OT_GRT8='$rst_ot_grt8',RST_ND='$rst_nd',RST_ND_GRT8='$rst_nd_grt8' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET LH_OT='$lh_ot',LH_OT_GRT8='$lh_ot_grt8',LH_ND='$lh_nd',LH_ND_GRT8='$lh_nd_grt8' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET SH_OT='$sh_ot',SH_OT_GRT8='$sh_ot_grt8',SH_ND='$sh_nd',SH_ND_GRT8='$sh_nd_grt8' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET RST_LH_OT='$rst_lh_ot',RST_LH_OT_GRT8='$rst_lh_ot_grt8',RST_LH_ND='$rst_lh_nd',RST_LH_ND_GRT8='$rst_lh_nd_grt8' WHERE attendance_id='$attendance_id'");
	$mysqli->query("UPDATE attendance SET RST_SH_OT='$rst_sh_ot',RST_SH_OT_GRT8='$rst_sh_ot_grt8',RST_SH_ND='$rst_sh_nd',RST_SH_ND_GRT8='$rst_sh_nd_grt8' WHERE attendance_id='$attendance_id'");
	
	$mysqli->query("UPDATE attendance SET status='Done' WHERE attendance_id='$attendance_id'");
?>