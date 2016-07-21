<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
		</script>
		<?php
			 include('menuheader.php');
		?>
		<title>Export Attendance</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/plugins/iCheck/custom.css" rel="stylesheet">		
				
		<script src="js/keypress.js"></script>
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
						toastr.success("Employee team updated!");
				}
				history.replaceState({}, "Title", "excel.php");
				
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
						<h5>Export Attendance into excel</h5>
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
							
						<div class="ibox-content" id="tableHolderz">

							<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM emp_data ORDER BY id")) //get records from db
								{

									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";			
										echo "<thead>";
										echo "<tr>";
										echo "<th>Name</th>";
										echo "<th>Team</th>";
										echo "<th></th>";
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
											$empid = $row1->id;

											echo '<form name="frmUser" method="post" action="excel101.php">';
											echo "<tr class = 'josh'>";

											//echo "<td><input type='checkbox'  class='checkbox' name='id[]' value='$empid'></td>";

											echo "<td>" . $row1->info_l_name . "," . " " . $row1->info_f_name . " " . $row1->info_m_name . "</td>";
									

											//echo "<input type='hidden' value='".$id."' name='empid'>";
											echo '<td><button id="submit" type="submit" name="export" class="btn btn3 btn-w-m btn-primary"><span style="float:left;">Export</span><span class="glyphicon glyphicon-cloud-download" style="float:right;"></span></button></td>';
										
											echo "</tr>";
											echo "</form>";
										}
										
										echo "</table>";
									}
								}
							
						?>
						
						<br><br><br>
						</div></div>
						<br><br><br>
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


		<?php
			include('menufooter.php');
		?>
	</body>

</html>