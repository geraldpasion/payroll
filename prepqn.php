 <!DOCTYPE html>
<html>

    <head>
        <?php
            include('menuheader.php');
            include('dbsettings.php');
        ?>





        
        <title>Manage Questions</title>
    </head>

    <body>

        <?php
        if(isset($_GET['id'])){
        $gid=$_GET['id'];
    }
    else{
        $gid="";
    }

    if(isset($_GET['edit'])){
        $eid=$_GET['edit'];
    }
    else{
        $eid="";
    }


if (isset($_REQUEST['managetests'])) {
    /*     * ************************ Step 2 - Case 2 ************************ */
    //redirect to Manage Tests Section
} else if (isset($_REQUEST['delete'])) {
    /*     * ************************ Step 2 - Case 3 ************************ */
    //deleting the selected Questions
    unset($_REQUEST['delete']);
    $hasvar = false;
    $count = 1;
    foreach ($_REQUEST as $variable) {
        if (is_numeric($variable)) { //it is because, some session values are also passed with request
            $hasvar = true;

            if (!@$mysqli->query("delete from question where testid=" . $_SESSION['testqn'] . " and qnid=" . htmlspecialchars($variable)))
                $_GLOBALS['message'] = mysqli_error();
        }
    }
    //reordering questions

    $result = $mysqli->query("select qnid from question where testid=" . $_SESSION['testqn'] . " order by qnid;");
    while ($r = mysql_fetch_array($result))
        if (!@$mysqli->query("update question set qnid=" . ($count++) . " where testid=" . $_SESSION['testqn'] . " and qnid=" . $r['qnid'] . ";"))
            $_GLOBALS['message'] = mysqli_error();

    //
    if (!isset($_GLOBALS['message']) && $hasvar == true)
        $_GLOBALS['message'] = "Selected Questions are successfully Deleted";
    else if (!$hasvar) {
        $_GLOBALS['message'] = "First Select the Questions to be Deleted.";
    }
} else if (isset($_REQUEST['savem'])) {
    /*     * ************************ Step 2 - Case 4 ************************ */
  
    if (strcmp($_REQUEST['correctans'], "<Choose the Correct Answer>") == 0 || empty($_REQUEST['question']) || empty($_REQUEST['optiona']) || empty($_REQUEST['optionb']) || empty($_REQUEST['optionc']) || empty($_REQUEST['optiond']) || empty($_REQUEST['marks'])) {
        $_GLOBALS['message'] = "Some of the required Fields are Empty";
    } else if (strcasecmp($_REQUEST['optiona'], $_REQUEST['optionb']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionc'], $_REQUEST['optiond']) == 0) {
        $_GLOBALS['message'] = "Two or more options are representing same answers.Verify Once again";
    } else {
        $query = "update question set question='" . htmlspecialchars($_REQUEST['question'],ENT_QUOTES) . "',optiona='" . htmlspecialchars($_REQUEST['optiona'],ENT_QUOTES) . "',optionb='" . htmlspecialchars($_REQUEST['optionb'],ENT_QUOTES) . "',optionc='" . htmlspecialchars($_REQUEST['optionc'],ENT_QUOTES) . "',optiond='" . htmlspecialchars($_REQUEST['optiond'],ENT_QUOTES) . "',correctanswer='" . htmlspecialchars($_REQUEST['correctans'],ENT_QUOTES) . "',marks=" . htmlspecialchars($_REQUEST['marks'],ENT_QUOTES) . " where testid=" . $_SESSION['testqn'] . " and qnid=" . $_REQUEST['qnid'] . " ;";
        if (!@$mysqli->query($query))
            $_GLOBALS['message'] = mysqli_error();
        else
            $_GLOBALS['message'] = "Question is updated Successfully.";
    }
}
else if (isset($_REQUEST['savea'])) {
    /*     * ************************ Step 2 - Case 5 ************************ */
    //Add the new Question
    $cancel = false;
    $result = $mysqli->query("select max(qnid) as qn from question where testid=" . $_SESSION['testqn'] . ";");
    $r = mysqli_fetch_array($result);
    if (is_null($r['qn']))
        $newstd = 1;
    else
        $newstd=$r['qn'] + 1;

    $result = $mysqli->query("select count(*) as q from question where testid=" . $_SESSION['testqn'] . ";");
    $r2 = mysqli_fetch_array($result);

    $result = $mysqli->query("select totalquestions from test where testid=" . $_SESSION['testqn'] . ";");
    $r1 = mysqli_fetch_array($result);

    if (!is_null($r2['q']) && (int) htmlspecialchars_decode($r1['totalquestions'],ENT_QUOTES) == (int) $r2['q']) {
        $cancel = true;
        $_GLOBALS['message'] = "Already you have created all the Questions for this Test.<br /><b>Help:</b> If you still want to add some more questions then edit the test settings(option:Total Questions).";
    }
    else
        $cancel=false;

    $result = $mysqli->query("select * from question where testid=" . $_SESSION['testqn'] . " and question='" . htmlspecialchars($_REQUEST['question'],ENT_QUOTES) . "';");
    if (!$cancel && $r1 = mysqli_fetch_array($result)) {
        $cancel = true;
        $_GLOBALS['message'] = "Sorry, You trying to enter same question for Same test";
    } else if (!$cancel)
        $cancel = false;
    // $_GLOBALS['message']=$newstd;
    if (strcmp($_REQUEST['correctans'], "<Choose the Correct Answer>") == 0 || empty($_REQUEST['question']) || empty($_REQUEST['optiona']) || empty($_REQUEST['optionb']) || empty($_REQUEST['optionc']) || empty($_REQUEST['optiond']) || empty($_REQUEST['marks'])) {
        $_GLOBALS['message'] = "Some of the required Fields are Empty";
    } else if (strcasecmp($_REQUEST['optiona'], $_REQUEST['optionb']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionc'], $_REQUEST['optiond']) == 0) {
        $_GLOBALS['message'] = "Two or more options are representing same answers.Verify Once again";
    } else if (!$cancel) {
        $query = "insert into question values(" . $gid . ",$newstd,'" . htmlspecialchars($_REQUEST['question'],ENT_QUOTES) . "','" . htmlspecialchars($_REQUEST['optiona'],ENT_QUOTES) . "','" . htmlspecialchars($_REQUEST['optionb'],ENT_QUOTES) . "','" . htmlspecialchars($_REQUEST['optionc'],ENT_QUOTES) . "','" . htmlspecialchars($_REQUEST['optiond'],ENT_QUOTES) . "','" . htmlspecialchars($_REQUEST['correctans'],ENT_QUOTES) . "'," . htmlspecialchars($_REQUEST['marks'],ENT_QUOTES) . ")";
        if (!@$mysqli->query($query))
            $_GLOBALS['message'] = mysqli_error();
        else
            $_GLOBALS['message'] = "Successfully New Question is Created.";
    }
}
?>
<script type="text/javascript">//ajax
            $(function() {
            $(".delete").click(function(){
            var element = $(this);
            var question_id = element.attr("id");
            var info = 'question_id1=' + question_id;
             $.ajax({
               type: "GET",
               url: "deletequestion.php",
               data: info,
               success: function(){

                        location.reload();   
                    
             }
            });
              
             $('#success').fadeIn(300).delay(3200).fadeOut(300);
             $(window).scrollTop(0);
            return false;
            });
            });
        </script>
        <div class="row"> 
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    <h5>Manage Questions</h5>
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
                        
                        

             
<form name="prepqn" action="prepqn.php?id=<?php echo $gid; ?>" method="post">


                <div class="page">
                        <?php
                        $_SESSION['testqn']=$_GET['id'];
                        $result = $mysqli->query("select count(*) as q from question where testid=" . $_SESSION['testqn'] . ";");
                        $r1 = mysqli_fetch_array($result);

                        $result = $mysqli->query("select totalquestions from test where testid=" . $_SESSION['testqn'] . ";");
                        $r2 = mysqli_fetch_array($result);
                        if ((int) $r1['q'] == (int) htmlspecialchars_decode($r2['totalquestions'],ENT_QUOTES))
                            echo "<div class=\"pmsg\">Status: All the Questions are Created for this test.</div>";
                        else
                            echo "<div class=\"pmsg\">Status: Still you need to create " . (htmlspecialchars_decode($r2['totalquestions'],ENT_QUOTES) - $r1['q']) . " Question/s. After that only, test will be available for candidates.</div><br><br>";
                        ?>
                        <?php
                        if (isset($_SESSION['testqn'])) {


                          if (isset($_REQUEST['add'])) {
                                /*                                 * ************************ Step 3 - Case 1 ************************ */
                                //Form for the new Question
                        ?>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Question <input type="hidden" name="qnid" /></label>
                                    <div class="col-sm-4"><textarea type="text" id = "question" class="form-control" required = "" name = "question" placeholder = "Enter your question here" value=""></textarea></div>
                                </div><br><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option A:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optiona" name="optiona" placeholder="Enter option A"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option B:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optionb" name="optionb" placeholder="Enter option B"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option C:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optionc" name="optionc" placeholder="Enter option C"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option D:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optiond" name="optiond" placeholder="Enter option D"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Correct Answer:</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="correctans">
                                            <option value="<Choose the Correct Answer>" selected>Choose the Correct Answer</option>
                                            <option value="optiona">Option A</option>
                                            <option value="optionb">Option B</option>
                                            <option value="optionc">Option C</option>
                                            <option value="optiond">Option D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2"></label>
                                    <div class="col-sm-4"><input type="hidden" name="marks" value="1" size="30" onkeyup="isnum(this)"/></div>
                                </div><br><br>

<?php
                            } else if (isset($_REQUEST['edit'])) {
                                /*                                 * ************************ Step 3 - Case 2 ************************ */
                                // To allow Editing Existing Question.
                                $result = $mysqli->query("select * from question where testid=" . $gid . " and qnid=" . $eid . ";");
                                if (mysqli_num_rows($result) == 0) {
                                } else if ($r = mysqli_fetch_array($result)) {
                                    //editing components
?>
                                    <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Question <input type="hidden" name="qnid" value="<?php echo $r['qnid']; ?>" /></label>
                                    <div class="col-sm-4"><textarea type="text" id = "question" class="form-control" required = "" name = "question" placeholder = "Enter your question here" value=""></textarea></div>
                                </div><br><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option A:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optiona" name="optiona" placeholder="Enter option A" value="<?php echo htmlspecialchars_decode($r['optiona'],ENT_QUOTES); ?>"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option B:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optionb" name="optionb" placeholder="Enter option B" value="<?php echo htmlspecialchars_decode($r['optionb'],ENT_QUOTES); ?>"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option C:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optionc" name="optionc" placeholder="Enter option C" value="<?php echo htmlspecialchars_decode($r['optionc'],ENT_QUOTES); ?>"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Option D:</label>
                                    <div class="col-sm-4"><input type="text" class="form-control" id="optiond" name="optiond" placeholder="Enter option D" value="<?php echo htmlspecialchars_decode($r['optiond'],ENT_QUOTES); ?>"></div>
                                </div><br><br>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2">Correct Answer:</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="correctans">
                                            <option value="<Choose the Correct Answer>" selected>Choose the Correct Answer</option>
                                            <option value="optiona" <?php if (strcmp(htmlspecialchars_decode($r['correctanswer'],ENT_QUOTES), "optiona") == 0)
                                        echo "selected"; ?>>Option A</option>
                                            <option value="optionb" <?php if (strcmp(htmlspecialchars_decode($r['correctanswer'],ENT_QUOTES), "optionb") == 0)
                                        echo "selected"; ?>>Option B</option>
                                            <option value="optionc" <?php if (strcmp(htmlspecialchars_decode($r['correctanswer'],ENT_QUOTES), "optionc") == 0)
                                        echo "selected"; ?>>Option C</option>
                                            <option value="optiond" <?php if (strcmp(htmlspecialchars_decode($r['correctanswer'],ENT_QUOTES), "optiond") == 0)
                                        echo "selected"; ?>>Option D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <label class="control-label col-sm-2"></label>
                                    <div class="col-sm-4"><input type="hidden" name="marks" value="1" size="30" onkeyup="isnum(this)" value="<?php echo htmlspecialchars_decode($r['marks'],ENT_QUOTES); ?>"/></div>
                                </div><br><br>
<?php
                                }
                            }

                            else {

                                /*                                 * ************************ Step 3 - Case 3 ************************ */
                                // Defualt Mode: Displays the Existing Question/s, If any.
                                $result = $mysqli->query("SELECT @row_number:=@row_number+1 AS row_number,qnid,question,correctanswer FROM question, (SELECT @row_number:=0) AS t where testid='".$gid."'");
                                if (mysqli_num_rows($result) == 0) {
                                    echo "<br><br><br><h3 style=\"color:#0000cc;text-align:center;\">No Questions Yet!</h3>";
                                } else {
                                    $i = 0;
                                    echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";
                    echo "<thead>";
                    echo    "<tr>";
                    echo    "<th>Qn.No</th>";
                    echo    "<th>Question</th>";
                    echo    "<th>Correct Answer</th>";
                    echo    "<th>Edit</th>";
                    echo    "<th>Delete</th>";
                    echo "</thead>";
					echo "<tfoot>";                    
					echo "<tr>";
					echo "<td colspan='7'>";
					echo "<ul class='pagination pull-right'></ul>";
					echo "</td>";
					echo "</tr>";
					echo "</tfoot>";
                    
?>
                                    
                    <?php

                    while($result1=mysqli_fetch_object($result))
                         {
                    $qnid = $result1->qnid;
                    echo "<tr class = 'josh'>";
                    echo "<td>" . $result1->row_number . "</td>";
                    echo "<td>" . $result1->question . "</td>";
                    echo "<td>" . $result1->correctanswer . "</td>";
                    echo "<td><a href='prepqn.php?id=".$gid."&edit=".$result1->qnid."'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></td></a>";
                    echo "<td><a href='#' id='$qnid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Delete</button></td></a>";
                    
                    }
                                    // while ($r = mysqli_fetch_array($result)) {
                                    //     $i = $i + 1;
                                    //     if ($i % 2 == 0)
                                    //         echo "<tr class=\"alt\">";
                                    //     else
                                    //         echo "<tr>";
                                    //     echo "<td style=\"text-align:center;\"><input type=\"checkbox\" name=\"d$i\" value=\"" . $r['qnid'] . "\" /></td><td> " . $i
                                    //     . "</td><td>" . htmlspecialchars_decode($r['question'],ENT_QUOTES) . "</td><td>" . htmlspecialchars_decode($r[htmlspecialchars_decode($r['correctanswer'],ENT_QUOTES)],ENT_QUOTES) . "</td><td>" . htmlspecialchars_decode($r['marks'],ENT_QUOTES) . "</td>"
                                    //     . "<td class=\"tddata\"><a title=\"Edit " . $r['qnid'] . "\"href=\"prepqn.php?edit=" . $r['qnid'] . "\"><img src=\"../images/edit.png\" height=\"30\" width=\"40\" alt=\"Edit\" /></a>"
                                    //     . "</td></tr>";
                                    // }
                    ?>
                                    </table>
<?php
                                }
                            }
                        }
?>
                <?php
if (isset($_SESSION['testqn'])) {
    // Navigations
?>
                       <!-- <li><input type="submit" value="LogOut" name="logout" class="btn btn-info" title="Log Out"/></li>-->

        <?php
        //navigation for Add option
        if (isset($_REQUEST['add'])) {
        ?>                  
                            
                            <br><br><div class="col-md-10"></div>
                            <input type="submit" value="Save" name="savea" class="btn btn-info" onclick="validateqnform('prepqn')" title="Save the Changes"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="Back" name="back" class="btn btn-info" title="Back"/>

<?php
        } else if (isset($_REQUEST['edit'])) { //navigation for Edit option
?>
                            <br><br><div class="col-md-10"></div>
                            <input type="submit" value="Save" name="savem" class="btn btn-info" onclick="validateqnform('prepqn')" title="Save the Changes"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="Back" name="back" class="btn btn-info" title="Back"/>
                            

                        <?php
                    } else {  //navigation for Default
                        ?>
                        <script type="text/javascript">
                        function goback(){
                            window.location.href='addedittest.php';
                        }
                        </script>
                        
                        <br><br><div class="col-md-9"></div>
                        <input type="submit" value="Add Questions" name="add" class="btn btn-info" title="Add Questions"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" value="Back" name="back" class="btn btn-info" title="back" onclick="goback()"/></input>
                        <?php }
                } ?>
                    </div>      
                </div>
            </div>
        </div>
        <?php
            include('menufooter.php');
        ?>
    </body>
</html>