
<!DOCTYPE html>
<html>
	<head>
		<?php
	    //get from ajax url
		//$fromAttendance = $_GET['from'];
	    //if($fromAttendance == 2) {				// this part is removed since supervisor(level 2) is now prevented-
	    //	include('supervisormenuheader.php'); 	// -access of all employees attendance records
	    //} else if($fromAttendance == 1) {
	    	session_start();
        $empLevel = $_SESSION['employee_level'];
        if(isset($_SESSION['logsession']) && $empLevel == '3') {
                include('menuheader.php');

        }else if(isset($_SESSION['logsession']) && $empLevel == '4') {
            include('levelexe.php');
        }
			$employee_id = $_SESSION['logsession'];
	     	$fromAttendance = 1; // remove this if supervisor is allowed to view attendance of all
	 	// }

		$id = intval($_GET['id']);
		$datef = $_GET['datef'];
		$datet = $_GET['datet'];

		//2016/6/1
		//06/01/2016 - 06/20/2016
		$datefArr = split('/', $datef);
		$newDatef = sprintf("%02d", $datefArr[1]) . "/" . sprintf("%02d", $datefArr[2]) . "/" . sprintf("%04d", $datefArr[0]);
		$datetArr = split('/', $datet);
		$newDatet = sprintf("%02d", $datetArr[1]) . "/" . sprintf("%02d", $datetArr[2]) . "/" . sprintf("%04d", $datetArr[0]);
		$newDateFilter = $newDatef . " - " . $newDatet;


		?>
		<title>Employee DTR</title>
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

		<link rel="stylesheet" type="text/css" href="datepicker.css" /> 
		<script type="text/javascript" src="datepicker.js"></script> 
		<!--script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script-->
		<script type="text/javascript">
			$(document).on("click", ".editdtrdialog", function () {

				// this gets the values from the a href button when the button is clicked
				var id = $(this).data('id');
				var date = $(this).data('date');
				var emp = $(this).data('emp');
				var daytype = $(this).data('daytype');
				var attend = $(this).data('attend');
				var timein = $(this).data('timein');
				var outfrombreak = $(this).data('breakout');
				var infrombreak = $(this).data('breakin');
				var timeout = $(this).data('timeout');
				var status = $(this).data('status');
				var absentbool = $(this).data('absentbool');
				
				// this puts the values gotten from the ahref button to display for the modal
				$(".modal-body #attendanceid").val( id );
				$(".modal-body #date").val( date );
				$(".modal-body #isabsent").val( attend );
				$(".modal-body #timein").val( timein );
				$(".modal-body #outfrombreak").val( outfrombreak );
				$(".modal-body #infrombreak").val( infrombreak );
				$(".modal-body #timeout").val( timeout );
				$(".modal-body #daytype").val( daytype );
				$(".modal-body #status").val( status );
				$(".modal-body #absentbool").val( absentbool );
				$(".modal-body #empType").val( emp );
				$(".modal-body #daytype").val( daytype );

				if(status == "inactive") { // if inactive status (absent)
					document.getElementById('timein').disabled=true;
					document.getElementById('outfrombreak').disabled=true;
					document.getElementById('infrombreak').disabled=true;
					document.getElementById('timeout').disabled=true;
					document.getElementById('timein').value="";
					document.getElementById('outfrombreak').value="";
					document.getElementById('infrombreak').value="";
					document.getElementById('timeout').value="";
				} else if(status == "timeout") { // if timeout status (present)
					document.getElementById('timein').disabled=false;
					document.getElementById('outfrombreak').disabled=false;
					document.getElementById('infrombreak').disabled=false;
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
				document.getElementById('outfrombreak').disabled=true;
				document.getElementById('infrombreak').disabled=true;
				document.getElementById('timeout').disabled=true;
				document.getElementById('timein').value="";
				document.getElementById('outfrombreak').value="";
				document.getElementById('infrombreak').value="";
				document.getElementById('timeout').value="";
			} else if(val == "Present") { // enables time inputs for an present case
				document.getElementById('timein').disabled=false;
				document.getElementById('outfrombreak').disabled=false;
				document.getElementById('infrombreak').disabled=false;
				document.getElementById('timeout').disabled=false;
				document.getElementById('timein').value="";
				document.getElementById('outfrombreak').value="";
				document.getElementById('infrombreak').value="";
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
				toastr.success("Successfully edited attendance!");
				}		
			});
		</script>

		<!--script type="text/javascript">
			$(document).ready(function(){ // this is the supposed toaster for level 2 user
			 	showEdited2=function(){
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
				toastr.success("Successfully edited attendance!");
				}		
			});
		</script-->

		<script type="text/javascript">
			//javascript for date picker - from and to
			$(function() {
			  $('input[name="datefilter"]').daterangepicker({
			      autoUpdateInput: false,
			      locale: {
			          cancelLabel: 'Clear'
			      }
			  });

			  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
			      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
			  });

			  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
			      $(this).val('');
			  });

			});
		</script>

		<script>		
			//ajax calling export_attendance.php
			function exportDet(id, datef, datet) { // passing of details for exporting
				var empid = id;
				var datef = new Date(datef);
				var datef = datef.getFullYear() + '/' + (datef.getMonth() + 1) + '/' + datef.getDate(); 
				
				var datet = new Date(datet);
				var datet = datet.getFullYear() + '/' + (datet.getMonth() + 1) + '/' + datet.getDate();

				document.location.href = 'export_attendance_process.php?from=one&id='+empid+'&datef='+datef+'&datet='+datet;
			}											// from=one means only one employee is going to be exported
		</script>

		<?php
			// calls shoWEdited when the 'edited' get variable is set (from editattendance.php)

			if(isset($_GET['edited'])){ // && $fromAttendance == 1) {
				echo '<script type="text/javascript">'
						, '$(document).ready(function(){'
						, 'showEdited();'
						, '});' 
				   		, '</script>';	
			} 
			// else if(isset($_GET['edited']) && $fromAttendance == 2) {
			// 	echo '<script type="text/javascript">'
			// 			, '$(document).ready(function(){'
			// 			, 'showEdited2();'
			// 			, '});' 
			// 	   		, '</script>';	
			// } // this is the supposed calling of showEdited2 for level 2 employees
		?>
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

					
					<div class="ibox-content">	<br><br>
						<div class="form-group">
							<div style="margin-left:-125px" class="col-md-3"></div>
							<?php 
								//if($fromAttendance == 1)  // for level 3 users
									echo'<form method="POST" action="attendance.php">'; 
								//else // for level 2 users
								//	echo'<form method="POST" action="attendance2.php">'; 
							?>
								<table>
									<tr>
										<td style="padding:10px;"><h4><label class="control-label">Select Date Range</label></h4></td>
										<td style="padding:10px; width:250px;"><div>
											<input type="text" name="datefilter" id="datefilter" value="<?php echo $newDateFilter?>" class="form-control" required/>
										</div></td>
										<?php
											// gets the cutoff daterange for validation
											$cutarray1 = array();
											$cutarray1 = split(" - ", $newDateFilter);
											$keydatefrom1 = $cutarray1[0];
											$keydatefrom1 = date("Y-m-d", strtotime($keydatefrom1));
											$keydateto1 = $cutarray1[1];
											$keydateto1 = date("Y-m-d", strtotime($keydateto1));
											$datef1 = strtotime($keydatefrom1)*1000;
											$datet1 = strtotime($keydateto1)*1000;
										?>
										<td style="padding:10px;"><button type="submit" name="test" class="btn btn-w-m btn-primary">Validate</button></td>
										<td style="padding:10px;"><button type="button" name="export" class="btn btn-w-m btn-primary" onclick="<?php echo 'exportDet('.$id.','.$datef1.','.$datet1.')'; ?>">Export This Attendance</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>

					<div class="ibox-content">

						<?php

						if(isset($_POST['keydate'])){
							$keydate = $_POST['keydate'];

							$cutarray = array();
							$cutarray = split(" - ", $keydate);
							$keydatefrom = $cutarray[0];
							$keydateto = $cutarray[1];
						}
						if(isset($_POST['keydate'])){
							$keydate1 = $_POST['keydate1'];

							$cutarray = array();
							$cutarray = split(" - ", $keydate1);
							$keydatefrom = $cutarray[0];
							$keydateto = $cutarray[1];
						}
						include('dbconfig.php');
						//if($fromAttendance == 1) 
							echo '<form name="frmUser" method="post" action="attendance.php">';
						//else echo '<form name="frmUser" method="post" action="attendance2.php">';
							echo "<input type='hidden' id='datefilter' name='datefilter' value='". $newDateFilter ."'>";
							$keydate = "WHERE attendance_date BETWEEN '$datef' AND '$datet' AND attendance.employee_id = '".$id."' AND (attendance.status = 'Done' OR attendance.attendance_status = 'active' OR attendance.attendance_status = 'outforbreak' OR attendance.attendance_status = 'infrombreak') AND employee.employee_type = 'Fixed'";
							$keydate1 = "WHERE attendance_date BETWEEN '$datef' AND '$datet' AND attendance.employee_id = '".$id."' AND (attendance.status = 'Done' OR attendance.attendance_status = 'active' OR attendance.attendance_status = 'outforbreak' OR attendance.attendance_status = 'infrombreak') AND employee.employee_type = 'Flexible'";
							$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$id'")->fetch_array();
							echo "<h4><label class='control-label' style='float:left;text-transform:uppercase;padding-top:10px;'>&nbsp;" . $employeeData['employee_firstname'] . " " . $employeeData['employee_lastname'] . " (" . $employeeData['employee_type'] . ")". "</label></h4>";
							echo "<button type='submit' name='list' id='list' class='btn btn-success' style='float:right;'><span class='glyphicon glyphicon-circle-arrow-left'>&nbsp;</span><span>Employee List</span></button>";
							echo "<input type='text' class='form-control input-sm m-b-xs' id='filter' placeholder='Search in table'>";

							if ($result = $mysqli->query("SELECT * FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id $keydate ORDER BY attendance_date")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{	

									echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";			
									echo "<thead>";
									echo "<tr>";
									//echo "<th>Name</th>";
									echo "<th>Date</th>";
									echo "<th>Type</th>";
									//echo "<th>Shift Type</th>";
									echo "<th>Rest Days</th>";
									echo "<th>Shift Schedule</th>";
									echo "<th>Time in</th>";
									echo "<th>Out from break</th>";
									echo "<th>In from break</th>";
									echo "<th>Time out</th>";
									echo "<th>ABS</th>";
									//echo "<th>REG HRS</th>";
									echo "<th>LATE</th>";
									echo "<th>UNDER TIME</th>";
									echo "<th>OVER BREAK</th>";										
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

										// checks type of day
										$typeOfDay = "Regular";
										$typeOfDay2 = "REG";
										if($dateRow = $mysqli->query("SELECT * FROM holiday where holiday_date = '$dateWithDayArray[0]' AND holiday_archive != 'archive'")->fetch_array()) {
											if($dateRow['holiday_type'] == "Regular" || $dateRow['holiday_type'] == "Legal") {
												if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
													$typeOfDay = "Rest & Legal Holiday";
													$typeOfDay2 = "RST/LH";
												} else {
													$typeOfDay = "Legal Holiday";
													$typeOfDay2 = "LH";
												}
											} else {
												if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
													$typeOfDay = "Rest & Special Holiday";
													$typeOfDay2 = "RST/SH";
												} else {
													$typeOfDay = "Special Holiday";
													$typeOfDay2 = "SH";
												}
											}
										} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
											$typeOfDay = "Rest Day";
											$typeOfDay2 = "RD";
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
										echo "<td>". $typeOfDay2 . "</td>";
										//echo "<td>" . $row->employee_type . "</td>";

										// for printing of rest days
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

										//start lois
											
										if($row->attendance_absent == "") { //absent lois
											echo "<td></td>";
										} else {
											echo "<td>" . $row->attendance_absent . "</td>";
										}

										/*if($row->attendance_hours == "") { //reg hrs lois
											echo "<td>00:00</td>";
										} else {
											$hour = sprintf("%02d", floor($row->attendance_hours));
											$min = sprintf("%02d", round(60*($row->attendance_hours - $hour)));
											$regHrs = $hour . ":" . $min;
											echo "<td>" . $regHrs . "</td>";
										}*/

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

										if($row->attendance_overbreak == "") { //overbreak
											echo "<td>00:00</td>";
										} else {
											$hour = sprintf("%02d", floor($row->attendance_overbreak/60));
											$min = sprintf("%02d", $row->attendance_overbreak % 60);
											$overbreak = $hour . ":" . $min;
											echo "<td>" . $overbreak . "</td>";
										}

										/*if($row->attendance_overtime == "") { //reg ot
											echo "<td>0.00</td>";
										} else {
											echo "<td>" . $row->attendance_overtime . "</td>";
										}*/
										if ($result1 = $mysqli->query("SELECT * FROM emp_cutoff INNER JOIN cutoff ON emp_cutoff.empcut_initial = cutoff.cutoff_initial AND emp_cutoff.empcut_end = cutoff.cutoff_end INNER JOIN attendance ON emp_cutoff.employee_id = attendance.employee_id WHERE '".$attendance_date."' BETWEEN emp_cutoff.empcut_initial AND emp_cutoff.empcut_end AND cutoff_submission = 'Submitted' AND attendance.employee_id = '".$id."'")) //get records from db
											{ // if attendance date is submitted in a cutoff, it should no longer be editable
												if ($result1->num_rows > 0) //display records if any
												{	
													echo "<td><button class='btn btn-info' type='button' disabled><i class='fa fa-paste'></i> Edit</button></td>";
												}
												else {
													if($row->attendance_timeout == "" && $row->attendance_absent == 0 && $row->status == "Not Done") {
														echo "<td><button class='btn btn-info' type='button' disabled><i class='fa fa-paste'></i> Edit</button></td>";
													} // if the attendance date is not done yet, it should not be editable
													 else {
													 	$empType = $employeeData['employee_type'];
													 	if($row->attendance_status == "timeout") $attRecord = "Present";
													 	else if($row->attendance_status == "inactive") $attRecord = "Absent";
														echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'editdtrdialog'					
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
																		data-remarks='$row->attendance_remarks'>
																		<button class='btn btn-info' type='button'><i class='fa fa-paste'></i> Edit</button></a></td>";
													}
												}
										}

										
										echo "</tr>";
									}
									echo "</table>";
								}
							}
							if ($result = $mysqli->query("SELECT * FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id $keydate1 ORDER BY attendance_date")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{	

									echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";			
									echo "<thead>";
									echo "<tr>";
									//echo "<th>Name</th>";
									echo "<th>Date</th>";
									echo "<th>Type</th>";
									//echo "<th>Shift Type</th>";
									echo "<th>Rest Days</th>";
									echo "<th>Shift Schedule</th>";
									echo "<th>Time in</th>";
									echo "<th>Out from break</th>";
									echo "<th>In from break</th>";
									echo "<th>Time out</th>";
									//echo "<th>ABS</th>";
									echo "<th>REG HRS</th>";
									//echo "<th>LATE</th>";
									echo "<th>UNDER TIME</th>";
									//echo "<th>OVER BREAK</th>";										
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

										// checks type of day
										$typeOfDay = "Regular";
										$typeOfDay2 = "REG";
										if($dateRow = $mysqli->query("SELECT * FROM holiday where holiday_date = '$dateWithDayArray[0]' AND holiday_archive != 'archive'")->fetch_array()) {
											if($dateRow['holiday_type'] == "Regular" || $dateRow['holiday_type'] == "Legal") {
												if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
													$typeOfDay = "Rest & Legal Holiday";
													$typeOfDay2 = "RST/LH";
												} else {
													$typeOfDay = "Legal Holiday";
													$typeOfDay2 = "LH";
												}
											} else {
												if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
													$typeOfDay = "Rest & Special Holiday";
													$typeOfDay2 = "RST/SH";
												} else {
													$typeOfDay = "Special Holiday";
													$typeOfDay2 = "SH";
												}
											}
										} else if(($restdayArray[0] == $dateWithDayArray[1]) || ($restdayArray[1] == $dateWithDayArray[1])) {
											$typeOfDay = "Rest Day";
											$typeOfDay2 = "RD";
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
										echo "<td>". $typeOfDay2 . "</td>";
										//echo "<td>" . $row->employee_type . "</td>";

										// for printing of rest days
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

										//start lois
											
										/*if($row->attendance_absent == "") { //absent lois
											echo "<td></td>";
										} else {
											echo "<td>" . $row->attendance_absent . "</td>";
										}*/

										if($row->attendance_hours == "") { //reg hrs lois
											echo "<td>00:00</td>";
										} else {
											$hour = sprintf("%02d", floor($row->attendance_hours));
											$min = sprintf("%02d", round(60*($row->attendance_hours - $hour)));
											$regHrs = $hour . ":" . $min;
											echo "<td>" . $regHrs . "</td>";
										}

										/*if($row->attendance_late == "") { //late lois
											echo "<td>00:00</td>";
										} else {
											$hour = sprintf("%02d", floor($row->attendance_late/60));
											$min = sprintf("%02d", $row->attendance_late % 60);
											$late = $hour . ":" . $min;
											echo "<td>" .  $late . "</td>";
										}*/
										if($row->attendance_undertime == "") { //undertime 
											echo "<td>00:00</td>";
										} else {
											$hour = sprintf("%02d", floor($row->attendance_undertime/60));
											$min = sprintf("%02d", $row->attendance_undertime % 60);
											$undertime = $hour . ":" . $min;
											echo "<td>" . $undertime . "</td>";
										}

										/*if($row->attendance_overbreak == "") { //overbreak
											echo "<td>00:00</td>";
										} else {
											$hour = sprintf("%02d", floor($row->attendance_overbreak/60));
											$min = sprintf("%02d", $row->attendance_overbreak % 60);
											$overbreak = $hour . ":" . $min;
											echo "<td>" . $overbreak . "</td>";
										}*/

										/*if($row->attendance_overtime == "") { //reg ot
											echo "<td>0.00</td>";
										} else {
											echo "<td>" . $row->attendance_overtime . "</td>";
										}*/
										if ($result1 = $mysqli->query("SELECT * FROM emp_cutoff INNER JOIN cutoff ON emp_cutoff.empcut_initial = cutoff.cutoff_initial AND emp_cutoff.empcut_end = cutoff.cutoff_end INNER JOIN attendance ON emp_cutoff.employee_id = attendance.employee_id WHERE '".$attendance_date."' BETWEEN emp_cutoff.empcut_initial AND emp_cutoff.empcut_end AND cutoff_submission = 'Submitted' AND attendance.employee_id = '".$id."'")) //get records from db
											{ // if attendance date is submitted in a cutoff, it should no longer be editable
												if ($result1->num_rows > 0) //display records if any
												{	
													echo "<td><button class='btn btn-info' type='button' disabled><i class='fa fa-paste'></i> Edit</button></td>";
												}
												else {
													if($row->attendance_timeout == "" && $row->attendance_absent == 0 && $row->status == "Not Done") {
														echo "<td><button class='btn btn-info' type='button' disabled><i class='fa fa-paste'></i> Edit</button></td>";
													} // if the attendance date is not done yet, it should not be editable
													 else {
													 	$empType = $employeeData['employee_type'];
													 	if($row->attendance_status == "timeout") $attRecord = "Present";
													 	else if($row->attendance_status == "inactive") $attRecord = "Absent";
														echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'editdtrdialog'					
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
																		data-remarks='$row->attendance_remarks'>
																		<button class='btn btn-info' type='button'><i class='fa fa-paste'></i> Edit</button></a></td>";
													}
												}
										}

										
										echo "</tr>";
									}
									echo "</table>";
								}
							}
						echo "<input type='hidden' value='".$datef."' name='datef'>";
						echo "<input type='hidden' value='".$datet."' name='datet'>";
						
						echo "</form>";
					?>
					<!--form method = "post" action="updateall.php">
						<input type="hidden" id = "urlfrom" name = "urlfrom" value="<?php //echo $fromAttendance ?>">
						<input type="hidden" id = "urlid" name = "urlid" value="<?php //echo $id ?>">
						<input type="hidden" id = "urldatef" name = "urldatef" value="<?php //echo $datef ?>">
						<input type="hidden" id = "urldatet" name = "urldatet" value="<?php // echo $datet ?>">
						<button type="update" class="btn btn-primary">Update</button>
					</form-->
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
					<h4 class="modal-title">Edit DTR</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "myForm" method="POST" action = "editattendance.php" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label">Attendance ID</label>
								<div class="col-md-8"><input id = "attendanceid" name = "attendanceid" type="text" class="form-control" readonly = "readonly"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Date</label>
								<div class="col-md-8"><input id = "date" name = "daterange" type="text" class="form-control" readonly="readonly"></div>
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
										<input type="text" id = "outfrombreak" name = "outfrombreak" class="form-control timepicker1" value="" required>
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
										<input type="text" id = "infrombreak" name = "infrombreak" class="form-control timepicker1" value="" required>
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
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id = "urlfrom" name = "urlfrom" value="<?php echo $fromAttendance ?>">
						<input type="hidden" id = "urlid" name = "urlid" value="<?php echo $id ?>">
						<input type="hidden" id = "urldatef" name = "urldatef" value="<?php echo $datef ?>">
						<input type="hidden" id = "urldatet" name = "urldatet" value="<?php echo $datet ?>">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
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
    <script>
	    $(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip({animation:true, delay: {show: 100, hide: 100}});
		});
    </script>
    <link href="css/timepicki.css" rel="stylesheet">
		<?php
			include('menufooter.php');
		?>
	</body>
</html>