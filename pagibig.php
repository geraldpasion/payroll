 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Pagibig Table</title>
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
			 var compensation = $(this).data('compensation');
			 var employer = $(this).data('employer');
			 var employee = $(this).data('employee');
			 
			 $(".modal-body #id").val( id );
			 $(".modal-body #compensation").val( compensation );
			 $(".modal-body #employer").val( employer );
			 $(".modal-body #employee").val( employee );
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
						toastr.success("HDMF table successfully edited!");
				}
				history.replaceState({}, "Title", "pagibig.php");
				
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
            <h5>Pagibig Table</h5>
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

				<?php
					include('dbconfig.php');
					if ($result = $mysqli->query("SELECT * FROM pagibig")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='1000' data-filter=#filter>";											
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Compensation</th>";
                            echo "<th>Employer</th>";
							echo "<th>Employee</th>";
							echo "</tr>";
							echo "</thead>";
							
							while ($row = mysqli_fetch_object($result))
							{
								echo "<tr class ='josh'>";
								echo "<td>" . $row->hdmf_compensation . "</td>";
								echo "<td>" . $row->hdmf_employer . "</td>";
								echo "<td>" . $row->hdmf_employee	 . "</td>";
	

								echo "<td><a href='#' data-toggle='modal' data-target='#myModal4'
															data-id='$row->hdmf_id' 
															data-compensation='$row->hdmf_compensation' 
															data-employer='$row->hdmf_employer' 
															data-employee='$row->hdmf_employee' 
															
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
					<h4 class="modal-title">Edit HDMF</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "myForm" method="POST" action = "editpagibig.php" class="form-horizontal">
						<input id = "id" name = "id" type="hidden" class="form-control" readonly = "readonly">
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">Compensation</label>
								<div class="col-md-8"><input id = "compensation" name = "compensation" type="text" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">Employer</label>
								<div class="col-md-8"><input id = "employer" type="text" onpaste="return false" onDrop="return false" name = "employer" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">Employee</label>
								<div class="col-md-8"><input id = "employee" type="text" onpaste="return false" onDrop="return false" name = "employee" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>					
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>
    
		
		<?php
			include('menufooter.php');
		?>
	</body>
</html>