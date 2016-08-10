<?php
$from="conde@midtermproject.com";
$to="domdomconde@gmail.com";
$subject="Jake Libed";
//$message=$_POST['comment'];
$message="hello dom. narereceive mo? pero sino si matumbokon05@gmail.com?";

mail($to, $subject, $message, "From:" . $from);

print "Your message has been sent: </br>$to</br>$subject</br>$message</br>$from</p>";
?>