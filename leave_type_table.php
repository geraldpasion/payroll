<?php 
include_once 'dbconfig.php';

$empid = isset($_GET['empid']) ? $_GET['empid'] : false;

if($empid) {
	echo "<table id='leave_type' class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
	<thead>
		<tr>
			<th>Leave Type</th>
			<th>From</th>
			<th>Status</th>
			<!--th>To</th-->
			<!--th>Days</th-->
			<th>Approved By</th>
			<th>Approve Date</th>
		</tr>
	</thead>
	<tbody>";



	$leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id=$empid");
		if($leavedetails->num_rows > 0){
			while($leave = $leavedetails->fetch_object()){
				echo '<tr>';
				echo '<td>'.$leave->leave_type.'</td>';
				echo '<td>'.$leave->leave_start.'</td>';
				echo '<td>'.$leave->leave_status.'</td>';
				//echo '<td>'.$leave->.'</td>';
				echo '<td>'.$leave->leave_approvedby.'</td>';
				echo '<td>'.$leave->leave_approvaldate.'</td>';
				echo '</tr>';
			}
		}
			

	echo "</tbody>
	</table>";
}


?>