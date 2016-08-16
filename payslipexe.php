<?php

include('dbconfig.php');

if(isset($_POST['confirm'])){

	$acctnum = mysqli_real_escape_string($mysqli,$_POST['empnum']);
	$password = mysqli_real_escape_string($mysqli,$_POST['payslippassword']);

	$resultquery = "SELECT * FROM employee WHERE employee_id = '$acctnum' AND employee_password = '$password'";
	$run_user = mysqli_query($mysqli, $resultquery);
	$check_user = mysqli_num_rows($run_user);

	if($check_user == 1){
		$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$acctnum'")->fetch_array();
		session_start();
		$_SESSION['acctnum'] = $result['employee_id'];
		header("location: print_payslip.php");
	}
	else{
		header("location:emppayslip.php?denied");
	}
}

?>