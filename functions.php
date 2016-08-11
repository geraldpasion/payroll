<?php


function get_fieldnames($tablename){
include 'dbconfig.php';

	$sql = "SHOW COLUMNS FROM $tablename";
	$result = mysqli_query($mysqli,$sql);
	while($row = mysqli_fetch_array($result)){
	////echo $row['Field']."<br>";
	//save it to an array
	$fields[]=$row['Field'];

	}

return $fields;
}//end get_fieldnames


function get_table($tablename){
	include 'dbconfig.php';
	?>
<div class="container">
		<table class='table table-responsive table-striped table-hover table-collapse' style="overflow: auto;">
			<tr>
				<?php
					$fields=get_fieldnames($tablename);
					foreach ($fields as $key => $value){
						//echo '<th>'.$value.'</th>';
					}
				?>
			</tr>

			
				<?php
					$fields=get_fieldnames($tablename);
					
						$sql = "SELECT * FROM $tablename WHERE coaching_status='Pending'";
						$result = mysqli_query($mysqli,$sql);

						while($row = mysqli_fetch_array($result)){
							//echo '<tr>';
							foreach ($fields as $key => $value){
								//echo "<td>".$row[$value]."</td>";			
							}
							//echo '</tr>';
						}
					
				?>
			
		</table>
</div>

	<?php
}//end of get_table


function delete_previous_compute($cutoff_field){
include 'dbconfig.php';

$table = array('total_comp_salary', 'totalcomputation', 'total_hours');
$field = array('cutoff', 'CutoffID', 'cutoff'); 

        for($i=0; $i<2; $i++){
            $tab = $table[$i];
            $fie = $field[$i];
            $sql = "DELETE FROM $tab WHERE $fie='$cutoff_field'";
            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully ".$tab.nextline();
            } else {
                echo "Error deleting record: " . $conn->error.nextline();
            }
        }//end for

}


//for adding additional earnings/deductions after computation of net pay. needs to recompute per affected employee only
function recompute_other_taxables($empids, $intial, $end){

include 'dbconfig.php';

//$empids must be an array


}

function create_total_hours_table($cutoff){
//duplicate total_comp table
include 'dbconfig.php';

    //Clear table first with the same cutoff
    delete_statement('total_hours',0,$cutoff);

    $sql="INSERT INTO total_hours SELECT * FROM total_comp WHERE cutoff='$cutoff'";

    echo $sql;

    echo nextline().nextline();;

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully total_hours".doubleline();
    } 
    else {
    echo "Error total_hours: " . $sql . "<br>" . $conn->error;
    }
    echo "<br>";

}//end create_total_hours_table

//pass cutoff
function compute($cutoff_field, $update, $emp, $comp=null){

$start_time = microtime(TRUE);

include 'dbconfig.php';
include 'payroll_compute.php';
include 'statutory_benefits_compute.php';
include 'other_earnings_and_deductions.php';
//require 'rb.php';

//clear first
//delete_previous_compute($cutoff_field);
//duplicate total_comp to total_hours, then compute using total_hours
//instead of total_comp. total_comp can be deleted so we need another table that doesn't.
//total_hours will be used to compute or recompute the process

create_total_hours_table($cutoff_field);

//echo 'swal("Test")';

$fields=get_fieldnames('total_hours');

foreach ($fields as $field){
   //echo $field.nextline();
}

$table='total_hours';

//get field names of total_comp //total_hours na
$fields=get_fieldnames($table);

                            //total_hours na
//prepare fields to fetch at total_comp and process it with formulas under payroll_compute.php
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

//get deduction fields
$deduction_fields = array(
    'absent',
    'late',
    'undertime'
    );

//$counts = array_count_values($hours_fields);
////echo "<br><Br>countarr: ".$counts['sh_nd']."<br>";

//get payroll factor value
$sql = "SELECT * FROM payrollfactor";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $payrollfactorvalue = $row['factor'];
        echo "payrollfactorvalue: ".$payrollfactorvalue."<br><br>";
    }
}
else {
    echo "payroll factor 0 results";
}


//select data from total_comp
$table='total_hours';
if($update==1){
    //delete from total_comp_salary and totalcomputation table in preparation for updates
    //Note: $emp is the employee id passed from the optional parameter of this compute() function
    delete_emp_salary($cutoff_field, $emp);

$sql = "SELECT * FROM $table WHERE cutoff='$cutoff_field' AND employee_id='$emp' LIMIT 1";
}
else{
    //clear first
delete_previous_compute($cutoff_field);
$sql = "SELECT * FROM $table WHERE cutoff='$cutoff_field'";
}




