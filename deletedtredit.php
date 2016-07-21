<?php

	// connect to the database
	include('dbconfig.php');
	
	// confirm that the 'id' variable has been set
	if (isset($_GET['attendance_id']) && is_numeric($_GET['attendance_id']))
	{
		// get the 'id' variable from the URL
		$attendance_id = $_GET['attendance_id'];
		
		// delete record from database
		if ($stmt = $mysqli->prepare("DELETE FROM logedit WHERE attendance_id = '$attendance_id'"))
		{
			$stmt->bind_param("i",$id);	
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