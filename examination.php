 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>

<script type="text/javascript">//ajax
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var employee_id = element.attr("id");
			var info = 'employee_id1=' + employee_id;
			 $.ajax({
			   type: "POST",
			   url: "deactivateemployee.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").animate({ backgroundColor: "white" }, "slow")
			  .animate({ opacity: "hide" }, "slow");
			 $('#success').fadeIn(300).delay(3200).fadeOut(300);
			 $(window).scrollTop(0);
			return false;
			});
			});
		</script>
		<title>Manage subjects</title>
	</head>

	<body>
		<div class="row"> 
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
					<h5>Manage subjects</h5>
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
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						
						<?php

						error_reporting(0);
						session_start();
						include_once '../oesdb.php';
						/* * ************************ Step 1 ************************ */
						if (!isset($_SESSION['admname'])) {
							$_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
						} else if (isset($_REQUEST['logout'])) {
							/*     * ************************ Step 2 - Case 1 ************************ */
							//Log out and redirect login page
							unset($_SESSION['admname']);
							header('Location: index.php');
						} else if (isset($_REQUEST['dashboard'])) {
							/*     * ************************ Step 2 - Case 2 ************************ */
							//redirect to dashboard
							header('Location: admwelcome.php');
						} else if (isset($_REQUEST['delete'])) {
							/*     * ************************ Step 2 - Case 3 ************************ */
							//deleting the selected Subjects
							unset($_REQUEST['delete']);
							$hasvar = false;
							foreach ($_REQUEST as $variable) {
								if (is_numeric($variable)) { //it is because, some session values are also passed with request
									$hasvar = true;

									if (!@executeQuery("delete from subject where subid=$variable")) {
										if (mysql_errno () == 1451) //Children are dependent value
											$_GLOBALS['message'] = "Too Prevent accidental deletions, system will not allow propagated deletions.<br/><b>Help:</b> If you still want to delete this subject, then first delete the tests that are conducted/dependent on this subject.";
										else
											$_GLOBALS['message'] = mysql_errno();
									}
								}
							}
							if (!isset($_GLOBALS['message']) && $hasvar == true)
								$_GLOBALS['message'] = "Selected Subject/s are successfully Deleted";
							else if (!$hasvar) {
								$_GLOBALS['message'] = "First Select the subject/s to be Deleted.";
							}
						} else if (isset($_REQUEST['savem'])) {
							/*     * ************************ Step 2 - Case 4 ************************ */
							//updating the modified values
							if (empty($_REQUEST['subname']) || empty($_REQUEST['subdesc'])) {
								$_GLOBALS['message'] = "Some of the required Fields are Empty.Therefore Nothing is Updated";
							} else {
								$query = "update subject set subname='" . htmlspecialchars($_REQUEST['subname'], ENT_QUOTES) . "', subdesc='" . htmlspecialchars($_REQUEST['subdesc'], ENT_QUOTES) . "'where subid=" . $_REQUEST['subject'] . ";";
								if (!@executeQuery($query))
									$_GLOBALS['message'] = mysql_error();
								else
									$_GLOBALS['message'] = "Subject Information is Successfully Updated.";
							}
							closedb();
						}
						else if (isset($_REQUEST['savea'])) {
							/*     * ************************ Step 2 - Case 5 ************************ */
							//Add the new Subject information in the database
							$result = executeQuery("select max(subid) as sub from subject");
							$r = mysql_fetch_array($result);
							if (is_null($r['sub']))
								$newstd = 1;
							else
								$newstd=$r['sub'] + 1;

							$result = executeQuery("select subname as sub from subject where subname='" . htmlspecialchars($_REQUEST['subname'], ENT_QUOTES) . "';");
							// $_GLOBALS['message']=$newstd;
							if (empty($_REQUEST['subname']) || empty($_REQUEST['subdesc'])) {
								$_GLOBALS['message'] = "Some of the required Fields are Empty";
							} else if (mysql_num_rows($result) > 0) {
								$_GLOBALS['message'] = "Sorry Subject Already Exists.";
							} else {
								$query = "insert into subject values($newstd,'" . htmlspecialchars($_REQUEST['subname'], ENT_QUOTES) . "','" . htmlspecialchars($_REQUEST['subdesc'], ENT_QUOTES) . "',NULL)";
								if (!@executeQuery($query)) {
									if (mysql_errno () == 1062) //duplicate value
										$_GLOBALS['message'] = "Given Subject Name voilates some constraints, please try with some other name.";
									else
										$_GLOBALS['message'] = mysql_error();
								}
								else
									$_GLOBALS['message'] = "Successfully New Exam is Created.";
							}
							closedb();
						}
						?>
					 <form name="examination" action="examination.php" method="post" class="form-horizontal">
					 
					
						<?php
						if (isset($_SESSION['admname'])) {
						// Navigations
						?>
												<!--<li><input type="submit" value="LogOut" name="logout" class="btn btn-info" title="Log Out"/></li>-->
												<input type="submit" value="Back" name="dashboard" class="btn btn-info" title="Dash Board"/>

						<?php
							//navigation for Add option
							if (isset($_REQUEST['add'])) {
						?>
												<input type="submit" value="Cancel" name="cancel" class="btn btn-info" title="Cancel"/>
												<input type="submit" value="Save" name="savea" class="btn btn-info" onclick="validatesubform('examination')" title="Save the Changes"/>

						<?php
							} else if (isset($_REQUEST['edit'])) { //navigation for Edit option
						?>
												<input type="submit" value="Cancel" name="cancel" class="btn btn-info" title="Cancel"/>
												<input type="submit" value="Save" name="savem" class="btn btn-info" onclick="validatesubform('examination')" title="Save the changes"/>

						<?php
							} else {  //navigation for Default
						?>
												<input type="submit" value="Delete" name="delete" class="btn btn-info" title="Delete"/>
												<input type="submit" value="Add" name="add" class="btn btn-info" title="Add"/>
						<?php }
						} ?>
                   <?php
