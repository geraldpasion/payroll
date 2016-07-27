<!DOCTYPE html>
<html>

	<head>
		<?php
			include('employeemenuheader.php');
		?>
		<title>Payslip</title>
		<style>
			.btn3{
				margin-left:26.5em;
			}
			.btn2{
				margin-left:15.5em;
			}
		</style>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>

	<script type="text/javascript">
		$(function() {
			$('input[name="daterange"]').daterangepicker();
		});
	</script>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Payslip</h5>
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
						<form id = "myForm" method="get" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label">ID</label>
								<div class="col-md-4"><input type="text" class="form-control" value = " <?php echo $_SESSION['logsession'] ?> "disabled = ""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Name</label>
								<div class="col-md-4"><input type="text" class="form-control" disabled = "" value  = "<?php echo $_SESSION['fname'] . " ".  $_SESSION['lname'] ?>"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Date</label>
								<div class="col-md-4"> <input type="text"  class="form-control" name="daterange" value="01/01/2015 - 01/31/2015" /> </div>
							</div>
							<div class="form-group">
								<div class="col-md-4"><button type="button" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
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