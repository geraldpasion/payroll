<?php
require "fpdf/fpdf.php";
/*class PDF extends FPDF{

function Hearder(){

}

}*/
include('dbconfig.php');
$appid = $_GET['id'];
$result = $mysqli->query("SELECT * FROM emp_data WHERE id = '$appid'")->fetch_array();

$pdf =  new FPDF ();
//var_dump(get_class_methods($pdf));

    

$pInfo = array(
				"PERSONAL INFORMATION",
				"FAMILY INFORMATION",
				"IN CASE OF EMERGENCY",
				"EDUCATIONAL ATTAINMENT",
				"EMPLOYMENT HISTORY ",
				"OTHER QUALIFICATIONS",
			   	"TRAINING/SEMINARS ATTENDED",
			   	"CHARACTER REFERENCES",
			  
			   	
			   	);
$pdf->AddPage();

$pdf->Image("iconnectlogo.jpg", 10,3, 70,25);
$pdf->SetFont("Arial", "", "7.5");
$pdf->Cell(180,5, "   ",0,1, 'R' );
$pdf->Cell(180,0, "A&B 28F IBM Plaza, Eastwood City Cyberpark",0,1, 'R' );
$pdf->Cell(180,5, "E. Rodriguez Jr. Avenue, Brgy. Bagumbayan",0,1, 'R' );
$pdf->Cell(180,0, "Quezon City, Philippines 1110",0,1, 'R' );
$pdf->Cell(180,5, "Phone: 02-4398511 Fax: 02-8572291",0,1, 'R' );
$pdf->Cell(180,0, "http://iconnectglobalcommunications.com",0,1, 'R' );
$pdf->SetLineWidth(0.5);
//$pdf->Rect(9.5,30,191,250, 'D');
//$pdf->Rect(9.5,40,191,65, 'D');
//$pdf->Rect(9.5,10,191,275, 'D');
$pdf -> SetDrawColor(239,185,100); 

$pdf->Line(10.5,28, 280-80.5,28);
//$pdf->Line(10.5, 48, 280-80.5,48);
//$pdf->Line(10.2, 40, 280-80.2,40);
//$pdf->Write(4,"asd");
//$pdf -> SetDrawColor(13,12,12);
$pdf -> SetDrawColor(117, 110, 114);
$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,7, " ",0,50);
$pdf->Cell(0,5, $pInfo[0], 0,1, 'L');
$pdf->Cell(0,2.5, " ",0,50);
$pdf->SetFont("Times", "", "9");

$pdf->SetLineWidth(0.1);

$pdf->SetFont("Arial", "B", "11");
//$pdf->Cell(0,9, $pInfo[12]."",0,1 );

//$pdf->SetFont("Times", "I", "10");
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(40,5, "Name ",1,0,'L');
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(90,5,"   " .$result['info_f_name']." ".$result['info_m_name']." ".$result['info_l_name'],1,0); 
$pdf->Cell(25,5, "Gender ",1,0,'L');
$pdf->Cell(35,5, "   " .$result['info_gender'],1,1);

$pdf->Cell(40,5, "Nationality ",1,0,'L' );
$pdf->Cell(90,5, "   ".$result['info_nat'],1,0);
$pdf->Cell(25,5, "Status ",1,0,'L');
$pdf->Cell(35,5, "   ".$result['info_status'],1,1);

$pdf->Cell(40,5, "Religion ",1,0,'L' );
$pdf->Cell(90,5, "   ".$result['info_religion'],1,0);
$pdf->Cell(25,5, "Birth Date ",1,0,'L');
$pdf->Cell(35,5, "   ".$result['info_bday'],1,1);

$pdf->Cell(40,5, "Blood Type ",1,0 ,'L');
$pdf->Cell(90,5, "   ".$result['info_blodtyp'],1,0);
$pdf->Cell(25,5, "Place of Birth ",1,0,'L');
$pdf->Cell(35,5, "   ".$result['info_placeofbirth'],1,1);

$pdf->Cell(40,10, "Present Home Address ",1,0,'L' );
$pdf->Cell(150,10, "  ".$result['info_pre_home_add'],1,1);

$pdf->Cell(40,10, "Permanent Address ",1,0,'L' );
$pdf->Cell(150,10, "  ".$result['info_per_add'],1,1);

