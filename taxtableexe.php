<?php 
include("dbconfig.php");

$fields=array(
'tax_id',
'TaxType',
'TaxCode',
'Level',
'GrossCheck',
'FixedTaxAmount',
'PercentOver'
);


foreach($fields as $field){
	$$field=$_POST[$field];

	echo $$field."<br>";
}



// insert the new record into the database
if ($stmt = $mysqli->prepare("UPDATE taxtable_meta 
	SET GrossCheck = '$GrossCheck', 
	FixedTaxAmount = '$FixedTaxAmount', 
	PercentOver = '$PercentOver'
	WHERE tax_id = '$tax_id'
	AND Level='$Level'" ))
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
header("Location: taxtable.php?edited");
?>