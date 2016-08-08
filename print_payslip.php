<?php
require "fpdf/fpdf.php";
include('dbconfig.php');


//put code here to input payslip password before executing the code



//code start here
$employeeid = $_GET['id'];
$compid = $_GET['compid'];
$initial = $_GET['initial'];
$end = $_GET['end'];
$cutoffrange = $initial . " - " . $end;
$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employeeid'")->fetch_array();
$totalCompSalary = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id = '$employeeid' AND process_status='Submitted' AND cutoff='$cutoffrange'")->fetch_array();
$totalComputation = $mysqli->query("SELECT * FROM totalcomputation WHERE EmployeeID = '$employeeid' AND process_status='Submitted' AND CutoffID='$cutoffrange'")->fetch_array();
$totalComp = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$employeeid' AND process_status='Submitted' AND cutoff='$cutoffrange'")->fetch_array();


$displaycutoff = date("F d, Y", strtotime($initial)) . " - " . date("F d, Y", strtotime($end));

$hours = array ('reg_ot',
			'reg_nd',
			'reg_ot_nd',
			'rst_ot',
			'rst_ot_grt8',
			'rst_nd',
			'rst_nd_grt8',
			'lh_ot',
			'lh_ot_grt8',
			'lh_nd',
			'lh_nd_grt8',
			'sh_ot',
			'sh_ot_grt8',
			'sh_nd',
			'sh_nd_grt8',
			'rst_lh_ot',
			'rst_lh_ot_grt8',
			'rst_lh_nd',
			'rst_lh_nd_grt8',
			'rst_sh_ot',
			'rst_sh_ot_grt8',
			'rst_sh_nd',
			'rst_sh_nd_grt8',
			'leave_hrs');
$hourTitles = array ('Reg Overtime',
			'Reg Nightdiff',
			'Reg Overtime Nightdiff',
			'Rest Overtime',
			'Rest Overtime > 8',
			'Rest Nightdiff',
			'Rest Nightdiff > 8',
			'Legal Holiday OT',
			'Legal Holiday OT > 8',
			'Legal Holiday ND',
			'Legal Holiday ND > 8',
			'Special Holiday OT',
			'Special Holiday OT > 8',
			'Special Holiday ND',
			'Special Holiday ND > 8',
			'Rest & Legal Holiday OT',
			'Rest & Legal Holiday OT > 8',
			'Rest & Legal Holiday ND',
			'Rest & Legal Holiday ND > 8',
			'Rest & Special Holiday OT',
			'Rest & Special Holiday OT > 8',
			'Rest & Special Holiday ND',
			'Rest & Special Holiday ND > 8',
			'Total Leave Hours');

$pdf =  new FPDF ();
$pdf->AddPage();

//$pdf->Image("avatar2.jpg", 140,37, 50,50);
$pdf->Image("iconnectlogo.jpg", 10,3, 70,25);
$pdf->SetFont("Arial", "", "7.5");
$pdf->Cell(180,5, "   ",0,1, 'R' );
$pdf->Cell(180,0, "A&B 28F IBM Plaza, Eastwood City Cyberpark",0,1, 'R' );
$pdf->Cell(180,5, "E. Rodriguez Jr. Avenue, Brgy. Bagumbayan",0,1, 'R' );
$pdf->Cell(180,0, "Quezon City, Philippines 1110",0,1, 'R' );
$pdf->Cell(180,5, "Phone: 02-4398511 Fax: 02-8572291",0,1, 'R' );
$pdf->Cell(180,0, "http://iconnectglobalcommunications.com",0,1, 'R' );

$pdf->SetLineWidth(1);
$pdf->SetDrawColor(255,140,0); //orange border
$pdf->Line(10.5,30, 280-80.5,30);

$pdf->SetLineWidth(0.1);
//$pdf->Rect(9.5,30,191,250, 'D');
//$pdf->Rect(9.5,40,191,65, 'D');
//$pdf->Rect(9.5,10,191,275, 'D');
$pdf->SetDrawColor(239,185,100); //orange border

