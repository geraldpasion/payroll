<?php
include 'dbconfig.php';

//mysql_select_db('payroll');

$tables=array(
	'totalcomputation', //main summary of computations
	'totalcomputation_meta', 
	'total_comp', //total hours ng attendance within cutoff, nabubura to kaya..
	'total_hours', //duplicate of total_comp, hindi nabubura
	'total_comp_salary', //similar to total_hours, but converted to money
	//'others', //retro
	'cutoff',

	//'announcement',
	//'emp_earnings', //other taxable/non-taxable earnings
	//'emp_deductions' //other taxable/non-taxable deductions
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