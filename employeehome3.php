<!DOCTYPE html>
<html>
	<head>
		<?php
			include('menuheader.php');
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
							$result = $mysqli->query("SELECT COUNT(leave_status) AS total FROM tbl_leave WHERE leave_status = 'Pending'")->fetch_array();
							$result2 = $mysqli->query("SELECT COUNT(leave_status) AS total FROM tbl_leave WHERE leave_status = 'Approved'")->fetch_array();
							$result3 = $mysqli->query("SELECT COUNT(leave_status) AS total FROM tbl_leave WHERE leave_status = 'Disapproved'")->fetch_array();
							$result4 = $mysqli->query("SELECT COUNT(overtime_status) AS total FROM overtime WHERE overtime_status = 'Pending'")->fetch_array();
							$result5 = $mysqli->query("SELECT COUNT(overtime_status) AS total FROM overtime WHERE overtime_status = 'Approved'")->fetch_array();
							$result6 = $mysqli->query("SELECT COUNT(overtime_status) AS total FROM overtime WHERE overtime_status = 'Disapproved'")->fetch_array();
							$result7 = $mysqli->query("SELECT COUNT(coaching_status) AS total FROM coaching WHERE coaching_status = 'Pending'")->fetch_array();
							$result8 = $mysqli->query("SELECT COUNT(coaching_status) AS total FROM coaching WHERE coaching_status = 'Completed'")->fetch_array();
							$result9 = $mysqli->query("SELECT * FROM announcement ORDER BY announcement_date DESC LIMIT 1")->fetch_array();
							$result10 = $mysqli->query("SELECT COUNT(loanstatus) AS total FROM loan WHERE loanstatus = 'Pending'")->fetch_array();
							$result11 = $mysqli->query("SELECT COUNT(loanstatus) AS total FROM loan WHERE loanstatus = 'Approved'")->fetch_array();
							$result12 = $mysqli->query("SELECT COUNT(loanstatus) AS total FROM loan WHERE loanstatus = 'Disapproved'")->fetch_array();
							$result13 = $mysqli->query("SELECT COUNT(inquiry_status) AS total FROM inquiry WHERE inquiry_status = 'Pending'")->fetch_array();
							$result14 = $mysqli->query("SELECT COUNT(inquiry_status) AS total FROM inquiry WHERE inquiry_status = 'answered'")->fetch_array();
							$result15 = $mysqli->query("SELECT COUNT(applicant_status) AS total FROM emp_data WHERE applicant_status = 'For interview'")->fetch_array();
				
							
							
							
							
					
		?>
	</head>
	<body>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
					<div class="col-lg-4">
					<a href = "attendance.php">
					<div class="widget lazur-bg p-xl">
					                                <h2>
                                    <span class="fa fa-clock-o m-r-xs"></span>DTR
                                </h2>
					<?php
							include('dbconfig.php');

								if ($resultx = $mysqli->query("SELECT * FROM attendance WHERE employee_id = $employee_id AND (attendance.status = 'Done' OR attendance.attendance_status = 'active') ORDER BY attendance_date DESC")) //get records from db
								{
									if ($resultx->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped ' data-page-size='2' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>Date</th>";
										echo "<th>In</th>";
										echo "<th>Out</th>";
										echo "</tr>";
										echo "</thead>";
										while ($row = $resultx->fetch_object())
										{
											$timeindisplay = date("g : i : A",strtotime($row->attendance_timein));
											$breakoutdisplay = date("g : i : A",strtotime($row->attendance_breakout));
											$breakindisplay = date("g : i : A",strtotime($row->attendance_breakin));
											$timeoutdisplay = date("g : i : A",strtotime($row->attendance_timeout));
											echo "<tr style='background-color:transparent'>";
											echo "<td>" . date("F d, Y",strtotime($row->attendance_date)) . "</td>";
											echo "<td>" . date("g:i A",strtotime($row->attendance_timein)) . "</td>";
											if($row->attendance_timeout == ""){
                                                echo "<td></td>";
                                            }else{
                                                echo "<td>" . date("g:i A",strtotime($row->attendance_timeout)) . "</td>";
                                            }
											
											echo "</tr>";
										}
										echo "</table>";
									}
								}
							
						?>

					
					</div>	
					</a>		
				</div>
						<div class="col-lg-4">
				<a href = "overtimetracer.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-clock-o m-r-xs"></span>Overtime status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP echo $result4['total']; ?> Pending</label>
                            </li>
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
				<a href = "leaveapproval.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-plane m-r-xs"></span>Leave status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP echo $result['total']; ?> Pending</label>
                               
                            </li>
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
								<a href = "coachingresult.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-smile-o m-r-xs"></span>Coaching
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP echo $result7['total']; ?> Pending</label>
                            </li>
                            <li>
                                <span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result8['total']; ?> Completed</label>
                            </li>

                        </ul>
                    </div>
					</a>
				</div>
								<div class="col-lg-4">
				<a href = "inquiry.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-money m-r-xs"></span>Inquiry status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP echo $result13['total']; ?> Pending</label>
                            </li>
                            <li>
                                <span class="fa fa-thumbs-up m-r-xs"></span>
                                <label><?PHP echo $result14['total']; ?> Answered</label>
                            </li>

                        </ul>
                    </div>
					</a>
				</div>
			<div class="col-lg-4">
                <a href="announcementlist.php">
		                       <div class="widget red-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-bell fa-4x"></i>
                            <h3 class="font-bold no-margins">
                                Announcement
                            </h3>
							 <small><?PHP if($result9['announcement_date']==""){echo"";} else {echo date("F d, Y",strtotime($result9['announcement_date']));} ?> </small><br>
                            <div style="word-wrap:break-word;"><label><?PHP if($result9['announcement_details']==""){echo"";} else {echo $result9['announcement_details'];} ?> </label></div>
                        </div>
                    </div>
                </a>
			</div>

			</div>
			<div class="row">

				<div class="col-lg-4">
				<a href = "loanapproval.php">
                    <div class="widget lazur-bg p-xl">
                                <h2>
                                    <span class="fa fa-money m-r-xs"></span>Loan status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP echo $result10['total']; ?> Pending</label>
                            </li>
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
				<a href = "applicants.php">
                    <div class="widget yellow-bg p-xl">
                                <h2>
                                    <span class="fa fa-user m-r-xs"></span>Interview status
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-clipboard m-r-xs"></span>
                                <label><?PHP echo $result15['total']; ?> For interview</label>
                            </li>
														<li>
								<label></label>
							</li>
														<li>
								<label></label>
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