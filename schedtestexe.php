<?php 
include("dbconfig.php");
session_start();
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
$dateToday = date("Y-m-d");
$hasdate = $_POST['hasdate'];
echo "hasdate: ".$hasdate."<br>";
$sched=$_POST["sched"];
		$schedArray = split('-', $sched);
		$schedArray[0] = substr($schedArray[0], 0, -3);
		$schedArray[1] = substr($schedArray[1], 0, -3);
		$sched = $schedArray[0].'-'.$schedArray[1];
$shift_start=$schedArray[0];
$tom = strtotime("tomorrow");
$dateTomorrow=date("Y-m-d", $tom);
$shift_end=$schedArray[1];
echo "sched: ".$sched."<br>";

if(isset($_POST['daterange']) AND $hasdate=='with')
{

	echo "daterange: ".$_POST['daterange']."<br>";
	$daterange=$_POST['daterange'];
	$str_explode=explode("-",$daterange);


	$string1 = $str_explode[0];
	$string1 = str_replace(' ', '', $string1);
	$string1Array = split('/', $string1);
	$string1 = $string1Array[2].'-'.$string1Array[0].'-'.$string1Array[1];
	echo "string1: ".$string1."<br>";

	$string2 = $str_explode[1];
	$string2 = str_replace(' ', '', $string2);
	$string2Array = split('/', $string2);
	$string2 = $string2Array[2].'-'.$string2Array[0].'-'.$string2Array[1];
	echo "string2: ".$string2."<br>";

	echo "dateToday: ".$dateToday."<br>";

	if($dateToday <= $string1) {

		$usersCount = count($_POST["id"]);
		for($i=0;$i<$usersCount;$i++) {
			$empid = $_POST["id"][$i];
		//if ($stmt = $mysqli->prepare("UPDATE employee set employee_shift='" . $_POST["sched"] . "',date_start='".$string1."',date_end='".$string2."' WHERE employee_id='" . $_POST["id"][$i] . "'"))
		//if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_shift='".$_POST["sched"]."' WHERE employee_id = '".$_POST["id"][$i]."' AND attendance_date BETWEEN '$string1' AND '$string2'"))
		$sql="UPDATE attendance SET attendance_shift='$sched' WHERE attendance_date BETWEEN '$string1' AND '$string2' AND employee_id = '$empid'";
			if ($stmt = $mysqli->prepare($sql))
			{
				$stmt->execute();
				$stmt->close();
				echo $hasdate." Successfully updated attendance table!";

				//move data of employee_shift to employee_shift_temp for backup
				$sql_sel = "SELECT employee.employee_shift,attendance.attendance_restday FROM employee INNER JOIN attendance ON employee.employee_id=attendance.employee_id WHERE employee.employee_id='$empid'";
			    $result = $conn->query($sql_sel);
			         if ($result->num_rows > 0) {
			                 while($row_shift = $result->fetch_assoc()) {
			                   $shift_current=$row_shift['employee_shift'];
			                   $shift_Restday=$row_shift['attendance_restday'];
			                   break;
			                 }
			         }
			         
					if(date($string1)>$dateToday){
			       	$status="pending";
					echo"pending";
			       }
			      	else if(date($string1)>$dateToday OR date($string2)<$dateToday OR date($string1)==$dateToday OR date($string2)==$dateToday){
			       	echo"active";
			       	$status="active";
			       }
			      
			       else{
			       	$status="completed";
			       	echo"completed";
			       }

				//update employee db2_tables(connection)				   								//put the new shift 		 //backup the previous
				//$sql_up = "UPDATE employee SET shift_temp_start='$string1', shift_temp_end='$string2', pending_shift='$sched',  employee_shift_temp='$shift_current' WHERE employee_id=$empid";
				$sql_up ="INSERT INTO shift_logs (employee_id, shiftlog_date, shiftlog_startdate, shiftlog_enddate, shiftlog_schedule, shiftlog_createdby, shiftlog_status) VALUES('$empid', '$dateToday', '$string1', '$string2' ,'$sched' ,'$approvedby', '$status')";
				if ($conn->query($sql_up) === TRUE) {
				    echo $hasdate." Record updated successfully employee ".$empid."<br>";
				} else {
				    echo $hasdate." Error updating record ".$empid.": " . $conn->error."<br>";
				}

			}
			// show an error if the query has an error
			else{
				echo $hasdate." ERROR: Could not prepare SQL statement."."<br>";
			}
		}//end for loop
		header("Location: schedtest.php?edited");
	} 
	else {
		header("Location: schedtest.php?error");
	}//end else
}//end if daterange
else if($hasdate=='without'){
	//update employee table

	$datetime = new DateTime('tomorrow');
	$datetime = $datetime->format('m/d/Y'); 

	$usersCount = count($_POST["id"]);
		for($i=0;$i<$usersCount;$i++) {
			$empid = $_POST["id"][$i];
			
			//$sql = "UPDATE employee SET shift_temp_start='$datetime', shift_temp_end=0, pending_shift='$sched', employee_shift_temp=null WHERE employee_id=$empid";

			$sql_sel = "SELECT attendance_restday FROM attendance WHERE employee_id='$empid'";
			$result = $conn->query($sql_sel);
				if ($result->num_rows > 0) {
					while($row_restday = $result->fetch_assoc()) {
						$restday_val=$row_restday['attendance_restday'];
						break;
			            }
			         }

			        if($dateTomorrow>$dateToday){
			       	$status="pending";
					echo"pending";
			       }
			      	else if($dateTomorrow>=$dateToday){
			       	echo"active";
			       	$status="active";
			       }
			      
			       else{
			       	$status="completed";
			       	echo"completed";
			       }


			$sql="INSERT INTO shift_logs (employee_id, shiftlog_date, shiftlog_startdate, shiftlog_enddate, shiftlog_schedule, shiftlog_createdby, shiftlog_status) VALUES('$empid', '$dateToday', '$dateTomorrow', 'NULL' ,'$sched' ,'$approvedby', '$status')";
			if ($conn->query($sql) === TRUE) {
			    echo $hasdate." Record updated successfully employee ".$empid."<br>";
			    header("Location: schedtest.php?edited");
			   // echo"<script>alert('ok!')</script>";

			} else {
			    echo $hasdate." Error updating record employee ".$empid.": " . $conn->error."<br>";
			   header("Location: schedtest.php?error");
			}
		}//end for loop

}//end else if
else
{
	echo "nothing!<br>";
}
?>