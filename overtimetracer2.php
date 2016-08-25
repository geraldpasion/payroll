 <!DOCTYPE html>
<html>
	<head>
		<?php
			include('supervisormenuheader.php');
			$team = $_SESSION['employee_team'];
		?>
		<title>Overtime Status</title>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
	</head>

	<body>
		<div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Overtime Status</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
 
            <div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<?php
					include('dbconfig.php');
						if ($result = $mysqli->query("SELECT * FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id WHERE (overtime.overtime_status = 'Approved' OR overtime.overtime_status = 'Disapproved') AND employee.employee_level = '1' and employee.employee_team LIKE '$team' ORDER BY overtime.overtime_date DESC")) //get records from db
						{//SELECT * FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id WHERE (employee_team = '$team' AND (overtime.overtime_status = 'Approved' OR overtime.overtime_status = 'Disapproved') AND (employee.employee_level = '1' OR overtime.employee_id = $employee_id) ORDER BY overtime.overtime_date DESC
							if ($result->num_rows > 0) //display records if any
							{
								echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
								echo "<thead>";
								echo "<tr>";	
								echo "<th>Name</th>";
								echo "<th>Date</th>";
								echo "<th>Start</th>";
								echo "<th>End</th>";
								echo "<th>Duration</th>";
								echo "<th>Reason</th>";
								echo "<th>Status</th>";
								echo "<th>Remarks</th>";
								echo "<th>Managed by</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tfoot>";                    
								echo "<tr>";
								echo "<td colspan='9'>";
								echo "<ul class='pagination pull-right'></ul>";
								echo "</td>";
								echo "</tr>";
								echo "</tfoot>";
								
								while ($row = mysqli_fetch_object($result))
								{
									$overtime =$row->overtime_id;
									$empsid =$row->employee_id;
									$overtimeend = date("g:i A",strtotime($row->overtime_end));
									
									
									echo "<tr>";
									echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
									echo "<td>" . date("Y-m-d",strtotime($row->overtime_date)) . "</td>";
									echo "<td>" . date("g:i A",strtotime($row->overtime_start)) . "</td>";
									echo "<td>" . date("g:i A",strtotime($row->overtime_end)) . "</td>";
									$OTin = $row->overtime_start;
									$OTout = $row->overtime_end;											
									$OTCount = date('H:i', strtotime($OTout) - strtotime($OTin) - strtotime('03:00'));
									$arrayOTCount = array();
									$arrayOTCount = split(':', $OTCount);
									$OTCountMin = $arrayOTCount[1]/60;
									$OTCountDec = sprintf("%.2f", $arrayOTCount[0]+$OTCountMin);
									if($OTCountDec >= 5.00) {
										$OTCountDec = $OTCountDec - 1.00;
										$OTCountDec = sprintf("%.2f", $OTCountDec);
									}
									if ($stmt = $mysqli->prepare("update overtime set overtime_duration='".$OTCountDec."' where overtime_id = '".$row->overtime_id."'")){
									$stmt->execute();
									$stmt->close();
									}
									echo "<td>" . $OTCountDec . "</td>";
									echo "<td>" . $row->overtime_reason . "</td>";
									echo "<td>" . $row->overtime_status . "</td>";
									echo "<td>" . $row->overtime_remarks . "</td>";
									echo "<td>" . $row->overtime_approvedby. "</td>";
									echo "<td> <a href = 'overtimeform.php?id=$empsid&otid=$overtime'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a></td>";
									echo "</tr>";
								}
								echo "</table>";
							}
						}
					
						
				?>
				
			</div>
	
        </div>
        </div>
        </div>

    
		
		<?php
			include('menufooter.php');
		?>
	</body>
</html>