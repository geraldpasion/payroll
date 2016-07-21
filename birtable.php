 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>BIR Table</title>
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
			 var one = $(this).data('one');
			 var two = $(this).data('2');
			 var three = $(this).data('3');
			 var four = $(this).data('4');
			 var five = $(this).data('5');
			 var six = $(this).data('6');
			 var seven = $(this).data('7');
			 var eight = $(this).data('8');
			 var id = $(this).data('id');
			 
			 $(".modal-body #one").val( one );
			 $(".modal-body #id").val( id );
			 $(".modal-body #2").val( two );
			 $(".modal-body #3").val( three );
			 $(".modal-body #4").val( four );
			 $(".modal-body #5").val( five );
			 $(".modal-body #6").val( six );
			 $(".modal-body #7").val( seven );
			 $(".modal-body #8").val( eight );
			 $(".modal-body #6").val( total );
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
						toastr.success("BIR table successfully edited!");
				}
				history.replaceState({}, "Title", "birtable.php");
				
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
            <h5>BIR Table</h5>
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
					if ($result = $mysqli->query("SELECT * FROM witholding_tax")) //get records from db
					{
						if ($result->num_rows > 0) //display records if any
						{
							echo "<table class='footable table table-stripped' data-page-size='1000' data-filter=#filter>";								
							echo "<thead>";
							echo "<tr>";	
							echo "<th>Type</th>";
							echo "<th>Status</th>";
                            echo "<th>1</th>";
							echo "<th>2</th>";
							echo "<th>3</th>";
							echo "<th>4</th>";
							echo "<th>5</th>";
							echo "<th>6</th>";
							echo "<th>7</th>";
							echo "<th>8</th>";
							echo "</tr>";
							echo "</thead>";
							
							while ($row = mysqli_fetch_object($result))
							{
								echo "<tr class ='josh'>";
								echo "<td>" . $row->Payroll_Type . "</td>";
								echo "<td>" . $row->Status . "</td>";
								echo "<td>" . $row->Withholding_tax1 . "</td>";
								echo "<td>" . $row->Withholding_tax2 . "</td>";
								echo "<td>" . $row->Withholding_tax3 . "</td>";
								echo "<td>" . $row->Withholding_tax4 . "</td>";
								echo "<td>" . $row->Withholding_tax5 . "</td>";
								echo "<td>" . $row->Withholding_tax6 . "</td>";
								echo "<td>" . $row->Withholding_tax7 . "</td>";
								echo "<td>" . $row->Withholding_tax8 . "</td>";

								echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'editempdialog'
													data-id='$row->Tax_ID'
													data-one='$row->Withholding_tax1' 
													data-2='$row->Withholding_tax2' 
													data-3='$row->Withholding_tax3' 
													data-4='$row->Withholding_tax4' 
													data-5='$row->Withholding_tax5' 
													data-6='$row->Withholding_tax6' 
													data-7='$row->Withholding_tax7' 
													data-8='$row->Withholding_tax8' 
										
										><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
										
										
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
					<h4 class="modal-title">Edit BIR</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "myForm" method="POST" action = "editbirtable.php" class="form-horizontal">
						<input id = "id" name = "id" type="hidden" class="form-control" readonly = "readonly">
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">1</label>
								<div class="col-md-8"><input id = "one" name = "one" type="text" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">2</label>
								<div class="col-md-8"><input id = "2" type="text" name = "two" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">3</label>
								<div class="col-md-8"><input id = "3" type="text" name = "three" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">4</label>
								<div class="col-md-8"><input id = "4" type="text" name = "four" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">5</label>
								<div class="col-md-8"><input id = "5" type="text" name = "five" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">6</label>
								<div class="col-md-8"><input id = "6" type="text" name = "six" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">7</label>
								<div class="col-md-8"><input id = "7" type="text" name = "seven" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
							</div>
							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label">8</label>
								<div class="col-md-8"><input id = "8" type="text" name = "eight" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
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