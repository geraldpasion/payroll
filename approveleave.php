<?php 
include("dbconfig.php");
session_start();
$approval_date = date("Y-m-d");

//leave approval by level 4
if(isset($_POST['approved'])){
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	//$logid = $_POST['logid1'];
	$remarks = $_POST['remarks'];
	$start = $_POST['start'];
	
	// insert the new record into the database
	$result = mysqli_query($mysqli, "SELECT * from employee WHERE employee_id = '$empid'");
	while($row = mysqli_fetch_array($result)){
	   $sick=$row['employee_sickleave'];
	   $vacation=$row['employee_vacationleave'];
	   $incentive=$row['employee_incentive'];
	   $maternity=$row['employee_maternityleave'];
	   $paternity=$row['employee_paternityleave'];
	   $singleparent=$row['employee_singleparentleave'];
	   $date = date('m/d/y');
	}
	/*$result2 = mysqli_query($mysqli, "SELECT * FROM leave_logs INNER JOIN tbl_leave ON tbl_leave.employee_id = leave_logs.employee_id WHERE leave_logs.employee_id = '$empid' and tbl_leave.leave_id = '$leaveid' AND leave_logs.type = 'Credited'");
	while($row = mysqli_fetch_array($result)){
	   $logid=$row['log_id'];
	}*/
	$result2 = mysqli_query($mysqli, "SELECT * FROM leave_logs INNER JOIN tbl_leave ON tbl_leave.employee_id = leave_logs.employee_id WHERE leave_logs.employee_id = '$empid' and tbl_leave.leave_id = '$leaveid' AND leave_logs.type = 'Credited'");
	while($row = mysqli_fetch_array($result2)){
	   $logid=$row['log_id'];
	}

	if($_POST['type']=='Sick leave'){
		if($sick!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_sickleave = employee_sickleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','-1','0','0','0','0','0')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval.php?approved");
		}
		else{
			header("Location: leaveapproval.php?disabled");
		}
	}
	else if($_POST['type']=='Vacation leave'){
		if($vacation!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_vacationleave = employee_vacationleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','-1','0','0','0','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval.php?approved");
		}
		else{
			header("Location: leaveapproval.php?disabled");
		}
	}
	else if($_POST['type']=='Paid rest day / Incentive'){
		if($incentive!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_incentive = employee_incentive - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','-1','0','0','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval.php?approved");
		}
		else{
			header("Location: leaveapproval.php?disabled");
		}
	}
	else if($_POST['type']=='Maternity leave'){
		if($maternity!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_maternityleave = employee_maternityleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','-1','0','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval.php?approved");
		}
		else{
			header("Location: leaveapproval.php?disabled");
		}
	}
	else if($_POST['type']=='Paternity leave'){
		if($paternity!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_paternityleave = employee_paternityleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','0','-1','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval.php?approved");
		}
		else{
			header("Location: leaveapproval.php?disabled");
		}
	}
	else if($_POST['type']=='Single-parent leave'){
		if($singleparent!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_singleparentleave = employee_singleparentleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','0','0','-1')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval.php?approved");
		}
		else{
			header("Location: leaveapproval.php?disabled");
		}
	}
	else{
		if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
		{
			$stmt->execute();
			$stmt->close();
		}
		header("Location: leaveapproval.php?approved");
	}

	//change the status of the employee in the attendance approval to pending
	$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
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
		if ($attendance_status=='Approved' && $keydatefrom <= $start && $start <= $keydateto) {
			if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
			{
				echo "<script></script>";
			}
			if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empid'"))
			{
				echo "<script></script>";
			}
		}
	}else{
		$attendance_status='';
	}
}

//leave approval by level 3
if(isset($_POST['approved3'])){
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	//$logid = $_POST['logid1'];
	$remarks = $_POST['remarks'];
	$start = $_POST['start'];
	
	// insert the new record into the database
	$result = mysqli_query($mysqli, "SELECT * from employee WHERE employee_id = '$empid'");
	while($row = mysqli_fetch_array($result)){
	   $sick=$row['employee_sickleave'];
	   $vacation=$row['employee_vacationleave'];
	   $incentive=$row['employee_incentive'];
	   $maternity=$row['employee_maternityleave'];
	   $paternity=$row['employee_paternityleave'];
	   $singleparent=$row['employee_singleparentleave'];
	   $date = date('m/d/y');
	}
	/*$result2 = mysqli_query($mysqli, "SELECT * FROM leave_logs INNER JOIN tbl_leave ON tbl_leave.employee_id = leave_logs.employee_id WHERE leave_logs.employee_id = '$empid' and tbl_leave.leave_id = '$leaveid' AND leave_logs.type = 'Credited'");
	while($row = mysqli_fetch_array($result)){
	   $logid=$row['log_id'];
	}*/
	$result2 = mysqli_query($mysqli, "SELECT * FROM leave_logs INNER JOIN tbl_leave ON tbl_leave.employee_id = leave_logs.employee_id WHERE leave_logs.employee_id = '$empid' and tbl_leave.leave_id = '$leaveid' AND leave_logs.type = 'Credited'");
	while($row = mysqli_fetch_array($result2)){
	   $logid=$row['log_id'];
	}

	if($_POST['type']=='Sick leave'){
		if($sick!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_sickleave = employee_sickleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','-1','0','0','0','0','0')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval3.php?approved");
		}
		else{
			header("Location: leaveapproval3.php?disabled");
		}
	}
	else if($_POST['type']=='Vacation leave'){
		if($vacation!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_vacationleave = employee_vacationleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','-1','0','0','0','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval3.php?approved");
		}
		else{
			header("Location: leaveapproval3.php?disabled");
		}
	}
	else if($_POST['type']=='Paid rest day / Incentive'){
		if($incentive!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_incentive = employee_incentive - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','-1','0','0','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval3.php?approved");
		}
		else{
			header("Location: leaveapproval3.php?disabled");
		}
	}
	else if($_POST['type']=='Maternity leave'){
		if($maternity!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_maternityleave = employee_maternityleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','-1','0','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval3.php?approved");
		}
		else{
			header("Location: leaveapproval3.php?disabled");
		}
	}
	else if($_POST['type']=='Paternity leave'){
		if($paternity!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_paternityleave = employee_paternityleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','0','-1','0')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval3.php?approved");
		}
		else{
			header("Location: leaveapproval3.php?disabled");
		}
	}
	else if($_POST['type']=='Single-parent leave'){
		if($singleparent!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_singleparentleave = employee_singleparentleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','0','0','-1')"))
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval3.php?approved");
		}
		else{
			header("Location: leaveapproval3.php?disabled");
		}
	}
	else{
		if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
		{
			$stmt->execute();
			$stmt->close();
		}
		header("Location: leaveapproval3.php?approved");
	}

	//change the status of the employee in the attendance approval to pending
	$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
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
		if ($attendance_status=='Approved' && $keydatefrom <= $start && $start <= $keydateto) {
			if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
			{
				echo "<script></script>";
			}
			if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empid'"))
			{
				echo "<script></script>";
			}
		}
	}else{
		$attendance_status='';
	}
}

