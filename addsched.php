<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Add Shift</title>
		<style>
			.btn2{
				margin-left:-10.7em;
			}
		</style>
	
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
			$(document).ready(function(){
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
			});
		</script>	
	
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Earnings Settings</h5>
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
							Successfully added.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Please fill all fields.
						</div>
						<form id = "myForm" method = "post"  class="form-horizontal">
													<div class="form-group">
								<div class="form-group">
								<label class="col-sm-4 control-label">Shift start</label>
								<div class="col-md-7"><input id = "lastname" type="text" name = "start" class="form-control timepicker1" required="" onKeyPress="return lettersonly(this, event)"></div>
							</div>
							<div class="form-group">	
								<label class="col-sm-4 control-label">Shift end</label>
								<div class="col-md-7"><input type="text" id = "firstname" class="form-control timepicker1" name = "end" required="" onKeyPress="return lettersonly(this, event)"></div>
							<div class="col-md-4"></div>
								<button id ="submit" type="submit" class="btn btn-w-m btn-primary">Submit</button>
							</form>
							<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						</div>
						<div class="ibox-content" id = "tableHolderz">
							<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM earnings_setting  ORDER BY earnings_id")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
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
			</div>
		</div>
	 <script src="js/jquery.min.js"></script>
    <script src="js/timepicki.js"></script>
    <script>
	$('.timepicker1').timepicki();
    </script>
     <script>
	$('.timepicker2').timepicki();
    </script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/timepicki.css" rel="stylesheet">
		<?php
			include('menufooter.php');
		?>
	</body>
</html>