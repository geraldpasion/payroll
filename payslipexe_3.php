<?php

include('dbconfig.php');

if(isset($_POST['confirm'])){
//$username = mysqli_real_escape_string($mysqli,$_POST['acctusername']);
session_start();
	$log = $_SESSION['logsession'];
	$initialcutha=$_SESSION['initialcutS'];
	$endcutha=$_SESSION['endcutS'];
	$compidha=$_SESSION['compidS'];


$password = mysqli_real_escape_string($mysqli,$_POST['payslippassword']);

$sel_user = "SELECT * from employee where employee_id='$log' AND employee_payslippassword='$password' AND employee_status = 'active'";

$run_user = mysqli_query($mysqli, $sel_user);

$check_user = mysqli_num_rows($run_user);



if($check_user>0){
	$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$log'")->fetch_array();
	
	$empid=$result['employee_id'];
	$pass=$result['employee_payslippassword'];


	if($result['employee_id']==$log AND $result['employee_payslippassword']==$password){

		// header("location:print_payslip.php?initial=".$initialcutha."&end=".$endcutha."&id=".$empid."&compid=".$compidha."");
		 //echo"<script>window.open('print_payslip.php?initial=$initialcutha&end=$endcutha&id=$empid&compid=$compidha', '_blank')</script>";
		echo "<script>window.location='print_payslip.php?initial=$initialcutha&end=$endcutha&id=$empid&compid=$compidha';</script>";
		echo "hello";
		//header("location:emppayslip.php?invalid");
	}
	
	}
	else if($result['employee_payslippassword']!=$password){
//	echo"<script>alert('invalid input');</script>";
	header("location:emppayslip_3.php?invalid");
	}

	//echo "<script>window.open('http://www.w3schools.com');</script>";
	

}
else {
	
}




?>