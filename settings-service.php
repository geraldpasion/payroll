<?php
require ('header.php');
  //include ('fetchservicessettings.php');


  $userid = $_SESSION["UserID"];
    
  //$business_id = $_SESSION["business_id"];

  $fetchquery = "SELECT * FROM servicestbl WHERE UserID=".$userid;
  $fetchresult= mysqli_query($conn, $fetchquery);
  $fetchSrvceName= array();
  $fetchSrvceFee = array();
  $fetchSrvceDur = array();
  $fetchSrvceID = array();
  $fetchSrvceDesc = array();

  while ($row = mysqli_fetch_array($fetchresult)) {
    $fetchSrvceID[] = $row["ServiceID"];
    $fetchSrvceName[] = $row["ServiceName"];
    $fetchSrvceDesc[] = $row["ServiceDesc"];
    $fetchSrvceDur[] = $row["ServiceDur"];
    $fetchSrvceFee[] = $row["ServiceFee"];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
       <link href="css/tabs2branding.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
<link href='css/staff.css' rel='stylesheet'>

      <link href="css1/bootstrap.min.css" rel="stylesheet">
    <link href="css1/bootstrap-responsive.min.css" rel="stylesheet">    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="css1/font-awesome.css" rel="stylesheet">    
    <link href="css1/style.css" rel="stylesheet">   
    <link href="css1/pages/plans.css" rel="stylesheet">

      


    <script type="text/javascript">
    function ConfirmDelete() {
      var answer = confirm ("Are you sure to delete?")
      if (answer) {
        return true;
      }
      else {
        return false;
      }
    }
    </script>

    <script>
    $(document).ready(function(){
        $("#viewBtn").click(function(){
            $("#addModal").modal();
        });
    });
    </script>

  </head>
  <body>
   
      <div class="subnavbar">

  <div class="subnavbar-inner">
  
    <div class="container">

      <ul class="mainnav">
      
        <li>
          <a href="admin.php">
            <i class="icon-dashboard"></i>
            <span>Dashboard</span>
          </a>              
        </li>   
                
        <li>          
          <a href="contacts.php">
            <i class="icon-facetime-video"></i>
            <span>Customer</span>
          </a>                    
        </li>
                <!--
                <li class="dropdown">         
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-long-arrow-down"></i>
            <span>Branding</span>
            <b class="caret"></b>
          </a>  
        
          <ul class="dropdown-menu">
                      <li><a href="branding.php">Welcome page</a></li>
            <li><a href="email.php">Email</a></li>
                        <li><a href="widget.php">Widget</a></li>
                    </ul>           
        </li>
      -->
                
                       <li class="active ">
          <a href="settings.php">
            <i class="icon-list-alt"></i>
            <span>Settings</span>
          </a>            
        </li>
        
        
        
      
      </ul>

    </div> <!-- /container -->
  
  </div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
    

    <div id='cssmenu' style="background-color:#f9f6f1; position:relative; left:128px;">
<ul id="ulcssmenu">
   <li><a href='settings.php'>Business Information</a></li>
   <li class='active'><a href='settings-service.php'>Business Service</a></li>
   <li><a href='settings-staff.php'>Staff</a></li>
   <li><a href='settings-sched.php'>Advance Options</a></li>
   <li><a href='branding.php'>Public Profile</a></li>
   <li><a href='settings-widget.php'>Widget</a></li>

    
</ul>
</div>


          
     
    
    
            <!-- process -->
        <div class="col-md-offset-1 col-md-10">
            
        <div class="jumbotron">
            <div class="container">
               <div class='row'>
          <div class='col-sm-12'>
              <label id="define" style="margin-left:50px;"><h2>Services</font></h2></label>
                    <a class="btn btn-success pull-right hvr-glow" style="position:relative; right:200px; bottom:25px; width:130px;" data-toggle='modal' data-backdrop='static' href='#addModal'>Add service <span class='glyphicon glyphicon glyphicon-plus'></span></a>
            <p style='font-size:14px; position:relative; left:50px;'>&nbsp;What kind of meetings, appointments or services your clients may schedule</p>

    
          <hr/>
                        
                
          


         <!-- <div class="col-md-9">

                 <form class="form-horizontal" role="form">


                  <!--MULA DITO
                  <iframe src='settings-select-service.php?id=1' style=' width:100%; height:700px; border:none;'></iframe>-->

               
        <div style='margin-bottom:20px;'>
        </div>

           <!-- <th><h3>Service</h3></th>-->
         
      <!--  <table class='table' border=0>
          <tbody>
      -->

        <div class="comment-tabs">                      
                    <ul class="media-list">

<?php
                  $arrlength=count($fetchSrvceName);

                  for($x=0;$x<$arrlength;$x++)
                    {

                      $holder1 = "deleteservicessettings.php?srvcid=".$fetchSrvceID[$x]."&&srvcname=".$fetchSrvceName[$x]."";

                     // $holder1 = "<a href='deleteservicessettings.php?srvcid=".$fetchSrvceID[$x]."&&srvcname=".$fetchSrvceName[$x].'">test</a>';
                /*    echo "<tr>
                          <td><h3><b>".$fetchSrvceName[$x]."</b></h3>
                          <br>
                          Duration:".$fetchSrvceDur[$x]." mins  &nbsp; &nbsp; &nbsp;
                              Fee: $".$fetchSrvceFee[$x]."

                          </td>
                          <td>
                          <a class='btn btn-danger pull-right hvr-glow popovers' href='#' title='Delete Service?' data-placement='left' data-toggle='popover' data-content='<a href=".$holder1.">Delete</a>' data-trigger='focus' data-content='pogiko'><span class='glyphicon glyphicon glyphicon-trash'></span></a>
            
                      
                            <button class='btn btn-success pull-right hvr-glow' data-toggle='modal' href='settings-edit-service.php?srvcid=".$fetchSrvceID[$x]."' data-target='#editModal' style='margin-right:10px;'>Edit</button>
                         
                          </tr>
                          <tr>                          ";
                    */
//<button  class='btn btn-danger pull-right hvr-glow popovers' href='#' title='Delete Service?' data-placement='left' data-toggle='popover' data-content='<a href='deleteservicessettings.php?srvcid=".$fetchSrvceID[$x]."&&srvcname=".$fetchSrvceName[$x]."'>test</a>  data-trigger='focus' data-content='bla'><span class='glyphicon glyphicon glyphicon-trash'></span></button>
                        
                    



                            echo "
                      <li class='media'>                        
                     <div class='media-body'>
                          <div class='well-sm'>
                              <h3 class='media-heading reviews'>".$fetchSrvceName[$x]."</h3>
                              
                              <div class='row' style='margin-left:5px;''>
                                  <div class='col-sm-3'>
                              <p style='font-size: 12px;''>Duration: <b>".$fetchSrvceDur[$x]." mins</b></p>
                             </div>
                                  <div class='col-sm-3'>
                                  <p style='font-size: 12px;''>Fee: <b>".$fetchSrvceFee[$x]."</b></p>
                                  </div>
                                  <div class='col-sm-3'>
                                    <p style='font-size: 12px;''>Description:<b>".$fetchSrvceDesc[$x]."</b></p>
                                  </div>
                                  <div class='col-sm-3'>
                                  <div role='group' style='position:relative; bottom:10px; '>
                            <a class='btn btn-danger pull-right' href='deleteservicessettings.php?srvcid=".$fetchSrvceID[$x]."&&srvcname=".$fetchSrvceName[$x]."' onclick='return ConfirmDelete()'><span class='glyphicon glyphicon glyphicon-trash'></span></a>


           <a class='btn btn-success pull-right hvr-glow' data-toggle='modal'  href='settings-edit-service.php?srvcid=".$fetchSrvceID[$x]."' data-target='#editModal' data-backdrop='static' style='margin-right:10px;'>Edit</a>
                          
                      <div class='modal fade' id='editModal' role='dialog' >
                        <div class='modal-dialog' style='width:450px;'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h4>Edit Service</h4>
                            </div>
                            <div class='modal-body'>

                                   
                                  </div>
                                   
                        </div>
                              </div>
                            </div>

                      
                           
                                </div>
                                  </div>
                                    
                            </div>
                          </div>                      
                        </div>      
                        </li>
                        
                      ";

// <a class='btn btn-danger pull-right hvr-glow popovers' href='#' title='Delete Service?' data-placement='left'  data-toggle='popover' data-content='<a href=".$holder1.">Delete</a>' data-trigger='focus' data-content='pogiko'><span class='glyphicon glyphicon glyphicon-trash'></span></a>
                        
// <a class='btn btn-success pull-right hvr-glow' data-toggle='modal'  href='settings-edit-service.php?srvcid=".$fetchSrvceID[$x]."' data-target='#editModal' data-backdrop='static' style='margin-right:10px;'>Edit</a>
           

 //         <iframe src='settings-edit-service.php?srvcid=".$fetchSrvceID[$x]."' style=' width:100%; height:700px; border:none;' id='editframe'></iframe>
// <iframe src='settings-edit-service.php?srvcid=".$fetchSrvceID[$x]."' style=' width:100%; height:700px; border:none;'></iframe>

// <a class='btn btn-success pull-right hvr-glow' data-toggle='modal' href='settings-edit-service.php?srvcid=".$fetchSrvceID[$x]."' data-target='#editModal' 
                      //style='margin-right:10px;'>Edit</a>
                         
//<a class='btn btn-success pull-right hvr-glow' data-toggle='modal' href='settings-edit-service.php?srvcid=".$fetchSrvceID[$x]."' data-target='#editModal' style='margin-right:10px;'>Edit</a>
                         
                      }
?>                     

                    </ul>      
        </div>
       <!--   </tbody>
        </table> 
-->

    <div class="container">
      <!--h2>Activate Modal with JavaScript</h2>
      < Trigger the modal with a button >


      <div class="modal fade" id="editModal" role="dialog">
        
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                  <iframe src='settings-add-service.php?id=1' style=' width:100%; height:700px; border:none;'></iframe>
            </div>
          </div>
          
      </div>
    </div>--> 





      <!-- ADD MODAL -->
   
    <div class='modal fade' id='addModal' role='dialog'  >
      <div class='modal-dialog'>
        <div class='modal-content' style="background-color:#F2F1EF; width:450px;">
          <div class='modal-header' style="height:70px; background-color:#1abc9c;">
            <center><h2 style="position:relative; bottom:10px;">Add Service</h2></center>
          </div>
          <div class='modal-body' style='height:300px;' >

            <form class="form-horizontal" role="form" method="post" action="addservicessettings.php">
                <div class="form-group">
                 <label for="addsrvcname" class="col-sm-3" control-label>Service Name</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control inputheight" name="addsrvcname" value="">
                    </div>
                </div> 

                <div class="form-group">
                 <label for="addsrvcdesc" class="col-sm-3" control-label>Service Description</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control inputheight" name="addsrvcdesc" value="">
                    </div>
                </div>

                <div class="form-group">
                 <label for="addsrvcdur" style='display: inline;' class="col-sm-3" control-label>Duration</label>
                    <div class="col-sm-9">
                                      <select name='addsrvcdur_hour' width="70" style="width: 70px">
                                        <option value='0'>0</option>
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>
                                        <option value='4'>4</option>
                                        <option value='5'>5</option>
                                        <option value='6'>6</option>
                                        <option value='7'>7</option>
                                        <option value='8'>8</option>
                                        <option value='9'>9</option>
                                        <option value='10'>10</option>
                                        <option value='11'>11</option>
                                        <option value='12'>12</option>
                                      </select>

                                        <label style='display: inline;' control-label>hr/s</label> &nbsp &nbsp
                                        <label style='display: inline;' control-label>to</label> &nbsp &nbsp
                                              
                                      <select name='addsrvcdur_min' width="70" style="width: 70px">
                                        <option value='0'>0</option>
                                        <option value='5'>5</option>
                                        <option value='10'>10</option>
                                        <option value='15'>15</option>
                                        <option value='20'>20</option>
                                        <option value='25'>25</option>
                                        <option value='30'>30</option>
                                        <option value='35'>35</option>
                                        <option value='40'>40</option>
                                        <option value='45'>45</option>
                                        <option value='50'>50</option>
                                        <option value='55'>55</option>
                                      </select>

                                        <label style='display: inline;' control-label>min/s</label>

                    </div>
                </div> 

                <div class="form-group">
                 <label for="addfee" class="col-sm-3" control-label>Service Fee</label>
                    <div class="col-sm-5">
                      <input  type="text" class="form-control inputheight" name="addsrvcfee" value="">
                    </div>

                                      <select name="addsrvccurrency"  style="width: 100px; height:25px;">
                                        <option value='usdollar'>US Dollars ($)</option>
                                        <option value='sgdollar'>Singaporean Dollars ($)</option>
                                        <option value='hkdollar'>Hongkong Dollars ($)</option>
                                        <option value='euro'>Euro (€)</option>
                                        <option value='yen'>Yen (¥)</option>
                                        <option value='peso'>Peso (₱)</option>
                                        <option value='baht'>Baht (฿)</option>
                                        <option value='bahraindinar'>Bahrain Dinar (฿)</option>


                                      </select>

                </div>


                        <div class="pull-right">
                        <input type="submit" class="btn btn-primary" value='Add Service'>
                        <!--<a href="settings-service.php" target="_top" class="btn btn-primary">Cancel</a>
                          -->

                                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                      </div>     

            </form>

                </div>
          </div>
      </div>
    </div>


<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({html:true});   
});
$(function () {
    $(".custom-close").on('click', function() {
        $('#addModal').modal('hide');
    });
});



$("#editModal").on('hidden.bs.modal', function () {
        window.location.reload();
    });


</script>

<script type="text/javascript">
  function delserv(staffedit){
    if(confirm("Are you sure you want to delete this?")){
      var counter = staffedit;
      $staffedit= window.location = "delstaff.php?staffid="+counter;
    }
  }

  </script>


<!-- HANGANG DITO-->
               
            </div> <!--col-->

          <div class="col-md-3">


          </div>            

      </div><!--Row-->
                
                
                
              </div>
            </div>
                    </div>
   
 
      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/editor.js"></script>
    <script src='js/scriptbg.js'></script>
  </body>
</html>