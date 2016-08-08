<?php
//Author: Gerald Dominic DM Pasion


//statutory benefits functions
//SSS
function sss_compute($NetTaxableIncome){

include 'dbconfig.php';

echo "x: ".$NetTaxableIncome.nextline();

//prepare an array to return all details of sss matched
$sss_details = array();

    $sql = "SELECT * FROM sss_contribution WHERE Range_Of_Compensation_From<=$NetTaxableIncome AND Range_Of_Compensation_To>=$NetTaxableIncome";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                $ee=$row['Social_Security_EE'];
                echo 'Social_Security_EE: '.$ee.nextline();
                //return $ee;

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
                    $sss_details[]=$row['SSS_ID']; //0
                    $sss_details[]=$row['Range_Of_Compensation_From']; //1
                    $sss_details[]=$row['Range_Of_Compensation_To']; //2
                    $sss_details[]=$row['Monthly_Salary_Credit']; //3
                    $sss_details[]=$row['Social_Security_ER']; //4
                    $sss_details[]=$row['Social_Security_EE']; //5
                    $sss_details[]=$row['Social_Security_Total']; //6
                    $sss_details[]=$row['ECER']; //7
                    $sss_details[]=$row['Total_Contribution_ER']; //8
                    $sss_details[]=$row['Total_Contribution_EE']; //9
                    $sss_details[]=$row['Total_Contribution_Total']; //10
                    $sss_details[]=$row['SEVMOFW']; //11

                return $sss_details;


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
	
    include 'dbconfig.php';

    $sql = "SELECT * FROM pagibig WHERE hdmf_compensation<=$NetTaxableIncome AND hdmf_compensation_from>=$NetTaxableIncome";

    $pagibig_details = array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                $ee=$row['hdmf_employee'];
                //echo 'PhilHealth Employee_Share: '.$ee.nextline();
                //return $ee;

                $pagibig_details[]=$row['hdmf_id']; //0
                
                $pagibig_details[]=$row['hdmf_compensation']; //1
                $pagibig_details[]=$row['hdmf_compensation_from']; //2
                $pagibig_details[]=$NetTaxableIncome*$row['hdmf_employer']/100; //3
                $pagibig_details[]=$NetTaxableIncome*$row['hdmf_employee']/100; //4
                
               
                return $pagibig_details;


            }//end while
    }//end if
    else {
        echo "0 results frompagibig".nextline();
        return 0;
    }   

    //$pagibig_val=$NetTaxableIncome*.02;
	//return $pagibig_val;

}

//PhilHealth
function philhealth_compute($NetTaxableIncome){

include 'dbconfig.php';

//echo "x: ".$NetTaxableIncome.nextline();

    $sql = "SELECT * FROM philhealth_contribution WHERE Salary_RangeFrom<=$NetTaxableIncome AND Salary_Range_To>=$NetTaxableIncome";
    $philhealth_details = array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                $ee=$row['Employee_Share'];
                //echo 'PhilHealth Employee_Share: '.$ee.nextline();
                //return $ee;

                $philhealth_details[]=$row['PhilHealth_ID']; //0
                
                $philhealth_details[]=$row['Salary_Bracket']; //1
                $philhealth_details[]=$row['Salary_RangeFrom']; //2
                $philhealth_details[]=$row['Salary_Range_To']; //3
                $philhealth_details[]=$row['Salary_Base']; //4
                $philhealth_details[]=$row['Total_Monthly_Contribution']; //5
                $philhealth_details[]=$row['Employer_Share']; //6
                $philhealth_details[]=$row['Employee_Share']; //7

                return $philhealth_details;


            }//end while
    }//end if
    else {
        echo "0 results from philhealth_contribution".nextline();
        return 0;
    }   

   // return $ee;



}

?>