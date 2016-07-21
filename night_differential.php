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
<?php
include('dbconfig.php');

if($attendanceAll = $mysqli->query("SELECT * FROM attendance INNER JOIN employee ON attendance.employee_id = employee.employee_id ORDER BY attendance_date")){
	if ($attendanceAll->num_rows > 0){
		echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
		echo "<thead>";
		echo "<tr>";
		echo "<th>Name</th>";
		echo "<th>Shift</th>";
		echo "<th>Date</th>";
		echo "<th>Time in</th>";
		echo "<th>Out from break</th>";
		echo "<th>In from break</th>";
		echo "<th>Time out</th>";
		echo "<th>Night Differential</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tfoot>";                    
		echo "<tr>";
		echo "<td colspan='78'>";
		echo "<ul class='pagination pull-right'></ul>";
		echo "</td>";
		echo "</tr>";
		echo "</tfoot>";

		while($fetchAll = $attendanceAll->fetch_object()){
			$timein = $fetchAll->attendance_timein;
			$breakout = $fetchAll->attendance_breakout;
			$breakin = $fetchAll->attendance_breakin;
			$timeout = $fetchAll->attendance_timeout;
			$date = $fetchAll->attendance_date;
			$ndStart = "22:00";
			$ndEnd = "06:00";

			echo '<td>'.$fetchAll->employee_firstname.' '.$fetchAll->employee_middlename.' '.$fetchAll->employee_lastname.'</td>';
			echo '<td>'.$fetchAll->employee_type.'</td>';
			echo '<td>'.$fetchAll->attendance_date.'</td>';
			echo '<td>'.date('g:i A', strtotime($timein)).'</td>';
			echo '<td>'.date('g:i A', strtotime($breakout)).'</td>';
			echo '<td>'.date('g:i A', strtotime($breakin)).'</td>';
			echo '<td>'.date('g:i A', strtotime($timeout)).'</td>';

			if($breakout > $ndStart || $breakout <= $ndEnd){
				if($timein > $ndStart){
					$ndStart = $timein;
				}else{
					if($timein < $ndStart){
						$ndStart = "22:00";
					}else{
						$ndStart = "22:00";
					}					
				}
				$nd1 = date('H:i', strtotime($breakout) - strtotime($ndStart) - strtotime("02:00"));
				echo '<td>'.$nd1.'</td>';
			}else{
				if($timein < $ndEnd || $timein >= $ndStart){
					if($breakout > $ndEnd){
						$breakout = "06:00";
						$ndEnd = $timein;
					}
					$nd1 = date('H:i', strtotime($breakout) - strtotime($ndEnd) - strtotime("02:00"));
					echo '<td>'.$nd1.'</td>';
				}else{
					if($timein < $ndStart && $breakout > $ndEnd){
						$timein = $ndStart;
						$breakout = $ndEnd;

						$nd1 = date('H:i', strtotime($breakout) - strtotime($timein) - strtotime("02:00"));
						echo '<td>'.$nd1.'</td>';
					}else{
						$nd1 = "00:00";
					echo '<td>'.$nd1.'</td>';
					}
				}
			}
			
			echo "</tr>";
		}
		echo "</table>";
	}
}

?>
</body>
</html>