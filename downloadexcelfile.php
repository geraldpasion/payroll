<?php 

/**********************************
Author: Gerald Dominic DM Pasion
email: gerald.pasion@gmail.com
***********************************/

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

$styleRegularCell = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 8,
        'name'  => 'Arial',
        
     ),
    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            //'color' => array('rgb' => 'FFFFFF') //orange FAC090
    ),
    'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' =>  PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
);


//overall default styling
//make column width auto
PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);


//**************************************top details*********************************
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


//merge certain cells
foreach ($value_top as $top){
$cell=$col.$row;
$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $top);
$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayTop);

$mergeCells = 'A'.$row.':J'.$row;

$objPHPExcel->getActiveSheet()->mergeCells($mergeCells);
$row++;
}


//*****************************generate header titles****************************
include 'functions.php';
include 'dbconfig.php';

$heads=head_titles(); //get table head values
$orange=orange_heads();
$col='A'; //column count
$row='4';

//get combination of taxable(meta_key) earnings(meta_type) names(meta_optional at totalcomputation_meta table) available for
//all the included employees in the given $cutoff
//this will be used in preparation for dynamic columns. use this for all taxable/non-taxable earnings/deductions
//call function here
//get compid then fetch data from meta
$compids =  get_compids_from_cutoff($cutoff);

//taxable
$taxable_earnings_fields=fetch_meta($compids, 'Taxable', 'earning');
$taxable_deductions_fields=fetch_meta($compids, 'Taxable', 'deduction');

//non-taxable
$nontaxable_earnings_fields=fetch_meta($compids, 'Non-Taxable', 'earning');
$nontaxable_deductions_fields=fetch_meta($compids, 'Non-Taxable', 'deduction');

foreach ($heads as $key => $value){
	$cell=$col.$row;

	//populate a cell
	//insert value of withholding tax first
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

	//move to next column
	$col++;

			//for other non-taxable earnings
			if($value=='WITHHOLDING TAX'){

				//insert other fields
				foreach($nontaxable_earnings_fields as $nontax_earning){
					$cell=$col.$row;
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $nontax_earning);
					$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayHead);
					$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
					$col++;
				}
			}

			//for other non-taxable deduction
			else if ($value=='NONTAXABLE BENEFITS TOTAL'){
				foreach($nontaxable_deductions_fields as $nontax_deduction){
					$cell=$col.$row;
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $nontax_deduction);
					$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayHead);
					$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
					$col++;
				}
			}

			//for other taxable income
			else if ($value=='RETRO TOTAL'){
				foreach($taxable_earnings_fields as $tax_earning){
					$cell=$col.$row;
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $tax_earning);
					$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayHead);
					$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
					$col++;
				}
			}

			//for other taxable deductions
			else if ($value=='STATUTORY TOTAL'){
				foreach($taxable_deductions_fields as $tax_deduction){
					$cell=$col.$row;
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $tax_deduction);
					$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayHead);
					$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
					$col++;
				}
			}

}



//*********************************write data here (per cell)*******************************

//*****************************************initialization section*********************************

//get employee ids from the given cutoff at totalcomputation
$employeeids = get_employeeids_from_cutoff($cutoff);

//check each employee_status is 'active'
foreach ($employeeids as $employee_id){
	//if employee_status is 'finalpay' or 'Inactive', remove from list.
	 $sql = "SELECT employee_status FROM employee WHERE employee_id='$employee_id'";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            	
            }
          }
}

//default styling
$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

//default formatting
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getNumberFormat()->setFormatCode('#,##0.00'); 
//$->getStyle("A1")->getNumberFormat()->setFormatCode('0.00'); 


/***************************************main process*****************************/

//initialize first cell
$col='A'; 
$row='5';
$counter=1;
//start looping through employee ids under cutoff
foreach ($employeeids as $emp_ids){

//row number
$cell=$col.$row;
$value=$counter;
$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
$counter++;
$col++;


//employee ID
$cell=$col.$row;
//populate a cell
$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $emp_ids);
$col++;

