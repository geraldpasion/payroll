<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<script src="sweetalert2-master/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert2.css">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	<style>
		body{
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
		.w {
			
		}
	
	</style>
	<script type="text/javascript">
			function alertFunction2()
		{
			swal({  title: "Wrong username or password!",   text: "",   timer: 2000, type: "error",   showConfirmButton: false}, 
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
	?>
	
	<script type="text/javascript">
			function alertFunction3()
		{
			swal({  title: "Login first!",   text: "",   timer: 2000, type: "error",   showConfirmButton: false}, 
			function(zz){  
			history.replaceState({}, "Title", "login.php");
		});  
		}
	</script>
	
	<?php
		if(isset($_GET['loginla']))
		{
			echo '<script type="text/javascript">'
			   , 'alertFunction3();'
			   , '</script>'
			;	
		}
	?>
<script src="js/keypress.js"></script>
</head>

<body class="gray-bg">
<?php
if (session_status() == PHP_SESSION_NONE) {
   			 session_start();
		}
if(!empty($_SESSION['logsession']))
{
	//echo "<script>alert('session yes!');</script>";
	//header("location: loginexe.php");
	$employee_id= isset($_SESSION['logsession']) ? $_SESSION['logsession'] : '';
	include 'dbconfig.php';
	$result = $mysqli->query("SELECT employee_level FROM employee WHERE employee_id = '$employee_id'")->fetch_array();
	
	if($result['employee_level'] == '1'){
		$_SESSION['login'] = TRUE;
		header("location: employeehome.php");
		exit;
	}
	else if($result['employee_level'] == '2'){
		$_SESSION['login'] = TRUE;
		header("location: employeehome2.php");
		exit;
	}
	else if($result['employee_level'] == '3'){
		$_SESSION['login'] = TRUE;
		header("location: employeehome3.php");
		exit;
	}
	else if($result['employee_level'] == '4'){
		$_SESSION['login'] = TRUE;
		header("location: employeehome4.php");
		exit;
	}
}
else{
	//echo "<script>alert('session not!');</script>";
	
	//echo "<div>hello".$_SESSION['logsession']."</div>";

}
?>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
			<h2>iConnect</h2>
            <h3>Welcome to iConnect</h3>
            <p>Please login.
            </p>
            <form class="m-t" role="form" action="loginexe.php" method = "POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name = "username" required="" onKeyPress="return numbersonly(this, event)">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name = "password" required="">
                </div>
                <button type="submit" name = "login" class="btn btn-primary block full-width m-b">Login</button>
				
                <a href="forgotpasswordlogin.php" data-toggle="modal" data-target="#myModal4"><small>Forgot password?</small></a><br><br>
				<a href="test1.php"><big>Applicant? Sign up here.</big></a><br><br>
				<a href="index.php"><big>Employee? Time in here.</big></a>
            </form>
            <div class="modal fade" id="myModal4" role="dialog">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
					</div>
				</div>
			</div>
            <p class="m-t"> <small>iConnect</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
