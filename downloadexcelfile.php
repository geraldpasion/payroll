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
//$cutoff = $_POST['cutoffdropdown'];
$start=$_GET['start'];
$end=$_GET['end'];
$cutoff=$start." - ".$end;

$value_top = array('Payroll Register - Detailed',
					'Group - iConnect Global Communications Inc.',
					'Coverage Period: '.$cutoff,
					);

//$value_top[]='Coverage Period: '.$start." - ".$end;



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

	//populate a cell
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

include 'functions.php';
include 'dbconfig.php';

//get employee ids from the given cutoff at totalcomputation
$employeeids = get_employeeids_from_cutoff($cutoff);



$col='B'; 
$row='5';

//start looping through employee ids under cutoff
foreach ($employeeids as $emp_ids){

//employee ID
$cell=$col.$row;
//populate a cell
$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $emp_ids);
$col++;

//Employee Basic Info
	$employeeinfo=get_employeeinfo($emp_ids);
		foreach ($employeeinfo as $key => $value){
			$cell=$col.$row;
			//populate a cell
			$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
			
			$col++;

			if($col=='F')
				$col++;
		}




//OT and equivalent earnings, get from total_comp and total_comp_salary


    //get_ot_and_ernings($cutoff, $emp_ids);

      $table='total_comp_salary';

     $fields=get_fieldnames($table);

     $hours_fields = array(
							//'reg_hrs',
							'reg_ot',
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
							'leave_hrs'
							    );//24 items
   
     $sql = "SELECT * FROM $table WHERE cutoff='$cutoff' AND employee_id=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row_query = $result->fetch_assoc()) {

                 	//fetch data both from total_comp and total_comp_salary
			       		foreach ($fields as $field){
			            //output only date with fields equivalent to $hours_field array
			            if(in_array($field, $hours_fields)){
			            	
			            	$cell=$col.$row;
			            	$value = $row_query[$field];
			            	//$parseval=explode('/', $value);
			            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
							$col++;
							//$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $parseval[1]);
							//$col++;
			               
			            }//end if
       				 }//end foreach
                 }//end while
             }//end if outer
          else{
          	//$objPHPExcel -> getActiveSheet() -> setCellValue($cell, 'xxx');
          }


//get taxable benefits total
          $table='totalcomputation';
     $sql = "SELECT * FROM $table WHERE CutoffID='$cutoff' AND EmployeeID=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row_query = $result->fetch_assoc()) {
                 	
                 	$cell=$col.$row;
			        $value=$row_query['OtherTaxableEarnings'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;


					//gross taxable income
					$cell=$col.$row;
			        $value=$row_query['GrossTaxableIncome'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

                 }
             }


//absent, late, undertime
//adjust for a mean time
             //$col++;
         $table='total_comp_salary';
     $sql = "SELECT * FROM $table WHERE cutoff='$cutoff' AND employee_id=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row_query = $result->fetch_assoc()) {
                 	
                 	//absent hours
                 	$col++;

                 	//absent
                 	$cell=$col.$row;
			        $value=$row_query['absent'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//late hours
					$col++;

					//late
					$cell=$col.$row;
			        $value=$row_query['late'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//undertime hours
					$col++;

					//undertime
					$cell=$col.$row;
			        $value=$row_query['undertime'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;


                 }
             }     

}//end of emp_ids





//****************************************second sheet*************************************
$i=2;
$objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating

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

$objPHPExcel->setActiveSheetIndex(0); 



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
	//'Account No',
	'Pay Rate',
	//'DAYS RENDERED',

	//blue
	'BASIC PAY',
	/*'LH ND',
	'LH ND AMOUNT',
	'LH OT',
	'LH OT AMOUNT',
	'REG ND',
	'REG ND AMOUNT',
	'RSTLH OT',
	'RSTLH OT AMOUNT',
	'OVERTIME TOTAL',
*/
	'reg_ot',
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
'leave_hrs',



	/*'SL ',
	'SL AMOUNT',
	'SPL ',
	'SPL AMOUNT',
	'VL ',
	'VL AMOUNT',
	'LEAVE AMOUNT TOTAL',*/

	//blue
	/*'ADJ RETRO ABSENT',
	'ADJ RETRO REGND',
	'ADJUSTMENTS',
	'SALARY ADJ RETRO LEAVE WITH PAY',
	'SALARY ADJ RETRO LHND',
	'SALARY ADJ RETRO LHOT',
	'SALARY ADJ RETRO REG',
	'SALARY ADJ RETRO REGND',
	'SALARY ADJ RETRO REGOT',
	'SALARY ADJ RETRO SH ND',
	'SALARY ADJ RETRO SH OT',*/
	'TAXABLE BENEFITS TOTAL',
	'GROSS TAXABLE INCOME',

	'DAYS ABSENT',
	'ABSENT AMOUNT',
	'TARDINESS TOTAL',
	'TARDINESS AMOUNT',
	'UNDERTIME',
	'UNDERTIME AMOUNT',

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