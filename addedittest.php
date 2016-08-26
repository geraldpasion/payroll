<!DOCTYPE html>
<html>

  <head>
            <?php
    session_start();
    $empLevel = $_SESSION['employee_level'];
    if(isset($_SESSION['logsession']) && $empLevel == '3') {
        include('menuheader.php');

    }else if(isset($_SESSION['logsession']) && $empLevel == '4') {
      include('levelexe.php');
    }
            include('dbsettings.php');
        ?>
<script type="text/javascript">//ajax
            $(function() {
            $(".delete").click(function(){
            var element = $(this);
            var test_id = element.attr("id");
            var info = 'test_id1=' + test_id;
             $.ajax({
               type: "GET",
               url: "deletetest.php",
               data: info,
               success: function(){
             }
            });
              $(this).parents(".josh").remove();
             $('#success').fadeIn(300).delay(3200).fadeOut(300);
             $(window).scrollTop(0);
            return false;
            });
            });
        </script>
                
          <script type="text/javascript" >//ajax  
       //    $(document).ready(function(){
       //    $(document).on('submit','#formko', function() {
       //    var subj = $("#sub").val();
       //    var tname = $("#tname").val();
       //    var tdesc = $("#tdesc").val();
       //    var tques = $("#tques").val();
       //    var tdur = $("#tdur").val();
       //    var tsc = $("#tsc").val();
       //   
       //    // Returns successful data submission message when the entered information is stored in database.
       //    var dataString = 'tsubject='+ subj + '&tname='+ tname + '&tdescription='+ tdesc + '&tquestion='+ tques + '&tduration='+ tdur + '&tsecret='+ tsc;
       //    if(tname=='')
       //    {
       //    $(window).scrollTop(0);
       //    $('#warning').fadeIn(700);
       //    $('#success').hide();
       //    }
       //    else
       //    {
       //    // AJAX Code To Submit Form.
       //    $.ajax({
       //    type: "POST",
       //    url: "addedittestexe.php",
       //    data: dataString,
       //    cache: false,
       //    success: function(result){
       //     scroll(0,0)
       //        toastr.options = { 
       //        "closeButton": true,
       //      "debug": false,
       //      "progressBar": true,
       //      "preventDuplicates": true,
       //      "positionClass": "toast-top-right",
       //      "onclick": null,
       //      "showDuration": "400",
       //      "hideDuration": "1000",
       //      "timeOut": "7000",
       //      "extendedTimeOut": "1000",
       //      "showEasing": "swing",
       //      "hideEasing": "linear",
       //      "showMethod": "fadeIn",
       //      "hideMethod": "fadeOut" // 1.5s
       //        }
       //        toastr.success('Employee successfully edited!');
       //    
       //    }
       //    });
       //    }
       //    return false;
       //    });
       //    });
       </script>

        <script type="text/javascript" src="../calendar/jsDatePick.full.1.1.js"></script>
        <script type="text/javascript">
            window.onload = function(){
                new JsDatePick({
                    useMode:2,
                    target:"testfrom"
                    //limitToToday:true <-- Add this should you want to limit the calendar until today.
                });

                new JsDatePick({
                    useMode:2,
                    target:"testto"
                    //limitToToday:true <-- Add this should you want to limit the calendar until today.
                });
            };
        </script>

        <script type="text/javascript" src="../validate.js" ></script>

<?php

include('dbsettings.php');

