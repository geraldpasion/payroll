
<?php
require "sqlconnection.php";
$deleteid = $_GET['id'];

mysqli_query($con, "DELETE FROM image WHERE p_id='$deleteid'");

	
require "images2.php";

 



?>