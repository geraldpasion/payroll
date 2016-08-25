<?php
 session_start();
 unset($_SESSION['logsession']);
 

session_unset(); 
session_destroy();
$_SESSION['login'] = FALSE;
 
  
  header("Location: login.php");
  exit;
 
?>