if (isset($_REQUEST['dashboard'])) {
    /*     * ************************ Step 2 - Case 2 ************************ */
    //redirect to dashboard
} else if (isset($_REQUEST['delete'])) { /* * ************************ Step 2 - Case 3 ************************ */
    //deleting the selected Tests
    unset($_REQUEST['delete']);
    $hasvar = false;
    foreach ($_REQUEST as $variable) {
        if (is_numeric($variable)) { //it is because, some session values are also passed with request
            $hasvar = true;

            if (!@$mysqli->query("delete from test where testid=$variable")) {
                if (mysqli_errno () == 1451) //Children are dependent value
                    $_GLOBALS['message'] = "Too Prevent accidental deletions, system will not allow propagated deletions.<br/><b>Help:</b> If you still want to delete this test, then first delete the questions that are associated with it.";
                else
                    $_GLOBALS['message'] = mysql_errno();
            }
        }
    }
    if (!isset($_GLOBALS['message']) && $hasvar == true)
        $_GLOBALS['message'] = "Selected Tests are successfully Deleted";
    else if (!$hasvar) {
        $_GLOBALS['message'] = "First Select the Tests to be Deleted.";
    }
} else if (isset($_REQUEST['savem'])) {
    /*     * ************************ Step 2 - Case 4 ************************ */
    //updating the modified values
    





// insert the new record into the database
if ($stmt = $mysqli->prepare("update test set testname='" . htmlspecialchars($_POST['testname2'], ENT_QUOTES) . "',testdesc='" . htmlspecialchars($_POST['testdesc2'], ENT_QUOTES) . "',subid=1 ,duration=" . htmlspecialchars($_POST['duration2'], ENT_QUOTES) . ",totalquestions=" . htmlspecialchars($_POST['totalqn2'], ENT_QUOTES) . ",testcode=ENCODE('" . htmlspecialchars($_POST['testcode2'], ENT_QUOTES) . "','oespass') where testid=" . $_POST['testid2'] . ";"))
{
  $stmt->execute();
  $stmt->close();
}

unset($_REQUEST['savem']);
    

}
else if (isset($_REQUEST['savea'])) {
    /*     * ************************ Step 2 - Case 5 ************************ */
    //Add the new Test information in the database

include("dbconfig.php");
$resultb = $mysqli->query("SELECT * FROM test WHERE testid = (SELECT MAX(testid) FROM test)")->fetch_array();
        $maxes = $resultb['testid'];
        $maxes= $maxes+1;


    $fromtime = "2000-01-20 03:38:06";
    


$tname = $_POST['testname'];
$tdescription = $_POST['testdesc'];
$tquestion = $_POST['totalqn'];
$tduration = $_POST['duration'];
$tsecret = $_POST['testcode'];


// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT INTO test (testid, testname, testdesc, totalquestions, duration, testcode, subid, testfrom) 
VALUES ('$maxes','$tname', '$tdescription', '$tquestion', '$tduration',ENCODE('" . htmlspecialchars($tsecret, ENT_QUOTES) . "','oespass'),'1','$fromtime')"))
{
  $stmt->execute();

  $stmt->close();


    
}

unset($_REQUEST['savea']);




        //$query = "insert into test values($newstd,'" . $_REQUEST['testname'] . "','" . $_REQUEST['testdesc']. "',(select curDate()),(select curTime())," . $_REQUEST['subject'] . ",'" . $fromtime . "','" . $totime . "'," . $_REQUEST['duration'] . "," . $_REQUEST['totalqn']. ",0,ENCODE('" . $_REQUEST['testcode'] . "','oespass'),NULL)";
    
    

}
else if (isset($_REQUEST['manageqn'])) {
    /*     * ************************ Step 2 - Case 6 ************************ */
    //Store the Test identity in session varibles and redirect to prepare question section.
    //$tempa=explode(" ",$_REQUEST['testqn']);
    // $testname=substr($_REQUEST['manageqn'],0,-10);
    $testname = $_REQUEST['manageqn'];
    $result = $mysqli->query("select testid from test where testname='" . htmlspecialchars($testname, ENT_QUOTES) . "';");

    if ($r = mysqli_fetch_array($result)) {
        $_SESSION['testname'] = $testname;
        $_SESSION['testqn'] = $r['testid'];
        $_GLOBALS['message']=$_SESSION['testname'];
        header('Location: prepqn.php');
    }
}
?>

  </head>