$pdf->Cell(40,5, "City ",1,0,'L' );
$pdf->Cell(90,5, "   ".$result['info_city'],1,0);
$pdf->Cell(25,5, "ZIP ",1,0,'L');
$pdf->Cell(35,5, "   " .$result['info_zip'],1,1);

$pdf->Cell(40,5, "Mobile No. ",1,0,'L' );
$pdf->Cell(90,5, "   ".$result['info_mob_num'],1,0);
$pdf->Cell(25,5, "TIN No. ",1,0,'L');
$pdf->Cell(35,5, "   ".$result['info_tin'],1,1);

$pdf->Cell(40,5, "Telephone No. ",1,0,'L' );
$pdf->Cell(90,5, "   ".$result['info_tel_num'],1,0);
$pdf->Cell(25,5, "SSS No. ",1,0,'L');
$pdf->Cell(35,5, "   ".$result['sss'],1,1);

$pdf->Cell(40,5, "Pag-Ibig No. ",1,0,'L' );
$pdf->Cell(90,5, "   ".$result['info_pagibigno'],1,0);
$pdf->Cell(25,5, "Philhealth No. ",1,0,'L');
$pdf->Cell(35,5, "   ".$result['info_philhealth'],1,1);

$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,5, " ",0,5);
$pdf->Cell(0,5, $pInfo[1], 0,1, 'L');
$pdf->Cell(0,2.5, " ",0,50);

//$pdf->SetFont("Times", "I", "10");
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(30,10, "Father's Name ",1,0,'L');
$pdf->Cell(65,10, "   ".$result['info_father'],1,0);
$pdf->Cell(20,10, "Birth Date: ",1,0,'L');
$pdf->Cell(25,10, "   ".$result['date_father'],1,0);
$pdf->Cell(18,10, "Occupation ",1,0,'L');
$pdf->Cell(32,10, "   ".$result['info_f_occupation'],1,1);

$pdf->Cell(30,10, "Mother's Name ",1,0,'L');
$pdf->Cell(65,10, "   ".$result['info_mother'],1,0);
$pdf->Cell(20,10, "Birth Date: ",1,0,'L');
$pdf->Cell(25,10, "   ".$result['date_mother'],1,0);
$pdf->Cell(18,10, "Occupation ",1,0,'L');
$pdf->Cell(32,10, "   ".$result['info_m_occupation'],1,1);

$pdf->Cell(95,5, "Name of Children ",1,0,'L');
$pdf->Cell(95,5, "Date of Birth ",1,1,'L');
$pdf->Cell(95,5, "  ".$result['info_n_children'],1,0,'C');
$pdf->Cell(95,5, "  ".$result['date_children'],1,1,'C');
$pdf->Cell(95,5, "  ".$result['info_n_children1'],1,0,'C');
$pdf->Cell(95,5, "  ".$result['date_children1'],1,1,'C');
$pdf->Cell(95,5, "  ".$result['info_n_children2'],1,0,'C');
$pdf->Cell(95,5, "  ".$result['date_children2'],1,1,'C');
$pdf->Cell(95,5, "Name of Sibling/s ",1,0,'L');
$pdf->Cell(95,5, "Date of Birth ",1,1,'L');
$pdf->Cell(95,5, "  ".$result['info_n_siblings'],1,0,'C');
$pdf->Cell(95,5, "  ".$result['date_siblings'],1,1,'C');
$pdf->Cell(95,5, "  ".$result['info_n_sibling1'],1,0,'C');
$pdf->Cell(95,5, "  ".$result['date_siblings1'],1,1,'C');
$pdf->Cell(95,5, "  ".$result['info_n_siblings2'],1,0,'C');
$pdf->Cell(95,5, "  ".$result['date_siblings2'],1,1,'C');

$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,2.5, " ",0,50);
$pdf->Cell(0,5, $pInfo[2], 0,1, 'L');
$pdf->Cell(0,2.5, " ",0,50);

$pdf->SetFont("Times", "I", "10");
$pdf->Cell(95,10, "  Contact Person:        ".$result['info_cont_person'],1,0,'L');
$pdf->Cell(95,10, "  Contact No.:        ".$result['info_cont_num'],1,1,'L');
$pdf->Cell(190,10, "  Address:        ".$result['info_cont_add'],1,1,'L');

