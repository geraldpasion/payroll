<?php
  //include ('viewservicessettings.php');
//require('config.php');
  $srvcid = $_REQUEST["srvcid"];
 // echo $srvcid;

  $con = mysqli_connect('localhost','root','','timecatcher');
  $sql1 =  "SELECT * FROM servicestbl WHERE ServiceID= '$srvcid' ";
  $result = mysql_query($sql1);

$result = mysqli_query($con,$sql1);
$row = $result->fetch_array(MYSQLI_ASSOC);
  //$count = mysql_num_rows($result);
  //$row = mysql_fetch_assoc($result);
 

    $SrvUserID = $row['UserID'];
    $SrvName = $row['ServiceName'];
    $SrvDesc= $row['ServiceDesc'];
    $SrvDur = $row['ServiceDur'];
    $SrvFee = $row['ServiceFee'];
    $SrvColor = $row['ServiceColor'];
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings</title>

    <link href="css/customize.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <script type='text/javascript' src='jscolor/jscolor.js'></script>

  </head>

  <body>





  <div class='modal-content' style="background-color:#F2F1EF; height:380px; width:450px;">

    <div class='modal-header' style="height:70px; background-color:#1abc9c;">
            <center><h2 style="position:relative; bottom:10px;">Edit Business Services</h2></center>
          </div>
      <div class='container'>

        <div class='row'>
        <div class='col-md-12 center-block'>
            <form class="form-horizontal" action="editservicessettings.php?srvcid=<?php echo $srvcid;?>" role="form" method="post" ><!--action="editservicessettings.php?srvcid=<?php echo $srvcid;?>"-->
                



                <div class="form-group">
                 <label for="editsrvcname" class="col-sm-3" control-label>Service Name</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control inputheight" name="editsrvcname" value="<?php echo $SrvName ?>">
                    </div>
                </div> 

                <div class="form-group">
                 <label for="editsrvcdesc" class="col-md-3" control-label>Service Description</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control inputheight" name="editsrvcdesc" value="<?php echo $SrvDesc ?>">
                    </div>
                </div> 

                <div class="form-group">
                 <label for="editsrvcdur" class="col-sm-3" control-label>Duration</label>
                    <div class="col-sm-9">
                                      <select name='editsrvcdur_hour' width="70" style="width: 70px">
                                        <option value='0'>0</option>
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>
                                        <option value='4'>4</option>
                                        <option value='5'>5</option>
                                        <option value='6'>6</option>
                                        <option value='7'>7</option>
                                        <option value='8'>8</option>
                                      </select>

                                        <label style='display: inline;'  control-label>hr/s</label> &nbsp &nbsp
                                        <label style='display: inline;'  control-label>to</label> &nbsp &nbsp

                                      <select style='display: inline;' name='editsrvcdur_min' width="70" value='3' style="width: 70px">
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

                                        <label control-label>min/s</label>

                    </div>
                </div> 

                <div class="form-group">
                 <label for="editsrvcfee" class="col-sm-3" control-label>Service Fee</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control inputheight" name="editsrvcfee" value="<?php echo $SrvFee ?>">
                    </div>
                </div>


                        <div class="modal-footer">
                        <!--<input type="submit" class="btn btn-primary" name="cancel" formaction="settings-service.php" value="Cancel">-->
                        
                              <input type="submit" class="btn btn-primary" name="save" value="Save Changes">
                                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>

                      </div>     

            </form>

            <!--?php 
              if ($_POST["cancel"]) {
                echo '<script language="javascript">';
                echo 'location.href = "settings-select-service.php";';
                echo '</script>';
              }
              if ($_POST["save"]) {
                echo '<script language="javascript">';
                echo 'location.href = "editservicessettings.php?srvcid='.$srvcid.'";';
                echo '</script>';
              }
            ?-->

        <!-- </div>col-->
      <!-- </div> row-->
       <!--</div>container-->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>


  </body>
</html>