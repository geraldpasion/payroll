 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('supervisormenuheader.php');
			$empid = $_SESSION['logsession'];
		?>
		<title>Loan Status</title>
	</head>

	<body>
		    <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Loan Status</h5>
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
					if ($result = $mysqli->query("SELECT * FROM loan WHERE employee_id = $empid")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Date</th>";
							echo "<th>Status</th>";
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
								echo "<td>" . date("Y-m-d",strtotime($row->loanDate)) . "</td>";
								echo "<td>" . $row->loanstatus . "</td>";
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