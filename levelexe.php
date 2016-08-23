<?php 
include('dbconfig.php');
if(!isset($_SESSION)) session_start();
if (!isset($_SESSION['logsession']) || $_SESSION['employee_level'] !== "4") {
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
							HRIS
						</div>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeehome.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="employeehome3.php"><i class="fa fa-home"></i><span class="nav-label">Home</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnew.php' OR basename($_SERVER['SCRIPT_NAME']) == 'employeelist.php' OR basename($_SERVER['SCRIPT_NAME']) == 'teammanagement.php' OR basename($_SERVER['SCRIPT_NAME']) == 'inactiveemployeelist.php' OR basename($_SERVER['SCRIPT_NAME']) == 'schedtest.php' OR basename($_SERVER['SCRIPT_NAME']) == 'editrestday.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#" ><i class="fa fa-group"></i><span class="nav-label ">Employee Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnew.php'){echo 'active'; }else { echo ''; } ?>"><a href="addnew.php">New</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'employeelist.php'){echo 'active'; }else { echo ''; } ?>"><a href="employeelist.php">Active Employee</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inactiveemployeelist.php'){echo 'active'; }else { echo ''; } ?>"><a href="inactiveemployeelist.php">Inactive Employee</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'teammanagement.php'){echo 'active'; }else { echo ''; } ?>"><a href="teammanagement.php">Team Management</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'schedtest.php'){echo 'active'; }else { echo ''; } ?>"><a href="schedtest.php">Shift Management</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'editrestday.php'){echo 'active'; }else { echo ''; } ?>"><a href="editrestday.php">Rest Day Settings</a></li>
						</ul>
					</li>
					<!-- <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnewholiday.php' OR basename($_SERVER['SCRIPT_NAME']) == 'legalholiday.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="legalholiday.php"><i class="fa fa-gift"></i><span class="nav-label">Holiday Management</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnewholiday.php'){echo 'active'; }else { echo ''; } ?>"><a href="addnewholiday.php">Add holiday</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'legalholiday.php'){echo 'active'; }else { echo ''; } ?>"><a href="legalholiday.php">Holiday list</a></li>
						</ul>
					</li> -->
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'attendance.php' OR basename($_SERVER['SCRIPT_NAME']) == 'logedit.php' OR basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php' OR basename($_SERVER['SCRIPT_NAME']) == 'additionalpayable.php' OR basename($_SERVER['SCRIPT_NAME']) == 'additionalpayablerequests.php' OR basename($_SERVER['SCRIPT_NAME']) == 'additionalpayablestatus.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-clock-o"></i><span class="nav-label">Time Keeping</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'attendance.php'){echo 'active'; }else { echo ''; } ?>"><a href="attendance.php">Attendance</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'logedit.php'){echo 'active'; }else { echo ''; } ?>"><a href="logedit.php">Log edit requests</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'logedittracker.php'){echo 'active'; }else { echo ''; } ?>"><a href="logedittracker.php">Log edit status</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'additionalpayable.php'){echo 'active'; }else { echo ''; } ?>"><a href="additionalpayable.php">Others application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'additionalpayablerequests.php'){echo 'active'; }else { echo ''; } ?>"><a href="additionalpayablerequests.php">Others pending</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'additionalpayablestatus.php'){echo 'active'; }else { echo ''; } ?>"><a href="additionalpayablestatus.php">Others status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminovertimeapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'overtimeapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'overtimetracer.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-clock-o"></i><span class="nav-label">Overtime Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminovertimeapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminovertimeapplication.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimeapproval.php'){echo 'active'; }else { echo ''; } ?>"><a href="overtimeapproval.php">Pending</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'overtimetracer.php'){echo 'active'; }else { echo ''; } ?>"><a href="overtimetracer.php">Status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminleaveapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'leaveapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'leavecreditsmanagement.php' OR basename($_SERVER['SCRIPT_NAME']) == 'leavetracer.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-briefcase"></i><span class="nav-label">Leave Management</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminleaveapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminleaveapplication.php">Application</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leavecreditsmanagement.php'){echo 'active'; }else { echo ''; } ?>"><a href="leavecreditsmanagement.php">Credits</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leaveapproval.php'){echo 'active'; }else { echo ''; } ?>"><a href="leaveapproval.php">Approval</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'leavetracer.php'){echo 'active'; }else { echo ''; } ?>"><a href="leavetracer.php">Status</a></li>
						</ul>
					</li>
					
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminloanapplication.php' OR basename($_SERVER['SCRIPT_NAME']) == 'loanapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'loantracer.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="legalholiday.php"><i class="fa fa-money"></i><span class="nav-label">Loan Management</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'adminloanapplication.php'){echo 'active'; }else { echo ''; } ?>"><a href="adminloanapplication.php">Application</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanapproval.php'){echo 'active'; }else { echo ''; } ?>"><a href="loanapproval.php">Approval</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'loantracer.php'){echo 'active'; }else { echo ''; } ?>"><a href="loantracer.php">Status</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coaching.php' OR basename($_SERVER['SCRIPT_NAME']) == 'coachingresult.php' OR basename($_SERVER['SCRIPT_NAME']) == 'coachingupdated.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-smile-o"></i><span class="nav-label">Coaching</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coaching.php'){echo 'active'; }else { echo ''; } ?>"><a href="coaching.php">New</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coachingresult.php'){echo 'active'; }else { echo ''; } ?>"><a href="coachingresult.php">Update</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'coachingupdated.php'){echo 'active'; }else { echo ''; } ?>"><a href="coachingupdated.php">Result</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inquiry.php' OR basename($_SERVER['SCRIPT_NAME']) == 'answeredinquiry.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="index-2.html"><i class="fa fa-question"></i><span class="nav-label">Inquiries</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'inquiry.php'){echo 'active'; }else { echo ''; } ?>"><a href="inquiry.php">Pending</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'answeredinquiry.php'){echo 'active'; }else { echo ''; } ?>"><a href="answeredinquiry.php">Answered</a></li>
						</ul>
					</li>
					
					

					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcement.php' OR basename($_SERVER['SCRIPT_NAME']) == 'announcementlist.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="#"><i class="fa fa-exclamation"></i><span class="nav-label">Announcements</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcement.php'){echo 'active'; }else { echo ''; } ?>"><a href="announcement.php">Post announcement</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'announcementlist.php'){echo 'active'; }else { echo ''; } ?>"><a href="announcementlist.php">Announcement list</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'applicants.php' OR basename($_SERVER['SCRIPT_NAME']) == 'test1.php' OR basename($_SERVER['SCRIPT_NAME']) == 'addedittest.php' OR basename($_SERVER['SCRIPT_NAME']) == 'interview.php') {echo 'active'; } else { echo ''; } ?>">
						<a href="#"><i class="fa fa-folder-o"></i><span class="nav-label">Recruitment</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'applicants.php'){echo 'active'; }else { echo ''; } ?>"><a href="applicants.php">Applicants</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'test1.php'){echo 'active'; }else { echo ''; } ?>"><a href="test1.php">Form</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addedittest.php'){echo 'active'; }else { echo ''; } ?>"><a href="addedittest.php">Add/Edit Test</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'interview.php'){echo 'active'; }else { echo ''; } ?>"><a href="interview.php">Interview </a></li>
						</ul>
					</li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'images.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="images.php"><i class="fa fa-image"></i><span class="nav-label">Gallery</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payrolllist.php' OR basename($_SERVER['SCRIPT_NAME']) == 'attendanceapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'payrollapproval.php' OR basename($_SERVER['SCRIPT_NAME']) == 'cutoff.php' OR basename($_SERVER['SCRIPT_NAME']) == 'processing2.php'  OR basename($_SERVER['SCRIPT_NAME']) == 'registration.php' OR basename($_SERVER['SCRIPT_NAME']) == 'payslip.php' OR basename($_SERVER['SCRIPT_NAME']) == 'finalpay.php')  {echo 'active'; }else { echo ''; } ?>">

						<a href="#"><i class="fa fa-money"></i><span class="nav-label">Payroll</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