//$pdf->Line(10.5,28, 280-80.5,28);
//$pdf->Line(10.5, 48, 280-80.5,48);
//$pdf->Line(10.2, 40, 280-80.2,40);
//$pdf->Write(4,"asd");
//$pdf->SetDrawColor(0,0,0); //black border
$pdf->setDrawColor(255,140,0);  // darker orange border
$pdf->SetFont("Arial", "B", "9");
$pdf->Cell(0,5, " ",0,50);
$pdf->setFillColor(239,185,100);  //orange fill
$pdf->SetTextColor(239,185,100);  //orange text 
$pdf->Cell(0,9, "EMPLOYEE INFORMATION", 0,1, 'L');
$pdf->SetFont("Times", "", "9");
$pdf->SetTextColor(0,0,0);  // black text
$pdf->SetFont("Arial", "", "8");

$pdf->Cell(30,5, "Name ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_firstname']." ".$result['employee_middlename']." ".$result['employee_lastname'],1,0 );
$pdf->Cell(30,5, "ID No. ",1,0,'l',1);
$pdf->Cell(65,5, $employeeid,1,1);

$pdf->Cell(30,5, "Address ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_address'],1,0 );
$pdf->Cell(30,5, "ZIP ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_zip'],1,1);

$pdf->Cell(30,5, "Cellphone No. ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_cellnum'],1,0 );
$pdf->Cell(30,5, "Email Address ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_email'],1,1);

$pdf->Cell(30,5, "Employee Type ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_type'],1,0 );
$pdf->Cell(30,5, "Department ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_jobtitle'],1,1);
$pdf->Cell(30,5, "Taxcode ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_taxcode'],1,0 );
$pdf->Cell(30,5, "SSS No.",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_sss'],1,1 );
$pdf->Cell(30,5, "Philhealth No. ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_philhealth'],1,0 );
$pdf->Cell(30,5, "Pagibig No. ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_pagibig'],1,1 );
$pdf->Cell(30,5, "TIN ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_tin'],1,0 );
$pdf->Cell(30,5, "Shift ",1,0,'l',1);
$pdf->Cell(65,5, $result['employee_shift'],1,1 );

$pdf->SetFont("Arial", "B", "9");
$pdf->Cell(0,5, " ",0,50);
$pdf->setFillColor(239,185,100);  //orange fill

$pdf->SetTextColor(239,185,100);  //orange text 
$pdf->Cell(0,9, "PAYROLL INFORMATION", 0,1, 'L');
$pdf->SetTextColor(0,0,0);  // black text
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(30,5, "Pay Period: ",1,0,'l',1);
$pdf->Cell(65,5,$displaycutoff,1,0);
$pdf->Cell(30,5, "Account No. : ",1,0,'l',1);
$pdf->Cell(65,5, "",1,1 );

$pdf->setFillColor(0,0,0); 
$pdf->setDrawColor(255,255,255);  // white border
$pdf->Cell(0,5, " ",0,50);
$pdf->SetX($pdf->lMargin);
$pdf->Cell(190,5, "I acknowledge to have received from iConnect Global Communications, Inc.",1,1,'C');
$pdf->SetX($pdf->lMargin);
$pdf->Cell(190,5, "the amount stated below and have no further claims for services rendered.",1,0,'C');
$pdf->Cell(0,5, " ",0,50);
$pdf->setDrawColor(0,0,0);  // white border
$pdf->Line(70,120,140,120);
$pdf->setDrawColor(255,255,255);  // white border
$pdf->Cell(0,5, " ",0,50);
$pdf->SetX($pdf->lMargin);
$pdf->SetY(121);
$pdf->Cell(190,5, "Signature over printed name",1,1,'C');

$pdf->SetLineWidth(1);
$pdf->SetDrawColor(255,140,0); //orange border
$pdf->Line(10.5,130, 280-80.5,130);

$pdf->SetFont("Arial", "B", "9");
$pdf->Cell(0,8, " ",0,50);
$pdf->setFillColor(239,185,100); 
$pdf->SetTextColor(239,185,100); 
//$pdf->SetX($pdf->lMargin);
$pdf->Cell(0,9, "PAYROLL DETAILS (All amounts in PHP)", 0,1, 'L');

$pdf->SetTextColor(0,0,0);  // black text
$pdf->SetFont("Arial", "BI", "8");
$pdf->SetLineWidth(0);
$pdf->setFillColor(255,255,255); 

$pdf->setFillColor(239,185,100); 
$pdf->Cell(160,5, "Basic Pay ",1,0,'l',1);
if($result['cutoff'] == "Monthly") {
	$basicpay = $totalComputation['BasicSalary'];
} else {
	$basicpay = $totalComputation['SemiMonthlyRate'];
}
$temp = sprintf("%.2f",$basicpay);
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->SetFont("Arial", "B", "8");
$pdf->setFillColor(255,255,255); 
$pdf->Cell(70,5, "Add: Other Income ",1,0,'l');
$pdf->Cell(45,5, "Hour(s) ",1,0,'l');
$pdf->Cell(45,5, "Amount ",1,0,'l');
$pdf->Cell(30,5, "",1,1,'R');

$pdf->SetFont("Arial", "", "8");
// naka loop dapat para yung importante lang lalabas
$ctr = 0;
$totalOtherIncome = $basicpay;
foreach($hours as $hour) {
	if($totalCompSalary[$hour] != 0 ) {
		$pdf->Cell(70,5, "        ".$hourTitles[$ctr],1,0,'l');
		$pdf->Cell(45,5, "",1,0,'l');
		$temp = sprintf("%.2f",$totalCompSalary[$hour]);
		$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
		$pdf->Cell(30,5, "",1,1,'R');
		$totalOtherIncome += $totalCompSalary[$hour];
	}
	$ctr++;
}
$pdf->SetFont("Arial", "BI", "8");
$pdf->setFillColor(239,185,100); 
$temp = sprintf("%.2f",$totalOtherIncome);
$pdf->Cell(160,5, "Total Other Income",1,0,'L',1);
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->setFillColor(255,255,255); 
$pdf->SetFont("Arial", "B", "8");
$pdf->Cell(70,5, "Add: Taxable Income ",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(30,5, "",1,1,'R');

$pdf->SetFont("Arial", "", "8");
$temp = sprintf("%.2f",$totalComputation['RetroTotal']);
$pdf->Cell(70,5, "        ADJ Retro",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$pdf->Cell(30,5, "",1,1,'R');

$temp = sprintf("%.2f",$totalComputation['OtherTaxableEarnings']);
$pdf->Cell(70,5, "        Taxable Earnings",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$pdf->Cell(30,5, "",1,1,'R');

$pdf->setFillColor(239,185,100); 
$pdf->SetFont("Arial", "BI", "8");
$temp = sprintf("%.2f",$totalComputation['TotalTaxableEarnings']);
$grossIncome= $temp;
$pdf->Cell(160,5, "Gross Income",1,0,'L',1);
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->setFillColor(255,255,255); 
$pdf->SetFont("Arial", "B", "8");
$pdf->Cell(70,5, "Less: Deductions ",1,0,'l');
$pdf->Cell(45,5, "Hour(s) ",1,0,'l');
$pdf->Cell(45,5, "Amount ",1,0,'l');
$pdf->Cell(30,5, "",1,1,'R');

$pdf->SetFont("Arial", "", "8");
$totalTaxableDeductions = $totalCompSalary['absent'];
$temp = sprintf("%.2f",$totalCompSalary['absent']);
$pdf->Cell(70,5, "        Absences",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$pdf->Cell(30,5, "",1,1,'R');

$totalTaxableDeductions += $totalCompSalary['late'];
$temp = sprintf("%.2f",$totalCompSalary['late']);
$pdf->Cell(70,5, "        Tardiness",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$pdf->Cell(30,5, "",1,1,'R');

$totalTaxableDeductions += $totalCompSalary['undertime'];
$temp = sprintf("%.2f",$totalCompSalary['undertime']);
$pdf->Cell(70,5, "        Undertime",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$pdf->Cell(30,5, "",1,1,'R');

$temp = sprintf("%.2f",$totalComputation['TotalTaxableDeduction'] - $totalTaxableDeductions);
$pdf->Cell(70,5, "        Taxable Deductions",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');

$temp = sprintf("%.2f",$totalComputation['TotalTaxableDeduction']);
$pdf->Cell(30,5, "(".number_format((float)$temp,2).")",1,1,'R');

$pdf->SetFont("Arial", "BI", "8");
$pdf->setFillColor(239,185,100); 
$temp = sprintf("%.2f",$grossIncome - $totalTaxableDeductions);
$pdf->Cell(160,5, "Gross Taxable Income",1,0,'L',1);
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->setFillColor(255,255,255); 
$pdf->SetFont("Arial", "B", "8");
$pdf->Cell(70,5, "Less: Statutory ",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(30,5, "",1,1,'R');

$pdf->SetFont("Arial", "", "8");
$temp =  sprintf("%.2f",$totalComputation['SSS']);
$pdf->Cell(70,5, "        SSS Premium",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$pdf->Cell(30,5, "",1,1,'R');

$temp =  sprintf("%.2f",$totalComputation['PAGIBIG']);
$pdf->Cell(70,5, "        HDMF Premium",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$pdf->Cell(30,5, "",1,1,'R');

$temp =  sprintf("%.2f",$totalComputation['PhilHealth']);
$pdf->Cell(70,5, "        Philhealth Premium",1,0,'l');
$pdf->Cell(45,5, "",1,0,'l');
$pdf->Cell(45,5, number_format((float)$temp,2),1,0,'R');
$temp =  sprintf("%.2f",$totalComputation['TotalStatutoryBenefits']);
$pdf->Cell(30,5, "(" . number_format((float)$temp,2) . ")",1,1,'R');

$pdf->SetFont("Arial", "BI", "8");
$pdf->setFillColor(239,185,100); 
$temp = sprintf("%.2f",$totalComputation['NetTaxableIncome']);
$pdf->Cell(160,5, "Net Taxable Income",1,0,'L',1);
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->SetFont("Arial", "B", "8");
$pdf->setFillColor(255,255,255);
$temp = sprintf("%.2f", $totalComputation['WithholdingTax']);
$pdf->Cell(160,5, "Less: Withholding Tax",1,0,'L',1);
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(30,5, "(".number_format((float)$temp,2) .")",1,1,'R',1);

$pdf->SetFont("Arial", "BI", "8");
$pdf->setFillColor(239,185,100);
$temp = sprintf("%.2f",$totalComputation['NetIncomeAfterTax']);
$pdf->Cell(160,5, "Net Income After Tax",1,0,'L',1);
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->SetFont("Arial", "B", "8");
$pdf->setFillColor(255,255,255);
$temp = sprintf("%.2f",$totalComputation['TotalNonTaxableIncome']);
$pdf->Cell(160,5, "Total Non-Taxable Income",1,0,'L',1);
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->SetFont("Arial", "B", "8");
$temp = sprintf("%.2f",$totalComputation['TotalNonTaxableDeduction']);
$pdf->Cell(160,5, "Total Non-Taxable Deductions",1,0,'L',1);
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(30,5, "(" .number_format((float)$temp,2).")",1,1,'R',1);

$pdf->setFillColor(239,185,100);
$pdf->SetFont("Arial", "BU", "8");
$temp = sprintf("%.2f",$totalComputation['NetPay']);
$pdf->Cell(160,5, "NET PAY",1,0,'L',1);
$pdf->Cell(30,5, number_format((float)$temp,2),1,1,'R',1);

$pdf->Output();
?>