<?php

date_default_timezone_set("Asia/Manila");

$time_now = date("G:i");
echo $time_now;
$time  = date("G:i", strtotime($time_now) + 72000);
echo "<br>".$time;

$timein = date("G:i");
$nxtAvailableLogin = date("G:i", strtotime($timein) + 72000);

echo "<br>".$timein;

$time2 = "19:00";
$time2Res = date("G:i", (strtotime($time2) - 60*60*7.72)-3600);
echo '<br>'.$time2Res;
?>