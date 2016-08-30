<?php

$dateToday = date("Y-m-d");


	$sql = "SELECT * FROM employee WHERE shift_temp_start='$dateToday'";
	$result = $conn->query($sql);
         if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
			$pending_shift=$row['pending_shift'];

			//update
			$sql_update = "UPDATE employee SET employee_shift=$pending_shift, pending_shift=null, shift_temp_start=null, shift_temp_end=null,
			employee_shift_temp=null";

				if ($conn->query($sql_update) === TRUE) {
				    //echo $hasdate." Record updated successfully employee ".$empid."<br>";
				    echo "success!";
				    
				} 
				else {
					header("Location: testge2.php");
				    //echo $hasdate." Error updating record employee ".$empid.": " . $conn->error."<br>";
				    //header("Location: schedtest.php?error");
				}
			
			}
}//end if
else
{
	header("Location: testge.php");
}

?>