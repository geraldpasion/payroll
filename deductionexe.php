<?php
include("dbconfig.php");
include 'functions.php';
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

				if(($end != "0000-00-00" && (($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)) && ($end >= $keydatefrom || $end <= $keydateto))) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){
					if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date, comp_id) VALUES ('$deduction_id','" . $_POST["id"][$i] . "', '$deductionname', '$amount', '$deduction_type', '$initial', '$end', '$comp_id')")){
						$stmt->execute();
					 	$stmt->close();

					 	$emp_id=$_POST["id"][$i];
					 	//put update code here - gerald pasion
					 	//check_update($cutoffdate, $empids);
					 	header("Location: deductions.php?addDeductions");
					 	$comp_sal = $mysqli->query("SELECT * FROM total_comp_salary WHERE comp_id = '$comp_id'");
						if ($comp_sal->num_rows > 0) {
						 	compute($cutoffdate, 1, $emp_id, $comp_id);
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
			else{
				if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date) VALUES ('$deduction_id','" . $_POST["id"][$i] . "', '$deductionname', '$amount', '$deduction_type', '$initial', '$end')")){
					$stmt->execute();
				 	$stmt->close();
				}
			}
			header("Location: deductions.php?addDeductions");
		}
	}

	
}else{
	$name = $_POST['name1'];
	$deducttype = $_POST['deducttype1'];

	$name = trim($name," ");

	if($deductionsett = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_name = '$name'")){
		if ($deductionsett->num_rows > 0) {
			echo 'swal({  title: "ERROR",   text: "Deduction Already Exists!",   timer: 3000, type: "warning",   showConfirmButton: false});';
			return false;
		}
		else {
			// insert the new record into the database
			if ($stmt = $mysqli->prepare("INSERT INTO deduction_settings (deduction_name, deduction_type) VALUES ('$name', '$deducttype')"))
			{
				$stmt->execute();
				$stmt->close();

				echo 'swal({title: "SUCCESS",text: "Deduction Successfully Added",timer: 1000, type: "success",showConfirmButton: false}); window.setTimeout(function(){location.reload();}, 1000);';
				//header("Location: earnings.php?added");
			}
			// show an error if the query has an error
			else
			{
				echo "ERROR: Could not prepare SQL statement.";
			}	
		}
	}
}
?>