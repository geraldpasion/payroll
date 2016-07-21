<?php
include('dbconfig.php');
	$empid = $_REQUEST['empid'];
	$cutoff_initial = date("Y-m-d", strtotime($_REQUEST['cutoff_initial']));
	$cutoff_end = date("Y-m-d", strtotime($_REQUEST['cutoff_end']));
		if ($leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id='$empid'")) {
			if ($leavedetails->num_rows >0) {
				while($leavedetails_info = $leavedetails->fetch_object()){
					$leavetype = $leavedetails_info ->leave_type;
					$leavestart = $leavedetails_info ->leave_start;
					$leaveapproveby = $leavedetails_info ->leave_approvedby;
					$leavestatus = $leavedetails_info ->leave_status;
					$duration = "00:00";
					if($leavedetails_info ->leave_halfday == 0) {
						$duration = "08:00";
					} else {
						$duration = "04:00";
					}
					
					if(date("Y-m-d", strtotime($leavestart)) >= $cutoff_initial && date("Y-m-d", strtotime($leavestart)) <= $cutoff_end){
					echo "
					<tr>
						<td>".$leavetype."</td>
						<td>".$leavestart."</td>
						<td>".$duration."</td>
						<td>".$leavestatus."</td>
						<td>".$leaveapproveby."</td>
					</tr>";
				}else{
					echo '';
				}

				}
			}
			

}
?>