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
      table.sortable th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after{
        content: " \25B4 "
      }
      a.edit{
        color: #000;
      }

      .btn-activate{

        display:none;

	}
	</style>';

$empid = $_REQUEST['empid'];
$cutoff =$_REQUEST['cutoff'];

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
$income_tax=sprintf('%.2f',$results['WithholdingTax']);//->WithholdingTax);
$net_income_after_tax = sprintf('%.2f',$results['NetIncomeAfterTax']);//->NetIncomeAfterTax);
$net_taxable_income = sprintf('%.2f',$results['NetTaxableIncome']);//->NetTaxableIncome);
$net_pay = sprintf('%.2f',$results['NetPay']);//->NetPay);
$sss = sprintf('%.2f',$results['SSS']);//->SSS);
$pagibig = sprintf('%.2f',$results['PAGIBIG']);//->PAGIBIG);
$philhealth = sprintf('%.2f',$results['PhilHealth']);//->PhilHealth);


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
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($monthly_rate, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3">Employment Status:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$empstatus.'"></div>
											<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Semi-Monthly Rate:</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($semi_rate,2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Tax Code:</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$taxcode.'"></div>
										<div class="form-group"></div>
											<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Daily Rate:</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($d_rate,2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Cut Off:</label>
											<div class="col-sm-3"><input type="text" id = "cutoff1" name="cutoff1" readonly = "readonly" readonly = "readonly" required="" value="'.$cutoff.'"></div>
											<br>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Hourly Rate:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" style="text-align:right" required="" value="'.'PHP '.@number_format($h_rate,2).'"></div>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Payment Schedule:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$paytype.'"></div>
									</div>
								</div>';

								//summary section
								//$taxable_earnings=

							echo   '<div id="summary" class="tab-pane">
									<div class="panel-body">
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Total Taxable Earnings</label>
											<div class="col-sm-2"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($taxable_earnings,2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Total Taxable Deduction</label>
											<div class="col-sm-2"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($taxable_deductions,2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Statutory Benefits</label><br>
											<!--div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($total_statutory_benefits,2).'"></div><br-->
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label"><span class="glyphicon glyphicon-stop"></span>&nbsp;&nbsp;&nbsp;SSS</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($sss,2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label"><span class="glyphicon glyphicon-stop"></span>&nbsp;&nbsp;&nbsp;PAG-IBIG</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($pagibig,2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label"><span class="glyphicon glyphicon-stop"></span>&nbsp;&nbsp;&nbsp;PhilHealth</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right;" readonly = "readonly" required="" value="'.'PHP '.@number_format($philhealth,2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Total Statutory Benefits</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($total_statutory_benefits,2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Net Taxable Income</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($net_taxable_income,2).'"></div><br>
										<div class="form-group"></div>
										<label class="col-sm-3 control-label" style="text-align:right"></label>	
											<label class="col-sm-4 control-label">Income Tax</label>
											<div class="col-sm-2"><input type="text" id = "password"  name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($income_tax,2).'"></div><br>
										<div class="form-group"></div>
										<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4">Net Income After Tax</label>
											<div class="col-sm-2"><input type="text" id = "password"  name = "password"  style="text-align:right" readonly = "readonly"  value="'.'PHP '.@number_format($net_income_after_tax,2).'"></div><br>
										<div class="form-group"></div>
										<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Total Non-Taxable Income</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($nontaxable_earnings,2).'"></div><br>
										<div class="form-group"></div>
										<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Total Non-Taxable Deduction</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($nontaxable_deductions,2).'"></div><br>
											<div class="form-group"></div>
											<label class="col-sm-3 control-label" style="text-align:right"></label>
											<label class="col-sm-4 control-label">Net Pay</label>
											<div class="col-sm-2"><input type = "text" id = "password" name = "password"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($net_pay,2).'"></div><br>
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
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Cut Off Period:</label>
											<div class="col-sm-2"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.$cutoff.'"></div>
										<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Absent:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($absentAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Legal Holiday Restday OT > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalrestot8Amt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Leave:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($leavehoursAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Legal Holiday Night Diff:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalndAmt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Late:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($lateAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Legal Holiday Night Diff > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalnd8Amt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Undertime:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($undertimeAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Legal Holiday Restday Night Diff:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalrestndAmt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Night Differential:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($nightdiffAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Legal Holiday Restday Night Diff > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalrestnd8Amt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Regular OT:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($regotAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday OT:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialotAmt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Regular OT Night Diff:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($regotndAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday OT > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialot8Amt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Restday OT:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($restotAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday Restday OT:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialrestotAmt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Restday OT > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($restot8Amt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday Restday OT > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialrestot8Amt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Restday Night Diff:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($restndAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday Night Diff:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialndAmt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Restday Night Diff > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($restnd8Amt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday Night Diff > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialnd8Amt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Legal Holiday OT:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalotAmt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday Restday Night Diff:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialrestndAmt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Legal Holiday OT > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalot8Amt, 2).'"></div>
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Special Holiday Restday Night Diff > 8:</label>
											<div><input class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($specialrestnd8Amt, 2).'"></div><br>
										<div class="form-group"></div>
											<label class="col-xs-3 control-label">Legal Holiday RD OT:</label>
											<input class="col-xs-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($legalrestotAmt, 2).'">
										<div class="form-group"></div>
											<label class="col-sm-5 control-label">Leave Hours Total:</label>
											<div><input class="col-sm-2" class="col-sm-2" type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)"  style="text-align:right" readonly = "readonly" required="" value="'.'PHP '.@number_format($leavehoursAmt, 2).'"></div><br>

									</div>
								</div>


								<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="earnings" class="tab-pane" >
									<div class="panel-body">
										<table class="footable table table-stripped" data-page-size="20" data-filter=#filter>						
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
										<table class="footable table table-stripped sortable" data-page-size="8" data-filter=#filter>						
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
															echo '<td>'."PHP ".@number_format($others->others_retro, 2).'</td>';
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