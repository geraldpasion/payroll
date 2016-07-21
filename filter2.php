<?php
	include('dbconfig.php');
//	if (isset($_GET['particularsel1'])) {
		$elem2=$_POST['elem2'];
		$elem3=$_POST['elem3'];
		$elem4=$_POST['elem4'];
		$empid=$_POST['empid'];

		$frmdate = '';
	  $todate = '';
	  $amount = '';
		if($elem2 == 'Earnings'){
			if($stmt = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid' AND earn_name = '$elem4'")){
				if($stmt->num_rows > 0){
					while($row = $stmt->fetch_object()){
						$frmdate = $row->initial_date;
						$todate = $row->end_date;
						$amount = $row->earn_max;
						echo("$('#fromdate').val('$frmdate');");
						echo("$('#todate').val('$todate');");
						echo("$('#amount').val('$amount');");
					}
				}
			}
		}
		if($elem2 == 'Deductions'){
			if($stmt = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid' AND deduct_name = '$elem4'")){
				if($stmt->num_rows > 0){
					while($row = $stmt->fetch_object()){
						$frmdate = $row->initial_date;
						$todate = $row->end_date;
						$amount = $row->deduct_max;
						echo("$('#fromdate').val('$frmdate');");
						echo("$('#todate').val('$todate');");
						echo("$('#amount').val('$amount');");
					}
				}
			}
		}
	
?>