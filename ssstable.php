 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>SSS Table</title>
		<style>
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			.zx{
			border: none;
			border-color: transparent;
			margin-top:1.5%;
			}
		
		</style>		
		<script type="text/javascript">
			$(document).on("click", ".editempdialog", function () {
			 var id = $(this).data('id');
			 var sssfrom = $(this).data('from');
			 var to = $(this).data('to');
			 var er = $(this).data('er');
			 var ee = $(this).data('ee');
			 var total = $(this).data('total');
			 
			 $(".modal-body #id").val( id );
			 $(".modal-body #from").val( sssfrom );
			 $(".modal-body #to").val( to );
			 $(".modal-body #er").val( er );
			 $(".modal-body #ee").val( ee );
			 $(".modal-body #total").val( total );
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
						toastr.success("SSS table successfully edited!");
				}
				history.replaceState({}, "Title", "ssstable.php");
				
			});
		</script>
		<?php
		if(isset($_GET['edited']))
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
						<h5>SSS Table</h5>
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
						<div id = "success" class="alert alert-success alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            You have disapproved a leave application. <a class="alert-link" href="#">Alert Link</a>.
						</div>
							<div id = "approved" class="alert alert-success alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            You have approved a leave application. <a class="alert-link" href="#">Alert Link</a>.
						</div>
						<?php
							include('dbconfig.php');
							if ($result = $mysqli->query("SELECT * FROM sss_contribution ORDER BY Range_Of_Compensation_To ")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='1000' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";	
									echo "<th>From</th>";
									echo "<th>To</th>";
									echo "<th>ER</th>";
									echo "<th>EE</th>";
									echo "<th>Total</th>";
									echo "<th>Action</th>";
									echo "</tr>";
									echo "</thead>";
									
									while ($row = mysqli_fetch_object($result))
									{
										echo "<tr class ='josh'>";
										echo "<td>" . $row->Range_Of_Compensation_From . "</td>";
										echo "<td>" . $row->Range_Of_Compensation_To . "</td>";
										echo "<td>" . $row->Social_Security_ER . "</td>";
										echo "<td>" . $row->Social_Security_EE . "</td>";
										echo "<td>" . $row->Social_Security_Total . "</td>";

										echo "<td><a href='#' data-toggle='modal' data-target='#myModal4'
															data-id='$row->SSS_ID' 
															data-from='$row->Range_Of_Compensation_From' 
															data-to='$row->Range_Of_Compensation_To' 
															data-er='$row->Social_Security_ER' 
															data-ee='$row->Social_Security_EE' 
															data-total='$row->Social_Security_Total' 
										class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;
										";
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
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Edit SSS</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "myForm" method="POST" action = "editssstable.php" class="form-horizontal">
						<input id = "id" name = "id" type="hidden" class="form-control" readonly = "readonly">
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">From</label>
								<div class="col-md-8"><input id = "from" name = "from" type="text" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">To</label>
								<div class="col-md-8"><input id = "to" type="text" name = "to" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">ER</label>
								<div class="col-md-8"><input id = "er" type="text" name = "er" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">EE</label>
								<div class="col-md-8"><input id = "ee" type="text" name = "ee" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">Total</label>
								<div class="col-md-8"><input id = "total" type="text" name = "total" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>							
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
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