<?php


function compute_other_earnings($comp_id){

include 'dbconfig.php';

	$sql_addearnings="SELECT earn_max FROM emp_earnings WHERE comp_id=$comp_id AND earn_type='Taxable'";
        //initialize $nonttaxable_income
        $taxable_income=0;
        $result_addearnings=$conn->query($sql_addearnings);
        if ($result_addearnings->num_rows > 0) {
            while($row_addernings = $result_addearnings->fetch_assoc()) {
                $taxable_income=$taxable_income+$row_addernings['earn_max'];
               
            }//end while
        }//end if
        else
            $taxable_income=0;

         echo "Other Taxable Earnings: ".$taxable_income.nextline();

        return $taxable_income;

}//end of compute_other_earnings



function compute_other_deductions($comp_id){

include 'dbconfig.php';

//get comp_id
        $sql_deductions="SELECT deduct_max FROM emp_deductions WHERE comp_id=$comp_id AND deduct_type='Taxable'";
        $taxable_deductions=0;
        $result_deductions=$conn->query($sql_deductions);
        if ($result_deductions->num_rows > 0) {
            while($row_deductions = $result_deductions->fetch_assoc()) {
                $taxable_deductions=$taxable_deductions+$row_deductions['deduct_max'];
               
            }//end while
        }//end if
        else
            $taxable_deductions=0;

        echo "Other Taxable Deductions: ".$taxable_deductions.nextline();

        return $taxable_deductions;

}//end compute_other_deductions

?>