<?php 
include("dbconfig.php");
session_start();
$leaveid = $_POST['leave_id1'];
$empid = $_POST['empid1'];
$remarks = $_POST['remarks'];
$approvedby = $_SESSION['fname'] . " " . $_SESSION['lname'];
if(isset($_POST['approved'])){
// insert the new record into the database
$result = mysqli_query($mysqli, "SELECT * from employee WHERE employee_id = '$empid'");
   while($row = mysqli_fetch_array($result)){
       $sakit=$row['employee_sickleave'];
       $bakasyon=$row['employee_vacationleave'];
   }

		if($_POST['firstname']=='Sick leave'){
			if($sakit!=0){
				if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby' WHERE leave_id = '$leaveid'"))
				{
					$stmt->execute();
					$stmt->close();
					if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_sickleave = employee_sickleave - 1 WHERE employee_id = '$empid'"))
					{
						$stmt2->execute();
						$stmt2->close();
					}
				}
			}
		}
		else if($_POST['firstname']=='Leave without pay'){
			if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby' WHERE leave_id = '$leaveid'"))
			{
				$stmt->execute();
				$stmt->close();
			}
			
		}
		else{
			if($bakasyon!=0){
				if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Approved', leave_remarks = '$remarks', leave_approvedby = '$approvedby' WHERE leave_id = '$leaveid'"))
				{
					$stmt->execute();
					$stmt->close();
					if ($stmt2 = $mysqli->prepare("UPDATE employee SET employee_vacationleave = employee_vacationleave - 1 WHERE employee_id = '$empid'"))
					{
						$stmt2->execute();
						$stmt2->close();
					}
				}
			}
		}
	

header("Location: leaveapproval2.php?approved");
}else{
include("dbconfig.php");
$leaveid = $_POST['leave_id1'];
// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE tbl_leave SET leave_status = 'Disapproved', leave_remarks = '$remarks', leave_approvedby = '$approvedby' WHERE leave_id = '$leaveid'"))
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
