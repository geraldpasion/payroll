<?php 
include("dbconfig.php");
$deduction_id = $_GET['deduction_id'];
	$fetch = $mysqli->query("SELECT * FROM deductions_archive WHERE deduction_id='$deduction_id'")->fetch_object();

	$id = $fetch->deduction_id;
	$name = $fetch->deduction_name;
	$amount = $fetch->deduction_max_amount;
	$type = $fetch->deduction_type;
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("INSERT INTO deduction_settings(deduction_id,deduction_name,deduction_type,deduction_max_amount) VALUES ('$id','$name','$type','$amount')"))
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
	if ($stmt = $mysqli->prepare("DELETE from deductions_archive WHERE deduction_id = '$deduction_id'"))
	{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}

	if (mysqli_query($conn, $sql)) {
    header("Location: archive.php");
	} else {
    header("Location: archive.php");
	}

?>

<!-- delete FROM `earnings_setting` WHERE earnings_id= 4; -->