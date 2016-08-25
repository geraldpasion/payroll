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
		?>
		<title>Overtime Application</title>
	<style>
				.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
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



		<!-- Clock picker -->

		<script type="text/javascript" >//ajax
			$(document).ready(function(){
			$(document).on('submit','#myForm', function() {
			var reason = $("#reason").val();
			var end = $("#timeto").val();
			var start = $("#timefrom").val();
			var date = $("#date").val();
			var empid = $("#empid").val();
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'reason1='+ reason + '&end1=' + end + '&start1=' + start + '&date1=' + date + '&empid1=' + empid;
			if(reason==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "overtimeapplicationexe.php",
				data: dataString,
				cache: false,
				success: function(result){
				$('#reason').val('');
				$('#date').val('');
				$('#timefrom').val('');
				$('#timeto').val('');
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
				toastr.success('Successfully applied for overtime	!');
					}
				});
			}
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
						<h5>Overtime Application</h5>
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
						<div id = "success" class="alert alert-success alert-dismissable" style="display: none;">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							You have applied for overtime.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Please fill all fields.
						</div>
						<form id = "myForm" method = "post"  class="form-horizontal">
													<div class="form-group">
								<input type="hidden" id = "empid" name = "empid" class="form-control" value = " <?php echo $_SESSION['logsession'] ?>">
								<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Employee ID</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $_SESSION['logsession'] ?>" disabled = ""></div>
							</div>
	
										<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Reason</label>
								<div class="col-md-4"><input id = "reason" name = "reason" type="text" class="form-control" required="" placeholder = "Type your reason here..."></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control datepicker" name="daterange" required="" onKeyPress="return noneonly(this, event)"/> </div>
							
							</div>
								<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Time from</label>
								<div class="col-md-4">
									
										<input type="text" id = "timefrom" name="timefrom" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" onKeyPress="return noneonly(this, event)">
								
									
								</div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Time to</label>
								<div class="col-md-4">
										<input id = "timeto" type="text" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" onKeyPress="return noneonly(this, event)" >
							
                            </div>
							</div>
							
							<div class="col-md-4"></div>
								<button id ="submit" type="submit" class="btn btn-w-m btn-primary">Submit</button>
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
	$('.timepicker2').timepicki();
    </script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/timepicki.css" rel="stylesheet">
		<?php
			//include('employeemenufooter.php');
			include('menufooter.php');
		?>
	</body>
</html>