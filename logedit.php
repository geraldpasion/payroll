<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			$empLevel = $_SESSION['employee_level'];
			if(isset($_SESSION['logsession']) && $empLevel == '2') {
				include('supervisormenuheader.php');
			} else if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');
			}
		?>
		<title>Log Edit Requests</title>
		<style>
			.btn3{
				margin-left:13em;
			}
			.btn2{
				margin-left:2.5em;
			}
			.clockpicker-popover{
    z-index: 9999;
}
		</style>
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- Clock picker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script type="text/javascript">
			$(function() {
			$(".approve").click(function(){
			var element = $(this);
			var attendance_id = $(this).data("id");
			var date = $(this).data("date");
			var timein = $(this).data("timein");
			var breakout = $(this).data("breakout");
			var breakin = $(this).data("breakin");
			var timeout = $(this).data("timeout");
			var emp = $(this).data("emp");
			var daytype = $(this).data("daytype");
			var attend = $(this).data("attend");
			var status = $(this).data("status");
			var absentbool = $(this).data("absentbool");

			var info = 'attendance_id=' + attendance_id + '&logedit_date='+ date + '&logedit_timein='+ timein + '&logedit_breakout='+ breakout + '&logedit_breakin='+ breakin + '&logedit_timeout='+ timeout + '&attend=' + attend + '&absentbool=' + absentbool + '&status=' + status + '&daytype=' + daytype + '&emptype=' + emp;
			
			 $.ajax({
			   type: "POST",
			   url: "logeditexe.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").remove();
			 $(window).scrollTop(0);
			 toastr.options = { 
				"closeButton": true,
			  "debug": false,
			  "progressBar": true,
			  "preventDuplicates": true,
			  "positionClass": "toast-top-right",
			  "onclick": null,
			  "showDuration": "400",
			  "hideDuration": "1000",
			  "timeOut": "7000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut" // 1.5s
				}
				toastr.success("Log edit request approved!");
			return false;
			});
			});
		</script>
				<script type="text/javascript">
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var attendance_id = $(this).data('id');
			var info = 'attendance_id=' + attendance_id;
			 $.ajax({
			   type: "POST",
			   url: "disapprovelogedit.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").remove();
				toastr.options = { 
				"closeButton": true,
				"debug": false,
				"progressBar": true,
				"preventDuplicates": false,
				"positionClass": "toast-top-right",
				"onclick": null,
				"showDuration": "400",
				"hideDuration": "1000",
				"timeOut": "7000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut" // 1.5s
				}
				toastr.success('Log edit request disapproved!');
			return false;
			});
			});
		</script>
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Employee DTR</h5>
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
								$employeeidsession = $_SESSION['logsession'];
								$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employeeidsession'")->fetch_array();
								$team = $result['employee_team'];
								if($empLevel == '2') {
									$sqlString = "SELECT * FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE employee_team = '$team' AND logedit_status ='Pending'";
								} else if($empLevel == '3') {
									$sqlString = "SELECT * FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE logedit_status ='Pending'";
								}
								if ($result = $mysqli->query($sqlString)) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th style='text-align:center'>Name</th>";
										echo "<th style='text-align:center'>Date</th>";
										echo "<th style='text-align:center'>Attendance</th>";
										echo "<th style='text-align:center'>Time in</th>";
										echo "<th style='text-align:center'>Out for break</th>";
										echo "<th style='text-align:center'>In from break</th>";
										echo "<th style='text-align:center'>Time out</th>";
										echo "<th style='text-align:center'>Action</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tfoot>";                    
										echo "<tr>";
										echo "<td colspan='78'>";
										echo "<ul class='pagination pull-right'></ul>";
										echo "</td>";
										echo "</tr>";
										echo "</tfoot>";
										while ($row = $result->fetch_object())
										{
											echo "<tr class = 'josh'>";
											echo "<td style='text-align:center'>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
											echo "<td style='text-align:center'>" . date("Y-m-d",strtotime($row->logedit_date)) . "</td>";
											if($row->attendance_status == "timeout") $attRecord = "Present";
											else if($row->attendance_status == "inactive") $attRecord = "Absent";
											echo "<td style='text-align:center'>" . $attRecord . "</td>";

											if($row->logedit_timein == "") echo "<td></td>";
											else echo "<td style='text-align:center'>" . date("g:i A",strtotime($row->logedit_timein)) . "</td>";	

											if($row->logedit_breakout == "") echo "<td></td>";
											else echo "<td style='text-align:center'>" . date("g:i A",strtotime($row->logedit_breakout)). "</td>";

											if($row->logedit_breakin == "") echo "<td></td>";
											else echo "<td style='text-align:center'>" . date("g:i A",strtotime($row->logedit_breakin)) . "</td>";
											
											if($row->logedit_timeout == "") echo "<td></td>";
											else echo "<td style='text-align:center'>" . date("g:i A",strtotime($row->logedit_timeout)) . "</td>";

											if($empLevel == '2' && $row->employee_id == $employeeidsession) {
												echo "<td style='text-align:center'><button class='btn btn-success' name = 'edit' type='button' disabled><i class='fa fa-paste'></i> Approve</button>&nbsp;&nbsp;";
											
												echo "<button class='btn btn-danger' type='button' disabled><i class='fa fa-warning'></i> Disapprove</button>";
											} else {
												echo "<td><a href='' class = 'approve'
															data-id='$row->attendance_id' 
															data-date='$row->logedit_date'
															data-emp='$row->employee_type'
															data-attend='$attRecord'
															data-absentbool='$row->attendance_absent' 
															data-timein='$row->logedit_timein'
															data-breakout='$row->logedit_breakout'
															data-breakin='$row->logedit_breakin'
															data-timeout='$row->logedit_timeout'
															data-status='$row->attendance_status'
															data-daytype='$row->attendance_daytype'
															data-remarks='$row->logedit_remarks'><button class='btn btn-success' name = 'edit' type='button'><i class='fa fa-paste'></i> Approve</button></a>&nbsp;&nbsp;";
											
												echo "<a href='#' data-id = '$row->attendance_id' class = 'delete'><button class='btn btn-danger' type='button'><i class='fa fa-warning'></i> Disapprove</button></a>";
											}
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
	
		<script type="text/javascript">
			$('.clockpicker').clockpicker();
		</script>
		<?php
		if($empLevel == '3') include('menufooter.php');
		else if($empLevel == '2') include('employeemenufooter.php');
		?>
	</body>
</html>