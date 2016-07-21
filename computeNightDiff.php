<?php //$nightdiff
	include("dbconfig.php");

	if($breakout == "" || $breakin == "" || $timeout == ""){
		$nightdiff = $zero;
	} else{
		if ($timein < $ndStart && $breakout <= $ndStart ||
			$timein < $ndStart && $breakout > $ndStart ||
			$timein < $ndStart && $breakout <= $ndEnd ||
			$timein <= $ndStart && $breakout > $ndEnd ||
			$timein >= $ndStart && $breakout <= $ndEnd ||
			$timein >= $ndStart && $breakout > $ndStart){

			//if($timein < $ndStart && $breakout <= $ndStart){
			//	$nd1 = "00:00";
			//}else 
			if($timein < $ndStart && $breakout >= $ndStart){
				$timein = $ndStart;
				$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
			}else if($timein < $ndStart && $breakout <= $ndEnd){
				$timein = $ndStart;
				$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
			}else if($timein < $ndStart && $breakout > $ndEnd){
				$nd1 = "00:00";
			}else if($timein >= $ndStart && $breakout <= $ndEnd){ //yo
				$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
			}else if($timein >= $ndStart && $breakout > $ndStart){
				$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
			}

			$ndArray = array();
			$ndArray = split(':', $nd1);
			$ndArrayMin = $ndArray[1]/60;
			$ndArrayDec = sprintf('%.2f', $ndArray[0] + $ndArrayMin);
		}

		if ($breakin < $ndStart && $timeout < $ndStart ||
			$breakin < $ndStart && $timeout >= $ndStart ||
			$breakin < $ndStart && $timeout <= $ndEnd ||
			$breakin > $ndStart && $timeout > $ndStart ||
			$breakin > $ndStart && $timeout <= $ndEnd ||
			$breakin < $ndEnd && $timeout <= $ndEnd ||
			$breakin < $ndEnd && $timeout > $ndEnd ||
			$breakin >= $ndEnd && $timeout > $ndEnd){

			if($breakin < $ndStart && $timeout >= $ndStart){
				$breakin = $ndStart;
				$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

				$ndArray2 = array();
				$ndArray2 = split(':', $nd2);
				$ndArray2Min = $ndArray2[1]/60;
				$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
			}else if($breakin < $ndStart && $timeout <= $ndEnd && $breakin >$ndEnd){
				$nd2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
				$nd2a = date('H:i', strtotime($ndEnd) - strtotime($nd2) - strtotime('03:00'));

				$ndArray2 = array();
				$ndArray2 = split(':', $nd2a);
				$ndArray2Min = sprintf('%.2f', ($ndArray2[1]/60)+2.0);
				$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
			}else if($breakin > $ndStart && $timeout > $ndStart){
				$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

				$ndArray2 = array();
				$ndArray2 = split(':', $nd2);
				$ndArray2Min = $ndArray2[1]/60;
				$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
			}else if($breakin > $ndStart && $timeout <= $ndEnd){
				$nd2a = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
				$nd2aArray = array();
				$nd2aArray = split(':', $nd2a);
				$nd2aArrayMin = $nd2aArray[1]/60;
				$nd2aArrayDec = sprintf('%.2f', $nd2aArray[0] + $nd2aArrayMin);

				$nd2b = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
				$nd2c = date('H:i', strtotime($ndEnd) - strtotime($nd2b) - strtotime('03:00'));
				$nd2cArray = array();
				$nd2cArray = split(':', $nd2c);
				$nd2cArrayMin = $nd2aArray[1]/60;
				$nd2cArrayDec = sprintf('%.2f', $nd2cArray[0] + $nd2cArrayMin);

				$nd2 = sprintf('%.2f', $nd2aArrayDec + $nd2cArrayDec);

				$ndArray2 = array();
				$ndArray2 = split(':', $nd2);
				$ndArray2Min = $ndArray2[1]/60;
				$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
			}else if($breakin < $ndEnd && $timeout <= $ndEnd){
				$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

				$ndArray2 = array();
				$ndArray2 = split(':', $nd2);
				$ndArray2Min = $ndArray2[1]/60;
				$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
			}else if($breakin < $ndEnd && $timeout > $ndEnd){ //yo
				$timeout = $ndEnd;
				$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

				$ndArray2 = array();
				$ndArray2 = split(':', $nd2);
				$ndArray2Min = $ndArray2[1]/60;
				$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
			}else if($breakin < $ndStart && $timeout < $ndStart){
				$nd2 = "00:00";

				$ndArray2 = array();
				$ndArray2 = split(':', $nd2);
				$ndArray2Min = $ndArray2[1]/60;
				$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
			}
		}
		if($dateWithDayArray[1] == $restdayArray[0] || $dateWithDayArray[1] == $restdayArray[1]){
			$nightdiff = $zero;
		}else{
			$ndTotal = sprintf('%.2f', $ndArrayDec + $ndArray2Dec);
			$nightdiff = $ndTotal;
		}
		
	}

?>