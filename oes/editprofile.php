

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
session_start();
include_once 'oesdb.php';
/************************** Step 1 *************************/
if(!isset($_SESSION['stdname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout']))
{
    /************************** Step 2 - Case 1 *************************/
    //Log out and redirect login page
    unset($_SESSION['stdname']);
    header('Location: index.php');

}
else if(isset($_REQUEST['dashboard'])){
     /************************** Step 2 - Case 2 *************************/
        //redirect to dashboard
     header('Location: stdwelcome.php');

    }else if(isset($_REQUEST['savem']))
{
      /************************** Step 2 - Case 3 *************************/
                //updating the modified values
    if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
    {
         $_GLOBALS['message']="Some of the required Fields are Empty.Therefore Nothing is Updated";
    }
    else
    {
     $query="update student set stdname='".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."', stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass'),emailid='".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."',contactno='".htmlspecialchars($_REQUEST['contactno'],ENT_QUOTES)."',address='".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."',city='".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."',pincode='".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."' where stdid='".$_REQUEST['student']."';";
     if(!@executeQuery($query))
        $_GLOBALS['message']=mysql_error();
     else
        $_GLOBALS['message']="Your Profile is Successfully Updated.";
    }
    closedb();

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>OES-Edit Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
   
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
          <div class="menubar">
               <ul >
                        <?php if(isset($_SESSION['stdname'])) {
                         // Navigations
                         ?>
                     
                        <input type="submit" value="Back" name="dashboard" class="btn btn1 btn-w-m btn-primary" title="Dash Board"/>
                        <input type="submit" value="Save" name="savem" class="btn btn1 btn-w-m btn-primary" onclick="validateform('editprofile')" title="Save the changes"/>
                        <input type="submit" value="LogOut" name="logout" class="btn btn1 btn-w-m btn-primary" title="Log Out"/>
               </ul>
          </div>
      <div class="page">
          <?php
                       
 /************************** Step 3 - Case 1 *************************/
        // Default Mode - Displays the saved information.
                        $result=executeQuery("select stdid,stdname,DECODE(stdpassword,'oespass') as stdpass ,emailid,contactno,address,city,pincode from student where stdname='".$_SESSION['stdname']."';");
                        if(mysql_num_rows($result)==0) {
                           header('Location: stdwelcome.php');
                        }
                        else if($r=mysql_fetch_array($result))
                        {
                           //editing components
                 ?>
           <table cellpadding="20" cellspacing="20" style="text-align:left;margin-left:15em" >
              <tr>
                  <td>User Name</td>
                  <td><input type="text" name="cname" value="<?php echo htmlspecialchars_decode($r['stdname'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>

                      <tr>
                  <td>Password</td>
                  <td><input type="password" name="password" value="<?php echo htmlspecialchars_decode($r['stdpass'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)" /></td>
                 
              </tr>

              <tr>
                  <td>E-mail ID</td>
                  <td><input type="text" name="email" value="<?php echo htmlspecialchars_decode($r['emailid'],ENT_QUOTES); ?>" size="16" /></td>
              </tr>
                       <tr>
                  <td>Contact No</td>
                  <td><input type="text" name="contactno" value="<?php echo htmlspecialchars_decode($r['contactno'],ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)"/></td>
              </tr>

                  <tr>
                  <td>Address</td>
                  <td><textarea name="address" cols="20" rows="3"><?php echo htmlspecialchars_decode($r['address'],ENT_QUOTES); ?></textarea></td>
              </tr>
                       <tr>
                  <td>City</td>
                  <td><input type="text" name="city" value="<?php echo htmlspecialchars_decode($r['city'],ENT_QUOTES); ?>" size="16" onkeyup="isalpha(this)"/></td>
              </tr>
                       <tr>
                  <td>PIN Code</td>
                  <td><input type="hidden" name="student" value="<?php echo $r['stdid']; ?>"/><input type="text" name="pin" value="<?php echo htmlspecialchars_decode($r['pincode'],ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)" /></td>
              </tr>

            </table>
<?php
                        closedb();
                        }
                        
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
  </body>
</html>
