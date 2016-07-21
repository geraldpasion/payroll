 <html>
<head>
<title>Applicant Log-in</title>

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
/***************************** Step 1 : Case 1 ****************************/
 //redirect to registration page
      if(isset($_REQUEST['register']))
      {
            header('Location: register.php');
      }
      else if($_REQUEST['stdsubmit'])
      {
/***************************** Step 1 : Case 2 ****************************/
 //Perform Authentication
          $result=executeQuery("select *,DECODE(stdpassword,'oespass') as std from student where stdname='".htmlspecialchars($_REQUEST['name'],ENT_QUOTES)."' and stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass')");
          if(mysql_num_rows($result)>0)
          {

              $r=mysql_fetch_array($result);
              if(strcmp(htmlspecialchars_decode($r['std'],ENT_QUOTES),(htmlspecialchars($_REQUEST['password'],ENT_QUOTES)))==0)
              {
                  $_SESSION['stdname']=htmlspecialchars_decode($r['stdname'],ENT_QUOTES);
                  $_SESSION['stdid']=$r['stdid'];
                  unset($_GLOBALS['message']);
                  header('Location: stdwelcome.php');
              }else
          {
              $_GLOBALS['message']="Check Your user name and Password.";
          }

          }
          else
          {
              $_GLOBALS['message']="Check Your user name and Password.";
          }
          closedb();
      }
 ?>
 <body class="gray-bg">

<div class="container">
  <div class="page-header">
  <h1>ICONNECT Global Communications <small> Quiz </small></h1>
</div>
<div class="panel panel-default">
  <div class="panel-body">


<!--personal information-->
  
  <div class="panel panel-default">
  <div class="panel-heading"><h3></h3></div>
  <div class="panel-body">


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Online Examination System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="oes.css"/>
  </head>
  <body>
      <?php

        if($_GLOBALS['message'])
        {
         echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
      ?>
    
     <form id="stdloginform" action="index.php" method="post">
  
       
       <ul id="menu">
                    <?php if(isset($_SESSION['stdname'])){
                          header('Location: stdwelcome.php');}else{  
                          /***************************** Step 2 ****************************/
                        ?>

                      <!--  <li><input type="submit" value="Register" name="register" class="subbtn" title="Register"/></li>-->
           <li><div ><a href="register.php" title="Click here  to Register" class="btn btn-info">Register</a></div></li>
                        <?php } ?>
                    </ul>

      </div>
      <div class="page">
              
             
             
                  <td>User Name</td>
                  <td><input type="text"  name="name" value="" size="16" /></td>

            
            
                  <td>Password</td>
                  <td><input type="password" name="password" value="" size="16" /></td>
            

                      <input type="submit"  value="Log In" name="stdsubmit" class="btn btn-info"  />
                  </td><td></td>
           
           


      </div>
       </form>

    <div id="footer">
         
      </div>
      </div>

 </div>
</div>
</div>
</div>
</div>
  </body>
</html>
