<?php

//from db
$attendance_shift = '22:00-07:00';
$attendance_date = '2016-03-13'; //date
$next_day = '2016-03-14';
//user input

$employee_id = '55'; //varchar
$timein = '01:00';
$timeout = '07:00';

$timein = $next_day." ".$timein;
echo $timein."<br><br>";

//check if ND

$timein_conv = strtotime($timein);
$timeout_conv = strtotime($timeout);


$usertimein= new DateTime($timein); //varchar
$usertimeout= new DateTime($timeout); //varchar


//compute for attendance_hours, attendance_late, attendance_overtime, attendance_absent


//main
$shift=explode("-", $attendance_shift);

$shift[0]=$attendance_date." ".$shift[0];

$db_start = strtotime($shift[0]);
$db_end = strtotime($shift[1]);

$start = new DateTime($shift[0]);
$end = new DateTime($shift[1]);

echo $timein_conv." ".$timeout_conv."<br>";
echo $db_start." ".$db_end."<br>";



//computation for late
if($timein_conv>$db_start){
$diff = $usertimein->diff( $start );
echo $diff->format( '%H:%I' )."<br>"; // -> 00:25:25
$timestring = $diff->format( '%H:%I' );
$parsed = date_parse($timestring);
$late_minutes = $parsed['hour'] * 60 + $parsed['minute'];
}
else
	$late_minutes=0;

echo "Total Late Minutes: ".$late_minutes."<br>";

//computation for undertime
if($timeout_conv<$db_end){
$diff = $end->diff( $usertimeout );
echo $diff->format( '%H:%I' )."<br>"; // -> 00:25:25
$timestring = $diff->format( '%H:%I' );
$parsed = date_parse($timestring);
$ut_minutes = $parsed['hour'] * 60 + $parsed['minute'];
}
else
	$ut_minutes=0;

echo "Total UT Minutes: ".$ut_minutes."<br>";


//computation for overtime
if($timeout_conv>$db_end){
$diff = $usertimeout->diff( $end );
echo $diff->format( '%H:%I' )."<br>"; // -> 00:25:25
$timestring = $diff->format( '%H:%I' );
$parsed = date_parse($timestring);
$ot_minutes = $parsed['hour'] * 60 + $parsed['minute'];
}
else
	$ot_minutes=0;

echo "Total OT Minutes: ".$ot_minutes."<br>";


?>

