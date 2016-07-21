<?php 
	include("dbconfig.php");
	session_start();
	$attendanceid = $_POST['attendance_id'];
	$maxes2 = $_POST['attendance_id'];
	$attend = $_POST['attend'];
	$absentbool = $_POST['absentbool'];
	$daytype = $_POST['daytype'];
	$status = $_POST['status'];
	$emptype = $_POST['emptype'];
	$date = date("Y-m-d",strtotime($_POST['logedit_date'])); 
	$timein = $_POST['logedit_timein'];
	$breakout = $_POST['logedit_breakout'];
	$breakin = $_POST['logedit_breakin'];
	$timeout = $_POST['logedit_timeout'];
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];

	$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE attendance_id = '$maxes2'")->fetch_array();
	$employeeid = $attendanceData['employee_id'];
	$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employeeid'")->fetch_array();
	$username = $employeeData['employee_id'];
	$password = $employeeData['employee_password'];

	$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
	$run_user = mysqli_query($mysqli, $sel_user);
	$fetch_emp = mysqli_fetch_array($run_user);

	$from = "edit";

	// insert the new record into the database
	if ($stmt = $mysqli->prepare("UPDATE attendance, logedit SET attendance.attendance_timein = '$timein', attendance.attendance_breakout = '$breakout', attendance.attendance_breakin = '$breakin', attendance.attendance_timeout = '$timeout', attendance.attendance_absent='$absentbool', attendance.attendance_status='$status', logedit.logedit_status = 'Approved', logedit.logedit_approvedby = '$approvedby' WHERE logedit.attendance_id = '$attendanceid' AND attendance.attendance_id = '$attendanceid'"))
	{
		$stmt->execute();
		$stmt->close();

		//change the status of the employee in the attendance approval to pending
		$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$employeeid'");
		if ($attstatus->num_rows > 0) {
			$row101 = mysqli_fetch_object($attstatus);
			$attendance_status = $row101->attendance_status;
			$cutoffdate = $row101->cutoff;
			$cutarray = array();
			$cutarray = split(" - ", $cutoffdate);
			$keydatefrom = $cutarray[0];
			$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
			$keydateto = $cutarray[1];
			$keydateto = date("Y-m-d", strtotime($keydateto));
			if ($attendance_status=='Approved' && $keydatefrom <= $date && $date <= $keydateto) {
				if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$employeeid'"))
				{
					echo "<script></script>";
				}
				if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$employeeid'"))
				{
					echo "<script></script>";
				}
			}
		}else{
			$attendance_status='';
		}
		
		include("updateattendance.php");
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
	// redirec the user
	header("Location: logedit.php?edited");
?>