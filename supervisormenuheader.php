<?php 
include('dbconfig.php');
if(!isset($_SESSION)) session_start();
if (!isset($_SESSION['logsession']) || $_SESSION['employee_level'] !== "2") {
  header("Location: login.php?loginla");
}
$employee_id = $_SESSION['logsession'];
$team = $_SESSION['employee_team'];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	 <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
	<script src="dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert2.css">
	<!--INPUT MASK -->
	<link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
	<!--STEPS JQUERY-->
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="js/jquery.steps.min.js"></script>
	
	<script src="sweetalert2-master/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert2.css">
	
	<!-- Include Required Prerequisites -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<!-- Include Date Range Picker -->
	  <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
	<script src="js/keypress.js"></script>
	
			 <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<style>
	nav{
		background-color:orange;
	}
	
	</style>
</head>

<body>
    <div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element"> 
							<span>
								<?php if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employee_id'")){
										while ($row22 = mysqli_fetch_object($result1))
										{echo "<img class='img-circle' src='images/".$row22->image."' alt='banner' width='48' height='48' />";}
									}
								?>
								
							</span>	 
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']  ?></strong>
							</span> <span class="text-muted text-xs block"><?php echo $_SESSION['employee_level'] ?><b class="caret"></b></span> </span> </a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div>
						<div class="logo-element">
							TL
						</div>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeehome2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="employeehome2.php"><i class="fa fa-home"></i><span class="nav-label">Home</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeprofile2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="employeeprofile2.php"><i class="fa fa-user"></i><span class="nav-label">Profile</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'attendance2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'logedit.php' OR basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php' OR basename($_SERVER['SCRIPT_NAME']) == 'dtr2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-clock-o"></i><span class="nav-label">Time Keeping</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'dtr2.php'){echo 'active'; }else { echo ''; } ?>"><a href="dtr2.php">DTR</a></li>
							<!--li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'attendance2.php'){echo 'active'; }else { echo ''; } ?>"><a href="attendance2.php">Attendance</a></li-->
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'logedit.php'){echo 'active'; }else { echo ''; } ?>"><a href="logedit.php">Log edit requests</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php'){echo 'active'; }else { echo ''; } ?>"><a href="logedittracker.php">Log edit status</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'additionalpayable.php'){echo 'active'; }else { echo ''; } ?>"><a href="additionalpayable.php">Others application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'additionalpayablestatus.php'){echo 'active'; }else { echo ''; } ?>"><a href="additionalpayablestatus.php">Others status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminovertimeapplication2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'overtimeapproval2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'overtimetracer2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-clock-o"></i><span class="nav-label">Overtime Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminovertimeapplication2.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminovertimeapplication2.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimeapproval2.php'){echo 'active'; }else { echo ''; } ?>"><a href="overtimeapproval2.php">Pending</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimetracer2.php'){echo 'active'; }else { echo ''; } ?>"><a href="overtimetracer2.php">Status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminleaveapplication2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'leaveapproval2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'leavetracer2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-briefcase"></i><span class="nav-label">Leave Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminleaveapplication2.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminleaveapplication2.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leaveapproval2.php'){echo 'active'; }else { echo ''; } ?>"><a href="leaveapproval2.php">Approval</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leavetracer2.php'){echo 'active'; }else { echo ''; } ?>"><a href="leavetracer2.php">Status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanapplication2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'employeeloanstatus2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-money"></i><span class="nav-label">Loan</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanapplication2.php'){echo 'active'; }else { echo ''; } ?>"><a href="loanapplication2.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeloanstatus2.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeeloanstatus2.php">Status</a></li>
						</ul>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coaching2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'coachingresult2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'coachingupdated2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-smile-o"></i><span class="nav-label">Coaching</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coaching2.php'){echo 'active'; }else { echo ''; } ?>"><a href="coaching2.php">New</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coachingresult2.php'){echo 'active'; }else { echo ''; } ?>"><a href="coachingresult2.php">Update</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coachingupdated2.php'){echo 'active'; }else { echo ''; } ?>"><a href="coachingupdated2.php">Result</a></li>
						</ul>
					</li>
					
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inquiry2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'answeredinquiry2.php'  OR basename($_SERVER['SCRIPT_NAME']) == 'employeeinquiry2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-question"></i><span class="nav-label">Inquiries</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeinquiry2.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeeinquiry2.php">Inquire</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inquiry2.php'){echo 'active'; }else { echo ''; } ?>"><a href="inquiry2.php">Pending</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'answeredinquiry2.php'){echo 'active'; }else { echo ''; } ?>"><a href="answeredinquiry2.php">Answered</a></li>
						</ul>
					</li>
				
					
					

	
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcement2.php' OR basename($_SERVER['SCRIPT_NAME']) == 'announcementlist2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-exclamation"></i><span class="nav-label">Announcements</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcement2.php'){echo 'active'; }else { echo ''; } ?>"><a href="announcement2.php">Post announcement</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcementlist2.php'){echo 'active'; }else { echo ''; } ?>"><a href="announcementlist2.php">Announcement list</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'applicants2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="applicants2.php"><i class="fa fa-file-o"></i><span class="nav-label">Interview</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'images2.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="images2.php?"><i class="fa fa-image"></i><span class="nav-label">Gallery</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payslip.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="payslip.php"><i class="fa fa-file"></i><span class="nav-label">Payslip</span></a>
					</li>
				</ul>
			</div>
		</nav>
        <div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<span class="m-r-sm text-muted welcome-message">Welcome <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']  ?></span>
						</li>
						<!--<li class="dropdown">
							<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
							</a>
							<ul class="dropdown-menu dropdown-messages">
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="img/a7.jpg">
										</a>
										<div>
											<small class="pull-right">46h ago</small>
											<strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
											<small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="img/a4.jpg">
										</a>
										<div>
											<small class="pull-right text-navy">5h ago</small>
											<strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
											<small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="img/profile.jpg">
										</a>
										<div>
											<small class="pull-right">23h ago</small>
											<strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
											<small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="text-center link-block">
										<a href="mailbox.html">
											<i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
										</a>
									</div>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
							</a>
							<ul class="dropdown-menu dropdown-alerts">
								<li>
									<a href="mailbox.html">
										<div>
											<i class="fa fa-envelope fa-fw"></i> You have 16 messages
											<span class="pull-right text-muted small">4 minutes ago</span>
										</div>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="profile.html">
										<div>
											<i class="fa fa-twitter fa-fw"></i> 3 New Followers
											<span class="pull-right text-muted small">12 minutes ago</span>
										</div>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="grid_options.html">
										<div>
											<i class="fa fa-upload fa-fw"></i> Server Rebooted
											<span class="pull-right text-muted small">4 minutes ago</span>
										</div>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<div class="text-center link-block">
										<a href="notifications.html">
											<strong>See All Alerts</strong>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</li>
							</ul>
						</li> -->
						<li>
							<a href="logout.php">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
						<!--<li>
							<a class="right-sidebar-toggle">
								<i class="fa fa-tasks"></i>
							</a>
						</li>-->
					</ul>
				</nav>
			</div>