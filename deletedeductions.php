<?php 
include("dbconfig.php");
$deduction_id = $_POST['deduction_id1'];
$type = $_POST['type'];

if($type=='setting'){
	$fetch = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_id='$deduction_id'")->fetch_object();

	$id = $fetch->deduction_id;
	$name = $fetch->deduction_name;
	$type = $fetch->deduction_type;
	$amount = $fetch->deduction_max_amount;
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("INSERT INTO deductions_archive(deduction_id,deduction_name,deduction_type,deduction_max_amount) VALUES ('$id','$name','$type','$amount')"))
		{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
	// delete records to database
	if ($stmt = $mysqli->prepare("DELETE from deduction_settings WHERE deduction_id = '$deduction_id'"))
	{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
}

if($type == 'process'){
	if ($stmt = $mysqli->prepare("DELETE from emp_deductions WHERE deduct_id = '$deduction_id'"))
	{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
}


?>

