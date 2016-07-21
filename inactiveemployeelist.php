<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Inactive employee list</title>
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
		<script type="text/javascript">
			$(function() {
			$(".activate").click(function(){
			var element = $(this);
			var employee_id = element.attr("id");
			var info = 'employee_id1=' + employee_id;
			 $.ajax({
			   type: "POST",
			   url: "activateemployee.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").remove();
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
       toastr.success('Employee successfully activated!');
			return false;
			});
			});
		</script>
		<script type="text/javascript">
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var employee_id = element.attr("id");
			var info = 'employee_id=' + employee_id;
			 $.ajax({
			   type: "GET",
			   url: "deleteemployee.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").remove();
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
				toastr.success('Employee successfully deleted!');
			return false;
			});
			});
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
			 $(".modal-body #employeetype").val( employeetype );	
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
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Inactive employee list</h5>
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
						<div class="row">
							<div class="col-sm-3">

								</div>
							</div>
						</div>
					<div class="ibox-content">
						<div id = "success" class="alert alert-success alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Employee successfully activated. <a class="alert-link" href="#">Alert Link</a>.
						</div>
						<?php
							include('dbconfig.php');
							
								if ($result = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'inactive' ORDER BY employee_id")) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
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
										
										while ($row = mysqli_fetch_object($result))
										{
											$empid = $row->employee_id;
											$shiftend = substr($row->employee_shift,6,10);
											$shiftend = date("g : i : A",strtotime($shiftend));
											echo "<tr class = 'josh'>";
											echo "<td>" . $row->employee_id . "</td>";
											echo "<td><a href='#' data-toggle='modal'
														data-employee-id='$empid' 
														data-lastname='$row->employee_lastname' 
														data-firstname='$row->employee_firstname' 
														data-middlename='$row->employee_middlename' 
														data-gender='$row->employee_gender' 
														data-birthday='$row->employee_birthday' 
														data-marital='$row->employee_marital' 
														data-address='$row->employee_address' 
														data-city='$row->employee_city' 
														data-zip='$row->employee_zip' 
														data-email='$row->employee_email' 
														data-cellnum='$row->employee_cellnum' 
														data-employeetype='$row->employee_type' 
														data-department='$row->employee_department' 
														data-rate='$row->employee_rate' 
														data-taxcode='$row->employee_taxcode'  
														data-sss='$row->employee_sss' 
														data-philhealth='$row->employee_philhealth' 
														data-pagibig='$row->employee_pagibig' 
														data-tin='$row->employee_tin' 
														data-shift='$shiftend' 
														data-datehired='$row->employee_datehired' 
														data-restday='$row->employee_restday' 
														data-jobtitle='$row->employee_jobtitle' 
														data-password='$row->employee_password' 

											data-target='#myModal2' class = 'viewempdialog'>" . $row->employee_lastname . "," . " " . $row->employee_firstname . " " . $row->employee_middlename . "</a></td>";
											echo "<td>" . $row->employee_department . "</td>";
											echo "<td><a href='#' id='$empid' class = 'activate'><button class='btn btn-primary' type='button'><i class='fa fa-check'></i> Activate</button></a>&nbsp;&nbsp;";
											// echo "<a href='#' id = '$empid' class = 'delete'><button class='btn btn-danger' name = 'edit' type='button'><i class='fa fa-warning'></i> Delete</button></a>";
											echo "</td>";
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
											<form id = "uploadForm" method="POST" action = "editemployee.php" class="form-horizontal">
															<div class="form-group">
									<h2>Personal information<h2>
									</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Employee ID</label>
								<div class="col-md-4"><input id = "empid" name = "employeeid" type="text" class="zx" readonly = "readonly" readonly = "readonly"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Last name</label>
								<div class="col-md-4"><input id = "lastname" type="text" name = "lastname" class="zx" readonly = "readonly" required="" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">First name</label>
								<div class="col-md-4"><input type="text" id = "firstname" class="zx" name = "firstname" readonly = "readonly" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Middle name</label>
								<div class="col-md-4"><input type="text" id = "middlename" class="zx" name = "middlename" readonly = "readonly" required="" onKeyPress="return lettersonly(this, event)"></div>
								<label class="col-sm-2 control-label">Gender</label>
								<div class="col-md-4"><input type = "text" class = "zx" id = "gender" name = "gender" readonly = "readonly" required="" ></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Birthday</label>
								<div class="col-md-4"><input type="text" id = "birthday" class="zx" name="daterange" readonly = "readonly" required="" onKeyPress="return noneonly(this, event)"></div>
								<label class="col-sm-2 control-label">Marital status</label>
								<div class="col-md-4"><input type = "text" class = "zx" id = "marital" name = "gender" readonly = "readonly" required="" ></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Address</label>
								<div class="col-md-7"><input type="text" id = "address" class="zxc" name = "address" readonly = "readonly" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">City</label>
								<div class="col-md-4"><input type="text" id = "city" class="zx" name = "city" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">ZIP</label>
								<div class="col-md-4"><input type="text" id = "zip" class="zx" name = "zip" maxlength="4" onKeyPress="return numbersonly(this, event)" readonly = "readonly" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-md-4"><input type="text" id = "email" class="zx" name = "email" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Mobile</label>
								<div class="col-md-4"><input type="text" id = "cellnum" class="zx" maxlength="11" name = "mobile" onKeyPress="return numbersonly(this, event)" readonly = "readonly" required=""></div>
							</div>
																<div class="form-group">
									<h2>Employee information<h2>
									</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Type</label>
								<div class="col-md-4"><input type="text" id = "employeetype" class="zx" name = "type" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Department</label>
								<div class="col-md-4"><input type="text" id = "department" class="zx" name = "department" readonly = "readonly" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Rate</label>
								<div class="col-md-4"><input type="text" id = "rate" class="zx" name = "rate" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Taxcode</label>
								<div class="col-md-4"><input type = "text" class = "zx" id = "taxcode" name = "gender" readonly = "readonly" required="" ></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">PhilHealth no</label>
								<div class="col-md-4"><input type="text" id = "philhealth" class="zx" name = "philhealth" data-mask="99-999999999-9" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">HDMF</label>
								<div class="col-md-4"><input type="text" id = "pagibig" class="zx" name = "pagibig" data-mask="9999-9999-9999" readonly = "readonly" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">TIN</label>
								<div class="col-md-4"><input type="text" id = "tin" class="zx" name = "tin" data-mask="999-999-999" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">SSS</label>
								<div class="col-md-4"><input type="text" id = "sss" class="zx" name = "sss" data-mask="99-9999999-9" readonly = "readonly" required=""></div>
							</div>
							<div class="form-group">
									<label class="col-sm-2 control-label">Shift</label>
								<div class="col-md-4"><input type="text" id = "shift" class="zx" name = "shift" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Rest day</label>
									<div class="col-md-4"><input type = "text" class = "zx" id = "restday" name = "gender" readonly = "readonly" required="" ></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Date hired</label>
								<div class="col-md-4"><input type="text" id = "datehired" class="zx" name="daterange2" readonly = "readonly" required=""></div>
								<label class="col-sm-2 control-label">Job title</label>
								<div class="col-md-4"><input type="text" id = "jobtitle" class="zx" name = "jobtitle" readonly = "readonly" onKeyPress="return lettersonly(this, event)" required=""></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Password</label>
								<div class="col-md-4"> <input type="text" id = "password" name = "password"class="zx" readonly = "readonly" required="" required=""></div>
							</div>		
					</div>
				</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>