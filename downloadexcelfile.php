<?php 

require 'excel/PHPExcel_1.8.0_doc/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

//table head style
$styleArrayHead = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 8,
        'name'  => 'Arial',
        
     ),
    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '4682B4') //blue FAC090
    ),
    'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' =>  PHPExcel_Style_Alignment::VERTICAL_CENTER
    
        )
);

//orange
$styleArrayHeadOrange = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 8,
        'name'  => 'Arial',
        
     ),
    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FAC090') //orange FAC090
    ),
    'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' =>  PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
);

//Top
$styleArrayTop = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 8,
        'name'  => 'Arial',
        
     ),
    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFFFF') //orange FAC090
    ),
    /*'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' =>  PHPExcel_Style_Alignment::VERTICAL_CENTER
    )*/
);


//top details
$col='A';
$row='1';

//get cutoff value

$value_top = array('Payroll Register - Detailed',
					'Group - iConnect Global Communications Inc.',
					'Coverage Period: Apr 24, 2016 - May 08, 2016');



foreach ($value_top as $top){
$cell=$col.$row;
$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $top);
$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayTop);

//$mergeCells = 'A'.$row.':J'.$row;
//echo $mergeCells;

$mergeCells = 'A'.$row.':J'.$row;

$objPHPExcel->getActiveSheet()->mergeCells($mergeCells);
$row++;
}


//generate header titles
$heads=head_titles(); //get table head values
$orange=orange_heads();
$col='A'; //column count
$row='4';
foreach ($heads as $key => $value){
	$cell=$col.$row;
	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);

	//style each cell
	if(in_array($value, $orange)){
		$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayHeadOrange);
	}
	else
		$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayHead);

	$count_string=count($value);

	//autosize cells
	//$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	if ($value=='Row No'){
		$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth('5');
	}
	else
	$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth('20');

	//row height
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);

	//wrap text
	$objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setWrapText(true); 

	$col++;
}



//*********************************write data here (per cell)*******************************













//****************************************second sheet*************************************
$objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating
$i=2;
 //top details
$col='A';
$row='1';

    //Write cells
foreach ($value_top as $top){
	$cell=$col.$row;
    $objWorkSheet->setCellValue($cell, $top);
         
         $row++;  
        }

    // Rename sheet*/
    $objWorkSheet->setTitle("Sheet 2");


//headers
$second_sheet_headers = array(
	'Row No',
	'Employee No',
	'Last Name',
	'First Name',
	'Middle Name',
	'NETPAY'
	 );

$col='A';
$row='4';
$objPHPExcel->setActiveSheetIndex(1); 
foreach ($second_sheet_headers as $value){
	$cell=$col.$row;
	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);

	//style each cell

		$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayHead);

	$count_string=count($value);

	//autosize cells
	//$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	if ($value=='Row No'){
		$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth('5');
	}
	else
	$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth('20');

	//row height
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);

	//wrap text
	$objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setWrapText(true); 

	$col++;

}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////



date_default_timezone_set("Asia/Manila");

header('Content-Type: application/vnd.ms-excel.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PayrollRegistrationSheet'.date("Y-m-d").' '.date("h i s").'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');


function head_titles(){
$head_title = array(	
	'Row No',
	'Employee No',
	'Last Name',
	'First Name',
	'Middle Name',
	'Account No',
	'Pay Rate',
	'DAYS RENDERED',

	//blue
	'BASIC PAY',
	'LH ND',
	'LH ND AMOUNT',
	'LH OT',
	'LH OT AMOUNT',
	'REG ND	REG ND AMOUNT',
	'RSTLH OT',
	'RSTLH OT AMOUNT',
	'OVERTIME TOTAL',

	'SL ',
	'SL AMOUNT',
	'SPL ',
	'SPL AMOUNT',
	'VL ',
	'VL AMOUNT',
	'LEAVE AMOUNT TOTAL',

	//blue
	'ADJ RETRO ABSENT',
	'ADJ RETRO REGND',
	'ADJUSTMENTS',
	'SALARY ADJ RETRO LEAVE WITH PAY',
	'SALARY ADJ RETRO LHND',
	'SALARY ADJ RETRO LHOT',
	'SALARY ADJ RETRO REG',
	'SALARY ADJ RETRO REGND',
	'SALARY ADJ RETRO REGOT',
	'SALARY ADJ RETRO SH ND',
	'SALARY ADJ RETRO SH OT',
	'TAXABLE BENEFITS TOTAL',
	'GROSS TAXABLE INCOME',

	'DAYS ABSENT',
	'ABSENT AMOUNT',
	'TARDINESS TOTAL',
	'TARDINESS AMOUNT',
	'SSS EC',
	'SSS EMPLOYEE SHARE',
	'SSS EMPLOYER SHARE',
	'HDMF EMPLOYEE SHARE',
	'HDMF EMPLOYER SHARE',
	'PHIC EMPLOYEE SHARE',
	'PHIC EMPLOYER SHARE',
	'STATUTORY TOTAL',
	'SALARY ADJ RETRO ABSENT DEDUCTIBLE',
	'SALARY ADJ RETRO TARDINESS DEDUCTIBLE',
	'TAXABLE DEDUCTIBLE BENEFITS TOTAL',
	'TAXABLE DEDUCTIBLE TOTAL',

	//blue
	'NET TAXABLE INCOME',

	'WITHHOLDING TAX',
	'LAUNDRY ALLOWANCE',
	'RICE ALLOWANCE',
	'NONTAXABLE BENEFITS TOTAL',

	//blue
	'MAXICARE',
	'PAGIBIG LOAN',
	'PERSONAL LOAN',
	'SSS LOAN',
	'NONTAXABLE DEDUCTIBLE BENEFITS TOTAL',
	'GROSS PAY',
	'DEDUCTIONS TOTAL',
	'NETPAY '
);//end array

return $head_title;
}

function orange_heads(){
	$orange_heads = array(	
	'Row No',
	'Employee No',
	'Last Name',
	'First Name',
	'Middle Name',
	'Account No',
	'Pay Rate',
	'DAYS RENDERED',

	'SL ',
	'SL AMOUNT',
	'SPL ',
	'SPL AMOUNT',
	'VL ',
	'VL AMOUNT',
	'LEAVE AMOUNT TOTAL',

	'DAYS ABSENT',
	'ABSENT AMOUNT',
	'TARDINESS TOTAL',
	'TARDINESS AMOUNT',
	'SSS EC',
	'SSS EMPLOYEE SHARE',
	'SSS EMPLOYER SHARE',
	'HDMF EMPLOYEE SHARE',
	'HDMF EMPLOYER SHARE',
	'PHIC EMPLOYEE SHARE',
	'PHIC EMPLOYER SHARE',
	'STATUTORY TOTAL',
	'SALARY ADJ RETRO ABSENT DEDUCTIBLE',
	'SALARY ADJ RETRO TARDINESS DEDUCTIBLE',
	'TAXABLE DEDUCTIBLE BENEFITS TOTAL',
	'TAXABLE DEDUCTIBLE TOTAL',

	'WITHHOLDING TAX',
	'LAUNDRY ALLOWANCE',
	'RICE ALLOWANCE',
	'NONTAXABLE BENEFITS TOTAL'
	);//end of array

	return $orange_heads;
}//


?>