<!-- 							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'processing.php'){echo 'active'; }else { echo ''; } ?>"><a href="processing.php">Basic Pay</a></li> -->
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'cutoff.php'){echo 'active'; }else { echo ''; } ?>"><a href="cutoff.php">Cut Off Settings</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'attendanceapproval.php'){echo 'active'; }else { echo ''; } ?>"><a href="attendanceapproval.php">Attendance Approval</a></li>
							<!-- <li class="<?php //if(basename($_SERVER['SCRIPT_NAME']) == 'payrolllist.php'){echo 'active'; }else { echo ''; } ?>"><a href="payrolllist.php">Processing2</a></li> -->
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'processing2.php'){echo 'active'; }else { echo ''; } ?>"><a href="processing2.php">Processing</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'registration.php'){echo 'active'; }else { echo ''; } ?>"><a href="registration.php">Registration</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payslip.php'){echo 'active'; }else { echo ''; } ?>"><a href="payslip.php">Payslip</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'finalpay.php'){echo 'active'; }else { echo ''; } ?>"><a href="finalpay.php">Final Pay</a></li>
						</ul>
					</li>
										<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payrollfactor.php' OR basename($_SERVER['SCRIPT_NAME']) == 'governmenttables.php' OR basename($_SERVER['SCRIPT_NAME']) == 'earnings.php' OR basename($_SERVER['SCRIPT_NAME']) == 'deductions.php' OR basename($_SERVER['SCRIPT_NAME']) == 'processing.php' OR basename($_SERVER['SCRIPT_NAME']) == 'autoupdate.php') {echo 'active'; }else { echo ''; } ?>">
						<a href="payroll.php"><i class="fa fa-gears"></i><span class="nav-label">Payroll Setting</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'payrollfactor.php'){echo 'active'; }else { echo ''; } ?>"><a href="payrollfactor.php">Payroll Factor Settings</a></li>
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'processing.php'){echo 'active'; }else { echo ''; } ?>"><a href="processing.php">Basic Pay</a></li>
<!-- 							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'cutoff.php'){echo 'active'; }else { echo ''; } ?>"><a href="cutoff.php">Cut Off Settings</a></li> -->
							<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'governmenttables.php'){echo 'active'; }else { echo ''; } ?>"><a href="governmenttables.php">Benefits Settings</a></li>
								<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'earnings.php'){echo 'active'; }else { echo ''; } ?>"><a href="earnings.php">Earnings Settings</a></li>
										<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'deductions.php'){echo 'active'; }else { echo ''; } ?>"><a href="deductions.php">Deductions Settings</a></li>
										<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'autoupdate.php'){echo 'active'; }else { echo ''; } ?>"><a href="autoupdate.php">System Calendar Update</a></li>
						</ul>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'archive.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="archive.php"><i class="fa fa-image"></i><span class="nav-label">Archive</span></a>
					</li>
					<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnewholiday.php' OR basename($_SERVER['SCRIPT_NAME']) == 'legalholiday.php'){echo 'active'; }else { echo ''; } ?>">
						<a href="legalholiday.php"><i class="fa fa-gift"></i><span class="nav-label">Holiday Management</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'addnewholiday.php'){echo 'active'; }else { echo ''; } ?>"><a href="addnewholiday.php">Add holiday</a></li>
						<li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'legalholiday.php'){echo 'active'; }else { echo ''; } ?>"><a href="legalholiday.php">Holiday list</a></li>
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
						<li>
							<a href="logout.php">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
					</ul>
				</nav>
			</div>