<?php 
include("dbconfig.php");
$earnings_id = $_GET['announcement_id'];

	$fetch = $mysqli->query("SELECT * FROM earnings_archive WHERE earnings_id='$earnings_id'")->fetch_object();


	$name = $fetch->deduction_name;
	// delete records to database
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

