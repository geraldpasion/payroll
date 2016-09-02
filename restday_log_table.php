<?php 
include_once 'dbconfig.php';

$empid = isset($_GET['empid']) ? $_GET['empid'] : false;

/*if($empid) {
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
}*/

if ($emp_rdlog = $mysqli->query("SELECT * FROM restday_logs WHERE employee_id = $empid ORDER BY restday_date DESC")){
								if($emp_rdlog->num_rows > 0){
								echo '<table class="footable table table-stripped" data-page-size="10" data-limit-navigation="5" data-filter=#filter>';	
								echo '<thead>';
								echo '<tr>';
								echo '<th>Date</th>';
								echo '<th>Start Date</th>';
								echo '<th>End Date</th>';
								echo '<th>Rest Day Schedule</th>';
								echo '<th>Created By</th>';
								//echo '<th>Status</th>';
								echo '</tr>';
								echo '</thead>';
								echo "<tfoot>";                    
								echo "<tr>";
								echo "<td colspan='7'>";
								echo "<ul class='pagination pull-right'></ul>";
								echo "</td>";
								echo "</tr>";
								echo "</tfoot>";
								while($rdlog = mysqli_fetch_object($emp_rdlog)){
									//$shiftlogid = $shiftlog->shiftlog_id;
									echo '<tr>';
									echo '<td>'.$rdlog->restday_date.'</td>';
									echo '<td>'.$rdlog->restday_startdate.'</td>';
									echo '<td>'.$rdlog->restday_enddate.'</td>';
									echo '<td>'.$rdlog->restday_schedule.'</td>';
									echo '<td>'.$rdlog->restday_createdby.'</td>';
									//echo '<td>'.$shiftlog->shiftlog_status.'</td>';
									echo '</tr>';
									}
								}
								echo "</table>";
							}



?>

