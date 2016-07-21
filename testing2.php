<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Holiday management</title>
		<style>
			.btn3{
				margin-left:26em;
			}
			.btn2{
				margin-left:-10.8em;
			}
		</style>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/0.4.2/sweet-alert.min.css" />
    <script data-require="jquery@*" data-semver="2.1.4" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script data-require="sweet-alert@*" data-semver="0.4.2" src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/0.4.2/sweet-alert.min.js"></script>
	<script src="sweetalert2-master/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert2.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript">
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var holiday_id = element.attr("id");
			var info = 'holiday_id1=' + holiday_id;
			if(confirm("Are you sure you want to delete this?"))
			{
			 $.ajax({
			   type: "POST",
			   url: "deleteholiday.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").animate({ backgroundColor: "white" }, "slow")
			  .animate({ opacity: "hide" }, "slow");
			 }
			return false;
			});
			});
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Holiday list</h5>
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
							if ($result = $mysqli->query("SELECT * FROM holiday ORDER BY holiday_id")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='1000' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th>Name</th>";
									echo "<th>Date</th>";
									echo "<th>Type</th>";
									echo "<th>Percentage</th>";
									echo "<th>Action</th>";
									echo "</tr>";
									echo "</thead>";
									
									while ($row = mysqli_fetch_object($result))
									{
										$holidayid = $row->holiday_id;
										echo "<tr class = 'josh'>";
										echo "<td>" . $row->holiday_name . "</td>";
										echo "<td>" . $row->holiday_date . "</td>";
										echo "<td>" . $row->holiday_type . "</td>";
										echo "<td>" . $row->holiday_rate . "%</td>";
										echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' ><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
										echo "<a href='#' id='$holidayid' class = 'delete'><button class='btn btn-danger' type='button'><i class='fa fa-warning'></i> Delete</button></button></a>";
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
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Edit holiday</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-2 control-label">Name</label>
									<div class="col-md-4"><input id = "employeeid" name = "employeeid" type="text" class="form-control"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Date</label>
									<div class="col-md-4"><input id = "employeeid" type="text" class="form-control"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Type</label>
									<div class="col-md-4"><input type="date" class="form-control" value = "<?php echo $getResult1->employeeid?>"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Rate</label>
									<div class="col-md-4"><input type="date" class="form-control" value = "<?php echo $getResult1->employee_middlename;?>"></div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>