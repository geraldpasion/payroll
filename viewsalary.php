<html>
<body>
<?php



//include 'functions.php';

salary_test();

/*
$fields=get_fieldnames('total_comp');

echo '<form action="demo_form.asp">';
foreach ($fields as $field){
    echo '<pre>';
   echo $field.': <pre><input type="text" name="'.$field.'" id="'.$field.'"><br></pre></pre>';
}
echo '<input type="submit" value="Submit">';
echo '</form>';

*/









function salary_test(){
include 'dbconfig.php';
include 'functions.php';
//include 'payroll_compute.php';

     $table='total_comp_salary';

     $fields=get_fieldnames($table);

echo "<table border=1>
<tr>
	<td><b>Hours/Mins</b></td>
	<td><b>Summary</b></td>
	<td><b>Detailed Computations</b></td>
	
</tr>";

$remove_field=array(
	'taxable_earnings',
	'nontaxable_earnings',
	'taxable_deductions',
	'nontaxable_deductions',
	'id',
	);


//hours

     $sql = "SELECT * FROM total_comp";

     $result = $conn->query($sql);
         if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td valign=top>";
                foreach ($fields as $field) {
			            if($field!='net_pay' ){	
			            	if ($field!='id' ){
					            $rowid=$row[$field];
					            echo "<b>".$field."</b>: ".$rowid.nextline(); 
					            if ($field=='comp_id')
					            	$comp_id=$rowid;
					        }
					        else if(in_array($field, $remove_field))
					        	echo nextline();

			            }  
                }//end foreach
                echo "<b>net_pay</b>: ".nextline();
                echo "</td>";
//echo "comp_id: ".$comp_id.nextline();
                //salary
               
                			$sql_sal = "SELECT * FROM total_comp_salary WHERE comp_id=$comp_id";

						    $result_sal = $conn->query($sql_sal);
						    echo "<td valign=top>";
						         if ($result_sal->num_rows > 0) {


						            // output data of each row
						            while($row_sal = $result_sal->fetch_assoc()) { 
						                foreach ($fields as $field) {
						                $rowid_sal=$row_sal[$field];
						                echo "<b>".$field."</b>: ".$rowid_sal.nextline();   

						                }//end foreach

						             }//end while
						         }

               				echo "</td>";

               				echo "<td valign=top>";

               						//computation summary
               						//compute($comp_id);

               				echo "</td>";

                echo "</tr>";
                
             }//end while
         }
echo "</table>";
}//end salary test


function compute3($comp_id_passed){

include 'dbconfig.php';
//include 'payroll_compute.php';
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
'reg_hrs',
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
'rst_sh_nd_grt8'
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
    echo "0 results";
}


