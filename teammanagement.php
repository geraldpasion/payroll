<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
function setUpdateAction() {
document.frmUser.action = "teammanagementexe.php";
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
		<title>Team Management</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/plugins/iCheck/custom.css" rel="stylesheet">		
				
		<script src="js/keypress.js"></script>
		<script>
		function myFunction() {
			document.getElementById("frmUser").reset();
		}
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
						toastr.success("Employee team updated!");
				}
				history.replaceState({}, "Title", "teammanagement.php");
				
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
		<form name="frmUser" id="frmUser" method="post" action="">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Team Management</h5>
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
						                        <div class = "col-md-5"></div><a href='#' data-target="#myModal4" data-toggle='modal' ><button class='btn btn-primary' name = 'edit' type='button'>New Team</button></a><br><br><br>
							<div class="form-group">
							
							<div class="col-md-3"></div>
								<label class="control-label col-sm-1" style="margin-top:5px;">Team</label>
																<div class="col-md-4"><select id = "teamname" class="form-control"  data-default-value="z" name="teamname" required="">
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM team")) //get records from db
																{
																	if ($result1->num_rows > 0) //display records if any
																	{
																	
																	
																		while ($row1 = mysqli_fetch_object($result1))
																	
																		{ 
																			
																			echo '<option value="'.$row1->team_name."\">".$row1->team_name. '</option>';
																			
																		}
																		
																		
																	}
																}

								?>
								</SELECT>
								</div>
							</div><br>
					<BR>
					<BR>
					<BR>
					<div class="ibox-content">
					<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						</div>
						<div class="ibox-content" id = "tableHolderz">

							<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' ORDER BY employee_team")) //get records from db
								{

									if ($result1->num_rows > 0) //display records if any
									{
										echo "<label><input type='checkbox' id='select_all'/>&nbsp;&nbsp;Check/Uncheck All</label>";
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th style='text-align:center; width:150px;'></th>";
										echo "<th style='padding-left:100px; width:550px;'>Name</th>";
										echo "<th>Department</th>";
										echo "<th>Team</th>";
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
											echo "<td>" . $row1->employee_team. "</td>";
										
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>
							<div class="form-group">
								<div class="col-md-8"></div>
								<button id = "submit" type="submit" name="sx" class="btn btn3 btn-w-m btn-primary" onClick="setUpdateAction();">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" onClick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
							</div>
						</form>
						<br><br><br>
						</div></div>
						<br><br><br>
						</div>
						
				
					<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-small">
			<div class="modal-content">
				<div class="modal-header">
				<?php
					//$q = mysqli_query("SELECT * FROM employee WHERE employee_id = '$empid");
					$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
					$res = $mysqli->query("SELECT * FROM employee");
				?>

					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Add New Team</h4>
				</div>    
        	<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "addteam.php" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label">Team name</label>
								<div class="col-md-7"><input id = "team" type="text" name = "team" class="form-control timepicker1" required="" ></div>
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
</div>
		<?php
			include('menufooter.php');
		?>
	</body>

</html>