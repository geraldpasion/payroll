<!DOCTYPE html>
<html>
	<head>
		<?php
			 include('menuheader.php');
		?>
		<title>Add Benefits</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/plugins/iCheck/custom.css" rel="stylesheet">
		<style>
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			input{
			border: none;
			border-color: transparent;
				
			}
			
			.zx{
			border: none;
			border-color: transparent;
			margin-top:2.4%;
			font-size:1em;
			cursor:default;
			}
						.zxc{
			border: none;
			border-color: transparent;
			margin-top:1%;
			font-size:1em;
			cursor:default;
			}
		</style>		
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
						toastr.success("Shift successfully added!");
				}
				history.replaceState({}, "Title", "benefits.php");
				
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
						<h5>Add Benefits</h5>
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
							Successfully submitted.
						</div>
						<div id = "warning" class="alert alert-danger alert-dismissable" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Please fill all fields.         

						</div>
<select id = "leavetype" class = "form-control" data-default-value="z" required="">
<?php 
include('dbconfig.php');

if ($result1 = $mysqli->query("SELECT * FROM benefits")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
									
									
										while ($row1 = mysqli_fetch_object($result1))
											
										{ 
									
											echo '<option value="'.$row1->benefits_name."\">".$row1->benefits_name.' - Php ';
											echo $row1->benefits_amount.'</option>';
										}
										
										
									}
								}
							








?>
</SELECT>

						<form id = "myForm" method = "post"  class="form-horizontal">

                            	 
							  <div class="form-group">
                            	<div class="col-md-5"><a href='#' data-target="#myModal4" data-toggle='modal' ><button class='btn btn-info' name = 'edit' type='button'>Add New Benefits</button></a></div>
                            </div>
					
							</div>
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
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
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
											echo "<td><input type='checkbox'  class='i-checks' name='input[]'></td>";

											echo "<td><a href='#' data-toggle='modal'
													
											data-target='#myModal2' class = 'viewempdialog'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
										
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>

						<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-5"><button id = "submit" type="submit" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
								<div class="col-md-4"><button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
							</div>
						</form>
						</div>
				</div>
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
					<h4 class="modal-title">Add Benefits</h4>
				</div>    
        	<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "addbenefits.php" class="form-horizontal">
						
						<div class='form-group'>
								<label class='col-sm-4 control-label'>Benefit Name</label>
								<div class='col-md-4'><input type='text' name='benefitname' class='form-control' ></div>
							</div>
							<div class='form-group'>
								<label class='col-sm-4 control-label'>Amount</label>
								<div class='col-md-4'><input type='text' name='amount' class='form-control' ></div>
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
	 <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
    </script>
   
		<?php
			include('menufooter.php');
		?>
	</body>

</html>