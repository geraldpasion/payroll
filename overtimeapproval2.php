 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('supervisormenuheader.php');
			
			$employee_id = $_SESSION['logsession'];
		?>
		<title>Pending Overtime</title>
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
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		
		<script type="text/javascript">
			$(document).on("click", ".viewempdialog", function () {
			 var overtimeid = $(this).data('id');
			 var date = $(this).data('date');
			 var start = $(this).data('start');
			 var end = $(this).data('end');
			 var reason = $(this).data('reason');
			 var name = $(this).data('name');
			 var empid = $(this).data('empid');
			 var sessionid = $(this).data('sessionid');
			 			
			 						if(empid == sessionid){
				$("#approvebutton").addClass("hidden");
				$("#disapprovebutton").addClass("hidden");
			}else{
				$("#approvebutton").removeClass("hidden");
				$("#disapprovebutton").removeClass("hidden");
			}
			 
			 $(".modal-body #overtimeid").val( overtimeid );	
			 $(".modal-body #employeename").val( name );	
			 $(".modal-body #overtimedate").val( date );	
			 $(".modal-body #overtimestart").val( start );	
			 $(".modal-body #overtimereason").val( reason );	
			 $(".modal-body #overtimeend").val( end );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   
			
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
				toastr.success("Overtime application successfully approved!");
				history.replaceState({}, "Title", "overtimeapproval2.php");
		}
		showDisapproved=function(){
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
				toastr.success("Overtime application successfully disapproved!");
				history.replaceState({}, "Title", "overtimeapproval2.php");
		}
		
		
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
		if(isset($_GET['disapproved']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showDisapproved();'
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
            <h5>Pending Overtime</h5>
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
					$employeeidsession = $_SESSION['logsession'];
					if ($result = $mysqli->query("SELECT * FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id WHERE (employee.employee_team LIKE '$team' OR overtime.employee_id = $employee_id) AND overtime.overtime_status = 'pending' ORDER BY overtime.overtime_id")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Name</th>";
							echo "<th>Date</th>";
							echo "<th>Start</th>";
                            echo "<th>End</th>";
                            echo "<th>Duration</th>";
                            echo "<th>Reason</th>";
							//echo "<th>Action</th>";
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
								
									$empidmodal = $row->employee_id;
								$overtimeid = $row->overtime_id;
								echo "<tr class = 'josh'>";
								echo "<td><a href='#' data-toggle='modal' data-target='#myModal4'
														data-name='$row->employee_firstname $row->employee_lastname' 
														data-id='$row->overtime_id' 
														data-date='$row->overtime_date'
														data-start='$row->overtime_start'
														data-end='$row->overtime_end'
														data-reason='$row->overtime_reason'
														data-sessionid='$employeeidsession'
														data-empid='$empidmodal'
														
														class = 'viewempdialog'>". $row->employee_firstname . " " . $row->employee_lastname . "</a></td>";
								echo "<td>" . date("Y-m-d",strtotime($row->overtime_date)) . "</td>";
								echo "<td>" . date("g:i A",strtotime($row->overtime_start)) . "</td>";
								echo "<td>" . date("g:i A",strtotime($row->overtime_end)) . "</td>";
								$OTin = $row->overtime_start;
											$OTout = $row->overtime_end;											
											$OTCount = date('H:i', strtotime($OTout) - strtotime($OTin) - strtotime('02:00'));
											$arrayOTCount = array();
											$arrayOTCount = split(':', $OTCount);
											$OTCountMin = $arrayOTCount[1]/60;
											$OTCountDec = sprintf("%.2f", $arrayOTCount[0]+$OTCountMin);
											if($OTCountDec >= 5.00) {
												$OTCountDec = $OTCountDec - 1.00;
												$OTCountDec = sprintf("%.2f", $OTCountDec);
											}
											if ($stmt = $mysqli->prepare("update overtime set overtime_duration='".$OTCountDec."' where overtime_id = '".$overtimeid."'")){
											$stmt->execute();
											$stmt->close();
											}
											echo "<td>" . $OTCountDec . "</td>";
								echo "<td>" . $row->overtime_reason . "</td>";
								//echo "<td><a href='#' id='$overtimeid' class = 'approve'><button id ='approve' class='btn btn-primary' type='submit'><i class='fa fa-check'></i> Approve</button></a>&nbsp;&nbsp;
								//<a href='#' id='$overtimeid' class = 'delete'><button class='btn btn-danger' type='button'><i class='fa fa-warning'></i> Disapprove</button></button></a>
								//				</td>";
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
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-clock-o modal-icon"></i>
					<h4 class="modal-title">Overtime details</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "approveovertime2.php"  class="form-horizontal">
						
							<div class="form-group">
						<input id = "overtimeid" type="hidden" name = "otid1" class="zx" required="" onKeyPress="return lettersonly(this, event)">
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Employee Name:</label>
								<div class="col-md-6"><input id = "employeename" type="text" name = "empid" class="zx" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Date:</label>
								<div class="col-md-8"><input id = "overtimedate" type="text" name = "lastname" class="zx" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Start:</label>
								<div class="col-md-8"><input type="text" id = "overtimestart" class="zx" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">End:</label>
								<div class="col-md-8"><input type="text" id = "overtimeend" class="zx" name = "firstname" onKeyPress="return lettersonly(this, event)"></div>
							</div>	
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Reason:</label>
								<div class="col-md-8"><input type="text" id = "overtimereason" class="zx" name = "firstname" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Remarks:</label>
								<div class="col-md-6"><textarea type="text" id = "overtimeremarks" class="form-control" name = "remarks" placeholder = "Input your remarks here..."></textarea></div>
							</div>
							</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button id = "approvebutton" class='btn btn-primary' type='submit' name = "approved"><i class='fa fa-check'></i> Approve</button></a>
					<button id = "disapprovebutton" class='btn btn-danger' type='submit' name = "disapproved"><i class='fa fa-warning'></i> Disapprove</button></button></a>
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
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