<!DOCTYPE html>
<html>
	<head>
		<?php
			include('menuheader.php');
		?>

		<?php
			include('dbconfig.php');
			if(isset($_POST['idss'])){
				$ids2 = $_POST['idss'];
				if ($result = $mysqli->query("SELECT * FROM employee where employee_id=ids2")){
					if ($result->num_rows > 0){
						while ($row = $result->fetch_object()){
							$tim=$row->employee_vacationleave;
						}
					}
				}	
			}	
		?>
		<title>Leave Application</title>
		<style>
			.btn3{
				margin-left:6.5em;
			}
			.btn2{
				margin-left:-10em;
			}
		</style>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		<script>
		function clearThis(target){
			document.getElementById("validate").disabled=true;
        	target.value= "";
			
			
    	}
		$(function() {
			$( ".ename" ).autocomplete({
				source: 'search.php'
			});
			$( ".ename" ).autocomplete({
			select: function(e, ui) {
               		document.getElementById("validate").disabled=false;
               		document.getElementById("validate").focus();
               		}
             });

		});

		</script>
		<script type="text/javascript">
		function updateInput(){

			var valu = document.getElementById("name").value;
			var numb = valu.match(/\d/g);
			numb = numb.join("");

	           
	 		document.getElementById("idsss").value=numb;

			}		
		</script>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange1"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
				$('input[name="daterange2"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
				$('input[name="daterange3"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
				$('input[name="daterange4"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script>
			function clearThis(target){
	        	target.value= "";
	    	}
		</script>
		<script type="text/javascript">
		$(document).ready(function(){
			error=function(){
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
				toastr.error('Already applied leave on that date!');
			}
			history.replaceState({}, "Title", "adminleaveapplication.php");				
		});
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
				toastr.error('Insufficient leave credits!');
			}
			history.replaceState({}, "Title", "adminleaveapplication.php");				
		});
		$(document).ready(function(){
			success2=function(){
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
				toastr.success('Successfully applied for leave!');
			}
			history.replaceState({}, "Title", "adminleaveapplication.php");				
		});
		</script>

		<?php
		if(isset($_GET['error']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'error();'
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
		if(isset($_GET['able']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'success2();'
					, '});' 
			   , '</script>'
			;	
		}
		?>
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Leave Application</h5>
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
					<?php
							include('dbconfig.php');
							if(isset($_POST['ss'])){
								$ids2=$_POST['ss'];

								if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_id =$ids2")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										while ($row1 = mysqli_fetch_object($result1))
											
										{
											$eid = $row1->employee_id;
											$inc = $row1->employee_incentive;
											$vl = $row1->employee_vacationleave;
											$sl = $row1->employee_sickleave;
											$ml = $row1->employee_maternityleave;
											$pl = $row1->employee_paternityleave;
											$spl = $row1->employee_singleparentleave;
											$nameu = $row1->employee_firstname." ".$row1->employee_lastname;

											echo "<div class='ibox-content'>
													<form id = 'myForm1' method='POST' class='form-horizontal'>
														<div class='form-group'>
															<div class='col-md-4'><input type='hidden' name='ss' onblur='this.form.submit()' id = 'idsss' name = 'empid' value='".$eid."' class='form-control ename'></div>
														</div>
													</form>
													<form id = 'myForm' method='POST' action = 'leaveapplicationexe.php' class='form-horizontal'>
													<input type='hidden' id = 'idsss' name = 'empid' value='".$eid."' class='form-control ename'>
													<div class='form-group'>
								<label class='col-sm-4 control-label'>Name</label>
								<div class='col-md-4'><input type='text' id = 'name' onpaste='return false' onDrop='return false' value='".$nameu."' class='form-control ename' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>PRD Credits</label>
								<div class='col-md-4'><input type='text' value='".$inc."' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>VL Credits</label>
								<div class='col-md-4'><input type='text' id='vlcred' value='".$vl."' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>SL Credits</label>
								<div class='col-md-4'><input type='text' value='".$sl."' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>ML Credits</label>
								<div class='col-md-4'><input type='text' value='".$ml."' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>PL Credits</label>
								<div class='col-md-4'><input type='text' value='".$pl."' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>SPL Credits</label>
								<div class='col-md-4'><input type='text' value='".$spl."' class='form-control' readonly></div>
							</div>
							<div class='hr-line-dashed'></div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Type</label>
								<div class='col-md-4'><select id = 'leavetype' name = 'leavetype' onclick='updateInput()' class = 'form-control' required='' data-default-value='z' ><option selected='true' disabled='disabled' value = ''>Select type...</option><option value = 'Leave without pay'>Leave without pay</option><option value = 'Paid rest day / Incentive'>Paid rest day / Incentive</option><option value = 'Vacation leave'>Vacation leave</option><option value = 'Sick leave'>Sick leave</option><option value = 'Maternity leave'>Maternity leave</option><option value = 'Paternity leave'>Paternity leave</option><option value = 'Single-parent leave'>Single-parent leave</option></select></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Length</label>
								<div class='col-md-4'><select id = 'length' name = 'length' class = 'form-control' data-default-value='Full' required=''><option value = 'Full' selected>Full day leave</option><option value = 'Half'>Half day leave</option></select></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date' type='text'  onpaste='return false' onDrop='return false' class='form-control' name='daterange1' required='' onKeyPress='return noneonly(this, event)'/> </div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date1' type='text' onpaste='return false' onDrop='return false' class='form-control' name='daterange2' onKeyPress='return noneonly(this, event)'/> </div>
							
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date2' type='text' onpaste='return false' onDrop='return false' class='form-control' name='daterange3' onKeyPress='return noneonly(this, event)'/> </div>
							
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date3' type='text' onpaste='return false' onDrop='return false' class='form-control' name='daterange4' onKeyPress='return noneonly(this, event)'/> </div>
							
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Reason</label>
								<div class='col-md-4'><input type='text' id = 'reason' name = 'reason' onpaste='return false' onDrop='return false' class='form-control' required=''></div>
							</div>
							<div class='hr-line-dashed'></div>
							<div class='form-group'>
								<div class='col-md-3'></div>
								<div class='col-md-5'><button id = 'submit' name='adleavesub' type='submit' class='btn btn3 btn-w-m btn-primary'>Submit</button></div>
								<div class='col-md-4'><button type='button' onclick = 'myFunction()' class='btn btn2 btn-w-m btn-white'>Reset</button></div>
							</div>
						</form>";
										}
									}
								}
							}
							else{
								echo "<div class='ibox-content'>
						<form id = 'myForm1' method='POST' class='form-horizontal'>
							<div class='form-group'>
								
								<div class='col-md-4'><input type='hidden' name='ss' onblur='this.form.submit()' id = 'idsss' class='form-control ename'></div>
							<div class='col-md-5'><button id = 'validate' onclick='updateInput()' disabled='true' type='submit' class='btn btn3 btn-w-m btn-primary'>Validate</button></div>
							</div>
						</form>
						<form id = 'myForm' method='POST' action = 'leaveapplicationexe.php' class='form-horizontal'>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Name</label>
								<div class='col-md-4'><input type='text' onfocus='clearThis(this)' onpaste='return false' onDrop='return false' id = 'name' class='form-control ename'></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>PRD Credits</label>
								<div class='col-md-4'><input type='text' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>VL Credits</label>
								<div class='col-md-4'><input type='text' id='vlcred' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>SL Credits</label>
								<div class='col-md-4'><input type='text' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>ML Credits</label>
								<div class='col-md-4'><input type='text' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>PL Credits</label>
								<div class='col-md-4'><input type='text' class='form-control' readonly></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>SPL Credits</label>
								<div class='col-md-4'><input type='text' class='form-control' readonly></div>
							</div>
							<div class='hr-line-dashed'></div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Type</label>
								<div class='col-md-4'><select id = 'leavetype' onclick='updateInput()' disabled class = 'form-control' data-default-value='z' required=''><option selected='true' disabled='disabled' value = ''>Select type...</option><option value = 'Leave without pay'>Leave without pay</option><option value = 'Paid rest day / Incentive'>Paid rest day / Incentive</option><option value = 'Vacation leave'>Vacation leave</option><option value = 'Sick leave'>Sick leave</option><option value = 'Maternity leave'>Maternity leave</option><option value = 'Paternity leave'>Paternity leave</option><option value = 'Single-parent leave'>Single-parent leave</option></select></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Length</label>
								<div class='col-md-4'><select id = 'length' disabled class = 'form-control' data-default-value='Full' required=''><option value = 'Full' selected>Full day leave</option><option value = 'Half'>Half day leave</option></select></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date' type='text'  disabled class='form-control' name='daterange1' required='' onKeyPress='return noneonly(this, event)'/> </div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date1' type='text'  disabled class='form-control' name='daterange2' onKeyPress='return noneonly(this, event)'/> </div>
							
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date2' type='text'  disabled class='form-control' name='daterange3' onKeyPress='return noneonly(this, event)'/> </div>
							
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Date</label>
								<div class='col-md-4'> <input id = 'date3' type='text' disabled class='form-control' name='daterange4' onKeyPress='return noneonly(this, event)'/> </div>
							
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Reason</label>
								<div class='col-md-4'><input type='text' id = 'reason' disabled class='form-control' required=''></div>
							</div>
							<div class='hr-line-dashed'></div>
							<div class='form-group'>
								<div class='col-md-7'></div>
								<button id = 'submit'  disabled='true' type='submit' class='btn btn3 btn-w-m btn-primary'>Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type='button' onclick = 'myFunction()' class='btn btn2 btn-w-m btn-white'>Reset</button>
							</div>
						</form>";
							}
					?>
					
				</div>
			</div>
        </div>	
		
		<?php
			include('menufooter.php');
		?>
	</body>
</html>