$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "***************************************************************<br>";

        //initialize insert statement values to null and generate insert statement;
        $insert_statement_val="(";

        $employee_id = $row['employee_id'];
        echo 'employee_id: '.$employee_id.'<br>';

        $comp_id=$row['comp_id'];
        echo 'comp_id: '.$comp_id."<br>";

        $cutoff_total_comp=$row['cutoff'];
        echo 'cutoff: '.$cutoff_total_comp.nextline();


        //insert values for comp_id and employee_id;
        $insert_statement_val=$insert_statement_val."'".$comp_id."', ";
        $insert_statement_val=$insert_statement_val."'".$employee_id."', ";
        $insert_statement_val=$insert_statement_val."'".$cutoff_total_comp."', ";

        //get BaseSalary from employee table, field employee rate
        $sql_basesalary = "SELECT employee_rate, cutoff FROM employee WHERE employee_id=$employee_id";
        $result_basesalary =  $conn->query($sql_basesalary);
        if ($result_basesalary->num_rows > 0) {
                while($row_basesalary = $result_basesalary->fetch_assoc()) {
                    
                    $BaseSalary = $row_basesalary['employee_rate'];
                    $getcutoff=$row_basesalary['cutoff'];

                    echo "cutoff (Monthly/Semi): ".$getcutoff.nextline();

                    if($getcutoff=='Semi-monthly'){
                        $SemiBase=$BaseSalary/2;
                        echo 'BaseSalary: '.$BaseSalary.'<br>';
                        echo 'Salary (Semi): '.$SemiBase.'<br>';
                        //$BaseSalary=$SemiBase;
                    }
                    else
                        echo 'BaseSalary: '.$BaseSalary.'<br>';
                }               
        }//end of get employee rate

        //compute hourly rate;
        $HourlyRatePay = HourlyRate($BaseSalary, $payrollfactorvalue);
        //force check
        //$HourlyRatePay = 12.5;
        echo 'HourlyRatePay: '.$HourlyRatePay.'<br>';

        //initialize gross income to BaseSalary;
        if($getcutoff=='Semi-monthly'){
            $NetTaxableIncome = $BaseSalary/2;
        }
        else
        $NetTaxableIncome = $BaseSalary;
        //$NetTaxableIncome=0;

        $WithoutOT=$NetTaxableIncome;
        echo '$NetTaxableIncome w/o OT: '.$WithoutOT.doubleline();

        $insert_statement_val_taxable_earnings="";

//*****************************************************compute OT******************************************

echo "<table>";


        foreach ($fields as $field){
            //output only date with fields equivalent to $hours_field array
            if(in_array($field, $hours_fields)){
                echo "<tr>";
                    
                   // echo "<font color=white><td>".floatval($row[$field])."</td></font>";   
                    echo "<td valign=top>";
                //call functions at functions.php

                $val = $field($row[$field],$HourlyRatePay);
                echo "<font color=black><b>".$field."</b>: ".$val."</font>";
                echo "</td>";

                //insert statement string
                $insert_statement_val_taxable_earnings=$insert_statement_val_taxable_earnings."'".$val."', ";


                echo "<td valign=top>";
                $NetTaxableIncome = $NetTaxableIncome + $val;
                echo "<font color=black><b>".$field."</b>: ".$row[$field]."</font>";
                echo "</td>";

                echo "</tr>";
            }
        }


echo "</table>";

        echo nextline();
        $OTearnings=$NetTaxableIncome-$WithoutOT;
        echo "Total OT earnings: ".$OTearnings.nextline();
        $GrossTaxableIncome=$NetTaxableIncome;
        //echo "Gross Income w/o deductions: ".$NetTaxableIncome.doubleline();

        //for insert statement
        $NetTaxableIncomeWithoutDeductions=$NetTaxableIncome;

       


echo '//*****************************************Retro************************************************'.nextline();
     
$Total_Retro = retro_compute($employee_id, $comp_id, $cutoff_field);

echo "Total Retro: ".$Total_Retro.nextline();

//add to net taxable income without deductions
$GrossTaxableIncome = $NetTaxableIncomeWithoutDeductions + $Total_Retro;
$NetTaxableIncome=$GrossTaxableIncome;

echo 'Gross Taxable Income W/ Retro: '.$GrossTaxableIncome.nextline();

echo nextline().'**********************************************************'.doubleline();

