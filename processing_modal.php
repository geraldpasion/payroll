<?php
include("dbconfig.php");
include("payroll_compute2.php");

echo '<style>
	.form-horizontal .control-label{
		/* text-align:right; */
		text-align:left;
		}
		.modal-dialog {
		  width: 1047px;
		}

		.modal-content {
		  width: 1047px;
		  margin-left: 80px;
		}
		input{
		border: none;
		border-color: transparent;
			
		}#sum{
			padding-left:25px;
			width:32%;
		}
		#sum2{
			padding-top:5px;
			padding-bottom:5px;
			text-align:center;
		}
		#sum3{
			padding-left:48px;
			width:46%;
		}
	</style>';

$empid = $_REQUEST['empid'];
$cutoff = $_REQUEST['cutoff'];
$submit = $_REQUEST['submit'];

$cutarray = array();
$cutarray = split(" - ", $cutoff);
$initialcut = $cutarray[0];
$endcut = $cutarray[1];

$payroll_factor = $mysqli->query("SELECT * FROM payrollfactor")->fetch_object();
$factor = $payroll_factor->factor;

$emp_rate = $mysqli->query("SELECT * FROM employee WHERE employee_id=$empid")->fetch_object();
$empstatus = $emp_rate->employee_empstatus;
$taxcode = $emp_rate->employee_taxcode;
$paytype = $emp_rate->cutoff;
$monthly_rate = $emp_rate->employee_rate;
$m_rate = sprintf('%.2f', $monthly_rate);
$semi_rate = $monthly_rate/2;
$s_rate = sprintf('%.2f', $semi_rate);
$hourly_rate = HourlyRate($monthly_rate,$factor);
$h_rate = sprintf('%.2f', $hourly_rate);
$daily_rate = $hourly_rate * 8;
$d_rate = sprintf('%.2f', $daily_rate);
$minutes_rate = MinutesRate($hourly_rate);
$min_rate = sprintf('%.2f', $minutes_rate);

if($daily_rate == "0.00"){
	$daily_rate = "0";
}
if($hourly_rate == "0.00"){
	$hourly_rate = "0";
}

