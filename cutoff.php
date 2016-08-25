<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
function setUpdateAction() {
document.frmUser.submit();
}
		</script>
		<?php
				session_start();
		$empLevel = $_SESSION['employee_level'];
		if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');

		}else if(isset($_SESSION['logsession']) && $empLevel == '4') {
			include('levelexe.php');
		}
		?>
		<title>Cut Off Settings</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/plugins/iCheck/custom.css" rel="stylesheet">		
				
		<script src="js/keypress.js"></script>

		<script type="text/javascript">
		$(document).ready(function(){
		cutoffEdit=function(){
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
						toastr.success("Cutoff successfully added!");
				}
				history.replaceState({}, "Title", "cutoff.php");
			});
		</script>
		<?php
		if(isset($_GET['added']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'showAdded();'
					, '});' 
			   
			   , '</script>'
			;	
		}

		if(isset($_GET['changeShift']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'shiftEdit();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		if(isset($_GET['changeCutoff']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'cutoffEdit();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		?>
		<?php
			if(isset($_GET['deactivated']))
			{
				echo '<script type="text/javascript">'
				   , 'alertFunction();'
				   , '</script>'
				;	
			}
		?>
		
		<script type="text/javascript">//ajax
			$(function() {
			$(".deactivate").click(function(){
			var element = $(this);
			var cutoff_id = element.attr("id");
			var info = 'cutoff_id1=' + cutoff_id;
			
			 $.ajax({
			   type: "POST",
			   url: "deactivatecutoff.php",
			   data: info,
			   success: function(){
				 $.ajax({
				   type: "POST",
				   url: "cutoffrefreshdropdown.php",
				   success: function(data){
				   	$('#leavetype').html(data);
				 }
				});
			 }
			});

			 
			  $(this).parents(".josh").find('td[name=cutoff_status]').each(function(){
			  	$(this).html('Inactive');
			  });
			 $('#success').fadeIn(300).delay(3200).fadeOut(300);
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
				toastr.success('Cutoff successfully Deactivated!');
			 
			return false;
			});
			});
		</script>

		<script type="text/javascript">//ajax
			$(function() {
			$(".activate").click(function(){
			var element = $(this);
			var cutoff_id = element.attr("id");
			var info = 'cutoff_id1=' + cutoff_id;
			
			 $.ajax({
			   type: "POST",
			   url: "activatecutoff.php",
			   data: info,
			   success: function(){
				 //refresh ajax of dropdown cutoff
				 $.ajax({
				   type: "POST",
				   url: "cutoffrefreshdropdown.php",
				   success: function(data){
				   	$('#leavetype').html(data);
				 }
				});
			 }
			});

			  $(this).parents(".josh").find('td[name=cutoff_status]').each(function(){
			  	$(this).html('Active');
			  });
			 $('#success').fadeIn(300).delay(3200).fadeOut(300);
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
				toastr.success('Cutoff successfully Activated!');
			 
			return false;
			});
			});
		</script>

		<script type="text/javascript">//ajax
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var cutoff_id = element.attr("id");
			var info = 'cutoff_id1=' + cutoff_id;
		   	$("#myModal4").modal("hide");
			swal({   title: "Are you sure?",   text: "You will not be able to recover this imaginary file!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){   swal("Deleted!", "Your imaginary file has been deleted.", "success");
				$.ajax({
				   type: "POST",
				   url: "deletecutoff.php",
				   data: info,
				   success: function(){
				   		$(element).parents(".josh").remove();
					 //refresh ajax of dropdown cutoff
						 $.ajax({
						   type: "POST",
						   url: "cutoffrefreshdropdown.php",
						   	success: function(data){
							   	$('#leavetype').html(data);
							}
						});

					}
				});		
				$('#success').fadeIn(300).delay(3200).fadeOut(300);
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
						toastr.success('Cutoff successfully Deleted!');
			 	
				});
			});
			});
		</script>
	</head>
	<body>
		<form name="frmUser" method="post" action="cutoffexe.php">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Cut Off Settings</h5>
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
						<div class="form-group">
	                        <div class = "col-md-5"></div>
	                        <a href='#' data-target="#myModal4" data-toggle='modal' ><button class='btn btn-info' name = 'edit' type='button'>New Cut-off</button></a>
						</div>
						<!--Schedule List-->
						<div class="form-group">
							<label class="col-sm-2 control-label" style="text-align:right;valign:center;">Schedule List</label>
							<div class="col-md-4">
								<select id = "leavetype" class="form-control"  data-default-value="z" name="sched" required="">
									<?php 
									include('dbconfig.php');

									if ($result1 = $mysqli->query("SELECT * FROM cutoff WHERE cutoff_status = 'Active' AND cutoff_sched_submission=''")) //get records from db
										{
											if ($result1->num_rows > 0) //display records if any
											{
												echo '<option value=""> Select Cutoff &nbsp;&nbsp;(Month-Day-Year) </option>';
												while ($row1 = mysqli_fetch_object($result1)){
													$initial = $row1->cutoff_initial;
													$end = $row1->cutoff_end;

													echo '<option value="'.$initial." - ".$end."\">".date("F d, Y",strtotime($initial)).' - ';
													echo date("F d, Y",strtotime($end)).'</option>';
												}
											}
										}
									?>
								</select>
							</div>
						</div>
						<!--Payment Schedule-->
						<div class="form-group">
							<label class="col-sm-2 control-label" style="text-align:right">Payment Schedule</label>
							<div class="col-md-4">
								<select class="form-control" name="paymentsched" id="paymentsched" onchange="filter(this.value)" required>
                              			<option>Select Payment Schedule..</option>
                                		<option value="Monthly">Monthly</option>
                                		<option value="Semi-monthly">Semi-monthly</option>
                              	</select>
							</div>
						<br><br><br><br>
						<div class="ibox-content">
							<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						</div>
						<div class="ibox-content" id = "tableHolderz">
							<div id="divMonthly" style="display:none;">
							<?php
								include('dbconfig.php');
									if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' and cutoff = 'Monthly' ORDER BY employee_id")) //get records from db
									{

										if ($result1->num_rows > 0) //display records if any
										{
											echo "<label><input type='checkbox' id='select_all'/>&nbsp;&nbsp;Check/Uncheck All</label>";
											echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
											echo "<thead>";
											echo "<tr>";
											echo "<th style='text-align:center; width:150px;'></th>";
											echo "<th style='padding-left:100px; width:400px;'>Name</th>";
											echo "<th>Department</th>";
											echo "<th>Payment Schedule</th>";
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
												$empid = $row1->employee_id;

												echo "<tr class = 'josh'>";
												echo "<td align='center'><input type='checkbox'  class='checkbox' name='id[]' value='$empid'></td>";
												echo "<td style='padding-left:100px'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</td>";
												echo "<td>" . $row1->employee_department. "</td>";
												echo "<td>" . $row1->cutoff. "</td>";
												echo "</tr>";
											}
											
											echo "</table>";
										}
									}
								
							?>
								<div class="form-group">								
									<div class="col-sm-8"></div>								
									<div class="col-sm-2">
									<button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
									<button id = "submit" type="submit" name="sx" class="btn btn3 btn-w-m btn-primary" onClick="setUpdateAction();">Submit</button>
								</div>
							</form>
						</div>
						<div id="divSMonthly" style="display:none;">
							<?php
								include('dbconfig.php');
									if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' and cutoff = 'Semi-monthly' ORDER BY employee_id")) //get records from db
									{

										if ($result1->num_rows > 0) //display records if any
										{
											echo "<label><input type='checkbox' id='select_all1'/>&nbsp;&nbsp;Check/Uncheck All</label>";
											echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
											echo "<thead>";
											echo "<tr>";
											echo "<th style='text-align:center; width:150px;'></th>";
											echo "<th style='padding-left:100px; width:400px;'>Name</th>";
											echo "<th>Department</th>";
											echo "<th>Payment Schedule</th>";
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
												$empid = $row1->employee_id;

												echo "<tr class = 'josh'>";
												echo "<td align='center'><input type='checkbox'  class='checkbox1' name='id[]' value='$empid'></td>";
												echo "<td style='padding-left:100px'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</td>";
												echo "<td>" . $row1->employee_department. "</td>";
												echo "<td>" . $row1->cutoff. "</td>";
												echo "</tr>";
											}
											
											echo "</table>";
										}
									}
								
							?>
								<div class="form-group">								
									<div class="col-sm-8"></div>								
									<div class="col-sm-2">
									<button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
									<button id = "submit" type="submit" name="sx" class="btn btn3 btn-w-m btn-primary" onClick="setUpdateAction();">Submit</button>
								</div>
							</form>
						</div>
						<script type="text/javascript">
                            $(function () {
                                $('#divMonthly').hide();
                                $('#divSMonthly').hide();
                                $('#paymentsched').bind('change', function(event) {
                                	var i= $('#paymentsched').val();
                                           
                                	if(i=="Monthly") {
                                    	$('#divMonthly').show();
                                    	$('#divSMonthly').hide();

                                	}
                                	else if(i=="Semi-monthly") {
                                    	$('#divMonthly').hide();
                                    	$('#divSMonthly').show();
                                	}
                                	else {
                                    	$('#divMonthly').hide();
                                    	$('#divSMonthly').hide();
                               	 	}
                                });
                            });
                        </script>
						</div>
					</div>
				<br>
				</div>
			</div>
		</div>
		<br><br>
				
			

	<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Add New Cut-off</h4>
				</div>    
        		<div class="modal-body">
					<div class="ibox-content">
					<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#newcutoff">New Cut Off</a></li>
								<li class=""><a data-toggle="tab" href="#editcutoff">Edit Cut Off</a></li>
							</ul>
						<div class="tab-content">
							<div id="newcutoff" class="tab-pane fade active in" >
						<div class="panel-body">
						<form id = "uploadForm" method="POST" action="" onsubmit="return false;" class="form-horizontal">

							<div class="form-group">
								<label class="col-sm-2 control-label">From</label>
								<div class="col-md-8"><input type="text" id="daterange2" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required="" placeholder="click to pick date"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">To</label>
								<div class="col-md-8"><input type="text" id="daterange3" onpaste="return false" onDrop="return false" class="form-control" name="daterange3" required="" placeholder="click to pick date"></div>
							</div>
							<div class="col-md-3"></div>
									<button id ="reset" type="reset" class="btn btn-w-m btn-warning">Reset</button>
									<input id ="addCutoff" type="submit" class="btn btn-w-m btn-primary" name="addCutoff" value="Submit">
						</form>
						</div>
						</div>
				</ul>
				<div id="editcutoff" class="tab-pane" >
						<div class="panel-body">
							<div class="form-group" style= 'max-height:500px; min-height:150px; overflow-y:scroll;'>

							<!-- <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table"> -->
								<?php
									include('dbconfig.php');
										if ($result1 = $mysqli->query("SELECT * FROM cutoff")) //get records from db
										{
											if ($result1->num_rows > 0) //display records if any
											{
												echo "<table  class='table table-stripped' data-filter=#filter>";

												echo "<thead>";
												echo "<tr>";
												echo "<th>From</th>";
												echo "<th>To</th>";
												echo "<th>Status</th>";
												echo "<th>Action</th>";
												echo "</tr>";
												echo "</thead>";
												echo "<tfoot>";                    
												echo "<tr>";
												echo "</td>";
												echo "</tr>";
												echo "</tfoot>";
											
												while ($row1 = mysqli_fetch_object($result1))
													
												{
													$cutoffid = $row1->cutoff_id;
													echo "<tr class = 'josh'>";
									

													echo "<td>" . $row1->cutoff_initial. "</td>";
													echo "<td>" . $row1->cutoff_end . "</td>";
													if($row1->cutoff_status == 'Inactive'){
														$c_status = 'Submitted';
													}
													else{
														$c_status = $row1->cutoff_status;													}
													echo "<td name='cutoff_status'>" . $c_status . "</td>";													
												
													echo "<td><a href='#' data-toggle='modal'"; 
																														
													//echo "<a href='#' id='$cutoffid' class = 'deactivate'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Deactivate</button></button></a>&nbsp;&nbsp;";
													//echo "<a href='#' id='$cutoffid' class = 'activate'><button class='btn btn-primary' type='button'><i class='fa fa-check'></i> Activate</button></a>&nbsp;&nbsp;";
													echo "<a href='#' id='$cutoffid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Delete</button></button></a>";

													echo "</tr>";

												}
												
												echo "</table>";
											}
										}
									


									
								?>
							</div>
						</div>
					</div>
					
				</ul>
				</div>
			</div>
		</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
				</div>
					</form>
				</div>
			</div>
			</div>
