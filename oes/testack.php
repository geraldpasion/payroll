
<html>
<head>
<title>add question</title>

   <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



</head>



<body>  

<?php
error_reporting(0);
session_start();



include_once 'oesdb.php';
if(!isset($_SESSION['stdname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout']))
{
    //Log out and redirect login page
    unset($_SESSION['stdname']);
    header('Location: index.php');

}
else if(isset($_REQUEST['dashboard'])){
    //redirect to dashboard
   
     header('Location: stdwelcome.php');

}
if(isset($_SESSION['starttime']))
{
    unset($_SESSION['starttime']);
    unset($_SESSION['endtime']);
    unset($_SESSION['tqn']);
    unset($_SESSION['qn']);
    unset($_SESSION['duration']);
    executeQuery("update studenttest set status='over' where testid=".$_SESSION['testid']." and stdid=".$_SESSION['stdid'].";");
 

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>OES-Test Acknowledgement</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="oes.css"/>
    <script type="text/javascript" src="validate.js" ></script>
    </head>
  <body >
       <?php

        if($_GLOBALS['message']) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
     <body class="gray-bg">


<div class="container">
  <div class="page-header">
  <h1>ICONNECT Global Communications </h1>
</div>
<div class="panel panel-default">
  <div class="panel-body">

        <div id="container">
            <div class="col-md-12"></div>



  <div class="panel panel-default">
  <div class="panel-heading"><h3>View Result</h3></div>
  <div class="panel-body">



           <form id="editprofile" action="editprofile.php" method="post">
       
               <ul id="menu">
                        <?php if(isset($_SESSION['stdname'])) {
                         // Navigations
                         ?>
                        <li><input type="submit" value="LogOut" name="logout" class="btn btn-info" title="Log Out"/></li>
                        <li><input type="submit" value="Back" name="dashboard" class="btn btn-info" title="Dash Board"/></li>
                       

               </ul>
       
      <div class="page">
          <?php header('Location: viewresult.php');?>
          <?php
                        }
          ?>
      </div>

           </form>
    
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </body>
</html>