//*****************************************************compute deductions here*************************************
        //initialize
        $total_deductions = 0;
        $insert_statement_deductions="";
        foreach ($fields as $field){
            //output only date with fields equivalent to $hours_field array
            if(in_array($field, $deduction_fields)){ // syntax: (a string, array of strings)
                    
                //call functions at functions.php
                if ($field == 'absent'){
                    $val = $field($row[$field],$HourlyRatePay, $employee_id, $comp_id);
                    echo "val: ".$val.nextline();
                    $total_deductions = $total_deductions + $val;
                }
                else{
                    $val = $field($row[$field],$HourlyRatePay);
                    $total_deductions = $total_deductions + $val;
                    echo $field.": ".$val."<br>";
                }
                    

                $NetTaxableIncome = $NetTaxableIncome - $val;

                //get absent, late, undertime insert statment
                $insert_statement_deductions=$insert_statement_deductions."'".$val."', ";
                echo "<u>".$field." deduction (peso): </u>".$val.doubleline();

            }
        }

        echo "Gross Income w/ OT+Retro: ".$GrossTaxableIncome.nextline();
        echo "Deductions (absent, late, ut): ".$total_deductions.nextline();

        //SSS, Pagibig, PhilHealth
        //Based on gross income
        

        //*************************other Taxable earnings and deductions*********************/

         //clear to recompute meta //this affects sss, pagibig and philhealth
                        delete_statement('totalcomputation_meta', $comp_id);

        //Note: functions can be found on other_earnings_and_deductions.php
        $other_earnings=compute_other_earnings($comp_id, $employee_id);
        echo "Other Taxable Earnings: ".$other_earnings.doubleline();

        $other_deductions=compute_other_deductions($comp_id, $employee_id);
        echo "Other Taxable Deductions: ".$other_deductions.doubleline();

        $NetTaxableIncome = $NetTaxableIncome + $other_earnings - $other_deductions;

        //$GrossTaxableIncome=$GrossTaxableIncome+$other_earnings;
       
        //*************************************

        //get cutoff and taxcode
        $sql_taxcode = "SELECT employee_taxcode, cutoff FROM employee WHERE employee_id=$employee_id";
        $result_taxcode =  $conn->query($sql_taxcode);
        if ($result_taxcode->num_rows > 0) {
                while($row_taxcode = $result_taxcode->fetch_assoc()) {
                    $Taxcode = $row_taxcode['employee_taxcode'];
                    //echo 'Taxcode: '.$Taxcode.'<br>';
                    $cutoff=$row_taxcode['cutoff'];
                    //echo 'cutoff: '.$cutoff.nextline();;                   
                }               
        }//end of get employee rate

        //$withoutStatutory = $NetTaxableIncome;

        //GrossTaxableIncome
        $earnings = $GrossTaxableIncome + $other_earnings;
        //GrossTaxableDeductions
        $deductions = $total_deductions + $other_deductions;

        /*
            Note: total_deductions = absent + late + undertime
                  other_deductions = other taxable deductions
                  deductions = 
        */


        //Gross Income w/o statutory before statutory
        $withoutStatutory = $earnings-$deductions;

        echo "Gross Taxable Income (BasicSalary+OT+Retro+Other Taxable Earnings): ".$earnings.doubleline();




        echo "Net Taxable Income w/o Statutory Benefits (Gross Income w/ OT - Deductions + Other Taxable Earnings - Other Taxable Deductions): ".$withoutStatutory.nextline();

        //************************************Statutory Benefits**************************

        echo "************************************Statutory Benefits**************************".doubleline();;


        echo 'cutoff: '.$cutoff.nextline();

        //initialize statutory benefits computation
        $Statutory_total=0;
        
        //SSS
        //semi monthly EE/2

        $sss_details=sss_compute($withoutStatutory);
        
        if($cutoff=='Semi-monthly'){
             //$sss_val=$sss_val/2;
        }

        /*
                    Range_Of_Compensation_From //1
                    Range_Of_Compensation_To //2
                    Monthly_Salary_Credit //3
                    Social_Security_ER //4
                    Social_Security_EE //5
                    Social_Security_Total //6
                    ECER //7
                    Total_Contribution_ER //8
                    Total_Contribution_EE //9
                    Total_Contribution_Total //10
                    SEVMOFW //11
        */
        $sss_range_from=$sss_details[1];
        $sss_range_to=$sss_details[2];
        $sss_monthly_salary_credit=$sss_details[3];
        $sss_ER=$sss_details[4];   

        $sss_val=$sss_details[5]; //important value for computation

        $sss_total=$sss_details[6];
        $sss_ECER=$sss_details[7];
        $sss_contribution_ER=$sss_details[8];
        $sss_contribution_EE=$sss_details[9];
        $sss_contribution_total=$sss_details[10];
        $sss_SEVMOFW =$sss_details[11];           

        echo "SSS (".$cutoff."): ".$sss_val.nextline();
        $Statutory_total=$Statutory_total+$sss_val;


        //Pagibig
        //divided by 2 for semi monthly
        $pagibig_details=pagibig_compute($withoutStatutory);

        $pagibig_compensation=$pagibig_details[1];
        $pagibig_compensation_from=$pagibig_details[2];
        $pagibig_employer=$pagibig_details[3];

        $pagibig_val=$pagibig_details[4]; //include in computation. pagibig employee share

        echo "PAG-IBIG: ".$pagibig_val.nextline();

        //add to statutory total
        $Statutory_total=$Statutory_total+$pagibig_val;


        //PhilHealth
        //divided by 2 for semi monthly
        $philhealth_details=philhealth_compute($withoutStatutory);

        //philhealth details
        $philhealth_braket=$philhealth_details[1];
        $philhealth_salary_range_from=$philhealth_details[2];
        $philhealth_salary_range_to=$philhealth_details[3];
        $philhealth_salary_base=$philhealth_details[4];
        $philhealth_total_monthly_conribution=$philhealth_details[5];
        $philhealth_employer_share=$philhealth_details[6];
       
        $philhealth_val=$philhealth_details[7]; //important

        echo "PhilHealth: ".$philhealth_val.nextline();
        $Statutory_total=$Statutory_total+$philhealth_val;

        echo nextline();
        //total statutory benefits (add all)    
        echo "Total Statutory Benefits: ".$Statutory_total.doubleline();

        //add $Statutory_total to $total_deductions
        //$total_deductions=$total_deductions+$Statutory_total;

        $NetTaxableIncome = $withoutStatutory - $Statutory_total;

        //echo "w/ Statutory(Net Taxable Income - Total Statutory Benefits): ".$withStatutory.nextline();

        echo nextline()."NetTaxableIncome(Net Income w/o Statutory - Total Statutory Benefits): ".$NetTaxableIncome.nextline();

        echo "<br>";



        //***********compute Net Income After Tax
        echo "/***********compute Net Income After Tax*****************/".doubleline();
       
        $GrossCheck=0;

        if ($cutoff=='Monthly'){
                        
                        $TaxDetails=TaxMonthly($Taxcode, $NetTaxableIncome);
                       $NetIncomeAfterTax=$TaxDetails[7];
                      
                    }
                    else if($cutoff=='Semi-monthly'){
                 
                        //$NetIncomeAfterTax=TaxSemiMonthly($Taxcode, $NetTaxableIncome);
                      $TaxDetails=TaxSemiMonthly($Taxcode, $NetTaxableIncome);
                      $NetIncomeAfterTax=$TaxDetails[7];
                    }


        echo nextline();

        //asign tax details values
         /*
          TaxDetails[]
          0. Level
          1. GrossCheck
          2. FixedAmount
          3. PercentOver
          4. Difference
          5. PercentedDifferenceGross
          6. total_tax
          7. NetIncomeAfterTax
        */
        $Level=$TaxDetails[0];
        $GrossCheck=$TaxDetails[1];
        $FixedAmount=$TaxDetails[2];
        $PercentOver=$TaxDetails[3];
        $Difference=$TaxDetails[4];
        $PercentedDifferenceGross=$TaxDetails[5];
        $WithholdingTax=$TaxDetails[6];
        //$NetIncomeAfterTax=$TaxDetails[7];

        //echo 'GrossCheckxxxx: '.$GrossCheck.nextline();
        //echo 'FX: '.$FixedAmount.nextline();

       //$withholdingtax=$NetTaxableIncome-$NetIncomeAfterTax;
        echo 'Withholding Tax: '.$WithholdingTax.doubleline();

          //*************************other Non-Taxable earnings and deductions*********************/
        //Note: functions can be found on other_earnings_and_deductions.php
        $nontaxable_income=compute_other_earnings($comp_id, $employee_id, 1);
        echo "Other Non-Taxable Earnings: ".$nontaxable_income.doubleline();

        $nontaxable_deductions=compute_other_deductions($comp_id, $employee_id, 1);
        echo "Other Non-Taxable Deductions: ".$nontaxable_deductions.doubleline();

        $net_pay=0;

        $net_pay=$NetIncomeAfterTax+$nontaxable_income-$nontaxable_deductions;
       


         //*********net pay*************************
         echo "Net Pay: ".$net_pay.nextline();
         echo "Round off Net Pay to 2 decimals: ".round($net_pay,2).doubleline();




         //generate insert statment;
         echo "************insert statment**********************".doubleline();

         //$insert_statement_val=substr($insert_statement_val, 0, -2);

         //get net taxable income and non-toxable income
         $insert_statement_val=$insert_statement_val."'".$NetTaxableIncomeWithoutDeductions."', ";
         $insert_statement_val=$insert_statement_val."'".$nontaxable_income."', ";

         //get net taxable deductions and non-toxable deductions
         $insert_statement_val=$insert_statement_val."'".$total_deductions."', ";
         $insert_statement_val=$insert_statement_val."'".$nontaxable_deductions."', ";

         //absent late undertime


         echo "generated insert earnings statement: ".$insert_statement_val.nextline();
         echo "generated insert deductions statement: ".$insert_statement_deductions.nextline();

         //$insert_statement_val=$insert_statement_val.")";
         echo "generated insert OT statement: ".$insert_statement_val_taxable_earnings.nextline().nextline();

         $insert_statement_concat=$insert_statement_val.$insert_statement_deductions.$insert_statement_val_taxable_earnings;

         //insert net pay
         $insert_statement_concat=$insert_statement_concat."'".$net_pay."', ";
         $insert_statement_concat=substr($insert_statement_concat, 0, -2);
         $insert_statement_concat=$insert_statement_concat.")";
         echo "concatenated insert statement values: ".$insert_statement_concat.nextline();




         //get fields of total_comp_salary
         $into_fields="(";
         $fields_salary=get_fieldnames('total_comp_salary');

         //generate into statement
         $i=0;
         foreach ($fields_salary as $field){
           
            if ($field!='id' and $field!='reg_hrs' and $field!='process_status'){
                 $i++;
             $into_fields=$into_fields.$field.", ";

            }
         }

         //trim
         $into_fields=substr($into_fields, 0, -2);
         //closing parenthesis
         $into_fields=$into_fields.")";
         echo "into_fields: ".$into_fields.nextline();

         echo nextline().nextline();


         //check if comp_id already exists in total_comp_salary. if  yes, update. else insert.
         $comp_id_check=check_comp_id_existence($comp_id, 'total_comp_salary'); //the value of $comp_id_check will be equal to ID of total_comp_salary if they found an existing entry
                                                           //this is crucial for redbean framework for updating purposes
         if($comp_id_check>0){
            //update_statement($comp_id_check);
         }
         else{
         //call insert function
         insert_statement($into_fields, $insert_statement_concat, 'total_comp_salary');
         }


 $semisalary=$BaseSalary/2;
 $dailyrate=dailyhours($employee_id)*$HourlyRatePay;
 echo "daily rate: ".$dailyrate.nextline();
         //insert_statement meta
         $totalcomputation_fields=get_fieldnames('totalcomputation');
         $into="(";
            $values="(";
         foreach ($totalcomputation_fields as $tcf){

            if($tcf!='id' and $tcf!='DateCreated' and $tcf!='DateModified' and $tcf!='process_status'){
             $into=$into.$tcf.", ";

             //fields CompID, EmployeeID, CutoffID, BasicSalary, SemiMonthlyRate, DailyRate, HourlyRate, 
             //TotalTaxableEarnings, TotalTaxableDeduction, TotalStatutoryBenefits, NetTaxableIncome, NetIncomeAfterTax, 
             //TotalNonTaxableIncome, TotalNonTaxableDeduction, NetPay

             //tcf - totalcomputation fieled

             if ($tcf=='CompID')
                $values=$values."'".$comp_id."'";
             else if ($tcf=='EmployeeID')
                $values=$values."'".$employee_id."'";
             else if ($tcf=='CutoffID')
                $values=$values."'".$cutoff_field."'";
             else if ($tcf=='BasicSalary')
                $values=$values."'".$BaseSalary."'";
             else if ($tcf=='SemiMonthlyRate')
                $values=$values."'".$semisalary."'";
             else if ($tcf=='DailyRate')
                $values=$values."'".$dailyrate."'";
             else if ($tcf=='HourlyRate')
                $values=$values."'".$HourlyRatePay."'";
             else if ($tcf=='RetroTotal')
                $values=$values."'".$Total_Retro."'";

            //oters
            else if ($tcf=='OtherTaxableEarnings')
                $values=$values."'".$other_earnings."'";
            else if ($tcf=='OtherTaxableDeductions')
                $values=$values."'".$other_deductions."'";

            //Gross Taxable Income
             else if ($tcf=='TotalTaxableEarnings')
                $values=$values."'".$earnings."'";
             else if ($tcf=='TotalTaxableDeduction')
                $values=$values."'".$deductions."'"; //absent+late+ut + other taxable deductions

            else if ($tcf=='GrossTaxableIncome')
                $values=$values."'".$earnings."'";

            //statutories
            //sss 
             else if ($tcf=='SSS'){
                $values=$values."'".$sss_val."'";

                //clear to recompute meta //this also affects pagibig and philhealth
                       // delete_statement('totalcomputation_meta', $comp_id); 

                //generate sss meta

                        //initialize string for into and values
                        $sss_into="(comp_id, meta_key, meta_value, meta_type)";
                        
                        //get sss_contribution field names
                        $sss_fields=get_fieldnames('sss_contribution');    
                        //get_lastestid('totalcomputation');
                        $i=0;
                        foreach ($sss_fields as $sf){
                            $sss_values="(";
                            $sss_values=$sss_values."'".$comp_id."', "."'".$sf."', "."'".$sss_details[$i]."', 'sss')";
                            $i++;

                        echo "sss into: ".$sss_into.nextline();
                        echo "sss values: ".$sss_values.nextline();
                         
                        insert_statement($sss_into, $sss_values, 'totalcomputation_meta');
                        }
                        echo doubleline(); 


                }
                

             else if ($tcf=='PAGIBIG'){
                $values=$values."'".$pagibig_val."'";

               //initialize string for into and values
                        $pagibig_into="(comp_id, meta_key, meta_value)";
                        
                        //get sss_contribution field names
                        $pagibig_fields=get_fieldnames('pagibig');    
                        //get_lastestid('totalcomputation');
                        $i=0;
                        foreach ($pagibig_fields as $pf){
                            $pagibig_values="(";
                            $pagibig_values=$pagibig_values."'".$comp_id."', "."'".$pf."', "."'".$pagibig_details[$i]."')";
                            $i++;

                        echo "pagibig into: ".$pagibig_into.nextline();
                        echo "pagibig values: ".$pagibig_values.nextline();
                         
                        insert_statement($pagibig_into, $pagibig_values, 'totalcomputation_meta');
                        }
                        echo doubleline(); 
                    
            }


             else if ($tcf=='PhilHealth'){
                $i=0;
                $values=$values."'".$philhealth_val."'";         

                //generate sss meta

                        //initialize string for into and values
                        $ph_into="(comp_id, meta_key, meta_value, meta_type)";
                        
                        //get sss_contribution field names
                        $ph_fields=get_fieldnames('philhealth_contribution');    
                        //get_lastestid('totalcomputation');
                        $i=0;
                        foreach ($ph_fields as $phf){
                            $ph_values="(";
                            $ph_values=$ph_values."'".$comp_id."', "."'".$phf."', "."'".$philhealth_details[$i]."', 'philhealth')";
                            $i++;

                        echo "ph into: ".$ph_into.nextline();
                        echo "ph values: ".$ph_values.nextline();
                         
                        insert_statement($ph_into, $ph_values, 'totalcomputation_meta');
                        }
                        echo doubleline(); 




                }



             else if ($tcf=='TotalStatutoryBenefits')
                $values=$values."'".$Statutory_total."'";

             else if ($tcf=='NetTaxableIncome')
                $values=$values."'".$NetTaxableIncome."'";

            //taxes
             else if ($tcf=='GrossCheck')
                $values=$values."'".$GrossCheck."'";
             else if ($tcf=='FixedAmount')
                $values=$values."'".$FixedAmount."'";
             else if ($tcf=='PercentOver')
                $values=$values."'".$PercentOver."'";
             else if ($tcf=='Difference')
                $values=$values."'".$Difference."'";
             else if ($tcf=='PercentedDifferenceGross')
                $values=$values."'".$PercentedDifferenceGross."'";
             else if ($tcf=='WithholdingTax')
                $values=$values."'".$WithholdingTax."'";
             else if ($tcf=='NetIncomeAfterTax')
                $values=$values."'".$NetIncomeAfterTax."'";

             else if ($tcf=='TotalNonTaxableIncome')
                $values=$values."'".$nontaxable_income."'";
             else if ($tcf=='TotalNonTaxableDeduction')
                $values=$values."'".$nontaxable_deductions."'";
             else if ($tcf=='NetPay')
                $values=$values."'".$net_pay."'";



             //comma on every value
             $values=$values.", ";
             }
            //echo $tcf.nextline();
         }
         $into=substr($into, 0, -2);
         $into=$into.")";

         $values=substr($values, 0, -2);
         $values=$values.")";
        
         echo "into: ".$into.nextline();
         echo "values: ".$values.nextline();

         $comp_id_check=0;
        //check if comp_id already exists in total_comp_salary. if  yes, update. else insert.
         $comp_id_check=check_comp_id_existence($comp_id, 'totalcomputation'); //the value of $comp_id_check will be equal to ID of total_comp_salary if they found an existing entry
                                                           //this is crucial for redbean framework for updating purposes
         if($comp_id_check>0){
            //update_statement($comp_id_check);
         }
         else{
         //call insert function
         insert_statement($into, $values, 'totalcomputation');
         }

         echo nextline()."=============================================================================".nextline();
         echo nextline();

         //view_all('total_comp_salary', $comp_id);
    }//end while loop (row per employee on total_comp)
}//end if statement
else {
    echo "0 results from ".$table;
}



