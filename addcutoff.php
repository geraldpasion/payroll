<!DOCTYPE html>
<html>

	<head>
		<?php
			 include('menuheader.php');
		?>
		<script type="text/javascript">
		$(function() {
			$('input[name="daterange"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
		});
		</script>

		<title>Add new cutoff</title>
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
			var date = $("#date").val();
			var days = $("#days").val();
	
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'date='+ date + '&days='+ days;
			if(date==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "addcutoffexe.php",
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
				toastr.success('Cutoff added!');
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
								<label class="col-sm-1 control-label">Initial date</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
							</div>
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Number of days</label>
								<div class="col-md-4"><input id = "days" type="text" name = "days" required="" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return numbersonly(this, event)"></div>
							</div>
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