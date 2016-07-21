<?php
include('dbconfig.php');
if(isset($_POST['export'])){
//$id = $_POST['id'];
	$datetoday = date('Y-m-d');

	if($attendace_result = $mysqli->query("SELECT * FROM emp_data where applicant_status= 'For interview'")){
		if($attendace_result->num_rows > 0){
			$output = '<table style="font-size: 12px;">
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><center><b>NAME</b></center></td>
								<td></td>
								<td></td>
								<td><b>DATE</b></td>
								<td><b>TIME</b></td>
								<td><b>INTERVIEWER</b></td>
							</tr>';
			while($row = $attendace_result->fetch_object()){
				$fname = $row->info_f_name;
				$lname = $row->info_l_name;
				$mname = $row->info_m_name;
				$date =  $row->interview_date;
				$time =  $row->interview_time;
				$interviewer = $row->interviewer;

				if($attendace_result2 = $mysqli->query("SELECT * FROM employee where employee_id='".$interviewer."'")){
				}
				while($row2 = $attendace_result2->fetch_object()){
					$mamf =  $row2->employee_firstname;
					$mamm =  $row2->employee_middlename;
					$maml =  $row2->employee_lastname;
				}
				$fullmam = $mamf." ".$mamm." ".$maml;

				$fullname = $lname."_".$fname."_".$mname;
				//$date = $row->attendance_date;
				//$timein = $row->attendance_timein;
				//$breakout = $row->attendance_breakout;
				//$breakin = $row->attendance_breakin;
				//$timeout = $row->attendance_breakout;
				//$late = sprintf('%.2f', $row->attendance_late);
				//$undertime = sprintf('%.2f', $row->attendance_undertime);
				//$totalhrs = sprintf('%.2f', $row->attendance_hours);
				//$overtime = sprintf('%.2f', $row->attendance_overtime);

				$output .= '<tr>
								<td>'.$fname.' '.$mname.' '.$lname.'</td>
								<td></td>
								<td></td>
						
								<td>'.$date.'</td>
								<td>'.$time.'</td>
								<td>'.$fullmam.'</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>';
			}			
		$output .= '</table>';
		header("Content-Type: application/xls");   
        header("Content-Disposition: attachment; filename=".'InterviewList'.".xls"); 
        echo $output;
        //header("Location: export_attendance.php");
		}
	}
}

?>