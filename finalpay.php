<!DOCTYPE html>
<html>
	<head>
		<?php
				session_start();
		$empLevel = $_SESSION['employee_level'];
		if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');

		}else if(isset($_SESSION['logsession']) && $empLevel == '4') {
			include('levelexe.php');
		}
		?>
		<title>Final pay employee list</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">						
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<script src="js/keypress.js"></script>
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Final Pay</h5>
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
					</div>
					<div class="ibox-content" id = "tableHolderz">
						<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT total_comp_salary.id, total_comp_salary.comp_id, total_comp_salary.cutoff, employee.employee_id, employee.employee_firstname, employee.employee_middlename, employee.employee_lastname, employee.employee_department FROM total_comp_salary INNER JOIN employee ON employee.employee_id = total_comp_salary.employee_id WHERE total_comp_salary.process_status = 'Final' AND employee.employee_status!='active'")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>ID</th>";
										echo "<th>Employee Name</th>";
										echo "<th>Department</th>";
										echo "<th>Cutoff Date Range</th>";
										echo "<th>Action</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tfoot>";                    
										echo "<tr>";
										echo "<td colspan='7'>";
										echo "<ul class='pagination pull-right'></ul>";
										echo "</td>";
										echo "</tr>";
										echo "</tfoot>";
										while ($row1 = mysqli_fetch_object($result1))
										{
											$cutarray = split(" - ", $row1->cutoff);
											$initialcut = date("F d, Y",strtotime($cutarray[0]));
											$endcut = date("F d, Y",strtotime($cutarray[1]));
											//$submitdate = date("F d, Y",strtotime($row1->cutoff_submitdate));
											echo "<tr class = 'josh'>";
											echo "<td>" . $row1->employee_id . "</td>";
											echo "<td>" . $row1->employee_firstname . " " . $row1->employee_middlename. " " . $row1->employee_lastname . "</td>";
											echo "<td>" . $row1->employee_department . "</td>";
											echo "<td>" . $initialcut . " - " . $endcut . "</td>";
											//echo "<td>" . $submitdate . "</td>";
											//echo "<td><a href='#' data-toggle='modal' 
											//		data-employee-id='$empid' 												
											//		data-cutoffd='".$initialcut." - ".$endcut."'
											//		data-submitdate='".$cutoffsubmitdate."'
											//		data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
											//echo "<a href='#' id='$empid' cutoff='".$initialcut." - ".$endcut."' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Deactivate</button></button></a>";
												echo "<td><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-file'></i>&nbsp;&nbsp;Export</button></td>";
											
											echo "</tr>";
										}									
										echo "</table>";
									}
								}			
						?><br><br>
					</div>
				</div>
			</div>
        </div>
	<div id="displaysomething"></div>
		<?php
			include('menufooter.php');
		?>
	</body>

</html>