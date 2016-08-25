
<?php
	include('dbconfig.php');
	$choice = $_GET['choice'];
	$empid = $_GET['empid'];
	if(!empty($_GET['elem'])){
		$elem=$_GET['elem'];
	}
	if(!empty($_GET['elem2'])){
		$elem2=$_GET['elem2'];
	}
	if(!empty($_GET['elem3'])){
		$elem3=$_GET['elem3'];
	}
	if(!empty($_GET['elem4'])){
		$elem4=$_GET['elem4'];
	}

	if($choice == 'Edit'){
		echo "<option value=''></option>";
		if($stmt = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid'")){
			if($stmt->num_rows > 0){
				while($row = $stmt->fetch_object()){
					echo "<option>" . $row->earn_name . "</option>";
				}
			}
		}
		if($stmt = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid'")){
			if($stmt->num_rows > 0){
				while($row = $stmt->fetch_object()){
					echo "<option>" . $row->deduct_name . "</option>";
				}
			}
		}
	}
	if($choice == 'New'){
		echo "<option value=''></option>";
		if($stmt = $mysqli->query("SELECT * FROM earnings_setting GROUP BY earnings_name")){
			if($stmt->num_rows > 0){
				while($row = $stmt->fetch_object()){
					echo "<option>" . $row->earnings_name . "</option>";
				}
			}
		}
		if($stmt = $mysqli->query("SELECT * FROM deduction_settings GROUP BY deduction_name")){
			if($stmt->num_rows > 0){
				while($row = $stmt->fetch_object()){
					echo "<option>" . $row->deduction_name . "</option>";
				}
			}
		}
	}
	if($choice == 'Earnings'){
		if($elem == 'Edit'){
			if($stmt = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid'")){
				if($stmt->num_rows > 0){
					echo "<option value=''></option>";
					while($row = $stmt->fetch_object()){
						echo "<option>" . $row->earn_name . "</option>";
					}
				}
			}
		}
		if($elem == 'New'){
			if($stmt = $mysqli->query("SELECT * FROM earnings_setting GROUP BY earnings_name")){
				if($stmt->num_rows > 0){
					echo "<option value=''></option>";
					while($row = $stmt->fetch_object()){
						echo "<option>" . $row->earnings_name . "</option>";
					}
				}
			}
		}
	}
	if($choice == 'Deductions'){
		if($elem == 'Edit'){
			if($stmt = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid'")){
				if($stmt->num_rows > 0){
					echo "<option value=''></option>";
					while($row = $stmt->fetch_object()){
						echo "<option>" . $row->deduct_name . "</option>";
					}
				}
			}
		}
		if($elem == 'New'){
			if($stmt = $mysqli->query("SELECT * FROM deduction_settings GROUP BY deduction_name")){
				if($stmt->num_rows > 0){
					echo "<option value=''></option>";
					while($row = $stmt->fetch_object()){
						echo "<option>" . $row->deduction_name . "</option>";
					}
				}
			}
		}
	}
	if($choice == 'Taxable'){
		if($elem == 'New'){
			if($elem2 == 'Earnings'){
				if($stmt = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_type = 'Taxable'  GROUP BY earnings_name")){
					if($stmt->num_rows > 0){
						echo "<option value='' disabled selected>Select Taxable Earning</option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earnings_name . "</option>";
						}
					}
				}
			}
			else if($elem2 == 'Deductions'){
				if($stmt = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_type = 'Taxable' GROUP BY deduction_name")){
					if($stmt->num_rows > 0){
						echo "<option value='' disabled selected>Select Taxable Deductions</option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduction_name . "</option>";
						}
					}
				}
			}
			else{
				echo "<option value=''></option>";
				if($stmt = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_type = 'Taxable'  GROUP BY earnings_name")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earnings_name . "</option>";
						}
					}
				}
				if($stmt = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_type = 'Taxable' GROUP BY deduction_name")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduction_name . "</option>";
						}
					}
				}
			}
		}

		if($elem == 'Edit'){
			if($elem2 == 'Earnings'){
				if($stmt = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid' AND earn_type = 'Taxable'")){
					if($stmt->num_rows > 0){
						echo "<option value=''></option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earn_name . "</option>";
						}
					}
				}
			}
			else if($elem2 == 'Deductions'){
				if($stmt = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid' AND deduct_type = 'Taxable'")){
					if($stmt->num_rows > 0){
						echo "<option value=''></option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduct_name . "</option>";
						}
					}
				}
			}
			else{
				echo "<option value=''></option>";
				if($stmt = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid' AND earn_type = 'Taxable'")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earn_name . "</option>";
						}
					}
				}
				if($stmt = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid' AND deduct_type = 'Taxable'")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduct_name . "</option>";
						}
					}
				}
			}
		}
	}
	if($choice == 'Non-Taxable'){
		if($elem == 'Edit'){
			if($elem2 == 'Earnings'){
				if($stmt = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid' AND earn_type = 'Non-Taxable'")){
					if($stmt->num_rows > 0){
						echo "<option value=''></option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earn_name . "</option>";
						}
					}
				}
			}
			else if($elem2 == 'Deductions'){
				if($stmt = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid' AND deduct_type = 'Non-Taxable'")){
					if($stmt->num_rows > 0){
						echo "<option value=''></option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduct_name . "</option>";
						}
					}
				}
			}
			else{
				echo "<option value=''></option>";
				if($stmt = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '$empid' AND earn_type = 'Non-Taxable'")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earn_name . "</option>";
						}
					}
				}
				if($stmt = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id = '$empid' AND deduct_type = 'Non-Taxable'")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduct_name . "</option>";
						}
					}
				}
			}
		}
		if($elem == 'New'){
			if($elem2 == 'Earnings'){
				if($stmt = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_type = 'Non-Taxable'  GROUP BY earnings_name")){
					if($stmt->num_rows > 0){
						echo "<option value='' disabled selected>Select Non-Taxable Earning</option>";
						echo "<option value=''></option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earnings_name . "</option>";
						}
					}
				}
			}
			else if($elem2 == 'Deductions'){
				if($stmt = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_type = 'Non-Taxable' GROUP BY deduction_name")){
					if($stmt->num_rows > 0){
						echo "<option value='' disabled selected>Select Non-Taxable Deductions</option>";
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduction_name . "</option>";
						}
					}
				}
			}
			else{
				echo "<option value=''></option>";
				if($stmt = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_type = 'Non-Taxable'  GROUP BY earnings_name")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->earnings_name . "</option>";
						}
					}
				}
				if($stmt = $mysqli->query("SELECT * FROM deduction_settings WHERE deduction_type = 'Non-Taxable' GROUP BY deduction_name")){
					if($stmt->num_rows > 0){
						while($row = $stmt->fetch_object()){
							echo "<option>" . $row->deduction_name . "</option>";
						}
					}
				}
			}
		}
	}



	
?>