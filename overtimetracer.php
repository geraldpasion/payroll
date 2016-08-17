<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Overtime Status</title>
				<style>
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			.zx{
			border: none;
			border-color: transparent;
			margin-top:2%;
			}
		</style>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
				<script type="text/javascript">
			$(document).on("click", ".viewempdialog", function () {
			 var overtimeid = $(this).data('id');
			 var date = $(this).data('date');
			 var start = $(this).data('start');
			 var end = $(this).data('end');
			 var reason = $(this).data('reason');
			 var name = $(this).data('name');
			 var remarks = $(this).data('remarks');
			 
			 $(".modal-body #overtimeid").val( overtimeid );	
			 $(".modal-body #employeename").val( name );	
			 $(".modal-body #overtimedate").val( date );	
			 $(".modal-body #overtimestart").val( start );	
			 $(".modal-body #overtimereason").val( reason );	
			 $(".modal-body #overtimeend").val( end );
			 $(".modal-body #overtimeremarks").val( remarks );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   
			
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
				toastr.success("Overtime application successfully approved!");
				history.replaceState({}, "Title", "overtimeapproval.php");
		}
		showDisapproved=function(){
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
				toastr.success("Overtime application successfully disapproved!");
				history.replaceState({}, "Title", "overtimeapproval.php");
		}
		
		
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
								if ($result = $mysqli->query("SELECT * FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id WHERE overtime.overtime_status = 'Approved' OR overtime.overtime_status = 'Disapproved' ORDER BY overtime.overtime_id desc")) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr style='text-align:center'>";	
										echo "<th style='text-align:center'>Name</th>";
										echo "<th style='text-align:center'>Date</th>";
										echo "<th style='text-align:center'>Start</th>";
										echo "<th style='text-align:center'>End</th>";
										echo "<th style='text-align:center'>Duration</th>";
										echo "<th style='text-align:center'>Reason</th>";
										echo "<th style='text-align:center'>Status</th>";
										//echo "<th style='text-align:center'>Remarks</th>";
										echo "<th style='text-align:center'>Managed by</th>";
										echo "<th style='text-align:center'>Action</th>";
										echo "<th style='text-align:center'>Progress</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tfoot>";                    
										echo "<tr>";
										echo "<td colspan='12'>";
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
											echo "<td style='text-align:center'><a href='#' data-toggle='modal' data-target='#myModal4'
														data-name='$row->employee_firstname $row->employee_lastname' 
														data-id='$row->overtime_id' 
														data-date='$row->overtime_date'
														data-start='$row->overtime_start'
														data-end='$row->overtime_end'
														data-reason='$row->overtime_reason'
														data-remarks='$row->overtime_remarks'
														
														class = 'viewempdialog'>". $row->employee_firstname . " " . $row->employee_lastname . "</a></td>";
											echo "<td style='text-align:center'>" . date("Y-m-d",strtotime($row->overtime_date)) . "</td>";
											echo "<td style='text-align:center'>" . date("g:i A",strtotime($row->overtime_start)) . "</td>";
											echo "<td style='text-align:center'>" . date("g:i A",strtotime($row->overtime_end)) . "</td>";
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
											echo "<td style='text-align:center'>" . $OTCountDec . "</td>";
											echo "<td style='text-align:center'>" . $row->overtime_reason . "</td>";
											echo "<td style='text-align:center'>" . $row->overtime_status . "</td>";
											//echo "<td style='text-align:center'>" . $row->overtime_remarks . "</td>";
											echo "<td style='text-align:center'>" . $row->overtime_approvedby. "</td>";
											echo "<td style='text-align:center'> <a href = 'overtimeform.php?id=$empsid&otid=$overtime'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a></td>";
											echo "<td style='text-align:center'><a href='#' data-toggle='modal' data-target='#myModal4' data-name='$row->employee_firstname $row->employee_lastname' 
														data-id='$row->overtime_id' 
														data-date='$row->overtime_date'
														data-start='$row->overtime_start'
														data-end='$row->overtime_end'
														data-reason='$row->overtime_reason' class = 'viewempdialog'>";
														
//if ($result2 = $mysqli->query("SELECT * FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id INNER //join attendance on attendance.employee_id = overtime.employee_id WHERE overtime.employee_id=$empsid"))
//	while ($row2 = mysqli_fetch_object($result2))
//{
//	$datuea = $row2->overtime_date;
//	$overtimeend2 = $row2->overtime_end;
//	$attendanceend = $row2->attendance_timeout;
//
//	$stdatese1 = $datuea.' '.$attendanceend.':'.'00';
//	$stdatese2 = $datuea.' '.$overtimeend2;
//
//	$d1 = $stdatese1;
//	$d2 = $stdatese2;
//	
//	//$date = new DateTime();
//	$dateSSS = new DateTime("now", new DateTimeZone('Etc/GMT-8') );
//	$curt = $dateSSS->format('Y-m-d H:i:s');
//	
//
//	 if($curt > $d2){echo "<button class='btn btn-primary'";}else{echo "<button //class='btn btn-danger'";}
//	 echo "type='button'><i class='fa fa-check'></i>";
//	
//	if($curt > $d2){echo "Complete";}else{echo "Incomplete";}  
//
//}
										if ($result2 = $mysqli->query("SELECT * FROM overtime where overtime_id=$overtime"))
											while ($row2 = mysqli_fetch_object($result2))
										{
											$datuea = $row2->overtime_date;
											$overtimeend2 = $row2->overtime_end;
											//$attendanceend = $row2->attendance_timeout;

											//$stdatese1 = $datuea.' '.$attendanceend.':'.'00';
											$stdatese2 = $datuea.' '.$overtimeend2;

											//$d1 = $stdatese1;
											$d2 = strtotime($stdatese2);
											
											//$date = new DateTime();
											$dateSSS = new DateTime("now", new DateTimeZone('Etc/GMT-8') );
											$curt = strtotime($dateSSS->format('Y-m-d H:i:s'));
											
										
											 if($curt >= $d2){echo "<button class='btn btn-primary'";}else{echo "<button class='btn btn-danger'";}
											 echo "type='button'><i class='fa fa-check'></i>";
											
											if($curt >= $d2){echo "Complete";}else{echo "Inprogress";}  

										}
											"</button></a></td>";
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
		<div class="modal-dialog modal-small">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-clock-o modal-icon"></i>
					<h4 class="modal-title">Overtime Details</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "reapproveovertime.php"  class="form-horizontal">
						
							<div class="form-group">
						<input id = "overtimeid" type="hidden" name = "otid1" class="zx" required="" onKeyPress="return lettersonly(this, event)">
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Employee Name:</label>
								<div class="col-md-6"><input id = "employeename" type="text" name = "empid" readonly = "" class="zx" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Date:</label>
								<div class="col-md-6"><input id = "overtimedate" type="text" name = "lastname" readonly = "" class="zx" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Start:</label>
								<div class="col-md-6"><input type="text" id = "overtimestart" class="zx" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">End:</label>
								<div class="col-md-6"><input type="text" id = "overtimeend" class="zx" name = "firstname" onKeyPress="return lettersonly(this, event)"></div>
							</div>	
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Reason:</label>
								<div class="col-md-6"><input type="text" id = "overtimereason" class="zx" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Remarks:</label>
								<div class="col-md-6"><textarea type="text" id = "overtimeremarks" class="form-control" name = "remarks" readonly></textarea></div>
							</div>
							</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button class='btn btn-primary' type='submit' name = "approved"><i class='fa fa-check'></i> Approve</button></a>
					<button class='btn btn-danger' type='submit' name = "disapproved"><i class='fa fa-warning'></i> Disapprove</button></button></a>
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</form>
				</div>				
			</div>
		</div>
	</div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>