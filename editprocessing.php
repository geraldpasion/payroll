<script> alert('omggggg');</script>
<?php
	include("dbconfig.php");
	//if(isset($_POST['editsub'])){

		/*$empid = $_POST['empid'];
		$action = $_POST['actionsel'];
		$earndeduct = $_POST['earndeduct'];
		$type = $_POST['type'];
		//$recurrence = $_POST['recurrence'];
		$amount = $_POST['amount'];
		$particular = $_POST['particularsel'];
		$selection = $_POST['cutsel'];
		$initial = date("Y-m-d", strtotime($_POST['daterange2']));
		$end = $_POST['daterange3'];

		if($end == ""){
		$end = "0000-00-00";
		}else{
			$end = date("Y-m-d", strtotime($_POST['daterange3']));
		}

		if($action == 'New') {
			if($earndeduct == 'Earnings'){
				if($stmt2 = $mysqli->prepare("INSERT INTO earnings_setting (earnings_name, earnings_max_amount, earnings_type) VALUES ('$particular','$amount','$type')")){
					$stmt2->execute();
					$stmt2->close();
				}
				$earningsett = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_name = '$particular'");
				if ($earningsett->num_rows > 0) {
					$row = mysqli_fetch_object($earningsett);
					$earnings_id = $row->earnings_id;
					$earnings_type = $row->earnings_type;
					$earnings_max_amount = $row->earnings_max_amount;

					$totalcomp = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
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
							if($stmt = $mysqli->prepare("INSERT INTO emp_earnings (earnings_setting_id, employee_id, earn_name, earn_max, earn_type, initial_date, end_date, comp_id) VALUES ('$earnings_id','$empid', '$particular', '$amount', '$type', '$initial', '$end', '$comp_id')")){
								$stmt->execute();
							 	$stmt->close();
							}
						}
						else{
							if($stmt = $mysqli->prepare("INSERT INTO emp_earnings (earnings_setting_id, employee_id, earn_name, earn_max, earn_type, initial_date, end_date) VALUES ('$earnings_id','$empid', '$particular', '$amount', '$type', '$initial', '$end')")){
								$stmt->execute();
							 	$stmt->close();
							}
						}
					}
					else{
						if($stmt = $mysqli->prepare("INSERT INTO emp_earnings (earnings_setting_id, employee_id, earn_name, earn_max, earn_type, initial_date, end_date) VALUES ('$earnings_id','$empid, '$particular', '$amount', '$type', '$initial', '$end')")){
							$stmt->execute();
						 	$stmt->close();
						}
					}				
				}
			}
			if($earndeduct == 'Deductions'){
				if($stmt2 = $mysqli->prepare("INSERT INTO deduction_settings (deduction_name, deduction_max_amount, deduction_type) VALUES ('$particular','$amount','$type')")){
					$stmt2->execute();
					$stmt2->close();
				}
				$deductionsett = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_name = '$particular'");
				if ($deductionsett->num_rows > 0) {
					$row = mysqli_fetch_object($deductionsett);
					$deduction_id = $row->deduction_id;
					$deduction_type = $row->deduction_type;
					$deduction_max_amount = $row->deduction_max_amount;

					$totalcomp = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid'");
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
							if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date, comp_id) VALUES ('$deduction_id','$empid', '$particular', '$amount', '$type', '$initial', '$end', '$comp_id')")){
								$stmt->execute();
							 	$stmt->close();
							}
						}
						else{
							if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date) VALUES ('$deduction_id','$empid', '$particular', '$amount', '$type', '$initial', '$end')")){
								$stmt->execute();
							 	$stmt->close();
							}
						}
					}
					else{
						if($stmt = $mysqli->prepare("INSERT INTO emp_deductions (deductions_setting_id, employee_id, deduct_name, deduct_max, deduct_type, initial_date, end_date) VALUES ('$deduction_id','$empid', '$particular', '$amount', '$type', '$initial', '$end')")){
							$stmt->execute();
						 	$stmt->close();
						}
					}
					
				}
			}
			header("Location: processing2.php?edited");					
		}*/

		/*if($action == 'Edit'){
			if($earndeduct == 'Earnings'){
				$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid' AND cutoff='$selection'");
				if ($attstatus->num_rows > 0) {
					$row101 = mysqli_fetch_object($attstatus);
					$comp_id = $row101->comp_id;
					$cutoffdate = $row101->cutoff;
					$cutarray = array();
					$cutarray = split(" - ", $cutoffdate);
					$keydatefrom = $cutarray[0];
					$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
					$keydateto = $cutarray[1];
					$keydateto = date("Y-m-d", strtotime($keydateto));

					if(($end != "0000-00-00" && $end >= $keydatefrom) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){
						if($stmt = $mysqli->prepare("UPDATE emp_earnings SET earn_max = '$amount', initial_date = '$initial', end_date = '$end', comp_id = '$comp_id' WHERE employee_id = '$empid' AND earn_name = '$particular' AND earn_type = 'type'")){
							$stmt->execute();
						 	$stmt->close();
						}
					}
				}
			}

			if($earndeduct == 'Deductions'){
				$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '$empid' AND cutoff='$selection'");
				if ($attstatus->num_rows > 0) {
					$row101 = mysqli_fetch_object($attstatus);
					$comp_id = $row101->comp_id;
					$cutoffdate = $row101->cutoff;
					$cutarray = array();
					$cutarray = split(" - ", $cutoffdate);
					$keydatefrom = $cutarray[0];
					$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
					$keydateto = $cutarray[1];
					$keydateto = date("Y-m-d", strtotime($keydateto));
					if(($end != "0000-00-00" && $end >= $keydatefrom) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){
						if($stmt = $mysqli->prepare("UPDATE emp_deductions SET deduct_max = '$amount', initial_date = '$initial', end_date = '$end', comp_id = '$comp_id' WHERE employee_id = '$empid' AND deduct_name = '$particular' AND deduct_type = 'type'")){
							$stmt->execute();
						 	$stmt->close();
						}
					}
				}
			}	
			header("Location: processing2.php?edited");			
		}*/
		/*if($stmt = $mysqli->prepare("UPDATE total_comp_salary SET  WHERE employee_id = '$empid' ")){
			$stmt->execute();
		 	$stmt->close();
		}*/
//	}

?>