//compute time page loads
$end_time = microtime(TRUE);
 
$time_taken = $end_time - $start_time;
 
$time_taken = round($time_taken,5);
 
echo 'Page generated in '.$time_taken.' seconds.';

echo '</div>';

return $time_taken;
}//end function compute()





//generate next line
function nextline(){
    $nextline = "<br>";

    return $nextline;
}

function doubleline(){
    $nextline = "<br><br>";

    return $nextline;
}

function insert_statement($fields, $values, $table){
    include 'dbconfig.php';

    //check if comp_id already existing
    

    $sql="INSERT INTO $table $fields VALUES $values";

    echo $sql;

    echo nextline().nextline();;

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } 
    else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function check_comp_id_existence($comp_id, $table){
     include 'dbconfig.php';
     //$table='total_comp_salary';

     if($table=='total_comp_salary')
        $sql = "SELECT * FROM $table WHERE comp_id=$comp_id";
     else if ($table=='totalcomputation')
        $sql = "SELECT * FROM $table WHERE CompID=$comp_id";

    $result = $conn->query($sql);
         if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "comp_id exists in total_comp_salary! Update! ".$comp_id.doubleline();
                $rowid=$row['id'];
                return $rowid;

             }
          }
          else
                return 0;

//end function
}

function update_statement($id){
//use redbean framework for ease of use.
//require 'rb.php';

     R::setup( 'mysql:host=localhost;dbname=payroll','root', '' ); //for both mysql or mariaDB
    R::setAutoResolve( TRUE ); 

    //echo "id: ".$id.nextline();

    //R::debug(true);
    $salary = R::load( 'total_comp_salary', $id ); //reloads our book
    //echo "net_pay (from total_comp_salary): ".$salary -> net_pay;
    //echo nextline();
    //echo "redbean: ".$salary;
    //echo nextline();
}

