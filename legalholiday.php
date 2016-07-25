<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Holiday management</title>
		<style>
			.btn3{
				margin-left:26em;
			}
			.btn2{
				margin-left:-10.8em;
			}
			.datepickar {
			z-index: 9999;
		}
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
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		
    <script data-require="jquery@*" data-semver="2.1.4" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript">
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var holiday_id = element.attr("id");
			var info = 'holiday_id1=' + holiday_id;
			
			
			 $.ajax({
			   type: "POST",
			   url: "deleteholiday.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").remove();
			 $(window).scrollTop(0);
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
				toastr.success("Holiday successfully deleted!");
			return false;
			});
			});
		</script>
		<script type="text/javascript">
			$(document).on("click", ".editholidaydialog", function () {
			var id = $(this).data('id');
			 var name = $(this).data('name');
			 var date = $(this).data('date');
			 var type = $(this).data('type');
			 var rate = $(this).data('rate');
			 
			 $(".modal-body #holidayid").val( id );
			 $(".modal-body #name").val( name );
			 $(".modal-body #date").val( date );
			 $(".modal-body #type").val( type );
			 $(".modal-body #rate").val( rate );
			 });
		</script>

		<script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
	<!--	<script type="text/javascript">
		 function showHide() {
			 function(zz){  
			 window.location.href='legalholiday.php';
		});  
		   var div = document.getElementById("edited");
		   if (div.style.display == 'none') {
			 style.display = 'block';
		   }
		   else {
			style.display = 'none';
		   }
		 }
		 </script>
	-->
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
				toastr.success("Holiday successfully edited!");
		}
		history.replaceState({}, "Title", "legalholiday.php");
		
	});
	</script>
		<?php
		if(isset($_GET['edited']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'
					, 'function alertFunction14() {'
					, '$("#edited").show();'
					, ''
					, '}'
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
						<h5>Holiday list</h5>
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
						<div id = "deleted" class="alert alert-success alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Holiday successfully deleted.
						</div>
						<div id = "edited" class="alert alert-success alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Holiday successfully edited.
						</div>
                        <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">

						<?php
							include('dbconfig.php');
							if ($result = $mysqli->query("SELECT * FROM holiday WHERE holiday_archive = 'active' ORDER BY holiday_id")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th>Name</th>";
									echo "<th>Date</th>";
									echo "<th>Type</th>";
									//echo "<th>Percentage</th>";
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
									
									while ($row = mysqli_fetch_object($result))
									{
										$holidayid = $row->holiday_id;
										echo "<tr class = 'josh'>";
										echo "<td><a href='#' data-toggle='modal' data-target='#myModal5' class = 'editholidaydialog'
													data-id='$row->holiday_id' 
													data-name='$row->holiday_name' 
													data-date='$row->holiday_date' 
													data-type='$row->holiday_type' 
													data-rate='$row->holiday_rate' >" . $row->holiday_name . "</a></td>";
										echo "<td>" . date("Y-m-d",strtotime($row->holiday_date)) . "</td>";
										
										$type = $row->holiday_type;
										if($type == "Special") {
											echo "<td>Special Holiday</td>";
										} else {
											echo "<td>Legal Holiday</td>";
										}

										//echo "<td>" . $row->holiday_rate . "%</td>";
										echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'editholidaydialog'
													data-id='$row->holiday_id' 
													data-name='$row->holiday_name' 
													data-date='$row->holiday_date' 
													data-type='$row->holiday_type' 
													data-rate='$row->holiday_rate' 
										
										><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
										
										echo "<a href='#' id='$holidayid' class = 'delete'><button class='btn btn-danger' type='button'><i class='fa fa-warning'></i> Delete</button></button></a>";
										echo "</td>";
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
					<i class="fa fa-edit modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Edit holiday</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" action = "editholiday.php" class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-3 control-label">Holiday ID</label>
									<div class="col-md-8"><input id = "holidayid" name = "holidayid" type="text" class="form-control" readonly = "readonly"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Name</label>
									<div class="col-md-8"><input id = "name" name = "name" type="text" onpaste="return false" onDrop="return false"class="form-control" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Date</label>
									<div class="col-md-8"><input id = "date" name = "daterange" type="text" class="form-control" readonly="readonly" required="" disabled></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Type</label>
									<div class="col-md-8"><select id = "type" name = "type" class = "form-control"><option value = "Regular">Legal</option><option value = "Special">Special</option></select></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Rate</label>
									<div class="col-md-8"><input id = "rate" name = "rate" class="form-control" onKeyPress="return doubleonly(this, event)"></div>
								</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name = "edit" class="btn btn-primary"><i class='fa fa-save'></i> Save</button>
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
					<i class="fa fa-gift modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Holiday details</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" action = "editholiday.php" class="form-horizontal">
								<div class="form-group">
									<div class = "col-sm-1"></div>
									<label class="col-sm-3 control-label">Holiday ID</label>
									<div class="col-md-8"><input id = "holidayid" name = "holidayid" type="text" class="zx" readonly = "readonly"></div>
								</div>
								<div class="form-group">
									<div class = "col-sm-1"></div>
									<label class="col-sm-3 control-label">Name</label>
									<div class="col-md-8"><input id = "name" name = "name" type="text" class="zx" readonly = "readonly" required="" onKeyPress="return lettersonly(this, event)"></div>
								</div>
								<div class="form-group">
									<div class = "col-sm-1"></div>
									<label class="col-sm-3 control-label">Date</label>
									<div class="col-md-8"><input id = "date" name = "" readonly = "readonly" type="text" class="zx" readonly="readonly" required=""></div>
								</div>
								<div class="form-group">
									<div class = "col-sm-1"></div>
									<label class="col-sm-3 control-label">Type</label>
									<div class="col-md-8"><input id = "type" name = "type" readonly = "readonly" class = "zx"></div>
								</div>
								<div class="form-group">
									<div class = "col-sm-1"></div>
									<label class="col-sm-3 control-label">Rate</label>
									<div class="col-md-8"><input id = "rate" name = "rate" class="zx" readonly = "readonly" onKeyPress="return doubleonly(this, event)"></div>
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
		<?php
			include('menufooter.php');
		?>
	</body>
</html>