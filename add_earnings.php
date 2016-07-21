<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
function setUpdateAction() {
document.frmUser.action = "add_earningsexe.php";
document.frmUser.submit();
}
		</script>
		<?php
			 include('menuheader.php');
		?>
		<title>Add Earnings</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/plugins/iCheck/custom.css" rel="stylesheet">		
				
		<script src="js/keypress.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				 addCutoff=function(){
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

				changeCutoff=function(){
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
						toastr.success("Cutoff successfully added to employee!");
				}
				history.replaceState({}, "Title", "add_earnings.php");
				
			});
		</script>
		<?php
		if(isset($_GET['added']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'addCutoff();'
					, '});' 
			   
			   , '</script>'
			;	
		}

		if(isset($_GET['changeCutoff']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'changeCutoff();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		?>
	</head>
	<body>
		<form name="frmUser" method="post" action="">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add Earnings</h5>
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
							<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Earnings List</label>
								<div class="col-md-4"><select id = "leavetype" class="form-control"  data-default-value="" name="sched" required="">
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
								</div>
							</div>
							
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Initial Date:</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required="" onKeyPress="return noneonly(this, event)" placeholder="click to pick date"/></div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">End Date:</label>
								<div class="col-md-4"><input id = "date" type="text" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" onKeyPress="return noneonly(this, event)" placeholder="click to pick date (optional)"/></div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Earning Amount:</label>
								<div class="col-md-4"><input type="text" class="form-control" placeholder="Enter Amount"/></div>
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
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
											echo "<td><input type='checkbox' id='select_all'/> Check/Uncheck All</label</td>";
										echo "<thead>";
										echo "<tr>";
										echo "<th></th>";
										echo "<th>Name</th>";
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

											echo "<td><input type='checkbox'  class='checkbox' name='id[]' value='$empid'></td>";

											echo "<td>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</td>";
										
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-5"><button id ="submit" type="submit" name="sx" class="btn btn3 btn-w-m btn-primary" onClick="setUpdateAction();">Submit</button></div>
								<div class="col-md-4"><button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
							</div>
						</form>
						</div></div>
						<br>
						</div>
						<br><br>


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
				$('input[name="daterange"]').daterangepicker();
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