function get_employeeids_from_cutoff($cutoff){
    include 'dbconfig.php';
     $table='totalcomputation';

     //prepare an array
     $emp_ids = array();

     $sql = "SELECT * FROM $table WHERE CutoffID='$cutoff'";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                    $emp_ids[]=$row['EmployeeID'];
                 }
         }


    return $emp_ids; 

}

function get_compids_from_cutoff($cutoff){
    include 'dbconfig.php';
     $table='totalcomputation';

     //prepare an array
     $comp_ids = array();

     $sql = "SELECT * FROM $table WHERE CutoffID='$cutoff'";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                    $comp_ids[]=$row['CompID'];
                 }
         }


    return $comp_ids; 

}
//get basic info of specific employee and save it in array then return
function get_employeeinfo($employee_id){
    include 'dbconfig.php';
     $table='employee';

     
     $sql = "SELECT * FROM $table WHERE employee_id=$employee_id";
     $employeeinfo=array();

     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                    $employeeinfo[]=$row['employee_lastname'];
                    $employeeinfo[]=$row['employee_firstname'];
                    $employeeinfo[]=$row['employee_middlename'];
                    $employeeinfo[]=$row['employee_rate'];
                    $employeeinfo[]=$row['cutoff'];
                      
                   
                    break;
                 }
         }     
 return $employeeinfo;
}



