<!DOCTYPE html>
<html>
	<head>
		<?php
		 include('menuheader.php');
		?>
		<title>Payroll Factor Settings</title>
		<style>
			.btn3{
				margin-left:6.5em;
			}
			.btn2{
				margin-left:-10em;
			}
		</style>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		<script type="text/javascript" >//ajax
			$(document).ready(function(){
			$(document).on('submit','#myForm', function() {
			var leavetype = $("#leavetype").val();
	

			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'leavetype1=' + leavetype;
			if(reason==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "payrollfactorexe.php",
				data: dataString,
				cache: false,
				success: function(result){
				$("#leavetype").val($("#leavetype").data("default-value"));
				$("#leavetype1").val($("#leavetype1").data("default-value"));
				$("#leavetype2").val($("#leavetype2").data("default-value"));
				$("#leavetype3").val($("#leavetype3").data("default-value"));
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
				toastr.success('Successfully applied!');
				
				
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
						<h5>Payroll Factor Settings</h5>
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
					?>
						<div id = "success" class="alert alert-success alert-dismissable" style="display: none;">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						   Successfully applied.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								   Please fill all fields.
						</div>
						<form id = "myForm" method="POST" action = "payrollfactorexe.php" class="form-horizontal">
							
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Payroll Factor Type</label>
								<div class="col-md-4"><select id = "leavetype" class = "form-control" name="leavetype" data-default-value="z" required=""><option selected="true" disabled="disabled" value = "z">Select type...</option><option value = "261">261 - Total Number of days/year</option><option value = "313">313 - Total Number of days/year</option><option value = "365">365 - Total Number of days/year</option><option value = "392.5">392.5 - Total Number of days/year</option></select></div>
							</div><br><br>
							<div class="form-group">
								<?php
								$payroll_factor = $mysqli->query("SELECT * FROM payrollfactor")->fetch_object();
								$factor = $payroll_factor->factor;
								echo '<label class="col-sm-4 control-label">Payroll Factor Value:</label>
								<input type="text" class="col-md-4" style="border:none" readonly="" value='.$factor.'>';
								?>
							</div>
							
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-5"><button id = "submit" type="submit" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
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