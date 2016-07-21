<?php 
include("dbconfig.php");
session_start();
$overtimeid = $_POST['otid1'];
$remarks = $_POST['remarks'];
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];

$overtimeData = $mysqli->query("SELECT * FROM overtime WHERE overtime_id = '$overtimeid'")->fetch_array();
$otDate = $overtimeData['overtime_date'];
$empID = $overtimeData['employee_id'];
$attendanceData = $mysqli->query("SELECT * FROM attendance WHERE attendance_date = '$otDate' AND employee_id='$empID'")->fetch_array();
$maxes2 = $attendanceData['attendance_id'];
$employeeData = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empID'")->fetch_array();
$username = $employeeData['employee_id'];
$password = $employeeData['employee_password'];
$sel_user = "SELECT * from employee where employee_id='$username' AND employee_password='$password' AND employee_status = 'active'";
$run_user = mysqli_query($mysqli, $sel_user);
$fetch_emp = mysqli_fetch_array($run_user);

if(isset($_POST['approved'])){
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("UPDATE overtime SET overtime_status = 'Approved', overtime_remarks = '$remarks', overtime_approvedby = '$approvedby' WHERE overtime_id = '$overtimeid'"))
	{
		$stmt->execute();
		$stmt->close();

		//change the status of the employee in the attendance approval to pending
		$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empID'");
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
			if ($attendance_status=='Approved' && $keydatefrom <= $otDate && $start <= $otDate) {
				if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empID'"))
				{
					echo "<script></script>";
				}
				if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empID'"))
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
	else {
		echo "ERROR: Could not prepare SQL statement.";
	}
	// redirec the user
	header("Location: overtimeapproval.php?approved");
} else{
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("UPDATE overtime SET overtime_status = 'Disapproved', overtime_remarks = '$remarks', overtime_approvedby = '$approvedby' WHERE overtime_id = '$overtimeid'"))
	{
		$stmt->execute();
		$stmt->close();

		//change the status of the employee in the attendance approval to pending
		$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empID'");
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
			if ($attendance_status=='Approved' && $keydatefrom <= $otDate && $start <= $otDate) {
				if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empID'"))
				{
					echo "<script></script>";
				}
				if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empID'"))
				{
					echo "<script></script>";
				}
			}
		} else{
			$attendance_status='';
		}

		include("updateattendance.php");

	} // show an error if the query has an error
	else {
		echo "ERROR: Could not prepare SQL statement.";
	}
	// redirec the user
	header("Location: overtimeapproval.php?disapproved");
}
?>