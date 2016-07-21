<?php 
include("dbconfig.php");
    $str_explode=explode("-",$_POST["daterange"]);
$string1 = $str_explode[0];
$newDate1 = date("Y-m-d", strtotime($string1));
$string2 = $str_explode[1];
$newDate2 = date("Y-m-d", strtotime($string2));

$usersCount = count($_POST["id"]);

$shift=explode("-",$_POST["sched"]);
$shift1 = $shift[0];
$shift2 = $shift[1];
$shift1 = date("H:i", strtotime($shift1));
$shift2 = date("H:i", strtotime($shift2));
$final = $shift1."-".$shift2;

for($i=0;$i<$usersCount;$i++) {

if ($stmt = $mysqli->prepare("UPDATE employee set employee_shift='" . $final . "',date_start='".$newDate1."',date_end='".$newDate2."' WHERE employee_id='" . $_POST["id"][$i] . "'"))
{
	$stmt->execute();
	$stmt->close();
	header("Location: schedtest.php?changeShift");
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
}
?>