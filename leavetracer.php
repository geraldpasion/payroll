 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Leave Status</title>
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

		<script type="text/javascript">
			$(document).on("click", ".viewempdialog", function () {
			 var leaveid = $(this).data('id');
			 var name = $(this).data('name');
			 var start = $(this).data('start');
			 var end = $(this).data('end');
			 var reason = $(this).data('reason');
			 var type = $(this).data('type');
			 var empid = $(this).data('empid');
			 var remarks = $(this).data('remarks');
			 var sl = $(this).data('sl');
			 var vl = $(this).data('vl');
			 var inc = $(this).data('inc');
			 var ml = $(this).data('ml');
			 var pl = $(this).data('pl');
			 var spl = $(this).data('spl');

			 $(".modal-body #leaveid").val( leaveid );	
			 $(".modal-body #name").val( name );	
			 $(".modal-body #start").val( start );	
			 $(".modal-body #end").val( end );	
			 $(".modal-body #reason").val( reason );	
			 $(".modal-body #type").val( type );
			 $(".modal-body #empid1").val( empid );
			 $(".modal-body #remarks").val( remarks );
			// if(type == "Sick leave" && sl == 0) {
			// 	$(".modal-footer #approved").hide();
			// } if(type == "Paid rest day / Incentive" && vl == 0) {
			// 	$(".modal-footer #approved").hide();
			// }
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
				toastr.success("Leave successfully approved!");
				history.replaceState({}, "Title", "leavetracer.php");
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
				toastr.success("Leave successfully disapproved!");
				history.replaceState({}, "Title", "leavetracer.php");
			}
			showAlert=function(){
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
				toastr.error("Cannot approve application! Insufficient leave credits!");
				history.replaceState({}, "Title", "leavetracer.php");
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
		if(isset($_GET['disabled']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showAlert();'
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
                            <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">
				<?php
					include('dbconfig.php');

					if ($result = $mysqli->query("SELECT * FROM tbl_leave RIGHT JOIN employee ON employee.employee_id = tbl_leave.employee_id  WHERE leave_status = 'Approved' OR leave_status = 'Disapproved' ORDER BY leave_id DESC")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Name</th>";
							echo "<th>Date</th>";
                     
                            echo "<th>Reason</th>";
							echo "<th>Type</th>";
							echo "<th>Status</th>";
							echo "<th>Remarks</th>";
							echo "<th>Managed by</th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tfoot>";                    
								echo "<tr>";
								echo "<td colspan='9'>";
								echo "<ul class='pagination pull-right'></ul>";
								echo "</td>";
								echo "</tr>";
								echo "</tfoot>";
								
							while ($row = mysqli_fetch_object($result))
							{
								$leaveid = $row->leave_id;
								$empsid =$row->employee_id;
								echo "<tr>";
								echo "<td><a href='#' data-toggle='modal' data-target='#myModal4'
														data-name='$row->employee_firstname $row->employee_lastname' 
														data-empid='$row->employee_id' 
														data-id='$row->leave_id' 
														data-start='$row->leave_start'
														data-sl='$row->employee_sickleave'
														data-vl='$row->employee_vacationleave'
														data-inc = '$row->employee_incentive'
														data-ml = '$row->employee_maternityleave'
														data-pl = '$row->employee_paternityleave'
														data-spl = '$row->employee_singleparentleave'
														data-reason='$row->leave_reason'
														data-type='$row->leave_type'
														data-remarks='$row->leave_remarks'
														
									class = 'viewempdialog'>" . $row->employee_firstname . " " . $row->employee_lastname .  "</a></td>";
								echo "<td>" . date("Y-m-d",strtotime($row->leave_start)) . "</td>";
			
								echo "<td>" . $row->leave_reason . "</td>";
								echo "<td>" . $row->leave_type . "</td>";
								echo "<td>" . $row->leave_status . "</td>";
								echo "<td>" . $row->leave_remarks . "</td>";
								echo "<td>" . $row->leave_approvedby . "</td>";
								
								echo "<td> <a href = 'leaveappform.php?id=$empsid&leaveid=$leaveid'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a></td>";
								echo "</tr>";

							}
							echo "</table>";

						}
						else 
						{if ($result1 = $mysqli->query("SELECT * FROM tbl_leave WHERE leave_status = 'Approved' OR leave_status = 'Disapproved' ORDER BY tbl_leave.leave_id DESC")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped toggle-arrow-tiny' data-page-size='20'>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th data-toggle='true'>ID</th>";
										echo "<th>Name</th>";
										echo "</tr>";
										echo "</thead>";
										
										while ($row1 = mysqli_fetch_object($result1))
											
										{
											$empid = $row1->leave_id;
											echo "<tr class = 'josh'>";
											echo "<td>" . $row1->employee_id . "</td>";
											echo "<td>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</td>";
											echo "<td></td>";echo "</tr>";
										}
										
										echo "</table>";
									}}}
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
					<i class="fa fa-briefcase modal-icon"></i>
					<h4 class="modal-title">Leave details</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "reapproveleave.php"  class="form-horizontal">
						
							<div class="form-group">
						<input id = "leaveid" type="hidden" name = "leave_id1" class="zx" required="" onKeyPress="return lettersonly(this, event)">
						<input id = "empid1" type="hidden" name = "empid1" class="zx" required="" onKeyPress="return lettersonly(this, event)">
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Employee Name:</label>
								<div class="col-md-6"><input id = "name" type="text" name = "empid" class="zx" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Start:</label>
								<div class="col-md-8"><input id = "start" type="text" name = "start" class="zx" readonly = "readonly" onKeyPress="return lettersonly(this, event)"></div>
								</div>
						
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Reason:</label>
								<div class="col-md-8"><input type="text" id = "reason" class="zx" name = "reason" readonly = "readonly" size = "80"></div>
							</div>	
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Type:</label>
								<div class="col-md-8"><input type="text" id = "type" class="zx" name = "type" required="" readonly = "readonly"></div>
							</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Remarks:</label>
								<div class="col-md-6"><textarea type="text" id = "remarks" class="form-control" name = "remarks" readonly></textarea></div>
							</div>
							</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button class='btn btn-primary' type='submit' id="approved" name = "approved"><i class='fa fa-check'></i> Approve</button></a>
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