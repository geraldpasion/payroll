<?php 
include("dbconfig.php");
session_start();
$overtimeid = $_POST['otid1'];
$remarks = $_POST['remarks'];
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
if(isset($_POST['approved'])){
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE loan SET loanstatus = 'Approved', loan_remarks = '$remarks', loan_approvedby = '$approvedby' WHERE loanid = '$overtimeid'"))
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
header("Location: loantracer.php?approved");
}
else if(isset($_POST['disapproved'])){
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE loan SET loanstatus = 'Disapproved', loan_remarks = '$remarks', loan_approvedby = '$approvedby' WHERE loanid = '$overtimeid'"))
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
header("Location: loantracer.php?disapproved");

}else if(isset($_POST['process'])){
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE loan SET loanstatus = 'In process', loan_remarks = '$remarks', loan_approvedby = '$approvedby' WHERE loanid = '$overtimeid'"))
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
header("Location: loantracer.php?approved");

}else if(isset($_POST['encash'])){
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE loan SET loanstatus = 'Encashed', loan_remarks = '$remarks', loan_approvedby = '$approvedby' WHERE loanid = '$overtimeid'"))
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
header("Location: loantracer.php?approved");

}




?>