<?php 
include('dbconfig.php');

if ($result1 = $mysqli->query("SELECT * FROM earnings_settings")) //get records from db
	{
		if ($result1->num_rows > 0) //display records if any
		{
			echo '<option value=""> Select Earning </option>';
			while ($row1 = mysqli_fetch_object($result1)){
				
				echo '<option value="'.$row1->earnings_name.'">'.$row1->earnings_name.'</option>';;

			}
		}
	}

?>
