<?php
include("dbconfig.php");
setlocale(LC_MONETARY, 'en_US');
$datetoday = date('Y-m-d');
$keydatefrom = $_GET['datef'];
$keydateto = $_GET['datet'];
$keydatefromArr = split('/', $keydatefrom);
$keydatetoArr = split('/', $keydateto);
$initialcut = sprintf("%02d", $keydatefromArr[0]) . '-' . sprintf("%02d", $keydatefromArr[1]) . '-' . sprintf("%02d", $keydatefromArr[2]);
$endcut = sprintf("%02d", $keydatetoArr[0]) . '-' . sprintf("%02d", $keydatetoArr[1]) . '-' . sprintf("%02d", $keydatetoArr[2]);
$cutoffrange = $initialcut . ' - ' .$endcut;

if($totalCompsQ = $mysqli->query("SELECT * FROM total_comp_salary WHERE total_comp_salary.process_status='Submitted' AND total_comp_salary.cutoff='$cutoffrange'")){
	if($totalCompsQ->num_rows > 0){
		$output = '<table style="font-size: 12px;">';
		while($totalComps = $totalCompsQ->fetch_object()) {
			$empQ = $mysqli->query("SELECT * FROM employee WHERE employee_id='$totalComps->employee_id'");
			$payQ = $mysqli->query("SELECT * FROM totalcomputation WHERE CompID='$totalComps->comp_id'");
			$empData = $empQ->fetch_object();
			$payData = $payQ->fetch_object();
			$string = ":===================================================================================================================================================================:";
				$output .= '<tr>
								<td colspan="15">'.$string.'</td>
							</tr>
						<tr>
							<td colspan="15" align="center"><b>iCONNECT GLOBAL COMMUNICATIONS, INC.</b></td>
						</tr>
						<tr>
							<td colspan="15" align="center">Unit A&B 28F IBM Plaza Building Eastwood City Cyberpark</td>
						</tr>
						<tr>
							<td colspan="15" align="center">E. Rodriguez Jr. Avenue Bagumbayan Quezon City</td>
						</tr>
						<tr><td colspan="15" align="center"></td></tr>';
				$output .= '<tr>
								<td colspan="3">Employee No. :</td>
								<td colspan="4" align="left">'.$empData->employee_id.'</td>
								<td colspan="1"></td>
								<td colspan="3">Payroll Period :</td>
								<td colspan="4">'.$cutoffrange.'</td>
							</tr>';
							$temp = sprintf("%.2f",$payData->BasicSalary);
							$temp = "P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="3">Employee Name :</td>
								<td colspan="4">'.$empData->employee_lastname.', '.$empData->employee_firstname.' '.$empData->employee_middlename.'</td>
								<td colspan="1"></td>
								<td colspan="3">Monthly :</td>
								<td colspan="4">'.$temp.'</td>
							</tr>';
							$temp = sprintf("%.2f",$payData->DailyRate);
							$temp = "P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="3">Position :</td>
								<td colspan="4">'.$empData->employee_jobtitle.'</td>
								<td colspan="1"></td>
								<td colspan="3">Daily Rate :</td>
								<td colspan="4">'.$temp.'</td>
							</tr>';
							$temp = sprintf("%.2f",$payData->HourlyRate);
							$temp = "P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="3">Status :</td>
								<td colspan="4">'.$empData->employee_empstatus.'</td>
								<td colspan="1"></td>
								<td colspan="3">Hourly Rate :</td>
								<td colspan="4">'.$temp.'</td>
							</tr>
							<tr><td colspan="15" align="center"></td></tr>
							<tr><td colspan="15" align="center"><b>P A Y R O L L&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D E T A I L S</b></td></tr>';
							if($empData->cutoff == "Monthly") $basicpay = $payData->BasicSalary;
							else $basicpay = $payData->SemiMonthlyRate;
							$temp1 = sprintf("%.2f",$basicpay);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->SSS);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3"><b>Basic Pay :</b></td>
								<td colspan="4" align="right"><b>'.$temp1.'</b></td>
								<td colspan="1"></td>
								<td colspan="3">SSS Contribution :</td>
								<td colspan="4" align="right">'.$temp2.'</td>
							</tr>';
				$totalOtherIncome = 0.00;
				$totalOtherIncome += $totalComps->reg_ot + $totalComps->reg_nd + $totalComps->reg_ot_nd + $totalComps->rst_ot + $totalComps->rst_ot_grt8 + $totalComps->rst_nd + $totalComps->rst_nd_grt8 + $totalComps->lh_ot + $totalComps->lh_ot_grt8 + $totalComps->lh_nd + $totalComps->lh_nd_grt8 + $totalComps->sh_ot + $totalComps->sh_ot_grt8 + $totalComps->sh_nd + $totalComps->sh_nd_grt8 + $totalComps->rst_lh_ot + $totalComps->rst_lh_ot_grt8 + $totalComps->rst_lh_nd + $totalComps->rst_lh_nd_grt8 + $totalComps->rst_sh_ot + $totalComps->rst_sh_ot_grt8 + $totalComps->rst_sh_nd + $totalComps->rst_sh_nd_grt8 + $totalComps->leave_hrs;
							$temp1 = sprintf("%.2f",$totalOtherIncome);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->PAGIBIG);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3">Other Income :</td>
								<td colspan="4" align="right">'.$temp1.'</td>
								<td colspan="1"></td>
								<td colspan="3">PAG-IBIG :</td>
								<td colspan="4" align="right">'.$temp2.'</td>
							</tr>';
							$temp1 = sprintf("%.2f",$payData->RetroTotal);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->PhilHealth);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3">Retro :</td>
								<td colspan="4" align="right">'.$temp1.'</td>
								<td colspan="1"></td>
								<td colspan="3">PhilHealth :</td>
								<td colspan="4" align="right">'.$temp2.'</td>
							</tr>';
							$temp1 = sprintf("%.2f",$payData->OtherTaxableEarnings);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->TotalStatutoryBenefits);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3">Taxable Earnings :</td>
								<td colspan="4" align="right">'.$temp1.'</td>
								<td colspan="1"></td>
								<td colspan="3"><b>Statutory :</b></td>
								<td colspan="4" align="right"><b>'.$temp2.'</b></td>
							</tr>';
				$grossIncome = $payData->TotalTaxableEarnings;
							$temp1 = sprintf("%.2f",$grossIncome);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->NetTaxableIncome);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3"><b>Gross Income :</b></td>
								<td colspan="4" align="right"><b>'.$temp1.'</b></td>
								<td colspan="1"></td>
								<td colspan="3"><b>Net Taxable Income :</b></td>
								<td colspan="4" align="right"><b>'.$temp2.'</b></td>
							</tr>';
				$totalTaxableDeductions = 0.00;
				$totalTaxableDeductions += $totalComps->absent + $totalComps->late + $totalComps->undertime;
							$temp1 = sprintf("%.2f",$totalComps->absent);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->WithholdingTax);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3">Absences :</td>
								<td colspan="4" align="right">'.$temp1.'</td>
								<td colspan="1"></td>
								<td colspan="3">Tax Withheld :</td>
								<td colspan="4" align="right">'.$temp2.'</td>
							</tr>';
							$temp1 = sprintf("%.2f",$totalComps->late);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->NetIncomeAfterTax);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3">Tardy :</td>
								<td colspan="4" align="right">'.$temp1.'</td>
								<td colspan="1"></td>
								<td colspan="3"><b>Net Income After Tax :</b></td>
								<td colspan="4" align="right"><b>'.$temp2.'</b></td>
							</tr>';
							$temp1 = sprintf("%.2f",$totalComps->undertime);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->TotalNonTaxableIncome);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3">Undertime :</td>
								<td colspan="4" align="right">'.$temp1.'</td>
								<td colspan="1"></td>
								<td colspan="3">Total Non-Taxable Earnings :</td>
								<td colspan="4" align="right">'.$temp2.'</td>
							</tr>';
				$temp = sprintf("%.2f",$payData->TotalTaxableDeduction - $totalTaxableDeductions);
							$temp1 = sprintf("%.2f",$temp);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->TotalNonTaxableDeduction);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="3">Taxable Deductions :</td>
								<td colspan="4" align="right">'.$temp1.'</td>
								<td colspan="1"></td>
								<td colspan="3">Total Non-Taxable Deductions :</td>
								<td colspan="4" align="right">'.$temp2.'</td>
							</tr>';
							$temp = sprintf("%.2f",$grossIncome - $totalTaxableDeductions);
							$temp = "P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="3"><b>Gross Taxable Income :</b></td>
								<td colspan="4" align="right"><b>'.$temp.'</b></td>
								<td colspan="1"></td>
								<td colspan="7"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="7" align="center"><b>TAX COMPUTATION</b></td>
							</tr>';
							$temp = sprintf("%.2f",$payData->NetTaxableIncome);
							$temp = "P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Net Taxable Income</td>
								<td colspan="4" align="right">'.$temp.'</td>
							</tr>';
							$temp = sprintf("%.2f",$payData->GrossCheck);
							$temp = "- P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Less: Gross Check</td>
								<td colspan="4" align="right">'.$temp.'</td>
							</tr>';
							$temp1 = sprintf("%.2f",$payData->NetPay);
							$temp1 = "P ".number_format((float)$temp1,2);
							$temp2 = sprintf("%.2f",$payData->Difference);
							$temp2 = "P ".number_format((float)$temp2,2);
				$output .= '<tr>
								<td colspan="1"></td>
								<td colspan="2" rowspan="2"><b><u>NET PAY</b></u></td>
								<td colspan="4" rowspan="2" align="right"><b>'.$temp1.'</b></td>
								<td colspan="1"></td>
								<td colspan="3"></td>
								<td colspan="4" align="right">'.$temp2.'</td>
							</tr>';
							$temp = $payData->PercentOver / 100;
							$temp = "x " . $temp;
				$output .= '<tr>
								<td colspan="1"></td>
								<td colspan="1"></td>
								<td colspan="3">Multiply: Tax Rate</td>
								<td colspan="4" align="right">'.$temp.'</td>
							</tr>';
							$temp = sprintf("%.2f",$payData->PercentedDifferenceGross);
							$temp = "P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3"></td>
								<td colspan="4" align="right">'.$temp.'</td>
							</tr>';
							$temp = sprintf("%.2f",$payData->FixedAmount);
							$temp = "+ P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Plus: Fixed Tax Amount</td>
								<td colspan="4" align="right">'.$temp.'</td>
							</tr>';
							$temp = sprintf("%.2f",$payData->WithholdingTax);
							$temp = "P ".number_format((float)$temp,2);
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3"><b>Tax Withheld</b></td>
								<td colspan="4" align="right"><b>'.$temp.'</b></td>
							</tr>
							<tr>
								<td colspan="15">'.$string.'</td>
							</tr>
							<tr></tr><tr></tr>';
		}
		$output .= '</table>';
		header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=payslip".'_'."$datetoday.xls");
        echo $output;
	}
}

?>