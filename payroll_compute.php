<?php
/**********************************
Author: Gerald Dominic DM Pasion
email: gerald.pasion@gmail.com
***********************************/
?>


<html>
<body>
<?php

//require 'rb.php';



   /*R::setup( 'mysql:host=localhost;dbname=payroll','root', '' ); //for both mysql or maria

   $post = R::dispense('totalcomputation');

   $post -> EmployeeID = 1;
   $post -> CutoffID = 1;
	
   $id = R::store($post);
   echo "id: ".$id."<endl>";


   $display = R::load('totalcomputation', $id);
   echo $display;
   $display -> EmployeeID = 2;
   R::store($display);

   R::close();
*/

   $functionnames=array(

   	//'HourlyRate',

   'Regular',
   	'RegularOverTime',

   	'NightDiff',
   	'RegularOTNightDiff',

	'RestDay',
	'RestDayOT',

	'RestDayNightDiff',
	'RestDayNightDiffOT',

	'LegalHoliday',
	'LegalHolidayOT',

	'LegalHolidayNightDiff',
	'LegalHolidayNightDiffOT',

	'SpecialHoliday',
	'SpecialHolidayOT',

	'SpecialHolidayND',
	'SpecialHolidayNDOT',

	'RestDayLegalHoliday',
	'RestDayLegalHolidayOT',

	'RestDayLegalHolidayND',
	'RestDayLegalHolidayNDOT',


	'RestDaySpecialHoliday',
	'RestDaySpecialHolidayOT',

	'RestDaySpecialHolidayND',
	'RestDaySpecialHolidayNDOT'

   	); //end array of function names



//echo $shop[]

//***************some static values for checking***************//
   //get base salary, depending on cutoff
   $BaseSalary=10000;

   //get Payroll Factor
   $PayrollFactor=261;

   //get pay per hour
   //$HourlyRatePay=HourlyRate($BaseSalary, $PayrollFactor);
   $HourlyRatePay = 12.5;
   //get hours attended
   $HoursAttended=2;
   //$func = $functionnames[1];
   //echo $func.": ".$func($HoursAttended, $HourlyRatePay);



   /*for checking output
   foreach ($functionnames as $funct){
   	
   	//output label
   	echo $funct.": ";
   	//output result
   	echo $funct($HoursAttended, $HourlyRatePay)."<br>";


   }
   */


   //******************functions/formula section***********************//
   //NOte: It is ideal to make the function names same as field names of total_comp table for ease of programming using $func() syntax
   //where $func is a variable for of function name. this saves coding time.

  function HourlyRate($BaseSalary, $PayrollFactor){

  	$HourlyRatePay=$BaseSalary*12/$PayrollFactor/8;

  	return $HourlyRatePay;

  }

  function MinutesRate($HourlyRatePay){

      $MinutesRatePay = $HourlyRatePay/60;

      return $MinutesRatePay;
  }

  function reg_hrs($HoursAttended, $HourlyRatePay){
  	
  	$RegularPay=$HoursAttended*$HourlyRatePay;

  	return $RegularPay;
  }

  function reg_ot($HoursOT, $HourlyRatePay){

  	$OTPay=$HoursOT*$HourlyRatePay*1.25; //125%
 
  	return $OTPay;
  }

  function reg_nd($HoursAttended, $HourlyRatePay){
  	
  	//additional 10% for night dif
  	$NightDiffPay=$HoursAttended*$HourlyRatePay*0.1;

  	return $NightDiffPay;
  }

  function reg_ot_nd($HoursOT, $HourlyRatePay){

  	$RegularOTNDPay= $HoursOT*$HourlyRatePay*1.35;

  	return $RegularOTNDPay;
  }

  function rst_ot($HoursAttended, $HourlyRatePay){

  	$RDPay = $HoursAttended*$HourlyRatePay*1.3;

  	return $RDPay;
  }

  //more than 8 hours on regular RD
  function rst_ot_grt8($HoursOT, $HourlyRatePay){

  	$RDOTPay = $HoursOT*$HourlyRatePay*1.6;

  	return $RDOTPay;
  }

  function rst_nd($HoursAttended, $HourlyRatePay){

  	$RDNDPay = $HoursAttended*$HourlyRatePay*1.4;

  	return $RDNDPay;
  }


//*****************************************************note this
  function rst_nd_grt8($HoursAttended, $HourlyRatePay){

  	$RDNDPayOT = $HoursAttended*$HourlyRatePay*1.7;

  	return $RDNDPayOT;
  }