$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,2.5, " ",0,50);
$pdf->Cell(0,5, $pInfo[3], 0,1, 'L');
$pdf->Cell(0,2.5, " ",0,50);

//$pdf->SetFont("Times", "I", "10");
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(65,5, "Post Graduate Diploma ",1,0,'L');
$pdf->Cell(125,5, "             ".$result['info_post'],1,1,'L');
$pdf->Cell(30,5, "School",1,0,'L');
$pdf->Cell(70,5, "    ".$result['info_educ_school'],1,0);
$pdf->Cell(30,5, "Course ",1,0,'L');
$pdf->Cell(60,5, "    ".$result['info_educ_course'],1,1);
$pdf->Cell(30,5, "Major",1,0,'L');
$pdf->Cell(70,5, "    ".$result['info_educ_major'],1,0);
$pdf->Cell(30,5, "Date Last Attended ",1,0,'L');
$pdf->Cell(60,5, "    ".$result['date_post_last'],1,1);

$pdf->Cell(65,5, "Bachelor's Degree ",1,0,'L');
$pdf->Cell(125,5, "   ".$result['info_bachelor'],1,1,'L');
$pdf->Cell(30,5, "School",1,0,'L');
$pdf->Cell(70,5, "    ".$result['info_bac_school'],1,0);
$pdf->Cell(30,5, "Course ",1,0,'L');
$pdf->Cell(60,5, "    ".$result['info_bac_course'],1,1);
$pdf->Cell(30,5, "Major",1,0,'L');
$pdf->Cell(70,5, "     ".$result['info_bac_major'],1,0);
$pdf->Cell(30,5, "Date Last Attended ",1,0,'L');
$pdf->Cell(60,5, "     ".$result['date_bac_last'],1,1);

$pdf->Cell(65,5, "Technical/Vocational Degree ",1,0,'L');
$pdf->Cell(125,5, "    ".$result['info_tech'],1,1,'L');
$pdf->Cell(30,5, "School",1,0,'L');
$pdf->Cell(70,5, "     ".$result['info_tech_school'],1,0);
$pdf->Cell(30,5, "Course ",1,0,'L');
$pdf->Cell(60,5, "     ".$result['info_tech_course'],1,1);
$pdf->Cell(30,5, "Major",1,0,'L');
$pdf->Cell(70,5, "     ".$result['info_tech_major'],1,0);
$pdf->Cell(30,5, "Date Last Attended ",1,0,'L');
$pdf->Cell(60,5, "     ".$result['date_tech_last'],1,1);

$pdf->Cell(30,6, "High School      ",1,0,'L');
$pdf->Cell(70,6, "     ".$result['info_high_school'],1,0);
$pdf->Cell(30,6, "Date Last Attended",1,0,'L');
$pdf->Cell(60,6, "     ".$result['date_high_last'],1,1);

$pdf->Cell(30,6, "Elementary",1,0,'L');
$pdf->Cell(70,6, "     ".$result['info_elem_school'],1,0);
$pdf->Cell(30,6, "Date Last Attended",1,0,'L');
$pdf->Cell(60,6, "     ".$result['date_elem_attend'],1,1);

$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,8, " ",0,50);
$pdf->Cell(0,0, $pInfo[4], 0,1, 'L');
$pdf->Cell(0,5, " ",0,50);

//$pdf->SetFont("Times", "I", "10");
$pdf->SetFont("Arial", "", "8");

$pdf->Cell(45,5, "(1) Company Name ",1,0,'L');
$pdf->Cell(145,5, "    ".$result['info_comp_name1'],1,1,'L');
$pdf->Cell(30,5, "Address",1,0,'L');
$pdf->Cell(90,5, "     ".$result['info_comp_add1'],1,0);
$pdf->Cell(30,5, "Date Joined ",1,0,'L');
$pdf->Cell(40,5, "     ".$result['date_compjoin1'],1,1);
$pdf->Cell(30,5, "Position",1,0,'L');
$pdf->Cell(90,5, "     ".$result['info_char_position1'],1,0);
$pdf->Cell(30,5, "Date Left ",1,0,'L');
$pdf->Cell(40,5, "     ".$result['date_compleft1'],1,1);
$pdf->Cell(30,10, "Previous Salary",1,0,'L');
$pdf->Cell(40,10, "    ".$result['info_comp_prev_salry1'],1,0);
$pdf->Cell(30,10, "Reason for Leaving ",1,0,'L');
$pdf->Cell(90,10, "    ".$result['info_comp_r_leavng1'],1,1);

