<?php 
include("dbconfig.php");

$usersCount = count($_POST["id"]);

$leavetype = $_POST["leavetype"];
$action = $_POST["action"];
$leavecredit = $_POST["leavecredit"];

for($i=0;$i<$usersCount;$i++) {
	if($leavetype == 'Paid rest day / Incentive'){
		if($action == '1'){
			if ($result = $mysqli->query("SELECT employee_incentive FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_incentive;
						$total_credits = $credits + $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_incentive='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
		else if($action == '2'){
			
			if ($stmt = $mysqli->prepare("UPDATE employee set employee_incentive='" . $leavecredit . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
		else {		
			if ($result = $mysqli->query("SELECT employee_incentive FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_incentive;
						$total_credits = $credits - $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_incentive='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	}


	else if($leavetype == 'Vacation leave'){
		if($action == '1'){		
			if ($result = $mysqli->query("SELECT employee_vacationleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_vacationleave;
						$total_credits = $credits + $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_vacationleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
		else if($action == '2'){	
			if ($stmt = $mysqli->prepare("UPDATE employee set employee_vacationleave='" . $leavecredit . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
	
		else {
			if ($result = $mysqli->query("SELECT employee_vacationleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_vacationleave;
						$total_credits = $credits - $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_vacationleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	}

	else if($leavetype == 'Sick leave'){
		if($action == '1'){
			if ($result = $mysqli->query("SELECT employee_sickleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_sickleave;
						$total_credits = $credits + $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_sickleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	
		else if($action == '2'){
			if ($stmt = $mysqli->prepare("UPDATE employee set employee_sickleave='" . $leavecredit . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
		else {
			if ($result = $mysqli->query("SELECT employee_sickleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_sickleave;
						$total_credits = $credits - $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_sickleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
						{
							$stmt->execute();
							$stmt->close();
						}
						// show an error if the query has an error
						else
						{
							echo "ERROR: Could not prepare SQL statement.";
						}					}
				}
			}
		}
	}

	else if($leavetype == 'Maternity leave'){
		if($action == '1'){
			if ($result = $mysqli->query("SELECT employee_maternityleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_maternityleave;
						$total_credits = $credits + $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_maternityleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
						{
							$stmt->execute();
							$stmt->close();
						}
						// show an error if the query has an error
						else
						{
							echo "ERROR: Could not prepare SQL statement.";
						}					}
				}
			}
		}
	
		else if($action == '2'){
			if ($stmt = $mysqli->prepare("UPDATE employee set employee_maternityleave='" . $leavecredit . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
	
		else {
			if ($result = $mysqli->query("SELECT employee_maternityleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_maternityleave;
						$total_credits = $credits - $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_maternityleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	}

	else if($leavetype == 'Paternity leave'){
		if($action == '1'){
			if ($result = $mysqli->query("SELECT employee_paternityleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_paternityleave;
						$total_credits = $credits + $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_paternityleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	
		else if($action == '2'){
			if ($stmt = $mysqli->prepare("UPDATE employee set employee_paternityleave='" . $leavecredit . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
	
		else {
			if ($result = $mysqli->query("SELECT employee_paternityleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_paternityleave;
						$total_credits = $credits - $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_paternityleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	}

	else{
		if($action == '1'){
			if ($result = $mysqli->query("SELECT employee_singleparentleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_singleparentleave;
						$total_credits = $credits + $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_singleparentleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	
		else if($action == '2'){
			if ($stmt = $mysqli->prepare("UPDATE employee set employee_singleparentleave='" . $leavecredit . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
	
		else {
			if ($result = $mysqli->query("SELECT employee_singleparentleave FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) 
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$credits = $row->employee_singleparentleave;
						$total_credits = $credits - $leavecredit;
						if ($stmt = $mysqli->prepare("UPDATE employee set employee_singleparentleave='" . $total_credits . "' WHERE employee_id='" . $_POST["id"][$i] . "'"))
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
				}
			}
		}
	}

	/*if ($result = $mysqli->query("SELECT * FROM employee WHERE employee_id='" . $_POST["id"][$i] . "'")) {
		if ($result->num_rows > 0){
			while ($row = $result->fetch_object()){
				$inc = $row->employee_incentive;
				$vl = $row->employee_vacationleave;
				$sl = $row->employee_sickleave;
				$ml = $row->employee_maternityleave;
				$pl = $row->employee_paternityleave;
				$spl = $row->employee_singleparentleave;
				$date = date('Y-m-d');
				if ($stmt = $mysqli->prepare("INSERT INTO leave_logs (employee_id, date, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('" . $_POST["id"][$i] . "', '".$date."', '".$sl."', '".$vl."', '".$inc."', '".$ml."', '".$pl."', '".$spl."')"))
				{
					$stmt->execute();
					$stmt->close();
				}
				// show an error if the query has an error
				else{
					echo "ERROR: Could not prepare SQL statement.";
				}
			}
		}
	}*/
	/*if ($result = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id='" . $_POST["id"][$i] . "' AND leave_status='Approved'")) {
		if ($result->num_rows > 0){
			while ($row = $result->fetch_object()){
				$lt = $row->leave_type;
				//$vl = $row->employee_vacationleave;
				//$sl = $row->employee_sickleave;
				//$ml = $row->employee_maternityleave;
				//$pl = $row->employee_paternityleave;
				//$spl = $row->employee_singleparentleave;
				$date = date('Y-m-d');
			if($lt == 'Sick leave'){
				if ($stmt = $mysqli->prepare("INSERT INTO leave_logs (employee_id, date, employee_sickleave, employee_vacationleave, employee_incentive, employee_maternityleave, employee_paternityleave, employee_singleparentleave) VALUES ('" . $_POST["id"][$i] . "', '".$date."', '-1', '0', '0', '0', '0', '0')"))
				{
					$stmt->execute();
					$stmt->close();
				}
				// show an error if the query has an error
				else{
					echo "ERROR: Could not prepare SQL statement.";
				}
			}
			}
		}
	}*/
	header("Location: leavecreditsmanagement.php?edited");	
}


?>