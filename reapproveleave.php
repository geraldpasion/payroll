<?php 
include("dbconfig.php");
session_start();
$approval_date = date("Y-m-d");
if(isset($_POST['approved'])){
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	$remarks = $_POST['remarks'];
	$start = $_POST['start'];
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
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
						}
					}
					header("Location: leavetracer.php?approved");
				}
				else{
					header("Location: leavetracer.php?disabled");
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
						}
					}
					header("Location: leavetracer.php?approved");
				}
				else{
					header("Location: leavetracer.php?disabled");
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
						}
					}
					header("Location: leavetracer.php?approved");
				}
				else{
					header("Location: leavetracer.php?disabled");
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
						}
					}
					header("Location: leavetracer.php?approved");
				}
				else{
					header("Location: leavetracer.php?disabled");
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
						}
					}
					header("Location: leavetracer.php?approved");
				}
				else{
					header("Location: leavetracer.php?disabled");
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
						}
					}
					header("Location: leavetracer.php?approved");
				}
				else{
					header("Location: leavetracer.php?disabled");
				}
			}
			else{
				if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
				{
					$stmt->execute();
					$stmt->close();
				}
				header("Location: leavetracer.php?approved");
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

if(isset($_POST['approved2'])){
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	$remarks = $_POST['remarks'];
	$start = $_POST['start'];
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
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
						}
					}
					header("Location: leavetracer2.php?approved");
				}
				else{
					header("Location: leavetracer2.php?disabled");
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
						}
					}
					header("Location: leavetracer2.php?approved");
				}
				else{
					header("Location: leavetracer2.php?disabled");
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
						}
					}
					header("Location: leavetracer2.php?approved");
				}
				else{
					header("Location: leavetracer2.php?disabled");
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
						}
					}
					header("Location: leavetracer2.php?approved");
				}
				else{
					header("Location: leavetracer2.php?disabled");
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
						}
					}
					header("Location: leavetracer2.php?approved");
				}
				else{
					header("Location: leavetracer2.php?disabled");
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
						}
					}
					header("Location: leavetracer2.php?approved");
				}
				else{
					header("Location: leavetracer2.php?disabled");
				}
			}
			else{
				if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
				{
					$stmt->execute();
					$stmt->close();
				}
				header("Location: leavetracer2.php?approved");
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

if(isset($_POST['disapproved'])){
	include("dbconfig.php");
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	$remarks = $_POST['remarks'];
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	// insert the new record into the database
	if($_POST['type']=='Sick leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_sickleave = employee_sickleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Vacation leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_vacationleave = employee_vacationleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Paid rest day / Incentive'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_incentive = employee_incentive + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Maternity leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_maternityleave = employee_maternityleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Paternity leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_paternityleave = employee_paternityleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Single-parent leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_singleparentleave = employee_singleparentleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else{
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
			}
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

	// redirec the user
	header("Location: leavetracer.php?disapproved");
}

if(isset($_POST['disapproved2'])){
	include("dbconfig.php");
	$leaveid = $_POST['leave_id1'];
	$empid = $_POST['empid1'];
	$remarks = $_POST['remarks'];
	$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
	// insert the new record into the database
		if($_POST['type']=='Sick leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_sickleave = employee_sickleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Vacation leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_vacationleave = employee_vacationleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Paid rest day / Incentive'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_incentive = employee_incentive + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Maternity leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_maternityleave = employee_maternityleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Paternity leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_paternityleave = employee_paternityleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else if($_POST['type']=='Single-parent leave'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
				if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_singleparentleave = employee_singleparentleave + 1 WHERE employee_id = '$empid'"))
				{
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
		else{
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby', leave_approvaldate = '$approval_date' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
			}
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

	// redirec the user
	header("Location: leavetracer2.php?disapproved");
}
?>
