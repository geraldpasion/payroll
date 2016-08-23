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
		<script type="text/javascript">
		$(function() {
			$('input[name="daterange"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
		});
		</script>

		<title>Add new holiday</title>
		<style>
			.btn3{
				margin-left:13em;
			}
			.btn2{
				margin-left:-10.8em;
			}
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
		</style>
		<script>	
			$(document).ready(function(){
			$(document).on('submit','#myForm', function() {
			var holidayname = $("#holidayname").val();
			var date = $("#date").val();
			var type = $("#type").val();
			var rate = $("#rate").val();
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'holidayname1='+ holidayname + '&date1='+ date + '&type1=' + type + '&rate1=' + rate;
			if(holidayname==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "addnewholidayexe.php",
				data: dataString,
				cache: false,
				success: function(result){
				$('#success').fadeIn(300).delay(3200).fadeOut(300);
				$('#holidayname').val('');
				$('#date').val('');
				$('#rate').val('');
				$("#type").val($("#type").data("default-value"));
				toastr.options = { 
				"closeButton": true,
				"debug": false,
				"progressBar": true,
				"preventDuplicates": false,
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
				toastr.success('Holiday successfully added!');
					}
				});
			}
			return false;
			});
});
		</script>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	</head>

	<body>
			<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add new holiday</h5>
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
						<form id = "myForm" method="POST" class="form-horizontal">
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Holiday name</label>
								<div class="col-md-4"><input id = "holidayname" onpaste="return false" onDrop="return false" type="text" name = "holidayname" required="" class="form-control"></div>
							</div>
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
							</div>
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Type</label>
								<div class="col-md-4"><select id = "type" name = "type" class = "form-control" data-default-value="Regular" required=""><option selected="true" value = "Regular">Legal</option><option value = "Special">Special</option></select></div>
							</div>
							<!-- <div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Holiday rate</label>
								<div class="col-md-4"><input id = "rate" type="text" name = "rate" required="" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return numbersonly(this, event)"></div>
							</div> -->
							<div class="form-group">
							<div class="col-md-4"></div>
								<div class="col-md-4"><button id = "submit" type="submit" class="btn btn-w-m btn-primary">Submit</button></div>
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