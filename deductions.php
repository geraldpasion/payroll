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
		<title>Deductions Settings</title>
		<style>
			.btn2{
				margin-left:-10.7em;
			}
		</style>
	<script>
		function myFunction() {
				document.getElementById("resetForm").reset();
			}
	</script>
	<script type="text/javascript">//ajax
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var deduction_id = element.attr("id");
			var info = 'deduction_id1=' + deduction_id + '&type=setting';
			 $.ajax({
			   type: "POST",
			   url: "deletedeductions.php",
			   data: info,
			   success: function(){
			   	window.setTimeout(function(){location.reload();}, 500);
			 }
			});
			  $(this).parents(".josh").remove();
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
				toastr.success('Successfully Deleted!');
			 
			return false;
			});
			});
		</script>
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- Clock picker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<script type="text/javascript" >//ajax
			$(document).ready(function(){
			$(document).on('submit','#myForm', function() {
			var deducttype = $("#deducttype option:selected").val();
			var reason = $("#reason").val();
			var date = $("#date").val();
			var name = $("#name").val();
		
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'name1=' + name +'&deducttype1=' + deducttype;
			if(reason==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
				$.ajax({
					type: "POST",
					url: "deductionexe.php",
					data: dataString,
					cache: false,
					success: function(result){
						$('#name').val('');
						$("#deducttype").val($("#deducttype").data("default-value"));
						$("#myModal4").modal("hide");
						eval(result);
					}
				});
			}
			return false;
			});
			});
		</script>	

		<script type="text/javascript">
		$(document).ready(function(){
			addDeductions=function(){
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
				toastr.success("Deductions successfully added to employee!");
			}
			history.replaceState({}, "Title", "deductions.php");				
		});
		</script>

		<?php
		if(isset($_GET['addDeductions']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'addDeductions();'
					, '});' 
			   , '</script>'
			;	
		}
		?>

		<style type="text/css">
		.divider{
		    position:absolute;
		    left:50%;
		    top:8%;
		    bottom:10%;
		    border-left:1px solid grey;
		}
		</style>

<!--custom gdp code-->
		<script type="text/javascript">
		    $(function() {
		        $('#deductionname').keyup(function() {
		            if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
		                this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
		            }
		        });
		    });

		</script>

		<script>
		function filter_type(choice){
		 //var choice = 'Taxable';
		 var elem = 'New';
		 var elem2 = 'Deductions';
			    $("#partinp").replaceWith("<div class='col-md-4' id='partinp'><select id = 'deductionname' name = 'deductionname' type='text' class='form-control' required></select></div>");
				$("#deductionname").load("filter.php?choice=" + choice + "&elem=" + elem + "&elem2=" + elem2);
		}
		</script>	
	
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Deductions Settings</h5>
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
                        	<a href='#' data-target="#myModal4" data-toggle='modal' ><button class='btn btn-info' name = 'edit' type='button'>New Deductions</button></a>
						</div>
					</div>
					<div class="ibox-content">		
						<div class="form-group">
							
							<form method="POST" id="resetForm" class="form-horizontal" action="deductionexe.php">
								<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="text-align:left">Type</label>
								<div class="col-md-4">
								<select class = "form-control" id = "type" name = "type" onchange="filter_type(this.value)" required="" >
									<option value="" disabled selected>Select Type</option>
									<option value="Taxable">Taxable</option>
									<option value="Non-Taxable">Non-Taxable</option>
								</select>
								</div>
							</div><br><br>
								<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-2 control-label">Deductions List</label>
								<div class="col-md-4" id="partinp"><select id = "deductionname" class="form-control"  data-default-value="" name="deductionname" required="">
									<option value="">Select Deductions</option>
									<?php 
									/*include('dbconfig.php');

									if ($result1 = $mysqli->query("SELECT * FROM deduction_settings")) //get records from db
									{
										if ($result1->num_rows > 0) //display records if any
										{																			
											while ($row1 = mysqli_fetch_object($result1))										
											{ 												
												echo '<option value="'.$row1->deduction_name.'">'.$row1->deduction_name.'</option>';
											}																					
										}
									}*/

									?>
									</SELECT>
								</div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-2 control-label">Deductions Amount</label>
								<div class="col-md-4"><input type="text" class="form-control" name="amount" placeholder="Enter Amount"/></div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-2 control-label">Initial Date</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required="" onKeyPress="return noneonly(this, event)" placeholder="click to pick date"/></div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-2 control-label">End Date</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control" name="daterange3" onKeyPress="return noneonly(this, event)" placeholder="click to pick date (optional)"/></div>
								<div class="col-sm-1" style="font-size:18px;"><a class="right" data-placement="right" data-toggle="tooltip" href="#" title="If no end date is specified, the deduction will be effective on all cutoffs after the start date."><span class="glyphicon glyphicon-info-sign" ></span></a></div>
							</div>
							
					<!-- <div class="form-group">
					<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"><input id = "date" type="text"  class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
					</div> -->

					<br><br><br><br>
					<div class="ibox-content">
						<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
					</div>
					<div class="ibox-content" id = "tableHolderz">
						<?php
							include('dbconfig.php');
							if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' ORDER BY employee_id")) //get records from db
							{

								if ($result1->num_rows > 0) //display records if any
								{
									echo "<label><input type='checkbox' id='select_all'/>&nbsp;&nbsp;Check/Uncheck All</label>";
									echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th style='text-align:center; width:150px;'></th>";
									echo "<th style='padding-left:100px; width:550px;'>Name</th>";
									echo "<th>Department</th>";
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
										echo "<td style='padding-left:100px;'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</td>";
										echo "<td>" . $row1->employee_department. "</td>";
										echo "</tr>";
									}
									
									echo "</table>";
								}
							}	
						?>
						<div class="form-group">								
							<div class="col-sm-4"></div>								
							<button id = "sub" type="submit" name="sub" class="btn btn3 btn-w-m btn-primary">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
							
						</div>
						</form>
						</div></div>
						<br>
						</div>
						<br><br>
	
	<!--div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">				
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Add New Deductions</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">						
						<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#newedit">Deductions</a></li>
								<li class=""><a data-toggle="tab" href="#deduct">Deductions Summary</a></li>
							</ul>
							<div class="tab-content">
								<!--div id="newedit" class="tab-pane fade active in" >
									<div class="panel-body">
										<form id="myForm" method="post" class="form-horizontal">
											<label class="col-md-4 control-label"><h2>Input New Deduction</h2></label><br><br><br><br>
										<div class="form-group">											
											<label class="col-sm-3 control-label">Particular</label>
												<div class="col-md-4" id="partinp"><input type="text" onfocus="clearThis(this)" id="name" name="name" class="form-control ename"required="" placeholder="Enter Name"></div>
												<br><br><br>		
											<label class="col-sm-3 control-label">Type</label>
												<div class="col-sm-4"><select id="deducttype" name="deducttype" class="form-control" data-default-value="z" required=""><option selected="true" disabled="disabled" value="">Select type...</option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
												<br><br><br>									
										</div>
										<div class="col-md-3"></div>
										<button id ="reset" type="reset" class="btn btn-w-m btn-warning">Reset</button>
										<button type="submit" class="btn btn-w-m btn-primary" id="sub2" name="sub2">Submit</button>		
										</form>
									</div>								
								</div-->
								<!--div id="newedit" class="tab-pane fade active in" >
									<div class="panel-body">
										<form id="myForm" method="post" class="form-horizontal">
											<label class="col-md-4 control-label"><h2>Input New Deduction</h2></label><br><br><br><br>
										<div class="form-group">											
											<label class="col-sm-3 control-label">Particular</label>
												<div class="col-md-4" id="partinp"><input type="text" onfocus="clearThis(this)" id="name" name="name" class="form-control ename"required="" placeholder="Enter Name"></div>
												<br><br><br>		
											<label class="col-sm-3 control-label">Type</label>
												<div class="col-sm-4"><select id="deducttype" name="deducttype" class="form-control" data-default-value="z" required=""><option selected="true" disabled="disabled" value="">Select type...</option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
												<br><br><br>									
										</div>
										<div class="col-md-3"></div>
										<button id ="reset" type="reset" class="btn btn-w-m btn-warning">Reset</button>
										<button type="submit" class="btn btn-w-m btn-primary" id="sub2" name="sub2">Submit</button>		
										</form>
									</div>								
								</div>

								<div style= "max-height:500px; min-height:300px; overflow-y:scroll;" id="deduct" class="tab-pane" >
									<div class="panel-body">
											<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
												<thead>
													<tr>
														<th>ID</th>
														<th>Particular</th>
														<th>Type</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
														/*$emp_deductions = $mysqli->query("SELECT * FROM deduction_settings  ORDER BY deduction_id");
														if($emp_deductions->num_rows > 0){
															while($deduct = mysqli_fetch_object($emp_deductions)){
																$deductid = $deduct->deduction_id;
																echo '<tr>';
																echo '<td>'.$deduct->deduction_id.'</td>';
																echo '<td>'.$deduct->deduction_name.'</td>';
																echo '<td>'.$deduct->deduction_type.'</td>';
																echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' id='$deductid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Delete</button></a></td>";
																echo '</tr>';
															}
														}*/
													?>
												</tbody>
											</table>
									</div>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div-->

	<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">				
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Add New Deductions</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">						
						<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#newedit">Deductions</a></li>
								<li class=""><a data-toggle="tab" href="#deduct">Deductions Summary</a></li>
							</ul>
							<div class="tab-content">
								<div id="newedit" class="tab-pane fade active in" >
									<div class="panel-body">
										<form id="myForm" method="post" class="form-horizontal">
											<label class="col-md-8 control-label"><h2>Input New Deduction</h2></label><br><br><br><br>
										<div class="form-group">											
											<label class="col-sm-5 control-label">Particular</label>
												<div class="col-md-4" id="partinp"><input type="text" onfocus="clearThis(this)" id="name" name="name" class="form-control ename"required="" placeholder="Enter Name"></div>
												<br><br><br>		
											<label class="col-sm-5 control-label">Type</label>
												<div class="col-sm-4"><select id="deducttype" name="deducttype" class="form-control" data-default-value="z" required=""><option selected="true" disabled="disabled" value="">Select type...</option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
												<br><br><br>									
										</div>
										<div class="col-md-4"></div>
										<button type="submit" class="btn btn-w-m btn-primary" id="sub2" name="sub2">Submit</button>
										<button id ="reset" type="reset" class="btn btn-w-m btn-warning">Reset</button>
										</form>
									</div>								
								</div>
								
								<div style= "max-height:500px; min-height:300px; overflow-y:scroll;" id="deduct" class="tab-pane" >
									<div class="panel-body">
											<?php
														$emp_deductions = $mysqli->query("SELECT * FROM deduction_settings ORDER BY deduction_id DESC");
														if($emp_deductions->num_rows > 0){
														echo '<table class="footable table table-stripped" data-page-size="10" data-limit-navigation="5" data-filter=#filter>';	
														echo '<thead>';
														echo '<tr>';
														echo '<th>ID</th>';
														echo '<th>Particular</th>';
														echo '<th>Type</th>';
														echo '<th style="text-align:center;">Action</th>';
														echo '</tr>';
														echo '</thead>';
														echo "<tfoot>";                    
														echo "<tr>";
														echo "<td colspan='7'>";
														echo "<ul class='pagination pull-right'></ul>";
														echo "</td>";
														echo "</tr>";
														echo "</tfoot>";
														while($deduct = mysqli_fetch_object($emp_deductions)){
																$deductid = $deduct->deduction_id;
																echo '<tr>';
																echo '<td>'.$deduct->deduction_id.'</td>';
																echo '<td>'.$deduct->deduction_name.'</td>';
																echo '<td>'.$deduct->deduction_type.'</td>';
																echo "<td style='text-align:center;'><a href='#' data-toggle='modal' data-target='#myModal4' id='$deductid' class = 'delete'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Delete</button></a></td>";
																echo '</tr>';
															}
														}
														echo "</table>";
													?>
									</div>
								</div>		
								<div class="modal-footer">
									<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
								</div>												
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
    $(function() {
        $('#name').keyup(function() {
            if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
            }
        });
    });
</script>
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
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
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
<script>
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip(); 
	});
</script>
<script src="js/jquery.min.js"></script>
   	   <script src="js/jquery.min.js"></script>
    <script src="js/timepicki.js"></script>
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