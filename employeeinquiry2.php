<!DOCTYPE html>
<html>
	<head>
		<?php
			include('supervisormenuheader.php');
		?>
		<title>Employee Inquiry</title>
		<style>
			.btn1{
				margin-left:26.4em;
			}
			.btn2{
				margin-left:-10.7em;
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript" >//ajax
			$(document).ready(function(){
			$(document).on('submit','#myForm', function() {
			var empid = $("#empid").val();
			var question = $("#question").val();
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'question1='+ question + '&empid1='+ empid;
			if(question==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "employeeinquiryexe2.php",
				data: dataString,
				cache: false,
				success: function(result){
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
				toastr.success('Your inquiry has been sent!');
				$('#question').val('');
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
						<h5>Employee inquiry</h5>
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
								   Your inquiry has been sent.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								   Please fill all fields.
						</div>
						<form id = "myForm" method="POST"  class="form-horizontal">
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-2 control-label">Employee ID</label>
								<input type="hidden" id = "empid" name = "empid" class="form-control" value = " <?php echo $_SESSION['logsession'] ?>">
								<div class="col-md-4"><input type="text" name = "" class="form-control" value = " <?php echo $_SESSION['logsession'] ?>" disabled></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-2 control-label">Employee name</label>
								<div class="col-md-4"><input type="text" class="form-control" value  = "<?php echo $_SESSION['fname'] . " ".  $_SESSION['lname'] ?>" disabled = ""></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-2 control-label">Questions</label>
								<div class="col-md-4"><input type="text" id = "question" name = "question" class = "form-control" required= "" placeholder = "Input your questions here." style="height:100px;"></div>
							</div>
							<div class="form-group">
								<div class="col-md-4"></div>
								<div class="col-md-4">
								<button type="submit" id = "submit" class="btn btn-w-m btn-primary">Submit</button></div>
								<div class="col-md-4"><button type="submit" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
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