<?php
// Include the Advanced Multicell Class

require "fpdf/fpdf.php";
/*class PDF extends FPDF{

function Hearder(){

}

}*/
include('dbconfig.php');
$empid = $_GET['id'];
$overtimeid = $_GET['otid'];
$result = $mysqli->query("SELECT * FROM overtime, employee WHERE overtime_id = '$overtimeid'")->fetch_array();
$result2 = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
$pdf =  new FPDF( );
//var_dump(get_class_methods($pdf));
    

$pInfo = array(
				"OVERTIME AUTHORIZATION FORM",
			   	"NAME:  ",
			   	"POSITION:  ",
			   	'DEPARTMENT:  ',
			   	'EMPLOYEE NO:  ',
			 	'          DATE  ',
			 	'FROM (TIME)',
			 	'TO (TIME)',
			 	'TOTAL HOUR/S  ',
			 	'APPROVED ',
			 	'REASON  ',
			 	'STATUS  ',
			 	'Requested by: ',
			 	'Approved by: ',
			 	'Noted by: ',
			 	'EMPLOYEE SIGNATURE ',
			 	'MANAGER ',
			 	'HUMAN RESOURCES ',
			   	);
$pdf->AddPage();
$pdf->Image("iconnectlogo.jpg", 10,5, 80,20);

//$pdf->Rect(9.5,40,191,50, 'D');//border line

//$pdf->Rect(9.5,92.5,190.5,15, 'D');//sign
$pdf -> SetDrawColor(239,185,100);//color line3
$pdf->SetLineWidth(0.2);
//$pdf->Write(0,4,"asd");

$pdf->Line(10, 25, 280-80,25);
$pdf->Ln(1);
$pdf->SetFont("Times", "B", "11");
$pdf->Cell(0,20, $pInfo[0], 0,1, 'R');
$pdf->SetFont("Times", "", "10");
$pdf -> SetDrawColor(0, 0, 0);


$pdf->SetFont("Arial", "", "10");
$pdf->Cell(15,5, "Name:",0,0,'L');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(95,5,$result2['employee_firstname']." ".$result2['employee_middlename']." ".$result2['employee_lastname'],0,0 );
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(25,5,"Department:",0,0,'l');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(10,5,$result2['employee_department'],0,1);
$pdf->Line(25,35.5, 120,35.5);
$pdf->SetFont("Arial", "", "10");
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(15,5, "Position:",0,0,'l');
$pdf->Line(25,40.5, 120,40.5);
$pdf->Line(195,40.5, 145,40.5);
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(95,5,$result2['employee_jobtitle'],0,0);
$pdf->SetFont("Arial", "", "10");
$pdf->Line(195,35.5, 145,35.5);
$pdf->Cell(25,5, "Employee No.:",0,0,'l');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(25,5,$result2['employee_id'],0,1);
//$pdf -> SetDrawColor(117, 110, 114);
$pdf->Cell(25,5, "",0,1,'l');

$pdf->Cell(40,8, "Date",1,0,'C');
$pdf->Cell(30,8, "From (Time)",1,0,'L');
$pdf->Cell(30,8, "To (Time)",1,0,'L');
$pdf->Cell(40,8, "Total Hour/s",1,0,'L');
$pdf->Cell(50,8, "Status",1,1,'C');


$pdf->Cell(40,7," ".$result['overtime_date'],1,0,'C'); 
$pdf->Cell(30,7," ".$result['overtime_start'],1,0,'C'); 
$pdf->Cell(30,7," ".$result['overtime_end'],1,0,'C');
$pdf->Cell(40,7," ".$result['overtime_duration'],1,0,'C');   
$pdf->Cell(50,7," ".$result['overtime_status'],1,1,'C');
$pdf->Cell(40,8, "Reason",1,0,'C');
$pdf->Cell(150,8," ".$result['overtime_reason'],1,1,'C');  

$pdf->SetFont("Times", "I", "10");
$pdf->Cell(63.4,5, "Requested By",1,0,'C');
$pdf->Cell(63.3,5, "Approved By",1,0,'C');
$pdf->Cell(63.3,5, "Noted By",1,1,'C');
//display signature image here
$pdf->Cell(63.4,15, "",1,0,'C');
$pdf->Cell(63.3,15, "",1,0,'C');
$pdf->Cell(63.3,15, "",1,1,'C');

