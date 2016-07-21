<?php
include("dbconfig.php");
$conn=mysql_connect("localhost",$user,$pass) or die(mysql_error());
$db=mysql_select_db("payroll",$conn);
?>