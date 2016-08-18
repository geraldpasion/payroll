<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
			$empid = $_SESSION['logsession'];
		?>
		<title>Interview Schedule</title>
				<style>
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			.zx{
			border: none;
			border-color: transparent;
			margin-top:2%;
			}
			.modal{
			  z-index: 1100;
			}
			.ui-autocomplete { z-index:2147483647; }
		</style>
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
			$(document).on("click", ".viewempdialog", function () {
			 var date = $(this).data('date');
			 var time = $(this).data('time');
			 var interviewer = $(this).data('interviewer');
			 var comment = $(this).data('comment');
			 var name = $(this).data('name');
			 
			 $(".modal-body #date").val( date );	
			 $(".modal-body #time").val( time );	
			 $(".modal-body #interviewer").val( interviewer );	
			 $(".modal-body #comment").val( comment );
			 $(".modal-body #name").val( name );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   
			
			});
		</script>	
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Interview Schedule</h5>
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
					<form name="frmUser" method="post" action="excel101.php">
					<td><button id="submit" type="submit" name="export" class="btn btn3 btn-w-m btn-primary"><span style="float:left;">Export All </span><span class="glyphicon glyphicon-cloud-download" style="float:right;"></span></button></td>
						</form>
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

								if ($result1 = $mysqli->query("SELECT * FROM emp_data INNER JOIN studenttest ON emp_data.id=studenttest.stdid INNER JOIN employee ON emp_data.interviewer=employee.employee_id WHERE applicant_status = 'For interview'")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>Name</th>";
										echo "<th>Date applied</th>";
										echo "<th>Position</th>";
										echo "<th>Score</th>";
										echo "<th>Status</th>";
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
											$name = $row1->info_l_name ." ".  $row1->info_m_name ." ".  $row1->info_f_name;
											$id = $row1->id;
											$date = date("F d, Y",strtotime($row1->interview_date));
											$time = date("G:i A",strtotime($row1->interview_time));
											echo "<tr class = 'josh'>";
											echo "<td>" . $row1->info_l_name ." ".  $row1->info_m_name ." ".  $row1->info_f_name ."</td>";
											echo "<td>". date("Y-m-d",strtotime($row1->date_applied)) ."</td>";
											echo "<td>". $row1->position ."</td>";
											echo "<td>". $row1->correctlyanswered ."%</td>";
											echo "<td><a href='#' data-toggle='modal' class='viewempdialog' data-target='#myModal5' data-date='$date' data-time='$time' data-interviewer='$row1->employee_firstname $row1->employee_lastname' data-comment='$row1->comments' data-name='$name'>". $row1->applicant_status ."</a></td>";
											echo "<td> <a href = 'personalinfo.php?id=$id'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a></td>";
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
	<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-small">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-folder-o modal-icon"></i>
					<h4 class="modal-title">Interview details</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "approveleave.php"  class="form-horizontal">
						
							<div class="form-group">
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Name:</label>
								<div class="col-md-6"><input id = "name" type="text" name = "empid" class="zx" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Date:</label>
								<div class="col-md-6"><input id = "date" type="text" name = "empid" class="zx" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Time:</label>
								<div class="col-md-8"><input id = "time" type="text" name = "lastname" class="zx" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Interviewer:</label>
								<div class="col-md-8"><input type="text" id = "interviewer" class="zx" name = "firstname" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Comments:</label>
								<div class="col-md-6"><input type="text" id = "comment" class="zx" name = "firstname" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</form>
				</div>				
			</div>
	
	</body>
</html>