if (isset($_SESSION['admname'])) {

    if (isset($_REQUEST['add'])) {

        /*         * ************************ Step 3 - Case 1 ************************ */
        //Form for the new Subject
?>

<table cellpadding="20" cellspacing="20" style="text-align:left;margin-left:15em" >
                        <tr>
                            <td>Subject Name</td>
                            <td><input type="text" name="subname" value="" size="16" onkeyup="isalphanum(this)" onblur="if(this.value==''){alert('Subject Name is Empty');this.focus();this.value='';}"/></td>

                        </tr>

                        <tr>
                            <td>Subject Description</td>
                            <td><textarea name="subdesc" cols="20" rows="3" onblur="if(this.value==''){alert('Subject Description is Empty');this.focus();this.value='';}"></textarea></td>
                        </tr>

                    </table>
						
						<?php
    } else if (isset($_REQUEST['edit'])) {

        /*         * ************************ Step 3 - Case 2 ************************ */
        // To allow Editing Existing Subject.
        $result = executeQuery("select subid,subname,subdesc from subject where subname='" . htmlspecialchars($_REQUEST['edit'], ENT_QUOTES) . "';");
        if (mysql_num_rows($result) == 0) {
            header('examination.php');
        } else if ($r = mysql_fetch_array($result)) {


            //editing components
?>
<table cellpadding="20" cellspacing="20" style="text-align:left;margin-left:15em" >
                        <tr>
                            <td>Subject Name</td>
                            <td><input type="text" name="subname" value="<?php echo htmlspecialchars_decode($r['subname'], ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)"/></td>

                        </tr>
                        <tr>
                            <td>Subject Description</td>
                            <td><textarea name="subdesc" cols="20" rows="3"><?php echo htmlspecialchars_decode($r['subdesc'], ENT_QUOTES); ?></textarea><input type="hidden" name="subject" value="<?php echo $r['subid']; ?>"/></td>
                        </tr>
                    </table>
					
					<?php
                    closedb();
                }
            } else {

                /*                 * ************************ Step 3 - Case 3 ************************ */
                // Defualt Mode: Displays the Existing Subject/s, If any.
                $result = executeQuery("select * from subject order by subid;");
                if (mysql_num_rows($result) == 0) {
                    echo "<h3 style=\"color:#0000cc;text-align:center;\">No Subjets Yet..!</h3>";
                } else {
                    $i = 0;
?>
                    <table cellpadding="30" cellspacing="10" class="datatable">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Subject Name</th>
                            <th>Subject Description</th>
                            <th>Edit</th>
                        </tr>
<?php
                    while ($r = mysql_fetch_array($result)) {
                        $i = $i + 1;
                        if ($i % 2 == 0) {
                            echo "<tr class=\"alt\">";
                        } else {
                            echo "<tr>";
                        }
                        echo "<td style=\"text-align:center;\"><input type=\"checkbox\" name=\"d$i\" value=\"" . $r['subid'] . "\" /></td><td>" . htmlspecialchars_decode($r['subname'], ENT_QUOTES)
                        . "</td><td>" . htmlspecialchars_decode($r['subdesc'], ENT_QUOTES) . "</td>"
                        . "<td class=\"tddata\"><a title=\"Edit " . htmlspecialchars_decode($r['stdname'], ENT_QUOTES) . "\"href=\"examination.php?edit=" . htmlspecialchars_decode($r['subname'], ENT_QUOTES) . "\"><img src=\"../images/edit.png\" height=\"30\" width=\"40\" alt=\"Edit\" /></a></td></tr>";
                    }
?>
                    </table>
<?php
                }
                closedb();
            }
        }
?>
					</div>		
				</div>
			</div>
        </div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>