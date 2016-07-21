<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			$empLevel = $_SESSION['employee_level'];
			if(isset($_SESSION['logsession']) && $empLevel == '2') {
				include('supervisormenuheader.php');
			} else {
				include('employeemenuheader.php');
			}
		?>
		<title>My DTR</title>
		<style>
			.btn3{
				margin-left:13em;
			}
			.btn2{
				margin-left:2.5em;
			}
				.datepicker{
    z-index: 9999;
}
		</style>

	<link rel="stylesheet" type="text/css" href="datepicker.css" /> 
	<script type="text/javascript" src="datepicker.js"></script>
		
		<script type="text/javascript">
			$(document).on("click", ".showmodal", function () {
				var id = $(this).data('id');
				var emp = $(this).data('emp');
				var daytype = $(this).data('daytype');
				var attend = $(this).data('attend');
				var date = $(this).data('date');
				var timein = $(this).data('timein');
				var outfrombreak = $(this).data('breakout');
				var infrombreak = $(this).data('breakin');
				var timeout = $(this).data('timeout');
				var status = $(this).data('status');
				var absentbool = $(this).data('absentbool');
				 
				$(".modal-body #attendanceid").val( id );
				$(".modal-body #date").val( date );
				$(".modal-body #isabsent").val( attend );
				$(".modal-body #timein").val( timein );
				$(".modal-body #breakout").val( outfrombreak );
				$(".modal-body #breakin").val( infrombreak );
				$(".modal-body #timeout").val( timeout );
				$(".modal-body #daytype").val( daytype );
				$(".modal-body #status").val( status );
				$(".modal-body #absentbool").val( absentbool );
				$(".modal-body #emptype").val( emp );
				$(".modal-body #daytype").val( daytype );

				if(status == "inactive") { // if inactive status (absent)
					document.getElementById('timein').disabled=true;
					document.getElementById('breakout').disabled=true;
					document.getElementById('breakin').disabled=true;
					document.getElementById('timeout').disabled=true;
					document.getElementById('timein').value="";
					document.getElementById('breakout').value="";
					document.getElementById('breakin').value="";
					document.getElementById('timeout').value="";
				} else if(status == "timeout") { // if timeout status (present)
					document.getElementById('timein').disabled=false;
					document.getElementById('breakout').disabled=false;
					document.getElementById('breakin').disabled=false;
					document.getElementById('timeout').disabled=false;
				}
			});
		</script>
		<script type="text/javascript">
		function changeAbsent(obj) { // script for when the select (absent/present) is changed
			var index = obj.selectedIndex;
			var val = obj.options[index].value;
			
			if(val == "Absent") { // disables time inputs and empties their values for an absent case
				document.getElementById('timein').disabled=true;
				document.getElementById('breakout').disabled=true;
				document.getElementById('breakin').disabled=true;
				document.getElementById('timeout').disabled=true;
				document.getElementById('timein').value="";
				document.getElementById('breakout').value="";
				document.getElementById('breakin').value="";
				document.getElementById('timeout').value="";
			} else if(val == "Present") { // enables time inputs for an present case
				document.getElementById('timein').disabled=false;
				document.getElementById('breakout').disabled=false;
				document.getElementById('breakin').disabled=false;
				document.getElementById('timeout').disabled=false;
				document.getElementById('timein').value="";
				document.getElementById('breakout').value="";
				document.getElementById('breakin').value="";
				document.getElementById('timeout').value="";
			}
		}
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
			 	showEdited=function(){
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
				toastr.success("Successfully applied for log edit!");

				}		
			});
		</script>

		<?php
			if(isset($_GET['submitted'])){
				echo '<script type="text/javascript">'
						, '$(document).ready(function(){'
						, 'showEdited();'
						, '});' 
				   		, '</script>';	
			}
		?>

	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Employee Daily Time Record (DTR)</h5>
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
						<?php
							include('dbconfig.php');
							$empid = $_SESSION['logsession'];
							$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
							echo "<h4><label class='control-label' style='text-align:left;text-transform:uppercase;'>&nbsp;&nbsp;" . $employeeData['employee_firstname'] . " " . $employeeData['employee_lastname'] . "</h4></label>";
							echo '<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">';
								if ($result = $mysqli->query("SELECT * FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id WHERE employee.employee_id = $empid AND (attendance.status = 'Done' OR attendance.attendance_status = 'active' OR attendance.attendance_status = 'outforbreak' OR attendance.attendance_status = 'infrombreak') ORDER BY attendance_date")) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										//echo "<th>Name</th>";
										echo "<th>Date</th>";
										echo "<th>Type of Day</th>";
										echo "<th>Rest Days</th>";
										echo "<th>Shift</th>";
										echo "<th>Schedule</th>";
										echo "<th>Time in</th>";
										echo "<th>Out from break</th>";
										echo "<th>In from break</th>";
										echo "<th>Time out</th>";
										echo "<th>ABS</th>";
										//echo "<th>REG HRS</th>";
										echo "<th>LATE (min)</th>";
										echo "<th>UNDER TIME (min)</th>";
										//echo "<th>REG OT</th>";
										echo "<th>Action</th>";
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
											$timein = $row->attendance_timein;
											$timeout = $row->attendance_timeout;
											$breakin = $row->attendance_breakin;
											$breakout = $row->attendance_breakout;

											$attendance_date = $row->attendance_date;
											$employee_id = $row->employee_id;
											$attendance_id = $row->attendance_id;
											$restday = $row->attendance_restday;
											$restdayArray = array();
											$restdayArray = split('/', $restday);
											$shifting = $row->attendance_shift;
											$shiftArray = array();
											$shiftArray = split('-', $shifting);

											$zero = "0.00";
											$s_zero = "0";
											
											$dateWithDay = date('Y-m-d:l', strtotime($attendance_date));
											$dateWithDayArray = array();
											$dateWithDayArray = split(':', $dateWithDay);

											$typeOfDay = "Regular";
											if($dateRow = $mysqli->query("SELECT * FROM holiday where holiday_date = '$dateWithDayArray[0]'")->fetch_array()) {
												if($dateRow['holiday_type'] == "Regular" || $dateRow['holiday_type'] == "Legal") {
													if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
														$typeOfDay = "Rest & Legal Holiday";
													} else {
														$typeOfDay = "Legal Holiday";
													}
												} else {
													if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
														$typeOfDay = "Rest & Special Holiday";
													} else {
														$typeOfDay = "Special Holiday";
													}
												}
											} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
												$typeOfDay = "Rest Day";
											}

											if($row->attendance_timein == "") {
												$timeindisplay = "";
											} else {
												$timeindisplay = date("g : i : A",strtotime($row->attendance_timein));
												if(strlen($timeindisplay) < 12){
													$timeindisplay = '0'.$timeindisplay; 
												}	
											}
												
											if($row->attendance_breakout == "") {
												$breakoutdisplay = "";
											} else {
												$breakoutdisplay = date("g : i : A",strtotime($row->attendance_breakout));
												if(strlen($breakoutdisplay) < 12){
													$breakoutdisplay = '0'.$breakoutdisplay; 
												}
											}
											
											if($row->attendance_breakin == "") {
												$breakindisplay = "";
											} else {
												$breakindisplay = date("g : i : A",strtotime($row->attendance_breakin));
												if(strlen($breakindisplay) < 12){
													$breakindisplay = '0'.$breakindisplay; 
												}
											}

											if($row->attendance_timeout == "") {
												$timeoutdisplay = "";
											} else {
												$timeoutdisplay = date("g : i : A",strtotime($row->attendance_timeout));
												if(strlen($timeoutdisplay) < 12){
													$timeoutdisplay = '0'.$timeoutdisplay;
												}
											}
										
											echo "<tr>";
											//echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
											echo "<td>" . date("Y-m-d",strtotime($row->attendance_date)) . "</td>";
											echo "<td>" . $typeOfDay . "</td>";
											echo "<td>";
												if($restdayArray[0] == "Monday") echo "Mon/";
												else if($restdayArray[0] == "Tuesday") echo "Tue/";
												else if($restdayArray[0] == "Wednesday") echo "Wed/";
												else if($restdayArray[0] == "Thursday") echo "Thu/";
												else if($restdayArray[0] == "Friday") echo "Fri/";
												else if($restdayArray[0] == "Saturday") echo "Sat/";
												else if($restdayArray[0] == "Sunday") echo "Sun/";

												if($restdayArray[1] == "Monday") echo "Mon</td>";
												else if($restdayArray[1] == "Tuesday") echo "Tue</td>";
												else if($restdayArray[1] == "Wednesday") echo "Wed</td>";
												else if($restdayArray[1] == "Thursday") echo "Thu</td>";
												else if($restdayArray[1] == "Friday") echo "Fri</td>";
												else if($restdayArray[1] == "Saturday") echo "Sat</td>";
												else if($restdayArray[1] == "Sunday") echo "Sun</td>";
											echo "<td>" . $row->employee_type . "</td>";
											echo "<td>" . $row->attendance_shift . "</td>";
											if($row->attendance_timein == ""){
											echo "<td></td>";
											}else{
											echo "<td>" . date("g:i A",strtotime($row->attendance_timein)) . "</td>";	
											}
											if($row->attendance_breakout == ""){
											echo "<td></td>";
											}else{
											echo "<td>" . date("g:i A",strtotime($row->attendance_breakout)). "</td>";
											}

											if($row->attendance_breakin == ""){
											echo "<td></td>";
											}else{
											echo "<td>" . date("g:i A",strtotime($row->attendance_breakin)) . "</td>";
											}

											if($row->attendance_timeout == ""){
											echo "<td></td>";
											}else{
											echo "<td>" . date("g:i A",strtotime($row->attendance_timeout)) . "</td>";
											}
											//START LOIS
											
											if($row->attendance_absent == "") { //absent lois
												echo "<td></td>";
											} else {
												echo "<td>" . $row->attendance_absent . "</td>";
											}

											// if($row->attendance_hours == "") { //reg hrs lois
											// 	echo "<td>00:00</td>";
											// } else {
											// 	$hour = sprintf("%02d", floor($row->attendance_hours));
											// 	$min = sprintf("%02d", round(60*($row->attendance_hours - $hour)));
											// 	$regHrs = $hour . ":" . $min;
											// 	echo "<td>" . $regHrs . "</td>";
											// }

											if($row->attendance_late == "") { //late lois
												echo "<td>00:00</td>";
											} else {
												$hour = sprintf("%02d", floor($row->attendance_late/60));
												$min = sprintf("%02d", $row->attendance_late % 60);
												$late = $hour . ":" . $min;
												echo "<td>" .  $late . "</td>";
											}

											if($row->attendance_undertime == "") { //undertime 
												echo "<td>00:00</td>";
											} else {
												$hour = sprintf("%02d", floor($row->attendance_undertime/60));
												$min = sprintf("%02d", $row->attendance_undertime % 60);
												$undertime = $hour . ":" . $min;
												echo "<td>" . $undertime . "</td>";
											}

											// if($row->attendance_overtime == "") { //reg ot
											// 	echo "<td>0.00</td>";
											// } else {
											// 	echo "<td>" . $row->attendance_overtime . "</td>";
											// }
											
											//END LOIS
											if($row->attendance_status == "timeout") $attRecord = "Present";
											else if($row->attendance_status == "inactive") $attRecord = "Absent";
											$empType = $employeeData['employee_type'];
											echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'showmodal' 											
														data-id='$row->attendance_id' 
														data-date='$row->attendance_date'
														data-emp='$empType'
														data-attend='$attRecord'
														data-absentbool='$row->attendance_absent' 
														data-timein='$timeindisplay'
														data-breakout='$breakoutdisplay'
														data-breakin='$breakindisplay'
														data-timeout='$timeoutdisplay'
														data-status='$row->attendance_status'
														data-daytype='$row->attendance_daytype'
														data-remarks='$row->attendance_remarks'
														
											
											><button class='btn btn-info' type='button'><i class='fa fa-paste'></i> Edit</button></a></td>";
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
				<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<i class="fa fa-edit modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Log edit request</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" action = "logeditrequestexe.php" class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-3 control-label">Attendance ID</label>
									<div class="col-md-8"><input id = "attendanceid" name = "attendanceid" type="text" class="form-control" readonly = "readonly"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Date</label>
									<div class="col-md-8"><input id = "date" name = "date" type="text" class="form-control" readonly="readonly" onKeyPress="return noneonly(this, event)"></div>
								</div>
								<input type ='hidden' name ='daytype' id ='daytype' />
								<input type='hidden' name='status' id='status' />
								<input type='hidden' name='absentbool' id='absentbool' />
								<input type='hidden' name='emptype' id='emptype' />
								<div class='form-group'>
									<label class='col-sm-3 control-label'>Attendance</label>
									<div class='col-md-8'><select id='isabsent' name='isabsent' onchange="changeAbsent(this);" class = 'form-control' required='' data-default-value='Present' ><option selected='true' value = 'Present'>Present</option><option value = 'Absent'>Absent</option></select></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Time in</label>
									<div class="col-md-8">
										<div class="input-group clockpicker" data-autoclose="true">
											<input type="text" id = "timein" name = "timein" class="form-control timepicker1" value="" required>
											<span class="input-group-addon">
												<span class="fa fa-clock-o"></span>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Out from break</label>
									<div class="col-md-8">
										<div class="input-group clockpicker" data-autoclose="true">
											<input type="text" id = "breakout" name = "breakout" class="form-control timepicker1" value="" required>
											<span class="input-group-addon">
												<span class="fa fa-clock-o"></span>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">In from break</label>
									<div class="col-md-8">
										<div class="input-group clockpicker" data-autoclose="true">
											<input type="text" id = "breakin" name = "breakin" class="form-control timepicker1" value="" required>
											<span class="input-group-addon">
												<span class="fa fa-clock-o"></span>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Time out</label>
									<div class="col-md-8">
										<div class="input-group clockpicker" data-autoclose="true">
											<input type="text" id = "timeout" name = "timeout" class="form-control timepicker1" value="" required>
											<span class="input-group-addon">
												<span class="fa fa-clock-o"></span>
											</span>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Reason:</label>
									<div class="col-md-8"><textarea type="text" id = "reason" class="form-control" name = "reason" placeholder = "Input your reasons here..." required></textarea></div>
								</div>
								
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary editdtrdialog">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	   <script src="js/jquery.min.js"></script>
    <script src="js/timepicki.js"></script>
    <script>
	$('.timepicker1').timepicki();
    </script>
    <link href="css/timepicki.css" rel="stylesheet">
		<?php
			include('employeemenufooter.php');
		?>
	</body>
</html>