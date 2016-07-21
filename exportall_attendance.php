<?php
include('dbconfig.php');
if(isset($_POST['export'])){
	// $employee_id = $_POST['empid'];
	$datetoday = date('Y-m-d');

	if($attendace_result = $mysqli->query("SELECT * FROM employee INNER JOIN attendance ON employee.employee_id=attendance.employee_id")){
		if($attendace_result->num_rows > 0){
			$empname = $mysqli->query("SELECT * FROM employee");
			$fetch = $empname->fetch_object();
			// $shiftArray = array();
			// $shiftArray = split('-', $fetch->employee_shift);
			
			$output = '<table style="font-size: 12px;">
							<tr>
								<td><b>'.$fetch->employee_lastname.', '.$fetch->employee_firstname.' '.$fetch->employee_middlename.'</b></td>
							</tr>
							<tr>
								<td><b>'.date("g:i A", strtotime($shiftArray[0])).' - '.date("g:i A", strtotime($shiftArray[1])).'</b></td>
							</tr>
							<tr>
								<td><b>Cut off</b></td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td><center><b>DATE</b></center></td>
								<td><b>TIME IN</b></td>
								<td><b>OUT FROM BREAK</b></td>
								<td><b>IN FROM BREAK</b></td>
								<td><b>TIME OUT</b></td>
								<td><b>ABS</b></td>
								<td><b>REG HRS</b></td>
								<td><b>LATE (Min)</b></td>
								<td><b>UNDERTIME (Min)</b></td>
								<td><b>REG OT</b></td>
								<td><b>REG ND</b></td>
								<td><b>REG OT ND</b></td>
								<td><b>RST OT</b></td>
								<td><b>RST OT >8</b></td>
								<td><b>RST ND</b></td>
								<td><b>RST ND >8</b></td>
								<td><b>LH OT</b></td>
								<td><b>LH OT >8</b></td>
								<td><b>LH ND</b></td>
								<td><b>LH ND >8</b></td>
								<td><b>SH OT</b></td>
								<td><b>SH OT >8</b></td>
								<td><b>SH ND</b></td>
								<td><b>SH ND >8</b></td>
								<td><b>RST LH OT</b></td>
								<td><b>RST LH OT >8</b></td>
								<td><b>RST LH ND</b></td>
								<td><b>RST LH ND >8</b></td>
								<td><b>RST SH OT</b></td>
								<td><b>RST SH OT >8</b></td>
								<td><b>RST SH ND</b></td>
								<td><b>RST SH ND >8</b></td>
							</tr>';
			while($row = $attendace_result->fetch_object()){
				$fname = $row->employee_firstname;
				$lname = $row->employee_lastname;
				$mname = $row->employee_middlename;
				$fullname = $lname."_".$fname."_".$mname;
				$date = $row->attendance_date;
				$timein = $row->attendance_timein;
				$breakout = $row->attendance_breakout;
				$breakin = $row->attendance_breakin;
				$timeout = $row->attendance_timeout;
				$late = sprintf('%.2f', $row->attendance_late);
				$undertime = sprintf('%.2f', $row->attendance_undertime);
				$totalhrs = sprintf('%.2f', $row->attendance_hours);
				$overtime = sprintf('%.2f', $row->attendance_overtime);
				$absent = sprintf('%.2f', $row->attendance_absent);
				$REG_ND = sprintf('%.2f', $row->attendance_overtime);
				$REG_OT_ND = sprintf('%.2f', $row->REG_OT_ND);
				$RST_OT = sprintf('%.2f', $row->RST_OT);
				$RST_OT_GRT8 = sprintf('%.2f', $row->RST_OT_GRT8);
				$RST_ND = sprintf('%.2f', $row->RST_ND);
				$RST_ND_GRT8 = sprintf('%.2f', $row->RST_ND_GRT8);
				$LH_OT = sprintf('%.2f', $row->LH_OT);
				$LH_OT_GRT8 = sprintf('%.2f', $row->LH_OT_GRT8);
				$LH_ND = sprintf('%.2f', $row->LH_ND);
				$LH_ND_GRT8 = sprintf('%.2f', $row->LH_ND_GRT8);
				$SH_OT = sprintf('%.2f', $row->SH_OT);
				$SH_OT_GRT8 = sprintf('%.2f', $row->SH_OT_GRT8);
				$SH_ND = sprintf('%.2f', $row->SH_ND);
				$SH_ND_GRT8 = sprintf('%.2f', $row->SH_ND_GRT8);
				$RST_LH_OT = sprintf('%.2f', $row->RST_LH_OT);
				$RST_LH_OT_GRT8 = sprintf('%.2f', $row->RST_LH_OT_GRT8);
				$RST_LH_ND = sprintf('%.2f', $row->RST_LH_ND);
				$RST_LH_ND_GRT8 = sprintf('%.2f', $row->RST_LH_ND_GRT8);
				$RST_SH_OT = sprintf('%.2f', $row->RST_SH_OT);
				$RST_SH_OT_GRT8 = sprintf('%.2f', $row->RST_SH_OT_GRT8);
				$RST_SH_ND = sprintf('%.2f', $row->RST_SH_ND);
				$RST_SH_ND_GRT8 = sprintf('%.2f', $row->RST_SH_ND_GRT8);

				$output .= '<tr>
								<td>'.$date.'</td>
								<td>'.$timein.'</td>
								<td>'.$breakout.'</td>
								<td>'.$breakin.'</td>
								<td>'.$timeout.'</td>
								<td>'.$absent.'</td>
								<td>'.$totalhrs.'</td>
								<td>'.$late.'</td>
								<td>'.$undertime.'</td>
								<td>'.$overtime.'</td>
								<td>'.$REG_ND.'</td>
								<td>'.$REG_OT_ND.'</td>
								<td>'.$RST_OT.'</td>
								<td>'.$RST_OT_GRT8.'</td>
								<td>'.$RST_ND.'</td>
								<td>'.$RST_ND_GRT8.'</td>
								<td>'.$LH_OT.'</td>
								<td>'.$LH_OT_GRT8.'</td>
								<td>'.$LH_ND.'</td>
								<td>'.$LH_ND_GRT8.'</td>
								<td>'.$SH_OT.'</td>
								<td>'.$SH_OT_GRT8.'</td>
								<td>'.$SH_ND.'</td>
								<td>'.$SH_ND_GRT8.'</td>
								<td>'.$RST_LH_OT.'</td>
								<td>'.$RST_LH_OT_GRT8.'</td>
								<td>'.$RST_LH_ND.'</td>
								<td>'.$RST_LH_ND_GRT8.'</td>
								<td>'.$RST_SH_OT.'</td>
								<td>'.$RST_SH_OT_GRT8.'</td>
								<td>'.$RST_SH_ND.'</td>
								<td>'.$RST_SH_ND_GRT8.'</td>
							</tr>';
			}			
		$output .= '</table>';
		header("Content-Type: application/xls");   
        header("Content-Disposition: attachment; filename=$fullname".'_'."$datetoday.xls"); 
        echo $output;
        //header("Location: export_attendance.php");
		}
	}
}

?>