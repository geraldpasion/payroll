<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			$empLevel = $_SESSION['employee_level'];
			if (isset($_SESSION['logsession']) && $empLevel == '3')  {
				include('menuheader.php');
			} else if(isset($_SESSION['logsession']) && $empLevel == '2') {
				include('supervisormenuheader.php');
			}else if(isset($_SESSION['logsession']) && $empLevel == '4'){
				include('levelexe.php');
			}
			 else {
				include('employeemenuheader.php');
			}
			$empid = $_SESSION['logsession'];
		?>
		<title>Log Edit Tracker</title>
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
		<!--script type="text/javascript">
			$(function() {
			$(".approve").click(function(){
			var element = $(this);
			var id = element.attr("id");
			var date = element.attr("date");
			var timein = element.attr("timein");
			var breakout = element.attr("breakout");
			var breakin = element.attr("breakin");
			var timeout = element.attr("timeout");
			var info = 'attendance_id=' + id + '&logedit_date='+ date + '&logedit_timein='+ timein + '&logedit_breakout='+ breakout + '&logedit_breakin='+ breakin + '&logedit_timeout='+ timeout;
			
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
		</script-->
		
		<!--script type="text/javascript">
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
	</script-->
	<!--?php
		if(isset($_GET['edited']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		?-->
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Log Edit Tracker</h5>
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
							$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
							$team1 = $result['employee_team'];
							$team2 = $result['employee_team1'];
							$team3 = $result['employee_team2'];
							$team4 = $result['employee_team3'];
							if($empLevel == '1') echo "<h4><label class='control-label' style='text-align:left;text-transform:uppercase;'>&nbsp;&nbsp;" . $result['employee_firstname'] . " " . $result['employee_lastname'] . "</h4></label>";
						?>
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						<?php
							include('dbconfig.php');
							if($empLevel == '4') {
								$sqlString = "SELECT * FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE logedit_status ='Approved' OR logedit_status = 'Disapproved' order by logeditid desc";
							} if($empLevel == '3') {
								$sqlString = "SELECT * FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE (logedit_status ='Approved' OR logedit_status = 'Disapproved') AND (employee_team = '$team1' OR employee_team1 = '$team2' OR employee_team2 = '$team3' OR employee_team3 = '$team4') AND (employee_level = 1 OR employee_level = 2) order by logeditid desc";
							} if($empLevel == '2') {
								$sqlString = "SELECT * FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE employee_team = '$team1' AND employee_level = 1 AND (logedit_status ='Approved' OR logedit_status = 'Disapproved') order by logeditid desc";
							} if($empLevel == '1') {
								$sqlString = "SELECT * FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE employee.employee_id = '$empid' AND logedit_status = 'Approved' AND employee_level = 1 order by logeditid desc";
							}
								if ($result = $mysqli->query($sqlString)) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										if($empLevel != '1') { echo "<th>Name</th>";
										echo "<th>Date</th>";
										echo "<th>Time in</th>";
										echo "<th>Out from break</th>";
										echo "<th>In from break</th>";
										echo "<th>Time out</th>";
										echo "<th>Status</th>";
										echo "<th>Managed by</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tfoot>";                    
										echo "<tr>";
										echo "<td colspan='78'>";
										echo "<ul class='pagination pull-right'></ul>";
										echo "</td>";
										echo "</tr>";
										echo "</tfoot>";
										} else { 
										echo "<th>Date</th>";
										echo "<th>Time in</th>";
										echo "<th>Out from break</th>";
										echo "<th>In from break</th>";
										echo "<th>Time out</th>";
										echo "<th>Status</th>";
										echo "<th>Managed by</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tfoot>";                    
										echo "<tr>";
										echo "<td colspan='78'>";
										echo "<ul class='pagination pull-right'></ul>";
										echo "</td>";
										echo "</tr>";
										echo "</tfoot>";
										} 
										while ($row = $result->fetch_object())
										{
											echo "<tr class = 'josh'>";
											if($empLevel != '1'){ echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
											echo "<td>" . date("Y-m-d",strtotime($row->logedit_date)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_timein)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_breakout)). "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_breakin)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_timeout)) . "</td>";
											echo "<td>" . $row->logedit_status . "</td>";
											echo "<td>" . $row->logedit_approvedby . "</td>";
											}
											else{
											echo "<td>" . date("Y-m-d",strtotime($row->logedit_date)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_timein)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_breakout)). "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_breakin)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->logedit_timeout)) . "</td>";
											echo "<td>" . $row->logedit_status . "</td>";
											echo "<td>" . $row->logedit_approvedby . "</td>";
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
		<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<i class="fa fa-edit modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Log edit requests</h4>
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
											<input type="text" id = "timein" name = "timein" class="form-control" value=""readonly = "readonly" >
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
											<input type="text" id = "outfrombreak" name = "outfrombreak" class="form-control" value=""readonly = "readonly" >
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
											<input type="text" id = "infrombreak" name = "infrombreak" class="form-control" value=""readonly = "readonly" >
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
											<input type="text" id = "timeout" name = "timeout" class="form-control" value=""readonly = "readonly" >
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
		<script type="text/javascript">
			$('.clockpicker').clockpicker();
		</script>
		<?php
			if($empLevel == "3") {
				include('menufooter.php');
			} else {
				include('employeemenufooter.php');
			}
		?>
	</body>
</html>