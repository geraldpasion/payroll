<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		
		<title>New Applicant</title>

	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Employee list</h5>
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
					
						</div>
							</div>
						</div>
					<div class="ibox-content">
						<?php
					include('dbconfig.php');
					if ($result = $mysqli->query("SELECT * FROM emp_data WHERE info_post = 'Graduate' OR info_post = 'UnderGraduate' ORDER BY id")) //get records from db
						{
							if ($result->num_rows > 0) //display records if any
							{
								echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
								echo "<thead>";
								echo "<tr>";
								echo "<th>Name</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tfoot>";                    
								echo "<tr>";
								echo "<td colspan='7'>";
								echo "<ul class='pagination pull-right'></ul>";
								echo "</td>";
								echo "</tr>";
								echo "</tfoot>";
								while ($row = mysqli_fetch_object($result))
								{
									$appid =$row->id;
									echo "<tr>";
									echo "<td>"   . $row->info_f_name ." ".$row->info_m_name ." " . $row->info_l_name . "</td>";
									echo "<td> <a href = 'personalinfo.php?id=$appid'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a></td>";
								echo "</tr>";

								}
								echo "</table>";
							}
						}
					
						
				?>
				
			</div>
	
        </div>
        </div>
        </div>

    
		
		<?php
			include('menufooter.php');
		?>
	</body>
</html>