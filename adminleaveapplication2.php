<!DOCTYPE html>
<html>
	<head>
		<?php
			include('supervisormenuheader.php');
		?>
		<title>Leave Application</title>
		<style>
			.btn3{
				margin-left:6.5em;
			}
			.btn2{
				margin-left:-10em;
			}
						.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
		</style>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange1"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
				$('input[name="daterange2"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
				$('input[name="daterange3"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
				$('input[name="daterange4"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script>
			function clearThis(target){
	        	target.value= "";
	    	}
		</script>
		<script type="text/javascript">
		$(document).ready(function(){
			error=function(){
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
				toastr.error('Already applied leave on that date!');
			}
			history.replaceState({}, "Title", "leaveapplication.php");				
		});
		$(document).ready(function(){
			disable=function(){
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
				toastr.error('Insufficient leave credits!');
			}
			history.replaceState({}, "Title", "leaveapplication.php");				
		});
		$(document).ready(function(){
			success2=function(){
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
				toastr.success('Successfully applied for leave!');
			}
			history.replaceState({}, "Title", "leaveapplication.php");				
		});
		</script>

		<?php
		if(isset($_GET['error']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'error();'
					, '});' 
			   , '</script>'
			;	
		}
		if(isset($_GET['disable']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'disable();'
					, '});' 
			   , '</script>'
			;	
		}
		if(isset($_GET['able']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'success2();'
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
						<h5>Leave Application</h5>
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
							$employee_id = $_SESSION['logsession'];
							$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employee_id'")->fetch_array();	
					?>
						<div id = "success" class="alert alert-success alert-dismissable" style="display: none;">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						   Successfully applied for leave.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								   Please fill all fields.
						</div>
						<form id = "myForm" method="POST" action = "leaveapplicationexe.php" class="form-horizontal">
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">ID</label>
								<div class="col-md-4"><input name = "empid" id = "empid" type="text" class="form-control" value = " <?php echo $employee_id ?> "readonly = "readonly"></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Name</label>
								<div class="col-md-4"><input type="text" id = "name" class="form-control" disabled = "" value  = "<?php echo $_SESSION['fname'] . " ".  $_SESSION['lname'] ?>"></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">PRD Credits</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $result['employee_incentive'] ?> "disabled = ""></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">VL Credits</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $result['employee_vacationleave'] ?> "disabled = ""></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">SL Credits</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $result['employee_sickleave'] ?> "disabled = ""></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">ML Credits</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $result['employee_maternityleave'] ?> "disabled = ""></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">PL Credits</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $result['employee_paternityleave'] ?> "disabled = ""></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">SPL Credits</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $result['employee_singleparentleave'] ?> "disabled = ""></div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Type</label>
								<div class="col-md-4"><select id = "leavetype" name = "leavetype" class = "form-control" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select type...</option><option value = "Leave without pay">Leave without pay</option><option value = "Paid rest day / Incentive">Paid rest day / Incentive</option><option value = "Vacation leave">Vacation leave</option><option value = "Sick leave">Sick leave</option><option value = "Maternity leave">Maternity leave</option><option value = "Paternity leave">Paternity leave</option><option value = "Single-parent leave">Single-parent leave</option></select></div>
							</div>
							<div class='form-group'><div class='col-md-3'></div>
								<label class='col-sm-1 control-label'>Length</label>
								<div class='col-md-4'><select id = 'length' name = 'length' class = 'form-control' data-default-value='Full' required=''><option value = 'Full' selected>Full day leave</option><option value = 'Half'>Half day leave</option></select></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"> <input id = "date" type="text" onfocus="clearThis(this)"  class="form-control" name="daterange1" required="" onKeyPress="return noneonly(this, event)"/> </div>
							
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"> <input id = "date1" type="text" onfocus="clearThis(this)" class="form-control" name="daterange2" onKeyPress="return noneonly(this, event)"/> </div>
							
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"> <input id = "date2" type="text" onfocus="clearThis(this)" class="form-control" name="daterange3" onKeyPress="return noneonly(this, event)"/> </div>
							
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"> <input id = "date3" type="text" onfocus="clearThis(this)"  class="form-control" name="daterange4" onKeyPress="return noneonly(this, event)"/> </div>
							
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Reason</label>
								<div class="col-md-4"><input type="text" id = "reason" name = "reason" class="form-control" required=""></div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-5"><button id = "submit" name = "empleavesub" type="submit" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
								<div class="col-md-4"><button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
							</div>
						</form>


 

					</div>
				</div>
			</div>
        </div>	
		
		<?php
			include('employeemenufooter.php');
		?>
	</body>
</html>