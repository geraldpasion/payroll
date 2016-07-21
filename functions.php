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

//pass cutoff
function compute($cutoff_field){
include 'dbconfig.php';
include 'payroll_compute.php';
include 'statutory_benefits_compute.php';
include 'other_earnings_and_deductions.php';
//require 'rb.php';

$fields=get_fieldnames('total_comp');

foreach ($fields as $field){
   //echo $field.nextline();
}

$table='total_comp';

//get field names of total_comp
$fields=get_fieldnames($table);

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
$sql = "SELECT * FROM $table WHERE cutoff='$cutoff_field'";

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

echo "<table border=1>";


        foreach ($fields as $field){
            //output only date with fields equivalent to $hours_field array
            if(in_array($field, $hours_fields)){
                echo "<tr>";
                    
                    echo "<td valign=top>";
                //call functions at functions.php
                $val = $field($row[$field],$HourlyRatePay);
                echo "<font color=white><b>".$field."</b>: ".$val."</font>";
                echo "</td>";

                //insert statement string
                $insert_statement_val_taxable_earnings=$insert_statement_val_taxable_earnings."'".$val."', ";


                echo "<td valign=top>";
                $NetTaxableIncome = $NetTaxableIncome + $val;
                echo "<font color=white><b>".$field."</b>: ".$row[$field]."</font>";
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

        $total_deductions = 0;
        $insert_statement_deductions="";
        //compute deductions here
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

        echo "Gross Income w/ OT: ".$GrossTaxableIncome.nextline();
        echo "Total (absent, late, ut): ".$total_deductions.nextline();

        //SSS, Pagibig, PhilHealth
        //Based on gross income
        


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



        echo "Net Taxable Income w/o Statutory Benefits (including OT - deductions [absent, late undertime]): ".$NetTaxableIncome.nextline();

        //************************************Statutory Benefits**************************

        echo "************************************Statutory Benefits**************************".doubleline();;


        echo 'cutoff: '.$cutoff.nextline();

        //initialize statutory benefits computation
        $Statutory_total=0;
        
        //SSS
        //semi monthly EE/2
        $sss_val=sss_compute($NetTaxableIncome);
        
        if($cutoff=='Semi-monthly'){
             //$sss_val=$sss_val/2;
        }
        echo "SSS (".$cutoff."): ".$sss_val.nextline();
        $Statutory_total=$Statutory_total+$sss_val;


        //Pagibig
        //divided by 2 for semi monthly
        $pagibig_val=pagibig_compute($NetTaxableIncome);
        echo "PAG-IBIG: ".$pagibig_val.nextline();
        $Statutory_total=$Statutory_total+$pagibig_val;

        //PhilHealth
        //divided by 2 for semi monthly
        $philhealth_val=philhealth_compute($NetTaxableIncome);
        echo "PhilHealth: ".$philhealth_val.nextline();
        $Statutory_total=$Statutory_total+$philhealth_val;

        echo nextline();
        //total statutory benefits (add all)    
        echo "Total Statutory Benefits: ".$Statutory_total.nextline();

        //add $Statutory_total to $total_deductions
        $total_deductions=$total_deductions+$Statutory_total;


        //*************************other earnings and deductions*********************/
        //Note: functions can be found on other_earnings_and_deductions.php
        $other_earnings=compute_other_earnings($comp_id);

        $other_deductions=compute_other_deductions($comp_id);

        $total_other_earnings=$OTearnings+$other_earnings;

        echo "Total Taxable Earnings (OT + others): ".$total_other_earnings.nextline();;
        //echo "Total Taxable Deductions: ".$other_deductions.nextline();;

        //do math here
        //$total_others=$other_earnings-$other_deductions;
        //echo "Total Taxables (earnings - deductions): ".$total_others.nextline();

        //add to $NetTaxableIncome
        //$NetTaxableIncome=$NetTaxableIncome+$total_others;



        echo "Total Taxable Deductions (Absent, Late, UT, Statutory Benefits, Others): ".$total_deductions.nextline();

        //deduct to NetTaxableIncome;
        $NetTaxableIncome=$NetTaxableIncome-$total_deductions;
        echo "NetTaxableIncome: ".$NetTaxableIncome."<br>";
        echo "<br>";



        //***********compute Net Income After Tax
        echo "/***********compute Net Income After Tax*****************/".doubleline();
       


        if ($cutoff=='Monthly'){
                        $NetIncomeAfterTax=TaxMonthly($Taxcode, $NetTaxableIncome);
                    }
                    else if($cutoff=='Semi-monthly'){
                        $NetIncomeAfterTax=TaxSemiMonthly($Taxcode, $NetTaxableIncome);
                    }

        echo nextline();






        //**************************compute Net pay***********************//

        //***********************add non-taxable income
        //get comp_id
        $sql_addearnings="SELECT earn_max FROM emp_earnings WHERE comp_id=$comp_id AND earn_type='Non-Taxable'";
        //initialize $nonttaxable_income
        $nontaxable_income=0;
        $result_addearnings=$conn->query($sql_addearnings);
        if ($result_addearnings->num_rows > 0) {
            while($row_addernings = $result_addearnings->fetch_assoc()) {
                $nontaxable_income=$nontaxable_income+$row_addernings['earn_max'];
               
            }//end while
        }//end if
        else
            $nontaxable_income=0;

         echo "Non-Taxable Earnings: ".$nontaxable_income.nextline();

        $net_pay=$NetIncomeAfterTax+$nontaxable_income;

        //***********************add non-taxable deductions
        //get comp_id
        $sql_deductions="SELECT deduct_max FROM emp_deductions WHERE comp_id=$comp_id AND deduct_type='Non-Taxable'";
        $nontaxable_deductions=0;
        $result_deductions=$conn->query($sql_deductions);
        if ($result_deductions->num_rows > 0) {
            while($row_deductions = $result_deductions->fetch_assoc()) {
                $nontaxable_deductions=$nontaxable_deductions+$row_deductions['deduct_max'];
               
            }//end while
        }//end if
        else
            $nontaxable_deductions=0;

        //add Statutory ben to non-taxable deductions
        //$nontaxable_deductions=$nontaxable_deductions+$Statutory_total;


         echo "Non-Taxable Deductions: ".$nontaxable_deductions.nextline();

         $net_pay=$net_pay-$nontaxable_deductions;

         //*********net pay
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

            if($tcf!='ID' and $tcf!='DateCreated' and $tcf!='DateModified'){
             $into=$into.$tcf.", ";

             //fields CompID, EmployeeID, CutoffID, BasicSalary, SemiMonthlyRate, DailyRate, HourlyRate, 
             //TotalTaxableEarnings, TotalTaxableDeduction, TotalStatutoryBenefits, NetTaxableIncome, NetIncomeAfterTax, 
             //TotalNonTaxableIncome, TotalNonTaxableDeduction, NetPay



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
             else if ($tcf=='TotalTaxableEarnings')
                $values=$values."'".$GrossTaxableIncome."'";
             else if ($tcf=='TotalTaxableDeduction')
                $values=$values."'".$total_deductions."'";
             else if ($tcf=='TotalStatutoryBenefits')
                $values=$values."'".$Statutory_total."'";
             else if ($tcf=='NetTaxableIncome')
                $values=$values."'".$NetTaxableIncome."'";
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

         echo "=============================================================================".nextline();
         echo nextline();

         //view_all('total_comp_salary', $comp_id);
    }//end while loop (row per employee on total_comp)
}//end if statement
else {
    echo "0 results from ".$table;
}



$conn->close();


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

function view_all($table, $comp_id){

include 'dbconfig.php';
     $table='total_comp_salary';

     $fields=get_fieldnames($table);


     $sql = "SELECT * FROM $table WHERE comp_id=$comp_id";

     $result = $conn->query($sql);
         if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                foreach ($fields as $field) {
                $rowid=$row[$field];
                echo $field.": ".$rowid.nextline();
                }
             }
          }

    echo "******************************************************".nextline();
          

}//end function













//**********************Wilma**************************//




?>