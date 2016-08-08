<!DOCTYPE html>
<html>
	<head>
		<?php
			 include('menuheader.php');
		?>
		<title>Payslip list</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">						
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<script src="js/keypress.js"></script>
	</head>
	<script>		
		//ajax calling export_attendance.php
		function exportAll(datef, datet) {
			//alert(datef);
			var datef = new Date(datef);
			var datef = datef.getFullYear() + '/' + (datef.getMonth() + 1) + '/' + datef.getDate(); 
			
			var datet = new Date(datet);
			var datet = datet.getFullYear() + '/' + (datet.getMonth() + 1) + '/' + datet.getDate();
			document.location.href = 'export_payslip.php?datef='+datef+'&datet='+datet;
		}
	</script>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Payslip</h5>
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
					<div class="ibox-content"><br><br>
						<div class="form-group">
							<div style="margin-left:-125px" class="col-md-3"></div>
							<form method="POST" action="payslip.php">
								<label class="col-sm-1 control-label">Cutoff List</label>
								<div class="col-md-4" style="padding-bottom:10px;">
									<select id = "sched" class="form-control"  data-default-value="z" name="sched" required="">
									<?php 
									include('dbconfig.php');

									if ($result1 = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_submission = 'Submitted' AND process_submission = 'Submitted'")) //get records from db
										{
											if ($result1->num_rows > 0) //display records if any
											{
												if(isset($_POST['test1'])){
													$selection = $_POST['sched'];
													$cutarray = array();
													$cutarray = split(" - ", $selection);
													$initialcut = $cutarray[0];
													$endcut = $cutarray[1];
													echo '<option value="'.$initialcut.' - '.$endcut.'">'.date("F d, Y",strtotime($initialcut)).' - ';
													echo date("F d, Y",strtotime($endcut)).'</option>';
												}else{
													//$newDateFilter = ''; 
													echo '<option value=""> Select Cutoff &nbsp;&nbsp;(Month-Day-Year) </option>';
												}
												while ($row1 = mysqli_fetch_object($result1)){
													$initial = $row1->cutoff_initial;
													$end = $row1->cutoff_end;
													$cutoffsubmitdate = $row1->cutoff_submitdate;

													echo '<option value="'.$initial.' - '.$end.'">'.date("F d, Y",strtotime($initial)).' - ';
													echo date("F d, Y",strtotime($end)).'</option>';
												}
											}
										}
									?>
									</select>
								</div>
								<div class="col-md-5 col-sm-12">
								&nbsp;&nbsp;<button type="submit" name="test1" class="btn btn-w-m btn-primary">Validate</button>&nbsp;&nbsp;
								<?php 
								if(isset($_POST['test1'])){
									$initialcut2 = strtotime($initialcut)*1000;
									$endcut2 = strtotime($endcut)*1000;
									echo'<button type="button" onClick="exportAll('.$initialcut2.','.$endcut2.')" class="btn btn-w-m btn-primary"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;Export All</button>';
								} else {
									echo'<button type="button" class="btn btn-w-m btn-primary"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;Export All</button>';
								} ?>
								</div>
							</form>
						</div>
						<br><br><br><br>
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
					</div>
					<div class="ibox-content" id = "tableHolderz">
						<?php
							include('dbconfig.php');
								if(isset($_POST['test1'])){
								$cutoffrange = $initialcut . ' - ' .$endcut;
								if ($result1 = $mysqli->query("SELECT * FROM employee INNER JOIN total_comp_salary ON employee.employee_id = total_comp_salary.employee_id WHERE total_comp_salary.process_status='Submitted' AND total_comp_salary.cutoff='$cutoffrange'")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>ID</th>";
										echo "<th>Name</th>";
										echo "<th>Department</th>";
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
											$empid = $row1->employee_id;
											$compid = $row1->id;
											echo "<tr class = 'josh'>";
											echo "<td>" . $empid . "</td>";
											echo "<td>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</td>";
											echo "<td>" . $row1->employee_department . "</td>";
											//echo "<td><a href='#' data-toggle='modal' 
											//		data-employee-id='$empid' 												
											//		data-cutoffd='".$initialcut." - ".$endcut."'
											//		data-submitdate='".$cutoffsubmitdate."'
											//		data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
											//echo "<a href='#' id='$empid' cutoff='".$initialcut." - ".$endcut."' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Deactivate</button></button></a>";
												echo "<td><a href = 'print_payslip.php?initial=".$initialcut."&end=".$endcut."&id=".$empid."&compid=".$compid." target="_blank"'><button class='btn btn-info' name = 'export' type='button'><i class='fa fa-file'></i>&nbsp;&nbsp;View/Download</button></a></td>";
											
											echo "</tr>";
										}									
										echo "</table>";
									}
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