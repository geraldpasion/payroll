<?php

include 'functions.php';

$fields=get_fieldnames('philhealth_contribution');

$i=0;
foreach($fields as $field){
	echo "\$philhealth_details[]=\$row['".$field."']; //$i<br>";
	$i++;
}
?>