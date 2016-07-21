<!DOCTYPE html>
<html>
	<head>
		<?php
			include('menuheader.php');
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
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script type="text/javascript">
			$(document).on("click", ".editdtrdialog", function () {
			var id = $(this).data('id');
			var date = $(this).data('date');
			var timein = $(this).data('timein');
			var outfrombreak = $(this).data('breakout');
			var infrombreak = $(this).data('breakin');
			var timeout = $(this).data('timeout');
			
			$(".modal-body #attendanceid").val( id );
			$(".modal-body #date").val( date );
			$(".modal-body #timein").val( timein );
			$(".modal-body #outfrombreak").val( outfrombreak );
			$(".modal-body #infrombreak").val( infrombreak );
			$(".modal-body #timeout").val( timeout );
			});

			$(document).on("click", ".openEmp", function () {
			var emp_id = $(this).data('emp_id');
			var emp_fname = $(this).data('emp_fname');
			var emp_lname = $(this).data('emp_lname');

			$(".openDiv #emp_id").val(emp_id);
			$(".openDiv #emp_fname").val(emp_fname);
			$(".openDiv #emp_lname").val(emp_lname);
			});

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
				history.replaceState({}, "Title", "attendance.php");
		}
		
		
	});
	</script>
	<?php
		if(isset($_GET['edited']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited();'
					, '});' 
			   
			   , '</script>'
			;	
		}
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
							<div class="col-md-3"></div>
							<form method="POST" action="attendance.php">
								<label class="col-sm-1 control-label">Schedule List</label>
								<div class="col-md-4">
									<select id = "leavetype" class="form-control"  data-default-value="z" name="keydate" required="">
								<?php 
								include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM cutoff")) //get records from db
									{
										if ($result1->num_rows > 0) //display records if any
										{
											echo '<option value=""> Select Cutoff &nbsp;&nbsp;(Month-Day-Year) </option>';
											while ($row1 = mysqli_fetch_object($result1)){
												$initial = $row1->cutoff_initial;
												$end = $row1->cutoff_end;

												echo '<option value="'.$initial." - ".$end."\">".date("F d, Y",strtotime($initial)).' - ';
												echo date("F d, Y",strtotime($end)).'</option>';
											}
										}
									}
								

								?>
								</SELECT>
							</div>
							<button type="submit" name="test" class="btn btn-w-m btn-primary">Validate</button>
						</form>
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
							include('dbconfig.php');
							if(isset($_POST['test'])){
								$keydate = "WHERE attendance_date BETWEEN '$keydatefrom' AND '$keydateto'";

								echo "<a href='export_attendance.php'><button id='submit' type='submit' name='export' class='btn btn3 btn-w-m btn-primary' style='float:right;'><span class='glyphicon glyphicon-file'>&nbsp;</span><span>Export Attendance</span></button></a>

								<input type='text' class='form-control input-sm m-b-xs' id='filter' placeholder='Search in table'>";

								if ($result = $mysqli->query("SELECT DISTINCT * FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id $keydate ORDER BY attendance_date")) //get records from db
								{
									if ($result->num_rows > 0) //display employee based on date range
									{
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";	
										echo "<thead>";
										echo "<tr>";
										echo "<th>Name</th>";
										echo "<th colspan='4'>Action</th>";
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
											$data['emp_id'] = $row->employee_id;
											$data['emp_fname'] = $row->employee_firstname;
											$data['emp_lname'] = $row->employee_lastname;
											echo "<tr>";
											echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
											echo "<td colspan='2'><button class='btn btn-info' type='submit' name='open'><span class='glyphicon glyphicon-folder-open'>&nbsp;</span><span>Open</button></span></td>";
											echo "<td colspan='2'><a href='export_attendance.php'><button id='submit' type='submit' name='export' class='btn btn3 btn-w-m btn-primary'><span class='glyphicon glyphicon-file'>&nbsp;</span><span>Export Attendance</span></button></a></td>";
											echo "</tr>";
										}
										echo "</table>";
									}
								}
							}
							//result after clicking the open button
							else if (isset($_POST['open'])){
								$keydate = "WHERE attendance_date BETWEEN '$keydatefrom' AND '$keydateto' AND employee_id ='". $emp_id ."' AND employee_firstname ='". $emp_fname ."' AND employee_lastname ='". $emp_lname ."'";
								echo "<input type='text' class='form-control input-sm m-b-xs' id='filter' placeholder='Search in table'>";
								
								//"<div class='openEmp'>"
								if ($result = $mysqli->query("SELECT * FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id $keydate ORDER BY attendance_date")) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>Name</th>";
										echo "<th>Date</th>";
										echo "<th>Type of Day</th>";
										echo "<th>Shift Type</th>";
										echo "<th>Shift Schedule</th>";
										echo "<th>Time in</th>";
										echo "<th>Out from break</th>";
										echo "<th>In from break</th>";
										echo "<th>Time out</th>";
										echo "<th>ABS</th>";
										echo "<th>REG HRS</th>";
										echo "<th>LATE (min)</th>";
										echo "<th>UNDER TIME (min)</th>";
										echo "<th>OVER BREAK (min)</th>";										
										echo "<th>REG OT</th>";
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

											$timeindisplay = date("g : i : A",strtotime($row->attendance_timein));
											if(strlen($timeindisplay) < 12){
												$timeindisplay = '0'.$timeindisplay; 
											}
											$breakoutdisplay = date("g : i : A",strtotime($row->attendance_breakout));
											if(strlen($breakoutdisplay) < 12){
												$breakoutdisplay = '0'.$breakoutdisplay; 
											}
											$breakindisplay = date("g : i : A",strtotime($row->attendance_breakin));
											if(strlen($breakindisplay) < 12){
												$breakindisplay = '0'.$breakindisplay; 
											}
											$timeoutdisplay = date("g : i : A",strtotime($row->attendance_timeout));
											if(strlen($timeoutdisplay) < 12){
												$timeoutdisplay = '0'.$timeoutdisplay;
											}
											echo "<tr>";
											echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
											echo "<td>" . date("Y-m-d",strtotime($row->attendance_date)) . "</td>";
											echo "<td></td>";
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

											//ABSENT
											$currTime = time();

											// $currDate = date("Y/m/d");
											// $var = date("Y-m-d", strtotime($currDate . "-1 days"));

											// $check_date = $mysqli->query("SELECT COUNT(*) AS check_absent FROM attendance WHERE attendance_date = '$var' AND employee_id = $employee_id");
											// $fetchDate = $check_date->fetch_object();
											// $checkAbsent = $fetchDate->check_absent;

											
											// $restday = $row->attendace_restday;
											// $checkRstday = date("y-m-d:l", strtotime($attendance_date));
											// $rstArray = array();
											// $rstArray = split(':', $checkRstday);
											
											// if($fetchDate->check_absent == 0 && $currTime > $shiftArray[1]){
											// 	$mysqli->query("INSERT INTO attendance (attendance_id,employee_id,attendance_date,attendance_timein,attendance_breakout,attendance_breakin,attendance_timeout) VALUES ('','$employee_id','$var','','','','')");
											// }

											// //RESTDAY CONDITION
											// if($row->attendance_timein == "" && $rstArray[1] == $restday){
											// 	$mysqli->query("UPDATE attendance SET attendance_absent = '0.0', attendance_status = 'timeout' WHERE employee_id = $employee_id AND attendance_date = '$var'");
											// 	echo '<td>Restday</td>';
											// }else if($row->attendance_timein == "" && $rstArray[1] !== $restday){
											// 	$mysqli->query("UPDATE attendance SET attendance_absent = '1.0', attendance_status = 'timeout' WHERE employee_id = $employee_id AND attendance_date = '$var'");
											// 	echo '<td>1</td>';
											// }else{
											// 	echo '<td>0</td>';
											// }
											echo '<td>0</td>';

											//REG HRS
											$ndStart = "22:00";
											$ndEnd = "06:00";

											// if($dateWithDayArray[1] == $restdayArray[0] || $dateWithDayArray[1] == $restdayArray[1]){
											// 	echo '<td>0.00</td>';
											// 	$mysqli->query("UPDATE attendance SET attendance_hours='$zero' WHERE attendance_id='$attendance_id'");
											// }else 
											if($row->employee_type == "Fixed" || $row->employee_type == "Shifting"){
												if($breakout == "" || $breakin == "" || $timeout == ""){
													echo '<td>00:00</td>';
													$mysqli->query("UPDATE attendance SET attendance_hours='$zero' WHERE attendance_id='$attendance_id'");
												}else{
													if(date("H:i", strtotime($timein)) < $shiftArray[0]){
														$timein = $shiftArray[0];
													}

													if($timeout > $shiftArray[1]){
														$timeout = $shiftArray[1];
													}

													$timeinArray = array();
													$timeinArray = split(":", $timein);
													$timeinArrayMin = sprintf("%.2f", $timeinArray[1]/60);
													$timeinArrayDec = sprintf("%.2f", $timeinArray[0] + $timeinArrayMin);
													$newRegHrs = date("H:i", (strtotime($timeout) - 60*60*$timeinArrayDec) - 3600);
													echo '<td>'.$newRegHrs.'</td>';

													$newRegHrsArray = array();
													$newRegHrsArray = split(":", $newRegHrs);
													$newRegHrsArrayMin = sprintf("%.2f", $newRegHrsArray[1]/60);
													$newRegHrsArrayDec = sprintf("%.2f", $newRegHrsArray[0] + $newRegHrsArrayMin);
													$mysqli->query("UPDATE attendance SET attendance_hours='$newRegHrsArrayDec' WHERE attendance_id='$attendance_id'");											

												}
											}else if($row->employee_type == "Flexi"){ //FLEXI
												if($breakout == "" || $breakin == "" || $timeout == ""){
													echo '<td>00:00</td>';
													$mysqli->query("UPDATE attendance SET attendance_hours='$zero' WHERE attendance_id='$attendance_id'");
												}else{
													$timeinArray = array();
													$timeinArray = split(":", $timein);
													$timeinArrayMin = sprintf("%.2f", $timeinArray[1]/60);
													$timeinArrayDec = sprintf("%.2f", $timeinArray[0] + $timeinArrayMin);
													$newRegHrs = date("H:i", (strtotime($timeout) - 60*60*$timeinArrayDec) - 3600);
													echo '<td>'.$newRegHrs.'</td>';
												}																			
											}
											
											else{
												echo '<td>00:00</td>';
												$mysqli->query("UPDATE attendance SET attendance_hours='$zero' WHERE attendance_id='$attendance_id'");												
											}
											
											

											//LATE
											if($dateWithDayArray[1] == $restdayArray[0] || $dateWithDayArray[1] == $restdayArray[1]){
												echo '<td>00:00</td>';
												$mysqli->query("UPDATE attendance SET attendance_late='$s_zero' WHERE attendance_id='$attendance_id'");
											}else if($row->employee_type == "Fixed" || $row->employee_type == "Shifting"){
												if(date('H:i', strtotime($timein)) < $shiftArray[0]){
													$totalLate = "00:00";
													echo '<td>'.$totalLate.'</td>';
													$mysqli->query("UPDATE attendance SET attendance_late='$s_zero' WHERE attendance_id='$attendance_id'");
												}else if($timein > $shiftArray[0]){
												$late = date('H:i', strtotime($timein) - strtotime($shiftArray[0]) - strtotime('03:00'));
												$lateArray = array();
												$lateArray = split(':', $late);
												$hoursTominutes1 = $lateArray[0]*60;
												$totalLate = $hoursTominutes1 + $lateArray[1];
													if($totalLate == "00"){
														echo '<td>00:00</td>';
														$mysqli->query("UPDATE attendance SET attendance_late='$s_zero' WHERE attendance_id='$attendance_id'");
													}else{
														echo '<td>'. $late .'</td>';
														$mysqli->query("UPDATE attendance SET attendance_late='$totalLate' WHERE attendance_id='$attendance_id'");
													}
												}else{
													echo '<td>00:00</td>';
													$mysqli->query("UPDATE attendance SET attendance_late='$s_zero' WHERE attendance_id='$attendance_id'");
												}
											}else{//FLEXI
												echo '<td>00:00</td>';
												$mysqli->query("UPDATE attendance SET attendance_late='$s_zero' WHERE attendance_id='$attendance_id'");
											}
											

											//UNDERTIME

											if($dateWithDayArray[1] == $restdayArray[0] || $dateWithDayArray[1] == $restdayArray[1]){
												echo '<td>00:00</td>';
												$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
											}else if($row->employee_type == "Fixed" || $row->employee_type == "Shifting"){
												if($timeout < $shiftArray[1]){
													if($timeout == ""){
														$timeout = $shiftArray[1];
													}
													$undertime = date('H:i', strtotime($shiftArray[1]) - strtotime($timeout) - strtotime('03:00'));
													$undertimeArray = array();
													$undertimeArray = split(':', $undertime);
													$hoursTominutes2 = $undertimeArray[0]*60;
													$totalUndertime = $hoursTominutes2 + $undertimeArray[1];
													if($totalUndertime == "00"){
														echo '<td>00:00</td>';
														$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
													}else{
														echo '<td>'.$undertime.'</td>';
														$mysqli->query("UPDATE attendance SET attendance_undertime='$totalUndertime' WHERE attendance_id='$attendance_id'");
													}
												}else{
													echo '<td>00:00</td>';
													$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
												}
											}else{//FLEXI
												echo '<td>00:00</td>';
												$mysqli->query("UPDATE attendance SET attendance_undertime='$s_zero' WHERE attendance_id='$attendance_id'");
											}


											//get max break time
											$out = date('H:i', strtotime($breakout));
											$breaktimeArray = array();
											$breaktimeArray = split(':', $out);
											$breaktimehr = $breaktimeArray[0] + 1;
											$hoursTominutes2 = $breaktimehr*60;
											$totalbreaktime = $hoursTominutes2 + $breaktimeArray[1];
											$btime = mktime($breaktimehr, $breaktimeArray[1]);
											$breaktime = date('H:i', $btime);

											//get break in time
											$in = date('H:i', strtotime($breakin));
											$breakinArray = array();
											$breakinArray = split(':', $in);
											$hoursTominutes2 = $breakinArray[0]*60;
											$totalbreakin = $hoursTominutes2 + $breakinArray[1];

											//Over break
											if($dateWithDayArray[1] == $restdayArray[0] || $dateWithDayArray[1] == $restdayArray[1]){
												echo '<td>00:00</td>';
												$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
											}else if($row->employee_type == "Fixed" || $row->employee_type == "Shifting"){
												if ($totalbreaktime < $totalbreakin){
													if($totalbreakin == ""){
														$totalbreakin = $totalbreaktime;
													}
													$overbreak = date('H:i', strtotime($breakin) - strtotime($breaktime) - strtotime('03:00'));
													$totalOverbreak = $totalbreakin - $totalbreaktime;


													if($totalOverbreak == "00"){
														echo '<td>00:00</td>';
														$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
													}else{
														echo '<td>'.$overbreak.'</td>';
														$mysqli->query("UPDATE attendance SET attendance_overbreak='$totalOverbreak' WHERE attendance_id='$attendance_id'");
													}
												}else{
													echo '<td>00:00</td>';
													$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
												}
											}else{//FLEXI
												echo '<td>00:00</td>';
												$mysqli->query("UPDATE attendance SET attendance_overbreak='$s_zero' WHERE attendance_id='$attendance_id'");
											}

											//REG OT
											if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = $employee_id AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
												if($OT->num_rows > 0){
													if($OT->num_rows == 1){
														while($OTResult = $OT->fetch_object()){
															$start = $OTResult->overtime_start;
															$end = $OTResult->overtime_end;

															if($start < $ndStart && $end <= $ndEnd || $start < $ndStart && $end > $ndEnd || $start > $ndStart && $end <= $ndEnd || $start < $ndStart && $end <= $ndEnd || $start >= $ndStart && $end > $ndEnd){
																if($start < $ndStart && $end <= $ndEnd){
																	$duration = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00:00'));
																}else if($start < $ndStart && $end > $ndStart){
																	$end = $ndStart;
																	$duration = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00:00'));
																}else if($start < $ndStart && $end > $ndEnd){
																	$duration = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00:00'));
																}else if($start > $ndStart && $end <= $ndEnd){
																	$duration = "00:00";
																}else if($start >= $ndStart && $end > $ndEnd){
																	$start = $ndEnd;
																}
																$durationArray = array();
																$durationArray = split(':', $duration);
																$durationMin = $durationArray[1]/60;
																$durationDec = sprintf('%.2f', $durationArray[0] + $durationMin);

																echo '<td>'.$durationDec.'</td>';
																$mysqli->query("UPDATE attendance SET attendance_overtime='$durationDec' WHERE attendance_id='$attendance_id'");
															}else{
																echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET attendance_overtime='$zero' WHERE attendance_id='$attendance_id'");
															}																
														}
													}else if($OT->num_rows > 1){
														$x = 0;
														while($OTResult = $OT->fetch_object()){
															$start = $OTResult->overtime_start;
															$end = $OTResult->overtime_end;

															if($start < $ndStart && $end <= $ndEnd || $start < $ndStart && $end > $ndEnd || $start > $ndStart && $end <= $ndEnd || $start < $ndStart && $end <= $ndEnd || $start >= $ndStart && $end > $ndEnd){
																if($start < $ndStart && $end <= $ndEnd){
																	$duration = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00:00'));
																}else if($start < $ndStart && $end > $ndStart){
																	$end = $ndStart;
																	$duration = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00:00'));
																}else if($start < $ndStart && $end > $ndEnd){
																	$duration = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00:00'));
																}else if($start > $ndStart && $end <= $ndEnd){
																	$duration = "00:00";
																}else if($start >= $ndStart && $end > $ndEnd){
																	$start = $ndEnd;
																}
																$durationArray = array();
																$durationArray = split(':', $duration);
																$durationMin = $durationArray[1]/60;
																$durationDec = sprintf('%.2f', $durationArray[0] + $durationMin);

																$x = sprintf('%.2f', $x + $durationDec);
															}else{
																$x == "0.00";
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET attendance_overtime='$zero' WHERE attendance_id='$attendance_id'");
															}
														}

														echo '<td>'.$x.'</td>';
														$mysqli->query("UPDATE attendance SET attendance_overtime='$x' WHERattendance_id='$attendance_id'");
													}
													
												}else{
													echo '<td>0.00</td>';
													$mysqli->query("UPDATE attendance SET attendance_overtime='$zero' WHERE attendance_id='$attendance_id'");
												}
											}
											
											$timein = $row->attendance_timein;
											$timeout = $row->attendance_timeout;
											$breakin = $row->attendance_breakin;
											$breakout = $row->attendance_breakout;

											//REG ND
											if($breakout == "" || $breakin == "" || $timeout == ""){
												//echo '<td>0.00</td>';
												$mysqli->query("UPDATE attendance SET attendance_nightdiff='$zero' WHERE attendance_id='$attendance_id'");
											}else{
												if ($timein < $ndStart && $breakout <= $ndStart ||
													$timein < $ndStart && $breakout > $ndStart ||
													$timein < $ndStart && $breakout <= $ndEnd ||
													$timein <= $ndStart && $breakout > $ndEnd ||
													$timein >= $ndStart && $breakout <= $ndEnd ||
													$timein >= $ndStart && $breakout > $ndStart){

													if($timein < $ndStart && $breakout <= $ndStart){
														$nd1 = "00:00";
													}else if($timein < $ndStart && $breakout >= $ndStart){
														$timein = $ndStart;
														$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
													}else if($timein < $ndStart && $breakout <= $ndEnd){
														$timein = $ndStart;
														$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
													}else if($timein < $ndStart && $breakout > $ndEnd){
														$nd1 = "00:00";
													}else if($timein >= $ndStart && $breakout <= $ndEnd){
														$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
													}else if($timein >= $ndStart && $breakout > $ndStart){
														$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("03:00"));
													}

													$ndArray = array();
													$ndArray = split(':', $nd1);
													$ndArrayMin = $ndArray[1]/60;
													$ndArrayDec = sprintf('%.2f', $ndArray[0] + $ndArrayMin);
												}

												if ($breakin < $ndStart && $timeout < $ndStart ||
													$breakin < $ndStart && $timeout >= $ndStart ||
													$breakin < $ndStart && $timeout <= $ndEnd ||
													$breakin > $ndStart && $timeout > $ndStart ||
													$breakin > $ndStart && $timeout <= $ndEnd ||
													$breakin < $ndEnd && $timeout <= $ndEnd ||
													$breakin < $ndEnd && $timeout > $ndEnd ||
													$breakin >= $ndEnd && $timeout > $ndEnd){

													if($breakin < $ndStart && $timeout >= $ndStart){
														$breakin = $ndStart;
														$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

														$ndArray2 = array();
														$ndArray2 = split(':', $nd2);
														$ndArray2Min = $ndArray2[1]/60;
														$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
													}else if($breakin < $ndStart && $timeout <= $ndEnd && $breakin >$ndEnd){
														$nd2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
														$nd2a = date('H:i', strtotime($ndEnd) - strtotime($nd2) - strtotime('03:00'));

														$ndArray2 = array();
														$ndArray2 = split(':', $nd2a);
														$ndArray2Min = sprintf('%.2f', ($ndArray2[1]/60)+2.0);
														$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
													}else if($breakin > $ndStart && $timeout > $ndStart){
														$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

														$ndArray2 = array();
														$ndArray2 = split(':', $nd2);
														$ndArray2Min = $ndArray2[1]/60;
														$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
													}else if($breakin > $ndStart && $timeout <= $ndEnd){
														$nd2a = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
														$nd2aArray = array();
														$nd2aArray = split(':', $nd2a);
														$nd2aArrayMin = $nd2aArray[1]/60;
														$nd2aArrayDec = sprintf('%.2f', $nd2aArray[0] + $nd2aArrayMin);

														$nd2b = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
														$nd2c = date('H:i', strtotime($ndEnd) - strtotime($nd2b) - strtotime('03:00'));
														$nd2cArray = array();
														$nd2cArray = split(':', $nd2c);
														$nd2cArrayMin = $nd2aArray[1]/60;
														$nd2cArrayDec = sprintf('%.2f', $nd2cArray[0] + $nd2cArrayMin);

														$nd2 = sprintf('%.2f', $nd2aArrayDec + $nd2cArrayDec);

														$ndArray2 = array();
														$ndArray2 = split(':', $nd2);
														$ndArray2Min = $ndArray2[1]/60;
														$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
													}else if($breakin < $ndEnd && $timeout <= $ndEnd){
														$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

														$ndArray2 = array();
														$ndArray2 = split(':', $nd2);
														$ndArray2Min = $ndArray2[1]/60;
														$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
													}else if($breakin < $ndEnd && $timeout > $ndEnd){
														$timeout = $ndEnd;
														$nd2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

														$ndArray2 = array();
														$ndArray2 = split(':', $nd2);
														$ndArray2Min = $ndArray2[1]/60;
														$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
													}else if($breakin < $ndStart && $timeout < $ndStart){
														$nd2 = "00:00";

														$ndArray2 = array();
														$ndArray2 = split(':', $nd2);
														$ndArray2Min = $ndArray2[1]/60;
														$ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
													}

													// $ndArray2 = array();
													// $ndArray2 = split(':', $nd2);
													// $ndArray2Min = $ndArray2[1]/60;
													// $ndArray2Dec = sprintf('%.2f', $ndArray2[0] + $ndArray2Min);
												}
													if($dateWithDayArray[1] == $restdayArray[0] || $dateWithDayArray[1] == $restdayArray[1]){
														$ndTotal = sprintf('%.2f', $ndArrayDec + $ndArray2Dec);
														//echo '<td>'.$ndTotal.'</td>';
														$mysqli->query("UPDATE attendance SET attendance_nightdiff='$ndTotal' WHERE attendance_id='$attendance_id'");
													}else{
														//echo '<td>0.00</td>';
														$mysqli->query("UPDATE attendance SET attendance_nightdiff='$zero' WHERE attendance_id='$attendance_id'");
													}
													
											}

											//REG OT ND
											if($OT = $mysqli->query("SELECT * FROM overtime WHERE employee_id = $employee_id AND overtime_date = '$attendance_date' AND overtime_status = 'Approved'")){
												if($OT->num_rows > 0){
													while($OTResult = $OT->fetch_object()){
														$start = $OTResult->overtime_start;
														$end = $OTResult->overtime_end;

														if($end == ""){
															//echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET REG_OT_ND='$zero' WHERE attendance_id='$attendance_id'");
														}else{
															if($start < $ndStart && $start > $ndEnd && $end < $ndStart && $end > $ndEnd ||
																$start < $ndStart && $end < $ndEnd ||
																$start < $ndStart && $end < $ndStart ||
																$start > $ndStart && $end < $ndEnd ||
																$start > $ndStart && $end > $ndStart ||
																$start < $ndStart && $end > $ndStart){

																if($start < $ndStart && $start > $ndEnd && $end < $ndStart && $end > $ndEnd){
																	//echo '<td>0.00</td>'; 
																	$mysqli->query("UPDATE attendance SET REG_OT_ND='$zero' WHERE attendance_id='$attendance_id'");
																}else if($start < $ndStart && $end < $ndEnd){
																	$start = $ndStart;
																	$startcomp = date('H:i', strtotime('24:00') - strtotime($start) - strtotime('03:00'));
																	$endcomp1 = date('H:i', strtotime('06:00') - strtotime($end) - strtotime('03:00'));
																	$endcomp2 = date('H:i', strtotime('06:00') - strtotime($endcomp1) - strtotime('03:00'));

																	$startArray = array();
																	$startArray = split(':', $startcomp);

																	$endArray = array();
																	$endArray = split(':', $endcomp2);

																	$startend1 = $startArray[0] + $endArray[0];
																	$startend2 = $startArray[1] + $endArray[1];

																	if($startend2 >= "60"){
																		$divide = (int)($startend2/60);
																		$modulo = $startend2%60;

																		if($modulo == "0"){
																			$modulo = "00";
																		}

																		$startend1 = $startend1 + $divide;
																		$startend2 = $modulo;
																	}

																	$startendcomp = $startend1.':'.$startend2;

																	$startendArray = array();
																	$startendArray = split(':', $startendcomp);
																	$startendArrayMin = sprintf('%.2f', $startendArray[1]/60);
																	$startendArrayDec = sprintf('$.2f', $startendArray[0] + $startendArrayMin);
																	//echo '<td>'.$startendArrayDec.'</td>';
																	$mysqli->query("UPDATE attendance SET REG_OT_ND='$startendArrayDec' WHERE attendance_id='$attendance_id'");
																}else if($start < $ndStart && $end < $ndStart){
																	//echo '<td>0.00</td>';
																	$mysqli->query("UPDATE attendance SET REG_OT_ND='$zero' WHERE attendance_id='$attendance_id'");
																}else if($start > $ndStart && $end < $ndEnd){
																	$startcomp = date('H:i', strtotime('24:00') - strtotime($start) - strtotime('03:00'));
																	$endcomp1 = date('H:i', strtotime('06:00') - strtotime($end) - strtotime('03:00'));
																	$endcomp2 = date('H:i', strtotime('06:00') - strtotime($endcomp1) - strtotime('03:00'));

																	$startArray = array();
																	$startArray = split(':', $startcomp);

																	$endArray = array();
																	$endArray = split(':', $endcomp2);

																	$startend1 = $startArray[0] + $endArray[0];
																	$startend2 = $startArray[1] + $endArray[1];

																	if($startend2 >= "60"){
																		$divide = (int)($startend2/60);
																		$modulo = $startend2%60;

																		if($modulo == "0"){
																			$modulo = "00";
																		}

																		$startend1 = $startend1 + $divide;
																		$startend2 = $modulo;
																	}

																	$startendcomp = $startend1.':'.$startend2;

																	$startendArray = array();
																	$startendArray = split(':', $startendcomp);
																	$startendArrayMin = sprintf('%.2f', $startendArray[1]/60);
																	$startendArrayDec = sprintf('$.2f', $startendArray[0] + $startendArrayMin);
																	//echo '<td>'.$startendArrayDec.'</td>';
																	$mysqli->query("UPDATE attendance SET REG_OT_ND='$startendArrayDec' WHERE attendance_id='$attendance_id'");
																}else if($start > $ndStart && $end > $ndStart){
																	$startend3 = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00'));
																	//echo '<td>'.$startend3.'</td>';
																	$mysqli->query("UPDATE attendance SET REG_OT_ND='$startend3' WHERE attendance_id='$attendance_id'");
																}else if($start < $ndStart && $end > $ndStart){
																	$start = $ndStart;
																	$startend4 = date('H:i', strtotime($end) - strtotime($start) - strtotime('03:00'));
																	$startend4Array = array();
																	$startend4Array = split(':', $startend4);
																	$startend4ArrayMin = $startend4Array[1]/60;
																	$startend4ArrayDec = sprintf('%.2f', $startend4Array[0] + $startend4ArrayMin);
																	//echo '<td>'.$startend4ArrayDec.'</td>';
																	$mysqli->query("UPDATE attendance SET REG_OT_ND='$startend4ArrayDec' WHERE attendance_id='$attendance_id'");
																}
															}else{
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET REG_OT_ND='$zero' WHERE attendance_id='$attendance_id'");
															}
														}
													}
												}else{
												// echo '<td>0.00</td>';
												$mysqli->query("UPDATE attendance SET REG_OT_ND='$zero' WHERE attendance_id='$attendance_id'");
												}
											}else{
												// echo '<td>0.00</td>';
												$mysqli->query("UPDATE attendance SET REG_OT_ND='$zero' WHERE attendance_id='$attendance_id'");
											}

											$timein = $row->attendance_timein;
											$breakin = $row->attendance_breakin;
											//RST OT / RST OT >8 / RST ND
											if($dateWithDayArray[1] == $restdayArray[0] || $dateWithDayArray[1] == $restdayArray[1]){
												//Timein and Breakout
												$timeinBreakout = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
												$timeinBreakoutArray = array();
												$timeinBreakoutArray = split(':', $timeinBreakout);

												//Breakin and Timeout
												$breakinTimeout = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
												$breakinTimeoutArray = array();
												$breakinTimeoutArray = split(':', $breakinTimeout);

												$tbbt1 = $timeinBreakoutArray[0] + $breakinTimeoutArray[0];
												$tbbt2 = ($timeinBreakoutArray[1] + $breakinTimeoutArray[1])/60;
												$tbbtTotal = sprintf('%.2f', $tbbt1 + $tbbt2);

												$regHrs = '8.00';

												$hol = $mysqli->query("SELECT COUNT(*) AS check_holiday FROM holiday WHERE holiday_date = $attendance_date");
												$fetchHoliday = $hol->fetch_object();
												$checkHoliday = $fetchHoliday->check_holiday;

												if($fetchHoliday->check_holiday > 0){
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													$mysqli->query("UPDATE attendance SET RST_OT='$zero',RST_OT_GRT8='$zero',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
												}else if ($timein < $ndStart && $timeout <= $ndStart ||
													$timein < $ndStart && $timeout > $ndStart ||
													$timein < $ndStart && $timeout <= $ndEnd ||
													$timein >= $ndStart && $timeout < $ndEnd ||
													$timein >= $ndStart && $timeout > $ndStart){
													if($timein < $ndStart && $timeout <= $ndStart && $timeout > $ndEnd && $timein >= $ndEnd){
														if($tbbtTotal <= $regHrs){
															// echo '<td>'.$tbbtTotal.'</td>';
															// echo '<td>0.00</td>';
															// echo '<td>0.00</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$tbbtTotal',RST_OT_GRT8='$zero',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}else if($tbbtTotal > $regHrs){
															$tbbtTotalgrt8 = sprintf('%.2f', $tbbtTotal - $regHrs);
															// echo '<td>'.$regHrs.'</td>';
															// echo '<td>'.$tbbtTotalgrt8.'</td>';
															// echo '<td>0.00</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$regHrs',RST_OT_GRT8='$tbbtTotalgrt8',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}
													}else if($timein < $ndStart && $timeout > $ndStart){
														if($timein < $ndStart && $breakout <= $ndStart){
															$timeinBreakoutNd = '00:00';
															$t1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
															$t1Array = array();
															$t1Array = split(':', $t1);
															$t1ArrayMin = $t1Array[1]/60;
															$notNDtb = sprintf('%.2f', $t1Array[0] + $t1ArrayMin);

														}else if($timein < $ndStart && $breakout > $ndStart){
															$timein = $ndStart;
															$timeinBreakoutNd = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
															$timein = $row->attendance_timein;
															$t1 = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
															$t1Array = array();
															$t1Array = split(':', $t1);
															$t1ArrayMin = $t1Array[1]/60;
															$notNDtb = sprintf('%.2f', $t1Array[0] + $t1ArrayMin);
														}

														if($breakin < $ndStart && $timeout >= $ndStart){
															$breakin = $ndStart;
															$breakinTimeoutNd = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

															$breakin = $row->attendance_breakin;
															$t4 = date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
															$t4Array = array();
															$t4Array = split(':', $t4);
															$t4ArrayMin = $t4Array[1]/60;
															$notNDbt = sprintf('%.2f', $t4Array[0] + $t4ArrayMin);

														}else if($breakin >= $ndStart && $timeout > $ndStart){
															$breakinTimeoutNd = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));

															$notNDbt = '0.00';
														}

														$timeinBreakoutNdArray = array();
														$timeinBreakoutNdArray = split(':', $timeinBreakoutNd);
														$timeinBreakoutNdArrayMin = $timeinBreakoutNdArray[1]/60;
														$timeinBreakoutNdArrayDec = sprintf('%.2f', $timeinBreakoutNdArray[0] + $timeinBreakoutNdArrayMin);

														$breakinTimeoutNdArray = array();
														$breakinTimeoutNdArray = split(':', $breakinTimeoutNd);
														$breakinTimeoutNdArrayMin = $breakinTimeoutNdArray[1]/60;
														$breakinTimeoutNdArrayDec = sprintf('%.2f', $breakinTimeoutNdArray[0] + $breakinTimeoutNdArrayMin);

														$tbbtNdTotal = sprintf('%.2f', $timeinBreakoutNdArrayDec + $breakinTimeoutNdArrayDec);

														//RST OT
														$notNDtbbtTotal = sprintf('%.2f', $notNDtb + $notNDbt);

														$NDandnotNDTotal = $tbbtNdTotal + $notNDtbbtTotal;

														if($notNDtbbtTotal <= '8.00'){
															if($notNDtbbtTotal){

															}
															// echo '<td>'.$notNDtbbtTotal.'</td>';
															// echo '<td>0.00</td>';
															// echo '<td>0.00</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$notNDtbbtTotal',RST_OT_GRT8='$zero',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}else if($notNDtbbtTotal > '8.00'){
															$notNDtbbtTotalgrt8 = sprintf('%.2f', $notNDtbbtTotal - 8.00);
															// echo '<td>8.00</td>';
															// echo '<td>'.$notNDtbbtTotalgrt8.'</td>';
															// echo '<td>0.00</td>';
															// echo '<td>'.$tbbtNdTotal.'</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$zero',RST_OT_GRT8='$notNDtbbtTotalgrt8',RST_ND='$zero',RST_ND_GRT8='$tbbtNdTotal' WHERE attendance_id='$attendance_id'");
														}else if($NDandnotNDTotal <= '8.00'){
															// echo '<td>'.$notNDtbbtTotal.'</td>';
															// echo '<td>0.00</td>';
															// echo '<td>0.00</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$notNDtbbtTotal',RST_OT_GRT8='$zero',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}else if($NDandnotNDTotal > '8.00'){
															if($notNDtbbtTotal <= '8.00'){
																// echo '<td>'.$notNDtbbtTotal.'</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET RST_OT='$notNDtbbtTotal',RST_OT_GRT8='$zero',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
															}else if($notNDtbbtTotal > '8.00'){
																$notNDtbbtTotalgrt8ver2 = $NDandnotNDTotal - 8.00;
																// echo '<td>8.00</td>';
																// echo '<td>'.$notNDtbbtTotalgrt8ver2.'</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET RST_OT='8.00',RST_OT_GRT8='$notNDtbbtTotalgrt8ver2',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
															}
														}else {
															// echo '<td>'.$notNDtbbtTotal.'</td>';
															// echo '<td>0.00</td>';
															// echo '<td>'.$tbbtNdTotal.'</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$notNDtbbtTotal',RST_OT_GRT8='$zero',RST_ND='$tbbtNdTotal',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");

														}
														

													}else if($timein < $ndStart && $timeout <= $ndEnd  && $timein >= $ndEnd){
														if($timein < $ndStart && $breakout <= $ndStart){
															$tb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
															$tbArray = array();
															$tbArray = split(':', $tb);
															$tbArrayMin = $tbArray[1]/60;
															$RSTOT = sprintf('%.2f', $tbArray[0] + $tbArrayMin);//RST OT

															$RSTOTND = '0.00';//RST OT ND
														}else if($timein < $ndStart && $breakout > $ndStart){
															$t = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
															$tArray = array();
															$tArray = split(':', $t);
															$tArrayMin = $tArray[1]/60;
															$RSTOT = sprintf('%.2f', $tArray[0] + $tArrayMin);//RST OT

															$b = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
															$bArray = array();
															$bArray = split(':', $b);
															$bArrayMin = $bArray[1]/60;
															$RSTOTND = sprintf('%.2f', $bArray[0] + $bArrayDec);//RST OT ND
														}else if($timein < $ndStart && $breakout <= $ndEnd){
															$t = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
															$tArray = array();
															$tArray = split(':', $t);
															$tArrayMin = $tArray[1]/60;
															$RSTOT = sprintf('%.2f', $tArray[0] + $tArrayMin);//RST OT

															$b = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
															$b2 = date('H:i', strtotime($ndEnd) - strtotime($b) - strtotime('03:00'));
															$b2Array = array();
															$b2Array = split(':', $b2);
															$b2ArrayMin = $b2Array[1]/60;
															$RSTOTND = sprintf('%.2f', $b2Array[0] + $b2ArrayMin + 2.00);//RST IT ND
														}

														if($breakin < $ndStart && $timeout <= $ndStart && $breakin >= $ndEnd && $timeout > $ndEnd){
															$bt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
															$btArray = array();
															$btArray = split(':', $bt);
															$btArrayMin = $btArray[1]/60;
															$RSTOT2 = sprintf('%.2f', $btArray[0] + $btArrayMin);//RST OT

															$RSTOTND2 = '0.00';//RST OT ND
														}else if($breakin <= $ndStart && $timeout > $ndStart && $breakin >= $ndEnd){
															$b3 = date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
															$b3Array = array();
															$b3Array = split(':', $b3);
															$b3ArrayMin = $b3Array[1]/60;
															$RSTOT2 = sprintf('%.2f', $b3Array[0] + $b3ArrayMin);//RST OT

															$t2 = date('H:i', strtotime($timeout) - strtotime($ndStart) - strtotime('03:00'));
															$t2Array = array();
															$t2Array = split(':', $t2);
															$t2ArrayMin = $t2Array[1]/60;
															$RSTOTND2 = sprintf('%.2f', $t2Array[0] + $t2ArrayMin);//RST OT ND
														}else if($breakin <= $ndStart && $timeout <= $ndEnd && $breakin >= $ndEnd){
															$b3 = date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
															$b3Array = array();
															$b3Array = split(':', $b3);
															$b3ArrayMin = $b3Array[1]/60;
															$RSTOT2 = sprintf('%.2f', $b3Array[0] + $b3ArrayMin);//RST OT

															$t2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
															$t3 = date('H:i', strtotime($ndEnd) - strtotime($t2) - strtotime('03:00'));
															$t3Array = array();
															$t3Array = split(':', $t3);
															$t3ArrayMin = $t3Array[1]/60;
															$RSTOTND2 = sprintf('%.2f', $t3Array[0] + $t3ArrayMin + 2.00);//RST OT ND
														}else if($breakin >= $ndStart && $timeout > $ndStart){
															$RSTOT2 = '0.00';//RST OT

															$b3 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
															$b3Array = array();
															$b3Array = split(':', $b3);
															$b3ArrayMin = $b3Array[1]/60;
															$RSTOTND2 = sprintf('%.2f', $b3Array[0] + $b3ArrayMin);//RST OT ND
														}else if($breakin >= $ndStart && $timeout <= $ndEnd){
															$RSTOT2 = '0.00';

															$b3 = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
															$b3Array = array();
															$b3Array = split(':', $b3);
															$b3ArrayMin = $b3Array[1]/60;
															$b3ArrayDec = sprintf('%.2f', $b3Array[0] + $b3ArrayMin);//RST OT ND

															$t2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
															$t3 = date('H:i', strtotime($ndEnd) - strtotime($t2) - strtotime('03:00'));
															$t3Array = array();
															$t3Array = split(':', $t3);
															$t3ArrayMin = $t3Array[1]/60;
															$t3ArrayDec = sprintf('%.2f', $t3Array[0] + $t3ArrayMin + 2.00);//RST OT ND 

															$RSTOTND2 = $b3ArrayDec + $t3ArrayDec;
														}else if($breakin < $ndEnd && $timeout <= $ndEnd){
															$RSTOT2 = '0.00';//RST OT

															$b3 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
															$b3Array = array();
															$b3Array = split(':', $b3);
															$b3ArrayMin = $b3Array[1]/60;
															$RSTOTND2 = sprintf('%.2f', $b3Array[0] + $b3ArrayMin);//RST OT ND
														}

														$RSTOTTotal = sprintf('%.2f', $RSTOT + $RSTOT2);
														$RSTOTNDTotal = sprintf('%.2f', $RSTOTND + $RSTOTND2);

														if($RSTOTTotal <= '8.00'){
															// echo '<td>'.$RSTOTTotal.'</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$RSTOTTotal',RST_OT_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}else if ($RSTOTTotal > '8.00'){
															$RSTOTTotalgrt8 = sprintf('%.2f', $RSTOTTotal - 8.00);
															// echo '<td>8.00</td>';
															// echo '<td>'.$RSTOTTotalgrt8.'</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='8.00',RST_OT_GRT8='$RSTOTTotalgrt8' WHERE attendance_id='$attendance_id'");
														}

														$RSTOTandRSTOTNDTotal = $RSTOTNDTotal + $RSTOTTotal;

														if($RSTOTTotal > '8.00'){
															// echo '<td>0.00</td>';
															// echo '<td>'.$RSTOTNDTotal.'</td>';
															$mysqli->query("UPDATE attendance SET RST_ND='$zero',RST_ND_GRT8='$RSTOTNDTotal' WHERE attendance_id='$attendance_id'");
														}else if($RSTOTandRSTOTNDTotal <= '8.00'){
															// echo '<td>'.$RSTOTNDTotal.'</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_ND='$RSTOTNDTotal',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}else if($RSTOTandRSTOTNDTotal > '8.00'){
															if($RSTOTTotal < '8.00'){
																$RSTOTTotalLess8 = sprintf('%.2f', 8.00 - $RSTOTTotal);
																//echo '<td>'.$RSTOTTotalLess8.'</td>';
																$RSTOTandRSTOTNDgrt8 = sprintf('%.2f', $RSTOTNDTotal - $RSTOTTotalLess8);
																//echo '<td>'.$RSTOTandRSTOTNDgrt8.'</td>';
																$mysqli->query("UPDATE attendance SET RST_ND='$RSTOTTotalLess8',RST_ND_GRT8='$$RSTOTandRSTOTNDgrt8' WHERE attendance_id='$attendance_id'");
															}else{
																// echo '<td>0.00</td>';
																// echo '<td>'.$RSTOTNDTotal.'</td>';
																$mysqli->query("UPDATE attendance SET RST_ND='$zero',RST_ND_GRT8='$RSTOTNDTotal' WHERE attendance_id='$attendance_id'");
															}															
														}
													}else if($timein >= $ndStart && $timeout <= $ndEnd){
														// echo '<td>0.00</td>';
														// echo '<td>0.00</td>';

														$RSTOTND1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
														$RSTOTND1Array = array();
														$RSTOTND1Array = split(':', $RSTOTND1);
														$RSTOTND1ArrayMin = sprintf('%.2f', $RSTOTND1Array[1]/60);
														$RSTOTND1ArrayDec = sprintf('%.2f', $RSTOTND1Array[0] + $RSTOTND1ArrayMin);

														$RSTOTND2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
														$RSTOTND2Array = array();
														$RSTOTND2Array = split(':', $RSTOTND2);
														$RSTOTND2ArrayMin = sprintf('%.2f', $RSTOTND2Array[1]/60);
														$RSTOTND2ArrayDec = sprintf('%.2f', $RSTOTND2Array[0] + $RSTOTND2ArrayMin);

														$RSTOTND12Total = sprintf('%.2f', $RSTOTND1ArrayDec + $RSTOTND2ArrayDec);
														if($RSTOTND12Total <= 8.00){
															// echo '<td>'.$RSTOTND12Total.'</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$zero',RST_OT_GRT8='$zero',RST_ND='$RSTOTND12Total',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}else if($RSTOTND12Total > 8.00){
															$RSTOTND12Totalgrt8 = $RSTOTND12Total - 8.00;

															// echo '<td>8.00</td>';
															// echo '<td>'.$RSTOTND12Totalgrt8.'</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$zero',RST_OT_GRT8='$zero',RST_ND='8.00',RST_ND_GRT8='$RSTOTND12Totalgrt8' WHERE attendance_id='$attendance_id'");
														}
													}else if($timein >= $ndStart && $timeout > $ndStart){
														// echo '<td>0.00</td>';
														// echo '<td>0.00</td>';

														$RSTOTND1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
														$RSTOTND1Array = array();
														$RSTOTND1Array = split(':', $RSTOTND1);
														$RSTOTND1ArrayMin = sprintf('%.2f', $RSTOTND1Array[1]/60);
														$RSTOTND1ArrayDec = sprintf('%.2f', $RSTOTND1Array[0] + $RSTOTND1ArrayMin);

														$RSTOTND2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
														$RSTOTND2Array = array();
														$RSTOTND2Array = split(':', $RSTOTND2);
														$RSTOTND2ArrayMin = sprintf('%.2f', $RSTOTND2Array[1]/60);
														$RSTOTND2ArrayDec = sprintf('%.2f', $RSTOTND2Array[0] + $RSTOTND2ArrayMin);

														$RSTOTND12Total = sprintf('%.2f', $RSTOTND1ArrayDec + $RSTOTND2ArrayDec);

														if($RSTOTND12Total <= 8.00){
															// echo '<td>'.$RSTOTND12Total.'</td>';
															// echo '<td>0.00</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$zero',RST_OT_GRT8='$zero',RST_ND='$RSTOTND12Total',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
														}else if($RSTOTND12Total > 8.00){
															$RSTOTND12Totalgrt8 = $RSTOTND12Total - 8.00;

															// echo '<td>8.00</td>';
															// echo '<td>'.$RSTOTND12Totalgrt8.'</td>';
															$mysqli->query("UPDATE attendance SET RST_OT='$zero',RST_OT_GRT8='$zero',RST_ND='8.00',RST_ND_GRT8='$RSTOTND12Totalgrt8' WHERE attendance_id='$attendance_id'");
														}
													}
												}
											}else{
												// echo '<td>0.00</td>';
												// echo '<td>0.00</td>';
												// echo '<td>0.00</td>';
												// echo '<td>0.00</td>';
												$mysqli->query("UPDATE attendance SET RST_OT='$zero',RST_OT_GRT8='$zero',RST_ND='$zero',RST_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
											}

											//LH OT / LH OT >8 / LH OT ND / LH OT ND >8
											if($regularHoliday = $mysqli->query("SELECT * FROM holiday WHERE holiday_type='Regular' AND holiday_date='$attendance_date'")){
												if($regularHoliday->num_rows > 0){
													while($reghol = $regularHoliday->fetch_object()){
														$regHoliday_date = $reghol->holiday_date;
														$regHolidayDateDay = date('Y-m-d:l', strtotime($regHoliday_date));
														$regHolidayArray = array();
														$regHolidayArray = split(':', $regHolidayDateDay);

														if(date("Y-m-d", strtotime($attendance_date)) == date("Y-m-d", strtotime($regHoliday_date))){
															if ($timein < $ndStart && $timeout <= $ndStart ||
																$timein < $ndStart && $timeout > $ndStart ||
																$timein < $ndStart && $timeout <= $ndEnd ||
																$timein >= $ndStart && $timeout < $ndEnd ||
																$timein >= $ndStart && $timeout > $ndStart){

																if($timein < $ndStart && $timeout <= $ndStart && $timein >= $ndEnd && $timeout > $ndEnd){
																	$THOT1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$THOT1Array = array();
																	$THOT1Array = split(':', $THOT1);
																	$THOT1ArrayMin = sprintf('%.2f', $THOT1Array[1]/60);
																	$THOT1ArrayDec = sprintf('%.2f', $THOT1Array[0] + $THOT1ArrayMin);

																	$THOT2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$THOT2Array = array();
																	$THOT2Array = split(':', $THOT2);
																	$THOT2ArrayMin = sprintf('%.2f', $THOT2Array[1]/60);
																	$THOT2ArrayDec = sprintf('%.2f', $THOT2Array[0] + $THOT2ArrayMin);

																	$THOTTotal = sprintf('%.2f', $THOT1ArrayDec + $THOT2ArrayDec);

																	if($THOTTotal <= 8.00){
																		// echo '<td>'.$THOTTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$THOTTotal',LH_OT_GRT8='$zero',LH_ND='$zero',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($THOTTotal > 8.00){
																		$THOTTotalgrt8 = sprintf('%.2f', $THOTTotal - 8.00);

																		// echo '<td>8.00</td>';
																		// echo '<td>'.$THOTTotalgrt8.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$$THOTTotalgrt8',LH_ND='$zero',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}
																}else if($timein < $ndStart && $timeout > $ndStart && $timein > $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart){
																		$RSTOTtbND = "0.00";//LH ND

																		$RSTOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('02:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart){
																		$tbND = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$tbNDArray = array();
																		$tbNDArray = split(':', $tbND);
																		$tbNDArrayMin = sprintf('%.2f', $tbNDArray[1]/60);
																		$RSTOTtbND = sprintf('%.2f', $tbNDArray[0] + $tbNDArrayMin); //LH ND

																		$RSTOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($ndStart) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbt =date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$RSTOTbtArray = array();
																		$RSTOTbtArray = split(':', $RSTOTbt);
																		$RSTOTbtArrayMin = sprintf('%.2f', $RSTOTbtArray[1]/60);
																		$RSTOTbtArrayDec = sprintf('%.2f', $RSTOTbtArray[0] + $RSTOTbtArrayMin); //LH OT
																	}else if($breakin >= $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbtArrayDec = "0.00"; //LH OT
																	}

																	$RSTOTtbbtTotal = sprintf('%.2f', $RSTOTtbArrayDec + $RSTOTbtArrayDec); //LH OT TOTAL
																	$RSTOTtbbtNDTotal = sprintf('%.2f', $RSTOTtbND + $RSTOTbtND); // LH OT ND TOTAL
																	$RSTOTandNDTotal = sprintf('%.2f', $RSTOTtbbtTotal + $RSTOTtbbtNDTotal);

																	if($RSTOTandNDTotal <= 8.00){
																		// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$RSTOTtbbtTotal',LH_OT_GRT8='$zero',LH_ND='$RSTOTtbbtNDTotal',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($RSTOTandNDTotal > 8.00){
																		if($RSTOTtbbtTotal == 8.00){
																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET LH_OT='$RSTOTtbbtTotal',LH_OT_GRT8='$zero',LH_ND='$zero',LH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal > 8.0){
																			$RSTOTtbbtTotalgrt8 = sprintf('%.2f', $RSTOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$RSTOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$RSTOTtbbtTotalgrt8',LH_ND='$zero',LH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal < 8.00){
																			$RSTOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $RSTOTtbbtTotal);
																			$RSTOTtbbtNDTotalgrt8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtTotalLess8);
																			$RSTOTtbbtNDTotalLess8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtNDTotalgrt8);

																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalLess8.'</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET LH_OT='$RSTOTtbbtTotal',LH_OT_GRT8='$zero',LH_ND='$RSTOTtbbtNDTotalLess8',LH_ND_GRT8='$$RSTOTtbbtNDTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}
																	}
																}else if($timein < $ndStart && $timeout <= $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart && $timein > $ndEnd && $breakout > $ndEnd){
																		$tbND = "0.00"; //LH OT ND

																		$LHOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); // LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout < $ndEnd && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTtb) - strtotime('03:00'));
																		$LHOTNDtb2Array = array();
																		$LHOTNDtb2Array = split(':', $LHOTNDtb2);
																		$LHOTNDtb2ArrayMin = sprintf('%.2f', $LHOTNDtb2Array[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtb2Array[0] + $LHOTNDtb2ArrayMin + 2.00); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout <= $ndEnd && $breakin > $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt) - strtotime('03:00'));
																		$LHOTNDbt2Array = array();
																		$LHOTNDbt2Array = split(':', $LHOTNDbt2);
																		$LHOTNDbt2ArrayMin = sprintf('%.2f', $LHOTNDbt2Array[1]/60);
																		$btND = sprintf('%.2f', $LHOTNDbt2Array[0] + $LHOTNDbt2ArrayMin + 2.00); // LH OT ND

																		$LHOTbt = date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTbtArray = array();
																		$LHOTbtArray = split(':', $LHOTbt);
																		$LHOTbtArrayMin = sprintf('%.2f', $LHOTbtArray[1]/60);
																		$LHOTbtArrayDec = sprintf('%.2f', $LHOTbtArray[0] + $LHOTbtArrayMin); //LH OT
																	}else if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtbArrayDec + $LHOTbtArrayDec); //LH OT TOTAL
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND); //LH OT ND TOTAL
																	$LHOTandNDtbbtTotal = sprintf('%.2f', $LHOTtbbtTotal + $LHOTNDtbbtTotal);

																	if($LHOTandNDtbbtTotal <= 8.00){
																		// echo '<td>'.$LHOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$LHOTtbbtTotal',LH_OT_GRT8='$zero',LH_ND='$LHOTNDtbbtTotal',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTandNDtbbtTotal > 8.00){
																		if($LHOTtbbtTotal == 8.00){
																			// echo '<td>'.$LHOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET LH_OT='$LHOTtbbtTotal',LH_OT_GRT8='$zero',LH_ND='$zero',LH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal > 8.00){
																			$LHOTtbbtTotalgrt8 = sprintf('%.2f', $LHOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$LHOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET LH_OT='8.00',LH_OT_GRT8='$LHOTtbbtTotalgrt8',LH_ND='$zero',LH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal < 8.00){
																			$LHOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $LHOTtbbtTotal);
																			$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTtbbtTotalLess8);
																			$LHOTNDtbbtTotalLess8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTNDtbbtTotalgrt8);
																			// echo '<td>'.$LHOTtbbtTotalLess8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalLess8.'</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET LH_OT='$LHOTtbbtTotalLess8',LH_OT_GRT8='$zero',LH_ND='$LHOTNDtbbtTotalLess8',LH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}

																	}

																}else if($timein >= $ndStart && $timeout <= $ndEnd){
																	if($timein >= $ndStart && $breakout > $ndStart){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}else if($timein >= $ndStart && $breakout <= $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($timein) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDtb2) - strtotime('03:00'));
																		$LHOTNDtb3Array = array();
																		$LHOTNDtb3Array = split(':', $LHOTNDtb3);
																		$LHOTNDtb3ArrayMin = sprintf('%.2f', $LHOTNDtb3Array[1]/60);
																		$LHOTNDtb3ArrayDec = sprintf('%.2f', $LHOTNDtb3Array[0] + $LHOTNDtb3ArrayMin);

																		$tbND = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDtb3ArrayDec); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}

																	if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtb + $LHOTbt);
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$zero',LH_ND='$LHOTNDtbbtTotal',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - 8.00);

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$zero',LH_ND='8.00',LH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																	}

																}else if($timein >= $ndStart && $timeout > $ndStart){
																	$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$LHOTNDtbArray = array();
																	$LHOTNDtbArray = split(':', $LHOTNDtb);
																	$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																	$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																	$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$LHOTNDbtArray = array();
																	$LHOTNDbtArray = split(':', $LHOTNDbt);
																	$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																	$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																	$LHOTNDtbbtTotal = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDbtArrayDec);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$zero',LH_ND='$LHOTNDtbbtTotal',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = $LHOTNDtbbtTotal - 8.00;

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$zero',LH_ND='8.00',LH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																	}
																}
															}else{
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$zero',LH_ND='$zero',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
															}
														}
													}
												}else{
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													$mysqli->query("UPDATE attendance SET LH_OT='$zero',LH_OT_GRT8='$zero',LH_ND='$zero',LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
												}
											}

											//SH OT / SH OT >8 / SH OT ND / SH OT ND >8
											if($regularHoliday = $mysqli->query("SELECT * FROM holiday WHERE holiday_type='Special' AND holiday_date='$attendance_date'")){
												if($regularHoliday->num_rows > 0){
													while($reghol = $regularHoliday->fetch_object()){
														$regHoliday_date = $reghol->holiday_date;
														$regHolidayDateDay = date('Y-m-d:l', strtotime($regHoliday_date));
														$regHolidayArray = array();
														$regHolidayArray = split(':', $regHolidayDateDay);

														if($attendance_date == $regHoliday_date){
															if ($timein < $ndStart && $timeout <= $ndStart ||
																$timein < $ndStart && $timeout > $ndStart ||
																$timein < $ndStart && $timeout <= $ndEnd ||
																$timein >= $ndStart && $timeout < $ndEnd ||
																$timein >= $ndStart && $timeout > $ndStart){

																if($timein < $ndStart && $timeout <= $ndStart && $timein >= $ndEnd && $timeout > $ndEnd){
																	$THOT1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$THOT1Array = array();
																	$THOT1Array = split(':', $THOT1);
																	$THOT1ArrayMin = sprintf('%.2f', $THOT1Array[1]/60);
																	$THOT1ArrayDec = sprintf('%.2f', $THOT1Array[0] + $THOT1ArrayMin);

																	$THOT2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$THOT2Array = array();
																	$THOT2Array = split(':', $THOT2);
																	$THOT2ArrayMin = sprintf('%.2f', $THOT2Array[1]/60);
																	$THOT2ArrayDec = sprintf('%.2f', $THOT2Array[0] + $THOT2ArrayMin);

																	$THOTTotal = sprintf('%.2f', $THOT1ArrayDec + $THOT2ArrayDec);

																	if($THOTTotal <= 8.00){
																		// echo '<td>'.$THOTTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='$THOTTotal',SH_OT_GRT8='$zero',SH_ND='$zero',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($THOTTotal > 8.00){
																		$THOTTotalgrt8 = sprintf('%.2f', $THOTTotal - 8.00);

																		// echo '<td>8.00</td>';
																		// echo '<td>'.$THOTTotalgrt8.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='8.00',SH_OT_GRT8='$THOTTotalgrt8',SH_ND='$zero',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}
																}else if($timein < $ndStart && $timeout > $ndStart && $timein > $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart){
																		$RSTOTtbND = "0.00";//LH ND

																		$RSTOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('02:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart){
																		$tbND = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$tbNDArray = array();
																		$tbNDArray = split(':', $tbND);
																		$tbNDArrayMin = sprintf('%.2f', $tbNDArray[1]/60);
																		$RSTOTtbND = sprintf('%.2f', $tbNDArray[0] + $tbNDArrayMin); //LH ND

																		$RSTOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($ndStart) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbt =date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$RSTOTbtArray = array();
																		$RSTOTbtArray = split(':', $RSTOTbt);
																		$RSTOTbtArrayMin = sprintf('%.2f', $RSTOTbtArray[1]/60);
																		$RSTOTbtArrayDec = sprintf('%.2f', $RSTOTbtArray[0] + $RSTOTbtArrayMin); //LH OT
																	}else if($breakin >= $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbtArrayDec = "0.00"; //LH OT
																	}

																	$RSTOTtbbtTotal = sprintf('%.2f', $RSTOTtbArrayDec + $RSTOTbtArrayDec); //LH OT TOTAL
																	$RSTOTtbbtNDTotal = sprintf('%.2f', $RSTOTtbND + $RSTOTbtND); // LH OT ND TOTAL
																	$RSTOTandNDTotal = sprintf('%.2f', $RSTOTtbbtTotal + $RSTOTtbbtNDTotal);

																	if($RSTOTandNDTotal <= 8.00){
																		// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='$RSTOTtbbtTotal',SH_OT_GRT8='$zero',SH_ND='$RSTOTtbbtNDTotal',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($RSTOTandNDTotal > 8.00){
																		if($RSTOTtbbtTotal == 8.00){
																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET SH_OT='$RSTOTtbbtTotal',SH_OT_GRT8='$zero',SH_ND='$zero',SH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal > 8.0){
																			$RSTOTtbbtTotalgrt8 = sprintf('%.2f', $RSTOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$RSTOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET SH_OT='8.00',SH_OT_GRT8='$RSTOTtbbtTotalgrt8',SH_ND='$zero',SH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal < 8.00){
																			$RSTOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $RSTOTtbbtTotal);
																			$RSTOTtbbtNDTotalgrt8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtTotalLess8);
																			$RSTOTtbbtNDTotalLess8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtNDTotalgrt8);

																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalLess8.'</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET SH_OT='$RSTOTtbbtTotal',SH_OT_GRT8='$zero',SH_ND='$RSTOTtbbtNDTotalLess8',SH_ND_GRT8='$RSTOTtbbtNDTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}
																	}
																}else if($timein < $ndStart && $timeout <= $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart && $timein > $ndEnd && $breakout > $ndEnd){
																		$tbND = "0.00"; //LH OT ND

																		$LHOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); // LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout < $ndEnd && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTtb) - strtotime('03:00'));
																		$LHOTNDtb2Array = array();
																		$LHOTNDtb2Array = split(':', $LHOTNDtb2);
																		$LHOTNDtb2ArrayMin = sprintf('%.2f', $LHOTNDtb2Array[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtb2Array[0] + $LHOTNDtb2ArrayMin + 2.00); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout <= $ndEnd && $breakin > $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt) - strtotime('03:00'));
																		$LHOTNDbt2Array = array();
																		$LHOTNDbt2Array = split(':', $LHOTNDbt2);
																		$LHOTNDbt2ArrayMin = sprintf('%.2f', $LHOTNDbt2Array[1]/60);
																		$btND = sprintf('%.2f', $LHOTNDbt2Array[0] + $LHOTNDbt2ArrayMin + 2.00); // LH OT ND

																		$LHOTbt = date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTbtArray = array();
																		$LHOTbtArray = split(':', $LHOTbt);
																		$LHOTbtArrayMin = sprintf('%.2f', $LHOTbtArray[1]/60);
																		$LHOTbtArrayDec = sprintf('%.2f', $LHOTbtArray[0] + $LHOTbtArrayMin); //LH OT
																	}else if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtbArrayDec + $LHOTbtArrayDec); //LH OT TOTAL
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND); //LH OT ND TOTAL
																	$LHOTandNDtbbtTotal = sprintf('%.2f', $LHOTtbbtTotal + $LHOTNDtbbtTotal);

																	if($LHOTandNDtbbtTotal <= 8.00){
																		// echo '<td>'.$LHOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='$LHOTtbbtTotal',SH_OT_GRT8='$zero',SH_ND='$$LHOTNDtbbtTotal',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTandNDtbbtTotal > 8.00){
																		if($LHOTtbbtTotal == 8.00){
																			// echo '<td>'.$LHOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET SH_OT='$LHOTtbbtTotal',SH_OT_GRT8='$zero',SH_ND='$zero',SH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal > 8.00){
																			$LHOTtbbtTotalgrt8 = sprintf('%.2f', $LHOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$LHOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET SH_OT='8.00',SH_OT_GRT8='$LHOTtbbtTotalgrt8',SH_ND='$zero',SH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal < 8.00){
																			$LHOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $LHOTtbbtTotal);
																			$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTtbbtTotalLess8);
																			$LHOTNDtbbtTotalLess8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTNDtbbtTotalgrt8);
																			// echo '<td>'.$LHOTtbbtTotalLess8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalLess8.'</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET SH_OT='$LHOTtbbtTotalLess8',SH_OT_GRT8='$zero',SH_ND='$LHOTNDtbbtTotalLess8',SH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}

																	}

																}else if($timein >= $ndStart && $timeout <= $ndEnd){
																	if($timein >= $ndStart && $breakout > $ndStart){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}else if($timein >= $ndStart && $breakout <= $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($timein) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDtb2) - strtotime('03:00'));
																		$LHOTNDtb3Array = array();
																		$LHOTNDtb3Array = split(':', $LHOTNDtb3);
																		$LHOTNDtb3ArrayMin = sprintf('%.2f', $LHOTNDtb3Array[1]/60);
																		$LHOTNDtb3ArrayDec = sprintf('%.2f', $LHOTNDtb3Array[0] + $LHOTNDtb3ArrayMin);

																		$tbND = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDtb3ArrayDec); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}

																	if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtb + $LHOTbt);
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='$zero',SH_OT_GRT8='$zero',SH_ND='$LHOTNDtbbtTotal',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - 8.00);

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='$zero',SH_OT_GRT8='$zero',SH_ND='8.00',SH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																	}

																}else if($timein >= $ndStart && $timeout > $ndStart){
																	$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$LHOTNDtbArray = array();
																	$LHOTNDtbArray = split(':', $LHOTNDtb);
																	$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																	$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																	$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$LHOTNDbtArray = array();
																	$LHOTNDbtArray = split(':', $LHOTNDbt);
																	$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																	$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																	$LHOTNDtbbtTotal = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDbtArrayDec);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='$zero',SH_OT_GRT8='$zero',SH_ND='$LHOTNDtbbtTotal',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = $LHOTNDtbbtTotal - 8.00;

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET SH_OT='$zero',SH_OT_GRT8='$zero',SH_ND='8.00',SH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																	}
																}
															}else{
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET SH_OT='$zero',SH_OT_GRT8='$zero',SH_ND='$zero',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
															}
														}
													}
												}else{
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													$mysqli->query("UPDATE attendance SET SH_OT='$zero',SH_OT_GRT8='$zero',SH_ND='$zero',SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
												}
											}

											//RST LH OT / RST LH OT >8 / RST LH OT ND / RST LH OT ND >8
											if($regularHoliday = $mysqli->query("SELECT * FROM holiday WHERE holiday_type='Regular' AND holiday_date='$attendance_date'")){
												if($regularHoliday->num_rows > 0){
													while($reghol = $regularHoliday->fetch_object()){
														$regHoliday_date = $reghol->holiday_date;
														$regHolidayDateDay = date('Y-m-d:l', strtotime($regHoliday_date));
														$regHolidayArray = array();
														$regHolidayArray = split(':', $regHolidayDateDay);
														if($attendance_date == $regHoliday_date && $regHolidayArray[1] == $restdayArray[0] || $attendance_date == $regHoliday_date && $regHolidayArray[1] == $restdayArray[1]){
															if ($timein < $ndStart && $timeout <= $ndStart ||
																$timein < $ndStart && $timeout > $ndStart ||
																$timein < $ndStart && $timeout <= $ndEnd ||
																$timein >= $ndStart && $timeout < $ndEnd ||
																$timein >= $ndStart && $timeout > $ndStart){

																if($timein < $ndStart && $timeout <= $ndStart && $timein >= $ndEnd && $timeout > $ndEnd){
																	$THOT1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$THOT1Array = array();
																	$THOT1Array = split(':', $THOT1);
																	$THOT1ArrayMin = sprintf('%.2f', $THOT1Array[1]/60);
																	$THOT1ArrayDec = sprintf('%.2f', $THOT1Array[0] + $THOT1ArrayMin);

																	$THOT2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$THOT2Array = array();
																	$THOT2Array = split(':', $THOT2);
																	$THOT2ArrayMin = sprintf('%.2f', $THOT2Array[1]/60);
																	$THOT2ArrayDec = sprintf('%.2f', $THOT2Array[0] + $THOT2ArrayMin);

																	$THOTTotal = sprintf('%.2f', $THOT1ArrayDec + $THOT2ArrayDec);

																	if($THOTTotal <= 8.00){
																		// echo '<td>'.$THOTTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='$THOTTotal',RST_LH_OT_GRT8='$zero',RST_LH_ND='$zero',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($THOTTotal > 8.00){
																		$THOTTotalgrt8 = sprintf('%.2f', $THOTTotal - 8.00);

																		// echo '<td>8.00</td>';
																		// echo '<td>'.$THOTTotalgrt8.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='8.00',RST_LH_OT_GRT8='$THOTTotalgrt8',RST_LH_ND='$zero',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}
																}else if($timein < $ndStart && $timeout > $ndStart && $timein > $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart){
																		$RSTOTtbND = "0.00";//LH ND

																		$RSTOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('02:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart){
																		$tbND = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$tbNDArray = array();
																		$tbNDArray = split(':', $tbND);
																		$tbNDArrayMin = sprintf('%.2f', $tbNDArray[1]/60);
																		$RSTOTtbND = sprintf('%.2f', $tbNDArray[0] + $tbNDArrayMin); //LH ND

																		$RSTOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($ndStart) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbt =date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$RSTOTbtArray = array();
																		$RSTOTbtArray = split(':', $RSTOTbt);
																		$RSTOTbtArrayMin = sprintf('%.2f', $RSTOTbtArray[1]/60);
																		$RSTOTbtArrayDec = sprintf('%.2f', $RSTOTbtArray[0] + $RSTOTbtArrayMin); //LH OT
																	}else if($breakin >= $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbtArrayDec = "0.00"; //LH OT
																	}

																	$RSTOTtbbtTotal = sprintf('%.2f', $RSTOTtbArrayDec + $RSTOTbtArrayDec); //LH OT TOTAL
																	$RSTOTtbbtNDTotal = sprintf('%.2f', $RSTOTtbND + $RSTOTbtND); // LH OT ND TOTAL
																	$RSTOTandNDTotal = sprintf('%.2f', $RSTOTtbbtTotal + $RSTOTtbbtNDTotal);

																	if($RSTOTandNDTotal <= 8.00){
																		// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='$RSTOTtbbtTotal',RST_LH_OT_GRT8='$zero',RST_LH_ND='$RSTOTtbbtNDTotal',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($RSTOTandNDTotal > 8.00){
																		if($RSTOTtbbtTotal == 8.00){
																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_LH_OT='$RSTOTtbbtTotal',RST_LH_OT_GRT8='$zero',RST_LH_ND='$zero',RST_LH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal > 8.0){
																			$RSTOTtbbtTotalgrt8 = sprintf('%.2f', $RSTOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$RSTOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_LH_OT='8.00',RST_LH_OT_GRT8='$RSTOTtbbtTotalgrt8',RST_LH_ND='$zero',RST_LH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal < 8.00){
																			$RSTOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $RSTOTtbbtTotal);
																			$RSTOTtbbtNDTotalgrt8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtTotalLess8);
																			$RSTOTtbbtNDTotalLess8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtNDTotalgrt8);

																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalLess8.'</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_LH_OT='$RSTOTtbbtTotal',RST_LH_OT_GRT8='$zero',RST_LH_ND='$RSTOTtbbtNDTotalLess8',RST_LH_ND_GRT8='$RSTOTtbbtNDTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}
																	}
																}else if($timein < $ndStart && $timeout <= $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart && $timein > $ndEnd && $breakout > $ndEnd){
																		$tbND = "0.00"; //LH OT ND

																		$LHOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); // LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout < $ndEnd && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTtb) - strtotime('03:00'));
																		$LHOTNDtb2Array = array();
																		$LHOTNDtb2Array = split(':', $LHOTNDtb2);
																		$LHOTNDtb2ArrayMin = sprintf('%.2f', $LHOTNDtb2Array[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtb2Array[0] + $LHOTNDtb2ArrayMin + 2.00); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout <= $ndEnd && $breakin > $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt) - strtotime('03:00'));
																		$LHOTNDbt2Array = array();
																		$LHOTNDbt2Array = split(':', $LHOTNDbt2);
																		$LHOTNDbt2ArrayMin = sprintf('%.2f', $LHOTNDbt2Array[1]/60);
																		$btND = sprintf('%.2f', $LHOTNDbt2Array[0] + $LHOTNDbt2ArrayMin + 2.00); // LH OT ND

																		$LHOTbt = date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTbtArray = array();
																		$LHOTbtArray = split(':', $LHOTbt);
																		$LHOTbtArrayMin = sprintf('%.2f', $LHOTbtArray[1]/60);
																		$LHOTbtArrayDec = sprintf('%.2f', $LHOTbtArray[0] + $LHOTbtArrayMin); //LH OT
																	}else if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtbArrayDec + $LHOTbtArrayDec); //LH OT TOTAL
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND); //LH OT ND TOTAL
																	$LHOTandNDtbbtTotal = sprintf('%.2f', $LHOTtbbtTotal + $LHOTNDtbbtTotal);

																	if($LHOTandNDtbbtTotal <= 8.00){
																		// echo '<td>'.$LHOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='$LHOTtbbtTotal',RST_LH_OT_GRT8='$zero',RST_LH_ND='$LHOTNDtbbtTotal',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTandNDtbbtTotal > 8.00){
																		if($LHOTtbbtTotal == 8.00){
																			// echo '<td>'.$LHOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_LH_OT='$LHOTtbbtTotal',RST_LH_OT_GRT8='$zero',RST_LH_ND='$zero',RST_LH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal > 8.00){
																			$LHOTtbbtTotalgrt8 = sprintf('%.2f', $LHOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$LHOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_LH_OT='8.00',RST_LH_OT_GRT8='$LHOTtbbtTotalgrt8',RST_LH_ND='$zero',RST_LH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal < 8.00){
																			$LHOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $LHOTtbbtTotal);
																			$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTtbbtTotalLess8);
																			$LHOTNDtbbtTotalLess8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTNDtbbtTotalgrt8);
																			// echo '<td>'.$LHOTtbbtTotalLess8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalLess8.'</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_LH_OT='$LHOTtbbtTotalLess8',RST_LH_OT_GRT8='$zero',RST_LH_ND='$LHOTNDtbbtTotalLess8',RST_LH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}

																	}

																}else if($timein >= $ndStart && $timeout <= $ndEnd){
																	if($timein >= $ndStart && $breakout > $ndStart){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}else if($timein >= $ndStart && $breakout <= $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($timein) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDtb2) - strtotime('03:00'));
																		$LHOTNDtb3Array = array();
																		$LHOTNDtb3Array = split(':', $LHOTNDtb3);
																		$LHOTNDtb3ArrayMin = sprintf('%.2f', $LHOTNDtb3Array[1]/60);
																		$LHOTNDtb3ArrayDec = sprintf('%.2f', $LHOTNDtb3Array[0] + $LHOTNDtb3ArrayMin);

																		$tbND = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDtb3ArrayDec); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}

																	if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtb + $LHOTbt);
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='$zero',RST_LH_OT_GRT8='$zero',RST_LH_ND='$LHOTNDtbbtTotal',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - 8.00);

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='$zero',RST_LH_OT_GRT8='$zero',RST_LH_ND='8.00',RST_LH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																	}

																}else if($timein >= $ndStart && $timeout > $ndStart){
																	$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$LHOTNDtbArray = array();
																	$LHOTNDtbArray = split(':', $LHOTNDtb);
																	$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																	$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																	$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$LHOTNDbtArray = array();
																	$LHOTNDbtArray = split(':', $LHOTNDbt);
																	$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																	$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																	$LHOTNDtbbtTotal = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDbtArrayDec);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='$zero',RST_LH_OT_GRT8='$zero',RST_LH_ND='$LHOTNDtbbtTotal',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = $LHOTNDtbbtTotal - 8.00;

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET RST_LH_OT='$zero',RST_LH_OT_GRT8='$zero',RST_LH_ND='8.00',RST_LH_ND_GRT8='$LHOTNDtbbtTotalget8' WHERE attendance_id='$attendance_id'");
																	}
																}
															}else{
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET RST_LH_OT='$zero',RST_LH_OT_GRT8='$zero',RST_LH_ND='$zero',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
															}
														}
													}
												}else{
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													$mysqli->query("UPDATE attendance SET RST_LH_OT='$zero',RST_LH_OT_GRT8='$zero',RST_LH_ND='$zero',RST_LH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
												}
											}



											//RST SH OT / RST SH OT >8 / RST SH OT ND / RST SH OT ND >8
											if($regularHoliday = $mysqli->query("SELECT * FROM holiday WHERE holiday_type='Special' AND holiday_date='$attendance_date'")){
												if($regularHoliday->num_rows > 0){
													while($reghol = $regularHoliday->fetch_object()){
														$regHoliday_date = $reghol->holiday_date;
														$regHolidayDateDay = date('Y-m-d:l', strtotime($regHoliday_date));
														$regHolidayArray = array();
														$regHolidayArray = split(':', $regHolidayDateDay);
														if($attendance_date == $regHoliday_date && $regHolidayArray[1] == $restdayArray[0] || $attendance_date == $regHoliday_date && $regHolidayArray[1] == $restdayArray[1]){
															if ($timein < $ndStart && $timeout <= $ndStart ||
																$timein < $ndStart && $timeout > $ndStart ||
																$timein < $ndStart && $timeout <= $ndEnd ||
																$timein >= $ndStart && $timeout < $ndEnd ||
																$timein >= $ndStart && $timeout > $ndStart){

																if($timein < $ndStart && $timeout <= $ndStart && $timein >= $ndEnd && $timeout > $ndEnd){
																	$THOT1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$THOT1Array = array();
																	$THOT1Array = split(':', $THOT1);
																	$THOT1ArrayMin = sprintf('%.2f', $THOT1Array[1]/60);
																	$THOT1ArrayDec = sprintf('%.2f', $THOT1Array[0] + $THOT1ArrayMin);

																	$THOT2 = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$THOT2Array = array();
																	$THOT2Array = split(':', $THOT2);
																	$THOT2ArrayMin = sprintf('%.2f', $THOT2Array[1]/60);
																	$THOT2ArrayDec = sprintf('%.2f', $THOT2Array[0] + $THOT2ArrayMin);

																	$THOTTotal = sprintf('%.2f', $THOT1ArrayDec + $THOT2ArrayDec);

																	if($THOTTotal <= 8.00){
																		// echo '<td>'.$THOTTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='$THOTTotal',RST_SH_OT_GRT8='$zero',RST_SH_ND='$zero',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($THOTTotal > 8.00){
																		$THOTTotalgrt8 = sprintf('%.2f', $THOTTotal - 8.00);

																		// echo '<td>8.00</td>';
																		// echo '<td>'.$THOTTotalgrt8.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='8.00',RST_SH_OT_GRT8='$THOTTotalgrt8',RST_SH_ND='$zero',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}
																}else if($timein < $ndStart && $timeout > $ndStart && $timein > $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart){
																		$RSTOTtbND = "0.00";//LH ND

																		$RSTOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('02:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart){
																		$tbND = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$tbNDArray = array();
																		$tbNDArray = split(':', $tbND);
																		$tbNDArrayMin = sprintf('%.2f', $tbNDArray[1]/60);
																		$RSTOTtbND = sprintf('%.2f', $tbNDArray[0] + $tbNDArrayMin); //LH ND

																		$RSTOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$RSTOTtbArray = array();
																		$RSTOTtbArray = split(':', $RSTOTtb);
																		$RSTOTtbArrayMin = sprintf('%.2f', $RSTOTtbArray[1]/60);
																		$RSTOTtbArrayDec = sprintf('%.2f', $RSTOTtbArray[0] + $RSTOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($ndStart) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbt =date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$RSTOTbtArray = array();
																		$RSTOTbtArray = split(':', $RSTOTbt);
																		$RSTOTbtArrayMin = sprintf('%.2f', $RSTOTbtArray[1]/60);
																		$RSTOTbtArrayDec = sprintf('%.2f', $RSTOTbtArray[0] + $RSTOTbtArrayMin); //LH OT
																	}else if($breakin >= $ndStart && $timeout > $ndStart){
																		$btND = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$btNDArray = array();
																		$btNDArray = split(':', $btND);
																		$btNDArrayMin = sprintf('%.2f', $btNDArray[1]/60);
																		$RSTOTbtND = sprintf('%.2f', $btNDArray[0] + $btNDArrayMin); //LH ND

																		$RSTOTbtArrayDec = "0.00"; //LH OT
																	}

																	$RSTOTtbbtTotal = sprintf('%.2f', $RSTOTtbArrayDec + $RSTOTbtArrayDec); //LH OT TOTAL
																	$RSTOTtbbtNDTotal = sprintf('%.2f', $RSTOTtbND + $RSTOTbtND); // LH OT ND TOTAL
																	$RSTOTandNDTotal = sprintf('%.2f', $RSTOTtbbtTotal + $RSTOTtbbtNDTotal);

																	if($RSTOTandNDTotal <= 8.00){
																		// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='$RSTOTtbbtTotal',RST_SH_OT_GRT8='$zero',RST_SH_ND='$RSTOTtbbtNDTotal',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($RSTOTandNDTotal > 8.00){
																		if($RSTOTtbbtTotal == 8.00){
																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_SH_OT='$RSTOTtbbtTotal',RST_SH_OT_GRT8='$zero',RST_SH_ND='$zero',RST_SH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal > 8.0){
																			$RSTOTtbbtTotalgrt8 = sprintf('%.2f', $RSTOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$RSTOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_SH_OT='8.00',RST_SH_OT_GRT8='$RSTOTtbbtTotalgrt8',RST_SH_ND='$zero',RST_SH_ND_GRT8='$RSTOTtbbtNDTotal' WHERE attendance_id='$attendance_id'");
																		}else if($RSTOTtbbtTotal < 8.00){
																			$RSTOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $RSTOTtbbtTotal);
																			$RSTOTtbbtNDTotalgrt8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtTotalLess8);
																			$RSTOTtbbtNDTotalLess8 = sprintf('%.2f', $RSTOTtbbtNDTotal - $RSTOTtbbtNDTotalgrt8);

																			// echo '<td>'.$RSTOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalLess8.'</td>';
																			// echo '<td>'.$RSTOTtbbtNDTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_SH_OT='$RSTOTtbbtTotal',RST_SH_OT_GRT8='$zero',RST_SH_ND='$RSTOTtbbtNDTotalLess8',RST_SH_ND_GRT8='$RSTOTtbbtNDTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}
																	}
																}else if($timein < $ndStart && $timeout <= $ndEnd){
																	if($timein < $ndStart && $breakout <= $ndStart && $timein > $ndEnd && $breakout > $ndEnd){
																		$tbND = "0.00"; //LH OT ND

																		$LHOTtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); // LH OT
																	}else if($timein < $ndStart && $breakout > $ndStart && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}else if($timein < $ndStart && $breakout < $ndEnd && $timein > $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTtb) - strtotime('03:00'));
																		$LHOTNDtb2Array = array();
																		$LHOTNDtb2Array = split(':', $LHOTNDtb2);
																		$LHOTNDtb2ArrayMin = sprintf('%.2f', $LHOTNDtb2Array[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtb2Array[0] + $LHOTNDtb2ArrayMin + 2.00); //LH OT ND

																		$LHOTtb = date('H:i', strtotime($ndStart) - strtotime($timein) - strtotime('03:00'));
																		$LHOTtbArray = array();
																		$LHOTtbArray = split(':', $LHOTtb);
																		$LHOTtbArrayMin = sprintf('%.2f', $LHOTtbArray[1]/60);
																		$LHOTtbArrayDec = sprintf('%.2f', $LHOTtbArray[0] + $LHOTtbArrayMin); //LH OT
																	}

																	if($breakin < $ndStart && $timeout <= $ndEnd && $breakin > $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt) - strtotime('03:00'));
																		$LHOTNDbt2Array = array();
																		$LHOTNDbt2Array = split(':', $LHOTNDbt2);
																		$LHOTNDbt2ArrayMin = sprintf('%.2f', $LHOTNDbt2Array[1]/60);
																		$btND = sprintf('%.2f', $LHOTNDbt2Array[0] + $LHOTNDbt2ArrayMin + 2.00); // LH OT ND

																		$LHOTbt = date('H:i', strtotime($ndStart) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTbtArray = array();
																		$LHOTbtArray = split(':', $LHOTbt);
																		$LHOTbtArrayMin = sprintf('%.2f', $LHOTbtArray[1]/60);
																		$LHOTbtArrayDec = sprintf('%.2f', $LHOTbtArray[0] + $LHOTbtArrayMin); //LH OT
																	}else if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbtArrayDec = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtbArrayDec + $LHOTbtArrayDec); //LH OT TOTAL
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND); //LH OT ND TOTAL
																	$LHOTandNDtbbtTotal = sprintf('%.2f', $LHOTtbbtTotal + $LHOTNDtbbtTotal);

																	if($LHOTandNDtbbtTotal <= 8.00){
																		// echo '<td>'.$LHOTtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='$LHOTtbbtTotal',RST_SH_OT_GRT8='$zero',RST_SH_ND='$LHOTNDtbbtTotal',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTandNDtbbtTotal > 8.00){
																		if($LHOTtbbtTotal == 8.00){
																			// echo '<td>'.$LHOTtbbtTotal.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_SH_OT='$LHOTtbbtTotal',RST_SH_OT_GRT8='$zero',RST_SH_ND='$zero',RST_SH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal > 8.00){
																			$LHOTtbbtTotalgrt8 = sprintf('%.2f', $LHOTtbbtTotal - 8.00);

																			// echo '<td>8.00</td>';
																			// echo '<td>'.$LHOTtbbtTotalgrt8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_SH_OT='8.00',RST_SH_OT_GRT8='$LHOTtbbtTotalgrt8',RST_SH_ND='$zero',RST_SH_ND_GRT8='$LHOTNDtbbtTotal' WHERE attendance_id='$attendance_id'");
																		}else if($LHOTtbbtTotal < 8.00){
																			$LHOTtbbtTotalLess8 = sprintf('%.2f', 8.00 - $LHOTtbbtTotal);
																			$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTtbbtTotalLess8);
																			$LHOTNDtbbtTotalLess8 = sprintf('%.2f', $LHOTNDtbbtTotal - $LHOTNDtbbtTotalgrt8);
																			// echo '<td>'.$LHOTtbbtTotalLess8.'</td>';
																			// echo '<td>0.00</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalLess8.'</td>';
																			// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																			$mysqli->query("UPDATE attendance SET RST_SH_OT='$LHOTtbbtTotalLess8',RST_SH_OT_GRT8='$zero',RST_SH_ND='$LHOTNDtbbtTotalLess8',RST_SH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																		}

																	}

																}else if($timein >= $ndStart && $timeout <= $ndEnd){
																	if($timein >= $ndStart && $breakout > $ndStart){
																		$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$tbND = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}else if($timein >= $ndStart && $breakout <= $ndEnd){
																		$LHOTNDtb = date('H:i', strtotime($timein) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDtbArray = array();
																		$LHOTNDtbArray = split(':', $LHOTNDtb);
																		$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																		$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																		$LHOTNDtb2 = date('H:i', strtotime($ndEnd) - strtotime($breakout) - strtotime('03:00'));
																		$LHOTNDtb3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDtb2) - strtotime('03:00'));
																		$LHOTNDtb3Array = array();
																		$LHOTNDtb3Array = split(':', $LHOTNDtb3);
																		$LHOTNDtb3ArrayMin = sprintf('%.2f', $LHOTNDtb3Array[1]/60);
																		$LHOTNDtb3ArrayDec = sprintf('%.2f', $LHOTNDtb3Array[0] + $LHOTNDtb3ArrayMin);

																		$tbND = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDtb3ArrayDec); //LH OT ND
																		$LHOTtb = "0.00"; //LH OT
																	}

																	if($breakin > $ndStart && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($breakin) - strtotime($ndStart) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																		$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																		$LHOTNDbt2 = date('H:i', strtotime($ndEnd) - strtotime($timeout) - strtotime('03:00'));
																		$LHOTNDbt3 = date('H:i', strtotime($ndEnd) - strtotime($LHOTNDbt2) - strtotime('03:00'));
																		$LHOTNDbt3Array = array();
																		$LHOTNDbt3Array = split(':', $LHOTNDbt3);
																		$LHOTNDbt3ArrayMin = sprintf('%.2f', $LHOTNDbt3Array[1]/60);
																		$LHOTNDbt3ArrayDec = sprintf('%.2f', $LHOTNDbt3Array[0] + $LHOTNDbt3ArrayMin);

																		$btND = sprintf('%.2f', $LHOTNDbtArrayDec + $LHOTNDbt3ArrayDec); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}else if($breakin < $ndEnd && $timeout <= $ndEnd){
																		$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																		$LHOTNDbtArray = array();
																		$LHOTNDbtArray = split(':', $LHOTNDbt);
																		$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);

																		$btND = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin); //LH OT ND
																		$LHOTbt = "0.00"; //LH OT
																	}

																	$LHOTtbbtTotal = sprintf('%.2f', $LHOTtb + $LHOTbt);
																	$LHOTNDtbbtTotal = sprintf('%.2f', $tbND + $btND);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='$zero',RST_SH_OT_GRT8='$zero',RST_SH_ND='$LHOTNDtbbtTotal',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = sprintf('%.2f', $LHOTNDtbbtTotal - 8.00);

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='$zero',RST_SH_OT_GRT8='$zero',RST_SH_ND='8.00',RST_SH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																	}

																}else if($timein >= $ndStart && $timeout > $ndStart){
																	$LHOTNDtb = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime('03:00'));
																	$LHOTNDtbArray = array();
																	$LHOTNDtbArray = split(':', $LHOTNDtb);
																	$LHOTNDtbArrayMin = sprintf('%.2f', $LHOTNDtbArray[1]/60);
																	$LHOTNDtbArrayDec = sprintf('%.2f', $LHOTNDtbArray[0] + $LHOTNDtbArrayMin);

																	$LHOTNDbt = date('H:i', strtotime($timeout) - strtotime($breakin) - strtotime('03:00'));
																	$LHOTNDbtArray = array();
																	$LHOTNDbtArray = split(':', $LHOTNDbt);
																	$LHOTNDbtArrayMin = sprintf('%.2f', $LHOTNDbtArray[1]/60);
																	$LHOTNDbtArrayDec = sprintf('%.2f', $LHOTNDbtArray[0] + $LHOTNDbtArrayMin);

																	$LHOTNDtbbtTotal = sprintf('%.2f', $LHOTNDtbArrayDec + $LHOTNDbtArrayDec);

																	if($LHOTNDtbbtTotal <= 8.00){
																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotal.'</td>';
																		// echo '<td>0.00</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='$zero',RST_SH_OT_GRT8='$zero',RST_SH_ND='$LHOTNDtbbtTotal',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
																	}else if($LHOTNDtbbtTotal > 8.00){
																		$LHOTNDtbbtTotalgrt8 = $LHOTNDtbbtTotal - 8.00;

																		// echo '<td>0.00</td>';
																		// echo '<td>0.00</td>';
																		// echo '<td>8.00</td>';
																		// echo '<td>'.$LHOTNDtbbtTotalgrt8.'</td>';
																		$mysqli->query("UPDATE attendance SET RST_SH_OT='$zero',RST_SH_OT_GRT8='$zero',RST_SH_ND='8.00',RST_SH_ND_GRT8='$LHOTNDtbbtTotalgrt8' WHERE attendance_id='$attendance_id'");
																	}
																}
															}else{
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																// echo '<td>0.00</td>';
																$mysqli->query("UPDATE attendance SET RST_SH_OT='$zero',RST_SH_OT_GRT8='$zero',RST_SH_ND='$zero',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
															}
														}
													}
												}else{
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													// echo '<td>0.00</td>';
													$mysqli->query("UPDATE attendance SET RST_SH_OT='$zero',RST_SH_OT_GRT8='$zero',RST_SH_ND='$zero',RST_SH_ND_GRT8='$zero' WHERE attendance_id='$attendance_id'");
												}
											}

											echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'editdtrdialog'											
														data-id='$row->attendance_id' 
														data-date='$row->attendance_date' 
														data-timein='$timeindisplay'
														data-breakout='$breakoutdisplay'
														data-breakin='$breakindisplay'
														data-timeout='$timeoutdisplay'
														data-remarks='$row->attendance_remarks'
														
											
											><button class='btn btn-info' type='button'><i class='fa fa-paste'></i> Edit</button></a></td>";
											echo "</tr>";
										}
										echo "</table>";
									}
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
									<div class="col-md-8"><input id = "date" name = "daterange" type="text" class="form-control" readonly="readonly" onKeyPress="return noneonly(this, event)"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Time in</label>
									<div class="col-md-8">
										<div class="input-group clockpicker" data-autoclose="true">
											<input type="text" id = "timein" name = "timein" class="form-control timepicker1" value=""readonly = "readonly" value="">
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
											<input type="text" id = "outfrombreak" name = "outfrombreak" class="form-control timepicker1" value=""readonly = "readonly" >
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
											<input type="text" id = "infrombreak" name = "infrombreak" class="form-control timepicker1" value=""readonly = "readonly" >
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
											<input type="text" id = "timeout" name = "timeout" class="form-control timepicker1" value=""readonly = "readonly" >
											<span class="input-group-addon">
												<span class="fa fa-clock-o"></span>
											</span>
										</div>
									</div>
								</div>		
						</div>
					</div>
					<div class="modal-footer">
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
    <link href="css/timepicki.css" rel="stylesheet">
		<?php
			include('menufooter.php');
		?>
	</body>
</html>