<?php 
include("dbconfig.php");
if (isset($_POST['leavetype'])){


if ($stmt = $mysqli->prepare("update payrollfactor set factor='".$_POST['leavetype']."' where id = 1"))
{
	$stmt->execute();
	$stmt->close();
	header("Location: payrollfactor.php");
}
// show an error if the query has an error
else

{
	echo "ERROR: Could not prepare SQL statement.";
}
}

header("Location: payrollfactor.php");



?>