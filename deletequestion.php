<?php

	// connect to the database
	include('dbconfig.php');
	
	// confirm that the 'id' variable has been set
	if (isset($_GET['question_id1']) && is_numeric($_GET['question_id1']))
	{
		// get the 'id' variable from the URL
		$question_id1 = $_GET['question_id1'];
		
		// delete record from database
		if ($stmt = $mysqli->prepare("DELETE FROM question WHERE qnid = '$question_id1'"))
		{
			$stmt->execute();
			$stmt->close();
		}
		else
		{
			echo "ERROR: could not prepare SQL statement.";
		}
		$mysqli->close();
		
		// redirect user after delete is successful
		header("Location: announcementlist.php");
	}
	else
	// if the 'id' variable isn't set, redirect the user
	{
		header("Location: announcementlist.php");
	}

?>