$pdf->Cell(45,5, "(2) Company Name ",1,0,'L');
$pdf->Cell(145,5, "    ".$result['info_comp_name2'],1,1,'L');
$pdf->Cell(30,5, "Address",1,0,'L');
$pdf->Cell(90,5, "     ".$result['info_comp_add2'],1,0);
$pdf->Cell(30,5, "Date Joined ",1,0,'L');
$pdf->Cell(40,5, "     ".$result['date_compjoin2'],1,1);
$pdf->Cell(30,5, "Position",1,0,'L');
$pdf->Cell(90,5, "     ".$result['info_char_position2'],1,0);
$pdf->Cell(30,5, "Date Left ",1,0,'L');
$pdf->Cell(40,5, "     ".$result['date_compleft2'],1,1);
$pdf->Cell(30,10, "Previous Salary",1,0,'L');
$pdf->Cell(40,10, "    ".$result['info_comp_prev_salry2'],1,0);
$pdf->Cell(30,10, "Reason for Leaving ",1,0,'L');
$pdf->Cell(90,10, "    ".$result['info_comp_r_leavng2'],1,1);

$pdf->Cell(45,5, "(3) Company Name ",1,0,'L');
$pdf->Cell(145,5, "    ".$result['info_comp_name3'],1,1,'L');
$pdf->Cell(30,5, "Address",1,0,'L');
$pdf->Cell(90,5, "     ".$result['info_comp_add3'],1,0);
$pdf->Cell(30,5, "Date Joined ",1,0,'L');
$pdf->Cell(40,5, "     ",1,1);
$pdf->Cell(30,5, "Position",1,0,'L');
$pdf->Cell(90,5, "     ".$result['info_char_position3'],1,0);
$pdf->Cell(30,5, "Date Left ",1,0,'L');
$pdf->Cell(40,5, "     ".$result['date_compleft3'],1,1);
$pdf->Cell(30,10, "Previous Salary",1,0,'L');
$pdf->Cell(40,10, "    ".$result['info_comp_prev_salry3'],1,0);
$pdf->Cell(30,10, "Reason for Leaving ",1,0,'L');
$pdf->Cell(90,10, "    ".$result['info_comp_r_leavng3'],1,1);

$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,5, " ",0,50);
$pdf->Cell(0,0, $pInfo[5], 0,1, 'L');
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(0,5, " ",0,50);


$pdf->Cell(45,5, "Languages (Oral/Written)",1,0,'L');
$pdf->Cell(45,5, "Computer Skills",1,0,'L');
$pdf->Cell(55,5, "Other Technical Professional Skills",1,0,'L');
$pdf->Cell(45,5, "Interest/Hobbies",1,1,'L');
$pdf->Cell(45,30, "    ".$result['info_language'],1,0,'L');
$pdf->Cell(45,30, "    ".$result['info_comp_skill'],1,0,'L');
$pdf->Cell(55,30, "    ".$result['info_other_tech'],1,0,'L');
$pdf->Cell(45,30, "    ".$result['info_inter_hobbies'],1,1,'L');
$pdf->Cell(130,5, "Are you willing to work in shifting schedule? ",1,0,'L');
$pdf->Cell(60,5, "".$result['shifting'],1,1,'L');

$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,5, " ",0,50);
$pdf->Cell(0,0, $pInfo[5], 0,1, 'L');
$pdf->Cell(0,5, " ",0,50);

