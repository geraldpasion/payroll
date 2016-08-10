<html>
<head>
	<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert.css">
<script src="sweetalert2-master/dist/sweetalert.min.js"></script> 

</head>

<?php


include ("functions.php");
$sched = $_POST['cutoffsched'];
$submitdate = date("Y-m-d");
$schedArray = array();
$schedArray = split(" - ", $sched);

$emp_count=count_employees_within_cutoff($sched);
$timer=$emp_count*1000*2;

//generate loading screen

echo '<script>
swal({
  title: "Calculating!",
  text: "Please wait",
  imageUrl: "images/loading.gif",
  timer: '.$timer.'
});
</script>';

compute($sched,0,0,0);



//header("Location: attendanceapproval.php");
//die();
?>

<script>
//swal({title: "SUCCESS",text: "Cutoff Successfully Submitted",timer: 3000, type: "success",showConfirmButton: false});
</script>

<?php

header("Location: attendanceapproval.php");
die();

?>