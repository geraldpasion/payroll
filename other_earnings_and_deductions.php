<?php


function compute_other_earnings($comp_id, $employee_id=0){

include 'dbconfig.php';

    //initial_date -> end_date
    //if initial_date is within cutoff - accept
    //if initial_date is no within cutoff, check end_date. if end_date is within cutoff - accept

    //get cutoff range
    $sql="SELECT cutoff FROM total_comp WHERE comp_id='$comp_id'";
    $result = $conn ->query($sql);
    if($result->num_rows > 0){
        while($row=$result->fetch_assoc()){
            $cutoff=$row['cutoff'];
            echo "Cutoff emp_earnings: ".$cutoff.nextline();
            break;
        }
    }

    $cutoff_array=cutoff_parse($cutoff);

    echo "start: ".$cutoff_array[0].nextline();
    echo "end: ".$cutoff_array[1].nextline();
    $start = $cutoff_array[0];
    $end = $cutoff_array[1];

    $start = strtotime($start);
    $end = strtotime($end);

    //echo "sdate: ".$start.nextline();
   // echo "edate: ".$end.doubleline();

    //compare date
    $sql_addearnings="SELECT * FROM emp_earnings WHERE earn_type='Taxable' 
    AND employee_id='$employee_id'";

        //initialize $nonttaxable_income
        $taxable_income=0;
        $result_addearnings=$conn->query($sql_addearnings);
        if ($result_addearnings->num_rows > 0) {
            while($row_addearnings = $result_addearnings->fetch_assoc()) {

                //echo 'earnings: '.$row_addernings['earn_max'].nextline();

                echo "<u>taxable_income list:</u> ".$row_addearnings['earn_max'].
                " | ".$row_addearnings['earn_type'].
                " | ".$row_addearnings['earn_name'].
                " | ".$row_addearnings['initial_date'].
                " | ".$row_addearnings['end_date'].nextline();
               
                //compare dates here
                $dbstart = strtotime($row_addearnings['initial_date']);
                $dbend = strtotime($row_addearnings['end_date']);

                //echo "dbstart: ".$dbstart.nextline();
                //echo "dbend: ".$dbend.nextline();

//                $zerodate = '0000-00-00';
              //  $zerodate = new DateTime($zerodate);

                if ($dbend == null){
                    echo "zeroooooooooooo!".nextline();
                }


                if (($start<=$dbstart && $end>=$dbstart) || ($start<=$dbend && $end>=$dbend) || ($dbstart<=$start && $dbend==null) ){

                $taxable_income=$taxable_income+$row_addearnings['earn_max'];
                echo "taxable_income include: ".$row_addearnings['earn_max'].
                " ".$row_addearnings['earn_type'].
                " ".$row_addearnings['earn_name'].
                " ".$row_addearnings['initial_date'].
                " ".$row_addearnings['end_date'].doubleline();
               }
            }//end while
        }//end if
        else
            $taxable_income=0;

         //echo "Other Taxable Earnings: ".$taxable_income.nextline();

        return $taxable_income;

}//end of compute_other_earnings





function compute_other_deductions($comp_id){

include 'dbconfig.php';


//initial_date -> end_date
    //if initial_date is within cutoff - accept
    //if initial_date is no within cutoff, check end_date. if end_date is within cutoff - accept

    //get cutoff range
    $sql="SELECT cutoff FROM total_comp WHERE comp_id='$comp_id'";
    $result = $conn ->query($sql);
    if($result->num_rows > 0){
        while($row=$result->fetch_assoc()){
            $cutoff=$row['cutoff'];
            echo "Cutoff emp_deductions: ".$cutoff.nextline();
            break;
        }
    }


    $cutoff_array=cutoff_parse($cutoff);

    echo "start: ".$cutoff_array[0].nextline();
    echo "end: ".$cutoff_array[1].nextline();
    $start = $cutoff_array[0];
    $end = $cutoff_array[1];

    //$start = strtotime($start);
    //$end = strtotime($end);

    //echo "sdate: ".$start.nextline();
    //echo "edate: ".$end.nextline();

//get comp_id
        //$sql_deductions="SELECT deduct_max FROM emp_deductions WHERE comp_id=$comp_id AND deduct_type='Taxable'";
        $sql_deductions ="SELECT * FROM emp_deductions WHERE (initial_date>='$start' OR end_date<='$end') AND deduct_type='Taxable' ";
        $taxable_deductions=0;
        $result_deductions=$conn->query($sql_deductions);
        if ($result_deductions->num_rows > 0) {
            while($row_deductions = $result_deductions->fetch_assoc()) {
                


                 //compare dates here
                $dbstart = strtotime($row_deductions['initial_date']);
                $dbend = strtotime($row_deductions['end_date']);

                 echo "taxable_deductions list: ".$row_deductions['deduct_max'].
                " ".$row_deductions['deduct_type'].
                " ".$row_deductions['deduct_name'].
                " ".$row_deductions['initial_date'].
                " ".$row_deductions['end_date'].nextline();

                if (($start<=$dbstart && $end>=$dbstart) || ($start<=$dbend && $end>=$dbend) || ($start<=$dbend && $end=='0000-00-00') ){

                    $taxable_deductions=$taxable_deductions+$row_deductions['deduct_max'];
                 echo "taxable_deductions: ".$row_deductions['deduct_max'].
                " ".$row_deductions['deduct_type'].
                " ".$row_deductions['deduct_name'].
                " ".$row_deductions['initial_date'].
                " ".$row_deductions['end_date'].nextline();
               }
            }//end while
        }//end if
        else
            $taxable_deductions=0;

        //echo "Other Taxable Deductions: ".$taxable_deductions.nextline();

        return $taxable_deductions;

}//end compute_other_deductions

?>