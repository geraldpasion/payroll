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
		<title>Registration employee list</title>
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
						<h5>Registration</h5>
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
						<!--div class="form-group">
							<div class="col-md-3"></div>
							<form method="POST" action="registration.php">
								<label class="col-sm-1 control-label">Cutoff List</label>
								<div class="col-md-4">
									<select id = "leavetype" class="form-control"  data-default-value="z" name="sched" required="">
									<?php 
									// include('dbconfig.php');

									// if ($result1 = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_submission = 'Submitted' AND process_submission = 'Submitted'")) //get records from db
									// 	{
									// 		if ($result1->num_rows > 0) //display records if any
									// 		{
									// 			if(isset($_POST['test1'])){
									// 				$selection = $_POST['sched']; 
									// 				$cutarray = array();
									// 				$cutarray = split(" - ", $selection);
									// 				$initialcut = $cutarray[0];
									// 				$endcut = $cutarray[1];
									// 				echo '<option value="'.$initialcut." - ".$endcut."\">".date("F d, Y",strtotime($initialcut)).' - ';
									// 				echo date("F d, Y",strtotime($endcut)).'</option>';
									// 			}else{
									// 				//$newDateFilter = ''; 
									// 				echo '<option value=""> Select Cutoff &nbsp;&nbsp;(Month-Day-Year) </option>';
									// 			}
									// 			while ($row1 = mysqli_fetch_object($result1)){
									// 				$initial = $row1->cutoff_initial;
									// 				$end = $row1->cutoff_end;
									// 				$cutoffsubmitdate = $row1->cutoff_submitdate;

									// 				echo '<option value="'.$initial." - ".$end."\">".date("F d, Y",strtotime($initial)).' - ';
									// 				echo date("F d, Y",strtotime($end)).'</option>';
									// 			}
									// 		}
									// 	}
									?>
									</select>
								</div>
								<button type="submit" name="test1" class="btn btn-w-m btn-primary">Validate</button>
							</form>
						</div>
						<br><br><br><br-->
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
					</div>
					<div class="ibox-content" id = "tableHolderz">
						<?php
							include('dbconfig.php');
							//if(isset($_POST['test1'])){
									
								if ($result1 = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_submission = 'Submitted' AND process_submission = 'Submitted'")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>Cutoff Date Range</th>";
										echo "<th>Cutoff Submit Date</th>";
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
											$initialcut = date("F d, Y",strtotime($row1->cutoff_initial));
											$endcut = date("F d, Y",strtotime($row1->cutoff_end));
											$submitdate = date("F d, Y",strtotime($row1->cutoff_submitdate));
											echo "<tr class = 'josh'>";
											echo "<td>" . $initialcut . " - " . $endcut . "</td>";
											echo "<td>" . $submitdate . "</td>";
											//echo "<td><a href='#' data-toggle='modal' 
											//		data-employee-id='$empid' 												
											//		data-cutoffd='".$initialcut." - ".$endcut."'
											//		data-submitdate='".$cutoffsubmitdate."'
											//		data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
											//echo "<a href='#' id='$empid' cutoff='".$initialcut." - ".$endcut."' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Deactivate</button></button></a>";
											echo "<td><a href='downloadexcelfile.php?start=".$row1->cutoff_initial."&end=".$row1->cutoff_end." '><i class='fa fa-file'></i>&nbsp;&nbsp;Export .xls</a></td>";	
											//echo "<td><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-file'></i>&nbsp;&nbsp;Export .xls</button></td>";
											echo "</tr>";
										}									
										echo "</table>";
									}
								}	
								//}				
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