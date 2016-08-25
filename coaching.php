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
		else if(!isset($empLevel)){
			include 'logout.php';
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
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- Clock picker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<title>New Coaching Schedule</title>
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
			var time = $("#timefrom").val();
			var subject = $("#subject").val();
			var trainer = $("#trainer").val();
			var trainee = $("#trainee").val();

			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'date1='+ date + '&time1='+ time + '&subject1=' + subject + '&trainer1=' + trainer + '&trainee1=' + trainee;
			if(trainee==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "coachingexe.php",
				data: dataString,
				cache: false,
				success: function(result){
				$('#success').fadeIn(300).delay(3200).fadeOut(300);
				$('#subject').val('');
				$('#date').val('');
				$('#timefrom').val('');
				$('#trainer').val('');
				$('#trainee').val('');
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
				toastr.success('Coaching schedule successfully added!');
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

		<script>
				function clearThis(target){
        	target.value= "";
    	}
		$(function() {
			$( ".ename" ).autocomplete({
				source: 'search4.php'
			});
						$( ".ename2" ).autocomplete({
				source: 'search2.php'
			});
			
			 $("#trainee").change(function() {                  // When the email is changed
        $('#traineeid').val(this.value);                  // copy it over to the mail
    });
	
		$("#trainer").change(function() {                  // When the email is changed
			$('#trainerid').val(this.value);                  // copy it over to the mail
		});
		$( ".ename" ).autocomplete({
			select: function(e, ui) {  
                 document.getElementById("trainee").focus();
               		}
             });
		
				$( ".ename2" ).autocomplete({
			select: function(e, ui) {  
                 document.getElementById("submit").focus();
               		}
             });
		});
		</script>
	</head>

	<body>
			<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>New Coaching Schedule</h5>
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
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"><input id = "date" type="" onpaste="return false" onDrop="return false"  class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
							</div>
							<div class="form-group">
							<div class="col-md-3"></div>
							<label class="col-sm-1 control-label">Time</label>
							<div class="col-md-4">
									<div class="input-group clockpicker" data-autoclose="true">
										<input type="text" id = "timefrom" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Subject</label>
								<div class="col-md-4"><input id = "subject" type="text" name = "subject" required="" class="form-control" ></div>
							</div>
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Trainer</label>
								<div class="col-md-4"><input id = "trainer" type="text" onfocus="clearThis(this)" name = "trainer" required="" onpaste="return false" onDrop="return false" class="form-control skills2 ename2"></div>
								
							</div>
				
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Trainee</label>
								<div class="col-md-4"><input id = "trainee" type="text" onfocus="clearThis(this)" name = "trainee" onpaste="return false" onDrop="return false" class = "form-control skills ename" required="" class="form-control"></div>
								
							</div><br><br>
							<div class="form-group">
							<div class="col-md-8"></div>
								<button id = "submit" type="submit" class="btn btn-w-m btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
							</div>
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