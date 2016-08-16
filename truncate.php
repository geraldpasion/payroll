<?php
include 'dbconfig.php';

//mysql_select_db('payroll');

$tables=array(
	'totalcomputation', 
	'totalcomputation_meta', 
	'total_comp', 
	'total_hours', 
	'total_comp_salary',
	'others',
	'cutoff'
	);

foreach($tables as $tab){
$sql='TRUNCATE TABLE '.$tab;
echo $sql."<br>";
$result = mysqli_query($conn,$sql);

 if ($result) {
   echo "$tab table has been truncated<br>";  
 }
 else echo "Something went wrong: " . mysql_error();
}
?>