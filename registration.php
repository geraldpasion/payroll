<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Registration</title>
		<style>
			.btn2{
				margin-left:-10.7em;
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
		<script>
		function clearThis(target){
        	target.value= "";
    	}
		$(function() {
			$( ".ename" ).autocomplete({
				source: 'search.php'
					
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
			var date = $("#date").val();
			var empid = $("#empid").val();

			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'date1=' + date + '&empid1=' + empid;
			if(empid==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "adminloanapplicationexe.php",
				data: dataString,
				cache: false,
				success: function(result){
				
				$('#date').val('');
				$('#empid').val('');
			
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
				toastr.success('Successfully applied for loan!');
					}
				});
			}
			return false;
			});
			});
		</script>	
						<script>
				function clearThis(target){
        	target.value= "";
    	}
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Registration</h5>
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
						<form id = "myForm" method = "POST" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label">Cutoff Date</label>
								<div class="col-md-4"><input id = "date" type="text" onfocus="clearThis(this)" onpaste="return false" onDrop="return false"  class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/> </div>
							</div>
								
							<div class="col-md-5"></div>
								<button id ="submit" type="submit" class="btn btn-w-m btn-primary">Submit</button>
								<a href="downloadexcelfile.php" class="btn btn-primary" role="button">Download (.xlsx)</a>
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