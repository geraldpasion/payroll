<?php
require "fpdf/fpdf.php";
/*class PDF extends FPDF{

function Hearder(){

}

}*/
include('dbconfig.php');
$empid = $_GET['id'];
$leaveid = $_GET['leaveid'];
$result = $mysqli->query("SELECT * FROM tbl_leave, employee WHERE leave_id = '$leaveid'")->fetch_array();
$result2 = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
$pdf =  new FPDF( );
//var_dump(get_class_methods($pdf));

    

$pInfo = array(
				"LEAVE APPLICATION FORM",
			    "NAME:  ",
			   	"POSITION:  ",
			   	'DEPARTMENT:  ',
			
			   	);
$pdf->AddPage();
$pdf->Image("iconnectlogo.jpg", 10,5, 80,20);

//$pdf->Rect(9.5,10,191,275, 'D');
$pdf -> SetDrawColor(239,185,100);//color line3
$pdf->Line(10, 25, 280-80,25);
$pdf->Ln(1);
$pdf->SetFont("Times", "B", "11");
$pdf->Cell(0,20, $pInfo[0], 0,1, 'R');
$pdf->SetFont("Times", "", "10");
$pdf->Ln(0.1);
$pdf -> SetDrawColor(0,0,0);
$pdf->SetLineWidth(0.1);
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
$pdf->Cell(25,5,$result['employee_id'],0,1);

$pdf->Cell(0,3," ", 0,1, 'R');
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "Leave Type",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(70,7,$result['leave_type'],1,0);
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(30,7, "VL Credits",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(15,7,$result['employee_vacationleave'],1,0,'C');
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "SL Credits",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(15,7,$result['employee_sickleave'],1,1,'C');
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "Leave Date",1,0,'C');

$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(21,7,$result['leave_start'],1,0);
$pdf->SetFont("Arial", "", "10");

//$pdf->Cell(21,7,$result['leave_end'],1,0);




$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "Reason",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(109,7,$result['leave_reason'],1,1);
$pdf->SetFont("Times", "I", "10");
$pdf->Cell(62,5, "Requested By",1,0,'C');
$pdf->Cell(62,5, "Approved By",1,0,'C');
$pdf->Cell(62,5, "Noted By",1,1,'C');
//display signature image here
$pdf->Cell(62,15, "",1,0,'C');
$pdf->Cell(62,15, "",1,0,'C');
$pdf->Cell(62,15, "",1,1,'C');

$pdf->SetFont("Times", "I", "8");
$pdf->Cell(62,3, "Employee Signature",1,0,'C');
$pdf->Cell(62,3, "Manager",1,0,'C');
$pdf->Cell(62,3, "Human Resources",1,1,'C');


$pdf->SetFont("Times", "", "8");
$pdf->Cell(0,1," ", 0,1, 'R');
$pdf->Cell(63,3, "1. An employee who is absent of 2 or more days due to an illness must submit a Medical Certificate or Return to Work Permit from a Physician together with",0,1);
$pdf->Cell(63,3, "     the approved Leave Application form.",0,1);
$pdf->Cell(63,3, "2. Scheduled leave of absence (LOA) shall be filed 5 days in advance.",0,1);
$pdf->Cell(63,3, "3. Approved Leave of Absence form must be submitted to HR before payroll cut off.",0,1);



$pdf->Cell(0,60," ", 0,1, 'R');

$pdf->Image("iconnectlogo.jpg", 10,150, 80,20);

//$pdf->Rect(9.5,10,191,275, 'D');
$pdf -> SetDrawColor(239,185,100);//color line3
$pdf->Line(10, 170, 280-80,170);
$pdf->Ln(1);
$pdf->SetFont("Times", "B", "11");
$pdf->Cell(0,20, $pInfo[0], 0,1, 'R');
$pdf->SetFont("Times", "", "10");
$pdf->SetLineWidth(1);
$pdf -> SetDrawColor(162,155,155);
$pdf->Line(0,145, 280-60,145);
$pdf -> SetDrawColor(0,0,0);
$pdf->SetLineWidth(0.1);
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(15,5, "Name:",0,0,'L');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(95,5,$result2['employee_firstname']." ".$result2['employee_middlename']." ".$result2['employee_lastname'],0,0 );
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(25,5,"Department:",0,0,'l');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(10,5,$result2['employee_department'],0,1);
$pdf->Line(25,185, 120,185);
$pdf->SetFont("Arial", "", "10");
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(15,5, "Position:",0,0,'l');
$pdf->Line(25,180, 120,180);
$pdf->Line(195,180, 145,180);
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(95,5,$result2['employee_jobtitle'],0,0);
$pdf->SetFont("Arial", "", "10");
$pdf->Line(195,185, 145,185);
$pdf->Cell(25,5, "Employee No.:",0,0,'l');
$pdf->SetFont("Arial", "I", "10");
$pdf->Cell(25,5,$result['employee_id'],0,1);

$pdf->Cell(0,3," ", 0,1, 'R');
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "Leave Type",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(70,7,$result['leave_type'],1,0);
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(30,7, "VL Credits",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(15,7,$result['employee_vacationleave'],1,0,'C');
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "SL Credits",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(15,7,$result['employee_sickleave'],1,1,'C');
$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "Leave Date",1,0,'C');

$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(21,7,$result['leave_start'],1,0);
$pdf->SetFont("Arial", "", "10");

//$pdf->Cell(21,7,$result['leave_end'],1,0);




$pdf->SetFont("Arial", "", "10");
$pdf->Cell(28,7, "Reason",1,0,'C');
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(109,7,$result['leave_reason'],1,1);
$pdf->SetFont("Times", "I", "10");
$pdf->Cell(62,5, "Requested By",1,0,'C');
$pdf->Cell(62,5, "Approved By",1,0,'C');
$pdf->Cell(62,5, "Noted By",1,1,'C');
//display signature image here
$pdf->Cell(62,15, "",1,0,'C');
$pdf->Cell(62,15, "",1,0,'C');
$pdf->Cell(62,15, "",1,1,'C');

$pdf->SetFont("Times", "I", "8");
$pdf->Cell(62,3, "Employee Signature",1,0,'C');
$pdf->Cell(62,3, "Manager",1,0,'C');
$pdf->Cell(62,3, "Human Resources",1,1,'C');


$pdf->SetFont("Times", "", "8");
$pdf->Cell(0,1," ", 0,1, 'R');
$pdf->Cell(63,3, "1. An employee who is absent of 2 or more days due to an illness must submit a Medical Certificate or Return to Work Permit from a Physician together with",0,1);
$pdf->Cell(63,3, "     the approved Leave Application form.",0,1);
$pdf->Cell(63,3, "2. Scheduled leave of absence (LOA) shall be filed 5 days in advance.",0,1);
$pdf->Cell(63,3, "3. Approved Leave of Absence form must be submitted to HR before payroll cut off.",0,1);




$pdf->Output();
?>
<?php
$pInfo = array(
				"Personal Information",
			   	"Employee Number: ",
			   	"Name: ",
			   	'Gender: ',
			   	'Birthday: ',
			   	'Marital Status: ',
			   	'Contact Information',
			   	);
$arrlength = count($pInfo);

for($x = 0; $x < $arrlength; $x++) {
   // echo $pInfo[$x];
    //echo "<br>";
}
?> 