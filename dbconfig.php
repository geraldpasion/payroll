<?php
//server info
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'payroll';
	
// connect to database
	$mysqli = new mysqli($server, $user, $pass, $db);


//alternative
	$conn = new mysqli($server, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
//show errors remove on live site
	// 	if ($resultss = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_id = '1'")){
	// 	while ($rowss = mysqli_fetch_object($resultss)){
	// 		$idcut=$rowss->cutoff_id;
	// 		$initcut=$rowss->cutoff_initial;
	// 		$daycut=$rowss->cutoff_days;
	// 	}
	// 	if(isset($idcut)){
	// 		$tdays=' + '.$daycut.' days';
	// 		$nd = date('Y-m-d', strtotime($initcut. $tdays));
	// 		if($nd == date('Y-m-d')){
	// 			$resultbs = $mysqli->query("UPDATE cutoff SET cutoff_id = '1',cutoff_initial = '".date('Y-m-d')."',cutoff_days='".$daycut."' ");
	// 		}
	// 	}
	// }
?>