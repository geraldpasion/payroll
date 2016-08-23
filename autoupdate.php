<!DOCTYPE html>
<html>
	<head>
		<link href="css/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="css/plugins/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet">
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
		<title>Auto Update</title>
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
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>System Calendar Update</h5>
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
						<form method = "POST" action="autoupdate.php" class="form-horizontal">
							<div class="form-group"><br>
								<label class="col-sm-4 control-label">Execute every</label>
								<div class="col-md-2">
									<input type="number" name="editnum" id="editnum" class="form-control" min="1" required/>
								</div>
								<div class="col-md-2">
									<select class="form-control" name ="type" id="type" required>
									  	<option>DAY</option>
									    <option>SECOND</option>
									    <option>MINUTE</option>
									    <option>HOUR</option>
									    <option>WEEK</option>
									    <option>MONTH</option>
									    <option>QUARTER</option>
									    <option>YEAR</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Start Date</label>
								<div class="col-md-4"><input type="text" id = "date" value="" class="input-append date form-control" id="date" name="date" readonly required> </div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Start Time</label>
								<div class="col-md-4"><input type="text" id = "time" name="time" class="form-control timepicker1" value="" readonly required> </div>
							</div>
								
							<div class="col-md-5"></div>
								<button id ="submit" type="submit" name = "update" class="btn btn-w-m btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<?php						
			include('dbconfig.php');
			$sql = $mysqli->query("SELECT MAX(attendance_date) FROM attendance");
			$maxdate = mysqli_fetch_array($sql);
			$mdate = date('Y-m-d',strtotime($maxdate[0]));

			if(isset($_POST['update'])){
				$number = $_POST['editnum'];
				$type = $_POST['type'];
				$date = $_POST['date'];
				$time = $_POST['time'];
				$len = strlen($time);
				if($len == 11){
					$time = "0".$time;
				}
				$time = str_replace(' ', '', $time);
				$time = substr_replace($time, '', 5, 1);
				$time = date("H:i:s", strtotime($time));
				$cond = $number . " " . $type;
				$timestamp = "'". $date . " " . $time ."'";

				$mysqli->query("ALTER EVENT hris_event
					ON SCHEDULE EVERY $cond
					STARTS $timestamp
					DO
						CALL logs(NOW(), DATE_ADD(NOW(),INTERVAL $cond))");
			}
		?>

	<script type="text/javascript">
		function getFormatDate(d){
			    return d.getMonth()+1 + '/' + d.getDate() + '/' + d.getFullYear()
			}

			$(document).ready(function() {
			 var mTemp = new Date("<?php echo $mdate ?>");
			 var minDate = getFormatDate(new Date(mTemp.setDate(mTemp.getDate() + 1)));

			    $('#date').daterangepicker(
			    {
			    	startDate: minDate,
			    	minDate: minDate,
			    	maxDate: 0,
					singleDatePicker: true,
					showDropdowns: true
			    }
			    );
			});
	</script>
	<script type="text/javascript">
	    $(".form_datetime").datetimepicker({
	        format: "dd MM yyyy - hh:ii",
	        autoclose: true,
	        todayBtn: true,
	        pickerPosition: "bottom-left"
	    });
	</script>  
	<script src="js/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="js/plugins/datetimepicker/bootstrap-datetimepicker.js"></script>
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