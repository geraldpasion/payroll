<!DOCTYPE html>
<html>
	<head>
		<?php
			 session_start();
		$empLevel = $_SESSION['employee_level'];
		if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');

		}else if(isset($_SESSION['logsession']) && $empLevel == '4') {
			include('levelexe.php');
		}
			if(isset($_POST['datefilter'])) 
				$newDateFilter = $_POST['datefilter']; 
			else $newDateFilter = '';
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
					history.replaceState({}, "Title", "attendance_4.php");
				}
			});
		</script>

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
			//ajax calling getEmpDetails.php to show an employee's attendance info w/in date range
			function showEmp(id, datef, datet) {
				var datef = new Date(datef);
				var datef = datef.getFullYear() + '/' + (datef.getMonth() + 1) + '/' + datef.getDate(); 

				
				var datet = new Date(datet);
				var datet = datet.getFullYear() + '/' + (datet.getMonth() + 1) + '/' + datet.getDate(); 

			    document.location.href = "getEmpDetails4.php?from=1&id="+id+"&datef="+datef+"&datet="+datet;
			}
		</script>

		<script>		
			//ajax calling export_attendance.php
			function exportDet(id, datef, datet) {
				var empid = id;
				var datef = new Date(datef);
				var datef = datef.getFullYear() + '/' + (datef.getMonth() + 1) + '/' + datef.getDate(); 
				
				var datet = new Date(datet);
				var datet = datet.getFullYear() + '/' + (datet.getMonth() + 1) + '/' + datet.getDate();

				document.location.href = 'export_attendance_process.php?from=one&id='+empid+'&datef='+datef+'&datet='+datet;
			}
		</script>

		<script>		
			//ajax calling export_attendance.php
			function exportAll(datef, datet) {
				alert(datef);
				var datef = new Date(datef);
				var datef = datef.getFullYear() + '/' + (datef.getMonth() + 1) + '/' + datef.getDate(); 
				
				var datet = new Date(datet);
				var datet = datet.getFullYear() + '/' + (datet.getMonth() + 1) + '/' + datet.getDate();

				document.location.href = 'export_attendance_process.php?from=all&datef='+datef+'&datet='+datet;
			}
		</script>
			
		<?php
			if(isset($_GET['edited'])) {
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
							<form method="POST" action="attendance_4.php">
								<table>
									<tr>
										<td style="padding:10px;"><h4><label class="control-label">Select Date Range</label></h4></td>
										<td style="padding:10px; width:250px;"><div>
											<input type="text" name="datefilter" id="datefilter" value="<?php echo $newDateFilter; ?>" class="form-control" required/>
										</div></td>
										<?php
											if(isset($_POST['datefilter'])) {
												$cutarray = array();
												$cutarray = split(" - ", $newDateFilter);
												$keydatefrom = $cutarray[0];
												$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
												$keydateto = $cutarray[1];
												$keydateto = date("Y-m-d", strtotime($keydateto));
												$datef = strtotime($keydatefrom)*1000;
												$datet = strtotime($keydateto)*1000;
											}
										?>
										<td style="padding:10px;"><button type="submit" name="test" class="btn btn-w-m btn-primary">Validate</button></td>
										<td style="padding:10px;"><button type="button" name="export" class="btn btn-w-m btn-primary" onclick="<?php echo 'exportAll('.$datef.','.$datet.')'; ?>">Export All Attendance</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>

					<div class="ibox-content">

						<?php						
							include('dbconfig.php');
							if(isset($_POST['list'])){
								$keydatefrom = $_POST['datef'];
								$keydateto = $_POST['datet'];

								$keydate = "WHERE attendance_date BETWEEN '$keydatefrom' AND '$keydateto' AND (attendance.status = 'Done' OR attendance.attendance_status = 'active' OR attendance.attendance_status = 'outforbreak' OR attendance.attendance_status = 'infrombreak')";
								echo "<div style='padding-left:60px;padding-right:60px;'>";
									echo "<input type='text' class='form-control input-sm m-b-xs' id='filter' placeholder='Search in table'><br>";
								
								if ($result = $mysqli->query("SELECT DISTINCT employee.employee_id, employee_firstname, employee_lastname FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id $keydate ORDER BY employee_firstname")) //get records from db
								{
									if ($result->num_rows > 0) //display employee based on date range
									{
										//echo "<form name='frmUser' method='post' action='export_attendance_process.php'>";
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";	
										echo "<thead>";
										echo "<tr>";
										echo "<th style='padding-left:20px;padding-right:80px;'>Name</th>";
										echo "<th colspan='2' style='text-align:center;padding-right:20px;'>Action</th>";
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
											echo "<tr>";											
											echo "<td style='padding-left:20px;padding-right:80px;'>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";

											$emp_id = $row->employee_id;
											$datef = strtotime($keydatefrom)*1000;
											$datet = strtotime($keydateto)*1000;

											echo "<td style='width:200px;'><button class='btn btn-info btn-block' type='button' name='open' onclick='showEmp(".$emp_id.",".$datef.",".$datet.")'><span class='glyphicon glyphicon-folder-open'>&nbsp;</span><span>Open</button></span></td>";
											 
											echo "<td style='padding-right:20px; width:200px;'><button type='button' name='export' id='exportFile' class='btn btn-primary btn-block' onclick='exportDet(".$emp_id.",".$datef.",".$datet.")'><span class='glyphicon glyphicon-file'>&nbsp;</span><span>Export Attendance</span></button></td>";
											
											echo "</tr>";
											
										}
										echo "</table>";
									}
								}
								echo "</div>";
							}
							else{
								if(isset($_POST['test'])){
									$datefilter = $_POST['datefilter'];

									$cutarray = array();
									$cutarray = split(" - ", $datefilter);
									$keydatefrom = $cutarray[0];
									$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
									$keydateto = $cutarray[1];
									$keydateto = date("Y-m-d", strtotime($keydateto));

									$keydate = "WHERE attendance_date BETWEEN '$keydatefrom' AND '$keydateto' AND (attendance.status = 'Done' OR attendance.attendance_status = 'active' OR attendance.attendance_status = 'outforbreak' OR attendance.attendance_status = 'infrombreak')";
									echo "<div style='padding-left:60px;padding-right:60px;'>";
									echo "<input type='text' class='form-control input-sm m-b-xs' id='filter' placeholder='Search in table'><br>";
									
									if ($result = $mysqli->query("SELECT DISTINCT employee.employee_id, employee_firstname, employee_lastname FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id $keydate ORDER BY attendance_date")) //get records from db
									{
										if ($result->num_rows > 0) //display employee based on date range
										{
											//echo "<form name='frmUser' method='post' action='export_attendance_process.php'>";
											echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";	
											echo "<thead>";
											echo "<tr>";
											echo "<th style='padding-left:20px;padding-right:80px;'>Name</th>";
											echo "<th colspan='2' style='text-align:center;padding-right:20px;'>Action</th>";
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
												echo "<tr>";											
												echo "<td style='padding-left:20px;padding-right:80px;'>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";

												$emp_id = $row->employee_id;
												$datef = strtotime($keydatefrom)*1000;
												$datet = strtotime($keydateto)*1000;

												echo "<td style='width:200px;'><button class='btn btn-info btn-block' type='button' name='open' onclick='showEmp(".$emp_id.",".$datef.",".$datet.")'><span class='glyphicon glyphicon-folder-open'>&nbsp;</span><span>Open</button></span></td>";
												 
												echo "<td style='padding-right:20px; width:200px;'><button type='button' name='export' id='exportFile' class='btn btn-primary btn-block' onclick='exportDet(".$emp_id.",".$datef.",".$datet.")'><span class='glyphicon glyphicon-file'>&nbsp;</span><span>Export Attendance</span></button></td>";
												
												echo "</tr>";
												
											}
											echo "</table>";
										}
									}
									echo "</div>";
								} 
							}
						?>
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