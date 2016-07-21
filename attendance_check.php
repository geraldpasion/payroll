<?php
include 'dbconfig.php';
if ($result = $mysqli->query("SELECT * FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id ORDER BY attendance_date")) //get records from db
{
	if ($result->num_rows > 0) //display records if any
	{
		while ($row = $result->fetch_object())
		{
			$timein = $row->attendance_timein;
			$timeout = $row->attendance_timeout;
			$breakin = $row->attendance_breakin;
			$breakout = $row->attendance_breakout;

			$attendance_date = $row->attendance_date;
			$employee_id = $row->employee_id;
			$attendance_id = $row->attendance_id;
			$restday = $row->employee_restday;

			$dateWithDay = date('Y-m-d:l', strtotime($attendance_date));
			$dateWithDayArray = array();
			$dateWithDayArray = split(':', $dateWithDay);

			//ABSENT
			$shiftArray = array();
			$shiftArray = split('-', $row->employee_shift);
			$currTime = time();

			$currDate = date("Y/m/d");
			$var = date("Y-m-d", strtotime($currDate . "-1 days"));

			$check_date = $mysqli->query("SELECT COUNT(*) AS check_absent FROM attendance WHERE attendance_date = '$var' AND employee_id = $employee_id");
			$fetchDate = $check_date->fetch_object();
			$checkAbsent = $fetchDate->check_absent;

														
			$restday = $row->employee_restday;
			$checkRstday = date("y-m-d:l", strtotime($attendance_date));
			$rstArray = array();
			$rstArray = split(':', $checkRstday);
														
			if($fetchDate->check_absent == 0 && $currTime > $shiftArray[1]){
				$mysqli->query("INSERT INTO attendance (attendance_id,employee_id,attendance_date,attendance_timein,attendance_breakout,attendance_breakin,attendance_timeout) VALUES ('','$employee_id','$var','','','','')");
			}

			//RESTDAY CONDITION
			if($row->attendance_timein == "" && $rstArray[1] == $restday){
				$mysqli->query("UPDATE attendance SET attendance_absent = '0.0', attendance_status = 'timeout' WHERE employee_id = $employee_id AND attendance_date = '$var'");
				echo '<td>Restday</td>';
			}else if($row->attendance_timein == "" && $rstArray[1] !== $restday){
				$mysqli->query("UPDATE attendance SET attendance_absent = '1.0', attendance_status = 'timeout' WHERE employee_id = $employee_id AND attendance_date = '$var'");
			}
		}
	}
}

?>