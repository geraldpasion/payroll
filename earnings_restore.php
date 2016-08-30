<?php 
include("dbconfig.php");
$earnings_id = $_GET['announcement_id'];

	$fetch = $mysqli->query("SELECT * FROM earnings_archive WHERE earnings_id='$earnings_id'")->fetch_object();

	$id = $fetch->earnings_id;
	$name = $fetch->earnings_name;
	$amount = $fetch->earnings_max_amount;
	$type = $fetch->earnings_type;
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("INSERT INTO earnings_setting(earnings_id,earnings_name,earnings_max_amount,earnings_type) VALUES ('$id','$name','$amount','$type')"))
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
	if ($stmt = $mysqli->prepare("DELETE from earnings_archive WHERE earnings_id = '$earnings_id'"))
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