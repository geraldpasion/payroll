<?php
include("dbconnect.php");

if(isset($_POST['sub'])){
$earning = $_POST['earning'];
$initial = date("Y-m-d", strtotime($_POST['daterange2']));
$end = $_POST['daterange3'];
$amount = $_POST['amount'];

if($end == ""){
	$end = "0000-00-00";
}else{
	$end = date("Y-m-d", strtotime($_POST['amount']));
}

$count = count($_POST['id']);

for($i=0; $i<$count; $i++){
	for ($i=0; $i<$count; $i++) { 
		if ($stmt = $mysqli->prepare("UPDATE employee set ".$earning."='$amount', ".$earning."_idate='$initial', ".$earning."_edate='$end' WHERE employee_id='" . $_POST["id"][$i] . "'")){
			$stmt->execute();
			$stmt->close();
		}
		header("Location: earnings.php?addEarnings");
	}
}
}

?>