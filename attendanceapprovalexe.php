<?php
include("dbconfig.php");
include 'functions.php';

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

			compute($sched,0,0,0);
			echo 'swal({title: "SUCCESS",text: "Cutoff Successfully Submitted",timer: 1000, type: "success",showConfirmButton: false}); ';
			$stmt->execute();
			$stmt->close();
			
			//curlphp();
		}
	}
}


/*function curlphp(){


// create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "perf_func.php"); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);    

}*/

?>