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
			} else {
				include('employeemenuheader.php');
			}
			// this gets the appropriate header for the employee based on their employee level
			// used to avoid creating separate php pages for each employee level (unlike what was done by previous programmers haha)
		?>
		<title>Others Application</title>
		<style>
			.btn2{
				margin-left:-10.7em;
			}
		</style>
		<script type="text/javascript">
		$(function() {
			$('input[name="daterange"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				minDate:0,
				maxDate: new Date() // maximum date fordate range picker should be today
			});
		});
		</script>
		<script>
		function changeAbsent(obj) {
			var index = obj.selectedIndex;
			var val = obj.options[index].value;
		//	alert(val);
			if(val == "Absent") { // disables time inputs and empties their values for an absent case
				document.getElementById('timefrom').disabled=true;
				document.getElementById('breakout').disabled=true;
				document.getElementById('breakin').disabled=true;
				document.getElementById('timeto').disabled=true;
				document.getElementById('timefrom').value="";
				document.getElementById('breakout').value="";
				document.getElementById('breakin').value="";
				document.getElementById('timeto').value="";
			} else if(val == "Present") { // enables time inputs for an present case
				document.getElementById('timefrom').disabled=false;
				document.getElementById('breakout').disabled=false;
				document.getElementById('breakin').disabled=false;
				document.getElementById('timeto').disabled=false;
			}
		}
		</script>
		<script>
		function clearThis(target){
        	target.value= "";
    	}
		$(function() {
			$( ".ename" ).autocomplete({
				source: 'search.php' //for employee name field
					
			});
			$( ".ename" ).autocomplete({
			select: function(e, ui) {  
                 document.getElementById("date").focus();
               		}
             });

		});

		</script>
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- Clock picker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<script type="text/javascript" >//ajax
			$(document).ready(function(){
			$(document).on('submit','#myForm', function() {
			var reason = $("#reason").val();
			var end = $("#timeto").val();
			var start = $("#timefrom").val();
			var breakin = $("#breakin").val();
			var breakout = $("#breakout").val();
			var date = $("#date").val();
			var empid = $("#empid").val();
			var name = $("#name").val();
			var isabsent = $("#isabsent").val();
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'reason1='+ reason + '&end1=' + end + '&start1=' + start + '&date1=' + date + '&empid1=' + empid + '&name1=' + name + '&breakin1=' + breakin + '&breakout1=' + breakout + '&isabsent=' + isabsent;
			// dataString is for additionalpayableapp to get the data needed to be saved to the database
			
			if(reason==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "additionalpayableapp.php", // executes the saving of data to the database
				data: dataString,
				cache: false,
				success: function(result){
				$('#reason').val('');
				$('#date').val('');
				$('#timefrom').val('');
				$('#breakin').val('');
				$('#breakout').val('');
				$('#timeto').val('');
				$('#name').val('');
				//$('#isabsent').val('');
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
				if(result == "Error") { // to be displayed when employee has already applied for the same date
					toastr.error("You already applied for an additional payable on the same date!");
				} else {
					toastr.success('Successfully applied for additional payable!');
				}
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
						<h5>Additional Payable Application</h5>
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
							You have applied for additional payable.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Please fill all fields.
						</div>
						<form id = "myForm" method = "post"  class="form-horizontal">
							<div class="form-group">
								<input type="hidden" id = "empid" name = "empid" class="form-control" value = " <?php echo $_SESSION['logsession'] ?>">
								<label class="col-sm-4 control-label">Employee Name</label>
								<?php
									$employee = $_SESSION['logsession'] . " " . $_SESSION['fname'] . " " . $_SESSION['mname'] . " " . $_SESSION['lname'];
									// for use on employee name field
								?>
								<div class="col-md-4">
									<?php 
										if($empLevel == "3") { // level 3 employees are allowed to submit application of others for any employee
											echo '<input type="text" onfocus="clearThis(this)" id="name" onpaste="return false" onDrop="return false" class="form-control ename">';
										} else { // level 1&2 employees are only allowed to submit own applications therefore search is disabled
											echo '<input type="text" onfocus="clearThis(this)" id="name" onpaste="return false" onDrop="return false" value="'.$employee.'" class="form-control ename" disabled>';
										}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Date</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false"  class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/> </div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Attendance</label>
								<div class='col-md-4'><select id='isabsent' name='isabsent' onchange="changeAbsent(this);" class = 'form-control' required='' data-default-value='z' ><option selected='true' value = 'Present'>Present</option><option value = 'Absent'>Absent</option></select></div>
							</div>
								<div class="form-group">
								<label class="col-sm-4 control-label">Time in</label>
								<div class="col-md-4">
									<div class="input-group clockpicker" data-autoclose="true">
										<input type="text" id = "timefrom" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" onKeyPress="return noneonly(this, event)">
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Out for break</label>
								<div class="col-md-4">
									<div class="input-group clockpicker" data-autoclose="true">
										<input id = "breakout" type="text" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" onKeyPress="return noneonly(this, event)" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>
                            	</div>
                            </div>
                            <div class="form-group">
								<label class="col-sm-4 control-label">In from break</label>
								<div class="col-md-4">
									<div class="input-group clockpicker" data-autoclose="true">
										<input id = "breakin" type="text" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" onKeyPress="return noneonly(this, event)" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>
                            	</div>
                            </div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Time out</label>
								<div class="col-md-4">
									<div class="input-group clockpicker" data-autoclose="true">
										<input id = "timeto" type="text" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" onKeyPress="return noneonly(this, event)" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>
                            </div>
							</div>
								<div class="form-group">
								<label class="col-sm-4 control-label">Reason</label>
								<div class="col-md-4"><input id = "reason"  onpaste="return false" onDrop="return false" name = "reason" type="text" class="form-control" required="" placeholder = "Type your reason here..."></div>
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
		if($empLevel == "3") {
			include('menufooter.php');
		} else {
			include('employeemenufooter.php');
		}
		?>
	</body>
</html>