//***********************************************

  function lh_ot($HoursAttended, $HourlyRatePay){

  	$LegalHolidayPay = $HoursAttended * $HourlyRatePay * 1; //200%

  	return $LegalHolidayPay;

  }

  function lh_ot_grt8($HoursOT, $HourlyRatePay){

  	$LHOTPay = $HoursOT*$HourlyRatePay*2.6; //100% regular, 100% LH, 130% OT 

  	return $LHOTPay;
  
  }


  function lh_nd($HoursAttended, $HourlyRatePay){

  	$LegalHolidayNDPay = $HoursAttended * $HourlyRatePay * 1.1; //200%

  	return $LegalHolidayNDPay;

  }

   function lh_nd_grt8($HoursOT, $HourlyRatePay){

  	$LegalHolidayNDOTPay = $HoursOT * $HourlyRatePay * 2.86; //200%

  	return $LegalHolidayNDOTPay;

  }

  function sh_ot($HoursAttended, $HourlyRatePay){

  	$SHPay =  $HoursAttended * $HourlyRatePay * 0.3;

  	return $SHPay;

  }

  function sh_ot_grt8($HoursOT, $HourlyRatePay){

  	$SHPayOT =  $HoursOT * $HourlyRatePay * 1.69;

  	return $SHPayOT;

  }

  function sh_nd($HoursAttended, $HourlyRatePay){

  	//1.53xy - simplified formula
  	$SHNDPay =  ($HoursAttended * $HourlyRatePay)* 0.43;

  	return $SHNDPay;

  }

  function sh_nd_grt8($HoursOT, $HourlyRatePay){

  	//2.53xy - simplified formula
  	$SHNDOTPay =  ($HoursOT * $HourlyRatePay) * 1.86;

  	return $SHNDOTPay;

  }

  function rst_lh_ot($HoursAttended, $HourlyRatePay){
  	$RDLHPay = reg_hrs($HoursAttended, $HourlyRatePay) * 2.6;
  	return $RDLHPay;
  }

//same computation above
function rst_lh_ot_grt8($HoursOT, $HourlyRatePay){
   	$RDLHOTPay = reg_hrs($HoursOT, $HourlyRatePay) * 3.38;
    return $RDLHOTPay;
   }

//same computation above * 110%
function rst_lh_nd($HoursAttended, $HourlyRatePay){
  	$RDLHOTNDPay = reg_hrs($HoursAttended, $HourlyRatePay) * 2.86;
   	return $RDLHOTNDPay;
  }

 //same computation above * 110%
function rst_lh_nd_grt8($HoursAttended, $HourlyRatePay){
  	$RDLHOTNDOTPay =reg_hrs($HoursAttended, $HourlyRatePay)*2.7; //with * 110%;
   	return $RDLHOTNDOTPay;
  }




 function rst_sh_ot($HoursAttended, $HourlyRatePay){
 	$RDSHPay = reg_hrs($HoursAttended, $HourlyRatePay) * 1.5; //150%
 	return $RDSHPay;
 }

 function rst_sh_ot_grt8($HoursAttended, $HourlyRatePay){
 	$RDSHOTPay = reg_hrs($HoursAttended, $HourlyRatePay) * 1.95; //150%
 	return $RDSHOTPay;
 }

//RD SH night differential
function rst_sh_nd($HoursAttended, $HourlyRatePay){
 	$RDSHNDPay = reg_hrs($HoursAttended, $HourlyRatePay) * 1.65; //150% SH, 110% ND
 	return $RDSHNDPay;
 }

 function rst_sh_nd_grt8($HoursAttended, $HourlyRatePay){
 	$RDSHNDOTPay = reg_hrs($HoursAttended, $HourlyRatePay) * 2.145; //150% SH, 110% ND
 	return $RDSHNDOTPay;
 }

 function leave_hrs($HoursAttended, $HourlyRatePay){
  $leave_salary = reg_hrs($HoursAttended, $HourlyRatePay);
  return $leave_salary;
 }


//*********************compute deductions
function absent($HoursAttended, $HourlyRatePay, $employee_id, $comp_id){
include 'dbconfig.php';

//get shift from employee
$table='employee';
$sql = "SELECT employee_shift FROM $table WHERE employee_id=$employee_id";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {

     // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo "absent employee_id: ".$employee_id."<br>";
     // echo "shift: ".$row['employee_shift']."<br><br>";

      //get timein and timeout
     /* $shift_string = $row['employee_shift'];
      $timein=substr($shift_string, 0, -6);
      $timeout=substr($shift_string, 6);
      echo "timein: ".$timein.nextline();
      echo "timeout: ".$timeout.nextline();

      //get total hours per day
      $totaltime_per_day=computeHours($timein, $timeout).nextline();

      //convert string to double
      $totaltime_per_day=(double)$totaltime_per_day;

      //if greater than 4, -1 for lunch break
      if($totaltime_per_day>4){
        $totaltime_per_day--;
      }

      echo "total hours per day: ".$totaltime_per_day.nextline();*/
      $totaltime_per_day=dailyhours($employee_id);
      echo "rate per hour: ".$HourlyRatePay.nextline();

      //get value of absent from total_comp, $comp_id is needed
      //hours per day x total days absent = absent total hours
      $total_absent_hours=total_absent_hours($totaltime_per_day, $comp_id);
      echo "total time absent (hours): ".$total_absent_hours.nextline();

      //compute absent rate;
      $absent_deduct=reg_hrs($total_absent_hours, $HourlyRatePay);
      //echo "absent deduction (peso): ".$absent_deduct.nextline();

      return $absent_deduct;

      break;

    }//end while loop

  }
  else {
    echo "0 results";
  }//end else



}//end function

