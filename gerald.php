<?php


 intialize_timeout_date();
function intialize_timeout_date(){
include 'dbconfig.php';

$sql = "SELECT * FROM attendance WHERE attendance_date<CURDATE()";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

	    	echo "==============================================<br>";
	    	$att_id=$row['attendance_id'];
	    	echo "attendance_id: ".$att_id."<br>";
			$attendance_shift=$row['attendance_shift'];
			echo "attendance_shift: ".$attendance_shift."<br>";
			$attendance_date_from_db=$row['attendance_date'];
			echo "attendance_date: ".$attendance_date_from_db."<br>";
			$daytype=$row['attendance_daytype'];
			echo 'attendance_daytype: '.$daytype."<br>";

			$timein=$row['attendance_timein'];
			$timeout=$row['attendance_timeout'];
			echo 'user timein: '.$timein."<br>";
			echo 'user timeout: '.$timeout."<br>";


				$attendance_date = new DateTime($attendance_date_from_db);
				$attendance_date->format('Y-m-d');
				$attendance_date_string=$attendance_date->format('Y-m-d');
				//get next day from database timein_date
				$next_day = new DateTime($row['timein_date']);
				//$next_day->modify('+1 day');
				$next_day->format('Y-m-d');//$next_day=$attendance_date+1;
				$next_day_string = $next_day->format('Y-m-d');


				if($attendance_date_string==$next_day_string){
						$dbdate = $row['attendance_date'];
				    	$sql_up = "UPDATE attendance SET timeout_date='$dbdate' WHERE attendance_date='$dbdate'";

							if ($conn->query($sql_up) === TRUE) {
							    echo $row['attendance_id']." ".$dbdate.": ";
							    echo "<br>";
							    echo "Record updated successfully timout_date same<br>";

							} else {
							    echo "Error updating record: " . $conn->error;
							}
				}
				else{
					$dbdate = $row['timein_date'];
				    	$sql_up = "UPDATE attendance SET timeout_date='$dbdate' WHERE attendance_date='$dbdate'";

							if ($conn->query($sql_up) === TRUE) {
							    echo $row['attendance_id']." ".$dbdate.": ";
							    echo "<br>";
							    echo "Record updated successfully timout_date next_day<br>";

							} else {
							    echo "Error updating record: " . $conn->error;
							}
				}
			}//end main while
		}//end main if
}//end function


//end php
?>