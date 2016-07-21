<?php
/*
ORIGINAL PROCESSING_MODAL.PHP
BACKUP
*/
include("dbconfig.php");
$empid = $_REQUEST['empid'];
$cutoff = '';// <----- cutoff here..

$emp = $mysqli->query("SELECT * FROM employee WHERE employee_id=$empid")->fetch_object();
$payroll_factor = $mysqli->query("SELECT * FROM payrollfactor")->fetch_object();
$comp = $mysqli->query("SELECT * FROM total_comp WHERE employee_id=$empid AND cutoff='$cutoff'")->fetch_object();
$compcount = $mysqli->query("SELECT * FROM total_comp WHERE employee_id=$empid AND cutoff='$cutoff'")->num_rows;

$factor = $payroll_factor->factor;
$emp_rate = $emp->employee_rate;
$emp_cutoff = $emp->cutoff;
$taxcode = $emp->employee_taxcode;
$semi_rate = $emp_rate/2;
$daily_rate = sprintf('%.2f', ($emp_rate * 12) / $factor);
$hourly_rate = sprintf('%.2f', (($emp_rate * 12) / $factor) / 8);
$minutes_rate = sprintf('%.2f', ((($emp_rate * 12) / $factor) / 8) /60);

if($daily_rate == "0.00"){
	$daily_rate = "0";
}
if($hourly_rate == "0.00"){
	$hourly_rate = "0";
}

