<!DOCTYPE html>
<html>
	<head>

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
		<form method="post" action="addearningexe.php">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Earnings</h5>
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
								<label class="col-sm-1 control-label">Name/Max Amount</label>
								<div class="col-md-4"><select id = "leavetype" class="form-control"  data-default-value="z" name="maxamount" required="">
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM earnings_setting")) //get records from db
																{
																	if ($result1->num_rows > 0) //display records if any
																	{
																	
																	
																		while ($row1 = mysqli_fetch_object($result1))
																	
																		{ 
																			
																			echo '<option value="'.$row1->earnings_name." - Php".$row1->earnings_max_amount."\">".$row1->earnings_name.' - Php';
																			echo $row1->earnings_max_amount.'</option>';
																		}
																		
																		
																	}
																}

								?>
								</SELECT>
								</div>
							</div><br><br>

							<div class="form-group">
					<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Amount</label>
								<div class="col-md-4"><input type="text" id = "name" name="amount" class="form-control"></div>
					</div><br><br>
					<div class="form-group">
					<div class="col-md-3"></div>
									<label class="col-sm-1 control-label">Type</label>
								<div class="col-md-4"><select id = "leavetype1" name="type" class = "form-control" data-default-value="z" required=""><option selected="true" disabled="disabled" value = "z">Select type...</option><option value = "Monthly">Monthly</option><option value = "Semi-Monthly">Semi-Monthly</option></select></div>
							</div>

					</div>

					<br><br>
					
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

											echo "<td><a href='#' data-toggle='modal'
													
											data-target='#myModal2' class = 'viewempdialog'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
										
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-5"><button id = "submit" type="submit" name="sx" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
								<div class="col-md-4"><button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
							</div>
						</form>
						</div></div>
						<br>
						</div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
						<br><br><br><br><br><br><br><br><br><br><br><br><br>
			

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
	
		<?php
			include('menufooter.php');
		?>
	</body>

</html>