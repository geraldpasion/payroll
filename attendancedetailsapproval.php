<?php 
include('dbconfig.php');
$empid = $_REQUEST['empid'];
$period = $_REQUEST['period'];
$absent = $_REQUEST['absent'];
$late = $_REQUEST['late'];
$undertime = $_REQUEST['undertime'];
$regnd =  $_REQUEST['nightdiff'];
$reghrs = $_REQUEST['reghrs'];
$regot = $_REQUEST['regot'];
$regotnd = $_REQUEST['regotnd'];
$restot = $_REQUEST['restot'];
$restot8 = $_REQUEST['restot8'];
$restnd = $_REQUEST['restnd'];
$restnd8 = $_REQUEST['restnd8'];
$legalot = $_REQUEST['legalot'];
$legalot8 = $_REQUEST['legalot8'];
$legalnd = $_REQUEST['legalnd'];
$legalnd8 = $_REQUEST['legalnd8'];
$specialot = $_REQUEST['specialot'];
$specialot8 = $_REQUEST['specialot8'];
$specialnd = $_REQUEST['specialnd'];
$specialnd8 = $_REQUEST['specialnd8'];
$legalrestot = $_REQUEST['legalrestot'];
$legalrestot8 = $_REQUEST['legalrestot8'];
$legalrestnd = $_REQUEST['legalrestnd'];
$legalrestnd8 = $_REQUEST['legalrestnd8']; 
$specialrestot = $_REQUEST['specialrestot'];
$specialrestot8 = $_REQUEST['specialrestot8'];
$specialrestnd = $_REQUEST['specialrestnd'];
$specialrestnd8 = $_REQUEST['specialrestnd8'];
$leavehours = $_REQUEST['leavehours'];

// if(isset($_POST['approved'])){
// insert the new record into the database
$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
if ($attstatus->num_rows > 0) {
	$row101 = mysqli_fetch_object($attstatus);
	$attendance_status = $row101->attendance_status;
}else{
	$attendance_status='';
}

