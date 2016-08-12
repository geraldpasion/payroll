<?php 
include("dbconfig.php");
include 'payroll_compute.php';
$cutoffid = $_POST['cutoff_id1'];

// insert the new record into the database

if ($cutoff = $mysqli->query("SELECT * from cutoff WHERE cutoff_id = '$cutoffid'"))
{
	if($cutofffetch = $cutoff->fetch_object()){
		$cutoff_initial = $cutofffetch->cutoff_initial;
		$cutoff_end = $cutofffetch->cutoff_end;
		$cutoff_concat=$cutoff_initial." - ".$cutoff_end;

		if ($stmt2 = $mysqli->prepare("DELETE FROM cutoff WHERE cutoff_id = '$cutoffid'"))
		{
			$stmt2->execute();
			$stmt2->close();
		}
		else
		{
			echo "<br>" . mysqli_error($mysqli);
		}

		if ($stmt3 = $mysqli->prepare("DELETE FROM emp_cutoff WHERE empcut_initial = '$cutoff_initial' AND empcut_end = '$cutoff_end'"))
		{
			$stmt3->execute();
			$stmt3->close();
		}
		else
		{
			echo "<br>" . mysqli_error($mysqli);
		}

		if ($stmt4 = $mysqli->prepare("DELETE FROM total_comp WHERE cutoff = '".$cutoff_initial.' - '.$cutoff_end."'"))
		{
			$stmt4->execute();
			$stmt4->close();
		}
		else
		{
			echo "<br>" . mysqli_error($mysqli);
		}

		on_cutoff_delete($cutoff_concat);

}
else
{
	echo "<br>" . mysqli_error($mysqli);
}
}
// show an error if the query has an error
else
{
	echo "<br>" . mysqli_error($mysqli);
}
// redirec the user
?>