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
        <title>Add Employee</title>
		
		<style>
			.btn1{
				margin-left:283%;
			}
			.btn2{
				margin-left:114%;
			}
			.cap{
				text-transform: capitalize;
			}
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
		</style>
				<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- Clock picker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<script>
			function myFunction() {
				document.getElementById("resetForm").reset();
			}
		</script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>

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
				$('input[name="daterange1"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>		
		
		<!--<script type="text/javascript">
		   function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
				$('#targetLayer').attr('src', e.target.result);
			   }
				reader.readAsDataURL(input.files[0]);
			   }
			}
		</script>
		-->
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript">
			$(document).ready(function (e) {
				$("#uploadForm").on('submit',(function(e) {
					e.preventDefault();
					$.ajax({
						url: "upload.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
						cache: false,
						processData:false,
						success: function(data)
						{
						$("#targetLayer").html(data);
						},
						error: function() 
						{
						} 	        
				   });
				}));
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
				toastr.success("Employee successfully added!");
				history.replaceState({}, "Title", "addnew.php");
		}
		
		
	});
	</script>
		<?php
		if(isset($_GET['added']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited();'
					, '});' 
			   
			   , '</script>'
			;	
		}
?>
	</head>

		<script src="js/keypress.js"></script>
	</head>
	<?php
		include("dbconfig.php");
		$resultb = $mysqli->query("SELECT * FROM employee WHERE employee_id = (SELECT MAX(employee_id) FROM employee)")->fetch_array();
		$maxes = $resultb['employee_id'];
	?>
    <body>
        <div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Employee</h5>
						<div class="ibox-tools">
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu dropdown-user">
								<li><a href="#">Config option 1</a></li>
								<li><a href="#">Config option 2</a></li>
							</ul>
							<a class="close-link"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">          
							<div class="col-md-12">
								<form action="addnewexe.php" id="resetForm"  method="post" class="form-horizontal" enctype="multipart/form-data">
									<div id = "success" class="alert alert-success alert-dismissable" style="display: none;">
										<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
									   Successfully added new employee. <a class="alert-link" href="#">Alert Link</a>.
									</div>
									<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								   Please fill all fields.
									</div>
									<div class="row"> 
									<div class="col-md-5">
									</div>
										<div class="col-sm-4">
											<img class="responsive" name = "targetLayer" id="output" src="img/user/default.png" width="150px" height="150px" id="img1">   
											<input onchange="loadFile(event)"  type="file" id="blogo" name="file" accept="image/*" required>
											<input type="hidden" name="userID" id="userID" value="<?php echo $user; ?>">
										</div>
									</div>
									<div class="form-group">
									<h2>Personal information<h2>
									</div>
									

									<div class="form-group">
										<label class="col-md-2 control-label ">Employee ID</label>
										<div class="col-md-4"><input type="text" id = "empid" class="form-control" value = "<?php echo $maxes + 1;?>" readonly = "readonly"></div>
									<?php
									
									if(isset($_GET['id305'])){
									$ISSS=$_GET['id305'];
												if ($result1 = $mysqli->query("SELECT * FROM emp_data  WHERE id = '$ISSS'")){
													while ($row = mysqli_fetch_object($result1)){
														//dito ung data na kukunin mo joshua
														$lastname = $row->info_l_name;
														$firstname = $row->info_f_name;
														$middlename = $row->info_m_name;
														$gender = $row->info_gender;
														$birthday = $row->info_bday;
														$marital = $row->info_status;
														$address = $row->info_pre_home_add;
														$city = $row->info_city;
														$email = $row->info_email;
														$mobile = $row->info_mob_num;
													}
												}

											echo '<label class="col-md-2 control-label">Last name</label>
											<div class="col-md-4"><input type="text" value="'.$lastname.'" readonly id = "lastname" onpaste="return false" onDrop="return false" class="form-control cap" name = "lastname" required="" onKeyPress="return lettersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">First name</label>
											<div class="col-md-4"><input type="text" value="'.$firstname.'" readonly id = "firstname" onpaste="return false" onDrop="return false" class="form-control cap" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
											<label class="col-md-2 control-label">Middle name</label>
											<div class="col-md-4"><input type="text" value="'.$middlename.'" readonly  id = "middlename" onpaste="return false" onDrop="return false"  class="form-control cap" name = "middlename" required="" onKeyPress="return lettersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Gender</label>
											<div class="col-md-4"><input type="text" value="'.$gender.'" readonly  id = "gender" onpaste="return false" onDrop="return false"  class="form-control cap" name = "gender"></div>
											<label class="col-md-2 control-label">Birthdate</label>
											<div class="col-md-4"><input id = "birthday" value="'.$birthday.'" readonly id = "date" type="text"  class="form-control" required="" name="daterange1" onKeyPress="return noneonly(this, event)"/></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Marital Status</label>
											<div class="col-md-4"><input type="text" value="'.$marital.'" readonly  id = "marital" onpaste="return false" onDrop="return false"  class="form-control cap" name = "marital"></div>
										</div>
										<div class="hr-line-dashed"></div><BR>
										<div class="form-group"><h2>Contact information<h2></div>
										<div class="form-group">
											<label class="col-md-2 control-label">Address</label>
											<div class="col-md-10"><input id = "address" value="'.$address.'" readonly onpaste="return false" onDrop="return false" type="text" class="form-control cap" name = "address" required=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">City</label>
											<div class="col-md-4"><input type="text" value="'.$city.'" readonly id = "city" onpaste="return false" onDrop="return false" class="form-control cap" name = "city" required="" onKeyPress="return lettersonly(this, event)"></div>
											<label class="col-md-2 control-label">ZIP</label>
											<div class="col-md-4"><input type="text" id = "zip" class="form-control" data-mask="9999" name = "zip" required="" onKeyPress="return numbersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Email</label>
											<div class="col-md-4"><input type="email" value='.$email.' readonly id = "email" onpaste="return false" onDrop="return false" class="form-control" required="" name = "email"></div>
											<label class="col-md-2 control-label">Mobile number</label>
											<div class="col-md-4"><input type="text" value='.$mobile.' readonly id = "mobile" onpaste="return false" onDrop="return false" class="form-control" name = "mobile" required="" onKeyPress="return numbersonly(this, event)"></div>
										</div>
										<div class="hr-line-dashed"></div><BR>
										<div class="form-group"><h2>Employee information<h2></div>
										<div class="form-group">
										<label class="col-md-2 control-label">Date hired</label>
												<div class="col-md-4"><input id = "datehired"  id = "date" type="text"  onpaste="return false" onDrop="return false" class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
											<label class="col-md-2 control-label">Designation</label>
											<div class="col-md-4"><input type="text" id = "jobtitle" onpaste="return false" onDrop="return false" class="form-control cap" name = "jtitle" required="" onKeyPress="return lettersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Department</label>
											<div class="col-md-4"><input type="text" id = "department" onpaste="return false" onDrop="return false" class="form-control cap" required="" name = "department"></div>
											<label class="col-md-2 control-label">Employment Status</label>
											<div class="col-md-4"><select class = "form-control" id = "empstatus" name="empstatus" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select Employment Status...</option>  <option value = "Project">Project</option><option value = "Contractual">Contractual</option><option value = "Probationary">Probationary</option><option value = "Regular">Regular</option><option value = "Student Training">Student Training</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Tax code</label>
											<div class="col-md-4"><select class = "form-control" id = "taxcode" name = "taxcode" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select tax code...</option><option value = "Z">Z</option><option value = "S/ME">S/ME</option><option value = "ME1/S1">ME1/S1</option><option value = "ME2/S2">ME2/S2</option><option value = "ME3/S3">ME3/S3</option><option value = "ME4/S4">ME4/S4</option></select></div>
											<label class="col-md-2 control-label">TIN</label>
											<div class="col-md-4"> <input type="text" name="tin" id = "tin" onpaste="return false" onDrop="return false"class="form-control" data-mask="999-999-999" placeholder=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">SSS</label>
											<div class="col-md-4"> <input type="text"  id = "sss" name="sss" onpaste="return false" onDrop="return false" class="form-control" data-mask="99-9999999-9" placeholder=""></div>
											<label class="col-md-2 control-label">Philhealth</label>
											<div class="col-md-4"> <input type="text" name="philhealth" id = "philhealth" onpaste="return false" onDrop="return false" class="form-control" data-mask="99-999999999-9" placeholder=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">HDMF</label>
											<div class="col-md-4"><input type="text" name="pagibig" id = "pagibig" onpaste="return false" onDrop="return false"class="form-control" data-mask="9999-9999-9999" placeholder=""></div>
											<label class="col-md-2 control-label">Payment Schedule</label>
											<div class="col-md-4"><select class = "form-control" id = "rate" name="pay_method" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select Payment Schedule...</option>  <option value = "Monthly">Monthly</option><option value = "Semi-monthly">Semi-monthly</option><option value = "Weekly">Weekly</option><option value = "Daily">Daily</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Basic Pay</label>
											<div class="col-md-4"><input type="text" id = "rate" onpaste="return false" onDrop="return false"class="form-control" name = "monthly" required="" onKeyPress="return doubleonly(this, event)"></div>
											<label class="col-md-2 control-label">Shift type</label>
											<div class="col-md-4"><select class = "form-control" id = "emptype" name="shift" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select shift type...</option>  <option value = "Fixed">Fixed</option><option value = "Flexible">Flexible</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Shift start</label>
											<div class="col-md-4"><input type="text" id = "shift" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" name = "shiftstart"></div>
											<label class="col-md-2 control-label">Shift end</label>
											<div class="col-md-4"><input type="text" id = "shift2" onpaste="return false" onDrop="return false"class="form-control timepicker1" required="" name = "shiftend"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Rest day</label>
											<div class="col-md-2"><select class = "form-control" id = "restday" name = "restday" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select rest day...</option><option value = "1">Monday</option><option value = "Tuesday">Tuesday</option><option value = "Wednesday">Wednesday</option><option value = "Thursday">Thursday</option><option value = "Friday">Friday</option><option value = "Saturday">Saturday</option><option value = "Sunday">Sunday</option></select></div>
											<div class="col-md-2"><select class = "form-control" id = "restday2" name = "restday2" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select rest day...</option><option value = "1">Monday</option><option value = "Tuesday">Tuesday</option><option value = "Wednesday">Wednesday</option><option value = "Thursday">Thursday</option><option value = "Friday">Friday</option><option value = "Saturday">Saturday</option><option value = "Sunday">Sunday</option></select></div>
											<label class="col-md-2 control-label">Account No.:</label>
											<div class="col-md-4"><input type="text" id = "acctno" onpaste="return false" onDrop="return false" class="form-control cap" name = "acctno" required=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Access level</label>
											<div class="col-md-4"><select class = "form-control" id = "access" name = "access" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select access level...</option><option value = "1">1</option><option value = "2">2</option><option value = "3">3</option><option value = "4">4</option></select></div>
											<label class="col-md-2 control-label">Password</label>
											<div class="col-md-4"> <input type="text" id = "password" name="password" onpaste="return false" onDrop="return false" class="form-control" required=""></div>
										</div>';
									}
									else{
										echo'<label class="col-md-2 control-label">Last name</label>
											<div class="col-md-4"><input type="text"  id = "lastname" onpaste="return false" onDrop="return false" class="form-control cap" name = "lastname" required="" onKeyPress="return lettersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">First name</label>
											<div class="col-md-4"><input type="text"  id = "firstname" onpaste="return false" onDrop="return false" class="form-control cap" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
											<label class="col-md-2 control-label">Middle name</label>
											<div class="col-md-4"><input type="text"   id = "middlename" onpaste="return false" onDrop="return false"  class="form-control cap" name = "middlename" required="" onKeyPress="return lettersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Gender</label>
											<div class="col-md-4"><select class = "form-control" id = "gender" name="gender" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select Gender...</option>  <option value = "Male">Male</option><option value = "Female">Female</option></select></div>
											<label class="col-md-2 control-label">Birthdate</label>
											<div class="col-md-4"><input id = "birthday"  id = "date" type="text"  class="form-control" required="" name="daterange1" onKeyPress="return noneonly(this, event)"/></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Marital Status</label>
											<div class="col-md-4"><select class = "form-control" id = "marital" name="marital" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select marital...</option>  <option value = "Single">Single</option><option value = "Married">Married</option><option value = "Divorced">Divorced</option><option value = "Widowed">Widowed</option><option value = "Separated">Separated</option></select></div>
										</div>
										<div class="hr-line-dashed"></div><BR>
										<div class="form-group"><h2>Contact information<h2></div>
										<div class="form-group">
											<label class="col-md-2 control-label">Address</label>
											<div class="col-md-10"><input id = "address"  onpaste="return false" onDrop="return false" type="text" class="form-control cap" name = "address" required=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">City</label>
											<div class="col-md-4"><input type="text"  id = "city" onpaste="return false" onDrop="return false" class="form-control cap" name = "city" required="" onKeyPress="return lettersonly(this, event)"></div>
											<label class="col-md-2 control-label">ZIP</label>
											<div class="col-md-4"><input type="text" id = "zip" class="form-control" data-mask="9999" name = "zip" required="" onKeyPress="return numbersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Email</label>
											<div class="col-md-4"><input type="email"  id = "email" onpaste="return false" onDrop="return false" class="form-control" required="" name = "email"></div>
											<label class="col-md-2 control-label">Mobile number</label>
											<div class="col-md-4"><input type="text"  id = "mobile" onpaste="return false" onDrop="return false" class="form-control" name = "mobile" required="" onKeyPress="return numbersonly(this, event)"></div>
										</div>
										
										<div class="hr-line-dashed"></div><BR>
										<div class="form-group"><h2>Employee information<h2></div>
										<div class="form-group">
										<label class="col-md-2 control-label">Date hired</label>
												<div class="col-md-4"><input id = "datehired"  id = "date" type="text"  onpaste="return false" onDrop="return false" class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
											<label class="col-md-2 control-label">Designation</label>
											<div class="col-md-4"><input type="text" id = "jobtitle" onpaste="return false" onDrop="return false" class="form-control cap" name = "jtitle" required="" onKeyPress="return lettersonly(this, event)"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Department</label>
											<div class="col-md-4"><input type="text" id = "department" onpaste="return false" onDrop="return false" class="form-control cap" required="" name = "department"></div>
											<label class="col-md-2 control-label">Employment Status</label>
											<div class="col-md-4"><select class = "form-control" id = "empstatus" name="empstatus" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select Employment Status...</option>  <option value = "Project">Project</option><option value = "Contractual">Contractual</option><option value = "Probationary">Probatisonary</option><option value = "Regular">Regular</option><option value = "Student Training">Student Training</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Tax code</label>
											<div class="col-md-4"><select class = "form-control" id = "taxcode" name = "taxcode" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select tax code...</option><option value = "Z">Z</option><option value = "S/ME">S/ME</option><option value = "ME1/S1">ME1/S1</option><option value = "ME2/S2">ME2/S2</option><option value = "ME3/S3">ME3/S3</option><option value = "ME4/S4">ME4/S4</option></select></div>
											<label class="col-md-2 control-label">TIN</label>
											<div class="col-md-4"> <input type="text" name="tin" id = "tin" onpaste="return false" onDrop="return false"class="form-control" data-mask="999-999-999" placeholder=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">SSS</label>
											<div class="col-md-4"> <input type="text"  id = "sss" name="sss" onpaste="return false" onDrop="return false" class="form-control" data-mask="99-9999999-9" placeholder=""></div>
											<label class="col-md-2 control-label">Philhealth</label>
											<div class="col-md-4"> <input type="text" name="philhealth" id = "philhealth" onpaste="return false" onDrop="return false" class="form-control" data-mask="99-999999999-9" placeholder=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">HDMF</label>
											<div class="col-md-4"><input type="text" name="pagibig" id = "pagibig" onpaste="return false" onDrop="return false"class="form-control" data-mask="9999-9999-9999" placeholder=""></div>
											<label class="col-md-2 control-label">Payment Schedule</label>
											<div class="col-md-4"><select class = "form-control" id = "rate" name="pay_method" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select Payment Schedule...</option>  <option value = "Monthly">Monthly</option><option value = "Semi-monthly">Semi-monthly</option><option value = "Weekly">Weekly</option><option value = "Daily">Daily</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Basic Pay</label>
											<div class="col-md-4"><input type="text" id = "rate" onpaste="return false" onDrop="return false"class="form-control" name = "monthly" required="" onKeyPress="return doubleonly(this, event)"></div>
											<label class="col-md-2 control-label">Shift type</label>
											<div class="col-md-4"><select class = "form-control" id = "emptype" name="shift" value = "Select" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select shift type...</option>  <option value = "Fixed">Fixed</option><option value = "Flexible">Flexible</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Shift start</label>
											<div class="col-md-4"><input type="text" id = "shift" onpaste="return false" onDrop="return false" class="form-control timepicker1" required="" name = "shiftstart"></div>
											<label class="col-md-2 control-label">Shift end</label>
											<div class="col-md-4"><input type="text" id = "shift2" onpaste="return false" onDrop="return false"class="form-control timepicker1" required="" name = "shiftend"></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Rest day</label>
											<div class="col-md-4"><select class = "form-control" id = "restday" name = "restday" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select rest day...</option><option value = "1">Monday</option><option value = "Tuesday">Tuesday</option><option value = "Wednesday">Wednesday</option><option value = "Thursday">Thursday</option><option value = "Friday">Friday</option><option value = "Saturday">Saturday</option><option value = "Sunday">Sunday</option></select></div>
											<label class="col-md-2 control-label">Rest day</label>
											<div class="col-md-4"><select class = "form-control" id = "restday2" name = "restday2" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select rest day...</option><option value = "1">Monday</option><option value = "Tuesday">Tuesday</option><option value = "Wednesday">Wednesday</option><option value = "Thursday">Thursday</option><option value = "Friday">Friday</option><option value = "Saturday">Saturday</option><option value = "Sunday">Sunday</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Account No.:</label>
											<div class="col-md-4"><input type="text" id = "acctnum" onpaste="return false" onDrop="return false" class="form-control cap" name = "acctnum" required=""></div>
											<label class="col-md-2 control-label">Payslip Password</label>
											<div class="col-md-4"> <input type="text" id = "pwpassword" name="pwpassword" onpaste="return false" onDrop="return false" class="form-control" required=""></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Login Password</label>
											<div class="col-md-4"> <input type="text" id = "password" name="password" onpaste="return false" onDrop="return false" class="form-control" required=""></div>
											<label class="col-md-2 control-label">Access level</label>
											<div class="col-md-4"><select onchange="dis()" class = "form-control" id = "access" name = "access" required="" data-default-value="z"><option selected="true" disabled="disabled" value = "">Select access level...</option><option value = "1">1</option><option value = "2">2</option><option value = "3">3</option><option value = "4">4</option></select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Team #1</label>
											<div class="col-md-4"><select id = "teamname" class="form-control"  data-default-value="z" name="teamname" required=""><option selected="true" disabled="disabled" value = "">Select team...</option></div>';
											include("dbconfig.php");
											if ($result1 = $mysqli->query("SELECT * FROM team")) {//get records from db
												if ($result1->num_rows > 0) { //display records if any
													while ($row1 = mysqli_fetch_object($result1)) { 
														echo '<option value='.$row1->team_name."\">".$row1->team_name. '</option>';
													}
												}
											}
										echo '</select></div>
										<label class="col-md-2 control-label">Team #2</label>
											<div class="col-md-4"><select id = "teamname1" class="form-control"  data-default-value="z" name="teamname" required=""><option selected="true" disabled="disabled" value = "">Select team...</option></div>';
											include("dbconfig.php");
											if ($result1 = $mysqli->query("SELECT * FROM team")) {//get records from db
												if ($result1->num_rows > 0) { //display records if any
													while ($row1 = mysqli_fetch_object($result1)) { 
														echo '<option value='.$row1->team_name."\">".$row1->team_name. '</option>';
													}
												}
											}
										echo '</select></div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Team #3</label>
											<div class="col-md-4"><select id = "teamname2" class="form-control"  data-default-value="z" name="teamname" required=""><option selected="true" disabled="disabled" value = "">Select team...</option></div>';
											include("dbconfig.php");
											if ($result1 = $mysqli->query("SELECT * FROM team")) {//get records from db
												if ($result1->num_rows > 0) { //display records if any
													while ($row1 = mysqli_fetch_object($result1)) { 
														echo '<option value='.$row1->team_name."\">".$row1->team_name. '</option>';
													}
												}
											}
										echo '</select></div>
											<label class="col-md-2 control-label">Team #4</label>
											<div class="col-md-4"><select id = "teamname3" class="form-control"  data-default-value="z" name="teamname" required=""><option selected="true" disabled="disabled" value = "">Select team...</option></div>';
											include("dbconfig.php");
											if ($result1 = $mysqli->query("SELECT * FROM team")) {//get records from db
												if ($result1->num_rows > 0) { //display records if any
													while ($row1 = mysqli_fetch_object($result1)) { 
														echo '<option value='.$row1->team_name."\">".$row1->team_name. '</option>';
													}
												}
											}
										echo '</select></div>
										</div>';
									}
									?>
									<script>
									function dis(){
										var val=document.getElementById("access").value;
											if(val==1 || val==2 || val==4){
											 document.getElementById("teamname1").disabled=true;
											 document.getElementById("teamname2").disabled=true;
											 document.getElementById("teamname3").disabled=true;
											}else if(val==3){

											 document.getElementById("teamname1").disabled=false;
											 document.getElementById("teamname2").disabled=false;
											 document.getElementById("teamname3").disabled=false;
											}
									}
									</script>
									<br><br><div class="col-md-4">
									<button id ="submit" type="submit" class="btn btn1 btn-w-m btn-primary">Submit</button>
									</div>
									<div class="col-md-4">
										<button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
									</div>
								</form>		 
							</div>
						</div>
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
            include('menufooter.php');
        ?>
    </body>

</html>