if ($attendance_status=='') {
	if ($stmt = $mysqli->query("INSERT INTO total_comp (`employee_id`,`cutoff`,`absent`,`late`,`undertime`,`reg_hrs`,`reg_nd`,`reg_ot`,`reg_ot_nd`,`rst_ot`,`rst_ot_grt8`,`rst_nd`,`rst_nd_grt8`,`lh_ot`,`lh_ot_grt8`,`lh_nd`,`lh_nd_grt8`,`sh_ot`,`sh_ot_grt8`,`sh_nd`,`sh_nd_grt8`,`rst_lh_ot`,`rst_lh_ot_grt8`,`rst_lh_nd`,`rst_lh_nd_grt8`,`rst_sh_ot`,`rst_sh_ot_grt8`,`rst_sh_nd`,`rst_sh_nd_grt8`,`leave_hrs`,`attendance_status`) values('$empid','$period','$absent','$late','$undertime','$reghrs','$regnd','$regot','$regotnd','$restot','$restot8','$restnd','$restnd8','$legalot','$legalot8','$legalnd','$legalnd8','$specialot','$specialot8','$specialnd','$specialnd8','$legalrestot','$legalrestot8','$legalrestnd','$legalrestnd8','$specialrestot','$specialrestot8','$specialrestnd','$specialrestnd8','$leavehours','Approved')"))
	{
		echo "<script></script>";
	// echo"<script>alert('$empid');</script>";
		// $stmt->execute();
		// $stmt->close();

		$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
		if ($attstatus->num_rows > 0) {
			$row101 = mysqli_fetch_object($attstatus);
			$comp_id = $row101->comp_id;
			$cutoffdate = $row101->cutoff;
			$cutarray = array();
			$cutarray = split(" - ", $cutoffdate);
			$keydatefrom = $cutarray[0];
			$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
			$keydateto = $cutarray[1];
			$keydateto = date("Y-m-d", strtotime($keydateto));

			if ($earningsett = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid'")){
				if ($earningsett->num_rows > 0) {
					while($row = $earningsett->fetch_object()){
						$initial = $row->initial_date;
						$end = $row->end_date;


						/*if(($end != "0000-00-00" && (($initial <= $keydatefrom && $end >= $keydatefrom) || ($initial <= $keydatefrom && $end <= $keydateto) || ($initial >= $keydatefrom && $initial <= $keydateto && $end >= $keydatefrom) || ($initial >= $keydatefrom && $initial <= $keydateto && $end <= $keydateto))) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){*/
						if(($end != "0000-00-00" && (($initial <= $keydateto && $end >= $keydateto && $end >= $keydatefrom) || ($end >= $keydatefrom && $initial <= $keydatefrom && $end <= $keydateto))) 
							|| ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))) {


						/*if(($end != "0000-00-00" && (($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)) && ($end >= $keydatefrom || $end <= $keydateto))) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){*/
							if($stmt = $mysqli->prepare("UPDATE emp_earnings SET comp_id = '$comp_id' WHERE employee_id = '$empid'")){
								$stmt->execute();
							 	$stmt->close();
							}
						}
					}
				}
			}

			if ($deductionsett = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid'")){
				if ($deductionsett->num_rows > 0) {
					while($row = $deductionsett->fetch_object()){
						$initial = $row->initial_date;
						$end = $row->end_date;
						if(($end != "0000-00-00" && (($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)) && ($end >= $keydatefrom || $end <= $keydateto))) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){
							if($stmt = $mysqli->prepare("UPDATE emp_deductions SET comp_id = '$comp_id' WHERE employee_id = '$empid'")){
								$stmt->execute();
							 	$stmt->close();
							}
						}
					}
				}
			}
		}
	}
	else
	{
		echo mysqli_error($mysqli);
	}

}else{
	if ($stmt = $mysqli->query("UPDATE total_comp SET employee_id = '$empid',
		cutoff = '$period',
		absent = '$absent',
		late = '$late',
		undertime = '$undertime',
		reg_hrs = '$reghrs',
		reg_nd = '$regnd',
		reg_ot = '$regot',
		reg_ot_nd = '$regotnd',
		rst_ot = '$restot',
		rst_ot_grt8 = '$restot8',
		rst_nd = '$restnd',
		rst_nd_grt8 = '$restnd8',
		lh_ot = '$legalot',
		lh_ot_grt8 = '$legalot8',
		lh_nd = '$legalnd',
		lh_nd_grt8 = '$legalnd8',
		sh_ot = '$specialot',
		sh_ot_grt8 = '$specialot8',
		sh_nd = '$specialnd',
		sh_nd_grt8 = '$specialnd8',
		rst_lh_ot = '$legalrestot',
		rst_lh_ot_grt8 = '$legalrestot8',
		rst_lh_nd = '$legalrestnd',
		rst_lh_nd_grt8 = '$legalrestnd8',
		rst_sh_ot = '$specialrestot',
		rst_sh_ot_grt8 = '$specialrestot8',
		rst_sh_nd = '$specialrestnd',
		rst_sh_nd_grt8 = '$specialrestnd8',
		leave_hrs = '$leavehours',
		attendance_status = 'Approved' WHERE employee_id = '$empid'"))
	{
		echo "<script></script>";
	// echo"<script>alert('$empid');</script>";
		// $stmt->execute();
		// $stmt->close();
	}
	else
	{
		echo mysqli_error($mysqli);
	}
}
// show an error if the query has an error
// redirec the user
// header("Location: attendancedetailsapproval.php?approved");
// }
// else{
// // insert the new record into the database
// if ($stmt = $mysqli->prepare("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
// {
// 	$stmt->execute();
// 	$stmt->close();
// }
// // show an error if the query has an error
// else
// {
// 	echo "ERROR: Could not prepare SQL statement.";
// }
// // redirec the user
// header("Location: attendancedetailsapproval.php?pending");

// }




?>