function view_all($table, $comp_id=0, $cutoff=0, $head=0){

include 'dbconfig.php';
     $table='total_comp_salary';

     $fields=get_fieldnames($table);

     if($comp_id>0)
     $sql = "SELECT * FROM $table WHERE comp_id=$comp_id";
     else
     $sql = "SELECT * FROM $table WHERE cutoff='$cutoff'";

    //prepare a string to return
    ;

    $first=0;

     $result = $conn->query($sql);
         if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                //list of fields
                foreach ($fields as $field) {
                $rowid=$row[$field];
               // echo $field.": ".$rowid.nextline();
                $viewval[]=$rowid;
                }//end foreach

                $first++;
             }
          }

return $viewval;
    //echo "******************************************************".nextline();
          

}//end function


function retro($employee_id, $HourlyRatePay){

    include 'dbconfig.php';
    //include 'payroll_compute.php';

      $table='others';

     $fields=get_fieldnames($table);

     foreach ($fields as $field){
      //  echo "'".$field."',".nextline();;
     }


$retro_fields = array (
//'others_id',
//'employee_id',
//'attendance_shift',
//'attendance_restday',
//'attendance_date',
//'attendance_timein',
//'attendance_breakout',
//'attendance_breakin',
//'attendance_timeout',
//'others_paid',
//'others_payable',
//'others_retro',
//'others_reason',
//'app_status',
//'others_status',
//'others_approvedby',
//'others_approvaldate',
//'others_remarks',
//'attendance_remarks',
'attendance_hours',
'attendance_absent',
'attendance_late',
'attendance_overtime',
'attendance_undertime',
//'attendance_overbreak',
'attendance_nightdiff',
'REG_OT_ND',
'RST_OT',
'RST_OT_GRT8',
'RST_ND',
'RST_ND_GRT8',
'LH_OT',
'LH_OT_GRT8',
'LH_ND',
'LH_ND_GRT8',
'SH_OT',
'SH_OT_GRT8',
'SH_ND',
'SH_ND_GRT8',
'RST_LH_OT',
'RST_LH_OT_GRT8',
'RST_LH_ND',
'RST_LH_ND_GRT8',
'RST_SH_OT',
'RST_SH_OT_GRT8',
'RST_SH_ND',
'RST_SH_ND_GRT8',
'leave_hrs',
//'attendance_status',
//'status',
//'attendance_daytype',
    );


     //$sql = "SELECT * FROM $table WHERE employee_id=$employee_id";
     $sql = "SELECT * FROM $table";
 echo "<table border=1>";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
               
                foreach ($fields as $field) {
                
                //only compute fields to consider
                if (in_array($field, $retro_fields)) { 

                    //compute value
                    $funct=strtolower($field);

                    //tweak some fields to match function names at lowercase
                    if ($funct=='attendance_hours')
                        $funct='reg_hrs';
                    else if ($funct=='attendance_absent')
                        $funct='absent';
                    else if ($funct=='attendance_late')
                        $funct='late';
                     else if ($funct=='attendance_overtime')
                        $funct='reg_ot';
                     else if ($funct=='attendance_undertime')
                        $funct='undertime';
                     else if ($funct=='attendance_nightdiff')
                        $funct='reg_nd';
                   
                    

                    $rowid=$row[$field];
                    echo "<td><font color=black>";

                    echo $funct."=";

                    echo $field.": ".$row[$field]."";

                    echo nextline();

                    if($funct=='absent'){

                        $totaltime_per_day=dailyhours($employee_id);
                        //echo "employee total time per day: ".$totaltime_per_day.nextline();
                    }
                    else
                    $value=$funct($row[$field], $HourlyRatePay);
                    echo "val: ".$value;

                    echo "</font></td>";
                }//end if
                

                }
            echo nextline();

             echo '</tr>';   
             }
          }
          else
            echo "no retro".nextline();


    echo "</table>";
}


