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
					<div class="ibox-content">
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						<?php
							include('dbconfig.php');
								if ($result = $mysqli->query("SELECT * FROM attendance INNER JOIN employee ON employee.employee_id = attendance.employee_id ORDER BY attendance_date")) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>Name</th>";
										echo "<th>Date</th>";
										echo "<th>Time in</th>";
										echo "<th>Out from break</th>";
										echo "<th>In from break</th>";
										echo "<th>Time out</th>";
										echo "<th>Total</th>";
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
											$tim=$row->attendance_timein;
											$tou=$row->attendance_timeout;
											$brin=$row->attendance_breakin;
											$brou=$row->attendance_breakout;


										
											$brou2=explode(':',$brou);
											$brou2hr=$brou2[0];
											$brou2mn=$brou2[1];											
											$tim2=explode(':',$tim);
											$tim2hr=$tim2[0];
											$tim2mn=$tim2[1];	
											//pangalawa
											$brin2=explode(':',$brin);
											$brin2hr=$brin2[0];
											$brin2mn=$brin2[1];	
											$tou2=explode(':',$tou);
											$tou2hr=$tou2[0];
											$tou2mn=$tou2[1];	
											
											


											//hour
											if($tim2hr>$brou2hr){
												$hour=$tim2hr-$brou2hr;

											}
											else {
												$hour=$brou2hr-$tim2hr;
											}
											
											//minute
											if($tim2mn>$brou2mn){
												$minutes=$tim2mn-$brou2mn;

											}
											else{
												$minutes=$brou2mn-$tim2mn;
											}	

											//hour2
											if($tou2hr>$brin2hr){
												$hour2=$tou2hr-$brin2hr;

											}
											else {
												$hour2=$brin2hr-$tou2hr;
											}
											
											//minute2
											if($tou2mn>$brin2mn){
												$minutes2=$tou2mn-$brin2mn;

											}
											else{
												$minutes2=$brin2mn-$tou2mn;
											}	


											$totalhr=$hour+$hour2;
											$totalmin=$minutes+$minutes2;


											echo "<tr>";
											echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
											echo "<td>" . date("F d, Y",strtotime($row->attendance_date)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->attendance_timein)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->attendance_breakout)). "</td>";
											echo "<td>" . date("g:i A",strtotime($row->attendance_breakin)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->attendance_timeout)) . "</td>";
											echo "<td>" . $totalhr.' Hours and '.$totalmin.' Minutes'. "</td>";
											echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'editdtrdialog'											
														data-id='$row->attendance_id' 
														data-date='$row->attendance_date' 
														data-timein='$row->attendance_timein'
														data-breakout='$row->attendance_breakout'
														data-breakin='$row->attendance_breakin'
														data-timeout='$row->attendance_timeout'
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
			include('menufooter.php');
		?>
	</body>
</html>