//select data from total_comp
$sql = "SELECT * FROM $table WHERE comp_id=$comp_id_passed";

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


        			if($getcutoff='Semi-monthly'){
        				$SemiBase=$BaseSalary/2;
        				echo 'BaseSalary: '.$SemiBase.'<br>';
        				//$BaseSalary=$SemiBase;
        			}
        			else
        			echo 'BaseSalary: '.$BaseSalary.'<br>';
        		}       		
        }//end of get employee rate

        //compute hourly rate;
        $HourlyRatePay = HourlyRate($BaseSalary, $payrollfactorvalue);
        echo 'HourlyRatePay: '.$HourlyRatePay.'<br>';

        //initialize gross income to BaseSalary;
        if($getcutoff='Semi-monthly'){
        $NetTaxableIncome = $BaseSalary/2;
        }
        else
        $NetTaxableIncome = $BaseSalary;
        //$NetTaxableIncome=0;

        $insert_statement_val_taxable_earnings="";

        foreach ($fields as $field){
        	//output only date with fields equivalent to $hours_field array
        	if(in_array($field, $hours_fields)){
        			
        		//call functions at functions.php
        		$val = $field($row[$field],$HourlyRatePay);
        		echo "<b>".$field."</b>: ".$val."&nbsp;&nbsp;&nbsp;";

                //insert statement string
                $insert_statement_val_taxable_earnings=$insert_statement_val_taxable_earnings."'".$val."', ";

        		$NetTaxableIncome = $NetTaxableIncome + $val;
        		echo "<b>".$field."</b>: ".$row[$field]."<br>";

        	}
        }

        echo nextline();
        echo "Gross Income w/o deductions: ".$NetTaxableIncome.nextline();

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
        		echo $field.": ".$row[$field]."<br>";

        	}
        }

        echo nextline();
        echo "Total Taxable Deductions: ".$total_deductions.nextline();
        echo "NetTaxableIncome: ".$NetTaxableIncome."<br>";
        echo "<br>";


        //SSS, Pagibig, PhilHealth
        //Based on gross income
        
        //SSS
        //semi monthly EE/2


        //Pagibig
        //divided by 2 for semi monthly

        //PhilHealth
        //divided by 2 for semi monthly




        //***********compute Net Income After Tax
        $sql_taxcode = "SELECT employee_taxcode, cutoff FROM employee WHERE employee_id=$employee_id";
        $result_taxcode =  $conn->query($sql_taxcode);
        if ($result_taxcode->num_rows > 0) {
        		while($row_taxcode = $result_taxcode->fetch_assoc()) {
        			$Taxcode = $row_taxcode['employee_taxcode'];
        			echo 'Taxcode: '.$Taxcode.'<br>';
        			$cutoff=$row_taxcode['cutoff'];
        			echo 'cutoff: '.$cutoff.nextline();;

        			if ($cutoff=='Monthly'){
        				$NetIncomeAfterTax=TaxMonthly($Taxcode, $NetTaxableIncome);
        			}
        			else if($cutoff=='Semi-monthly'){
        				$NetIncomeAfterTax=TaxSemiMonthly($Taxcode, $NetTaxableIncome);
        			}
        		}       		
        }//end of get employee rate

        echo nextline();


        //**************************compute Net pay***********************//

        //***********************add non-taxable income
        //get comp_id
        $sql_addearnings="SELECT earn_max FROM emp_earnings WHERE comp_id=$comp_id";
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
        $sql_deductions="SELECT deduct_max FROM emp_deductions WHERE comp_id=$comp_id";
        $nontaxable_deductions=0;
        $result_deductions=$conn->query($sql_deductions);
        if ($result_deductions->num_rows > 0) {
            while($row_deductions = $result_deductions->fetch_assoc()) {
                $nontaxable_deductions=$nontaxable_deductions+$row_deductions['deduct_max'];
               
            }//end while
        }//end if
        else
            $nontaxable_deductions=0;

         echo "Non-Taxable Deductions: ".$nontaxable_deductions.nextline();

         $net_pay=$net_pay-$nontaxable_deductions;

         //*********net pay
         echo "Net Pay: ".$net_pay.nextline();
         echo "Round off Net Pay to 2 decimals: ".round($net_pay,2).nextline();


         //generate insert statment;
         //$insert_statement_val=substr($insert_statement_val, 0, -2);

         //get net taxable income and non-toxable income
         $insert_statement_val=$insert_statement_val."'".$NetTaxableIncomeWithoutDeductions."', ";
         $insert_statement_val=$insert_statement_val."'".$nontaxable_income."', ";

         //get net taxable deductions and non-toxable deductions
         $insert_statement_val=$insert_statement_val."'".$total_deductions."', ";
         $insert_statement_val=$insert_statement_val."'".$nontaxable_deductions."', ";

         //absent late undertime


         //echo "generated insert earnings statement: ".$insert_statement_val.nextline();
         //echo "generated insert deductions statement: ".$insert_statement_deductions.nextline();

         //$insert_statement_val=$insert_statement_val.")";
         //echo "generated insert OT statement: ".$insert_statement_val_taxable_earnings.nextline().nextline();

         $insert_statement_concat=$insert_statement_val.$insert_statement_deductions.$insert_statement_val_taxable_earnings;

         //insert net pay
         $insert_statement_concat=$insert_statement_concat."'".$net_pay."', ";
         $insert_statement_concat=substr($insert_statement_concat, 0, -2);
         $insert_statement_concat=$insert_statement_concat.")";
         //echo "concatenated insert statement values: ".$insert_statement_concat.nextline();




         //get fields of total_comp_salary
         $into_fields="(";
         $fields_salary=get_fieldnames('total_comp_salary');

         //generate into statement
         foreach ($fields_salary as $field){
            if ($field!='id')
             $into_fields=$into_fields.$field.", ";
         }

         //trim
         $into_fields=substr($into_fields, 0, -2);
         //closing parenthesis
         $into_fields=$into_fields.")";
         //echo "into_fields: ".$into_fields.nextline();

         //echo nextline().nextline();


         //check if comp_id already exists in total_comp_salary. if  yes, update. else insert.
         $comp_id_check=check_comp_id_existence($comp_id); //the value of $comp_id_check will be equal to ID of total_comp_salary if they found an existing entry
                                                           //this is crucial for redbean framework for updating purposes
         if($comp_id_check>0){
            //update_statement($comp_id_check);
         }
         else{
         //call insert function
         insert_statement($into_fields, $insert_statement_concat);
         }

         //echo nextline();

         view_all('total_comp_salary', $comp_id);
    }//end while loop (row per employee on total_comp)
}//end if statement
else {
    //echo "0 results";
}



$conn->close();

}//end function compute()

?>
</body>
</html>