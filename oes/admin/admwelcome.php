<html>
<head>
<title></title>

   <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



</head>




<?php
error_reporting(0);
/********************* Step 1 *****************************/
session_start();
        if(!isset($_SESSION['admname'])){
            $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
        }
        else if(isset($_REQUEST['logout'])){
           unset($_SESSION['admname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
            header('Location: index.php');
        }
?>



        <?php
       /********************* Step 2 *****************************/
        if(isset($_GLOBALS['message'])) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
     
       <head>

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
  <div class="panel-heading"><h3>Online Examination</h3></div>
  <div class="panel-body">


          

  </head>        

                <form name="admwelcome" action="admwelcome.php" method="post">
                  

                        <?php if(isset($_SESSION['admname'])){ ?>
                          <div class="row">
                          <div class="col-md-10">
                          </div>
                          <div class="col-md-2">
                        <button input type="submit" value="LogOut" name="logout" class="btn btn-info" title="Log Out"/>Log Out</button>
                        <?php } ?>
            </div>
        </div>

        






            <div class="admpage">
                <?php if(isset($_SESSION['admname'])){ ?>
                <div class="row">
                  <div class="col-md-2">
                  </div>
                  
            <div class="row">
             <div class="col-md-2">
                    <a href="usermng.php" class="btn btn-info" role="button">Manage Applicant</a>
                        </div>
                        <div class="col-md-2">
                        <a href="submng.php" class="btn btn-info" role="button">Add Subject</a>
                         </div>
                         <div class="col-md-2">
                         <a href="rsltmng.php?edit=edit" class="btn btn-info" role="button">Applicant Result</a>
                          </div>
                          <div class="col-md-2">
                          <a href="testmng.php" class="btn btn-info" role="button">Add/Edit Question</a>
                        </div>
                       </div>
                    </div>


                <?php }?>

           
</form>
         
   
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    

    </div>
  </body>
</html>
