<?php
include("dbconfig.php");
if(isset($_POST['submit']))
{  
  $mail=$_POST['email'];
  $username=$_POST['username'];
  $sql= "SELECT employee_password FROM employee WHERE employee_email ='".$mail."' AND employee_id ='".$username."'";

  if ($result = $mysqli->query($sql)) //get records from db
  {
    if ($result->num_rows > 0) //display records if any
    {
      while ($row = $result->fetch_object())
      {
        $to=$mail;
        $subject='Remind password';
        $message='Your password : '.$row->employee_password; 
        $headers='From:iConnectHRIS@gmail.com';
        $m=mail($to,$subject,$message,$headers);
      }
      if($m)
      {
        echo'<script> alert("Check your inbox in mail"); </script>';
        header("Location: index.php");
      }
      else
      {
       //echo'mail is not send';
        echo'<script> alert("mail is not send"); </script>';
        header("Location: index.php");
      }
    }
    else
    {
      //echo'You entered mail id is not present';
      echo'<script> alert("You entered mail id is not present");</script>';
      exit();
      header("Location: index.php");
    }
  }
}
?>