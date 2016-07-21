<?php 
include("dbconfig.php");
$id = $_POST['id'];
$one = $_POST['one'];
$two = $_POST['two'];
$three = $_POST['three'];
$four = $_POST['four'];
$five = $_POST['five'];
$six = $_POST['six'];
$seven = $_POST['seven'];
$eight = $_POST['eight'];




// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE witholding_tax SET Withholding_tax1 = '$one', Withholding_tax2 = '$two', Withholding_tax3 = '$three', Withholding_tax4 = '$four', Withholding_tax5 = '$five', Withholding_tax6 = '$six', Withholding_tax7 = '$seven', Withholding_tax8 = '$eight' WHERE Tax_ID = '$id'"))
{
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}
// redirec the user
header("Location: birtable.php?edited");
?>