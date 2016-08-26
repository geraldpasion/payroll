<?php 
include('dbconfig.php');
if (session_status() == PHP_SESSION_NONE) {
    			session_start();
			}
if (!isset($_SESSION['logsession']) || $_SESSION['employee_level'] !== "1") {
  header("Location: login.php");
  exit();
}
$employee_id = $_SESSION['logsession'];
if(!isset($employee_id)){
	include 'logout.php';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	<!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
							<!-- Include Required Prerequisites -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	 
	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
	<script src="js/keypress.js"></script>
	
		
			 <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element"> <span>
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
							<!--<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="profile.html">Profile</a></li>
								<li><a href="contacts.html">Contacts</a></li>
								<li><a href="mailbox.html">Mailbox</a></li>
								<li class="divider"></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>-->
						</div>
						<div class="logo-element">
							EMP
						</div>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeehome.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="employeehome.php"><i class="fa fa-home"></i><span class="nav-label">Home</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeprofile.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="employeeprofile.php"><i class="fa fa-user"></i><span class="nav-label">Profile</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeedtr.php' OR basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-clock-o"></i><span class="nav-label">Time Keeping</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'dtr2.php'){echo 'active'; }else { echo ''; } ?>"><a href="dtr2.php">DTR</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php'){echo 'active'; }else { echo ''; } ?>"><a href="logedittracker.php">Log edit status</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'additionalpayable.php'){echo 'active'; }else { echo ''; } ?>"><a href="additionalpayable.php">Others Application</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'additionalpayablestatus.php'){echo 'active'; }else { echo ''; } ?>"><a href="additionalpayablestatus.php">Others Status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimeapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'employeeovertimestatus.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-moon-o"></i><span class="nav-label">Overtime</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimeapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="overtimeapplication.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeovertimestatus.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeeovertimestatus.php">Status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leaveapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'employeeleavestatus.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-plane"></i><span class="nav-label">Leave</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leaveapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="leaveapplication.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeleavestatus.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeeleavestatus.php">Status</a></li>
						</ul>
					</li>
					
										
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'employeeloanstatus.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-money"></i><span class="nav-label">Loan</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="loanapplication.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeloanstatus.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeeloanstatus.php">Status</a></li>
						</ul>

	
					</li>
					
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeecoaching.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="employeecoaching.php"><i class="fa fa-smile-o"></i><span class="nav-label">Coaching</span></a>
					</li>

					</li>
					
					
				
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeinquiry.php' OR basename($_SERVER['SCRIPT_NAME']) == 'employeeinquiryanswers.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-question"></i><span class="nav-label">Inquiries</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeinquiry.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeeinquiry.php">New</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeinquiryanswers.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeeinquiryanswers.php">Result</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeeannouncementlist.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="employeeannouncementlist.php"><i class="fa fa-smile-o"></i><span class="nav-label">Announcement List</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'images3.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="images3.php"><i class="fa fa-image"></i><span class="nav-label">Gallery</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'emppayslip.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="emppayslip.php"><i class="fa fa-file"></i><span class="nav-label">Payslip</span></a>
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
						<span class="m-r-sm text-muted welcome-message">Welcome <?php echo $_SESSION['fname'] ?></span>
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
					</li>
				-->	<li>
				
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