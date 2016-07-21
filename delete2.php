<?php
require "sqlconnection.php";
$deleteid = $_GET['id'];


mysqli_query($con, "DELETE FROM comment1 WHERE id='$deleteid'");


	$come = "Location: comment2.php?id=".$_GET['id2'];
	header($come);





?>