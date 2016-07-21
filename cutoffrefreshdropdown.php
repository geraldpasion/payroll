<?php 
include('dbconfig.php');

if ($result1 = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_status = 'Active'")) //get records from db
	{
		if ($result1->num_rows > 0) //display records if any
		{
			echo '<option value=""> Select Cutoff &nbsp;&nbsp;(Month-Day-Year) </option>';
			while ($row1 = mysqli_fetch_object($result1)){
				$initial = $row1->cutoff_initial;
				$end = $row1->cutoff_end;

				echo '<option value="'.$initial." - ".$end."\">".date("F d, Y",strtotime($initial)).' - ';
				echo date("F d, Y",strtotime($end)).'</option>';

			}
		}
	}
?>