</div>

<?php
// if(isset($_POST['edit'])){
// echo "<div class='modal-body'>";
// echo "<input id = 'employeeid' name = 'employeeid' type='text' class='form-control'>";
// echo "</div>";
 // $employeeid = $_GET['employeeid'];

 // }
 ?>
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    $('#select_all1').on('click',function(){
        if(this.checked){
            $('.checkbox1').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox1').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
    $('.checkbox1').on('click',function(){
        if($('.checkbox1:checked').length == $('.checkbox1').length){
            $('#select_all1').prop('checked',true);
        }else{
            $('#select_all1').prop('checked',false);
        }
    });
});

</script>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange2"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange3"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
    <script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker();
			});
		</script>
			   <script src="js/jquery.min.js"></script>
   	   <script src="js/jquery.min.js"></script>
    <script src="js/timepicki.js"></script>
    <script type="text/javascript">
			$("#addCutoff").click(function(){
				var daterange2 = $("#daterange2").val();
				var daterange3 = $("#daterange3").val();
				var paysched = $("#paymentsched").val();
				var element = $(this);
				 $.ajax({
				   type: "POST",
				   url: "cutoffexe.php?daterange2=" + daterange2 + "&daterange3=" + daterange3 + "&paysched" + paymentsched,
				   success: function(data){
				   		//location.reload();
						eval(data);
						$.ajax({
						   type: "POST",
						   url: "cutoffrefreshdropdown.php",
						   success: function(data){
						   		$('#leavetype').html(data);
							}
						});
					}
				});
				showAdded=function(){
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
					toastr.success("Cut-off successfully added!");
				}
				header("Location: cutoff.php?changeCutoff");
			});
		</script>
    <script>
	$('.timepicker1').timepicki();
    </script>
     <script>
	$('.timepicker2').timepicki();
    </script>
    <link href="css/timepicki.css" rel="stylesheet">

		<?php
			include('menufooter.php');
		?>
	</body>

</html>