function delete_emp_salary($cutoff_field, $emp){

    include 'dbconfig.php';

    $sql = "DELETE FROM total_comp_salary
WHERE cutoff='$cutoff_field' AND employee_id='$emp'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully total_comp_salary".nextline();
} else {
    echo "Error deleting record: " . $conn->error;
}

 $sql = "DELETE FROM totalcomputation
WHERE CutoffID='$cutoff_field' AND EmployeeID='$emp'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully totalcomputation".nextline();
} else {
    echo "Error deleting record: " . $conn->error;
}

 }

function delete_statement($table, $comp_id=0, $cutoff=""){

     include 'dbconfig.php';

     if($comp_id>0){
            $sql = "DELETE FROM $table WHERE comp_id=$comp_id";
            $ch="hello";
        }
    else{
    $sql = "DELETE FROM $table WHERE cutoff='$cutoff'";
        $ch="world";
    }

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully $table $comp_id $cutoff $ch".nextline();
} else {
    echo "Error deleting record: " . $conn->error;
}
}

function check_update($cutoff_field, $empids){
    //check if total_comp has an existing cutoff, if none. don't compute.

    include 'dbconfig.php';
     $table='total_comp_salary';

     $fields=get_fieldnames($table);

     //initialize check flag
     $update_check = 0;

     $sql = "SELECT * FROM $table WHERE cutoff='$cutoff_field'";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                $update_check=0;
                break;
             }
          }
          else{

            $update_check=1;


            //recompute each employee that got affected with the new earnings/deduction
            foreach ($empids as $emp)
                //echo "empidxxxxx: ".$emp.nextline();
                compute($cutoff_field, $update_check, $emp);
          }

    //echo "******************************************************".nextline();
          

}


