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
		<title>Earnings Settings</title>
		<style>
			.btn2{
				margin-left:-10.7em;
			}
		</style>
	<script>
			function myFunction() {
				document.getElementById("uploadForm").reset();
			}
		</script>
	<script type="text/javascript">//ajax
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var earnings_id = element.attr("id");
			var info = 'earnings_id1=' + earnings_id;
			 $.ajax({
			   type: "POST",
			   url: "deleteearnings.php",
			   data: info,
			   success: function(){
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
				toastr.success('Successfully Delete!');
			 
			return false;
			});
			});
		</script>
		<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- Clock picker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>
		<script type="text/javascript" >//ajax
			$(document).on('submit','#myForm', function() {
			var leavetype = $("#leavetype1 option:selected").val();
			var reason = $("#reason").val();
			var date = $("#date").val();
			var name = $("#name").val();
		
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'reason1='+ reason +'&date1=' + date + '&name1=' + name +'&leavetype1=' + leavetype;
			if(reason==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.


			$.ajax({
				type: "POST",
				url: "earningsexe.php",
				data: dataString,
				cache: false,
				success: function(result){
				$('#reason').val('');
				$('#name').val('');
				//$("#leavetype").val($("#leavetype").data("default-value"));
				$("#leavetype1").val($("#leavetype1").data("default-value"));
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

				toastr.success('Successfully Added	!');
  
					}
				});
			}

			return false;
			});
		</script>
<script type="text/javascript">
$(document).ready(function(){
	addEarnings=function(){
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
		toastr.success("Earnings successfully added to employee!");
	}
	history.replaceState({}, "Title", "processing.php");				
});
</script>

<?php
if(isset($_GET['addEarnings']))
{
	echo '<script type="text/javascript">'
			, '$(document).ready(function(){'	
			, 'addEarnings();'
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
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Basic Pay</h5>
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
<!-- 					<div class="ibox-content">
						<div class="form-group">
                        <div class = "col-md-5"></div>
                        	<a href='#' data-target="#myModal4" data-toggle='modal' ><button class='btn btn-info' name = 'edit' type='button'>New Earnings</button></a>
						</div>
					</div> -->

					<div class="ibox-content">		
							<div class="form-group">
							<div class="col-md-2"></div>
							<form method="POST" id="uploadForm" class="form-horizontal" action="earningsexe.php">
								<!-- label class="col-sm-2 control-label">Amount</label>
								<div class="col-md-4"><select id = "leavetype" class="form-control"  data-default-value="" name="earning" required="">
									<option value="">Select Earning</option>
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM earnings_setting")) //get records from db
																{
																	if ($result1->num_rows > 0) //display records if any
																	{
																	
																	
																		while ($row1 = mysqli_fetch_object($result1))
																	
																		{ 
																			
																			echo '<option value="'.$row1->earnings_name.'">'.$row1->earnings_name.'</option>';
																		}
																		
																		
																	}
																}
								?>
								</SELECT>
								</div> -->
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-md-1 control-label">Amount</label>
								<div class="col-md-4"><input type="text" class="form-control" name="amount" placeholder="Enter Amount"/></div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date Applied</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control" name="daterange3" onKeyPress="return noneonly(this, event)" placeholder="click to pick date"/></div>
							</div>
							<!-- <br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Amount</label>
								<div class="col-md-4"><input type="text" class="form-control" name="amount" placeholder="Enter Amount"/></div> -->
							<!-- </div> -->
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
								<div class="col-md-3"></div>
								<div class="col-md-5"><button id="submit" type="submit" name="sub" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
								<div class="col-md-4"><button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
							</div>
						</form>
						</div></div>
						<br>
						</div>
						<br><br>


<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Add new Earnings</h4>
				</div>    
        	<div class="modal-body">
					<div class="ibox-content" style="height:400px;">
						<div class="col-md-6">
							<h3 class="modal-title">Existing Earnings:</h3>
							<br>
							<div class="ibox-content" id = "tableHolderz">
							<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
								<?php
									include('dbconfig.php');
										if ($result1 = $mysqli->query("SELECT * FROM earnings_setting  ORDER BY earnings_id")) //get records from db
										{
											if ($result1->num_rows > 0) //display records if any
											{
												echo "<table class='footable table table-stripped' data-page-size='3' data-filter=#filter>";								
												echo "<thead>";
												echo "<tr>";
										
												echo "<th>Name</th>";
												echo "<th>Max Amount</th>";
												echo "<th>Type</th>";
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
													$empid = $row1->earnings_id;
													echo "<tr class = 'josh'>";
									

													echo "<td><a href='#' data-toggle='modal'			
													data-target='#myModal2' class = 'viewempdialog'>" . $row1->earnings_name . "</a></td>";
													echo "<td>" . $row1->earnings_max_amount . "</td>";
													echo "<td>" . $row1->earnings_type . "</td>";
												
												echo "<td><a href='#' data-toggle='modal' 
															
															
															data-target='#myModal4' id='$empid' class = 'delete'><button class='btn btn-warning' name = 'edit' type='button'><i class='fa fa-warning'></i> Delete</button></a>&nbsp;&nbsp;";
												
													echo "</tr>";

												}
												
												echo "</table>";
											}
										}
									


									
								?>
							</div>
						</div>

						<div class="col-md-6 divider">
							<h3 class="modal-title">Input New Earnings:</h3>
							<br>
							<form id="myForm" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label">Name</label>
									<div class="col-md-7"><input type="text" onfocus="clearThis(this)" id="name" class="form-control ename"required="" placeholder="Enter Name"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Max Amount</label>
									<div class="col-md-7"><input id = "reason" name = "reason" type="text" class="form-control" required="" placeholder = "Type the max amount here..."></div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Type</label>
									<div class="col-md-7"><select id="leavetype1" class="form-control" data-default-value="z" required=""><option selected="true" disabled="disabled" value="">Select type...</option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
								</div>
								<div class="col-md-4"></div>
									<button id ="reset" type="reset" class="btn btn-w-m btn-warning">Reset</button>
									<input type="submit" class="btn btn-w-m btn-primary" value="Submit">
								</form>
						</div>
					</div>
			</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
		</div>
	</div>
</div><br>

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