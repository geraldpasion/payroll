<!DOCTYPE html>
<html>

	<head>
		<?php
			 include('menuheader.php');
		?>
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
		</style>
		<title>Employee list</title>
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
		</script>                   
	-->
		<script type="text/javascript">
		   $(document).on('click', "#tab-1", function()
		{

			$(this).removeClass();
			$(this).addClass("tab-pane active")
		})
		$(document).on('click', "#tab-2", function()
		{

			$(this).removeClass();
			$(this).addClass("tab-pane active")
		})
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
			 var type = $(this).data('type');
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
			 var jobtitle = $(this).data('jobtitle');
			 
			 
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
			 $(".modal-body #type").val( type );	
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
			  $(".modal-body #jobtitle").val( jobtitle );
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
			 var type = $(this).data('type');
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
			 var jobtitle = $(this).data('jobtitle');
			 
			 
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
			 $(".modal-body #type").val( type );	
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
			  $(".modal-body #jobtitle").val( jobtitle );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   
			
			});
		</script>
		<script type="text/javascript" >//ajax	
			$(document).ready(function(){
			$(document).on('submit','#formidlagaymodito', function() {
			var empid = $("#empid").val();
			var lastname = $("#lastname").val();
			var firstname = $("#firstname").val();
			var middlename = $("#middlename").val();
			var gender = $("#gender").val();
			var birthday = $("#birthday").val();
			var marital = $("#marital").val();
			var address = $("#address").val();
			var email = $("#email").val();
			var mobile = $("#mobile").val();
			var emptype = $("#type").val();
			var department = $("#department").val();
			var jobtitle = $("#jobtitle").val();
			var rate = $("#rate").val();
			var taxcode = $("#taxcode").val();
			var dependency = $("#dependency").val();
			var sss = $("#sss").val();
			var philhealth = $("#philhealth").val();
			var pagibig = $("#pagibig").val();
			var tin = $("#tin").val();
			var shift = $("#shift").val();
			var datehired = $("#datehired").val();
			var city = $("#city").val();
			var zip = $("#zip").val();
			var restday = $("#restday").val();
			var password = $("#password").val();
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'employeeid='+ empid + '&lastname='+ lastname + '&firstname='+ firstname + '&middlename='+ middlename + '&gender='+ gender + '&birthday='+ birthday + '&marital='+ marital + '&address='+ address + '&email='+ email + '&mobile='+ mobile + '&emptype='+ emptype + '&department='+ department + '&jobtitle='+ jobtitle + '&rate='+ rate + '&taxcode='+ taxcode + '&sss='+ sss + '&philhealth='+ philhealth + '&pagibig='+ pagibig + '&tin='+ tin + '&shift='+ shift + '&datehired='+ datehired + '&city='+ city + '&zip='+ zip + '&restday='+ restday + '&password='+ password;
			if(lastname=='')
			{
				$(window).scrollTop(0);
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else
			{
			// AJAX Code To Submit Form.
			$.ajax({
			type: "POST",
			url: "editemployee.php",
			data: dataString,
			cache: false,
			success: function(result){
			 scroll(0,0)
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
				toastr.success('Employee successfully edited!');
			
			}
			});
			}
			return false;
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
				toastr.success('Employee successfully deleted!');
			 
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
				toastr.success("Holiday successfully edited!");
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
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Employee list</h5>
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
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>ID</th>";
										echo "<th>Name</th>";
										echo "<th>Department</th>";
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
											echo "<tr class = 'josh'>";
											echo "<td>" . $row1->employee_id . "</td>";
											echo "<td><a href='#' data-toggle='modal'
														data-employee-id='$empid' 

											data-target='#myModal2' class = 'viewempdialog'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
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
													data-type='$row1->employee_type' 
													data-department='$row1->employee_department' 
													data-rate='$row1->employee_rate' 
													data-taxcode='$row1->employee_taxcode'  
													data-sss='$row1->employee_sss' 
													data-philhealth='$row1->employee_philhealth' 
													data-pagibig='$row1->employee_pagibig' 
													data-tin='$row1->employee_tin' 
													data-shift='$row1->employee_shift' 
													data-datehired='$row1->employee_datehired' 
													data-restday='$row1->employee_restday' 
													data-jobtitle='$row1->employee_jobtitle' 
													data-password='$row1->employee_password' 
													
													
													data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
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
			<div class="modal-content">
				<div class="modal-header">
				<?php
					//$q = mysqli_query("SELECT * FROM employee WHERE employee_id = '$empid");
					$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
					$res = $mysqli->query("SELECT * FROM employee");
				?>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-user modal-icon"></i>
					<h4 class="modal-title">Employee information</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<div class="tabs-container">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#tab-1">Personal information</a></li>
								<li class=""><a data-toggle="tab" href="#tab-2">Employee Information</a></li>
								<li class=""><a data-toggle="tab" href="#tab-3">201 FIle</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab-1" class="tab-pane active" >
									<div class="panel-body">
										<div class="col-md-3"></div>
										<a href="testpic.png" title="Image from Unsplash" data-gallery=""><img class = "profilepic"src="img/a4.jpg"></a>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>ID</b></div>
										<div class="col-md-4"><input id ="empid"></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>Name</b></div>
										<div class="col-md-4"><?php echo $result['employee_firstname']. " " .$result['employee_lastname'] ; ?></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>Gender</b></div>
										<div class="col-md-4"><?php echo $result['employee_gender']; ?></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>Birthday</b></div>
										<div class="col-md-4"><?php echo $birthday?></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>Marital Status</b></div>
										<div class="col-md-4"><?php echo $result['employee_marital']; ?></div>   
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>Address</b></div>
										<div class="col-md-4"><?php echo $result['employee_address']; ?></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>City</b></div>
										<div class="col-md-4"><?php echo $result['employee_city']; ?></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>ZIP</b></div>
										<div class="col-md-4"><?php echo $result['employee_zip']; ?></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>Email</b></div>
										<div class="col-md-4"><?php echo $result['employee_email']; ?></div>
										<br><br>
										<div class="col-md-3"></div>
										<div class="col-md-3"><b>Cellphone number</b></div>
										<div class="col-md-4"><?php echo $result['employee_cellnum']; ?></div>
										<br><br>
									</div>
								</div>
								<div id="tab-2" class="tab-pane">
									<div class="panel-body">
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Employee type</b></div>
									<div class="col-md-4"><?php echo $result['employee_type']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Department</b></div>
									<div class="col-md-4"><?php echo $result['employee_department']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Rate</b></div>
									<div class="col-md-4"><?php echo $result['employee_rate']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Taxcode</b></div>
									<div class="col-md-4"><?php echo $result['employee_taxcode']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Dependencies</b></div>
									<div class="col-md-4"><?php echo $result['employee_dependency']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>SSS</b></div>
									<div class="col-md-4"><?php echo $result['employee_sss']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Philhealth</b></div>
									<div class="col-md-4"><?php echo $result['employee_philhealth']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Pagibig</b></div>
									<div class="col-md-4"><?php echo $result['employee_pagibig']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>TIN</b></div>
									<div class="col-md-4"><?php echo $result['employee_tin']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Shift</b></div>
									<div class="col-md-4"><?php echo $result['employee_shift']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Date hired</b></div>
									<div class="col-md-4"><?php echo $result['employee_datehired']; ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
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
					<h4 class="modal-title">Edit information</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "editemployee.php" class="form-horizontal">
						
							<div class="form-group">
								<label class="col-sm-2 control-label">Employee ID</label>
								<div class="col-md-4"><input id = "empid" name = "employeeid" type="text" class="form-control" readonly = "readonly"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Last name</label>
								<div class="col-md-4"><input id = "lastname" type="text" name = "lastname" class="form-control" required="" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">First name</label>
								<div class="col-md-4"><input type="text" id = "firstname" class="form-control" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Middle name</label>
								<div class="col-md-4"><input type="text" id = "middlename" class="form-control" name = "middlename" required="" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">Gender</label>
								<div class="col-md-4"><select class = "form-control" id = "gender" name = "gender" required="" ><option value = "Male">Male</option><option value = "Female">Female</option></select></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Birthday</label>
								<div class="col-md-4"><input type="text" id = "birthday" class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"></div>
								<label class="col-sm-2 control-label">Marital status</label>
								<div class="col-md-4"><select class = "form-control" name = "marital" id = "marital" required=""><option value = "Single">Single</option><option value = "Married">Married</option><option value = "Widowed">Widowed</option><option value = "Separated">Separated</option><option value = "Divorced">Divorced</option></select></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Address</label>
								<div class="col-md-10"><input type="text" id = "address" class="form-control" name = "address" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">City</label>
								<div class="col-md-4"><input type="text" id = "city" class="form-control" name = "city" onKeyPress="return lettersonly(this, event)" required=""></div>
								<label class="col-sm-2 control-label">ZIP</label>
								<div class="col-md-4"><input type="text" id = "zip" class="form-control" name = "zip" maxlength="4" onKeyPress="return numbersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-md-4"><input type="text" id = "email" class="form-control" name = "email" required=""></div>
								<label class="col-sm-2 control-label">Mobile</label>
								<div class="col-md-4"><input type="text" id = "mobile" class="form-control" maxlength="11" name = "mobile" onKeyPress="return numbersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Type</label>
								<div class="col-md-4"><input type="text" id = "type" class="form-control" name = "type" onKeyPress="return lettersonly(this, event)" required=""></div>
								<label class="col-sm-2 control-label">Department</label>
								<div class="col-md-4"><input type="text" id = "department" class="form-control" name = "department" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Rate</label>
								<div class="col-md-4"><input type="text" id = "rate" class="form-control" name = "rate" onKeyPress="return doubleonly(this, event)" required=""></div>
								<label class="col-sm-2 control-label">Taxcode</label>
								<div class="col-md-4"><select class = "form-control" name = "taxcode" id = "taxcode" value = "Select" required=""><option value = "Z">Z</option><option value = "S/ME">S/ME</option><option value = "ME1/S1">ME1/S1</option><option value = "ME2/S2">ME2/S2</option><option value = "ME3/S3">ME3/S3</option><option value = "ME4/S4">ME4/S4</option></select></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">PhilHealth no</label>
								<div class="col-md-4"><input type="text" id = "philhealth" class="form-control" name = "philhealth" data-mask="99-999999999-9" required=""></div>
								<label class="col-sm-2 control-label">HDMF</label>
								<div class="col-md-4"><input type="text" id = "pagibig" class="form-control" name = "hdmf" data-mask="9999-9999-9999" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">TIN</label>
								<div class="col-md-4"><input type="text" id = "tin" class="form-control" name = "tin" data-mask="999-999-999" required=""></div>
								<label class="col-sm-2 control-label">SSS</label>
								<div class="col-md-4"><input type="text" id = "sss" class="form-control" name = "sss" data-mask="99-9999999-9" required=""></div>
							</div>
							<div class="form-group">
									<label class="col-sm-2 control-label">Shift</label>
								<div class="col-md-4"><input type="text" id = "shift" class="form-control" name = "shift" required=""></div>
								<label class="col-sm-2 control-label">Rest day</label>
									<div class="col-md-4"><select class = "form-control" name = "restday" id = "restday" required=""><option value = "Monday">Monday</option><option value = "Tuesday">Tuesday</option><option value = "Wednesday">Wednesday</option><option value = "Thursday">Thursday</option><option value = "Friday">Friday</option><option value = "Saturday">Saturday</option><option value = "Sunday">Sunday</option></select></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Date hired</label>
								<div class="col-md-4"><input type="text" id = "datehired" class="form-control" name="daterange2" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Job title</label>
								<div class="col-md-4"><input type="text" id = "jobtitle" class="form-control" name = "jobtitle" onKeyPress="return lettersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Password</label>
								<div class="col-md-4"> <input type="text" id = "password" name = "password"class="form-control" required="" required=""></div>
							</div>		
							<div class="form-group">	
							<div id = "success2" class="alert alert-success alert-dismissable col-md-12" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Employee successfully edited. <a class="alert-link" href="#">Alert Link</a>.
						</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-small">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-exclamation modal-icon"></i>
					<h4 class="modal-title">Deactivate</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST"  class="form-horizontal">
						
							<div class="form-group">
						
								<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-8">
								<strong>Are you sure you want to deactivate?
								</div>
								</div>
								<div class="form-group">
								<label class="col-sm-2 control-label">Employee ID</label>
								<div class="col-md-4"><input id = "empid" type="text" name = "empid" class="form-control" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
															<div class="form-group">
								<label class="col-sm-2 control-label">Last name</label>
								<div class="col-md-4"><input id = "lastname" type="text" name = "lastname" class="form-control" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<label class="col-sm-2 control-label">First name</label>
								<div class="col-md-4"><input type="text" id = "firstname" class="form-control" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							</div>
					</div>
				</div>	
			<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary delete">Submit</button>
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