function cutoff_parse($cutoffdate){
                $cutarray = array();
                $cutarray = split(" - ", $cutoffdate);
                $keydatefrom = $cutarray[0];
                $keydatefrom = date("Y-m-d", strtotime($keydatefrom));
                $keydateto = $cutarray[1];
                $keydateto = date("Y-m-d", strtotime($keydateto));

                //echo "start: ".$keydateto.nextline();
               //echo "end: ".$keydatefrom.nextline();

                $cutoff_array = array(
                    $keydatefrom,
                    $keydateto
                    );

                return $cutoff_array;
}

function get_lastestid($table){
    include 'dbconfig.php';
echo 'xxxxxxxxxxxxxxxxxx'.nextline();
     $sql = "SELECT id FROM $table ORDER BY id DESC";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $lastid=$row['id'];
                echo "Last id of ".$table.": ".$lastid.nextline();
                return $lastid;
            }

        }
        else
            echo "wala".nextline();


}


function count_employees_within_cutoff($cutoff){
    include 'dbconfig.php';
    $count=0;
     $sql = "SELECT * FROM total_comp WHERE cutoff='$cutoff'";
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $count++;
            }

        }
       // else
           //echo "wala".nextline();

//echo "count: ".$count;
return $count;

}

//**********************Wilma**************************//




?>