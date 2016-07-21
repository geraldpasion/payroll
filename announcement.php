<!DOCTYPE html>
<html>
	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Post announcement</title>
		<style>
			.btn1{
				margin-left:26.4em;
			}
			.btn2{
				margin-left:-10.7em;
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
			var announcement = $("#announcement").val();
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'announcement1='+ announcement;
			if(announcement==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "announcementexe.php",
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
				toastr.success("Successfully posted announcement!");
				$('#announcement').val('');
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
						<h5>Announcements</h5>
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
								   Your inquiry has been sent. <a class="alert-link" href="#">Alert Link</a>.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								   Please fill all fields. <a class="alert-link" href="#">Alert Link</a>.
						</div>
						<form id = "myForm" method="POST"  class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label">Announcements</label>
								<div class="col-md-4"><textarea id = "announcement" name = "announcement" class = "form-control" required = "" placeholder = "Input your announcement here."></textarea></div>
							</div>
							<div class="form-group">
								<div class="col-md-4"></div>
								<div class="col-md-4">
								<button type="submit" id = "submit" class="btn btn-w-m btn-primary">Submit</button></div>
								<div class="col-md-4"><button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>