<html>
<head>
<title></title>

   <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



</head>



<body>    

<?php
session_start();
$_SESSION['stdname']=$_GET['stdname'];
        if(!isset($_SESSION['stdname'])){
            $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
        }
        else if(isset($_REQUEST['logout'])){
                unset($_SESSION['stdname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
            header('Location: index.php');
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
  <div class="panel-heading"><h3>Examination</h3></div>
  <div class="panel-body">

</head>
          
             

                <form name="stdwelcome" action="stdwelcome.php" method="post">
                 
                   <!--button logout-->
                   <ul id=menu>
                  
             
                        <?php if(isset($_SESSION['stdname'])){ ?>
                   <!--<button id ="submit" type="submit" name="logout" class="btn btn-info" title="Log out">Log Out</button>-->
                      <div class="row">
                          <div class="col-md-10">
                          </div>
                          <div class="col-md-2">
                        <?php } ?>
                      </ul>
          
            <div class="stdpage">
                <?php if(isset($_SESSION['stdname'])){ ?>

        
               <!--<img height="600" width="100%" alt="back" src="images/trans.png" class="btmimg" />-->
              
                <div class="row">
                <div class="col-md-3">
                </div>

                    <div class="row">
                      <div class="col-md-2">
                        </div>

                        <div class="col-md-2">
                        <a href="stdtest.php?id=<?php echo $_GET['id'].'&'."stdname=".$_GET['id']; ?>" class="btn btn-info" role="button">Start Test</a>
                         </div>

                        <!-- <div class="col-md-2">
                         <a href="editprofile.php?edit=edit" class="btn btn-info" role="button">Edit Profile</a>
                          </div>-->

                          <div class="col-md-2">
                          <!-- <a href="resumetest.php" class="btn btn-info" role="button">Resume Test</a>-->
                        </div>
                        </div>

                   </form>     
                </div>
                <?php }?>

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
