<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
function setUpdateAction() {
document.frmUser.action = "leavecreditsmanagementexe.php";
document.frmUser.submit();
}
		</script>
		<?php
			 include('menuheader.php');
		?>
		<title>Leave Credits</title>
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
						toastr.success("Leave credits updated!");
				}
				history.replaceState({}, "Title", "leavecreditsmanagement.php");
				
			});
		</script>
		<script type="text/javascript">
			$(document).on("click", ".viewhistorylogs", function () {
				var id = $(this).data('id');
				var name = $(this).data('name');
				$(".modal-body #empid").val( id );
				$(".modal-body #name").val( name );
				$.ajax({
	                url: "historylogs.php?empid="+$(this).data('id'),
	                method: "POST",
	                success: function(data) {
	                    $('#tablelogs').html(data);
	                }
	            });
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
		<form name="frmUser" method="post" action="">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Leave Credits</h5>
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
								<label class='col-sm-1 control-label' style="margin-top:5px;">Type</label>
								<div class='col-md-4'>
									<select id = 'leavetype' name = 'leavetype' onclick='updateInput()' class = 'form-control' required='' data-default-value='z' >
										<option selected='true' disabled='disabled' value = ''>Select type...</option>
										<option value = 'Paid rest day / Incentive'>Paid rest day / Incentive</option>
										<option value = 'Vacation leave'>Vacation leave</option>
										<option value = 'Sick leave'>Sick leave</option>
										<option value = 'Maternity leave'>Maternity leave</option>
										<option value = 'Paternity leave'>Paternity leave</option>
										<option value = 'Single-parent leave'>Single-parent leave</option>
									</select>
								</div>
							</div><br><br><br>
					<div class="form-group">
						<div class="col-md-3"></div>
						<label class="col-sm-1 control-label" style="margin-top:5px;">Credits</label>
						<div class="col-md-2"><input id = "leavecredit" type="text"  class="form-control" name="leavecredit" required="" onKeyPress="return numbersonly(this, event)"/></div>
						<div class="col-md-2">
							<select class="form-control" id='action' name='action'>
								<option value = '1'>ADD</option>
								<option value = '2'>EDIT</option>
								<option value = '3'>DEDUCT</option>
							</select>
						</div>
								
					</div>
					<BR>
					<BR>
					<BR>
					<div class="ibox-content">
					<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						</div>
						<div class="ibox-content" id = "tableHolderz">
						
 						
							<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' ORDER BY employee_lastname DESC")) //get records from db
								{

									if ($result1->num_rows > 0) //display records if any
									{
										echo "<input type='checkbox' id='select_all'/>&nbsp;&nbsp;<label class='control-label'>Check/Uncheck All</label>";
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";																			
										echo "<thead>";
										echo "<tr>";
										echo "<th></th>";
										echo "<th>Name</th>";
										echo "<th>PRD</th>";
										echo "<th>VL</th>";
										echo "<th>SL</th>";
										echo "<th>ML</th>";
										echo "<th>PL</th>";
										echo "<th>SPL</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tfoot>";                    
										echo "<tr>";
										echo "<td colspan='12'>";
										echo "<ul class='pagination pull-right'></ul>";
										echo "</td>";
										echo "</tr>";
										echo "</tfoot>";
										
									
										while ($row1 = mysqli_fetch_object($result1))
											
										{
											$empid = $row1->employee_id;
											$lname = $row1->employee_lastname;
											$fname = $row1->employee_firstname;
											$mname = $row1->employee_middlename;
											$name = $lname . ", " . $fname . " " . $mname;

											echo "<tr class = 'josh'>"; 

											echo "<td><input type='checkbox' id='chk2' class='checkbox' name='id[]' value='$empid'></td>";

											echo "<td><a href='#' data-toggle='modal' data-id='$empid' data-name='$name' class='viewhistorylogs' data-target='#myModal4'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
											echo "<td>" . $row1->employee_incentive . "</td>";
											echo "<td>" . $row1->employee_vacationleave . "</td>";
											echo "<td>" . $row1->employee_sickleave . "</td>";
											echo "<td>" . $row1->employee_maternityleave . "</td>";
											echo "<td>" . $row1->employee_paternityleave . "</td>";
											echo "<td>" . $row1->employee_singleparentleave . "</td>";
										
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>
							<div class="form-group">
								<div class="col-md-8"></div>
								<button id = "submit" type="submit" name="sx" class="btn btn3 btn-w-m btn-primary" onClick="setUpdateAction();">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" onClick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
							</div>
							</div>
						</form>
						<br><br><br>
						</div></div>
						<br><br><br>
						</div>
						</div>

	<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog modal-small">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-folder-o modal-icon"></i>
					<h4 class="modal-title">Leave History Logs</h4>
				</div>
				<div class="modal-body">
					<div style= "max-height:300px; min-height:300px; overflow-y:scroll;" id="details" class="tab-pane" >
						<div class="panel-body">
							<table class='table table-stripped' data-page-size='20' data-filter=#filter>																		
								<thead>
									<tr>
										<th>Date Modified</th>
										<th>PRD</th>
										<th>VL</th>
										<th>SL</th>
										<th>ML</th>
										<th>PL</th>
										<th>SPL</th>
									</tr>
								</thead>
								<tbody id='tablelogs'>
								</tbody>
							</table>

						</div>
					</div>
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

		<?php
			include('menufooter.php');
		?>
	</body>

</html>