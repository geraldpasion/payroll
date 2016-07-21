<!DOCTYPE html>
<html>
	<head>
		<?php
			 include('menuheader.php');
		?>
		<title>Applicant list</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
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
		
		<!--<script type="text/javascript">
			$(document).ready(function(){
			  refreshTable();
			});
				$('#tableHolderz').load('getemployeetable.php', function(){
				   setTimeout(refreshTable, 1000);
				});
		</script>-->             
		
		<script type="text/javascript">
		function changetextbox()
		{
			if (document.getElementById("status").value == "For interview") {
				document.getElementById("date1").disabled=false;
				document.getElementById("time1").disabled=false;
				document.getElementById("interviewer1").disabled=false;
			} else {
				document.getElementById("date1").disabled=true;
				document.getElementById("time1").disabled=true;
				document.getElementById("interviewer1").disabled=true;
				$('#date1').val('');
				$('#time1').val('');
				$('#interviewer1').val('');
			}
		}
		</script>
		
		<script src="js/keypress.js"></script>
				<script type="text/javascript">
			$(document).on("click", ".editempdialog", function () {
			 var id = $(this).data('id');
			
			 
			 $(".modal-body #id").val( id );
			 
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

		<script type="text/javascript">
			$(function() {
				$('input[name="date"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
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
				toastr.success("Successfully updated applicant status!");
				history.replaceState({}, "Title", "applicants.php");
		}
		
		
	});
	</script>
	<?php
		if(isset($_GET['answered']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'showEdited();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		?>
		
		<script>
		function clearThis(target){
        	target.value= "";
    	}
		$(function() {
			$( ".ename" ).autocomplete({
				source: 'search2.php'
					
			});
			$( ".ename" ).autocomplete({
			select: function(e, ui) {  
                 document.getElementById("comment").focus();
               		}
             });

		});

		</script>
	</head>
	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Applicant list</h5>
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
					</div>
						<div class="ibox-content" id = "tableHolderz">
							<?php
							include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM emp_data INNER JOIN studenttest ON emp_data.id=studenttest.stdid ORDER BY interview_date DESC")) //get records from db
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
											if($row1->applicant_status=="Hired"){
												echo "<td>" . $row1->info_l_name ." ".  $row1->info_m_name ." ".  $row1->info_f_name ."</td>";
											}
											else{
											echo "<td><a href='#' data-toggle='modal' data-id='$row1->id' class='editempdialog' data-target='#myModal4'>" . $row1->info_l_name ." ".  $row1->info_m_name ." ".  $row1->info_f_name ."</a></td>";
											}
											
											echo "<td>". date("Y-m-d",strtotime($row1->date_applied)) ."</td>";
											echo "<td>". $row1->position ."</td>";
											echo "<td>". $row1->correctlyanswered ."%</td>";
											if ($result11 = $mysqli->query("SELECT * FROM employee where employee_id='".$row1->interviewer."'")) //get records from db
								{
									if ($result11->num_rows > 0) //display records if any
									{
										while ($row11 = mysqli_fetch_object($result11))
											
										{
										echo "<td><a href='#' data-toggle='modal' class='viewempdialog' data-target='#myModal5' data-date='$date' data-time='$time' data-interviewer='$row11->employee_firstname $row11->employee_lastname' data-comment='$row1->comments' data-name='$name'>". $row1->applicant_status ."</a></td>";
										}
									}
									else if($row1->applicant_status == 'No show' || $row1->applicant_status == 'Hired' ){
										echo "<td>". $row1->applicant_status ."</td>";
									}else{
										echo "<td>Pending</td>";
									}
								}
											
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
		
		<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-small">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-folder-o modal-icon"></i>
					<h4 class="modal-title">Applicant</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "applicantstatus.php"  class="form-horizontal">
							<div class="form-group">
								<div class = "form-group">
										<div class= "col-sm-1"></div><label class="col-sm-2 control-label">Status</label><div class = "col-md-8"><select class = "form-control" id = "status" value = "Select" name ="status" required="" onchange="changetextbox();" data-default-value="z"><option selected="true" disabled="disabled" value = "z">Select status...</option>  <option value = "For interview">For interview</option><option value = "No show">No show</option><option value = "Hired">Hired</option></select>
									</div>
								</div>
								<div class = "form-group">
								<input id = "id" name = "id" type="hidden" class="form-control" readonly = "readonly">
									<div class= "col-md-1"></div><label class="col-sm-2 control-label">Date</label>
									<div class = "col-md-8">	
										<input class = "form-control" id = "date1" name = "date" required = "" disabled>
									</div>
								</div>
								<div class = "form-group">
									<div class= "col-md-1"></div><label class="col-sm-2 control-label">Time</label>
									<div class = "col-md-8">	
										<input class = "form-control timepicker1" id = "time1" required = "" name ="time" disabled>
									</div>
								</div>
								<div class = "form-group">
									<div class= "col-md-1"></div><label class="col-sm-2 control-label">Interviewer</label>
									<div class = "col-md-8">	
										<input class = "form-control ename" id = "interviewer1" required = "" onClick = "clearThis(this);" name ="interviewer" disabled>
									</div>
								</div>							
							<div class="form-group">
								<div class="col-md-1"></div>
								<label class="col-sm-2 control-label">Comments</label>
								<div class="col-md-8"><textarea type="text" id = "comment" class="form-control" required = "" name = "comments" placeholder = "Input your remarks here..."></textarea></div>
							</div>
								
							</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button class='btn btn-primary' type='submit' name = "approved"><i class='fa fa-check'></i> Submit</button></a>
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</form>
				</div>				
			</div>
		</div>
	</div>
	
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
		</div>
	</div>
		   <script src="js/jquery.min.js"></script>
    <script src="js/timepicki.js"></script>
    <script>
	$('.timepicker1').timepicki();
    </script>

    <link href="css/timepicki.css" rel="stylesheet">
		<?php
			include('menufooter.php');
		?>
		
		
	</body>

</html>