<?php 
include('dbconfig.php');
session_start();
if (!isset($_SESSION['logsession']) || $_SESSION['employee_level'] !== "3") {
  header("Location: login.php?loginla");
}
$employee_id = $_SESSION['logsession'];
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
							<span><img alt="image" class="img-circle" src="img/profile_small.jpg" /></span>	 
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']  ?></strong>
							</span> <span class="text-muted text-xs block"><?php echo $_SESSION['emptype'] ?><b class="caret"></b></span> </span> </a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="profile.html">Profile</a></li>
								<li><a href="contacts.html">Contacts</a></li>
								<li><a href="mailbox.html">Mailbox</a></li>
								<li class="divider"></li>
								<li><a href="login.html">Logout</a></li>
							</ul>
						</div>
						<div class="logo-element">
							HRIS
						</div>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnew.php' OR basename($_SERVER['SCRIPT_NAME']) == 'employeelist.php' OR basename($_SERVER['SCRIPT_NAME']) == 'inactiveemployeelist.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#" ><i class="fa fa-group"></i><span class="nav-label ">Employee Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnew.php'){echo 'active'; }else { echo ''; } ?>"><a href="addnew.php">Add new</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeelist.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeelist.php">Active Employee list</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inactiveemployeelist.php'){echo 'active'; }else { echo ''; } ?>"><a href="inactiveemployeelist.php">Inactive employee list</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnewholiday.php' OR basename($_SERVER['SCRIPT_NAME']) == 'legalholiday.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="legalholiday.php"><i class="fa fa-gift"></i><span class="nav-label">Holiday Management</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnewholiday.php'){echo 'active'; }else { echo ''; } ?>"><a href="addnewholiday.php">Add holiday</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'legalholiday.php'){echo 'active'; }else { echo ''; } ?>"><a href="legalholiday.php">Holiday list</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminleaveapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'leaveapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'leavetracer.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-briefcase"></i><span class="nav-label">Leave Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminleaveapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminleaveapplication.php">Leave application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leaveapproval.php'){echo 'active'; }else { echo ''; } ?>"><a href="leaveapproval.php">Leave approval</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leavetracer.php'){echo 'active'; }else { echo ''; } ?>"><a href="leavetracer.php">Leave tracker</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminovertimeapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'overtimeapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'overtimetracer.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-clock-o"></i><span class="nav-label">Overtime Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminovertimeapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminovertimeapplication.php">Overtime application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimeapproval.php'){echo 'active'; }else { echo ''; } ?>"><a href="overtimeapproval.php">Overtime approval</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimetracer.php'){echo 'active'; }else { echo ''; } ?>"><a href="overtimetracer.php">Overtime tracker</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminoloanapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'loanapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'overtimetracer.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-clock-o"></i><span class="nav-label">Loan Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminloanapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminloanapplication.php">Loan application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanapproval.php'){echo 'active'; }else { echo ''; } ?>"><a href="loanapproval.php">Loan approval</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loantracer.php'){echo 'active'; }else { echo ''; } ?>"><a href="loantracer.php">Loan tracker</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inquiry.php' OR basename($_SERVER['SCRIPT_NAME']) == 'answeredinquiry.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-question"></i><span class="nav-label">Inquiries</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inquiry.php'){echo 'active'; }else { echo ''; } ?>"><a href="inquiry.php">Inquiries</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'answeredinquiry.php'){echo 'active'; }else { echo ''; } ?>"><a href="answeredinquiry.php">Answered inquiries</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payroll.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="payroll.php"><i class="fa fa-money"></i><span class="nav-label">Payroll</span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payrolllist.php'){echo 'active'; }else { echo ''; } ?>"><a href="payrolllist.php">Employee List</a></li>
						</ul>
					</li>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payroll.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="payroll.php"><i class="fa fa-gears"></i><span class="nav-label">Payroll Setting</span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payrollfactor.php'){echo 'active'; }else { echo ''; } ?>"><a href="payrollfactor.php">Payroll Factor Settings</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == ''){echo 'active'; }else { echo ''; } ?>"><a href="">Cut Off Settings</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == ''){echo 'active'; }else { echo ''; } ?>"><a href="">Benefits Settings</a></li>
								<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == ''){echo 'active'; }else { echo ''; } ?>"><a href="">Earnings Settings</a></li>
										<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == ''){echo 'active'; }else { echo ''; } ?>"><a href="">Deductions Settings</a></li>
						</ul>
					</li>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coaching.php' OR basename($_SERVER['SCRIPT_NAME']) == 'coachingresult.php' OR basename($_SERVER['SCRIPT_NAME']) == 'coachingupdated.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-smile-o"></i><span class="nav-label">Coaching</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coaching.php'){echo 'active'; }else { echo ''; } ?>"><a href="coaching.php">Coaching</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coachingresult.php'){echo 'active'; }else { echo ''; } ?>"><a href="coachingresult.php">Update result</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coachingupdated.php'){echo 'active'; }else { echo ''; } ?>"><a href="coachingupdated.php">Coaching result</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'attendance.php' OR basename($_SERVER['SCRIPT_NAME']) == 'logedit.php' OR basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-clock-o"></i><span class="nav-label">Attendance</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'attendance.php'){echo 'active'; }else { echo ''; } ?>"><a href="attendance.php">Attendance</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'logedit.php'){echo 'active'; }else { echo ''; } ?>"><a href="logedit.php">Log edit requests</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php'){echo 'active'; }else { echo ''; } ?>"><a href="logedittracker.php">Log edit tracker</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcement.php' OR basename($_SERVER['SCRIPT_NAME']) == 'announcementlist.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-exclamation"></i><span class="nav-label">Announcements</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcement.php'){echo 'active'; }else { echo ''; } ?>"><a href="announcement.php">Post announcement</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcementlist.php'){echo 'active'; }else { echo ''; } ?>"><a href="announcementlist.php">Announcement list</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'ssstable.php' OR basename($_SERVER['SCRIPT_NAME']) == 'birtable.php' OR basename($_SERVER['SCRIPT_NAME']) == 'philhealthtable.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-table"></i><span class="nav-label">Government Tables</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'ssstable.php'){echo 'active'; }else { echo ''; } ?>"><a href="ssstable.php">SSS</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'birtable.php'){echo 'active'; }else { echo ''; } ?>"><a href="birtable.php">BIR</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'philhealthtable.php'){echo 'active'; }else { echo ''; } ?>"><a href="philhealthtable.php">Philhealth</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'pagibig.php'){echo 'active'; }else { echo ''; } ?>"><a href="pagibig.php">Pagibig</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'applicants.php' OR basename($_SERVER['SCRIPT_NAME']) == 'test1.php' OR basename($_SERVER['SCRIPT_NAME']) == 'philhealthtable.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-folder-o"></i><span class="nav-label">Application</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'applicants.php'){echo 'active'; }else { echo ''; } ?>"><a href="applicants.php">Applicants</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'test1.php'){echo 'active'; }else { echo ''; } ?>"><a href="test1.php">Form</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'examination.php'){echo 'active'; }else { echo ''; } ?>"><a href="examination.php">Examination</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'pagibig.php'){echo 'active'; }else { echo ''; } ?>"><a href="pagibig.php">//</a></li>
						</ul>
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