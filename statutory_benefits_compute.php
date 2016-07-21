<?php
//Author: Gerald Dominic DM Pasion


//statutory benefits functions
//SSS
function sss_compute($NetTaxableIncome){

include 'dbconfig.php';

echo "x: ".$NetTaxableIncome.nextline();

    $sql = "SELECT * FROM sss_contribution WHERE Range_Of_Compensation_From<=$NetTaxableIncome AND Range_Of_Compensation_To>=$NetTaxableIncome";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                $ee=$row['Social_Security_EE'];
                echo 'Social_Security_EE: '.$ee.nextline();
                return $ee;
            }//end while
    }//end if
    else {
        echo "0 results from sss_contribution".nextline();
        return 0;
    }   

   // return $ee;

}

//PAGIBIG
function pagibig_compute($NetTaxableIncome){
	$pagibig_val=$NetTaxableIncome*.02;
	return $pagibig_val;

}

//PhilHealth
function philhealth_compute($NetTaxableIncome){

include 'dbconfig.php';

//echo "x: ".$NetTaxableIncome.nextline();

    $sql = "SELECT * FROM philhealth_contribution WHERE Salary_RangeFrom<=$NetTaxableIncome AND Salary_Range_To>=$NetTaxableIncome";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                $ee=$row['Employee_Share'];
                //echo 'PhilHealth Employee_Share: '.$ee.nextline();
                return $ee;
            }//end while
    }//end if
    else {
        echo "0 results from philhealth_contribution".nextline();
        return 0;
    }   

   // return $ee;



}

?>