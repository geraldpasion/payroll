<!DOCTYPE html>
<html>
	<head>
		<?php
			 include('menuheader.php');
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
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
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
			 var lastname = $(this).data('lastname');
			 var firstname = $(this).data('firstname');
			 var middlename = $(this).data('middlename');
			 var gender = $(this).data('gender');
			 var birthday = $(this).data('birthday');
			 var marital = $(this).data('marital');
			 var address = $(this).data('address');
			 var city = $(this).data('city');
			 var zip = $(this).data('zip');
			 var email = $(this).data('email');
			 var cellnum = $(this).data('cellnum');
			 var employeetype = $(this).data('employeetype');
			 var employeestatus = $(this).data('employeestatus');
			 var jobtitle = $(this).data('jobtitle');
			 var department = $(this).data('department');
			 var rate = $(this).data('rate');
			 var taxcode = $(this).data('taxcode');
			 var sss = $(this).data('sss');
			 var philhealth = $(this).data('philhealth');
			 var pagibig = $(this).data('pagibig');
			 var tin = $(this).data('tin');
			 var shift = $(this).data('shift');
			 var shift2 = $(this).data('shift2');
			 var datehired = $(this).data('datehired');
			 var restday = $(this).data('restday');
			 var restday2 = $(this).data('restday2');
			 var password = $(this).data('password');
			 var sickleave = $(this).data('sickleave');
			 var vacationleave = $(this).data('vacationleave');
			 var status = $(this).data('status');
			 var jobtitle = $(this).data('jobtitle');
			 var level = $(this).data('level');
			 var team = $(this).data('team');
			 var imgss = "images/"+$(this).data('im');

			 document.getElementById("output").src = imgss;
			 

			 $(".modal-body #output").val( imgss );
			 $(".modal-body #empid").val( employeeid );
			 $(".modal-body #lastname").val( lastname );
			 $(".modal-body #firstname").val( firstname );
			 $(".modal-body #middlename").val( middlename );
			 $(".modal-body #gender").val( gender );	
			 $(".modal-body #birthday").val( birthday );	
			 $(".modal-body #marital").val( marital );	
			 $(".modal-body #address").val( address );	
			 $(".modal-body #city").val( city );	
			 $(".modal-body #zip").val( zip );	
			 $(".modal-body #email").val( email );	
			 $(".modal-body #cellnum").val( cellnum );	
			 $(".modal-body #employeetype").val( employeetype );
			 $(".modal-body #employeestatus").val( employeestatus );		
			 $(".modal-body #jobtitle").val( jobtitle );	
			 $(".modal-body #department").val( department );	
			 $(".modal-body #rate").val( rate );	
			 $(".modal-body #taxcode").val( taxcode );	
			 $(".modal-body #sss").val( sss );	
			 $(".modal-body #philhealth").val( philhealth );	
			 $(".modal-body #pagibig").val( pagibig );	
			 $(".modal-body #tin").val( tin );	
			 $(".modal-body #shift").val( shift );	
			 $(".modal-body #shift2").val( shift2 );	
			 $(".modal-body #datehired").val( datehired );	
			 $(".modal-body #restday").val( restday );	
			 $(".modal-body #restday2").val( restday2 );
			 $(".modal-body #password").val( password );	
			 $(".modal-body #sickleave").val( sickleave );	
			 $(".modal-body #vacationleave").val( vacationleave );	
			 $(".modal-body #status").val( status );	
			 $(".modal-body #jobtitle").val( jobtitle );
			 $(".modal-body #level").val( level );
			 $(".modal-body #team").val( team );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   
			
			});
			<?php $employee = "<script>document.write(employeeid)</script>"?>
		</script>
		<script type="text/javascript">
			$(document).on("click", ".viewempdialog", function () {
			 var employeeid = $(this).data('employee-id');
			 var lastname = $(this).data('lastname');
			 var firstname = $(this).data('firstname');
			 var middlename = $(this).data('middlename');
			 var gender = $(this).data('gender');
			 var birthday = $(this).data('birthday');
			 var marital = $(this).data('marital');
			 var address = $(this).data('address');
			 var city = $(this).data('city');
			 var zip = $(this).data('zip');
			 var email = $(this).data('email');
			 var cellnum = $(this).data('cellnum');
			 var employeetype = $(this).data('employeetype');
			 var employeestatus = $(this).data('employeestatus');
			 var jobtitle = $(this).data('jobtitle');
			 var department = $(this).data('department');
			 var rate = $(this).data('rate');
			 var taxcode = $(this).data('taxcode');
			 var sss = $(this).data('sss');
			 var philhealth = $(this).data('philhealth');
			 var pagibig = $(this).data('pagibig');
			 var tin = $(this).data('tin');
			 var shift = $(this).data('shift');
			 var datehired = $(this).data('datehired');
			 var restday = $(this).data('restday');
			 var password = $(this).data('password');
			 var sickleave = $(this).data('sickleave');
			 var vacationleave = $(this).data('vacationleave');
			 var status = $(this).data('status');
			 var team = $(this).data('team');
			 var level = $(this).data('level');
			 var cutoffd = $(this).data('cutoffd');
			 
			 
			 $(".modal-body #empid").val( employeeid );
			 $(".modal-body #lastname").val( lastname );
			 $(".modal-body #firstname").val( firstname );
			 $(".modal-body #middlename").val( middlename );
			 $(".modal-body #gender").val( gender );	
			 $(".modal-body #birthday").val( birthday );	
			 $(".modal-body #marital").val( marital );	
			 $(".modal-body #address").val( address );	
			 $(".modal-body #city").val( city );	
			 $(".modal-body #zip").val( zip );	
			 $(".modal-body #email").val( email );	
			 $(".modal-body #cellnum").val( cellnum );	
			 $(".modal-body #employeetype").val( employeetype );
			 $(".modal-body #employeestatus").val( employeestatus );	
			 $(".modal-body #jobtitle").val( jobtitle );	
			 $(".modal-body #department").val( department );	
			 $(".modal-body #rate").val( rate );	
			 $(".modal-body #taxcode").val( taxcode );	
			 $(".modal-body #sss").val( sss );	
			 $(".modal-body #philhealth").val( philhealth );	
			 $(".modal-body #pagibig").val( pagibig );	
			 $(".modal-body #tin").val( tin );	
			 $(".modal-body #shift").val( shift );	
			 $(".modal-body #datehired").val( datehired );	
			 $(".modal-body #restday").val( restday );		
			 $(".modal-body #password").val( password );	
			 $(".modal-body #sickleave").val( sickleave );	
			 $(".modal-body #vacationleave").val( vacationleave );	
			 $(".modal-body #status").val( status );	
			 $(".modal-body #team").val( team );
			 $(".modal-body #level").val( level );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   

			$.ajax({
	            url: "processing_modal.php",
	            method: "POST",
	            data:{
			       empid: employeeid,
			       cutoff: cutoffd
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
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var employee_id = element.attr("id");
			var info = 'employee_id1=' + employee_id;
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
			 
			return false;
			});
			});
		</script>
		
		<script type="text/javascript">
			$(document).ready(function(){
			showEdited=function(){
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
			history.replaceState({}, "Title", "processing2.php");
			});
		</script>
		<?php
		if(isset($_GET['edited']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited();'
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
							<form method="POST" action="processing2.php">
								<label class="col-sm-1 control-label">Cut Off</label>
								<div class="col-md-4">
									<select id = "leavetype" class="form-control"  data-default-value="z" name="sched" required="">
									<?php 
									include('dbconfig.php');

									if ($result1 = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_submission = 'Submitted'")) //get records from db
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

													echo '<option value="'.$initial." - ".$end."\">".date("F d, Y",strtotime($initial)).' - ';
													echo date("F d, Y",strtotime($end)).'</option>';
												}
											}
										}
									?>
									</SELECT>
								</div>
								<button type="submit" name="test1" class="btn btn-w-m btn-primary">Validate</button>
							</form>
						</div>
						<br><br><br><br>
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
					</div>
					<div class="ibox-content" id = "tableHolderz">
						<?php
							include('dbconfig.php');
								if(isset($_POST['test1'])){
									
								if ($result1 = $mysqli->query("SELECT * FROM employee INNER JOIN emp_cutoff ON employee.employee_id = emp_cutoff.employee_id WHERE emp_cutoff.empcut_initial='$initialcut' AND emp_cutoff.empcut_end = '$endcut'")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo '<form method="POST" action = "editprocessing.php"  class="form-horizontal"><input type="hidden" value="$selection" name="cutsel" id="cutsel">';
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>ID</th>";
										echo "<th>Name</th>";
										echo "<th>Department</th>";
										echo "<th>Status</th>";
										echo "<th>Action</th>";
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
											echo "<tr class = 'josh'>";
											echo "<td>" . $row1->employee_id . "</td>";
											echo "<td><a href='#' data-toggle='modal'
														data-employee-id='$empid' 
														data-lastname='$row1->employee_lastname' 
														data-firstname='$row1->employee_firstname' 
														data-middlename='$row1->employee_middlename' 
														data-gender='$row1->employee_gender' 
														data-birthday='$row1->employee_birthday' 
														data-marital='$row1->employee_marital' 
														data-address='$row1->employee_address' 
														data-city='$row1->employee_city' 
														data-zip='$row1->employee_zip' 
														data-email='$row1->employee_email' 
														data-cellnum='$row1->employee_cellnum' 
														data-employeetype='$row1->employee_type'
														data-employeestatus='$row1->employee_status' 
														data-department='$row1->employee_department' 
														data-rate='$row1->employee_rate' 
														data-taxcode='$row1->employee_taxcode'  
														data-sss='$row1->employee_sss' 
														data-philhealth='$row1->employee_philhealth' 
														data-pagibig='$row1->employee_pagibig' 
														data-tin='$row1->employee_tin' 
														data-shift='".$shiftstart." - ".$shiftend."' 
														data-datehired='$row1->employee_datehired' 
														data-restday='$row1->employee_restday' 
														data-jobtitle='$row1->employee_jobtitle' 
														data-password='$row1->employee_password' 
														data-level='$row1->employee_level' 
														data-team='$row1->employee_team'  
														data-cutoffd='".$initialcut." - ".$endcut."'

											data-target='#myModal2' class = 'viewempdialog'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
											echo "<td>" . $row1->employee_department . "</td>";
											echo "<td>" . $row1->employee_department . "</td>";
											echo "<td><a href='#' data-toggle='modal' 
													data-employee-id='$empid' 
													data-lastname='$row1->employee_lastname' 
													data-firstname='$row1->employee_firstname' 
													data-middlename='$row1->employee_middlename' 
													data-gender='$row1->employee_gender' 
													data-birthday='$row1->employee_birthday' 
													data-marital='$row1->employee_marital' 
													data-address='$row1->employee_address' 
													data-city='$row1->employee_city' 
													data-zip='$row1->employee_zip' 
													data-email='$row1->employee_email' 
													data-cellnum='$row1->employee_cellnum' 
													data-employeetype='$row1->employee_type'
													data-employeestatus='$row1->employee_status'  
													data-department='$row1->employee_department' 
													data-rate='$row1->employee_rate' 
													data-taxcode='$row1->employee_taxcode'  
													data-sss='$row1->employee_sss' 
													data-philhealth='$row1->employee_philhealth' 
													data-pagibig='$row1->employee_pagibig' 
													data-tin='$row1->employee_tin' 
													data-shift='$shiftstart' 
													data-shift2='$shiftend' 
													data-datehired='$row1->employee_datehired' 
													data-restday='".$restdayArray[0]."' 
													data-restday2='".$restdayArray[1]."' 
													data-jobtitle='$row1->employee_jobtitle' 
													data-password='$row1->employee_password' 
													data-level='$row1->employee_level' 
													data-team='$row1->employee_team' 
													data-im='$row1->image'
													data-cutoff='".$initialcut." - ".$endcut."'													
													data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
											echo "<a href='#' id='$empid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Deactivate</button></button></a>";											
											echo "</tr>";
										}									
										echo "</table>";
									}
								}
							}							
						?>
						<div class="col-sm-9"></div>								
						<div class="col-sm-3">
							<div class="col-md-5"><button id="submit" type="submit" name="subproc" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
						</div>
					</form>
					</div>
				</div>
			</div>
        </div>
		


	<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<?php
					//$q = mysqli_query("SELECT * FROM employee WHERE employee_id = '$empid");
					$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
					$res = $mysqli->query("SELECT * FROM employee");
				?>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Edit information</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						
						<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<!-- <li class="active"><a data-toggle="tab" href="#editinfo">Information</a></li> -->
								<li class="active"><a data-toggle="tab" href="#newedit">Earning and Deductions</a></li>
								<li class=""><a data-toggle="tab" href="#earn">Earnings Summary</a></li>
								<li class=""><a data-toggle="tab" href="#deduct">Deductions Summary</a></li>
							</ul>
							<div class="tab-content">
								<div id="newedit" class="tab-pane fade active in" >
									<div class="panel-body">
										<form method="POST" action = "editprocessing.php"  class="form-horizontal">
										<input type="hidden" value="<?php echo $empid; ?>" name="empid" id="empid"/>
										<input type="hidden" value="<?php echo $selection;?>" name="cutsel" id="cutsel">
										<div class="form-group">
											<label class="col-sm-3 control-label">New/Edit</label>
												<div class="col-sm-4"><select class = "form-control" id = "actionsel" name = "actionsel" onchange="filter_action(this.value)" required="" ><option value = "New">New</option><option value = "Edit">Edit</option></select></div>
												<br><br><br>
											<label class="col-sm-3 control-label">Earnings/Deductions</label>
												<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" onchange="filter_ed(this.value)" required="" ><option value = ""></option><option value = "Earnings">Earnings</option><option value = "Deductions">Deductions</option></select></div>
												<br><br><br>
											<label class="col-sm-3 control-label">Type</label>
												<div class="col-sm-4"><select class = "form-control" id = "type" name = "type" onchange="filter_type(this.value)" required="" ><option value = ""></option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
												<br><br><br>
											<!-- <label class="col-sm-3 control-label">Recurrence</label>
												<div class="col-sm-4"><select class = "form-control" id = "recurrence" name = "recurrence" required="" ><option value = ""></option><option value = "Once">Once</option><option value = "Multiple">Multiple</option></select></div>
												<br><br><br> -->
											<label class="col-sm-3 control-label">Particular</label>
												<div class="col-md-4" id="partinp" style="display:block;"><input id = "particularsel" name = "particularsel" onkeyup="" type="text" class="form-control"></div>
												<div class="col-md-4" id="partsel" style="display:none;"><select id = "particularsel" name = "particularsel" onchange="" type="text" class="form-control"></select></div>
												<br><br><br>								
											<label class="col-sm-3 control-label">Amount</label>
												<div class="col-md-4"><input id = "amount" name = "amount" type="text" class="form-control" onkeyup="filter_amount(this.value)" placeholder="Enter Amount" onKeyPress="return numbersonly(this, event)" required></div>
												<br><br><br>
											<label class="col-sm-3 control-label">From</label>
												<div class="col-md-4" id="frmnew" style="display:block;"><input type="text" id = "fromdate" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" value="<?php echo $initialcut; ?>" readonly></div>
												<div class="col-md-4" id="frmedit" style="display:none;"><input type="text" id = "fromdate" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required=""></div>
											<br><br><br>
												<label class="col-sm-3 control-label">To</label>
												<div class="col-md-4" id="tonew" style="display:block;"><input type="text" id = "todate" onpaste="return false" onDrop="return false" class="form-control" name="daterange3" placeholder="click to pick date (optional)"></div>
												<div class="col-md-4" id="toedit" style="display:none;"><input type="text" id = "todate" onpaste="return false" onDrop="return false" class="form-control" name="daterange3"></div>
										</div>
									</div>
								</div>
								
								<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="earn" class="tab-pane" >
									<div class="panel-body">
											<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
												<thead>
													<tr>
														<th>From</th>
														<th>To</th>
														<th>Type</th>
														<th>Particular</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$total_comp_salary = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id='$empid' AND cutoff='".$selection."'")->fetch_object();
														$comp_id = $total_comp_salary->comp_id;
														$emp_earnings = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id='$empid'");
														if($emp_earnings->num_rows > 0){
															while($earn = $emp_earnings->fetch_object()){
																echo '<tr>';
																echo '<td>'.$earn->initial_date.'</td>';
																echo '<td>'.$earn->end_date.'</td>';
																echo '<td>'.$earn->earn_type.'</td>';
																echo '<td>'.$earn->earn_name.'</td>';
																echo '<td>'.$earn->earn_max.'</td>';
																echo '</tr>';
															}
														}
													?>
												</tbody>
											</table>
									</div>
								</div>
								<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="deduct" class="tab-pane" >
									<div class="panel-body">
											<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
												<thead>
													<tr>
														<th>From</th>
														<th>To</th>
														<th>Type</th>
														<th>Particular</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$total_comp_salary = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id='$empid' AND cutoff='".$selection."'")->fetch_object();
														$comp_id = $total_comp_salary->comp_id;
														$emp_deductions = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id='$empid'");
														if($emp_deductions->num_rows > 0){
															while($deduct = $emp_deductions->fetch_object()){
																echo '<tr>';
																echo '<td>'.$deduct->initial_date.'</td>';
																echo '<td>'.$deduct->end_date.'</td>';
																echo '<td>'.$deduct->deduct_type.'</td>';
																echo '<td>'.$deduct->deduct_name.'</td>';
																echo '<td>'.$deduct->deduct_max.'</td>';								
																echo '</tr>';
															}
														}
													?>
												</tbody>
											</table>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
									<button type="submit" id="editsub" name="editsub" class="btn btn-primary">Submit</button>
									</form>
								</div>
								
							</div>
						</div>
					</div>
					
				</div>

			</div>
		</div>
	</div>
			<?php
				//include("processing_modal.php");
			?>
	<div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="process_modal">

			</div>
		</div>
	</div>			

	<script>
		function filter_action(elem){
			if(elem == 'Edit'){
				var empid = <?php echo $empid; ?>;
				document.getElementById('partinp').style.display="none";
				document.getElementById('partsel').style.display="block";
				document.getElementById('frmnew').style.display="none";
				document.getElementById('frmedit').style.display="block";
				document.getElementById('tonew').style.display="none";
				document.getElementById('toedit').style.display="block";
				
				$("#particularsel").load("filter.php?choice=" + elem + "&empid=" + empid);
			}
			if(elem == 'New'){
				document.getElementById('partinp').style.display="block";
				document.getElementById('partsel').style.display="none";
				document.getElementById('frmnew').style.display="block";
				document.getElementById('frmedit').style.display="none";
				document.getElementById('tonew').style.display="block";
				document.getElementById('toedit').style.display="none";
			}
		}
		function filter_ed(elem2){
			var elem = $("#actionsel").val();
			var empid = <?php echo $empid; ?>;
			if(elem == 'Edit'){
				$("#particularsel").load("filter.php?choice=" + elem2 + "&empid=" + empid);

			}
		}
		function filter_type(elem3){
			var elem = $("#actionsel").val();
			var elem2 = $("#earndeduct").val();
			var empid = <?php echo $empid; ?>;
			if(elem == 'Edit' || (elem == 'Edit' && elem2 == 'Earnings') || (elem == 'Edit' && elem2 == 'Deductions')){
				$("#particularsel").load("filter.php?choice=" + elem3 + "&empid=" + empid + "&elem2=" + elem2);
			}
		}
		function filter_part(elem4){
			var elem = $("#actionsel").val();
			var elem2 = $("#earndeduct").val();
			var elem3 = $("#type").val();
			var empid = <?php echo $empid; ?>;
			$('#fromdate').val('2016-05-01');
			return $.ajax({
                    url: "filter.php?choice='part'&elem4=" + elem4 + "&empid=" + empid + "&elem2=" + elem2 + "&elem3=" + elem3,
                    type: "GET",
                    success: function(data) {
                        eval(data);
                    }
                });
		}

	</script>
	<script>
		$(document).ready(function(){
			$('#particularsel').change(function(){
	            var partic = $(this).val();
	            var elem = $("#actionsel").val();
				var elem2 = $("#earndeduct").val();
				var elem3 = $("#type").val();
				var empid = <?php echo $empid; ?>;
				var info = "choice=part&elem4=" + partic + "&empid=" + empid + "&elem2=" + elem2 + "&elem3=" + elem3 + "&particularsel";
				//$('#fromdate').val('2016-05-01');
	             $.ajax({

	                    url: "filter2.php",
	                    type: "POST",
	                    data:info,
	                    success: function(data) {
	                        eval(data);
	                    }
	                });
	        });
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
	</body>

</html>