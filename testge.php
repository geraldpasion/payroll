<?php

//include 'dbconfig.php';


 $dateToday = date("Y-m-d");

 echo $dateToday;

// 	$sql = "SELECT * FROM employee WHERE shift_temp_start>='$dateToday'";
// 	$result = mysqli_query($mysqli,$sql);

// 	while($row = mysqli_fetch_array($result)){
// 		$pending_shift=$row['pending_shift'];

// 		//update
// 		$sql = "UPDATE employee SET employee_shift=$pending_shift, pending_shift=null";

// 			if ($conn->query($sql) === TRUE) {
// 			    //echo $hasdate." Record updated successfully employee ".$empid."<br>";
			    
// 			} else {
// 			    //echo $hasdate." Error updating record employee ".$empid.": " . $conn->error."<br>";
// 			    //header("Location: schedtest.php?error");
// 			}
		
// 	}

?>