if($compcount > 0){
	$empCompId = $comp->comp_id;
	$cutoff = $comp->cutoff;
	$taxable_earnings = $comp->taxable_earnings;
	$nontaxable_earnings = $comp->nontaxable_earnings;
	$taxable_deductions = $comp->taxable_deductions;
	$nontaxable_deductions = $comp->nontaxable_deductions;

	//COMPUTATION OF RATES IN ALL COMPUTED HOURS
	$absent = ($comp->absent * 8) * $hourly_rate;
	$late = $comp->late * $minutes_rate;
	$undertime = $comp->undertime * $minutes_rate;
	$reg_hrs = $comp->reg_hrs * $hourly_rate;
	$reg_ot = ($comp->reg_ot * $hourly_rate) * 1.25;
	$reg_nd = ($comp->reg_nd * $hourly_rate) * 0.10;
	$reg_ot_nd = (($comp->reg_ot_nd * $hourly_rate) * 1.25) * 1.10;
	$rst_ot = ($comp->rst_ot * $hourly_rate) * 1.69;
	$rst_ot_grt8 = (($comp->rst_ot_grt8 * $hourly_rate) * 1.69) * 1.25;//25% na muna para sa ot more then 8 hours
	$rst_nd = (($comp->rst_nd * $hourly_rate) * 1.69) * 1.10;
	$rst_nd_grt8 = ((($comp->rst_nd_grt8 * $hourly_rate) * 1.69) * 1.10) * 1.25;
	$lh_ot = ($comp->lh_ot * $hourly_rate) * 1.00;
	$lh_ot_grt8 = (($comp->lh_ot_grt8 * $hourly_rate) * 2.00) * 1.30;
	$lh_nd = (($comp->lh_nd * $hourly_rate) * 1.00) * 1.10;
	$lh_nd_grt8 = ((($comp->lh_nd_grt8 * $hourly_rate) * 2.00) * 1.10) * 1.30;
	$sh_ot = ($comp->sh_ot * $hourly_rate) * 1.30;
	$sh_ot_grt8 = (($comp->sh_ot_grt8 * $hourly_rate) * 1.30) * 1.30;
	$sh_nd = (($comp->sh_nd * $hourly_rate) * 1.30) * 1.10;
	$sh_nd_grt8 = ((($comp->sh_nd_grt8 * $hourly_rate) * 1.30) * 1.10) * 1.30;
	$rst_lh_ot = [($comp->rst_lh_ot * $hourly_rate) * 1.00] + [(($comp->rst_lh_ot * $hourly_rate) * 2.00) * 0.30];
	$rst_lh_ot_grt8 = ((($comp->rst_lh_ot_grt8 * $hourly_rate) * 2.00) * 1.30) * 1.30;
	$rst_lh_nd = ((($comp->rst_lh_nd * $hourly_rate) * 1.00) * 1.30) * 1.10;
	$rst_lh_nd_grt8 = (((($comp->rst_lh_nd_grt8 * $hourly_rate) * 2.00) * 1.30) * 1.10) * 1.30;
	$rst_sh_ot = ($comp->rst_sh_ot * $hourly_rate) * 1.50;
	$rst_sh_ot_grt8 = (($comp->rst_sh_ot_grt8 * $hourly_rate) * 1.50) * 1.30;
	$rst_sh_nd = (($comp->rst_sh_nd * $hourly_rate) * 1.50) * 1.10;
	$rst_sh_nd_grt8 = ((($comp->rst_sh_nd_grt8 * $hourly_rate) * 1.50) * 1.10) * 1.30;
	$attendance_status = $comp->attendance_status;

	//TOTAL OF ALL HOURS COMPUTED WITH ADDITIONAL TAXABLE EARNINGS AND TAXABLE DEDUCTIONS
	$taxableIncome = sprintf('%.2f', ($reg_hrs+$reg_ot+$reg_nd+$reg_ot_nd+$rst_ot+$rst_ot_grt8+$rst_nd+$rst_nd_grt8+$lh_ot+$lh_ot_grt8+$lh_nd+$lh_nd_grt8+$sh_ot+$sh_ot_grt8+$sh_nd+$sh_nd_grt8+$rst_lh_ot+$rst_lh_ot_grt8+$rst_lh_nd+$rst_lh_nd_grt8+$rst_sh_ot+$rst_sh_ot_grt8+$rst_sh_nd+$rst_sh_nd_grt8 + $taxable_earnings+$taxable_deductions));

	//SSS CONTRIBUTION
	$ssstable = $mysqli->query("SELECT * FROM sss_contribution WHERE '$taxableIncome'>=Range_Of_Compensation_From AND '$taxableIncome'<=Range_Of_Compensation_To")->fetch_object();
	$sssEE = $ssstable->Social_Security_EE;

	//PHILHEALTH CONTRIBUTION
	$philhealth = $mysqli->query("SELECT * FROM philhealth_contribution WHERE '$taxableIncome'>=Salary_RangeFrom AND '$taxableIncome'<=Salary_Range_to")->fetch_object();
	$PHemp = $philhealth->Employee_Share;

	//PAGIBIG CONTRIBUTION
	$pagibig = $mysqli->query("SELECT * FROM pagibig WHERE '$taxableIncome'>=hdmf_compensation")->fetch_object();
	$pagibigCont = $pagibig->hdmf_employee;

	//INSERTING COMPUTED SSS, PHILHEALTH AND PAGIBIG
	$mysqli->query("UPDATE total_comp SET sss='$sssEE', philhealth='$PHemp', pagibig='$pagibigCont' WHERE comp_id=$empCompId");

	//COMPUTING ALL STATUTORY BENEFITS
	$statutory = $mysqli->query("SELECT * FROM total_comp WHERE employee_id='$empid' AND cutoff='$cutoff'")->fetch_object();
	$sssvalue = $statutory->sss_contribution;
	$philhealthvalue = $statutory->philhealth_contribution;
	$pagibigvalue = $statutory->pagibig;
	//TOTAL STATUTORY
	$totalstatutory = sprintf('%.2f', $sssvalue + $philhealth + $pagibigvalue);

	//NET TAXABLE INCOME COMPUTATION
	$netIncome = $taxableIncome - $totalstatutory; //TOTAL NET INCOME


	//BIR COMPUTATION
	$bir = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='$taxcode' ")->fetch_object();
	$range1 = $bir->Withholding_tax1;
	$range2 = $bir->Withholding_tax2;
	$range3 = $bir->Withholding_tax3;
	$range4 = $bir->Withholding_tax4;
	$range5 = $bir->Withholding_tax5;
	$range6 = $bir->Withholding_tax6;
	$range7 = $bir->Withholding_tax7;
	$range8 = $bir->Withholding_tax8;

	if($netIncome >= $range8){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax8;
		$percent = $perc->Withholding_tax8;
		$range = $range8;
	}else if($netIncome >= $range7){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax7;
		$percent = $perc->Withholding_tax7;
		$range = $range7;
	}else if($netIncome >= $range6){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax6;
		$percent = $perc->Withholding_tax6;
		$range = $range6;
	}else if($netIncome >= $range5){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax5;
		$percent = $perc->Withholding_tax5;
		$range = $range5;
	}else if($netIncome >= $range4){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax4;
		$percent = $perc->Withholding_tax4;
		$range = $range4;
	}else if($netIncome >= $range3){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax3;
		$percent = $perc->Withholding_tax3;
		$range = $range3;
	}else if($netIncome >= $range2){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax2;
		$percent = $perc->Withholding_tax2;
		$range = $range2;
	}else if($netIncome >= $range1){
		$exemp = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Exemption' ")->fetch_object();
		$perc = $mysqli->query("SELECT * FROM witholding_tax WHERE Payroll_Type='$cutoff' AND Status='Percent' ")->fetch_object();
		$exempt = $exemp->Withholding_tax1;
		$percent = $perc->Withholding_tax1;
		$range = $range1;
	}

	$multiplier = sprintf('%.2f', $percent / 100);
	$excess = sprintf('%.2f', ($netIncome - $range) * $multiplier);
	$with_tax = sprintf('%.2f', $exempt + $excess);
	

}else{
	$taxable_earnings = "0";
	$nontaxable_earnings = "0";
	$taxable_deductions = "0";
	$nontaxable_deductions = "0";
	$totalstatutory = "0";
	$netIncome = "0";
}


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
								<li class=""><a data-toggle="tab" href="#earnings">Earnings</a></li>
								<li class=""><a data-toggle="tab" href="#deductions">Deductions</a></li>
								<li class=""><a data-toggle="tab" href="#leavedetails">Leave Details</a></li>
							</ul>
							<div class="tab-content">
								<div id="paysettings" class="tab-pane tab-pane fade active in" >
									<div class="panel-body">
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Monthly Rate:</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required="" value="'.$with_tax.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3">Exemption Status:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
											<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Semi-Monthly Rate:</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return doubleonly(this, event)" readonly = "readonly" required="" value="'.$semi_rate.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Tax Computation:</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" ></div>
										<div class="form-group"></div>
											<br>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Daily Rate:</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$daily_rate.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Cut Off:</label>
											<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required=""></div>
											<br>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Hourly Rate:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$hourly_rate.'"></div>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Pay Type:</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
									</div>
								</div>

								<div id="summary" class="tab-pane" >
									<div class="panel-body">
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Total Taxable Earnings</label>
											<div class="col-sm-3"><input type="text" id = "password" name = "password" onKeyPress="return lettersonly(this, event)" readonly = "readonly" required="" value="'.$taxable_earnings.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3">Net Income After Tax</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required=""></div>
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
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$totalstatutory.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Total Non-Taxable Deduction</label>
											<div class="col-sm-3"><input type = "text" id = "password" name = "password" readonly = "readonly" required="" value="'.$nontaxable_deductions.'"></div>
										<div class="form-group"></div>
											<br>
											<br>
										<div class="form-group"></div>	
											<label class="col-sm-3 control-label">Net Taxable Income</label>
											<div class="col-sm-3"><input type="text" id = "password"  name = "password" readonly = "readonly" required="" value="'.$netIncome.'"></div>
										<div class="form-group"></div>
											<label class="col-sm-3 control-label">Net Pay</label>
											<div class="col-sm-3"><input type="text" id = "password" name="password" readonly = "readonly" readonly = "readonly" required=""></div>
									</div>
								</div>


								<div style= "max-height:200px; min-height:200px; overflow-y:scroll;" id="earnings" class="tab-pane" >
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
										</table>
									</div>
								</div>

								<div style= "max-height:200px; min-height:200px; overflow-y:scroll;" id="deductions" class="tab-pane" >
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
										</table>
									</div>
								</div>

								<div style= "max-height:200px; min-height:200px; overflow-y:scroll;" id="leavedetails" class="tab-pane" >
									<div class="panel-body">
										<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
											<thead>
												<tr>
													<th>Leave Type</th>
													<th>From</th>
													<th>To</th>
													<th>Days</th>
													<th>Approved By</th>
													<th>Approve Date</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>

									</form>
				</div>
				<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i>Approve</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class=""></i>Pending</button>
				</div>
			</div>
		</div>
	</div>';
?>