<?php
include("dbconfig.php");


$empid = $_REQUEST['empid'];

// echo '<div style= "max-height:100px; min-height:100px; overflow-y:scroll;" id="leavedetails" class="tab-pane" >
// 								<div class="panel-body">
// 									<table class=\'footable table table-stripped\' data-page-size=\'20\' data-filter=#filter>						
// 										<thead>
// 											<tr>
// 												<th>Leave Type</th>
// 												<th>From</th>
// 												<!--th>To</th-->
// 												<!--th>Days</th-->
// 												<th>Approved By</th>
// 												<th>Approve Date</th>
// 											</tr>
// 										</thead>
// 										<tbody>';
											

?>
<head>
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

			 
			  //alert("hello!"+lastname);
			 
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
			
		
		<script src="js/keypress.js"></script>
</head>
<body>
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
									<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
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
											
												$leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id=$empid");
													if($leavedetails->num_rows > 0){
														while($leave = $leavedetails->fetch_object()){
															echo '<tr>';
															echo '<td>'.$leave->leave_type.'</td>';
															echo '<td>'.$leave->leave_start.'</td>';
															echo '<td>'.$leave->leave_status.'</td>';
															echo '<td>'.$leave->leave_approvedby.'</td>';
															echo '<td>'.$leave->leave_approvaldate.'</td>';
															echo '</tr>';
														}
													}
												
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
				</body>