$results = $mysqli->query("SELECT * FROM totalcomputation WHERE EmployeeID=$empid AND CutoffID='".$cutoff."'")->fetch_array();
$comp_id = $results['CompID'];//$results->CompID;
$taxable_earnings = sprintf('%.2f',$results['TotalTaxableEarnings']);//->TotalTaxableEarnings);
$nontaxable_earnings = sprintf('%.2f',$results['TotalNonTaxableIncome']);//->TotalNonTaxableIncome);
$taxable_deductions = sprintf('%.2f',$results['TotalTaxableDeduction']);//->TotalTaxableDeduction);
$nontaxable_deductions = sprintf('%.2f',$results['TotalNonTaxableDeduction']);//->TotalNonTaxableDeduction);
$total_statutory_benefits= sprintf('%.2f',$results['TotalStatutoryBenefits']);//->TotalStatutoryBenefits);
$net_income_after_tax = sprintf('%.2f',$results['NetIncomeAfterTax']);//->NetIncomeAfterTax);
$net_taxable_income = sprintf('%.2f',$results['NetTaxableIncome']);//->NetTaxableIncome);
$net_pay = sprintf('%.2f',$results['NetPay']);//->NetPay);


		echo '<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-user modal-icon"></i>
					<h4 class="modal-title">Employee Information</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#paysettings">Salary and Wages</a></li>
								<li class=""><a data-toggle="tab" href="#summary">Summary</a></li>
								<li class=""><a data-toggle="tab" href="#details">Details</a></li>
								<li class=""><a data-toggle="tab" href="#earnings">Earnings</a></li>
								<li class=""><a data-toggle="tab" href="#deductions">Deductions</a></li>
								<li class=""><a data-toggle="tab" href="#leavedetails">Leave Details</a></li>
								<li class=""><a data-toggle="tab" href="#retro">Others</a></li>
							</ul>
							<div class="tab-content">
								<div id="paysettings" class="tab-pane tab-pane fade active in" >
									<div class="panel-body">
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Basic Pay:</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required="" value="'.$monthly_rate.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3">Employment Status:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$empstatus.'"></div>
											<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Semi-Monthly Rate:</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required="" value="'.$semi_rate.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Tax Code:</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$taxcode.'"></div>
										<div class="form-group"></div>
											<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Daily Rate:</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$d_rate.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Cut Off:</label>
											<div class="col-sm-3"><input type="text" id = "cutoff1" name="cutoff1" readonly = "readonly" readonly = "readonly" required="" value="'.$cutoff.'"></div>
											<br>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Hourly Rate:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$h_rate.'"></div>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Payment Schedule:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$paytype.'"></div>
									</div>
								</div>';

								//summary section
								//$taxable_earnings=

							echo   '<div id="summary" class="tab-pane" >
									<div class="panel-body">
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Total Taxable Earnings</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required="" value="'.$taxable_earnings.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3">Net Income After Tax</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly"  value="'.$net_income_after_tax.'"></div>
											<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Total Taxable Deduction</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required="" value="'.$taxable_deductions.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Total Non-Taxable Income</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$nontaxable_earnings.'"></div>
										<div class="form-group"></div>
											<br>
											<br>
										
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Total Statutory Benefits</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$total_statutory_benefits.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Total Non-Taxable Deduction</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$nontaxable_deductions.'"></div>
										<div class="form-group"></div>
											<br>
											<br>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Net Taxable Income</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$net_taxable_income.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Net Pay</label>
											<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required="" value="'.$net_pay.'"></div>
									</div>
								</div>';


								$amount = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id = '".$empid."' AND cutoff = '".$cutoff."'")->fetch_array();
								$hours = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '".$empid."' AND cutoff = '".$cutoff."'")->fetch_array();

								$absentAmt = sprintf('%.2f',$amount['absent']);
								$lateAmt = sprintf('%.2f',$amount['late']);
								$undertimeAmt = sprintf('%.2f',$amount['undertime']);
								$reghrsAmt = sprintf('%.2f',$amount['reg_hrs']);
								$regotAmt = sprintf('%.2f',$amount['reg_ot']);
								$nightdiffAmt = sprintf('%.2f',$amount['reg_nd']);
								$regotndAmt = sprintf('%.2f',$amount['reg_ot_nd']);
								$restotAmt = sprintf('%.2f',$amount['rst_ot']);
								$restot8Amt = sprintf('%.2f',$amount['rst_ot_grt8']);
								$restndAmt = sprintf('%.2f',$amount['rst_nd']);
								$restnd8Amt = sprintf('%.2f',$amount['rst_nd_grt8']);
								$legalotAmt = sprintf('%.2f',$amount['lh_ot']);
								$legalot8Amt = sprintf('%.2f',$amount['lh_ot_grt8']);
								$legalndAmt = sprintf('%.2f',$amount['lh_nd']);
								$legalnd8Amt = sprintf('%.2f',$amount['lh_nd_grt8']);
								$specialotAmt = sprintf('%.2f',$amount['sh_ot']);
								$specialot8Amt = sprintf('%.2f',$amount['sh_ot_grt8']);
								$specialndAmt = sprintf('%.2f',$amount['sh_nd']);
								$specialnd8Amt = sprintf('%.2f',$amount['sh_nd_grt8']);
								$legalrestotAmt = sprintf('%.2f',$amount['rst_lh_ot']);
								$legalrestot8Amt = sprintf('%.2f',$amount['rst_lh_ot_grt8']);
								$legalrestndAmt = sprintf('%.2f',$amount['rst_lh_nd']);
								$legalrestnd8Amt = sprintf('%.2f',$amount['rst_lh_nd_grt8']);
								$specialrestotAmt = sprintf('%.2f',$amount['rst_sh_ot']);
								$specialrestot8Amt = sprintf('%.2f',$amount['rst_sh_ot_grt8']);
								$specialrestndAmt = sprintf('%.2f',$amount['rst_sh_nd']);
								$specialrestnd8Amt = sprintf('%.2f',$amount['rst_sh_nd_grt8']);
								$leavehoursAmt = sprintf('%.2f',$amount['leave_hrs']);

								// $absent = $hours['absent'];
								// $late = $hours['late'];
								// $undertime = $hours['undertime'];
								// $reghrs = $hours['reg_hrs'];
								// $regot = $hours['reg_ot'];
								// $nightdiff = $hours['reg_nd'];
								// $regotnd = $hours['reg_ot_nd'];
								// $restot = $hours['rst_ot'];
								// $restot8 = $hours['rst_ot_grt8'];
								// $restnd = $hours['rst_nd'];
								// $restnd8 = $hours['rst_nd_grt8'];
								// $legalot = $hours['lh_ot'];
								// $legalot8 = $hours['lh_ot_grt8'];
								// $legalnd = $hours['lh_nd'];
								// $legalnd8 = $hours['lh_nd_grt8'];
								// $specialot = $hours['sh_ot'];
								// $specialot8 = $hours['sh_ot_grt8'];
								// $specialnd = $hours['sh_nd'];
								// $specialnd8 = $hours['sh_nd_grt8'];
								// $legalrestot = $hours['rst_lh_ot'];
								// $legalrestot8 = $hours['rst_lh_ot_grt8'];
								// $legalrestnd = $hours['rst_lh_nd'];
								// $legalrestnd8 = $hours['rst_lh_nd_grt8'];
								// $specialrestot = $hours['rst_sh_ot'];
								// $specialrestot8 = $hours['rst_sh_ot_grt8'];
								// $specialrestnd = $hours['rst_sh_nd'];
								// $specialrestnd8 = $hours['rst_sh_nd_grt8'];
								// $leavehours = $hours['leave_hrs'];


								echo '<div id="details" class="tab-pane" >
									<div class="panel-body">
										<div class="form-group">
											<table>
												<tr>
													<td id="sum"><b>Cut Off Period</b></td>
													<td id="sum2">'.$cutoff.'</td>  
													<td id="sum3"><b></b> </td>
													<td id="sum2"></td>  
												</tr>
												<tr>
													<td id="sum"><b>Absent</b></td>
													<td id="sum2">'.$absentAmt.'</td>  
													<td id="sum3"><b>Legal Holiday Restday OT > 8</b></td>
													<td id="sum2">'.$legalrestot8Amt.'</td>  
												</tr>
												<tr>';
													//<td id="sum"><b>Regular Hours</b></td>
													//<td id="sum2">'.$reghrsAmt.'</td>  
													echo '
													<td id="sum"><b>Leave</b></td>
													<td id="sum2">'.$leavehoursAmt.'</td> 
													<td id="sum3"><b>Legal Holiday Night Diff</b></td>
													<td id="sum2">'.$legalndAmt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Late</b></td>
													<td id="sum2">'.$lateAmt.'</td>  
													<td id="sum3"><b>Legal Holiday Night Diff > 8</b></td>
													<td id="sum2">'.$legalnd8Amt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Undertime</b></td>
													<td id="sum2">'.$undertimeAmt.'</td>  
													<td id="sum3"><b>Legal Holiday Restday Night Diff</b></td>
													<td id="sum2">'.$legalrestndAmt.'</td> 
												</tr>
												<tr>
													<td id="sum"><b>Night Differential</b></td>
													<td id="sum2">'.$nightdiffAmt.'</td>  
													<td id="sum3"><b>Legal Holiday Restday Night Diff > 8</b></td>
													<td id="sum2">'.$legalrestnd8Amt.'</td> 
												</tr>
												<tr>
													<td id="sum"><b>Regular OT</b></td>
													<td id="sum2">'.$regotAmt.'</td>  
													<td id="sum3"><b>Special Holiday OT</b></td>
													<td id="sum2">'.$specialotAmt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Regular OT Night Diff</b></td>
													<td id="sum2">'.$regotndAmt.'</td>  
													<td id="sum3"><b>Special Holiday OT > 8</b></td>
													<td id="sum2">'.$specialot8Amt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Restday OT</b></td>
													<td id="sum2">'.$restotAmt.'</td>  
													<td id="sum3"><b>Special Holiday Restday OT</b></td>
													<td id="sum2">'.$specialrestotAmt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Restday OT > 8</b></td>
													<td id="sum2">'.$restot8Amt.'</td>  
													<td id="sum3"><b>Special Holiday Restday OT > 8</b></td>
													<td id="sum2">'.$specialrestot8Amt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Restday Night Diff</b></td>
													<td id="sum2">'.$restndAmt.'</td>  
													<td id="sum3"><b>Special Holiday Night Diff</b></td>
													<td id="sum2">'.$specialndAmt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Restday Night Diff > 8</b></td>
													<td id="sum2">'.$restnd8Amt.'</td>  
													<td id="sum3"><b>Special Holiday Night Diff > 8</b></td>
													<td id="sum2">'.$specialnd8Amt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Legal Holiday OT</b></td>
													<td id="sum2">'.$legalotAmt.'</td>  
													<td id="sum3"><b>Special Holiday Restday Night Diff</b></td>
													<td id="sum2">'.$specialrestndAmt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Legal Holiday OT > 8</b></td>
													<td id="sum2">'.$legalot8Amt.'</td>  
													<td id="sum3"><b>Special Holiday Restday Night Diff > 8</b></td>
													<td id="sum2">'.$specialrestnd8Amt.'</td>  
												</tr>
												<tr>
													<td id="sum"><b>Legal Holiday Restday OT</b></td>
													<td id="sum2">'.$legalrestotAmt.'</td>
													<td id="sum3"><b></b></td>
													<td id="sum2"></td>';
													//<td id="sum3"><b>Leave Hours Total</b></td>
													//<td id="sum2">'.$leavehoursAmt.'</td> 
													echo'
												</tr>
											</table>	
										</div>
									</div>
								</div>


								<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="earnings" class="tab-pane" >
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
											<tbody>';

													$emp_earnings = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id='$empid' AND comp_id='$comp_id'");
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
										echo '</tbody>
										</table>
									</div>
								</div>

								<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="deductions" class="tab-pane" >
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
											<tbody>';
													$emp_deductions = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id='$empid' AND comp_id='$comp_id'");
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
										echo '</tbody>
										</table>
									</div>
								</div>

								<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="leavedetails" class="tab-pane" >
									<div class="panel-body">
										<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
											<thead>
												<tr>
													<th>Leave Type</th>
													<th>Leave Start</th>
													<th>Duration</th>
													<th>Status</th>
													<th>Managed By</th>
												</tr>
											</thead>
											<tbody>';
													$leave_det = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id='$empid' AND leave_status != 'Pending' AND leave_start BETWEEN '$initialcut' AND '$endcut'");
													if($leave_det->num_rows > 0){
														while($leave = $leave_det->fetch_object()){
															$duration = "00:00";
															if($leave->leave_halfday == 0) {
																$duration = "08:00";
															} else {
																$duration = "04:00";
															}
															echo '<tr>';
															echo '<td>'.$leave->leave_type.'</td>';
															echo '<td>'.$leave->leave_start.'</td>';
															echo '<td>'.$duration.'</td>';
															echo '<td>'.$leave->leave_status.'</td>';
															echo '<td>'.$leave->leave_approvedby.'</td>';
															echo '</tr>';
														}
													}
										echo '</tbody>
										</table>
									</div>
								</div>

								<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="retro" class="tab-pane" >
									<div class="panel-body">
										<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
											<thead>
												<tr>
													<th>Date</th>
													<th>Retro</th>
													<th>Status</th>
													<th>Approval Date</th>
													<th>Managed By</th>
												</tr>
											</thead>
											<tbody>';
													$others_det = $mysqli->query("SELECT * FROM others WHERE employee_id='$empid' AND app_status != 'Pending' AND others_status = 'not paid' AND others_approvaldate <= '$submit' AND others_approvaldate BETWEEN '$initialcut' AND '$endcut' ORDER BY attendance_date");
													if($others_det->num_rows > 0){
														while($others = $others_det->fetch_object()){
															// $type = "Additional";
															// if($others->others_paid > $others->others_payable) $type = "Deductable";
															// else $type = "Additional";
															echo '<tr>';
															echo '<td>'.$others->attendance_date.'</td>';
															echo '<td>'.$others->others_retro.'</td>';
															echo '<td>'.$others->app_status.'</td>';
															echo '<td>'.$others->others_approvaldate.'</td>';
															echo '<td>'.$others->others_approvedby.'</td>';
															echo '</tr>';
														}
													}
										echo '</tbody>
										</table>
									</div>
								</div>

									</form>
				</div>
				<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="approvedstatus" value="'.$empid.'"><i class="fa fa-check"></i>Approve</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal" id="pendingstatus" value="'.$empid.'"><i class=""></i>Pending</button>
				</div>
			</div>
		</div>
	</div>';

	echo '<script type="text/javascript">
			$("#approvedstatus").click(function(){
				var empid101 = $(this).val();
				var cutoff = $("#cutoff1").val();
				$.ajax({
		            url: "processingapproval.php?status=approve&empid="+empid101+"&cutoff="+cutoff,
		            method: "POST",
		            success: function(data) {
		                $("#displaysomething").html(data);
		                $("#proc_status"+empid101).html("Approved");
		            }
		        });
	        });

	        $("#pendingstatus").click(function(){
			var empid101 = $("#approvedstatus").val();
			var cutoff = $("#cutoff1").val();
				$.ajax({
		            url: "processingapproval.php?status=pending&empid="+empid101+"&cutoff="+cutoff,
		            method: "POST",
		            success: function(data) {
		                $("#displaysomething").html(data);
		                $("#proc_status"+empid101).html("Pending");
		            }
				});
			});
		</script>';

	/*
	<script type="text/javascript">
			$("#approvedstatus").click(function(){
				var empid101 = $(this).val();
				$.ajax({
		            url: "processingapproval.php?empid="+empid101",
		            method: "POST",
		            success: function(data) {
		                $("#displaysomething").html(data);
		                $("#attendance_status"+empid101).html("Approved");
		            }
		        });
	        });

	        $("#pendingstatus").click(function(){
			var empid101 = $("#approvedstatus").val();
				$.ajax({
		            url: "processingpending.php?empid="+empid101,
		            method: "POST",
		            success: function(data) {
		                $("#displaysomething").html(data);
		                $("#attendance_status"+empid101).html("Pending");
		            }
				});
			});
		</script>
		<div id="displaysomething"></div>

	*/
?>