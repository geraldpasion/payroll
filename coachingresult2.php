<!DOCTYPE html>
<html>

	<head>
		<?php
			include('supervisormenuheader.php');
			$employee_id = $_SESSION['logsession'];
			$team = $_SESSION['employee_team'];
		?>
		<title>Coaching Update</title>
		<script type="text/javascript">
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var coaching_id = element.attr("id");
			
			var info = 'coaching_id='+ coaching_id;
			 $.ajax({
			   type: "GET",
			   url: "deletecoaching.php",
			   data: info,
			   success: function(){
				    
				   toastr.options = { 
				"closeButton": true,
			  "debug": false,
			  "progressBar": true,
			  "preventDuplicates": false,
			  "positionClass": "toast-top-right",
			  "onclick": null,
			  "showDuration": "400",
			  "hideDuration": "1000",
			  "timeOut": "7000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut" // 1.5s
				}
			toastr.success('Successfully cancelled coaching!');
			 }
			 
			});
				$(this).parents(".josh").remove();
			return false;
			});
			});
		</script>
		<script type="text/javascript">
			$(document).on("click", ".editempdialog", function () {
			 var id = $(this).data('empid');
			 
			  $(".modal-body #empidz").val( id );
			});
		</script>
		
		
		<script type="text/javascript">
			$(document).ready(function(){
			showEdited=function(){
			toastr.options = { 
				"closeButton": true,
			  "debug": false,
			  "progressBar": true,
			  "preventDuplicates": true,
			  "positionClass": "toast-top-right",
			  "onclick": null,
			  "showDuration": "400",
			  "hideDuration": "1000",
			  "timeOut": "7000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut" // 1.5s
				}
				toastr.success("Result successfully updated!");
			}
			history.replaceState({}, "Title", "coachingresult2.php");
			});
		</script>
		<?php
		if(isset($_GET['approved']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		?>
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Coaching Update</h5>
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
						<div class="row">
							<div class="col-sm-3">

								</div>
							</div>
						</div>
					<div class="ibox-content">
						<div id = "success" class="alert alert-success alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Employee successfully activated. <a class="alert-link" href="#">Alert Link</a>.
						</div>
						<?php
							include('dbconfig.php');
							
								if ($result = $mysqli->query("SELECT * FROM coaching INNER JOIN employee ON employee.employee_id = coaching.employee_id WHERE (coaching.coaching_trainerid = $employee_id OR employee.employee_team LIKE '$team') AND coaching.coaching_status = 'Pending'")) //get records from db
								{
									if ($result->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
										echo "<thead>";
									echo "<tr>";
									echo "<th>Date</th>";
									echo "<th>Time</th>";
									echo "<th>Trainer</th>";
									echo "<th>Trainee</th>";
									echo "<th>Subject</th>";
									echo "<th style='text-align:center;'>Action</th>";
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
											$empid = $row->coaching_id;
											echo "<tr class = 'josh'>";
											echo "<td>" . date("Y-m-d",strtotime($row->coaching_date)) . "</td>";
											echo "<td>" . date("G:i A",strtotime($row->coaching_time)) . "</td>";
											echo "<td>" . $row->coaching_coachemployeeid . "</td>";
											echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
											echo "<td>" . $row->coaching_subject . "</td>";
											echo "<td style='text-align:center;'><a href='#' id='$empid' data-toggle='modal' 
															data-empid='$row->coaching_id' 
											data-target='#myModal4' class = 'editempdialog'><button class='btn btn-primary' type='button'><i class='fa fa-smile-o'></i> Update</button></button></a>&nbsp;&nbsp;
											<a href='#' id='$empid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-exclamation'></i> Cancel</button></button></a>";
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
					<h4 class="modal-title">Update result</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "myForm" method="post" action = "updatecoaching2.php" class="form-horizontal">
						<input id = "empidz" name = "id" type="hidden" class="form-control" readonly = "readonly">
							<div class="form-group">
								<div class = "col-md-1"></div>
								<label class="col-sm-2 control-label">Result</label>
								<div class="col-md-8"><textarea type="text" class="form-control" id = "result" name = "result" placeholder="Input your coaching result here..."></textarea></div>
							</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary coaching">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>