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
		<title>Employee List</title>
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
			var loadFile = function(event, id, value) {
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
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange2"]').daterangepicker({
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
			 var cutoff = $(this).data('cutoff');
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
			 var acctnum = $(this).data('acctnum');
			 var payslippassword = $(this).data('payslippassword');
			 var team1 = $(this).data('team1');
			 var team2 = $(this).data('team2');
			 var team3 = $(this).data('team3');
			 var team4 = $(this).data('team4');
			 var imgss = "images/"+$(this).data('im');

			 document.getElementById("output").src = imgss;
			 
			 
			if(level==1||level==2||level==4){

					 $(".teams2").fadeOut();
					 $(".teams3").fadeOut();
					 $(".teams4").fadeOut();
					 $("#lt2").fadeOut();
					 $("#lt3").fadeOut();
					 $("#lt4").fadeOut();
					// alert();
			 }else if(level==3){
					$(".teams2").fadeIn();
					$(".teams3").fadeIn();
				    $(".teams4").fadeIn();
					$("#lt2").fadeIn();
					$("#lt3").fadeIn();
					$("#lt4").fadeIn();

			 }

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
			 $(".modal-body #cutoff").val( cutoff );
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
			 $(".modal-body #team1").val( team1 );
			 $(".modal-body #team2").val( team2 );
			 $(".modal-body #team3").val( team3 );
			 $(".modal-body #team4").val( team4 );
			 $(".modal-body #acctnum").val( acctnum );
			 $(".modal-body #payslippassword").val( payslippassword );

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
			 var cutoff = $(this).data('cutoff');
			 var shift = $(this).data('shift');
			 var datehired = $(this).data('datehired');
			 var restday = $(this).data('restday');
			 var password = $(this).data('password');
			 var sickleave = $(this).data('sickleave');
			 var vacationleave = $(this).data('vacationleave');
			 var status = $(this).data('status');
			 var level = $(this).data('level');
			 var acctnum = $(this).data('acctnum');
			 var payslippassword = $(this).data('payslippassword');
			 var team1 = $(this).data('team1');
			 var team2 = $(this).data('team2');
			 var team3 = $(this).data('team3');
			 var team4 = $(this).data('team4');
			 var vleave = $(this).data('vleave');
			 var sleave = $(this).data('sleave');
			 var prd = $(this).data('prd');
			 var mleave = $(this).data('mleave');
			 var pleave = $(this).data('pleave');
			 var spleave = $(this).data('spleave');
			 var paylessleave = $(this).data('paylessleave');
			 var oleave = $(this).data('oleave');

			 
			 
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
			 $(".modal-body #cutoff").val( cutoff );
			 $(".modal-body #shift").val( shift );	
			 $(".modal-body #datehired").val( datehired );	
			 $(".modal-body #restday").val( restday );		
			 $(".modal-body #password").val( password );	
			 $(".modal-body #sickleave").val( sickleave );	
			 $(".modal-body #vacationleave").val( vacationleave );	
			 $(".modal-body #status").val( status );	
			 // $(".modal-body #team").val( team );
			 $(".modal-body #level").val( level );
			 $(".modal-body #team1").val( team1 );
			 $(".modal-body #team2").val( team2 );
			 $(".modal-body #team3").val( team3 );
			 $(".modal-body #team4").val( team4 );
			 $(".modal-body #acctnum").val( acctnum );
			 $(".modal-body #payslippassword").val( payslippassword );
			 $(".modal-body #vLeave").val( vleave );
			 $(".modal-body #sLeave").val( sleave );
			 $(".modal-body #paidRST").val( prd );
			 $(".modal-body #mLeave").val( mleave );
			 $(".modal-body #pLeave").val( pleave );
			 $(".modal-body #spLeave").val( spleave );
			 $(".modal-body #leaveNoPay").val( paylessleave );
			 $(".modal-body #oLeave").val( oleave );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   
			
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
			history.replaceState({}, "Title", "employeelist.php");
			});
		</script>
		<?php
		if(isset($_GET['edited']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'function alertFunction14() {'
					, '$("#edited").show();'
					, ''
					, '}'
					, 'showEdited();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		?>
		<script src="js/keypress.js"></script>

		<script type="text/javascript">
			// $(document).on("click", ".viewempdialog", function () {
			// var employeeid = $(this).data('employee-id');			
			// //var cutoffd = $(this).data('cutoffd');
			// //var submitdate = $(this).data('submitdate');

			// $.ajax({
	  //           url: "employeelist_modal.php",
	  //           method: "POST",
	  //           data:{
			//        empid: employeeid
			//        //cutoff: cutoffd,
			//        //submit: submitdate
			//     },
	  //           success: function(data) {
	  //               $('#employeelist_modal').html(data);
	  //           }
	  //       });
			
			// });
		</script>
		
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Employee List</h5>
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
					<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						</div>
						<div class="ibox-content" id = "tableHolderz">
							<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' ORDER BY employee_id")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>ID</th>";
										echo "<th>Name</th>";
										echo "<th>Department</th>";
										echo "<th>Team</th>";
										echo "<th style='text-align:center'>Access Level</th>";
										echo "<th style='text-align:center;'>Action</th>";
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
											//employee id
											echo "<td>" . $row1->employee_id . "</td>";
											//name
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
														data-employeestatus='$row1->employee_empstatus' 
														data-department='$row1->employee_department' 
														data-rate='$row1->employee_rate' 
														data-taxcode='$row1->employee_taxcode'  
														data-sss='$row1->employee_sss' 
														data-philhealth='$row1->employee_philhealth' 
														data-pagibig='$row1->employee_pagibig' 
														data-tin='$row1->employee_tin'
														data-cutoff='$row1->cutoff' 
														data-shift='".$shiftstart." - ".$shiftend."' 
														data-datehired='$row1->employee_datehired' 
														data-restday='$row1->employee_restday' 
														data-jobtitle='$row1->employee_jobtitle'  
														data-password='$row1->employee_password' 
														data-level='$row1->employee_level' 
														data-acctnum='$row1->account_number'
														data-team1='$row1->employee_team'
														data-team2='$row1->employee_team1'
														data-team3='$row1->employee_team2'
														data-team4='$row1->employee_team3'
														data-vleave='$row1->employee_vacationleave'
														data-sleave='$row1->employee_sickleave'
														data-prd='$row1->employee_incentive'
														data-mleave='$row1->employee_maternityleave'
														data-pleave='$row1->employee_paternityleave'
														data-spleave='$row1->employee_singleparentleave'
														data-payslippassword='$row1->employee_payslippassword'  

											data-target='#myModal2' class = 'viewempdialog'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
											//department
											echo "<td>" . $row1->employee_department . "</td>";
											//team
											echo "<td>" . $row1->employee_team . "</td>";
											//access level
											echo "<td style='text-align:center'>" . $row1->employee_level . "</td>";
											//edit
											echo "<td style='text-align:center;'><a href='#' data-toggle='modal' 
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
													data-employeestatus='$row1->employee_empstatus'  
													data-department='$row1->employee_department' 
													data-rate='$row1->employee_rate' 
													data-taxcode='$row1->employee_taxcode'  
													data-sss='$row1->employee_sss' 
													data-philhealth='$row1->employee_philhealth' 
													data-pagibig='$row1->employee_pagibig' 
													data-tin='$row1->employee_tin' 
													data-cutoff='$row1->cutoff'
													data-shift='$shiftstart' 
													data-shift2='$shiftend' 
													data-datehired='$row1->employee_datehired' 
													data-restday='".$restdayArray[0]."' 
													data-restday2='".$restdayArray[1]."' 
													data-jobtitle='$row1->employee_jobtitle' 
													data-password='$row1->employee_password' 
													data-level='$row1->employee_level' 
													data-team1='$row1->employee_team'
													data-team2='$row1->employee_team1'
													data-team3='$row1->employee_team2'
													data-team4='$row1->employee_team3'
													data-acctnum='$row1->account_number'
													data-vleave='$row1->employee_vacationleave'
													data-sleave='$row1->employee_sickleave'
														data-prd='$row1->employee_incentive'
														data-mleave='$row1->employee_maternityleave'
														data-pleave='$row1->employee_paternityleave'
														data-spleave='$row1->employee_singleparentleave'
													data-payslippassword='$row1->employee_payslippassword' 
													data-im='$row1->image'
													
													
													data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
											//deactivate and print
											echo "<a href='#' id='$empid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Deactivate</button></button></a>
											<a href = 'employeedocument.php?id=$empid'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a>";
											
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>
						</div>
				</div>
			</div>
        </div>
<?php
// if(isset($_POST['edit'])){
// echo "<div class='modal-body'>";
// echo "<input id = 'employeeid' name = 'employeeid' type='text' class='form-control'>";
// echo "</div>";
 // $employeeid = $_GET['employeeid'];

 // }
 ?>
	<div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="employeelist_modal">
				<div class="modal-header">
				<?php
					//$q = mysqli_query("SELECT * FROM employee WHERE employee_id = '$empid");
					// $result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
					// $res = $mysqli->query("SELECT * FROM employee");
				?>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-user modal-icon"></i>
					<h4 class="modal-title">Employee Information</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
							<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#personaldetails">Personal Details</a></li>
								<li class=""><a data-toggle="tab" href="#employeedetails">Employment Details</a></li>
								<!-- <li class=""><a data-toggle="tab" href="#paysettings">Salary and Wages</a></li>
								<li class=""><a data-toggle="tab" href="#summary">Summary</a></li>
								<li class=""><a data-toggle="tab" href="#earnings">Earnings</a></li>
								<li class=""><a data-toggle="tab" href="#deductions">Deductions</a></li> -->
								<li class=""><a data-toggle="tab" href="#leavedetails">Leave Details</a></li>
								<li class=""><a data-toggle="tab" href="#passwords">Password</a></li>

							
							</ul>
							<div class="tab-content">
								<div id="personaldetails" class="tab-pane fade active in" >
									<div class="panel-body">
										<form id = "uploadForm" method="POST" action = "editemployee.php" class="form-horizontal">
							<div class="form-group">
									</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Last name</label>
								<div class="col-md-4"><input id = "lastname" type="text" name = "lastname" class="zx" required="" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">First name</label>
								<div class="col-md-4"><input type="text" id = "firstname" class="zx" name = "firstname" required="" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Middle name</label>
								<div class="col-md-4"><input type="text" id = "middlename" class="zx" name = "middlename" required="" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">Gender</label>
								<div class="col-md-4"><input type = "text" class = "zx" id = "gender" name = "gender" required="" readonly = "readonly"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Birthday</label>
								<div class="col-md-4"><input type="text" id = "birthday" class="zx" readonly = "readonly" required="" onKeyPress="return noneonly(this, event)"></div>
								<label class="col-sm-2 control-label">Marital status</label>
								<div class="col-md-4"><input type = "text" class = "zx" id = "marital" name = "gender" readonly = "readonly" required="" ></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Address</label>
								<div class="col-md-4" style="max-width:100px;"><input type="text" class="zx" id = "address" readonly = "readonly" name = "address" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">City</label>
								<div class="col-md-4"><input type="text" id = "city" class="zx" name = "city" readonly = "readonly" onKeyPress="return lettersonly(this, event)" required=""></div>
								<label class="col-sm-2 control-label">ZIP</label>
								<div class="col-md-4"><input type="text" id = "zip" class="zx" name = "zip" maxlength="4" readonly = "readonly" onKeyPress="return numbersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-md-4"><input type="text" id = "email" class="zx" name = "email" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Mobile</label>
								<div class="col-md-4"><input type="text" id = "cellnum" class="zx" maxlength="11" name = "mobile" readonly = "readonly" onKeyPress="return numbersonly(this, event)" required=""></div>
							</div>
										
									</div>
								</div>
							
						
							<div style= "max-height:300px; min-height:300px; overflow-y:scroll;" id="employeedetails" class="tab-pane" >
									<div class="panel-body">
										<div class="form-group">
									</div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Employee ID</label>
								<div class="col-sm-3"><input type="text" id = "empid" name = "employeeid" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required=""></div><br>

							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Account No.</label>
								<div class="col-sm-3"><input type="text" id = "acctnum" name = "acctnum" readonly = "readonly" onKeyPress="return lettersonly(this, event)" required=""></div>
								<label class="col-sm-3 control-label">Tax Code</label>
								<div class="col-sm-3"> <input type="text" id = "taxcode" name = "taxcode"  readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Date Hired</label>
								<div class="col-sm-3"><input type="text" id = "datehired" name = "employeetype" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">SSS</label>
								<div class="col-sm-3"><input type="text" id = "sss" name = "sss"  readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Designation</label>
								<div class="col-sm-3"><input type = "text" id = "jobtitle" name = "jobtitle" readonly = "readonly" required="" ></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">Philhealth No.</label>
								<div class="col-sm-3"><input type="text" id = "philhealth"  name = "philhealth" readonly = "readonly" data-mask="999-999-999" required=""></div>
								<br>
							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Employment Status</label>
								<div class="col-sm-3"><input type="text" id = "employeestatus"  name = "employeestatus" readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">HDMF</label>
								<div class="col-sm-3"> <input type="text" id = "pagibig" name = "pagibig"  readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Department</label>
								<div class="col-sm-3"><input type="text" id = "department"  name = "department" readonly = "readonly" data-mask="99-999999999-9" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">Access Level</label>
								<div class="col-sm-3"><input type = "text" id = "level" name = "level" readonly = "readonly" required="" ></div><br>

							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Team 1</label>
								<div class="col-sm-3"> <input type="text" id = "team1" name = "team"  readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">Vacation Leave</label>
								<div class="col-sm-3"> <input type="text" id = "vLeave" name = "vLeave"  readonly = "readonly" required=""></div><br>


							<div class="form-group"></div>
								<label class="col-sm-3 control-label" id="vt2">Team 2</label>
								<div class="col-sm-3"> <input type="text" id = "team2" name = "team1"  readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">Sick Leave</label>
								<div class="col-sm-3"> <input type="text" id = "sLeave" name = "sLeave"  readonly = "readonly" required=""></div><br>

							<div class="form-group"></div>
								<label class="col-sm-3 control-label" id="vt3">Team 3</label>
								<div class="col-sm-3"> <input type="text" id = "team3" name = "team2"  readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3">Paid Restday/Incentive</label>
								<div class="col-sm-3"><input type="text" id = "paidRST"  name = "paidRST" readonly = "readonly" required=""></div><br>
						
							<div class="form-group"></div>
								<label class="col-sm-3 control-label" id="vt4">Team 4</label>
								<div class="col-sm-3"> <input type="text" id = "team4" name = "team3"  readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">Maternity Leave</label>
								<div class="col-sm-3"><input type="text" id = "mLeave"  name = "mLeave" readonly = "readonly" data-mask="999-999-999" required=""></div><br>
							
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Schedule</label>
								<div class="col-sm-3"> <input type="text" id = "shift" name = "shift"  readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">Paternity Leave</label>
								<div class="col-sm-3"> <input type="text" id = "pLeave" name = "pLeave"  readonly = "readonly" required=""></div>
								<br>

							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Restday</label>
								<div class="col-sm-3"><input type="text" id = "restday"  name = "restday" readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3">Single-Parent Leave</label>
								<div class="col-sm-3"><input type="text" id = "spLeave"  name = "spLeave" readonly = "readonly" required=""></div>
								<br>

							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Password</label>
								<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3">Leave without pay</label>
								<div class="col-sm-3"><input type="text" id = "leaveNoPay"  name = "leaveNoPay" readonly = "readonly" required=""></div><br>
							
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Tin No.</label>
								<div class="col-sm-3"><input type="text" id = "tin" name = "tin" readonly = "readonly" onKeyPress="return lettersonly(this, event)" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3">Other Leave</label>
								<div class="col-sm-3"><input type="text" id = "oLeave"  name = "oLeave" readonly = "readonly" required=""></div><br>

							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Payment Schedule</label>
								<div class="col-sm-3"><input type="text" id = "cutoff" name = "cutoff" readonly = "readonly" onKeyPress="return lettersonly(this, event)" required=""></div>
							<!-- <div class="form-group"></div> -->
								<label class="col-sm-3 control-label">Shift Type</label>
								<div class="col-sm-3"> <input type="text" id = "employeetype" name = "employeetype"  readonly = "readonly" required=""></div>
							</div>
						</div>
							</ul>

								<div id="paysettings" class="tab-pane" >
									<div class="panel-body">
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Monthly Rate:</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3">Exemption Status:</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Semi-Monthly Rate:</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Tax Computation:</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Daily Rate:</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Cut Off:</label>
								<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Hourly Rate:</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div>	
								<label class="col-sm-3 control-label">Statutory Period:</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
								<br> -->
							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Pay Type:</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
							<!-- <div class="form-group"></div>	
								<label class="col-sm-3 control-label">Holding Period:</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>	 -->
									</div>
								</div>
							</ul>

							<div id="summary" class="tab-pane" >
								<div class="panel-body">
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Total Taxable Earnings</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3">Net Income After Tax</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Total Taxable Deduction</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Total Non-Taxable Deduction</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<br>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Total Statutory Benefits</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Net Pay</label>
								<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Total Taxable Income</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>	
									</div>
								</div>
							</ul>


							<div style= "max-height:100px; min-height:100px; overflow-y:scroll;" id="earnings" class="tab-pane" >
								<div class="panel-body">
									<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
										<thead>
											<tr>
												<th>From</th>
												<th>To</th>
												<th>Type</th>
												<th>Particular</th>
												<th>Amount</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</ul>
<!-- 							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Taxable</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3">Night Differential</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Basic</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Overtime</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Incentives</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Non-Taxable</label>
								<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Leave</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>	
									</div>
								</div>
							</ul>
 -->
							<div style= "max-height:100px; min-height:100px; overflow-y:scroll;" id="deductions" class="tab-pane" >
								<div class="panel-body">
									<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
										<thead>
											<tr>
												<th>From</th>
												<th>To</th>
												<th>Type</th>
												<th>Particular</th>
												<th>Amount</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</ul>

						<div style= "max-height:100px; min-height:300px; overflow-y:scroll;" id="leavedetails" class="tab-pane" >
								<div class="panel-body">
									<table id="leave_type" class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
										<thead>
											<tr>
												<th>Leave Type</th>
												<th>From</th>
												<th>Status</th>
												<!--th>To</th-->
												<!--th>Days</th-->
												<th>Approved By</th>
												<th>Approve Date</th>
											</tr>
										</thead>
										<tbody>
											<?php
											//call employeelist_modal.php here



												/*$leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id=$empid");
													if($leavedetails->num_rows > 0){
														while($leave = $leavedetails->fetch_object()){
															echo '<tr>';
															echo '<td>'.$leave->leave_type.'</td>';
															echo '<td>'.$leave->leave_start.'</td>';
															//echo '<td>'.$leave->.'</td>';
															echo '<td>'.$leave->leave_approvedby.'</td>';
															echo '<td>'.$leave->leave_approvaldate.'</td>';
															echo '</tr>';
														}
													}
												*/
											?>
										</tbody>
									</table>
								</div>
							</div>
						</ul>

					<div id="passwords" class="tab-pane" >
							<div class="panel-body">
										<form id = "uploadForm" method="POST" action = "editemployee.php" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label">Log In Password:</label>
								<div class="col-md-3"><input id = "password" type="text" name = "loginpassword" required="" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-3 control-label">Payslip Password:</label>
								<div class="col-md-3"><input id = "payslippassword" type="text" name = "payslippassword" required="" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
							</div>
						</div>
					</div>
						<!--script>
								/function dis(){
								//	var val=document.getElementByClassname("level").value;
								//var val =  document.getElementsByName("level").value;
								var myValue = $( "#level" ).val();
								//alert(myValue);
										if(myValue==1 || myValue==2 || myValue==4){
											  $("#team2").hide();
											  $("#team3").hide();
											  $("#team4").hide();
											  $("#vt2").hide();
											  $("#vt3").hide();
											  $("#vt4").hide();
											 //document.getElementById("team2").disabled=true;
											// document.getElementById("team3").disabled=true;
											// document.getElementById("team4").disabled=true;
											 
											// alert('1,2,4');

										}//else if(myValue==3){
											  //$(".teams2").fadeIn();
											  //$(".teams3").fadeIn();
											  //$(".teams4").fadeIn();
											  //$("#lt2").fadeIn();
											  //$("#lt3").fadeIn();
											  //$("#lt4").fadeIn();
											//document.getElementById("team2").style.visibility=false;
											// document.getElementById("team3").style.visibility=false;
											// document.getElementById("team4").style.visibility=false;
										//}
								}
							</script-->
							<!-- <div class="form-group"></div>
								<label class="col-sm-3 control-label">Taxable</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3">SSS</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Philhealth</label>
								<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required=""></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Pag-Ibig</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<br>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Absences</label>
								<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
							<div class="form-group"></div>
								<label class="col-sm-3 control-label">Lates</label>
								<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required=""></div>
								<br>
							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Non-Taxable</label>
								<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
							<div class="form-group"></div>	
								<label class="col-sm-3 control-label">Loan</label>
							<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>	
									</div>
								</div>
							</ul> -->

							</div>
						</div>
						
					</div>
					
				</form>
				
				
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
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
					<h4 class="modal-title">Edit Information</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#editinfo">Information</a></li>
								<!--li class=""><a data-toggle="tab" href="#newedit">Earning and Deductions</a></li-->
							</ul>

					<!-- START OF EDIT MODAL -->	
							<div class="tab-content">
								<div id="editinfo" class="tab-pane fade active in" >
									<div class="panel-body">
					<form id = "uploadForm" method="POST" action = "editemployee.php" enctype="multipart/form-data" class="form-horizontal">

						<div class="form-group">
								<div class="col-md-4"></div>
								<div class="col-md-4">
								<img class="responsive" name = "targetLayer" id="output"  width="150px" height="150px" id="img1">   
								<input onchange="loadFile(event, this.id, this.value)"  type="file" id="picture" name="picture" accept="image/jpeg">
								<input type="hidden" name="userID" id="userID" value="<?php echo $user; ?>">
								</div>
								<div class="col-md-4"></div>
						</div>
						
							<div class="form-group">
								<label class="col-sm-2 control-label">Employee ID</label>
								<div class="col-md-4"><input id = "empid" name = "employeeid" type="text" class="form-control" readonly = "readonly"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Last name</label>
								<div class="col-md-4"><input id = "lastname" type="text" name = "lastname"  onpaste="return false" onDrop="return false" class="form-control" required="" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">First name</label>
								<div class="col-md-4"><input type="text" id = "firstname"  onpaste="return false" onDrop="return false" class="form-control" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Middle name</label>
								<div class="col-md-4"><input type="text" id = "middlename"  onpaste="return false" onDrop="return false" class="form-control" name = "middlename" required="" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">Gender</label>
								<div class="col-md-4"><select class = "form-control" id = "gender" name = "gender" required="" ><option value = "Male">Male</option><option value = "Female">Female</option></select></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Birthday</label>
								<div class="col-md-4"><input type="text" id = "birthday" class="form-control" name="daterange" required="" readonly="" onKeyPress="return noneonly(this, event)"></div>
								<label class="col-sm-2 control-label">Marital status</label>
								<div class="col-md-4"><select class = "form-control" name = "marital" id = "marital" required=""><option value = "Single">Single</option><option value = "Married">Married</option><option value = "Widowed">Widowed</option><option value = "Separated">Separated</option><option value = "Divorced">Divorced</option></select></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Address</label>
								<div class="col-md-10"><input type="text" id = "address" onpaste="return false" onDrop="return false" class="form-control" name = "address" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">City</label>
								<div class="col-md-4"><input type="text" id = "city" onpaste="return false" onDrop="return false" class="form-control" name = "city" onKeyPress="return lettersonly(this, event)" required=""></div>
								<label class="col-sm-2 control-label">ZIP</label>
								<div class="col-md-4"><input type="text" id = "zip" onpaste="return false" onDrop="return false" class="form-control" name = "zip" maxlength="4" onKeyPress="return numbersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-md-4"><input type="text" id = "email" onpaste="return false" onDrop="return false" class="form-control" name = "email" required=""></div>
								<label class="col-sm-2 control-label">Mobile</label>
								<div class="col-md-4"><input type="text" id = "cellnum" onpaste="return false" onDrop="return false" class="form-control" maxlength="11" name = "mobile" data-mask="99999999999" onKeyPress="return numbersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Date hired</label>
								<div class="col-md-4"><input type="text" id = "datehired" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Designation</label>
								<div class="col-md-4"><input type="text" id = "jobtitle" onpaste="return false" onDrop="return false" class="form-control" name = "jobtitle" onKeyPress="return lettersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Department</label>
								<div class="col-md-4"><input type="text" id = "department" onpaste="return false" onDrop="return false" class="form-control" name = "department" required=""></div>
								<label class="col-sm-2 control-label">Employment Status</label>
								<div class="col-md-4">
									<select class = "form-control" name = "employeestatus" id = "employeestatus" value = "Select" required=""><option value = "Project">Project</option><option value = "Contractual">Contractual</option><option value = "Probationary">Probationary</option><option value = "Regular">Regular</option><option value = "Student Training">Student Training</option></select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Taxcode</label>
								<div class="col-md-4"><select class = "form-control" name = "taxcode" id = "taxcode" value = "Select" required=""><option value = "Z">Z</option><option value = "S/ME">S/ME</option><option value = "ME1/S1">ME1/S1</option><option value = "ME2/S2">ME2/S2</option><option value = "ME3/S3">ME3/S3</option><option value = "ME4/S4">ME4/S4</option></select></div>
								<label class="col-sm-2 control-label">TIN</label>
								<div class="col-md-4"><input type="text" id = "tin" onpaste="return false" onDrop="return false" class="form-control" name = "tin" data-mask="999-999-999" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">SSS</label>
								<div class="col-md-4"><input type="text" id = "sss" onpaste="return false" onDrop="return false" class="form-control" name = "sss" data-mask="99-9999999-9" required=""></div>
								<label class="col-sm-2 control-label">PhilHealth no</label>
								<div class="col-md-4"><input type="text" id = "philhealth" onpaste="return false" onDrop="return false" class="form-control" name = "philhealth" data-mask="99-999999999-9" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">HDMF</label>
								<div class="col-md-4"><input type="text" id = "pagibig" onpaste="return false" onDrop="return false" class="form-control" name = "pagibig" data-mask="9999-9999-9999" required=""></div>
								<label class="col-md-2 control-label">Payment Schedule</label>
								<div class="col-md-4"><select class = "form-control" id = "cutoff" name="cutoff" value = "Select" required=""><option value = "Monthly">Monthly</option><option value = "Semi-monthly">Semi-monthly</option><option value = "Weekly">Weekly</option><option value = "Daily">Daily</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Basic Pay</label>
								<div class="col-md-4"><input type="text" id = "rate" onpaste="return false" onDrop="return false" class="form-control" name = "rate" onKeyPress="return doubleonly(this, event)" required=""></div>
								<label class="col-sm-2 control-label">Shift Type</label>
								<div class="col-md-4"><select class = "form-control" id = "employeetype" name="employeetype" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select shift type...</option>  <option value = "Fixed">Fixed</option><option value = "Flexible">Flexible</option></select></div>
							</div>							
							<div class="form-group">
									<label class="col-sm-2 control-label">Shift start</label>
								<div class="col-md-4"><input type="text" id = "shift" onpaste="return false" onDrop="return false" class="form-control timepicker1" name = "shift" required=""></div>
								<label class="col-sm-2 control-label">Shift end</label>
								<div class="col-md-4"><input type="text" id = "shift2" onpaste="return false" onDrop="return false" class="form-control timepicker1" name = "shift2" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Rest day</label>
								<div class="col-md-4"><select class = "form-control" name = "restday" id = "restday" required=""><option value = "Monday">Monday</option><option value = "Tuesday">Tuesday</option><option value = "Wednesday">Wednesday</option><option value = "Thursday">Thursday</option><option value = "Friday">Friday</option><option value = "Saturday">Saturday</option><option value = "Sunday">Sunday</option></select></div>
								<label class="col-sm-2 control-label">Rest day</label>
								<div class="col-md-4"><select class = "form-control" name = "restday2" id = "restday2" required=""><option value = "Monday">Monday</option><option value = "Tuesday">Tuesday</option><option value = "Wednesday">Wednesday</option><option value = "Thursday">Thursday</option><option value = "Friday">Friday</option><option value = "Saturday">Saturday</option><option value = "Sunday">Sunday</option></select></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Account No.:</label>
								<div class="col-md-4"><input type="text" id = "acctnum" onpaste="return false" onDrop="return false" class="form-control cap" name = "acctnum" required=""></div>
								<label class="col-md-2 control-label">Payslip Password</label>
								<div class="col-md-4"> <input type="text" id = "payslippassword" onpaste="return false" onDrop="return false" name = "paypassword" class="form-control" required="" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Log In Password</label>
								<div class="col-md-4"> <input type="text" id = "password" onpaste="return false" onDrop="return false" name = "logpassword"class="form-control" required="" required=""></div>
								<label class="col-sm-2 control-label">Access level</label>
								<div class="col-md-4">
									<select class = "access"  name = "level" id = "level" required="" onChange="dis()">
										<option value = "1">1</option>
										<option value = "2">2</option>
										<option value = "3">3</option>
										<option value = "4">4</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Team #1</label>
								<div class="col-md-4"><select id = "team1" class="teams1"  data-default-value="z" name="team" ><option selected="true"  value = "">Select team...</option>
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM team")) //get records from db
																{
																	if ($result1->num_rows > 0) //display records if any
																	{
																	
																	
																		while ($row1 = mysqli_fetch_object($result1))
																	
																		{ 
																			
																			echo '<option value="'.$row1->team_name."\">".$row1->team_name. '</option>';
																			
																		}
																		
																		
																	}
																}

								?>
								</SELECT>
								</div>
								<label class="col-md-2 control-label" id ="lt2">Team #2</label>
								<div class="col-md-4"><select id = "team2" class="teams2"  data-default-value="z" name="team1" ><option selected="true"  value = "">Select team...</option>
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM team")) //get records from db
																{
																	if ($result1->num_rows > 0) //display records if any
																	{
																	
																	
																		while ($row1 = mysqli_fetch_object($result1))
																	
																		{ 
																			
																			echo '<option value="'.$row1->team_name."\">".$row1->team_name. '</option>';
																			
																		}
																		
																		
																	}
																}

								?>
								</SELECT>
								</div>
							</div>
							<div class="form-group">		
								<label class="col-md-2 control-label" id ="lt3">Team #3</label>
								<div class="col-md-4"><select id = "team3" class="teams3"  data-default-value="z" name="team2" ><option selected="true"  value = "">Select team...</option>
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM team")) //get records from db
																{
																	if ($result1->num_rows > 0) //display records if any
																	{
																	
																	
																		while ($row1 = mysqli_fetch_object($result1))
																	
																		{ 
																			
																			echo '<option value="'.$row1->team_name."\">".$row1->team_name. '</option>';
																			
																		}
																		
																		
																	}
																}

								?>
								</SELECT>
								</div>
								<label class="col-md-2 control-label" id ="lt4">Team #4</label>
								<div class="col-md-4"><select id = "team4" class="teams4"  data-default-value="z" name="team3" ><option selected="true"  value = "">Select team...</option>
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM team")) //get records from db
																{
																	if ($result1->num_rows > 0) //display records if any
																	{
																	
																	
																		while ($row1 = mysqli_fetch_object($result1))
																	
																		{ 
																			
																			echo '<option value="'.$row1->team_name."\">".$row1->team_name. '</option>';
																			
																		}
																		
																		
																	}
																}

								?>
								</SELECT>
								</div>
							</div>			
						</div>
					</div>
					</ul>
					<!-- <div id="earnanddeduct" class="tab-pane" >
						<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Earnings/Deductions</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" required="" ><option value = ""></option><option value = "Earnings">Earnings</option><option value = "Deductions">Deductions</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Type</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" required="" ><option value = ""></option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Recurence</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" required="" ><option value = ""></option><option value = "Once">Once</option><option value = "Multiple">Multiple</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">From</label>
								<div class="col-md-4"><input type="text" id = "" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required="" placeholder="click to pick date"></div>
							<br><br><br>
								<label class="col-sm-3 control-label">To</label>
								<div class="col-md-4"><input type="text" id = "" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required="" placeholder="click to pick date"></div>
							<br><br><br>
								<label class="col-sm-3 control-label">Particular</label>
								<div class="col-md-4"><input id = "" name = "particular" type="text" class="form-control"></div>
							<br><br><br>
								<label class="col-sm-3 control-label">Amount</label>
								<div class="col-md-4"><input id = "" name = "amount" type="text" class="form-control" placeholder="Enter Amount"></div>
							</div>
						</div>
					</div>
				</ul> -->
					<!--div id="newedit" class="tab-pane" >
						<div class="panel-body">
						<div class="form-group">

							<label class="col-sm-3 control-label">New/Edit</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" required="" ><option value = ""></option><option value = "New">New</option><option value = "Edit">Edit</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Earnings/Deductions</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" required="" ><option value = ""></option><option value = "Earnings">Earnings</option><option value = "Deductions">Deductions</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Type</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" required="" ><option value = ""></option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Recurence</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" required="" ><option value = ""></option><option value = "Once">Once</option><option value = "Multiple">Multiple</option></select></div>
								<br><br><br>								
							<label class="col-sm-3 control-label">Amount</label>
								<div class="col-md-4"><input id = "" name = "amount" type="text" class="form-control" placeholder="Enter Amount"></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Particular</label>
								<div class="col-md-4"><input id = "" name = "particular" type="text" class="form-control"></div>
								<br><br><br>
							<label class="col-sm-3 control-label">From</label>
								<div class="col-md-4"><input type="text" id = "" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required="" placeholder="click to pick date"></div>
							<br><br><br>
								<label class="col-sm-3 control-label">To</label>
								<div class="col-md-4"><input type="text" id = "" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required="" placeholder="click to pick date"></div>
							</div>
						</div>
					</div>
				</ul-->
					</div>
				</div>
				<script>
								function dis(){
								//	var val=document.getElementByClassname("level").value;
								//var val =  document.getElementsByName("level").value;
								var myValue = $( ".access" ).val();
								//alert(myValue);
										if(myValue==1 || myValue==2 || myValue==4){
											  $(".teams2").fadeOut();
											  $(".teams3").fadeOut();
											  $(".teams4").fadeOut();
											  $("#lt2").fadeOut();
											  $("#lt3").fadeOut();
											  $("#lt4").fadeOut();
											 //document.getElementById("team2").disabled=true;
											// document.getElementById("team3").disabled=true;
											// document.getElementById("team4").disabled=true;
											 
											// alert('1,2,4');

										}else if(myValue==3){
											  $(".teams2").fadeIn();
											  $(".teams3").fadeIn();
											  $(".teams4").fadeIn();
											  $("#lt2").fadeIn();
											  $("#lt3").fadeIn();
											  $("#lt4").fadeIn();
											//document.getElementById("team2").style.visibility=false;
											// document.getElementById("team3").style.visibility=false;
											// document.getElementById("team4").style.visibility=false;
										}
								}
							</script>	
				<div class="modal-footer">
					
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

					</form> <!-- END OF EDIT MODAL -->
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
		<link href="css/timepicki.css" rel="stylesheet">
			</div>
		</div>
	</div>
		<?php
			include('menufooter.php');
		?>
	</body>
	<script type="text/javascript">
		$('#myModal2').on('shown.bs.modal', function () {
	   		var menuId = $('#empid').val();
			var request = $.ajax({
			  url: "leave_type_table.php",
			  method: "GET",
			  data: { empid : menuId },
			  dataType: "html"
			});
			 
			request.done(function(msg) {
				//alert(msg);
			  $("#leave_type").html(msg);
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		});

	</script>

</html>