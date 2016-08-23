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
		<title>Loan Approval</title>
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
			 
			 $(".modal-body #overtimeid").val( overtimeid );	
			 $(".modal-body #employeename").val( name );	
			 $(".modal-body #overtimedate").val( date );	
	
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
				toastr.success("Loan application successfully approved!");
				history.replaceState({}, "Title", "loanapproval.php");
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
				toastr.success("Loan application successfully disapproved!");
				history.replaceState({}, "Title", "loanapproval.php");
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
            <h5>Loan Approval</h5>
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
				 	<div id = "approved" class="alert alert-success alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            You have approved a loan application. <a class="alert-link" href="#">Alert Link</a>.
						</div>
				<div id = "delete" class="alert alert-success alert-dismissable" style="display: none;">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					You have disapproved a loan application. <a class="alert-link" href="#">Alert Link</a>.
				</div>
				<?php
					include('dbconfig.php');
					if ($result = $mysqli->query("SELECT * FROM loan RIGHT JOIN employee ON employee.employee_id = loan.employee_id WHERE loanstatus = 'pending' ORDER BY loanid")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Name</th>";
							echo "<th>Date</th>";
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
								$overtimeid = $row->loanid;
								echo "<tr class = 'josh'>";
								echo "<td><a href='#' data-toggle='modal' data-target='#myModal4'
														data-name='$row->employee_firstname $row->employee_lastname' 
														data-id='$row->loanid' 
														data-date='$row->loanDate'
														class = 'viewempdialog'>". $row->employee_firstname . " " . $row->employee_lastname . "</a></td>";
														echo "<td>" . date("Y-m-d",strtotime($row->loanDate)) . "</td>";
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
					<h4 class="modal-title">Loan Details</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "approveloan.php"  class="form-horizontal">
						
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
								<div class="col-md-6"><textarea type="text" id = "overtimeremarks" class="form-control" name = "remarks" placeholder = "Input your remarks here..."></textarea></div>
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