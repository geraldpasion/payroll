<?php
$date = date("Y-m-d",strtotime($_POST['date'])); 
$days = $_POST['days'];
// insert the new record into the database
if ($stmt1 = $mysqli->prepare("DELETE FROM cutoff WHERE cutoff_id='1'"))
{
	$stmt1->execute();
	$stmt1->close();
}
if ($stmt = $mysqli->prepare("SELECT * FROM cutoff WHERE cutoff_initial = '$date' and cutoff_days = '$days'"))
	if($stmt->num_rows > 0){
		swal({  title: "ERROR",   text: "Cutoff Already Exist",   timer: 3000, type: "warning",   showConfirmButton: false});
			return false;
			
	}else{
		if ($stmt = $mysqli->prepare("INSERT INTO cutoff (cutoff_id, cutoff_initial, cutoff_days) VALUES ('1', '$date', '$days')"))
		{
			$stmt->execute();
			$stmt->close();
		}
	}
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
echo "Form Submitted Succesfully";
?>