 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('employeemenuheader.php');
			$empid = $_SESSION['logsession'];
		?>
		<title>Overtime Status</title>
	</head>

	<body>
		    <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Overtime Status</h5>
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
					if ($result = $mysqli->query("SELECT * FROM overtime WHERE employee_id = $empid")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Date</th>";
                            echo "<th>Start</th>";
                            echo "<th>End</th>";
                            echo "<th>Duration</th>";
							echo "<th>Reason</th>";
							echo "<th>Status</th>";
							echo "<th>Managed by</th>";
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
								echo "<tr>";
								echo "<td>" . date("Y-m-d",strtotime($row->overtime_date)) . "</td>";
								echo "<td>" . date("g:i A",strtotime($row->overtime_start)) . "</td>";
								echo "<td>" . date("g:i A",strtotime($row->overtime_end)) . "</td>";
								$OTin = $row->overtime_start;
								$OTout = $row->overtime_end;											
								$OTCount = date('H:i', strtotime($OTout) - strtotime($OTin) - strtotime('03:00'));
								$arrayOTCount = array();
								$arrayOTCount = split(':', $OTCount);
								$OTCountMin = $arrayOTCount[1]/60;
								$OTCountDec = sprintf("%.2f", $arrayOTCount[0]+$OTCountMin);
								if($OTCountDec >= 5.00) {
									$OTCountDec = $OTCountDec - 1.00;
									$OTCountDec = sprintf("%.2f", $OTCountDec);
								}
								if ($stmt = $mysqli->prepare("update overtime set overtime_duration='".$OTCountDec."' where overtime_id = '".$row->overtime_id."'")){
								$stmt->execute();
								$stmt->close();
								}
								echo "<td>" . $OTCountDec . "</td>";
								echo "<td>" . $row->overtime_reason . "</td>";
								echo "<td>" . $row->overtime_status . "</td>";
								echo "<td>" . $row->overtime_approvedby . "</td>";
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
			include('employeemenufooter.php');
		?>
	</body>
</html>