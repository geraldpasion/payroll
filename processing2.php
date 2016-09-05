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
		<title>Employee list</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<style>
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			input{
			border: none;
			border-color: transparent;
				
			}
			
			.zx{
			border: none;
			border-color: transparent;
			margin-top:2.4%;
			font-size:1em;
			cursor:default;
			}
						.zxc{
			border: none;
			border-color: transparent;
			margin-top:1%;
			font-size:1em;
			cursor:default;
			}
		</style>
				
		<script>
		  /*var loadFile = function(event) {
		    var reader = new FileReader();
		    reader.onload = function(){
		      var output = document.getElementById('output');
		      output.src = reader.result;
		    };
		    reader.readAsDataURL(event.target.files[0]);
		  };*/
		</script>							
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- Clock picker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange2"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange3"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<!--<script type="text/javascript">
			$(document).ready(function(){
			  refreshTable();
			});
				$('#tableHolderz').load('getemployeetable.php', function(){
				   setTimeout(refreshTable, 1000);
				});
		</script>-->             
		<script type="text/javascript">
			$(document).ready(function() {
				$('#tab-2').click(function() {
					$(this).removeClass('tab-pane active');
					$('#tab-1').removeClass('tab-pane active');
				});
				$('#tab-1').click(function() {
					$(this).removeClass('tab-pane active');
				});
			});
		</script>
		<script type="text/javascript">
			$(document).on("click", ".editempdialog", function () {
			 var employeeid = $(this).data('employee-id');			
			 var cutoffd = $(this).data('cutoffd');
			 var submitdate = $(this).data('submitdate');
			 
			 $.ajax({
	            url: "edit_modal.php",
	            method: "POST",
	            data:{
			       empid: employeeid,
			       cutoff: cutoffd,
			       submit: submitdate
			    },
	            success: function(data) {
	                $('#edit_modal').html(data);
	            }
	        });
			
			});
		</script>
		<script type="text/javascript">
			$(document).on("click", ".viewempdialog", function () {
			var employeeid = $(this).data('employee-id');			
			var cutoffd = $(this).data('cutoffd');
			var submitdate = $(this).data('submitdate');

			$.ajax({
	            url: "processing_modal.php",
	            method: "POST",
	            data:{
			       empid: employeeid,
			       cutoff: cutoffd,
			       submit: submitdate
			    },
	            success: function(data) {
	                $('#process_modal').html(data);
	            }
	        });
			
			});
		</script>
		
		<?php $employee = "<script>document.write(employeeid)</script>"?>
		<?php
			if(isset($_GET['deactivated']))
			{
				echo '<script type="text/javascript">'
				   , 'alertFunction();'
				   , '</script>'
				;	
			}
		?>
		<script type="text/javascript">//ajax
			/*$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var employee_id = element.attr("id");
			var status = document.getElementById('proc_status' + employee_id).innerText;
			var cutoff = element.attr("cutoff");
			var info = 'employee_id1=' + employee_id + "&cutoff1=" + cutoff;

			if(status == "Approved") {
				$.ajax({
				   type: "POST",
				   url: "deactivateemployee.php",
				   data: info,
				   success: function(){
				 }
				});
				  $(this).parents(".josh").remove();
				 $('#success').fadeIn(300).delay(3200).fadeOut(300);
				 $(window).scrollTop(0);
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
					toastr.success('Employee successfully deactivated!');
				} else {
					swal({  title: "Cannot Submit",   text: "Employee still has pending status",   timer: 3000, type: "warning",   showConfirmButton: false});
				}
						 
			 
			return false;
			});
			});*/
		</script>
		<script type="text/javascript" >//ajax	
			$(document).ready(function(){
			$(document).on('submit','#form1', function() {
				var check = true;
				var cutoffd = document.getElementById('cutoff').value;

				$(this).find('td[name=proc_status]').each(function(){
					if($(this).html() == 'Pending'){
						swal({  title: "Cannot Submit",   text: "There are entries with pending status",   timer: 3000, type: "warning",   showConfirmButton: false});
							check = false;
							return false;
					}
				});
				if(check == true) {
					var dataString = "cutoff=" + cutoffd;
					/// AJAX Code To Submit Form.
					$.ajax({
						type: "POST",
						url: "processingexe.php",
						data: dataString,
						cache: false,
						success: function(result){
							//eval(result);
							//alert(result);
							swal({
								title: "SUCCESS",
								text: "Processing Submitted",
								timer: 1000, 
								type: "success",
								showConfirmButton: false
							});
							window.setTimeout(function(){location.reload();}, 1000);
						}
					});
				}
			return false;
			});
			});
		</script>
		
		<script type="text/javascript">
			$(document).ready(function(){
			showEdited=function(cutoff){
			
			//history.replaceState({}, "Title", "processing2.php");
			var info = "cutoff="+cutoff+"&test1";
			$.ajax({
				   type: "POST",
				   url: "processing2.php",
				   async: false,
				   data: info,
				   success: function(){
				   		$("#leavetype").val( cutoff );

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
						toastr.success("Employee successfully edited!");
					}
				});

			}

			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
			paidSuccess=function(){
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
				toastr.success("Successfully removed!");
			}
			//history.replaceState({}, "Title", "registration.php");

			});
			$(document).ready(function(){
				showEdited2=function(){
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
					toastr.success("Processing successfully submitted!");
				}
			});
			//history.replaceState({}, "Title", "registration.php");
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
				toastr.error('!');
			}
			history.replaceState({}, "Title", "processing2.php");				
		});
		</script>
		<?php
		if(isset($_GET['edited']))
		{
			$cutoff = $_GET['cutoff'];
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited("'.$cutoff.'");'
					, '});' 
			   
			   , '</script>'
			;	
		}
		if(isset($_GET['paidSuccess']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'paidSuccess();'
					, '});' 
			   
			   , '</script>'
			;	
		}

		if(isset($_GET['submitted']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited2();'
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
		?>
		<script type="text/javascript" >//ajax	
			/*$('#editsub').click(function(){
						
						var empid = $('#empid').val();
						var actionsel = $('#actionsel').val();
						var earndeduct = $('#earndeduct').val();
						var type = $('#type').val();
						var amount = $('#amount').val();
						var particularsel = $('#particularsel').val();
						var cutsel = $('#cutsel').val();
						var fromdate = $('#fromdate').val();
						var todate = $('#todate').val();
						var dataString = "empid="+empid;
						/// AJAX Code To Submit Form.
						$.ajax({
							type: "POST",
							url: "editprocessing.php",
							//data: dataString,
							//cache: false,
							success: function(result){
								eval(result);
								}
						});
					
			});*/
		</script>
		<script src="js/keypress.js"></script>


	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Processing</h5>
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
						<div class="form-group">
							<div class="col-md-3"></div>
							<form method="POST" action="processing2.php" id="formcut">
								<label class="col-sm-1 control-label">Cut Off</label>
								<div class="col-md-4">
									<select id = "leavetype" class="form-control"  data-default-value="z" name="sched" required="">
									<?php 
									include('dbconfig.php');

									if ($result1 = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_submission = 'Submitted' AND process_submission != 'Submitted'")) //get records from db
										{
											if ($result1->num_rows > 0) //display records if any
											{
												if(isset($_POST['test1'])){
													$selection = $_POST['sched']; 
													$cutarray = array();
													$cutarray = split(" - ", $selection);
													$initialcut = $cutarray[0];
													$endcut = $cutarray[1];
													echo '<option value="'.$initialcut." - ".$endcut."\">".date("F d, Y",strtotime($initialcut)).' - ';
													echo date("F d, Y",strtotime($endcut)).'</option>';
												}else{
													//$newDateFilter = ''; 
													echo '<option value=""> Select Cutoff &nbsp;&nbsp;(Month-Day-Year) </option>';
												}
												while ($row1 = mysqli_fetch_object($result1)){
													$initial = $row1->cutoff_initial;
													$end = $row1->cutoff_end;
													$cutoffsubmitdate = $row1->cutoff_submitdate;

													echo '<option value="'.$initial." - ".$end."\">".date("F d, Y",strtotime($initial)).' - ';
													echo date("F d, Y",strtotime($end)).'</option>';
												}
											}
										}
									?>
									</select>
								</div>
								<button type="submit" name="test1" id="test1" class="btn btn-w-m btn-primary">Validate</button>
							</form>
						</div>
						<br><br><br><br>
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
					</div>
					<div class="ibox-content" id = "tableHolderz">
						<?php
							include('dbconfig.php');
								if(isset($_POST['test1'])){
									
								if ($result1 = $mysqli->query("SELECT * FROM employee INNER JOIN emp_cutoff ON employee.employee_id = emp_cutoff.employee_id WHERE emp_cutoff.empcut_initial='$initialcut' AND emp_cutoff.empcut_end = '$endcut' AND employee_status='active' AND emp_cutoff.status='done'")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo '<form method="POST" action = "processingexe.php"  class="form-horizontal" id="form1"><input type="hidden" value="$selection" name="cutsel" id="cutsel">';
										echo '<input type="hidden" value="'.$initialcut . ' - ' . $endcut.'" name="cutoff" id="cutoff">';
										echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>ID</th>";
										echo "<th>Name</th>";
										echo "<th>Department</th>";
										echo "<th>Shift Type</th>";
										echo "<th>Payment Schedule</th>";
										echo "<th>Status</th>";
										echo "<th style='text-align:center'>Action</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tfoot>";                    
										echo "<tr>";
										echo "<td colspan='7'>";
										echo "<ul class='pagination pull-right'></ul>";
										echo "</td>";
										echo "</tr>";
										echo "</tfoot>";
										while ($row1 = mysqli_fetch_object($result1))
										{
											$empid = $row1->employee_id;
											$shiftstart = substr($row1->employee_shift,0,5);
											$shiftstart = date("g : i : A",strtotime($shiftstart));
											$shiftend = substr($row1->employee_shift,6,10);
											$shiftend = date("g : i : A",strtotime($shiftend));
											$restdayArray = array();
											$restdayArray = split('/', $row1->employee_restday);

											$status = $mysqli->query("SELECT process_status FROM total_comp_salary WHERE employee_id = '".$empid."' AND cutoff = '".$initialcut." - ".$endcut."'")->fetch_object();
											echo "<tr class = 'josh'>";
											echo "<td>" . $row1->employee_id . "</td>";
											echo "<td><a href='#' data-toggle='modal'
														data-employee-id='$empid'										
														data-cutoffd='".$initialcut." - ".$endcut."'
														data-submitdate='".$cutoffsubmitdate."'
														data-target='#myModal2' class = 'viewempdialog'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
											echo "<td>" . $row1->employee_department . "</td>";
											echo "<td>" . $row1->employee_type . "</td>";
											echo "<td>" . $row1->cutoff . "</td>";
											echo "<td name='proc_status' id='proc_status".$row1->employee_id."'>" . $status->process_status . "</td>";
											echo "<td style='text-align:center'><a href='#' data-toggle='modal' 
													data-employee-id='$empid' 												
													data-cutoffd='".$initialcut." - ".$endcut."'
													data-submitdate='".$cutoffsubmitdate."'
													data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' id='edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
											echo "<a href='finalpayexe.php?emp_id=".$row1->employee_id."' id='$empid' cutoff='".$initialcut." - ".$endcut."' class = 'delete'><button id='payment' class='btn btn-warning' type='button'><i class='fa fa-warning'></i> For Back Pay</button></button></a>";											
											echo "</tr>";
										}									
										echo "</table>";
									}
								}
							}							
						?>
						<div class="col-sm-5"></div>								
						<div class="col-sm-3">
							<button id="subproc" type="submit" name="subproc" class="btn btn3 btn-w-m btn-primary">Submit</button>
						</div><br><br>
					</div>
				</div>
			</div>
        </div>
        </form>
		
			<?php
				//include("processing_modal.php");
			?>
	<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="edit_modal">

			</div>
		</div>
	</div>	
	<div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="process_modal">

			</div>
		</div>
	</div>
	<div id="displaysomething"></div>		

	<script type="text/javascript">
    $(function() {
        $('#particularsel').keyup(function() {
            if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
            }
        });
    });
</script>
	<script>
		$( "#edit" ).click(function() {
			$("#actionsel").val("New");
			$("#type").val("");
			$("#amount").val("");
			$("#tonew").val("");
			$("#earndeduct").val("");
			$("#partinp").replaceWith("<div class='col-md-4' id='partinp'><select id = 'particularsel' name = 'particularsel' type='text' class='form-control' required></select></div>");
			$("#particularsel").load("filter.php?choice=New");
		});
	</script>	
	
		<script src="js/jquery.min.js"></script>
		<script src="js/timepicki.js"></script>
		<script>
		$('.timepicker1').timepicki();
		</script>
		 <script>
		$('.timepicker2').timepicki();
		</script>
		<link href="css/timepicki.css" rel="stylesheet">
		<?php
			include('menufooter.php');
		?>


		<script type="text/javascript">

		</script>
		<script>
			jQuery(function(){
			   jQuery('#test1').click();
			});
		</script>

	</body>

</html>