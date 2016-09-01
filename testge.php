<?php

//include 'dbconfig.php';


 $dateToday = date("Y-m-d");

 echo "dateToday: ".$dateToday."<br>";


$end = '5 : 00 : PM';
//$isAbsent = $_POST['isabsent'];
//$reason = $_POST['reason1'];
$start = '8 : 00 : AM';
$breakin = '1 : 00 : PM';
$breakout = '12 : 00 : PM';

// $strtotimeend = strtotime($end);
// echo "strtotime end: ".$strtotimeend."<br>";
// echo "timetostr end: ".date("H:i",time($strtotimeend))."<br>";

 $end = str_replace(' ', '', $end);
 $count=strlen($end);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
 $end = substr_replace($end, '', $replace_count, 1);
 $end = date("G:i", strtotime($end));

$start = str_replace(' ', '', $start);
 $count=strlen($start);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
$start = substr_replace($start, '', $replace_count, 1);
$start = date("G:i", strtotime($start));

$breakin = str_replace(' ', '', $breakin);
 $count=strlen($breakin);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
$breakin = substr_replace($breakin, '', $replace_count, 1);
$breakin = date("G:i", strtotime($breakin));

$breakout = str_replace(' ', '', $breakout);
 $count=strlen($breakout);
 echo "count: ".$count."<br>";
 if($count==7)
 	$replace_count=4;
 else
 	$replace_count=5;
$breakout = substr_replace($breakout, '', $replace_count, 1);
$breakout = date("G:i", strtotime($breakout));

echo 'start: '.$start."<br>";
echo 'breakout: '.$breakout."<br>";
echo 'breakin: '.$breakin."<br>";
echo 'end: '.$end."<br>";
// 	$sql = "SELECT * FROM employee WHERE shift_temp_start>='$dateToday'";
// 	$result = mysqli_query($mysqli,$sql);

// 	while($row = mysqli_fetch_array($result)){
// 		$pending_shift=$row['pending_shift'];

// 		//update
// 		$sql = "UPDATE employee SET employee_shift=$pending_shift, pending_shift=null";

// 			if ($conn->query($sql) === TRUE) {
// 			    //echo $hasdate." Record updated successfully employee ".$empid."<br>";
			    
// 			} else {
// 			    //echo $hasdate." Error updating record employee ".$empid.": " . $conn->error."<br>";
// 			    //header("Location: schedtest.php?error");
// 			}
		
// 	}

?>