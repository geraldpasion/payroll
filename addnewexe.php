<?php
include("dbconfig.php");
if ($_FILES["file"]["error"] > 0){
	echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else{
	if(move_uploaded_file($_FILES["file"]["tmp_name"],"images/" . $_FILES["file"]["name"]))
	{
		$lastname =  ucfirst($_POST['lastname']);
		$firstname =  ucfirst($_POST['firstname']);
		$middlename =  ucfirst($_POST['middlename']);
		$gender = $_POST['gender'];
		$birthday = date("Y-m-d",strtotime($_POST['daterange1']));
		$marital = $_POST['marital'];
		$address =  ucfirst($_POST['address']);
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$emptype =  ucfirst($_POST['shift']);
		$department =  ucfirst($_POST['department']);
		$jobtitle =  ucfirst($_POST['jtitle']);
		$empstatus =  ucfirst($_POST['empstatus']);
		$rate = $_POST['monthly'];
		$taxcode = $_POST['taxcode'];

		$sss = $_POST['sss'];
		$philhealth = $_POST['philhealth'];
		$pagibig = $_POST['pagibig'];
		$tin = $_POST['tin'];
		$pay_method = $_POST['pay_method'];
		$shift = $_POST['shiftstart'];
		$shift = str_replace(' ', '', $shift);
		$shift = substr_replace($shift, '', 5, 1);
		$shift = date("H:i", strtotime($shift));
		$shift2 = $_POST['shiftend'];
		$shift2 = str_replace(' ', '', $shift2);
		$shift2 = substr_replace($shift2, '', 5, 1);
		$shift2 = date("H:i", strtotime($shift2));
		$shift = $shift."-".$shift2;
		$datehired = date("Y-m-d",strtotime($_POST['daterange']));
		$city =  ucfirst($_POST['city']);
		$zip = $_POST['zip'];
		$restday = $_POST['restday']."/".$_POST['restday2'];
		$password = $_POST['password'];
		$access = $_POST['access'];
		$team = $_POST['teamname'];
		$team1 = $_POST['teamname1'];
		$team2 = $_POST['teamname2'];
		$team3 = $_POST['teamname3'];
		$accountnum = $_POST['acctnum'];
		// insert the new record into the database
		if ($stmt = $mysqli->prepare("INSERT INTO employee (employee_lastname, employee_firstname, employee_middlename, employee_gender, employee_birthday, employee_marital,
		employee_address, employee_city, employee_zip, employee_email, employee_cellnum, employee_type, employee_jobtitle, employee_empstatus, employee_department, employee_rate, employee_taxcode,  employee_sss, employee_philhealth, employee_pagibig, employee_tin, cutoff, employee_shift, employee_datehired, employee_restday, employee_password, employee_level, employee_team,employee_team1,employee_team2,employee_team3, image, account_number) 
		VALUES ('$lastname', '$firstname', '$middlename', '$gender', '$birthday', '$marital', '$address', '$city', '$zip', '$email', '$mobile', '$emptype', '$jobtitle', '$empstatus', '$department', '$rate', '$taxcode',  '$sss', '$philhealth', '$pagibig', '$tin', '$pay_method', '$shift', '$datehired', '$restday', '$password', '$access', '$team','$team1','$team2','$team3','".$_FILES['file']['name']."', '$accountnum')"))
		{
			$stmt->execute();
			$stmt->close();
			$resultb = $mysqli->query("SELECT * FROM employee WHERE employee_id = (SELECT MAX(employee_id) FROM employee)")->fetch_array();
			$maxes = $resultb['employee_id'];
			$hired = $resultb['employee_datehired'];

			$sql = $mysqli->query("SELECT MAX(attendance_date) FROM attendance");
			$maxdate = mysqli_fetch_array($sql);
			$mdate = date('Y-m-d',strtotime($maxdate[0]));
			$hired = date('Y-m-d',strtotime($hired));
			$timestamp = date('Y-m-d H:i:s');

			//insert dates automatically to the attendance table in the database
			$mysqli->query("CREATE EVENT hris_event2
					ON SCHEDULE AT CURRENT_TIMESTAMP
					DO
						CALL newEmpLogs('".$hired."', DATE_ADD('".$mdate."',INTERVAL 1 DAY), $maxes)");
		}
		// show an error if the query has an error

						

		header("Location: addnew.php?added");
	}
}
?>