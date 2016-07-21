<?php

	// connect to the database
	include('dbconfig.php');
	
	// confirm that the 'id' variable has been set
	if (isset($_GET['coaching_id']) && is_numeric($_GET['coaching_id']))
	{
		// get the 'id' variable from the URL
		$coaching_id = $_GET['coaching_id'];
		
		// delete record from database
		if ($stmt = $mysqli->prepare("DELETE FROM coaching WHERE coaching_id = '$coaching_id'"))
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
		header("Location: inactiveemployeelist.php");
	}
	else
	// if the 'id' variable isn't set, redirect the user
	{
		header("Location: inactiveemployeelist.php");
	}

?>