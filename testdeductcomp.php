<?php

/*include 'dbconfig.php';

//from db
$attendance_shift = '22:00-07:00';
$attendance_date_from_db = '2016-03-13'; //date
$attendance_date = new DateTime($attendance_date_from_db);
$attendance_date->format('Y-m-d');

$next_day = new DateTime($attendance_date_from_db);
$next_day->modify('+1 day');
$next_day->format('Y-m-d');//$next_day=$attendance_date+1;

//user input
$employee_id = '55'; //varchar
$timein = '01:00';
$timeout = '07:00';
*/

// //echo 'attendance_date: '.$attendance_date->format('Y-m-d')."<br>";
// //echo 'next_day: '.$next_day->format('Y-m-d')."<br>";

// for testing purposes
$string1 = '2016-07-06';
$string2 = '2016-07-06';
$empid = 141;

recompute_attendance_details($string1, $string2, $empid);

function recompute_attendance_details($string1, $string2, $empid){

include 'dbconfig.php';

$sql = "SELECT * FROM attendance WHERE attendance_date BETWEEN '$string1' AND '$string2' AND employee_id = '$empid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
			//initialize
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

			if($timein!=""){
				//$nd_start = $attendance_date." 22:00";
				//$nd_end	= $next_day." 6:00";
				
				//date configurations
				//$attendance_shift = '22:00-07:00';
				//$attendance_date_from_db = '2016-03-13'; //date
				$attendance_date = new DateTime($attendance_date_from_db);
				$attendance_date->format('Y-m-d');
				$attendance_date_string=$attendance_date->format('Y-m-d');
				//get next day from database timein_date
				$next_day = new DateTime($row['timein_date']);
				//$next_day->modify('+1 day');
				$next_day->format('Y-m-d');//$next_day=$attendance_date+1;
				$next_day_string = $next_day->format('Y-m-d');

				if($row['timeout_date']==0)
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
				
				$timein_date = $row['timein_date']; //check if what date he/she timed in
				echo "timein_date: ".$timein_date."<br>";
				$timeout_date = $row['timeout_date']; //check if what date he/she timed in
				echo "timeout_date: ".$timeout_date."<br>";


				$timein = $timein_date." ".$timein;
				$timeout = $timeout_date." ".$timeout;
				echo "<br>";

				//user
				$timein_conv = strtotime($timein);
				$timeout_conv = strtotime($timeout);

				echo "yyyyy: ".$timein_conv."<br>";
				echo "xxxxx: ".$timeout_conv."<br>"; 
				//check if timein_conv is bigger than timeout_conv, if so.. apply next_day to timeout;
				//this case applies usually for nigh differentail issue where timeout is less then timein due to next day clock cycle
				if($timein_conv>$timeout_conv){
					echo $next_day_string."<br>";
					$timeout_conv=strtotime($next_day->format('Y-m-d')." ".$timeout);
				}

				//user
				$usertimein= new DateTime($timein); //varchar
				$usertimeout= new DateTime($timeout); //varchar


				//compute for attendance_hours, attendance_late, attendance_overtime, attendance_absent
				//main
				
				//from database
				$shift=explode("-", $attendance_shift);
				$db_shift_start=$shift[0];
				$db_shift_end=$shift[1]; //to hold temporary for checking if shift timein > shift timeout
				$shift[0]=$attendance_date->format('Y-m-d')." ".$shift[0]; //database timein
				$shift[1]=$attendance_date->format('Y-m-d')." ".$shift[1]; //database timeout

				echo "us: ".$timein." &nbsp &nbsp ".$timeout."<br>";
				echo "db: ".$shift[0]." &nbsp &nbsp ".$shift[1]."<br>";


				$db_start = strtotime($shift[0]);
				$db_end = strtotime($shift[1]);

				if($db_start>$db_end)
					$db_end=strtotime($next_day->format('Y-m-d')." ".$db_shift_end);

				//echo "xxxxxx ".$shift[1]."<br>";

				$start = new DateTime($shift[0]);
				$end = new DateTime($shift[1]);

				echo "conv us: ".$timein_conv." ".$timeout_conv."<br>";
				echo "conv db: ".$db_start." ".$db_end."<br>";


				$absent=0;

				//computation for late**********************************************
				if($timein_conv>$db_start){
				$diff = $usertimein->diff( $start );
				echo "Late: ".$diff->format( '%H:%I' )."<br>"; // -> 00:25:25
				$timestring = $diff->format( '%H:%I' );
				$parsed = date_parse($timestring);
				$late_minutes = $parsed['hour'] * 60 + $parsed['minute'];
				}
				else
					$late_minutes=0;

				echo "Total Late Minutes: ".$late_minutes."<br>";

				//computation for undertime******************************************
				if($timeout_conv<$db_end){
				$diff = $end->diff( $usertimeout );
				echo "UT: ".$diff->format( '%H:%I' )."<br>"; // -> 00:25:25
				$timestring = $diff->format( '%H:%I' );
				$parsed = date_parse($timestring);
				$ut_minutes = $parsed['hour'] * 60 + $parsed['minute'];
				}//end UT
				else
					$ut_minutes=0;

				echo "Total UT Minutes: ".$ut_minutes."<br>";


				//computation for overtime********************************************
				if($timeout_conv>$db_end){
				$diff = $usertimeout->diff( $end );
				echo "OT: ".$diff->format( '%H:%I' )."<br>"; // -> 00:25:25
				$timestring = $diff->format( '%H:%I' );
				//echo "$timestring: ".$timestring."<br>";
				// $parsed = date_parse($timestring);
				// $ot_minutes = $parsed['hour'] * 60 + $parsed['minute'];
				$ot_minutes = time_to_decimal($timestring);
				} //end OT
				else
					$ot_minutes=0;

				echo "Total OT Hours: ".$ot_minutes."<br>";
				echo "Absent on this day: ".$absent."<br>";

				//absent**************************************************************
				echo '$db_start: '.$db_start." ";
				echo '$db_end: '.$db_end."<br>";
				echo '$timein_conv: '.$timein_conv." ";
				echo '$timeout_conv: '.$timeout_conv."<br>";

				if(
					($db_start>$timein_conv AND $db_start>=$timeout_conv ) OR //case AC
					($db_end<=$timein_conv AND $db_end<$timeout_conv ) //case BD
					){
					$late_minutes=0;
					$ut_minutes=0;
					$ot_minutes=0;
					$absent=1;
					echo 'Absent: 1<br>';
					echo "Values for Late, UT, OT: 0<br>";
				}


				$daytype_arr=array(
					'Rest Day',
					'Legal Holiday',
					'Special Holiday',
					'Rest and Special Holiday',
					'Rest and Legal Holiday');

				if(in_array($daytype, $daytype_arr)==true){
					$late_minutes=0;
					$ut_minutes=0;
					$absent=0;

					echo 'RD, LH, SH<br>';
				}
			}//if timein not null end
			else if($timein=='' AND $daytype=='Regular'){
				$late_minutes=0;
				$ut_minutes=0;
				$ot_minutes=0;
				$absent=1;
				echo "Total Late Minutes: ".$late_minutes."<br>";
				echo "Total UT Minutes: ".$ut_minutes."<br>";
				echo "Total OT Hours: ".$ot_minutes."<br>";
				echo "Absent on this day: ".$absent."<br><br>";
			}
			else{ //holiday,restday,

				$late_minutes=0;
				$ut_minutes=0;
				$ot_minutes=0;

				echo "Total Late Minutes: ".$late_minutes."<br>";
				echo "Total UT Minutes: ".$ut_minutes."<br>";
				echo "Total OT Hours: ".$ot_minutes."<br>";
			}

			//set values
			

			//update attendance here
			$sql_up = "UPDATE attendance 
			SET attendance_late='$late_minutes', 
			attendance_overtime='$ot_minutes', 
			attendance_undertime='$ut_minutes',
			attendance_absent='$absent'
			 WHERE attendance_id='$att_id'
			 ";

			if ($conn->query($sql_up) === TRUE) {
			    //echo $row['attendance_id']." ".$dbdate.": ";
			    echo "Record updated successfully at Attendance Table<br>";

			} else {
			    echo "Error updating record: " . $conn->error;
			}

			//update overtime table
				//prepare OT details
				// $overtime_date = $attendance_date->format('Y-m-d');
				// $overtime_start = $db_shift_end;
				// $overtime_end = $timeout;

				// $duration_ot = $end->diff( $usertimeout );
				// $reason_ot = "";
				// $remarks_ot = "";
				// $status_ot = "Disapproved";
				// $approved_by_ot = "";
				// $approval_date = '0000-00-00';
				// $approval_date_conv = $approval_date->format('Y-m-d');

			// $sql_up = "UPDATE overtime
			// SET  
			// overtime_start='$overtime_start',
			// overtime_end='$overtime_end',
			// overtime_duration='$duration_ot',
			// overtime_reason='$reason_ot',
			// overtime_remarks='$remarks_ot',
			// overtime_status='$status_ot',
			// overtime_approvedby='$approved_by_ot',
			// overtime_approvaldate='$approval_date'

			//  WHERE overtime_date='$overtime_date' AND employee_id='$empid'
			//  ";

			// if ($conn->query($sql_up) === TRUE) {
			//     //echo $row['attendance_id']." ".$dbdate.": ";
			//     echo "Record updated successfully at Overtime Table<br>";

			// } else {
			//     echo "Error updating record: " . $conn->error;
			// }


			
	}//end while

}//end if

}//end function

function time_to_decimal($time) {
	//$time = "07:30:00";
    $timeArr = explode(':', $time);
    $decTime = ($timeArr[0]) + ($timeArr[1]/60);
 
    return $decTime;
}
//extra code for setting default timein_date

function intialize_timeout_date(){
$sql = "SELECT * FROM attendance WHERE attendance_date<CURDATE()";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$dbdate = $row['attendance_date'];
    	$sql_up = "UPDATE attendance SET timeout_date='$dbdate' WHERE attendance_date='$dbdate'";

			if ($conn->query($sql_up) === TRUE) {
			    echo $row['attendance_id']." ".$dbdate.": ";
			    echo "Record updated successfully<br>";

			} else {
			    echo "Error updating record: " . $conn->error;
			}
    	//echo $row['employee_id']." ".$row['attendance_date']."<br>";
    }
 }
}//end function
//$mysqli->query("UPDATE attendance SET attendance_time");
?>

