<?php
	include('dbconfig.php');
	$choice = $_POST['choice'];
	$type = $_POST['type'];

	$elem4=$_POST['elem4'];
	$amount = '';

	if($choice == 'part'){
		if($type == 'earn'){
			if($stmt = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_name = '$elem4'")){
				if($stmt->num_rows > 0){
					while($row = $stmt->fetch_object()){
						$amount = $row->earnings_max_amount;
						echo("$('#amount').val('$amount');");
					}
				}
			}
		}
	}

?>