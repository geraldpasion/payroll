<?php 
include("dbconfig.php");
$deduction_id = $_GET['deduction_id'];

	$fetch = $mysqli->query("SELECT * FROM deductions_archive WHERE deduction_id='$deduction_id'")->fetch_object();


	$name = $fetch->deduction_name;
	// delete records to database
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

