 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('employeemenuheader.php');
			$empid = $_SESSION['logsession'];
		?>
		<title>Leave Status</title>
	</head>

	<body>
		    <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Leave Status</h5>
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
					if ($result = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id = $empid")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";
							echo "<th>Start</th>";
                            echo "<th>Reason</th>";
							echo "<th>Type</th>";
							echo "<th>Remarks</th>";
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
								$leaveid = $row->leave_id;
								echo "<tr>";
								echo "<td>" . date("Y-m-d",strtotime($row->leave_start)) . "</td>";
								echo "<td>" . $row->leave_reason . "</td>";
								echo "<td>" . $row->leave_type . "</td>";
								echo "<td>" . $row->leave_remarks . "</td>";
								echo "<td>" . $row->leave_status . "</td>";
								echo "<td>" . $row->leave_approvedby . "</td>";
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