 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Loan Status</title>
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
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript" >//ajax
			$(function() {
			$(".approve").click(function(){
			var element = $(this);
			var ot_id = element.attr("id");
			var info = 'otid1=' + ot_id;
			 $.ajax({
			   type: "POST",
			   url: "approveloan.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").animate({ backgroundColor: "white" }, "slow")
			  .animate({ opacity: "hide" }, "slow");
			 $('#approved').fadeIn(300).delay(3200).fadeOut(300);
			 $(window).scrollTop(0);
			return false;
			});
			});
			
			
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var ot_id = element.attr("id");
			var info = 'otid1=' + ot_id;
			 $.ajax({
			   type: "POST",
			   url: "disapproveloan.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").animate({ backgroundColor: "white" }, "slow")
			  .animate({ opacity: "hide" }, "slow");
			 $('#delete').fadeIn(300).delay(3200).fadeOut(300);
			 $(window).scrollTop(0);
			return false;
			});
			});
		</script>
		<script type="text/javascript">
			$(document).on("click", ".viewempdialog", function () {
			 var overtimeid = $(this).data('id');
			 var date = $(this).data('date');
			 var start = $(this).data('start');
			 var end = $(this).data('end');
			 var reason = $(this).data('reason');
			 var name = $(this).data('name');
			 var remarks = $(this).data('remarks');
			 
			 $(".modal-body #overtimeid").val( overtimeid );	
			 $(".modal-body #employeename").val( name );	
			 $(".modal-body #overtimedate").val( date );	
			 $(".modal-body #overtimeremarks").val( remarks );
	
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
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<?php
					include('dbconfig.php');
						if ($result = $mysqli->query("SELECT * FROM loan RIGHT JOIN employee ON employee.employee_id = loan.employee_id WHERE loanstatus = 'Approved' OR loanstatus = 'Disapproved' OR loanstatus = 'In process' OR loanstatus = 'Encashed' ORDER BY loanid")) //get records from db
						{
							if ($result->num_rows > 0) //display records if any
							{
								echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
								echo "<thead>";
								echo "<tr>";	
								echo "<th>Name</th>";
								echo "<th>Date</th>";
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
									$loanid =$row->loanid;
									$empid = $row->employee_id;
									echo "<tr>";
										echo "<td><a href='#' data-toggle='modal' data-target='#myModal4'
														data-name='$row->employee_firstname $row->employee_lastname' 
														data-id='$row->loanid' 
														data-date='$row->loanDate'
														data-remarks='$row->loan_remarks'
														class = 'viewempdialog'>". $row->employee_firstname . " " . $row->employee_lastname . "</a></td>";
									//echo "<td>" . $row->employee_firstname . " " . $row->employee_lastname . "</td>";
									echo "<td>" . date("Y-m-d",strtotime($row->loanDate)) . "</td>";
						
									echo "<td>" . $row->loanstatus . "</td>";
									echo "<td style='width:200px;'>" . $row->loan_remarks . "</td>";
									echo "<td>" . $row->loan_approvedby. "</td>";

									// echo "<td> <a href = 'leaveappform.php?id=$empid&loadid=$loanid'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a></td>";

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
					<i class="fa fa-money modal-icon"></i>
					<h4 class="modal-title">Loan details</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "approveloan1.php"  class="form-horizontal">
						
							<div class="form-group">
						<input id = "overtimeid" type="hidden" name = "otid1" class="zx" required="" onKeyPress="return lettersonly(this, event)">
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Employee Name:</label>
								<div class="col-md-6"><input id = "employeename" type="text" readonly="" name = "empid" class="zx" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Date:</label>
								<div class="col-md-8"><input id = "overtimedate" type="text" readonly="" name = "lastname" class="zx" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-3 control-label">Remarks:</label>
								<div class="col-md-6"><textarea type="text" id = "overtimeremarks" class="form-control" name = "remarks" required></textarea></div>
							</div>
							</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button class='btn btn-primary' type='submit' name = "approved"><i class='fa fa-check'></i> Approve</button></a>
					<button class='btn btn-danger' type='submit' name = "disapproved"><i class='fa fa-warning'></i> Disapprove</button></button></a>
					<button class='btn btn-info' type='submit' name = "process">In process</button></a>
					<button class='btn btn-info' type='submit' name = "encash">Encashed</button></a>
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