//Employee Basic Info
$prev_val="";
	$employeeinfo=get_employeeinfo($emp_ids);
		foreach ($employeeinfo as $key => $value){
			$cell=$col.$row;

			//basic pay
			if($value=='Semi-monthly'){
				$value=$prev_val/2;
			}
			else if($value=='Monthly'){
				$value=$prev_val;
			}

			//populate a cell
			$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
			
			$col++;

			$prev_val=$value;
			//Pay Rate skip for now
			//if($col=='F')
			//	$col++;
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
     //$col++;
         if ($result->num_rows > 0) {
                 while($row_query = $result->fetch_assoc()) {

                 	//fetch data both from total_comp and total_comp_salary
			       		foreach ($fields as $field){
			            //output only date with fields equivalent to $hours_field array
			            if(in_array($field, $hours_fields)){
			        
			            	//OT Hours
			            	$cell=$col.$row;
			            	//get function
			            	$value=get_total_hours($cutoff, $emp_ids, $field);
			            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
			            	$col++;

			            	//OT Amount
			            	$cell=$col.$row;
			            	$value = $row_query[$field];
			            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
							$col++;
							
			               
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

                 	//Retro
                 	$cell=$col.$row;
			        $value=$row_query['RetroTotal'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

                 	$comp_id=$row_query['CompID'];
                 	//*dynamic taxable earnings values here
                 	foreach($taxable_earnings_fields as $meta_optional){
						$cell=$col.$row;
						$value=get_meta_value($comp_id, $meta_optional);
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
						$col++;
					}
                 	
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
	            	$cell=$col.$row;
	            	//get function
	            	$value=get_total_hours($cutoff, $emp_ids, 'absent');
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
	            	$col++;

                 	//absent amount
                 	$cell=$col.$row;
			        $value=$row_query['absent'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;



					//late hours
					$cell=$col.$row;
	            	//get function
	            	$value=get_total_hours($cutoff, $emp_ids, 'late');
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
	            	$col++;

					//late amount
					$cell=$col.$row;
			        $value=$row_query['late'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;



					//undertime hours
					$cell=$col.$row;
	            	//get function
	            	$value=get_total_hours($cutoff, $emp_ids, 'undertime');
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
	            	$col++;

					//undertime amount
					$cell=$col.$row;
			        $value=$row_query['undertime'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;


                 }
             }

//********************statutory benefits (totalcomputation_meta)**************

//prepare array

 $table='total_comp_salary';
     $sql = "SELECT * FROM $table WHERE cutoff='$cutoff' AND employee_id=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row_query = $result->fetch_assoc()) {
                 	$comp_id=$row_query['comp_id'];

                 	$meta_array=prepare_multi_array($comp_id);

                 	

					///SSS Employee Share
					$cell=$col.$row;
			        $value=$meta_array['Total_Contribution_EE'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					///SSS Employer Share
					$cell=$col.$row;
			        $value=$meta_array['Total_Contribution_ER'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					///SSS EC
                 	$cell=$col.$row;
			        $value=$meta_array['ECER'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;



					//PAGIBIG Employee
					$cell=$col.$row;
			        $value=$meta_array['hdmf_employee'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//PAGIBIG Employer
					$cell=$col.$row;
			        $value=$meta_array['hdmf_employer'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;
					

					

					//PhilHealth Employee Share
					$cell=$col.$row;
			        $value=$meta_array['Employee_Share'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//PhilHealth Employer Share
					$cell=$col.$row;
			        $value=$meta_array['Employer_Share'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

                 }
            }//end if




//statutory total. get this from totalcomputation
$table='totalcomputation';
     $sql = "SELECT TotalStatutoryBenefits FROM $table WHERE CutoffID='$cutoff' AND EmployeeID=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row_query = $result->fetch_assoc()) {
                 	$cell=$col.$row;
			        $value=$row_query['TotalStatutoryBenefits'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;
                 }
             }


$table='totalcomputation';
     $sql = "SELECT * FROM $table WHERE CutoffID='$cutoff' AND EmployeeID=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row_query = $result->fetch_assoc()) {

                 	$comp_id=$row_query['CompID'];
                 	//*dynamic taxable earnings values here
                 	foreach($taxable_deductions_fields as $meta_optional){
						$cell=$col.$row;
						$value=get_meta_value($comp_id, $meta_optional);
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
						$col++;
					}
                 	
                 	$col++;
                 	//total taxable deductions
                 	/*$cell=$col.$row;
			        $value=$row_query['TotalTaxableDeduction'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;*/

					//total deductions absent+late+ut+statuory
					$cell=$col.$row;
			        $value=$row_query['TotalTaxableDeduction'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//net taxable income
					$cell=$col.$row;
			        $value=$row_query['NetTaxableIncome'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//withholding tax
                 	$cell=$col.$row;
			        $value=$row_query['WithholdingTax'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					/*make this dynamic! income*/
					
					foreach($nontaxable_earnings_fields as $meta_optional){
						$cell=$col.$row;
						$value=get_meta_value($comp_id, $meta_optional);
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
						$col++;
					}

					//total non taxable income
					$cell=$col.$row;
			        $value=$row_query['TotalNonTaxableIncome'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					/*make this dynamic! deductions*/
					foreach($nontaxable_deductions_fields as $meta_optional){
						$cell=$col.$row;
						$value=get_meta_value($comp_id, $meta_optional);
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
						$col++;
					}

					//total non taxable income
					$cell=$col.$row;
			        $value=$row_query['TotalNonTaxableDeduction'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					/*make this dynamic! others*/
	
					//Gross Pay
					$cell=$col.$row;
					$value=$row_query['GrossTaxableIncome']+$row_query['TotalNonTaxableIncome'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//deduction total
					$cell=$col.$row;
					$value=$row_query['TotalTaxableDeduction']+$row_query['TotalNonTaxableDeduction']+$row_query['WithholdingTax']+$row_query['TotalStatutoryBenefits'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

					//net pay
					$cell=$col.$row;
			        $value=$row_query['NetPay'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;
                 }
             }

//increment row - reset column to A to begin filling next employee per cutoff
$row++;
$col='A';
}//end of emp_ids





//****************************************second sheet*************************************
$i=2;
$objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating

//set active sheet index to 1 to apply values to this current cells
$objPHPExcel->setActiveSheetIndex(1); 

//set default alignment for headers
$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

 //top details
$col='A';
$row='1';

    //Write cells
foreach ($value_top as $top){
	$cell=$col.$row;
    $objWorkSheet->setCellValue($cell, $top);
        $cell=$col.$row;
$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $top);
$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArrayTop);

$mergeCells = 'A'.$row.':F'.$row;

$objPHPExcel->getActiveSheet()->mergeCells($mergeCells);
$row++;
        }

    // Rename sheet*/
    $objWorkSheet->setTitle("Summary");


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
}//end foreach second sheet headers

//set default alignment for contents
$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

//reset cell pointer
         		$col='A';
         		$row='5';

//fields to show
$employee_fields = array(
    'employee_id',
	'employee_lastname',
	'employee_firstname',
	'employee_middlename'
	);

$table='totalcomputation';
$employeeids = get_employeeids_from_cutoff($cutoff);

//initialize row count
$row_count=1;
foreach ($employeeids as $emp_ids){
     $sql = "SELECT * FROM $table WHERE CutoffID='$cutoff' AND EmployeeID=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {

                 while($row_query = $result->fetch_assoc()) {
                 	//output row count
                 	$cell=$col.$row;
			        $value=$row_count;		     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					$col++;

                 						//fetch employee details from employee table
				         				$sql_employee = "SELECT * FROM employee WHERE employee_id=$emp_ids";
				     					$result_employee = $conn->query($sql_employee);
				       					  if ($result_employee->num_rows > 0) {
				       					  		while($row_employee = $result_employee->fetch_assoc()) {

				       					  			foreach($employee_fields as $emp_field){
				       					  				$cell=$col.$row;
												        $value=$row_employee[$emp_field];			     
										            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
														$col++;
				       					  			}//end foreach
				       					  			}//end while
				       					  		}//end if
				       					  	
				       					  
				    //get netpay from table totalcomputation   					  
                 	$cell=$col.$row;
			        $value=$row_query['NetPay'];			     
	            	$objPHPExcel -> getActiveSheet() -> setCellValue($cell, $value);
					//$col++;

					//reset cell pointer and move to next row
					$row++;
					$col='A';
					$row_count++;
                 }
             }

	}//end of for each emp id*/

//enter summation
	

//bring first active sheet to front
$objPHPExcel->setActiveSheetIndex(0); 



//////////////////////////////////////////////////////////////////////////////////////////////////////////////



date_default_timezone_set("Asia/Manila");

header('Content-Type: application/vnd.ms-excel.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PayrollRegistrationSheet '.$cutoff.' '.date("Y-m-d").' '.date("h i s").'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');


//**********************************************functions section********************************************
function get_total_hours($cutoff, $emp_ids, $field){
include 'dbconfig.php';

	 $sql = "SELECT $field FROM total_hours WHERE cutoff='$cutoff' AND employee_id=$emp_ids";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                 	$value=$row[$field];
                 }
            }
return $value;
}//end get_total_hours


function prepare_multi_array($comp_id){

	$multi_array = array();

	include 'dbconfig.php';
	 $sql = "SELECT * FROM totalcomputation_meta WHERE comp_id=$comp_id";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                 	$field=$row['meta_key'];
                 	$value=$row['meta_value'];
                 	
                 	$multi_array[$field]=$value;
                 }
            }
return $multi_array;

}//end function


function fetch_meta($compids, $meta_key, $meta_type){
include 'dbconfig.php';

//prepare an array
$multi_array = array();
	
//check if $compids is an array
if (is_array($compids)) {

	//start loop
	foreach($compids as $comp_id){

		$sql = "SELECT * FROM totalcomputation_meta WHERE comp_id='$comp_id' AND meta_key='$meta_key' AND meta_type='$meta_type'";
		     $result = $conn->query($sql);
		         if ($result->num_rows > 0) {
		                 while($row = $result->fetch_assoc()) {
		                 	
		                 	//hashmap this

		                 	$field=$row['meta_optional']; //$key
		                 	//$value=$row['meta_value']; //$value
		                 	
		                 	$multi_array[]=$field;

		                 	$multi_array=array_unique($multi_array);
		                 }//end while
		            }//end if

	}//end foreach $compids
}//end if

sort($multi_array);

return $multi_array;
}//end function

function get_meta_value($comp_id, $meta_optional){

	

	include 'dbconfig.php';
	 $sql = "SELECT * FROM totalcomputation_meta WHERE comp_id='$comp_id' AND meta_optional='$meta_optional'";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                 	$value=$row['meta_value'];                 	
                 	
                 }
            }
         else
         	$value=0;

return $value;
}//end function

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

'Regular OT',
'reg_ot',

'Regular ND',
'reg_nd',

'Regular OT ND',
'reg_ot_nd',

'Rest Day',
'rst_ot',

'Rest Day > 8',
'rst_ot_grt8',

'Rest Day ND',
'rst_nd',

'Rest Day ND > 8',
'rst_nd_grt8',

'Legal Holiday',
'lh_ot',

'Legal Holiday > 8',
'lh_ot_grt8',

'Legah Holiday ND',
'lh_nd',

'Legah Holiday ND > 8',
'lh_nd_grt8',

'Special Holiday',
'sh_ot',

'Special Holiday > 8',
'sh_ot_grt8',

'Special Holiday ND',
'sh_nd',

'Special Holiday ND > 8',
'sh_nd_grt8',

'Rest Day/Legal Holiday',
'rst_lh_ot',

'Rest Day/Legal Holiday > 8',
'rst_lh_ot_grt8',

'Rest Day/Legal Holiday ND',
'rst_lh_nd',

'Rest Day/Legal Holiday ND > 8',
'rst_lh_nd_grt8',

'Rest Day/Special Holiday',
'rst_sh_ot',

'Rest Day/Special Holiday > 8',
'rst_sh_ot_grt8',

'Rest Day/Special Holiday ND',
'rst_sh_nd',

'Rest Day/Special Holiday ND > 8',
'rst_sh_nd_grt8',

'Leave Hours',
'leave_hrs',

'RETRO TOTAL',



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
	'TAXABLE BENEFITS TOTAL', //total other taxable earnings
	'GROSS TAXABLE INCOME', //income + other taxable earnings

//start deductions

	'DAYS ABSENT',
	'ABSENT AMOUNT',
	'TARDINESS TOTAL',
	'TARDINESS AMOUNT',
	'UNDERTIME',
	'UNDERTIME AMOUNT',

	//sss
	'SSS EMPLOYEE SHARE',
	'SSS EMPLOYER SHARE',
	'SSS EC', //employer contribution 10 pesos

	//pagibig
	'HDMF EMPLOYEE SHARE',
	'HDMF EMPLOYER SHARE',
	
	//philhealth
	'PHIC EMPLOYEE SHARE',
	'PHIC EMPLOYER SHARE',
	
	//
	'STATUTORY TOTAL',
	//'SALARY ADJ RETRO ABSENT DEDUCTIBLE',
	//'SALARY ADJ RETRO TARDINESS DEDUCTIBLE',
	'TAXABLE DEDUCTIBLE BENEFITS TOTAL', //ano to??
	'TAXABLE DEDUCTIBLE TOTAL', //absent+late+tardiness+statutory

	//blue
	'NET TAXABLE INCOME',

	'WITHHOLDING TAX',

	//'LAUNDRY ALLOWANCE', //start non-taxable income
	//'RICE ALLOWANCE',
	'NONTAXABLE BENEFITS TOTAL',

	//blue
	//'MAXICARE', //start non-taxable deductions
	//'PAGIBIG LOAN',
	//'PERSONAL LOAN',
	//'SSS LOAN',
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