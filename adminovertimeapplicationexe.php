<?php
include("dbconfig.php");
if(isset($_POST['submit'])){
	$end = $_POST['timeto'];
	$end = str_replace(' ', '', $end);
	$end = substr_replace($end, '', 5, 1);
	$end = date("H:i", strtotime($end));
	$reason = $_POST['reason'];
	$start = $_POST['timefrom'];
	$start = str_replace(' ', '', $start);
	$start = substr_replace($start, '', 5, 1);
	$start = date("H:i", strtotime($start));
	$name = $_POST['name'];
	$date = date("Y-m-d",strtotime($_POST['daterange']));

	$id = filter_var($name, FILTER_SANITIZE_NUMBER_INT);
	$id = str_replace(' ', '', $id);

	$ot_date = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$id' AND overtime_date = '$date'");
	if ($ot_date->num_rows > 0) {
		header("Location: adminovertimeapplication.php?disabled");
	}
	else {
		// insert the new record into the database
		if ($stmt = $mysqli->prepare("INSERT INTO overtime (employee_id, overtime_date, overtime_start, overtime_end, overtime_reason) VALUES ('$id','$date','$start','$end', '$reason')"))
		{
			$stmt->execute();
			$stmt->close();
			header("Location: adminovertimeapplication.php?applied");
		}
	}
}
if(isset($_POST['submit2'])){
	$end = $_POST['timeto'];
	$end = str_replace(' ', '', $end);
	$end = substr_replace($end, '', 5, 1);
	$end = date("H:i", strtotime($end));
	$reason = $_POST['reason'];
	$start = $_POST['timefrom'];
	$start = str_replace(' ', '', $start);
	$start = substr_replace($start, '', 5, 1);
	$start = date("H:i", strtotime($start));
	$name = $_POST['name'];
	$date = date("Y-m-d",strtotime($_POST['daterange']));

	$id = filter_var($name, FILTER_SANITIZE_NUMBER_INT);
	$id = str_replace(' ', '', $id);

	$ot_date = $mysqli->query("SELECT * FROM overtime WHERE employee_id = '$id' AND overtime_date = '$date'");
	if ($ot_date->num_rows > 0) {
		header("Location: adminovertimeapplication2.php?disabled");
	}
	else {
		// insert the new record into the database
		if ($stmt = $mysqli->prepare("INSERT INTO overtime (employee_id, overtime_date, overtime_start, overtime_end, overtime_reason) VALUES ('$id','$date','$start','$end', '$reason')"))
		{
			$stmt->execute();
			$stmt->close();
			header("Location: adminovertimeapplication2.php?applied");
		}
	}
}
?>