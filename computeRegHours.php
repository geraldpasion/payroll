<?php // $regHours
	include("dbconfig.php");
	if($fetch_emp['employee_type'] == "Fixed" || $fetch_emp['employee_type'] == "Shifting"){
		if($breakout == "" || $breakin == "" || $timeout == "") {
			$regHours = $zero;
		} else {
			if(date("H:i", strtotime($timein)) < $shiftArray[0]){
				$timein = $shiftArray[0];
			}

			if(date("H:i", strtotime($timeout)) > $shiftArray[1]) {
				$timeout = $shiftArray[1];
			}

			if($isNightShift == 1 && $timeout > date("H:i", strtotime($shiftArray[1]) - 60*60*24)) {
				$tempTimeout = date("H:i", strtotime($timeout) + 60*60*24);
				if($tempTimeout < $shiftArray[1]) {
					$timeout = $shiftArray[1];
				}
			}


			$timeinArray = array();
			$timeinArray = split(":", $timein);
			$timeinArrayMin = sprintf("%.2f", $timeinArray[1]/60);
			$timeinArrayDec = sprintf("%.2f", $timeinArray[0] + $timeinArrayMin);
			$tempTimeout = $timeout;
			// if($from == "index") {
			// 	if (($logday > $dateWithDayArray[2]) && ($isNightShift == 0))
			// 		$timeout = $shiftArray[1];
			// }
			$newRegHrs = date("H:i", (strtotime($timeout) - strtotime($timein)) - 3600);
			$timeout = $tempTimeout;

			$newRegHrsArray = array();
			$newRegHrsArray = split(":", $newRegHrs);
			$newRegHrsArrayMin = sprintf("%.2f", $newRegHrsArray[1]/60);
			$newRegHrsArrayDec = sprintf("%.2f", $newRegHrsArray[0] + $newRegHrsArrayMin);
			$regHours = $newRegHrsArrayDec;
		}
	} else if($fetch_emp['employee_type'] == "Flexi"){ //FLEXI
		if($breakout == "" || $breakin == "" || $timeout == ""){
			$regHours = $zero;
		}else{
			$timeinArray = array();
			$timeinArray = split(":", $timein);
			$timeinArrayMin = sprintf("%.2f", $timeinArray[1]/60);
			$timeinArrayDec = sprintf("%.2f", $timeinArray[0] + $timeinArrayMin);
			//$newRegHrs = date("H:i", (strtotime($timeout) - 60*60*$timeinArrayDec) - 3600);
			$newRegHrs = date("H:i", (strtotime($timeout) - strtotime($timein)) - 3600);

			$newRegHrsArray = array();
			$newRegHrsArray = split(":", $newRegHrs);
			$newRegHrsArrayMin = sprintf("%.2f", $newRegHrsArray[1]/60);
			$newRegHrsArrayDec = sprintf("%.2f", $newRegHrsArray[0] + $newRegHrsArrayMin);
			$regHours = $newRegHrsArrayDec;
		}
	} else{
		$regHours = $zero;
	}
?>