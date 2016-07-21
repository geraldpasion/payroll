<?php



include('sqlconnection.php');
require "sqlconnection.php";
$id = $_GET['id'];

$result = mysqli_query($con, "SELECT * FROM image WHERE p_id > ".$id." ORDER BY p_id LIMIT 1");
while($row = mysqli_fetch_array($result)){



$yeah=$row['p_id'];
	
	header("Location: comment.php?id=".$yeah);	

}
?>