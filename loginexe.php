<?php

include('dbconfig.php');
// checking the user

if(isset($_POST['login'])){

$username = mysqli_real_escape_string($mysqli,$_POST['username']);

$password = mysqli_real_escape_string($mysqli,$_POST['password']);

$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";

$run_user = mysqli_query($mysqli, $sel_user);

$check_user = mysqli_num_rows($run_user);



if($check_user>0){
	$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$username'")->fetch_array();
	
	if($result['employee_level'] == '1'){
		session_start();
	if(isset($_SESSION['logsession']))
	{
		unset($_SESSION['logsession']);
	}
		$_SESSION['logsession'] = $result['employee_id'];
		$_SESSION['fname'] = $result['employee_firstname'];
		$_SESSION['mname'] = $result['employee_middlename'];
		$_SESSION['lname'] = $result['employee_lastname'];
		$_SESSION['emptype'] = $result['employee_type'];
		$_SESSION['employee_level'] = $result['employee_level'];
		
		header("location: employeehome.php");
	}else if($result['employee_level'] == '3'){//  level 4
		session_start();
		if(isset($_SESSION['logsession']))
	{
		unset($_SESSION['logsession']);
	}
		$_SESSION['logsession'] = $result['employee_id'];
		$_SESSION['fname'] = $result['employee_firstname'];
		$_SESSION['mname'] = $result['employee_middlename'];
		$_SESSION['lname'] = $result['employee_lastname'];
		$_SESSION['emptype'] = $result['employee_type'];
		$_SESSION['employee_level'] = $result['employee_level'];
		
		header("location: employeehome3.php");

	}else if($result['employee_level'] == '2'){// level 2
			session_start();
		
		if(isset($_SESSION['logsession']))
		{
			unset($_SESSION['logsession']);
		}
			$_SESSION['logsession'] = $result['employee_id'];
			$_SESSION['fname'] = $result['employee_firstname'];
			$_SESSION['mname'] = $result['employee_middlename'];
			$_SESSION['lname'] = $result['employee_lastname'];
			$_SESSION['emptype'] = $result['employee_type'];
			$_SESSION['employee_level'] = $result['employee_level'];
			$_SESSION['employee_team'] = $result['employee_team'];
			
			header("location: employeehome2.php");
	}

}
else {
	header('location:login.php?denied');
}
}

?>