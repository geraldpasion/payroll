<?php
require "fpdf/fpdf.php";
/*class PDF extends FPDF{

function Hearder(){

}

}*/
include('dbconfig.php');
$employeeid = $_GET['id'];
$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employeeid'")->fetch_array();

$pdf =  new FPDF ();
//var_dump(get_class_methods($pdf));

    

$pInfo = array(
				"Personal Information",
			   	"Employee Number: ",
			   	"Name: ",
			   	'Gender: ',
			   	'Birthday: ',
			   	'Marital Status: ',
			   	'',
			   	'Addess: ',
			   	'City: ',
			   	'Zip: ',
			   	'Email: ',
			   	'Mobile Number: ',
			   	'Employee Information',
			   	'Employee Type: ',
			   	'Department: ',
			   	'Rate: ',
			   	'Taxcode: ',
			   	'Dependencies:  ',
			   	'SSS: ',
			   	'Philhealth: ',
			   	'HDMF: ',
			   	'TIN: ',
			   	'Shift:',
			   	'Date Hired: ', 
			   	);
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

$pdf->SetLineWidth(0.1);
//$pdf->Rect(9.5,30,191,250, 'D');
//$pdf->Rect(9.5,40,191,65, 'D');
//$pdf->Rect(9.5,10,191,275, 'D');
$pdf -> SetDrawColor(239,185,100); 

$pdf->Line(10.5,28, 280-80.5,28);
//$pdf->Line(10.5, 48, 280-80.5,48);
//$pdf->Line(10.2, 40, 280-80.2,40);
//$pdf->Write(4,"asd");
$pdf -> SetDrawColor(13,12,12);
$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,5, " ",0,50);

$pdf->Cell(0,9, $pInfo[0], 0,1, 'L');
$pdf->SetFont("Times", "", "9");

$pdf->SetFont("Arial", "", "8");
$pdf->Cell(30,5, "Name ",1,0,'L');
$pdf->Cell(110,5,$result['employee_firstname']." ".$result['employee_middlename']." ".$result['employee_lastname'],1,0 );
$pdf->Cell(25,5, "ID No. ",1,0,'l');
$pdf->Cell(25,5,$result['employee_id'],1,1);
$pdf->Cell(30,5, "Gender ",1,0,'l');
$pdf->Cell(110,5,$result['employee_gender'],1,0);
$pdf->Cell(25,5, "Status ",1,0,'l');
$pdf->Cell(25,5,$result['employee_marital'],1,1 );
$pdf->Cell(30,5, "Birthdate ",1,0,'l');
$pdf->Cell(160,5,$result['employee_birthday'],1,1 );
$pdf->Cell(30,5, "Address ",1,0,'lC');
$pdf->Cell(160,5,$result['employee_address'],1,1 );

$pdf->Cell(30,5, "City ",1,0,'l');
$pdf->Cell(110,5,$result['employee_city'],1,0 );
$pdf->Cell(25,5, "ZIP ",1,0,'l');
$pdf->Cell(25,5,$result['employee_zip'],1,1 );
$pdf->Cell(30,5, "Cellphone No. ",1,0,'l');
$pdf->Cell(160,5,$result['employee_cellnum'],1,1 );
$pdf->Cell(30,5, "Email Address ",1,0,'l');
$pdf->Cell(160,5,$result['employee_email'],1,1 );


$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,9, $pInfo[12]."",0,1 );

$pdf->SetFont("Arial", "", "8");
$pdf->Cell(30,5, "Employee Type ",1,0,'l');
$pdf->Cell(65,5, $result['employee_type'],1,0 );
$pdf->Cell(30,5, "Department ",1,0,'l');
$pdf->Cell(65,5, $result['employee_jobtitle'],1,1 );
$pdf->Cell(30,5, "Rate ",1,0,'l');
$pdf->Cell(65,5, $result['employee_rate'],1,0 );
$pdf->Cell(30,5, "Taxcode ",1,0,'l');
$pdf->Cell(65,5, $result['employee_taxcode'],1,1 );
$pdf->Cell(30,5, "Dependencies ",1,0,'l');
$pdf->Cell(65,5, $result['employee_dependency'],1,0 );
$pdf->Cell(30,5, "SSS No.",1,0,'l');
$pdf->Cell(65,5, $result['employee_sss'],1,1 );
$pdf->Cell(30,5, "Philhealth No. ",1,0,'l');
$pdf->Cell(65,5, $result['employee_philhealth'],1,0 );
$pdf->Cell(30,5, "Pagibig No. ",1,0,'l');
$pdf->Cell(65,5, $result['employee_pagibig'],1,1 );
$pdf->Cell(30,5, "TIN ",1,0,'l');
$pdf->Cell(65,5, $result['employee_tin'],1,0 );
$pdf->Cell(30,5, "Shift ",1,0,'l');
$pdf->Cell(65,5, $result['employee_shift'],1,1 );
$pdf->Cell(30,5, "Date Hired ",1,0,'l');
$pdf->Cell(65,5, $result['employee_datehired'],1,0 );
$pdf->Cell(30,5, "Signature ",1,0,'l');
$pdf->Cell(65,5, " ",1,0 );



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
			   	'Addess: ',
			   	'City: ',
			   	'Zip: ',
			   	'Email: ',
			   	'Mobile Number: ',
			   	'Employee Information',
			   	'Employee Type: ',
			   	'Department: ',
			   	'Rate: ',
			   	'Taxcode: ',
			   	'Dependencies:  ',
			   	'SSS: ',
			   	'Philhealth: ',
			   	'HDMF: ',
			   	'TIN: ',
			   	'Shift:',
			   	'Date Hired: ', 
			   	);


$arrlength = count($pInfo);

for($x = 0; $x < $arrlength; $x++) {
   // echo $pInfo[$x];
    //echo "<br>";
}
?> 