function dailyhours($employee_id){
  include 'dbconfig.php';

  $table='employee';
$sql = "SELECT employee_shift FROM $table WHERE employee_id=$employee_id";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {

     // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo "absent employee_id: ".$employee_id."<br>";
      echo "shift: ".$row['employee_shift']."<br><br>";

      //get timein and timeout
      $shift_string = $row['employee_shift'];
      $timein=substr($shift_string, 0, -6);
      $timeout=substr($shift_string, 6);
      echo "timein: ".$timein.nextline();
      echo "timeout: ".$timeout.nextline();

   //get total hours per day
      $totaltime_per_day=computeHours($timein, $timeout).nextline();

      //convert string to double
      $totaltime_per_day=(double)$totaltime_per_day;

      //if greater than 4, -1 for lunch break
      if($totaltime_per_day>4){
        $totaltime_per_day--;
      }

      echo "total hours per day: ".$totaltime_per_day.nextline();

      return $totaltime_per_day;
    }

}
}//end function

function late($late_mins, $HourlyRatePay){

//get rate per minute based on hourly rate
$MinsRate = MinutesRate($HourlyRatePay);
echo "Rate per minute: ".$MinsRate.nextline();

echo "late (min): ".$late_mins.nextline();

$total_late_deduction = $late_mins * $MinsRate;  
echo "Total late deduction: ".$total_late_deduction.nextline();;

return $total_late_deduction;
}

//same computation with late
function undertime($undertime_mins, $HourlyRatePay){

$MinsRate = MinutesRate($HourlyRatePay);
//echo "Rate per minute: ".$MinsRate.nextline();

echo "undertime (min): ".$undertime_mins.nextline();

$total_undertime_deduction = $undertime_mins * $MinsRate;  
echo "Total undertime deduction: ".$total_undertime_deduction.nextline();;

return $total_undertime_deduction;
  
}

function total_absent_hours($totaltime_per_day, $comp_id){

  include 'dbconfig.php';

  $table='total_comp';
$sql = "SELECT absent FROM $table WHERE comp_id=$comp_id";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {

     // output data of each row
    while($row = $result->fetch_assoc()) {
      $absent_days=$row['absent'];
      echo "absent days from total_comp: ".$absent_days.nextline();

      $absent_hours=$absent_days*$totaltime_per_day;
      return $absent_hours;
    }//end while loop
  }
  else {
    echo "0 results";
  }//end else


}


//*********************compute for taxes
function NetIncomeAfterTax($NetTaxableIncome,$TaxCode,$PaymentSchedule){

  if ($PaymentSchedule=='Semi-Monthly'){
    TaxSemiMonthly($TaxCode, $NetTaxableIncome);
  }
 

}

//compute hours
function computeHours($timein, $timeout) {
    $timeinArray = array();
    $timeinArray = split(":", $timein);
    $timeinArrayMin = sprintf("%.2f", $timeinArray[1]/60);
    $timeinArrayDec = sprintf("%.2f", $timeinArray[0] + $timeinArrayMin);
    $newRegHrs = date("H:i", (strtotime($timeout) - 60*60*$timeinArrayDec));
    //$newRegHrs = date("H:i", (strtotime($timeout) - strtotime($timein)));
    $newRegHrsArray = array();
    $newRegHrsArray = split(":", $newRegHrs);
    $newRegHrsArrayMin = sprintf("%.2f", $newRegHrsArray[1]/60);
    $newRegHrsArrayDec = sprintf("%.2f", $newRegHrsArray[0] + $newRegHrsArrayMin);
    return $newRegHrsArrayDec;
  }

//compute total retro
function retro_compute($employee_id, $comp_id){
  include 'dbconfig.php';
 
$sql = "SELECT * FROM others WHERE employee_id=$employee_id AND others_status='not paid' AND comp_id=0 AND app_status='Approved'";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {

    //initialize retro
    $retro_total=0;

     // output data of each row
    while($row = $result->fetch_assoc()) {
      $retro_value=$row['others_retro'];
      $retro_total=$retro_total+$retro_value;
      echo "Retro: ".$retro_value.nextline();
    }

    //reset for testing purposes
    /*$sql = "UPDATE others SET others_status='not paid', comp_id=0";

          if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
          } else {
              echo "Error updating record: " . $conn->error;
          }
    */
    return $retro_total;
  }
  else{
    return 0;
  }


}//end retro

function update_retro($comp_id, $employee_id){

  include 'dbconfig.php';

   //update retro //do this after processing
    $sql = "UPDATE others SET others_status='paid', comp_id=$comp_id WHERE employee_id=$employee_id AND others_status='not paid' AND comp_id=0 AND app_status='Approved'";

          if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
          } else {
              echo "Error updating record: " . $conn->error;
          }

}

//for adding non-taxable/non-taxable earnings/dedutions DURING processing
function recompute_others(){

 //check comp_id from emp_earnings where employee_id
 //if comp_id==0, meaning it hasn't been processed yet. add it to TotalTaxableEarnings at totalcomputation table
  

}

//load tax table


include 'taxtableSemiMonthly.php';
include 'taxtableMonthly.php';



//end php  
?>

</body>
</html>