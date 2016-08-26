<?php
$dir    = 'C://xampp/htdocs/payroll';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);

// echo "<pre>";
// print_r($files1);
// //print_r($files2);
// echo "</pre>";

foreach ($files1 as $dir){
	echo $dir.": ";
	echo "<input type=text><br>";
}
?>