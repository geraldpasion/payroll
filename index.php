<!DOCTYPE html>
<html>

<head>

    <!--main headers-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Attendance</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	<script src="sweetalert2-master/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert2.css">

	<script type="text/javascript">
		tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
		tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

		function GetClock(){
		var d=new Date();
		var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
		if(nyear<1000) nyear+=1900;
		var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

		if(nhour==0){ap=" AM";nhour=12;}
		else if(nhour<12){ap=" AM";}
		else if(nhour==12){ap=" PM";}
		else if(nhour>12){ap=" PM";nhour-=12;}

		if(nmin<=9) nmin="0"+nmin;
		if(nsec<=9) nsec="0"+nsec;

		document.getElementById('clockbox').innerHTML=""+tday[nday]+"<br>"+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"<br><a href='login.php'><small><u>Sign in here.</u><small></a>";
		}

		window.onload=function(){
		GetClock();
		setInterval(GetClock,1000);
		}
		function alertFunction2()
		{
			swal({  title: "Successfully timed in!",   text: "",   timer: 3000, type: "success",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction3()
		{
			swal({  title: "Please check your status!",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction4()
		{
			swal({  title: "You are successfully Out for Lunch/Break",   text: "",   timer: 3000, type: "success",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction5()
		{
			swal({  title: "Please login first!",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction6()
		{
			swal({  title: "You are successfully In from Lunch/Break",   text: "",   timer: 3000, type: "success",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction7()
		{
			swal({  title: "You are already Timed In from Lunch/Break, You need to Time Out",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction8()
		{
			swal({  title: "You are successfully Timed Out",   text: "",   timer: 3000, type: "success",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction9()
		{
			swal({  title: "You are already Timed Out, You need to Time In",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction10()
		{
			swal({  title: "Break in or login first!",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction11()
		{
			swal({  title: "Please check your status!",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction12()
		{
			swal({  title: "You need to time out for break!",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction13()
		{
			swal({  title: "You are already Timed Out for Lunch/Break",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction14()
		{
			swal({  title: "You already timed in, you need to time out!",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			 window.location.href='index.php';
		});  
		}
		function alertFunction15()
		{
			swal({	title: "Click time out to end your shift!",	text: "",	timer: 3000, type:"error", showConfirmButton: false},
			function(zz){
			 window.location.href='index.php';
		});
		}

		function checkStatus1()
		{
			swal({	title: "Your current status is : Timed In",	text: "",	timer: 5000, type:"success", showConfirmButton: false},
			function(zz){
			 window.location.href='index.php';
		});
		}
		function checkStatus2()
		{
			swal({	title: "Your current status is: Out for Lunch",	text: "",	timer: 5000, type:"success", showConfirmButton: false},
			function(zz){
			 window.location.href='index.php';
		});
		}
		function checkStatus3()
		{
			swal({	title: "Your current status is: In from Lunch",	text: "",	timer: 5000, type:"success", showConfirmButton: false},
			function(zz){
			 window.location.href='index.php';
		});
		}
		function checkStatus4()
		{
			swal({	title: "Your current status is: Timed Out",	text: "",	timer: 5000, type:"success", showConfirmButton: false},
			function(zz){
			 window.location.href='index.php';
		});
		}
		function restrict()
		{
			swal({	title: "Please try to login again in a few hours",	text: "",	timer: 5000, type:"error", showConfirmButton: false},
			function(zz){
			 window.location.href='index.php';
		});
		}

	</script>


	<style>
		#clockbox{
			font-size:3.2em;
			color:white;
		}body{
			background-image:url("img/orange.jpg");	
		}
		.btn{
			background-color:#FF6633;
			border-color:white;
		}
		.btn:hover{
			background-color:#FF9933;
			border-color:white;
		}
		.wide{
			margin:0px 20px 0px 20px;
		}
		
	</style>
	<?php
		if(isset($_GET['restrict']))
		{
			echo '<script type="text/javascript">'
			   , 'restrict();'
			   , '</script>'
			;	
		}
		if(isset($_GET['timedin']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction2();'
			   , '</script>'
			;	
		}
		if(isset($_GET['alreadyactive']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction3();'
			   , '</script>'
			;	
		}
		if(isset($_GET['breaksuccess']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction4();'
			   , '</script>'
			;	
		}
		if(isset($_GET['loginfirst']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction5();'
			   , '</script>'
			;	
		}
		if(isset($_GET['breakinsuccess']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction6();'
			   , '</script>'
			;	
		}
		if(isset($_GET['alreadybreak']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction7();'
			   , '</script>'
			;	
		}
		if(isset($_GET['timedout']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction8();'
			   , '</script>'
			;	
		}
		if(isset($_GET['inactive']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction9();'
			   , '</script>'
			;	
		}
		if(isset($_GET['broke']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction10();'
			   , '</script>'
			;	
		}
		if(isset($_GET['doubletime']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction11();'
			   , '</script>'
			;	
		}
		if(isset($_GET['youneedtobreakout']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction12();'
			   , '</script>'
			;	
		}
		if(isset($_GET['timedoutforbreak']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction13();'
			   , '</script>'
			;	
		}
		if(isset($_GET['infrombreak']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction14();'
			   , '</script>'
			;	
		}
		if(isset($_GET['alreadyhadyourbreak']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction15();'
			   , '</script>'
			;
		}
	?>
		<script type="text/javascript">
			function alertFunction2()
		{
			swal({  title: "Please check your status!",   text: "",   timer: 3000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			history.replaceState({}, "Title", "login.php");
		});  
		}
	</script>
	
	<?php
		if(isset($_GET['denied']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction2();'
			   , '</script>'
			;	
		}

include("dbconfig.php");

if(isset($_POST['submit'])){
	$emp_id = $_POST['username'];
	$date= date("Y-m-d");
	$status = $mysqli->query("SELECT * FROM attendance WHERE employee_id='$emp_id' AND attendance_status != 'inactive' ORDER BY attendance_id DESC LIMIT 1")->fetch_object();
	$statusRes = $status->attendance_status;

	if($statusRes == "active"){
		echo '<script type="text/javascript">'
			   , 'checkStatus1();'
			   , '</script>'
			;	
	}else if ($statusRes == "outforbreak"){
		echo '<script type="text/javascript">'
			   , 'checkStatus2();'
			   , '</script>'
			;	
	}else if($statusRes == "infrombreak"){
		echo '<script type="text/javascript">'
			   , 'checkStatus3();'
			   , '</script>'
			;	
	}else if($statusRes == "timeout"){
		echo '<script type="text/javascript">'
			   , 'checkStatus4();'
			   , '</script>'
			;	
	}
}
	?>
<script src="js/keypress.js"></script>
</head>

<body background = "img/orange.jpeg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
				<h1 class="font-bold">iConnect</h1>
				<br><br>
				<div id="clockbox"></div>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                	<div class="row">
            <div class="col-md-9">
                Please login.
            </div>
            <a href = "#myModal" data-toggle="modal"><medium>Check Status</medium></a>
			<div class="modal fade" id="myModal" role="dialog">
    			<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
					<form action='index.php' method='post'>
					<table cellspacing='5' align='left'>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <center><h1 class="modal-title">Check Status</h1></center>
				      </div>
						<div class="modal-body">
							<h3 style="text-align:center">Enter your username:</h3><br>
							<input type = "text" class = "form-control" placeholder = "Username" name = "username" required = "" onKeyPress="return numbersonly(this, event)">
						</div>
							<div class="col-sm-2"></div>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="submit" name="submit" class="btn btn-primary">&nbsp;&nbsp;Ok&nbsp;&nbsp;</button>
							
							
					</table>
					</form>
						</div>
       				</div>
				</div>
			</div>
        			</div>	
                    <form class="m-t" role="form" method = "POST" action="indexexe.php">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name = "username" required="" onKeyPress="return numbersonly(this, event)">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name = "password" required="">
                        </div>
                        <button type="submit" name = "login" class="btn btn-block btn-primary"><span class = "wide">Time in</span></button>

                        <button type="submit" name = "breakout" class="btn btn-block btn-primary"><span class = "wide">Out for lunch</span></button>
						
						<button type="submit" name = "breakin" class="btn btn-block btn-primary"><span class = "wide">In from lunch</span></button>
						
						<button type="submit" name = "out" class="btn btn-block btn-primary"><span class = "wide">Time out</span></button>
						</form>
						<br>
						

			<a href="forgotpassword.php" data-toggle="modal" data-target="#myModal4" ><small>Forgot password?</small></a>
			<div class="modal fade" id="myModal4" role="dialog">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
					</div>
				</div>
			</div>
                    <p class="m-t">
                        <!--insert text here -->
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright iConnect
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
	
</body>

</html>
