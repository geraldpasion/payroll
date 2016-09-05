<?php 
include("dbconfig.php");
session_start();
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
$dateToday = date("Y-m-d");
$hasdate = $_POST['hasdate'];
echo "hasdate: <b>".$hasdate."</b><br>";
$sched=$_POST["sched"]; //time
		$schedArray = split('-', $sched);
		$schedArray[0] = substr($schedArray[0], 0, -3); //start time
		echo 'schedArray[0]: '.$schedArray[0]."<br>";
		$schedArray[1] = substr($schedArray[1], 0, -3); //end time
		echo 'schedArray[1]: '.$schedArray[1]."<br>";
		$sched = $schedArray[0].'-'.$schedArray[1];
		//echo 'sched: '.$sched."<br>";

		$start=$schedArray[0];
		$end=$schedArray[1];

$shift_start=$schedArray[0];
$tom = strtotime("tomorrow");
$dateTomorrow=date("Y-m-d", $tom);
$shift_end=$schedArray[1];
echo "sched: ".$sched."<br><br>";

//check first if already exist
function check_if_existing($sched){
	include 'dbconfig.php';

$usersCount = count($_POST["id"]);
		for($i=0;$i<$usersCount;$i++){ 
			$empid = $_POST["id"][$i];


			if(isset($_POST['daterange'])){
            	$user_daterange=$_POST['daterange'];
                echo "user daterange: ".$user_daterange."<br><br>";

                $str_explode=explode("-",$user_daterange);

				$string1 = $str_explode[0];
				$string1 = str_replace(' ', '', $string1);
				$string1Array = split('/', $string1);
				$string1 = $string1Array[2].'-'.$string1Array[0].'-'.$string1Array[1];
				echo "user string1: ".$string1."<br>";

				$string2 = $str_explode[1];
				$string2 = str_replace(' ', '', $string2);
				$string2Array = split('/', $string2);
				$string2 = $string2Array[2].'-'.$string2Array[0].'-'.$string2Array[1];
				echo "user string2: ".$string2."<br><br>";
         		}
         		else{
         		//tomorrow
         		$tom = strtotime("tomorrow");
				$dateTomorrow=date("Y-m-d", $tom);
				echo "tomorrow's date: ".$tom."<br>";
				echo "converted: ".$dateTomorrow."<br><br>";
				}



			//$sql = "SELECT shiftlog_id FROM shift_logs WHERE employee_id='$empid' AND shiftlog_schedule='$sched'";
			$sql = "SELECT * FROM shift_logs WHERE employee_id='$empid' shiftlog_startdate>='$string1' AND shiftlog_startdate";
			$result = $conn->query($sql);
         	if ($result->num_rows > 0) {
         		
         		// output data of each row
            while($row = $result->fetch_assoc()) {

            	//start date in db
            	echo "db start date: ".$row['shiftlog_startdate']."<br>";
				echo "db end date: ".$row['shiftlog_enddate']."<br>";      	

                //if existing, error, then ask if they want to change with new sched
            	
         		//initialize variables for ease of coding
         		//database date
         		$start_date=$row['shiftlog_startdate'];
         		$end_date=$row['shiftlog_enddate'];


         		//time start-end at db
         		$schedule=$row['shiftlog_schedule']; 
         		//parse schedule //these are times
         		$dbsched=split("-", $schedule);
         		$db_start=$dbsched[0];
         		$db_end=$dbsched[1];

         		echo "db_start: ".$db_start."<br>";
         		echo "db_end: ".$db_end."<br>";

         		//convert to time
         		$db_start=strtotime($db_start);
         		$db_end=strtotime($db_end);
         		echo "converted:<br>";
         		echo "db_start: ".$db_start."<br>";
         		echo "db_end: ".$db_end."<br><br>";

         		//***user input

         		//$sched - user input schedule
         		//parse this too.
         		$usersched=split("-", $sched);
         		$user_start = $usersched[0];
         		$user_end = $usersched[1];

         		echo "user_start: ".$user_start."<br>";
         		echo "user_db: ".$user_end."<br>";

         		//convert to time
         		$user_start=strtotime($user_start);
         		$user_end=strtotime($user_end);
         		echo "converted:<br>";
         		echo "user_start: ".$user_start."<br>";
         		echo "user_db: ".$user_end."<br><br>";

		         		//start comparison here
		         		if(
		         			//cases here //do not accept
		         			//A
		         			($db_start<=$user_end and $db_end>=$user_end) OR
							//B
							($db_start<=$user_start and $db_end>=$user_start) OR
							//C
							($db_start>=$user_start and $db_end>=$user_end) 
							

		         		){
		         			echo "<b>conflict!</b><br>";
		         		}//end if
		         		else{
		         			echo "<b>accept!</b><br>";
		         		}


		         		echo "**************<br>";
             } //end while        		
         		return 1;
         		break;
         		
           
         }//end if

         echo "==============================<br>";
		}//end for
			
			return 0;
}//end function

$check_exist=0;
$check_exist=check_if_existing($sched);

echo "existing: ".$check_exist;

if(isset($_POST['daterange']) AND $hasdate=='with' AND $check_exist==0)
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
	//$attendance_date_concat=$string1."-".$string2;

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
		//header("Location: schedtest.php?edited");
	} 
	else {
		//header("Location: schedtest.php?error");
	}//end else
}//end if daterange
else if($hasdate=='without' AND $check_exist==0){
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
			  // header("Location: schedtest.php?edited");
			 //  echo"<script>alert('insert!')</script>";

			} else {
			   echo $hasdate." Error updating record employee ".$empid.": " . $conn->error."<br>";
			  // header("Location: schedtest.php?error");
			}

			$sqlup = "UPDATE attendance SET attendance_shift='$sched' WHERE attendance_date >='$dateTomorrow' AND employee_id='$empid'";
			if ($conn->query($sqlup) === TRUE) {
			    echo $hasdate." Record updated successfully employee ".$empid."<br>";
			    //header("Location: schedtest.php?edited");
			  //  echo"<script>alert('updated successfully')</script>";

			} else {
			   echo $hasdate." Error updating record employee ".$empid.": " . $conn->error."<br>";
			   //header("Location: schedtest.php?error");
				//echo"<script>alert('error updating record ')</script>";
			}
		}//end for loop

}//end else if
else
{
	echo "nothing!<br>";
}
?>