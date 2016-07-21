<?php
include("dbconfig.php");
if(isset($_POST['sub'])){
	//$deduction = $_POST['deduction'];
	$initial = date("Y-m-d", strtotime($_POST['daterange2']));
	$end = $_POST['daterange3'];
	$amount = $_POST['amount'];
	$deductionname = $_POST['deductionname'];

	if($end == ""){
		$end = "0000-00-00";
	}else{
		$end = date("Y-m-d", strtotime($_POST['daterange3']));
	}

	$count = count($_POST['id']);

	for ($i=0; $i<$count; $i++) {

		$deductionsett = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_name = '$deductionname'");
		if ($deductionsett->num_rows > 0) {
			$row = mysqli_fetch_object($deductionsett);
			$deduction_id = $row->deduction_id;
			$deduction_type = $row->deduction_type;
			$deduction_max_amount = $row->deduction_max_amount;

			$totalcomp = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '".$_POST["id"][$i]."'");
			if($totalcomp->num_rows > 0) {
				$row1 = mysqli_fetch_object($totalcomp);
				$comp_id = $row1->comp_id;
				$cutoffdate = $row1->cutoff;
				$cutarray = array();
				$cutarray = split(" - ", $cutoffdate);
				$keydatefrom = $cutarray[0];
				$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
				$keydateto = $cutarray[1];
				$keydateto = date("Y-m-d", strtotime($keydateto));

				if(($end != "0000-00-00" && $end >= $keydatefrom) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){
					if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date, comp_id) VALUES ('$deduction_id','" . $_POST["id"][$i] . "', '$deductionname', '$amount', '$deduction_type', '$initial', '$end', '$comp_id')")){
						$stmt->execute();
					 	$stmt->close();
					}
				}
				else{
					if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date) VALUES ('$deduction_id','" . $_POST["id"][$i] . "', '$deductionname', '$amount', '$deduction_type', '$initial', '$end')")){
						$stmt->execute();
					 	$stmt->close();
					}
				}
			}
			else{
				if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date) VALUES ('$deduction_id','" . $_POST["id"][$i] . "', '$deductionname', '$amount', '$deduction_type', '$initial', '$end')")){
					$stmt->execute();
				 	$stmt->close();
				}
			}
			
		}
	}

	header("Location: deductions.php?addDeductions");
}else{
	$name = $_POST['name1'];
	$deduct_max = $_POST['reason1'];
	$deducttype = $_POST['deducttype1'];

	// insert the new record into the database
	if ($stmt = $mysqli->prepare("INSERT INTO deduction_settings (deduction_name, deduction_max_amount, deduction_type) VALUES ('$name', '$deduct_max', '$deducttype')"))
	{
		/*$mysqli->query("ALTER TABLE employee ADD COLUMN ".$name." VARCHAR(999) NOT NULL,
							ADD COLUMN ".$name."_idate DATE NOT NULL,
							ADD COLUMN ".$name."_edate DATE NOT NULL");*/
		$stmt->execute();
		$stmt->close();
	}
	// show an error if the query has an error
	else
	{
		echo "ERROR: Could not prepare SQL statement.";
	}
}
?>