<?php 
include("dbconfig.php");
$employeeid = $_POST['employeeid'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$gender = $_POST['gender'];
$birthday = date("Y-m-d",strtotime($_POST['daterange']));
$marital = $_POST['marital'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$type = $_POST['type'];
$department = $_POST['department'];
$rate = $_POST['rate'];
$taxcode = $_POST['taxcode'];
$philhealth = $_POST['philhealth'];
$hdmf = $_POST['pagibig'];
$tin = $_POST['tin'];
$sss = $_POST['sss'];
$shift = $_POST['shift'];
$restday = $_POST['restday'];
$datehired = date("Y-m-d",strtotime($_POST['daterange2']));
$jobtitle = $_POST['jobtitle'];
$password = $_POST['password'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE employee SET employee_lastname = '$lastname', employee_firstname = '$firstname', employee_middlename = '$middlename', employee_gender = '$gender', employee_birthday = '$birthday', employee_marital = '$marital', employee_address = '$address', employee_city = '$city', employee_zip = '$zip', employee_email = '$email', employee_cellnum = '$mobile', employee_type = '$type', employee_jobtitle = '$jobtitle', employee_department = '$department', employee_rate = '$rate', employee_taxcode = '$taxcode', employee_sss = '$sss', employee_philhealth = '$philhealth', employee_pagibig = '$hdmf', employee_tin = '$tin', employee_shift = '$shift', employee_datehired = '$datehired', employee_restday = '$restday',employee_password = '$password' WHERE employee_id = '$employeeid'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: payrolllist.php?edited");
?>