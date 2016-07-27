<?php
include("dbconfig.php");
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
				$output .= '<tr></tr>
						<tr>
							<td colspan="15" align="center"><b>iConnect Global Communications, Inc.</b></td>
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
								<td colspan="4">'.$empData->employee_id.'</td>
								<td colspan="1"></td>
								<td colspan="3">Payroll Period :</td>
								<td colspan="4">'.$cutoffrange.'</td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Employee Name :</td>
								<td colspan="4">'.$empData->employee_lastname.', '.$empData->employee_firstname.' '.$empData->employee_middlename.'</td>
								<td colspan="1"></td>
								<td colspan="3">Payroll Mode :</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Position :</td>
								<td colspan="4">'.$empData->employee_jobtitle.'</td>
								<td colspan="1"></td>
								<td colspan="3">Monthly :</td>
								<td colspan="4">'.$payData->BasicSalary.'</td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Status :</td>
								<td colspan="4">'.$empData->employee_empstatus.'</td>
								<td colspan="1"></td>
								<td colspan="3"></td>
								<td colspan="4"></td>
							</tr>
							<tr><td colspan="15" align="center"></td></tr>
							<tr>
								<td colspan="7"><b>Income Summary</b></td>
								<td colspan="1"></td>
								<td colspan="7"><b>Summary of Deductions</b></td>
							</tr>';
							if($empData->cutoff == "Monthly") $basicpay = $payData->BasicSalary;
							else $basicpay = $payData->SemiMonthlyRate;
				$output .= '<tr>
								<td colspan="3">Basic Pay :</td>
								<td colspan="4">'.$basicpay.'</td>
								<td colspan="1"></td>
								<td colspan="3">SSS Contribution :</td>
								<td colspan="4">'.$payData->SSS.'</td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Daily Rate :</td>
								<td colspan="4">'.$payData->DailyRate.'</td>
								<td colspan="1"></td>
								<td colspan="3">Philhealth :</td>
								<td colspan="4">'.$payData->PhilHealth.'</td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Hourly Rate :</td>
								<td colspan="4">'.$payData->HourlyRate.'</td>
								<td colspan="1"></td>
								<td colspan="3">Pag-ibig :</td>
								<td colspan="4">'.$payData->PAGIBIG.'</td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Absent/No Work :</td>
								<td colspan="4">'.$totalComps->absent.'</td>
								<td colspan="1"></td>
								<td colspan="3">Tax Withheld :</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Tardy :</td>
								<td colspan="4">'.$totalComps->late.'</td>
								<td colspan="1"></td>
								<td colspan="3">Non-Taxable Deductions :</td>
								<td colspan="4">'.$payData->TotalNonTaxableDeduction.'</td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Undertime :</td>
								<td colspan="4">'.$totalComps->undertime.'</td>
								<td colspan="1"></td>
								<td colspan="3">Lost IDs :</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Overtime :</td>
								<td colspan="4">'.$totalComps->reg_ot.'</td>
								<td colspan="1"></td>
								<td colspan="3"><b>TOTAL DEDUCTIONS :</b></td>
								<td colspan="4"></td>
							</tr>';
				$totalOtherIncome = 0.00;
				$totalOtherIncome += $totalComps->reg_nd + $totalComps->reg_ot_nd + $totalComps->rst_ot + $totalComps->rst_ot_grt8 + $totalComps->rst_nd + $totalComps->rst_nd_grt8 + $totalComps->lh_ot + $totalComps->lh_ot_grt8 + $totalComps->lh_nd + $totalComps->lh_nd_grt8 + $totalComps->sh_ot + $totalComps->sh_ot_grt8 + $totalComps->sh_nd + $totalComps->sh_nd_grt8 + $totalComps->rst_lh_ot + $totalComps->rst_lh_ot_grt8 + $totalComps->rst_lh_nd + $totalComps->rst_lh_nd_grt8 + $totalComps->rst_sh_ot + $totalComps->rst_sh_ot_grt8 + $totalComps->rst_sh_nd + $totalComps->rst_sh_nd_grt8 + $totalComps->leave_hrs;

				$output .= '<tr>
								<td colspan="3">Other Income :</td>
								<td colspan="4">'.$totalOtherIncome.'</td>
								<td colspan="1"></td>
								<td colspan="3"><b>NET PAY :</b></td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="3">Non-Taxable Earnings :</td>
								<td colspan="4">'.$payData->TotalNonTaxableIncome.'</td>
								<td colspan="1"></td>
								<td colspan="7" align="center"><b>TAX COMPUTATION</b></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Gross Salary</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Less: Non-Taxable (-)</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Taxable Income</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Less Tax Exemption (-)</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="1"></td>
								<td colspan="2"><b>GROSS SALARY :</b></td>
								<td colspan="4"></td>
								<td colspan="1"></td>
								<td colspan="3"></td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Multiply by Tax Rate (x)</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="1"></td>
								<td colspan="2"><b>Total Allowance :</b></td>
								<td colspan="4"></td>
								<td colspan="1"></td>
								<td colspan="3"></td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">Plus Income Tax Due (+)</td>
								<td colspan="4"></td>
							</tr>';
				$output .= '<tr>
								<td colspan="7"></td>
								<td colspan="1"></td>
								<td colspan="3">TAX WITHHELD :</td>
								<td colspan="4"></td>
							</tr>
							<tr></tr><tr></tr><tr></tr>';
		}
		$output .= '</table>';
		header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=payslip".'_'."$datetoday.xls");
        echo $output;
	}
}

?>