//$pdf->SetFont("Times", "I", "B", "10");
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(70,5, "Title",1,0,'L');
$pdf->Cell(60,5, "Institution/Organizer",1,0,'L');
$pdf->Cell(30,5, "From",1,0,'L');
$pdf->Cell(30,5, "To",1,1,'L');
$pdf->Cell(70,5, "".$result['info_train_title'],1,0,'L');
$pdf->Cell(60,5, "".$result['info_train_title2'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_train_title3'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_train_org'],1,1,'L');
$pdf->Cell(70,5, "".$result['info_train_org2'],1,0,'L');
$pdf->Cell(60,5, "".$result['info_train_org3'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_train_from'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_train_from2'],1,1,'L');
$pdf->Cell(70,5, "".$result['info_train_from3'],1,0,'L');
$pdf->Cell(60,5, "".$result['info_train_to'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_train_to2'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_train_to3'],1,1,'L');

$pdf->SetFont("Arial", "B", "11");
$pdf->Cell(0,5, " ",0,50);
$pdf->Cell(0,0, $pInfo[6], 0,1, 'L');
$pdf->Cell(0,5, " ",0,50);

//$pdf->SetFont("Times", "I", "B", "10");
$pdf->SetFont("Arial", "", "8");
$pdf->Cell(60,5, "Name",1,0,'L');
$pdf->Cell(60,5, "Company Address",1,0,'L');
$pdf->Cell(30,5, "Position",1,0,'L');
$pdf->Cell(40,5, "Contact No. ",1,1,'L');
$pdf->Cell(60,5, "".$result['info_char_name1'],1,0,'L');
$pdf->Cell(60,5, "".$result['info_char_name2'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_char_name3'],1,0,'L');
$pdf->Cell(40,5, "".$result['info_char_comp_add1'],1,1,'L');
$pdf->Cell(60,5, "".$result['info_char_comp_add2'],1,0,'L');
$pdf->Cell(60,5, "".$result['info_char_comp_add3'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_char_position1'],1,0,'L');
$pdf->Cell(40,5, "".$result['info_char_position2'],1,1,'L');
$pdf->Cell(60,5, "".$result['info_char_position3'],1,0,'L');
$pdf->Cell(60,5, "".$result['info_char_cont_num1'],1,0,'L');
$pdf->Cell(30,5, "".$result['info_char_cont_num2'],1,0,'L');
$pdf->Cell(40,5, "".$result['info_char_cont_num3'],1,1,'L');

$pdf->Cell(0,5, " ",0,50);
$pdf->SetFont("Arial", "I", "8");
$pdf->Cell(92,5, "Have you been convicted of any crime?    ".$result['info_crime']."    (If yes please specify)  ".$result['info_specify1'],0,1,'C');
$pdf->Cell(100,5, "State any major illnes, surgery or hospitalization in the last two years   ".$result['info_specify2'],0,1);
$pdf->Cell(100,5, "State all known allergies (i.e dust, antibiotics, etc)    ".$result['info_specify3'],0,1);
$pdf->Cell(100,5, "Do you have any physical limitations?     ".$result['info_specify4'],0,1);

$pdf->Cell(0,5, " ",0,1);
$pdf->SetFont("Arial", "I", "8",'C');
$pdf->Cell(100,5, "				I declare that the information given by me in this form is correct and true to the best of my knowledge. I have not willfully suppressed any facts.",0,1);
$pdf->Cell(100,5, " I fully understand and accpet that is any time after engagement, it is found that a false declaration has been made in this form,the Company has ",0,1);
$pdf->Cell(200,5, " the absolute right to terminate my employement without assigning any reason.",0,1);
$pdf->Cell(100,5, "		  The company and its representatives likewise authorized to obtain such information as it may require for evaluating my application, employment, ",0,1);
$pdf->Cell(100,5,"personal information form.",0,1);


$pdf->Cell(0,5, " ",0,1);
$pdf->Cell(185,3,"___________________________________",0,1,'R');
$pdf->SetFont("Arial", "B", "6",'C');
$pdf->Cell(180,4, "PRINTED NAME AND SIGNATURE/DATE ",0,1,'R');



//$pdf->Cell(90,5, $pInfo[22].$result['employee_datehired'],1,0 );
//$pdf->Cell(90,5, "Signature:",1,0 );


$pdf->Output();
?>
<?php
$pInfo = array(
				
			   	);


$arrlength = count($pInfo);

for($x = 0; $x < $arrlength; $x++) {
   // echo $pInfo[$x];
    //echo "<br>";
}
?> 