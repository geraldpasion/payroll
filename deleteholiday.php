<?php 
include("dbconfig.php");
$holidayid = $_POST['holiday_id1'];
$dateRow = $mysqli->query("SELECT * FROM holiday where holiday_id = '$holidayid'")->fetch_array();
$date = $dateRow['holiday_date'];
$attendanceIDs = array();
$i = 0;

if($result = $mysqli->query("SELECT * FROM attendance where attendance_date = '$date'")) {
	if($result->num_rows > 0) {
		while ($row = $result->fetch_object()) {
			$type = $row->attendance_daytype;
			if($type == "Rest and Legal Holiday" || $type == "Rest and Special Holiday") {
				if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Rest Day' WHERE attendance_id = '$row->attendance_id'")) {
					$stmt2->execute();
					$stmt2->close();
				}
			} else {
				if($stmt2 = $mysqli->prepare("UPDATE attendance SET attendance_daytype='Regular' WHERE attendance_id = '$row->attendance_id'")) {
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
	}
}

//$ctr = $i;
// while($i >= 0) {
// 	$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE attendance_id='".$attendanceIDs[$i]."'")->fetch_array();
// 	$maxes2 = $attendanceData['attendance_id'];
// 	$empID = $attendanceData['employee_id'];
// 	$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empID'")->fetch_array();
// 	$username = $employeeData['employee_id'];
// 	$password = $employeeData['employee_password'];
// 	$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
// 	$run_user = mysqli_query($mysqli, $sel_user);
// 	$fetch_emp = mysqli_fetch_array($run_user);
// 	include("updateattendance.php");
// 	$i = $i - 1;
// }

// insert the new record into the database
if ($stmt = $mysqli->prepare("DELETE FROM holiday WHERE holiday_id = '$holidayid'"))
{
	$stmt->execute();
	$stmt->close();
	header("Location: legalholiday.php");
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
?>