<style>
.add,.edit{
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,th,.add{
  
    text-align: center;
    padding: 8px;
}
tr:hover{background-color:#f5f5f5}

</style>
  <body>
    <div class="row"> 
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
          <h5>Manage Tests</h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
              </a>
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                <li><a href="#">Config option 1</a>
                </li>
                <li><a href="#">Config option 2</a>
                </li>
              </ul>
              <a class="close-link">
                <i class="fa fa-times"></i>
              </a>
            </div>
          </div>
          <div class="ibox-content">
            <form name="testmng" id="formko" action="addedittest.php" method="post">
                <div class="page">
<?php
{
    // To display the Help Message
    if (isset($_REQUEST['forpq']))
        echo "<div class=\"pmsg\" style=\"text-align:center\"> Which test questions Do you want to Manage? <br/><b>Help:</b>Click on Questions button to manage the questions of respective tests</div>";
    if (isset($_REQUEST['add'])) {
        /*         * ************************ Step 3 - Case 1 ************************ */
        //Form for the new Test
?>
                    <table class='add'>

                        <tr>
                            <td><b>Test Name</b></td>
                            <td><input type="text" class = "form-control" id ="tname" name="testname" value="" size="16" onkeyup="isalphanum(this)"  /></td>
                            <td><div class="help"><b>Note:</b><br/>Test Name must be Unique<br/> in order to identify different<br/> tests on same subject.</div></td>
                        </tr>
                        <tr>
                            <td><b>Test Description</b></td>
                            <td><textarea name="testdesc" class = "form-control" id ="tdesc" cols="20" rows="3" ></textarea></td>
                            <td><div class="help"><b>Describe here:</b><br/>What the test is all about?</div></td>
                        </tr>
                        <tr>
                            <td><b>Total Questions</b></td>
                            <td><input type="text" class = "form-control" name="totalqn" id="tques" value="" size="16" onkeyup="isnum(this)" onKeyPress="return numbersonly(this, event)" onpaste="return false" onDrop="return false" /></td>

                        </tr>
                        <tr>
                            <td><b>Duration(Mins)</b></td>
                            <td><input type="text" class = "form-control" name="duration" id="tdur" value="" size="16" onkeyup="isnum(this)"  onKeyPress="return numbersonly(this, event)" onpaste="return false" onDrop="return false"/></td>

                        </tr>

                        <tr>
                            <td><b>Test Secret Code</b></td>
                            <td><input type="text" class = "form-control" name="testcode" id="tsc" value="" size="16" onkeyup="isalphanum(this)"  /></td>
                            <td><div class="help"><b>Note:</b><br/>Candidates must enter<br/>this code in order to <br/> take the test</div></td>
                        </tr>

                    </table

<?php
    } else if (isset($_REQUEST['edit'])) {
        /*         * ************************ Step 3 - Case 2 ************************ */
        // To allow Editing Existing Test.
        $result = $mysqli->query("select t.totalquestions,t.duration,t.testid,t.testname,t.testdesc,t.subid,s.subname,DECODE(t.testcode,'oespass') as tcode,DATE_FORMAT(t.testfrom,'%Y-%m-%d') as testfrom,DATE_FORMAT(t.testto,'%Y-%m-%d') as testto from test as t,subject as s where t.subid=s.subid and t.testname='" . htmlspecialchars($_REQUEST['edit'], ENT_QUOTES) . "';");
        if (mysqli_num_rows($result) == 0) {
            header('Location: addedittest.php');
        } else if ($r = mysqli_fetch_array($result)) {


            //editing components

                    echo '<table class="edit" >
                        <tr>
                        </tr>
                        <tr>
                            <td><b>Test Name</b></td>
                            <td><input class = "form-control" type="hidden" name="testid2" value="'.$r['testid'].'"/><input type="text" name="testname2" id="testname2" value="'. htmlspecialchars_decode($r['testname'], ENT_QUOTES).'" size="16" onkeyup="isalphanum(this)" /></td>
                            <td><div class="help"><b>Note:</b><br/>Test Name must be Unique<br/> in order to identify different<br/> tests on same subject.</div></td>
                        </tr>
                        <tr>
                            <td><b>Test Description</b></td>
                            <td><textarea  class = "form-control" name="testdesc2" id="testdesc2" cols="20" rows="3" >"'.htmlspecialchars_decode($r['testdesc'], ENT_QUOTES).'"</textarea></td>
                            <td><div class="help"><b>Describe here:</b><br/>What the test is all about?</div></td>
                        </tr>
                        <tr>
                            <td><b>Total Questions</b></td>
                            <td><input  class = "form-control" type="text" name="totalqn2" id="totalqn2" value="'.htmlspecialchars_decode($r['totalquestions'], ENT_QUOTES).'" size="16" onkeyup="isnum(this)" onKeyPress="return numbersonly(this, event)" onpaste="return false" onDrop="return false"/></td>

                        </tr>
                        <tr>
                            <td><b>Duration(Mins)</b></td>
                            <td><input  class = "form-control" type="text" name="duration2" id="duration2" value="'.htmlspecialchars_decode($r['duration'], ENT_QUOTES).'" size="16" onkeyup="isnum(this)" onKeyPress="return numbersonly(this, event)" onpaste="return false" onDrop="return false"/></td>

                        </tr>

                        <tr>
                            <td><b>Test Secret Code</b></td>
                            <td><input  class = "form-control" type="text" name="testcode2" id="testcode2" value="'.htmlspecialchars_decode($r['tcode'], ENT_QUOTES) .'" size="16" onkeyup="isalphanum(this)" /></td>
                            <td><div class="help"><b>Note:</b><br/>Candidates must enter<br/>this code in order to <br/> take the test</div></td>
                        </tr>

                    </table';


                                }
                            }

                            else {

                                /*                                 * ************************ Step 3 - Case 3 ************************ */
                                // Defualt Mode: Displays the Existing Test/s, If any.
                                $result = $mysqli->query("select *,DECODE(t.testcode,'oespass') as tcode,DATE_FORMAT(t.testfrom,'%d-%M-%Y') as testfrom,DATE_FORMAT(t.testto,'%d-%M-%Y %H:%i:%s %p') as testto from test as t,subject as s where t.subid=s.subid order by t.testdate desc,t.testtime desc;");
                                if (mysqli_num_rows($result) == 0) {
                                    echo "<h3 style=\"color:#0000cc;text-align:center;\">No Tests Yet..!</h3>";
                                } else {
                                    $i = 0;

                                    echo "<table class='footable table table-stripped' data-page-size='1000000000' data-filter=#filter>";
                    echo "<thead>";
                    echo    "<tr>";
                    echo    "<th>Test Name</th>";
                    echo    "<th>Test Description</th>";
                    echo    "<th>Test Secret Code</th>";
                    echo    "<th>Questions</th>";
                    echo    "<th style='text-align:center'>Edit</th>";
                    echo "</thead>";
                    echo    " </tr>";
?>
                                       
<?php

while($result1=mysqli_fetch_object($result))
                         {
                    $testid = $result1->testid;
                    echo "<tr class = 'josh'>";
                    echo "<td>" . $result1->testname . "</td>";
                    echo "<td>" . $result1->testdesc . "</td>";
                    echo "<td>" . $result1->tcode . "</td>";
                    

                   
                    echo "<td><a href='prepqn.php?id=".$testid."'><button class='btn btn-success' name = 'edit' type='button'><i class='fa fa-plus'></i> Add</button></td></a>";
                     echo "<td style='text-align:center'><a href='addedittest.php?edit=".$result1->testname."'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></td></a>";
                    echo "<td style='text-align:center'><a href='#' id='$testid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Delete</button></a></td>";
                    

                    }



                                    // while ($r = mysqli_fetch_array($result)) {
                                    //     $i = $i + 1;
                                    //     if ($i % 2 == 0)
                                    //         echo "<tr class=\"alt\">";
                                    //     else
                                    //         echo "<tr>";
                                    //     echo "<td style=\"text-align:center;\"><input type=\"checkbox\" name=\"d$i\" value=\"" . $r['testid'] . "\" /></td><td> " . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . " : " . htmlspecialchars_decode($r['testdesc'], ENT_QUOTES)
                                    //     . "</td><td>" . htmlspecialchars_decode($r['subname'], ENT_QUOTES) . "</td><td>" . htmlspecialchars_decode($r['tcode'], ENT_QUOTES) . "</td><td>" . $r['testfrom'] . " To " . $r['testto'] . "</td>"
                                    //     . "<td class=\"tddata\"><a title=\"Edit " . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"href=\"addeditquestions.php?edit=" . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"><img src=\"../images/edit.png\" height=\"30\" width=\"40\" alt=\"Edit\" /></a></td>"
                                    //     . "<td class=\"tddata\"><a title=\"Manage Questions of " . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"href=\"addeditquestions.php?manageqn=" . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"><img src=\"../images/mngqn.png\" height=\"30\" width=\"40\" alt=\"Manage Questions\" /></a></td></tr>";
                                    // }
                    //echo "</tr>";
?>
                                
<?php

                                }
                                echo "</table";

                            }
                        }
?>

                </div>
                <?php
    //navigation for Add option
    if (isset($_REQUEST['add'])) {
?>
                      <br><br><div class="col-md-10"></div>
                        <input type="submit" value="Save" name="savea" class="btn btn-info" onclick="validatetestform('testmng')" title="Save the Changes"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" value="Back" name="back" class="btn btn-info" title="Back"/>

<?php
    } else if (isset($_REQUEST['edit'])) { //navigation for Edit option
?>  
                      <br><br><div class="col-md-10"></div>
                        <input type="submit" value="Save" name="savem" class="btn btn-info" onclick="validatetestform('testmng')" title="Save the changes"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" value="Back" name="back" class="btn btn-info" title="Back"/>

<?php
    } else {  
?>
                      <br><br><div class="col-md-11"></div>
                        <input type="submit" value="Add Test" name="add" class="btn btn-info" title="Add"/>
<?php }
?>
                </div>

            </form>

        </div>

                </div>
   
          </div>
                </div>


 <?php
      include('menufooter.php');
    ?>
  </body>
</html>