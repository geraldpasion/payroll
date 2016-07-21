<!DOCTYPE html>
<html>

	<head>
		<?php
			include('employeemenuheader.php');
			
		?>
		<title>Coaching</title>
		<script type="text/javascript">
			$(document).on("click", ".editempdialog", function () {
			 var result = $(this).data('result');
			 
			  $(".modal-body #result").val( result );
			});
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Coaching</h5>
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
                        <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">
						<?php
							include('dbconfig.php');
							if ($result = $mysqli->query("SELECT * FROM coaching WHERE employee_id = '$employee_id ' ORDER BY coaching_id")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='1000' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th>Date</th>";
									echo "<th>Trainer</th>";
									echo "<th>Scenario</th>";
									echo "<th>Status</th>";
									echo "<th>Result</th>";
									echo "</tr>";
									echo "</thead>";
									
									while ($row = mysqli_fetch_object($result))
									{
										echo "<tr>";
										echo "<td>" . date("Y-m-d",strtotime($row->coaching_date)) . "</td>";
										echo "<td>" . $row->coaching_coachemployeeid . "</td>";
										echo "<td>" . $row->coaching_subject . "</td>";
										echo "<td>" . $row->coaching_status . "</td>";
										echo "<td><a href='#' data-toggle='modal' data-result='$row->coaching_result' data-target='#myModal4' class = 'editempdialog' ><button class='btn btn-info' name = 'edit' type='button'> View</button></a>&nbsp;&nbsp;";
										echo "</td>";
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
		<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-small">
			<div class="modal-content">
				<div class="modal-header">
				<?php
							include('dbconfig.php');
				?>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-smile-o modal-icon"></i>
					<h4 class="modal-title">Coaching results</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "myForm" method="post" action = "updatecoaching.php" class="form-horizontal">
						<input id = "empidz" name = "id" type="hidden" class="form-control" readonly = "readonly">
							<div class="form-group">
								<div class = "col-md-1"></div>
								<div class="col-md-10"><textarea type="text" class="form-control" id = "result" name = "result" disabled></textarea></div>
							</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</form>
				</div>
			</div>
		</div>
	</div>
		<?php
			include('employeemenufooter.php');
		?>
	</body>
</html>