//leave approval by level 2
if(isset($_POST['approved2'])){
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	$remarks = $_POST['remarks'];
	$start = $_POST['start'];
	// insert the new record into the database
	$result = mysqli_query($mysqli, "SELECT * from employee WHERE employee_id = '$empid'");
	while($row = mysqli_fetch_array($result)){
	   $sick=$row['employee_sickleave'];
	   $vacation=$row['employee_vacationleave'];
	   $incentive=$row['employee_incentive'];
	   $maternity=$row['employee_maternityleave'];
	   $paternity=$row['employee_paternityleave'];
	   $singleparent=$row['employee_singleparentleave'];
	}
	$result2 = mysqli_query($mysqli, "SELECT * FROM leave_logs INNER JOIN tbl_leave ON tbl_leave.employee_id = leave_logs.employee_id WHERE leave_logs.employee_id = '$empid' and tbl_leave.leave_id = '$leaveid' AND leave_logs.type = 'Credited'");
	while($row = mysqli_fetch_array($result2)){
	   $logid=$row['log_id'];
	}

	if($_POST['type']=='Sick leave'){
		if($sick!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_sickleave = employee_sickleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','-1','0','0','0','0','0')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval2.php?approved");
		}
		else{
			header("Location: leaveapproval2.php?disabled");
		}
	}
	else if($_POST['type']=='Vacation leave'){
		if($vacation!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_vacationleave = employee_vacationleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','-1','0','0','0','0')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval2.php?approved");
		}
		else{
			header("Location: leaveapproval2.php?disabled");
		}
	}
	else if($_POST['type']=='Paid rest day / Incentive'){
		if($incentive!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_incentive = employee_incentive - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','-1','0','0','0')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval2.php?approved");
		}
		else{
			header("Location: leaveapproval2.php?disabled");
		}
	}
	else if($_POST['type']=='Maternity leave'){
		if($maternity!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_maternityleave = employee_maternityleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','-1','0','0')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval2.php?approved");
		}
		else{
			header("Location: leaveapproval2.php?disabled");
		}
	}
	else if($_POST['type']=='Paternity leave'){
		if($paternity!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_paternityleave = employee_paternityleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','0','-1','0')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval2.php?approved");
		}
		else{
			header("Location: leaveapproval2.php?disabled");
		}
	}
	else if($_POST['type']=='Single-parent leave'){
		if($singleparent!=0){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_singleparentleave = employee_singleparentleave - 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
					if($stmt3 = $mysqli->prepare("INSERT INTO leave_logs (employee_id, table_leave_id,date, type, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('".$empid."','$table_leave_id',CURDATE(),'Used','0','0','0','0','0','-1')"))
						
					{
						$stmt3->execute();
						$stmt3->close();
					}
				}
			}
			header("Location: leaveapproval2.php?approved");
		}
		else{
			header("Location: leaveapproval2.php?disabled");
		}
	}
	else{
		if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
		{
			$stmt->execute();
			$stmt->close();
		}
		header("Location: leaveapproval2.php?approved");
	}

	//change the status of the employee in the attendance approval to pending
	$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
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
		if ($attendance_status=='Approved' && $keydatefrom <= $start && $start <= $keydateto) {
			if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '$empid'"))
			{
				echo "<script></script>";
			}
			if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '$empid'"))
			{
				echo "<script></script>";
			}
		}
	}else{
		$attendance_status='';
	}
}

if(isset($_POST['disapproved'])) {
	include("dbconfig.php");
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	$remarks = $_POST['remarks'];
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
	{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
	// redirec the user
	header("Location: leaveapproval.php?disapproved");
}

if(isset($_POST['disapproved2'])) {
	include("dbconfig.php");
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	$remarks = $_POST['remarks'];
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	// insert the new record into the database
	if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
	{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
	// redirec the user
	header("Location: leaveapproval2.php?disapproved");
}
?>
