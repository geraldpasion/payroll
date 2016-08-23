<?php
include("dbconfig.php");

/*if(isset($_POST['sx'])){
	$sched = $_POST['sched'];
	echo $sched;

	$schedArray = array();
	$schedArray = split(" - ", $sched);

	$start = $schedArray[0];
	$ending = $schedArray[1];
	
	$count = count($_POST['id']);
		for ($i=0; $i <$count ; $i++) { 
			if ($result1 = $mysqli->query("SELECT * FROM emp_cutoff WHERE employee_id = '".$_POST["id"][$i]."'")) //get records from db
			{
				if ($result1->num_rows > 0) //display records if any
				{
					if ($stmt = $mysqli->prepare("UPDATE emp_cutoff SET empcut_initial = '".$schedArray[0]."', empcut_end = '".$schedArray[1]."' WHERE employee_id = '".$_POST["id"][$i]."'")){
						$stmt->execute();
						$stmt->close();

					}
					$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '".$_POST["id"][$i]."'");
					if ($attstatus->num_rows > 0) {
						$row101 = mysqli_fetch_object($attstatus);
						$attendance_status = $row101->attendance_status;
						if ($attendance_status=='Approved') {
							if ($stmt = $mysqli->query("UPDATE total_comp SET attendance_status = 'Pending' WHERE employee_id = '".$_POST["id"][$i]."'"))
							{
								echo "<script></script>";
								// $stmt->execute();
								// $stmt->close();

								//update cutoff table cutoff_sched_submission to submitted
								
							}
							if ($stmt = $mysqli->query("DELETE FROM total_comp WHERE employee_id = '".$_POST["id"][$i]."'"))
							{
								echo "<script></script>";
							}
						}
					}else{
						$attendance_status='';
					}
				}

				else {
					if ($stmt = $mysqli->prepare("INSERT INTO emp_cutoff (employee_id,empcut_initial,empcut_end) VALUES ('".$_POST["id"][$i]."','".$schedArray[0]."','".$schedArray[1]."')")){
						$stmt->execute();
						$stmt->close();
					}
				}
			}//end if
		}//end for loop


		$sql="UPDATE cutoff SET cutoff_sched_submission = 'Submitted' WHERE  cutoff_initial='$start' AND cutoff_end='$ending'";
		echo $sql;
		if ($stmt2 = $mysqli->query($sql))
		{
			//$stmt2->execute();
			//$stmt2->close();
			header("Location: attendanceapproval.php");
		}
		//header("Location: cutoff.php?changeCutoff");
		//header("Location: attendanceapproval.php");
}*/

if(isset($_GET['parts']) and $_GET['parts'] != '' and isset($_GET['earningtype']) and $_GET['earningtype'] != ''){
	// $days = $_POST['days'];
	// insert the new record into the database
	$parts = $_POST['parts'];
	$earningtype = $_POST['earningtype'];
	if ($check = $mysqli->query("SELECT * FROM earnings_settings")){
		
		if($check->num_rows > 0){

		echo 'swal({  title: "ERROR",   text: "Cutoff Already Exist",   timer: 3000, type: "warning",   showConfirmButton: false}); $("#myModal4").modal("hide"); $("#parts").val("");';
			return false;
		}
		else{
		$mysqli->query("INSERT INTO earnings_settings (earnings_name, earnings_type) VALUES ('$parts','$earningtype')");
		echo 'swal({  title: "Saved",   text: "Cutoff Saved",   timer: 3000, type: "success",   showConfirmButton: false}); $("#myModal4").modal("hide"); $("#parts").val("");';
			// return false;
		}
	}
}
?>