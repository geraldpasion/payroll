<?php
 session_start();
 unset($_SESSION['logsession']);
 
 if(session_destroy())
 {
  header("Location: login.php");
 }
?>