<?php

include 'functions.php';

/*$fields=get_fieldnames('philhealth_contribution');

$i=0;
foreach($fields as $field){
	echo "\$philhealth_details[]=\$row['".$field."']; //$i<br>";
	$i++;
}*/

$cutoff='2016-05-16 - 2016-06-16';

$count_emp=count_employees_within_cutoff($cutoff);

echo "Count: ".$count_emp.nextline();
?>