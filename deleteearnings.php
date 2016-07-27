<?php 
include("dbconfig.php");
$earnings_id = $_POST['earnings_id1'];
$type = $_POST['type'];

if($type=='setting'){
	$fetch = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_id='$earnings_id'")->fetch_object();

	$id = $fetch->earnings_id;
	$name = $fetch->earnings_name;
	$amount = $fetch->earnings_max_amount;
	$type = $fetch->earnings_type;
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("INSERT INTO earnings_archive(earnings_id,earnings_name,earnings_max_amount,earnings_type) VALUES ('$id','$name','$amount','$type')"))
		{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
	//delete records in database
	if ($stmt = $mysqli->prepare("DELETE from earnings_setting WHERE earnings_id = '$earnings_id'"))
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
	if ($stmt = $mysqli->prepare("DELETE from emp_earnings WHERE earn_id = '$earnings_id'"))
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

<!-- delete FROM `earnings_setting` WHERE earnings_id= 4; -->