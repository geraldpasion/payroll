<?php
include('dbconfig.php');
	$empid = $_REQUEST['empid'];
	$cutoff_initial = date("Y-m-d", strtotime($_REQUEST['cutoff_initial']));
	$cutoff_end = date("Y-m-d", strtotime($_REQUEST['cutoff_end']));
		if ($details = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$empid' ORDER BY attendance_date")) {
			if ($details->num_rows >0) {
				while($details_info = $details->fetch_object()){
					$detailsdate = $details_info ->attendance_date;
					$detailsShift = $details_info ->attendance_shift;
					$detailsDaytype = $details_info ->attendance_daytype;
					$detailstimein = $details_info ->attendance_timein;
					$detailslunchout = $details_info ->attendance_breakout;
					$detailslunchin = $details_info ->attendance_breakin;
					$detailstimeout = $details_info ->attendance_timeout;
					
					$hour = sprintf("%02d", floor($details_info ->attendance_hours));
					$min = sprintf("%02d", round(60*($details_info ->attendance_hours - $hour)));
					$detailsreghrs = $hour . ":" . $min;

					$hour = sprintf("%02d", floor($details_info ->attendance_late/60));
					$min = sprintf("%02d", $details_info ->attendance_late % 60);
					$detailslate = $hour . ":" . $min;

					$hour = sprintf("%02d", floor($details_info ->attendance_undertime/60));
					$min = sprintf("%02d", $details_info ->attendance_undertime % 60);
					$detailsundertime = $hour . ":" . $min;

					if(date("Y-m-d", strtotime($detailsdate)) >= $cutoff_initial && date("Y-m-d", strtotime($detailsdate)) <= $cutoff_end){
						echo "
						<tr>
							<td>".$detailsdate."</td>
							<td>".$detailsShift."</td>
							<td>".$detailsDaytype."</td>
							<td>".$detailstimein."</td>
							<td>".$detailslunchout."</td>
							<td>".$detailslunchin."</td>
							<td>".$detailstimeout."</td>
							<td>".$detailsreghrs."</td>
							<td>".$detailslate."</td>
							<td>".$detailsundertime."</td>
						</tr>";
					}else{
						echo '';
					}
					

				}
			}
			

}
?>