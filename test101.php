<?php
date_default_timezone_set('Europe/London');

$d1 = new DateTime('2008-01-03 14:52:10');
$d2 = new DateTime('2008-01-03 11:11:10');
echo var_dump($d1 == $d2);
echo var_dump($d1 > $d2);
echo var_dump($d1 < $d2);
?>