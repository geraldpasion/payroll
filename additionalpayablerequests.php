 <!DOCTYPE html>
<html>

	<head>
		<?php
			
			session_start();
		$empLevel = $_SESSION['employee_level'];
		if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');

		}else if(isset($_SESSION['logsession']) && $empLevel == '4') {
			include('levelexe.php');
		}
		?>
		<title>Pending Additional Payable</title>
		<style>
			.form-horizontal .control-label{
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
			 var othersid = $(this).data('id');
			 var date = $(this).data('date');
			 var start = $(this).data('start');
			 var end = $(this).data('end');
			 var reason = $(this).data('reason');
			 var name = $(this).data('name');
			 var daytype = $(this).data('daytype');
			 var attend = $(this).data('attend');
			 var paid = $(this).data('paid');
			 var payable = $(this).data('payable');
			 var retro = $(this).data('retro');
			 var appstat = $(this).data('appstat');
			 
			 // sets the value for display in the modal
			 $(".modal-body #othersid").val( othersid );	
			 $(".modal-body #name").val( name );	
			 $(".modal-body #date").val( date );	
			 $(".modal-body #start").val( start );	
			 $(".modal-body #reason").val( reason );	
			 $(".modal-body #end").val( end );
			 $(".modal-body #daytype").val( daytype );
			 $(".modal-body #attend").val( attend );
			 $(".modal-body #paid").val( paid );
			 $(".modal-body #payable").val( payable );
			 $(".modal-body #retro").val( retro );
			 $(".modal-body #appstat").val( appstat );
			 // As pointed out in comments, 
			 // it is superfluous to have to manually call the modal.
			 // $('#addBookDialog').modal('show');   
			
			});
		</script>
		
	<script type="text/javascript">
	$(document).ready(function(){
		 showEdited=function(){ // toastr to be displayed for approved application
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
				toastr.success("Additional payable application successfully approved!");
				history.replaceState({}, "Title", "additionalpayablerequests.php");
		}
		showDisapproved=function(){ // toastr to be displayed for disapproved application
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
				toastr.success("Additional payable application successfully disapproved!");
				history.replaceState({}, "Title", "additionalpayablerequests.php");
		}
		
		
	});
	</script>
	<?php
		if(isset($_GET['approved'])) // checks if approved 
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		if(isset($_GET['disapproved'])) // checks if disapproved
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
            <h5>Pending Additional Payables</h5>
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
				<?php
					include('dbconfig.php');
					// fetches pending requests from others table 
					if ($result = $mysqli->query("SELECT * FROM others RIGHT JOIN employee ON employee.employee_id = others.employee_id WHERE others.app_status = 'Pending' ORDER BY others.attendance_date DESC")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Name</th>";
							echo "<th>Date</th>";
							echo "<th>Day type</th>";
							echo "<th>Attendance</th>";
                            echo "<th>Reason</th>";
                            echo "<th>Approval Status</th>";
							
							echo "</tr>";
							echo "</thead>";
							echo "<tfoot>";                    
							echo "<tr>";
							echo "<td colspan='7'>";
							echo "<ul class='pagination pull-right'></ul>";
							echo "</td>";
							echo "</tr>";
							echo "</tfoot>";
							
							while ($row = mysqli_fetch_object($result)) {
								$othersid = $row->others_id;
								if($row->attendance_timein == "") {
									$timein ="";
								} else {
									$timein=date("g:i A",strtotime($row->attendance_timein));
								}
								if($row->attendance_timeout == "") {
									$timeout ="";
								} else {
									$timeout=date("g:i A",strtotime($row->attendance_timeout));
								}
								if($row->attendance_absent == "0") {
									$attend = "Present";
								} else {
									$attend = "Absent";
								}
								echo "<tr class = 'josh'>";
								echo "<td><a href='#' data-toggle='modal' data-target='#myModal4'
														data-name='$row->employee_firstname $row->employee_lastname' 
														data-id='$row->others_id' 
														data-date='$row->attendance_date'
														data-daytype='$row->attendance_daytype'
														data-attend='$attend'
														data-start='$timein'
														data-end='$timeout'
														data-reason='$row->others_reason'
														data-paid='$row->others_paid'
														data-payable='$row->others_payable'
														data-retro='$row->others_retro'
														data-appstat='$row->app_status'

														class = 'viewempdialog'>". $row->employee_firstname . " " . $row->employee_lastname . "</a></td>";
								echo "<td>" . date("Y-m-d",strtotime($row->attendance_date)) . "</td>";
								echo "<td>" . $row->attendance_daytype . "</td>";
								if($row->attendance_absent == "0") {
									echo "<td>Present</td>";
								} else {
									echo "<td>Absent</td>";
								}
								echo "<td>" . $row->others_reason . "</td>";
								echo "<td>" . $row->app_status . "</td>";
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
					<h4 class="modal-title">Additional Payable Details</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "additionalapproval.php"  class="form-horizontal"> <!-- previously action=aproveovertime.php-->
						
							<div class="form-group">
							<input id = "othersid" type="hidden" name = "othersid" class="zx" required="" onKeyPress="return lettersonly(this, event)">
							<input id = "from" type="hidden" name = "from" class="zx" required="" value="req">
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Employee Name:</label>
								<div class="col-md-6"><input id = "name" type="text" name = "name" class="zx" required="" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Date:</label>
								<div class="col-md-8"><input id = "date" type="text" name = "date" class="zx" required="" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Day type:</label>
								<div class="col-md-8"><input id = "daytype" type="text" name = "daytype" class="zx" required="" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Attendance:</label>
								<div class="col-md-8"><input type="text" id = "attend" class="zx" name = "attend" required="" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
							</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Time in:</label>
								<div class="col-md-8"><input type="text" id = "start" class="zx" name = "start" required="" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Time out:</label>
								<div class="col-md-8"><input type="text" id = "end" class="zx" name = "end" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Paid:</label>
								<div class="col-md-8"><input type="text" id = "paid" class="zx" name = "paid" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
							</div>	
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Due:</label>
								<div class="col-md-8"><input type="text" id = "payable" class="zx" name = "payable" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
							</div>	
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Retro:</label>
								<div class="col-md-8"><input type="text" id = "retro" class="zx" name = "retro" readonly = "" onKeyPress="return lettersonly(this, event)"></div>
							</div>	
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Reason:</label>
								<div class="col-md-8"><input type="text" id = "reason" class="zx" name = "reason" required="" readonly = ""onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Status:</label>
								<div class="col-md-8"><input type="text" id = "appstat" class="zx" name = "appstat" required="" readonly = ""onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Remarks:</label>
								<div class="col-md-6"><textarea type="text" id = "othersremarks" class="form-control" name = "othersremarks" placeholder = "Input your remarks here..."></textarea></div>
							</div>
							</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button class='btn btn-primary' type='submit' name = "approved"><i class='fa fa-check'></i> Approve</button></a>
					<button class='btn btn-danger' type='submit' name = "disapproved"><i class='fa fa-warning'></i> Disapprove</button></button></a>
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