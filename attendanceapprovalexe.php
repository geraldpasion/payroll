<?php
include("dbconfig.php");

// $cutoffsubmit = $_POST['cutoff_submission'];
$sched = $_POST['sched'];
$submitdate = date("Y-m-d");
$schedArray = array();
$schedArray = split(" - ", $sched);
// insert the new record into the database
	
if ($check = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_submission = 'Submitted' AND cutoff_initial = '$schedArray[0]' AND cutoff_end = '$schedArray[1]'")){
	if($check->num_rows > 0){

		echo 'swal({  title: "ERROR",   text: "Cutoff Already Submitted",   timer: 3000, type: "warning",   showConfirmButton: false}); $("#myModal4").modal("hide"); $("#daterange2").val(""); $("#daterange3").val("");';
			return false;
	}else{

		if ($stmt = $mysqli->prepare("UPDATE cutoff SET cutoff_status = 'Inactive', cutoff_submission = 'Submitted', cutoff_submitdate='$submitdate' WHERE cutoff_initial = '$schedArray[0]' AND cutoff_end = '$schedArray[1]'"))
		{
			$stmt->execute();
			$stmt->close();
			echo 'swal({  title: "SUCCESS",   text: "Cutoff Submitted",   timer: 3000, type: "success",   showConfirmButton: false}); $("#myModal4").modal("hide"); $("#daterange2").val(""); $("#daterange3").val("");';                   
		}
	}
}
?>