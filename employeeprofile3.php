<!DOCTYPE html>
<html>
	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Profile</title>
			<style>
				.profilepic{
					height:120px;
					width:12%;
					margin-left:140px;
					postion:absolute;
					border-color:black;
				}
			</style>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Profile</h5>
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
						<?php
							include('dbconfig.php');
							$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employee_id'")->fetch_array();
							$birthday = date("F d,Y",strtotime($result['employee_birthday'])); 
						?>
						<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">Personal information</a></li>
							<li class=""><a data-toggle="tab" href="#tab-3">Employee Information</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
								<div class="col-md-3"></div>
								<?php if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employee_id'")){
										while ($row22 = mysqli_fetch_object($result1))
										{echo "<img class='profilepic' src='images/".$row22->image."'/>";}
									}
								?>
									
								<br><br>
                                    <div class="col-md-3"></div>
									<div class="col-md-3"><b>ID</b></div>
									<div class="col-md-4"><?php echo $result['employee_id']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Name</b></div>
									<div class="col-md-4"><?php echo $result['employee_firstname']. " " .$result['employee_lastname'] ; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Gender</b></div>
									<div class="col-md-4"><?php echo $result['employee_gender']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Birthday</b></div>
									<div class="col-md-4"><?php echo $birthday?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Marital Status</b></div>
									<div class="col-md-4"><?php echo $result['employee_marital']; ?></div>  
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Address</b></div>
									<div class="col-md-4"><?php echo $result['employee_address']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>City</b></div>
									<div class="col-md-4"><?php echo $result['employee_city']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>ZIP</b></div>
									<div class="col-md-4"><?php echo $result['employee_zip']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Email</b></div>
									<div class="col-md-4"><?php echo $result['employee_email']; ?></div>
									<br><br>
									<div class="col-md-3"></div>
									<div class="col-md-3"><b>Cellphone number</b></div>
									<div class="col-md-4"><?php echo $result['employee_cellnum']; ?></div>
								</div> 
                            </div>
							<div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                <div class="col-md-3"></div>
								<div class="col-md-3"><b>Employee type</b></div>
								<div class="col-md-4"><?php echo $result['employee_type']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Department</b></div>
								<div class="col-md-4"><?php echo $result['employee_department']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Rate</b></div>
								<div class="col-md-4"><?php echo $result['employee_rate']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Taxcode</b></div>
								<div class="col-md-4"><?php echo $result['employee_taxcode']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Dependencies</b></div>
								<div class="col-md-4"><?php echo $result['employee_dependency']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>SSS</b></div>
								<div class="col-md-4"><?php echo $result['employee_sss']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Philhealth</b></div>
								<div class="col-md-4"><?php echo $result['employee_philhealth']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Pagibig</b></div>
								<div class="col-md-4"><?php echo $result['employee_pagibig']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>TIN</b></div>
								<div class="col-md-4"><?php echo $result['employee_tin']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Shift</b></div>
								<div class="col-md-4"><?php echo $result['employee_shift']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Rest days</b></div>
								<div class="col-md-4"><?php echo $result['employee_restday']; ?></div>
								<br><br>
								<div class="col-md-3"></div>
								<div class="col-md-3"><b>Date hired</b></div>
								<div class="col-md-4"><?php echo $result['employee_datehired']; ?></div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
        </div>
		<?php
			include('employeemenufooter.php');
		?>
	</body>
</html>