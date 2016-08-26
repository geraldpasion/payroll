<!DOCTYPE html>
<html>
	<head>
		<?php
			include('employeemenuheader.php');
			$employee_id = $_SESSION['logsession'];
		?>
		<title>Home</title>
		<style>
			.btn3{
				margin-left:13em;
			}
			.btn2{
				margin-left:2.5em;
			}
		</style>
		<?php
                            include('dbconfig.php');
                            $result = $mysqli->query("SELECT COUNT(*) AS total FROM tbl_leave INNER JOIN employee ON employee.employee_id = tbl_leave.employee_id WHERE leave_status = 'Pending'")->fetch_array();
                            $result2 = $mysqli->query("SELECT COUNT(*) AS total FROM tbl_leave WHERE employee_id = $employee_id AND leave_status = 'Approved'")->fetch_array();
                            $result3 = $mysqli->query("SELECT COUNT(*) AS total FROM tbl_leave WHERE employee_id = $employee_id AND leave_status = 'Disapproved'")->fetch_array();
                            $result4 = $mysqli->query("SELECT COUNT(*) AS total FROM overtime RIGHT JOIN employee ON employee.employee_id = overtime.employee_id WHERE overtime.overtime_status = 'Pending'")->fetch_array();
                            $result5 = $mysqli->query("SELECT COUNT(*) AS total FROM overtime WHERE employee_id = $employee_id AND overtime_status = 'Approved'")->fetch_array();
                            $result6 = $mysqli->query("SELECT COUNT(*) AS total FROM overtime WHERE employee_id = $employee_id AND overtime_status = 'Disapproved'")->fetch_array();
                            $result7 = $mysqli->query("SELECT COUNT(*) AS total FROM coaching WHERE employee_id = '$employee_id'")->fetch_array();
                            $result8 = $mysqli->query("SELECT COUNT(*) AS total FROM coaching WHERE employee_id = '$employee_id'")->fetch_array();
                            $result9 = $mysqli->query("SELECT * FROM announcement WHERE announcement_archive = 'active' ORDER BY announcement_id DESC LIMIT 1")->fetch_array();
                            $result10 = $mysqli->query("SELECT COUNT(*) AS total FROM loan WHERE employee_id = '$employee_id' AND loanstatus='Pending'")->fetch_array();
                            $result11 = $mysqli->query("SELECT COUNT(*) AS total FROM loan WHERE employee_id = '$employee_id' AND loanstatus='Approved'")->fetch_array();
                            $result12 = $mysqli->query("SELECT COUNT(*) AS total FROM loan WHERE employee_id = '$employee_id' AND loanstatus='Disapproved'")->fetch_array();
                            $result13 = $mysqli->query("SELECT COUNT(*) AS total FROM inquiry WHERE employee_id = $employee_id AND inquiry_status = 'Pending'")->fetch_array();
                            $result14 = $mysqli->query("SELECT COUNT(*) AS total FROM inquiry WHERE employee_id = $employee_id AND inquiry_status = 'Answered'")->fetch_array();
                            $result15 = $mysqli->query("SELECT COUNT(applicant_status) AS total FROM emp_data WHERE applicant_status = 'For interview'")->fetch_array();
                            //$result16 = $mysqli->query("SELECT COUNT(*) AS total FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE logedit_status ='Pending'")->fetch_array();
                            $result17 = $mysqli->query("SELECT COUNT(*) AS total FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE employee.employee_id = '$employee_id' AND logedit_status = 'Approved' AND employee_level = 1")->fetch_array();
                            $result18 = $mysqli->query("SELECT COUNT(*) AS total FROM logedit INNER JOIN employee ON employee.employee_id = logedit.employee_id WHERE employee.employee_id = '$employee_id' AND logedit_status = 'Disapproved'")->fetch_array();

        ?>
	</head>
	<body>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
			     <div class="col-lg-4">
                    <!--a href = "logedittracker.php"-->
                    <div class="widget lazur-bg p-xl">
                        <h2>
                            <span class="fa fa-clock-o m-r-xs"></span>Log edit
                        </h2>
                       <ul class="list-unstyled m-t-md">
                            <!--li>
                                <a href = "logedit.php" style="color:white"><span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP //echo $result16['total']; ?> Pending</label></a>
                            </li-->
                            <li>
                                <a href = "logedittracker.php" style="color:white"><span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result17['total']; ?> Approved</label></a>
                            </li>
                            <li>
                                <a href = "logedittracker.php" style="color:white"><span class="fa fa-thumbs-down m-r-xs"></span>
                                <label><?PHP echo $result18['total']; ?> Disapproved</label></a>
                            </li>
                                                        <li>
                            <label></label>
                            </li>
                        </ul>
                    </div>  
                    <!--/a-->        
                </div>
				<div class="col-lg-4">
				<a href = "employeeovertimestatus.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-clock-o m-r-xs"></span>Overtime status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <!--li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP //echo $result4['total']; ?> Pending</label>
                            </li-->
                            <li>
                                <span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result5['total']; ?> Approved</label>
                            </li>
                            <li>
                                <span class="fa fa-thumbs-down m-r-xs"></span>
                                <label><?PHP echo $result6['total']; ?> Disapproved</label>
                            </li>
														<li>
							<label></label>
							</li>
                        </ul>
                    </div>
					</a>
				</div>
                <div class="col-lg-4">
				<a href = "employeeleavestatus.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-plane m-r-xs"></span>Leave status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <!--li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP// echo $result['total']; ?> Pending</label>
                               
                            </li-->
                            <li>
                                <span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result2['total']; ?> Approved</label>
                            </li>
                            <li>
                                <span class="fa fa-thumbs-down m-r-xs"></span>
                                <label><?PHP echo $result3['total']; ?> Disapproved</label>
                            </li>
							<li>
								<label></label>
							</li>
                        </ul>
                    </div>
					</a>
				</div>
									
					

			

           </div>
		    <div class="row">
							                <div class="col-lg-4">
								<a href = "employeecoaching.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-smile-o m-r-xs"></span>Coaching
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <!--li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP //echo $result7['total']; ?> Pending</label>
                            </li-->
                            <li>
                                <span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result8['total']; ?> Completed</label>
                            </li>

                        </ul>
                    </div>
					</a>
				</div>
								<div class="col-lg-4">
				<a href = "employeeinquiryanswers.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-money m-r-xs"></span>Inquiry status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <!--li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP //echo $result13['total']; ?> Pending</label>
                            </li-->
                            <li>
                                <span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result14['total']; ?> Answered</label>
                            </li>

                        </ul>
                    </div>
					</a>
				</div>
			<div class="col-lg-4">
                <!--a href="announcementlist.php"-->
                               <div class="widget red-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-bell fa-2x" style="color:white"></i>
                            <h3 class="font-bold no-margins" style="color:white">
                                Announcement
                            </h3>
                             <small style="color:white"><?PHP if($result9['announcement_date']==""){echo"";} else {echo date("F d, Y",strtotime($result9['announcement_date']));} ?> </small><br><br>
                            <div style="word-wrap:break-word;"><label class="show-read-more" style="color:white;font-size:14px;"><?PHP if($result9['announcement_details']==""){echo"";} else {echo $result9['announcement_details'];} ?> </label></div>
                            <script>
                            $(document).ready(function(){
                                var maxLength = 80;
                                $(".show-read-more").each(function(){
                                    var myStr = $(this).text();
                                    if($.trim(myStr).length > maxLength){
                                        var newStr = myStr.substring(0, maxLength);
                                        var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                                        $(this).empty().html(newStr);
                                        $(this).append('<br><a href="employeeannouncementlist.php" class="read-more" style="color:white;font-size:10px;">..read more</a>');
                                     $(this).append('<br><br><a href="employeeannouncementlist.php" style="color:white;font-size:10px;">See more announcements</a>');
                                    }
                                    else if($.trim(myStr).length < maxLength){
                                        $(this).append('<br><br><a href="employeeannouncementlist.php" style="color:white;font-size:10px;">See more announcements</a>');
                                    }
                                });
                                $(".read-more").click(function(){
                                    $(this).siblings(".more-text").contents().unwrap();
                                    $(this).remove();
                                });
                            });
                            </script>
                        </div>
                    </div>
                <!--/a-->
            </div>

			</div>
			<div class="row">

				<div class="col-lg-4">
				<a href = "employeeloanstatus.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-money m-r-xs"></span>Loan status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <!--li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP //echo $result10['total']; ?> Pending</label>
                            </li-->
                            <li>
                                <span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result11['total']; ?> Approved</label>
                            </li>
                            <li>
                                <span class="fa fa-thumbs-down m-r-xs"></span>
                                <label><?PHP echo $result12['total']; ?> Disapproved</label>
                            </li>
                        </ul>
                    </div>
					</a>
				</div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="carousel slide" id="carousel1">
                                <div class="carousel-inner">
                                <?php
                                $result = mysqli_query($mysqli, "select count(*) as num from image");
                                while($row = mysqli_fetch_array($result)){
                                    $bilang=$row['num'];
                                }
                                for($co=1;$bilang>=$co;$co++){
                                    $result1 = mysqli_query($mysqli, "SELECT (@row_number:=@row_number + 1) AS num, p_id, p_img FROM image,(SELECT @row_number:=0) AS t group by num having num = $co");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                $im1=$row1['p_img'];
                                            }      
                                                    if($co==1){
                                                    echo '<div class="item active">
                                                           <img alt="image" style="height:200px;" class="img-responsive" src="'.$im1.'">
                                                          </div>';
                                                    }
                                                    else{
                                                    echo  '<div class="item">
                                                            <img alt="image" style="height:200px;" class="img-responsive" src="'.$im1.'">
                                                          </div>'; 
                                                    }            
                                }
                                ?>
                                </div>
<a data-slide="prev" href="#carousel1" class="left carousel-control">
                                    <span class="icon-prev"></span>
                                </a>
                                <a data-slide="next" href="#carousel1" class="right carousel-control">
                                    <span class="icon-next"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
	
			
			</div>
		</div>
        

       <?php
			include('employeemenufooter.php');
		?>			

	</body>
</html>