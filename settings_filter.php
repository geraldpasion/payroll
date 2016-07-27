
<?php
	include('dbconfig.php');
	$choice = $_GET['choice'];
	$type = $_GET['type'];	

	if($choice == 'Edit'){
		echo "<option value=''></option>";
		if($type == 'earn'){
			if($stmt = $mysqli->query("SELECT * FROM earnings_setting  ORDER BY earnings_id")){
				if($stmt->num_rows > 0){
					while($row = mysqli_fetch_object($stmt)){
						echo "<option>" . $row->earnings_name . "</option>";
					}
				}
			}
		}
	}

	if($choice == 'Taxable'){
		if($type == 'earn'){
			if($stmt = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_type = 'Taxable'")){
				if($stmt->num_rows > 0){
					echo "<option value=''></option>";
					while($row = $stmt->fetch_object()){
						echo "<option>" . $row->earnings_name . "</option>";
					}
				}
			}
		}		
	}
	if($choice == 'Non-Taxable'){
		if($type == 'earn'){
			if($stmt = $mysqli->query("SELECT * FROM earnings_setting WHERE earnings_type = 'Non-Taxable'")){
				if($stmt->num_rows > 0){
					echo "<option value=''></option>";
					while($row = $stmt->fetch_object()){
						echo "<option>" . $row->earnings_name . "</option>";
					}
				}			
			}
		}		
	}	

?>