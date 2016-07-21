<?php
include('dbconfig.php');
	$empid = $_REQUEST['empid'];
	$cutoff_initial = date("Y-m-d", strtotime($_REQUEST['cutoff_initial']));
	$cutoff_end = date("Y-m-d", strtotime($_REQUEST['cutoff_end']));
		if ($otdetails = $mysqli->query("SELECT * FROM overtime WHERE employee_id='$empid' ORDER BY overtime_date")) {
			if ($otdetails->num_rows >0) {
				while($otdetails_info = $otdetails->fetch_object()){
					$otdate = $otdetails_info ->overtime_date;
					$otstart = $otdetails_info ->overtime_start;
					$otend = $otdetails_info ->overtime_end;
					
					$hour = sprintf("%02d", floor($otdetails_info ->overtime_duration));
					$min = sprintf("%02d", round(60*($otdetails_info ->overtime_duration - $hour)));
					$othours = $hour . ":" . $min;
					
					$otapproveby = $otdetails_info ->overtime_approvedby;
					
					if(date("Y-m-d", strtotime($otdate)) >= $cutoff_initial && date("Y-m-d", strtotime($otdate)) <= $cutoff_end){
					echo "
					<tr>
						<td>".$otdate."</td>
						<td>".$otstart."</td>
						<td>".$otend."</td>
						<td>".$othours."</td>
						<td>".$otapproveby."</td>
					</tr>";
				}else{
					echo '';
				}

				}
			}
			

}
?>