$pdf->SetFont("Times", "I", "8");
$pdf->Cell(63.4,3, "Employee Signature",1,0,'C');
$pdf->Cell(63.3,3, "Manager",1,0,'C');
$pdf->Cell(63.3,3, "Human Resources",1,1,'C');

$pdf->Image("iconnectlogo.jpg", 10,150, 80,20);

//$pdf->Rect(9.5,10,191,275, 'D');
$pdf -> SetDrawColor(239,185,100);//color line3
$pdf->Line(10, 170, 280-80,170);
$pdf->Ln(1);
$pdf->SetFont("Times", "B", "11");
$pdf->Cell(0,62," ", 0,1, 'R');
$pdf->Cell(0,18, $pInfo[0], 0,1, 'R');
$pdf->SetFont("Times", "", "10");
$pdf->SetLineWidth(1);
$pdf -> SetDrawColor(162,155,155);
$pdf->Line(0,145, 280-60,145);
$pdf -> SetDrawColor(0,0,0);
$pdf->SetLineWidth(0.1);
//$pdf->Cell(0,5, $pInfo[7].$result['overtime_end'],0,1 );
//$pdf->Cell(0,5, $pInfo[8].$result['overtime_reason'],0,1 );
//$pdf->Cell(0,5, $pInfo[9].$result['overtime_status'],0,1 );


$pdf->SetFont("Arial", "", "10");
$pdf->Cell(15,5, "Name:",0,0,'L');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(95,5,$result2['employee_firstname']." ".$result2['employee_middlename']." ".$result2['employee_lastname'],0,0 );
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(25,5,"Department:",0,0,'l');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(10,5,$result2['employee_department'],0,1);
$pdf->Line(25,177, 120,177);
$pdf->SetFont("Arial", "", "10");
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(15,5, "Position:",0,0,'l');
$pdf->Line(25,182.5, 120,182.5);
$pdf->Line(195,182.5, 145,182.5);
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(95,5,$result2['employee_jobtitle'],0,0);
$pdf->SetFont("Arial", "", "10");
$pdf->Line(195,177, 145,177);
$pdf->Cell(25,5, "Employee No.:",0,0,'l');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(25,5,$result2['employee_id'],0,1);
//$pdf -> SetDrawColor(117, 110, 114);
$pdf->Cell(25,5, "",0,1,'l');

$pdf->Cell(40,8, "Date",1,0,'C');
$pdf->Cell(30,8, "From (Time)",1,0,'L');
$pdf->Cell(30,8, "To (Time)",1,0,'L');
$pdf->Cell(40,8, "Total Hour/s",1,0,'L');
$pdf->Cell(50,8, "Status",1,1,'C');

$pdf->Cell(40,7," ".$result['overtime_date'],1,0,'C'); 
$pdf->Cell(30,7," ".$result['overtime_start'],1,0,'C'); 
$pdf->Cell(30,7," ".$result['overtime_end'],1,0,'C'); 
$pdf->Cell(40,7," ".$result['overtime_duration'],1,0,'C'); 
$pdf->Cell(50,7," ".$result['overtime_status'],1,1,'C');
$pdf->Cell(40,8, "Reason",1,0,'C');
$pdf->Cell(150,8," ".$result['overtime_reason'],1,1,'C');   

$pdf->SetFont("Times", "I", "10");
$pdf->Cell(63.4,5, "Requested By",1,0,'C');
$pdf->Cell(63.3,5, "Approved By",1,0,'C');
$pdf->Cell(63.3,5, "Noted By",1,1,'C');
//display signature image here
$pdf->Cell(63.4,15, "",1,0,'C');
$pdf->Cell(63.3,15, "",1,0,'C');
$pdf->Cell(63.3,15, "",1,1,'C');

$pdf->SetFont("Times", "I", "8");
$pdf->Cell(63.4,3, "Employee Signature",1,0,'C');
$pdf->Cell(63.3,3, "Manager",1,0,'C');
$pdf->Cell(63.3,3, "Human Resources",1,1,'C');

$pdf->Output();
?>

for($x = 0; $x < $arrlength; $x++) {
   // echo $pInfo[$x];
    //echo "<br>";
}
?> 