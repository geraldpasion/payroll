<?php 
include("dbconfig.php");
$str_explode=explode("-",$_POST["daterange"]);
$dateToday = date("Y-m-d");

$string1 = $str_explode[0];
$string1 = str_replace(' ', '', $string1);
$string1Array = split('/', $string1);
$string1 = $string1Array[2].'-'.$string1Array[0].'-'.$string1Array[1];

$string2 = $str_explode[1];
$string2 = str_replace(' ', '', $string2);
$string2Array = split('/', $string2);
$string2 = $string2Array[2].'-'.$string2Array[0].'-'.$string2Array[1];

if($dateToday < $string1) {
	$sched=$_POST["sched"];
	$schedArray = split('-', $sched);
	$schedArray[0] = substr($schedArray[0], 0, -3);
	$schedArray[1] = substr($schedArray[1], 0, -3);
	$sched = $schedArray[0].'-'.$schedArray[1];


	$usersCount = count($_POST["id"]);
	for($i=0;$i<$usersCount;$i++) {
		$empid = $_POST["id"][$i];
	//if ($stmt = $mysqli->prepare("UPDATE employee set employee_shift='" . $_POST["sched"] . "',date_start='".$string1."',date_end='".$string2."' WHERE employee_id='" . $_POST["id"][$i] . "'"))
	//if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_shift='".$_POST["sched"]."' WHERE employee_id = '".$_POST["id"][$i]."' AND attendance_date BETWEEN '$string1' AND '$string2'"))
	if ($stmt = $mysqli->prepare("UPDATE attendance SET attendance_shift='$sched' WHERE attendance_date BETWEEN '$string1' AND '$string2' AND employee_id = '$empid'"))
	{
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
	}
	header("Location: schedtest.php?edited");
} else {
	header("Location: schedtest.php?error");
}
?>