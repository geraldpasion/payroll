<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function setUpdateAction() {
				document.frmUser.action = "shedtestexe.php";
				document.frmUser.submit();
			}
		</script>
		<?php
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		$empLevel = $_SESSION['employee_level'];
		if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');

		}else if(isset($_SESSION['logsession']) && $empLevel == '4') {
			include('levelexe.php');
		}
		else if(!isset($empLevel)){
			include 'logout.php';
		}
		?>
		<title>Employee List</title>
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
						toastr.success("Shift successfully added!");
				}

				showError=function(){
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
						toastr.success("Start date should be greater than date today!");
				}

				shiftEdit=function(){
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
						toastr.success("Shift successfully Edited!");
				}
				history.replaceState({}, "Title", "schedtest.php");
				
			});
		</script>
		<script>
		function change(obj) {
			var index = obj.selectedIndex;
			var val = obj.options[index].value;
			
			document.getElementById('date').disabled=true;

			if(val == "without") {
				document.getElementById('date').disabled=true;
				document.getElementById('date').value="";
			} else if(val == "with") {
				document.getElementById('date').disabled=false;
			}
		}
		</script>

		<!--sweet alert before proceeding-->
		<script>
		 $(document).on("click", ".clickdialog", function () {
		 	//alert('hasdhashdhasdh');
			 var empid = $(this).data('empid');
			 $(".modal-body #empid").val( empid );
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

		if(isset($_GET['changeShift']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'shiftEdit();'
					, '});' 
			   
			   , '</script>'
			;	
		}

		if(isset($_GET['error']))
		{
			echo '<script type="text/javascript">'
					, '$(document).ready(function(){'	
					, 'showError();'
					, '});' 
			   
			   , '</script>'
			;	
		}
		?>
	</head>
	<body>
		<form name="frmUser" id="frmUser" method="post" action="schedtestexe.php">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Employee List</h5>
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
                        <div class = "col-md-5"></div><a href='#' data-target="#myModal4" data-toggle='modal' ><button class='btn btn-info' name = 'edit' type='button'>New Shifting</button></a>
							
							</div>
							
							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="margin-top:5px;">Schedule List</label>
								<div class="col-md-4"><select id = "leavetype" class="form-control"  data-default-value="z" name="sched" required="">
								<?php 
								include('dbconfig.php');

								if ($result1 = $mysqli->query("SELECT * FROM shift")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										while ($row1 = mysqli_fetch_object($result1))
										{ 
											echo '<option value="'.$row1->shift_start."-".$row1->shift_end."\">".date("g : i : A",strtotime($row1->shift_start)).' - ';
											echo date("g : i : A",strtotime($row1->shift_end)).'</option>';
										}
									}
								}

								?>
								</SELECT>
								</div>
							</div><br><br><br>

					<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="margin-top:5px;">Date Range</label>
								<div class="col-md-4"><select id = 'hasdate' name = 'hasdate' onchange="change(this);" class = 'form-control' data-default-value='without' required=''>
									<option value = 'without' selected="selected">Without Date Range (tomorrow onwards)</option>
									<option value = 'with'>With Specified Date Range</option>
								</select></div>
							</div><br><br>

							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="margin-top:5px;">Date</label>
								<div class="col-md-4"><input id = "date" type="text" disabled class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
							</div>
					<br><br>
					<!---->
					<div class="ibox-content">
					<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
						</div>
						<div class="ibox-content" id = "tableHolderz">

							<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' AND employee_type = 'Fixed' ORDER BY employee_id")) //get records from db
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
										echo "<th>Shift Type</th>";
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
											echo "<td align='center'><input type='checkbox' id='empid' class='checkbox' name='id[]' value='$empid'></td>";
											echo "<td style='padding-left:100px;text-align:left'>
											<a href='#' data-toggle='modal' data-empid='$empid'  class='clickdialog' data-target='#myModal2'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
											echo "<td style='text-align:left'>" . $row1->employee_department. "</td>";
											echo "<td style='text-align:left'>". $row1->employee_type . "</td>";

											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>
							<div class="form-group">
								<div class="col-md-4"></div>
								<button id = "button" onclick='swalC()' type="button" name="sx" class="btn btn3 btn-w-m btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
							</div>
							
						</form>
						</div></div>
						<br>
						</div>
						<br><br>

				<script>
					function swalC(){
						if($('#hasdate').val()=="without"){
							var str="This will overwrite the succeeding dates starting tomorrow.";
						}else{
							var str=" ";
						}

						swal({
							html:true,
							title:'Are you sure?',
							text: str,
							type:'warning',
							closeOnConfirm:true,
							confirmButtonText:'Yes',
							cancelButtonText:'No',
							showCancelButton:true
						},
						function(isConfirm){
							if(isConfirm){
								$('#frmUser').submit();
							}
						});
					}
				</script>
			

<div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="employeelist_modal">
				<div class="modal-header">
				<?php
					//$q = mysqli_query("SELECT * FROM employee WHERE employee_id = '$empid");
					// $result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$empid'")->fetch_array();
					// $res = $mysqli->query("SELECT * FROM employee");
				?>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-user modal-icon"></i>
					<h4 class="modal-title">Employee Information</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
							<div class="tabs-container">
							<ul id="mytab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#shiftlog">Shift Schedule</a></li>
								<li class=""><a data-toggle="tab" href="#daily">Daily Schedule</a></li>
								<li class=""><a data-toggle="tab" href="#restdaylog">Rest Day</a></li>
							</ul>
							<div class="tab-content">
						<div style= "max-height:100px; min-height:300px; overflow-y:scroll;" id="shiftlog" class="tab-pane fade active in" >
								<div class="panel-body">
							<table id="shift_log" class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
										<thead>
											<tr>
												<th>Date</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>Schedule</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											//call employeelist_modal.php here



												/*$leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id=$empid");
													if($leavedetails->num_rows > 0){
														while($leave = $leavedetails->fetch_object()){
															echo '<tr>';
															echo '<td>'.$leave->leave_type.'</td>';
															echo '<td>'.$leave->leave_start.'</td>';
															//echo '<td>'.$leave->.'</td>';
															echo '<td>'.$leave->leave_approvedby.'</td>';
															echo '<td>'.$leave->leave_approvaldate.'</td>';
															echo '</tr>';
														}
													}
												*/
											?>
										</tbody>
									</table>
								</div>
							</div>
						</ul>

					<div style= "max-height:100px; min-height:300px; overflow-y:scroll;" id="daily" class="tab-pane" >
								<div class="panel-body">
									
							<table id="daily_log" class='footable table table-stripped' data-page-size='20' data-filter=#filter>
							<div class="form-group">

								<label class="col-md-1 control-label" id ="lt3">Year:</label>
								<div class="col-md-3">
									<select id = "dyear" data-default-value="z" name="dyear" onchange="filterdailylogs()" >
										<option value = "" selected="true" disabled>Year</option>
										<option value = "2016">2016</option>
										<option value = "2015">2015</option>
										<option value = "2014">2014</option>
										<option value = "2013">2013</option>
										<option value = "2012">2012</option>
										<option value = "2011">2011</option>
										<option value = "2010">2010</option>
										<option value = "2009">2009</option>
										<option value = "2008">2008</option>
										<option value = "2007">2007</option>
										<option value = "2006">2006</option>
										<option value = "2005">2005</option>
										<option value = "2004">2004</option>
										<option value = "2003">2003</option>
										<option value = "2002">2002</option>
										<option value = "2001">2001</option>
										<option value = "2000">2000</option>

										
									</SELECT>
								</div>		
								<label class="col-md-1 control-label" id ="lt3">Month:</label>
								<div class="col-md-3">
									<select id = "dmonth" data-default-value="z" name="dmonth" onchange="filterdailylogs_month()">
										<option value = "" selected="true" disabled>Month</option>
										<option value = "January">January</option>
										<option value = "February">February</option>
										<option value = "March">March</option>
										<option value = "April">April</option>
										<option value = "May">May</option>
										<option value = "June">June</option>
										<option value = "July">July</option>
										<option value = "August">August</option>
										<option value = "September">September</option>
										<option value = "October">October</option>
										<option value = "November">November</option>
										<option value = "December">December</option>
									</SELECT>
								</div>
								<!--label class="col-md-1 control-label" id ="lt3">Day:</label>
								<div class="col-md-3">
									<select id = "dday" data-default-value="z" name="dday" onchange="filterdailylogs_day()">
										<option value = "" selected="true" disabled>Day</option>
										<option selected="true"  value = "1">1</option>
										<option value = "2">2</option>
										<option value = "3">3</option>
										<option value = "4">4</option>
										<option value = "5">5</option>
										<option value = "6">6</option>
										<option value = "7">7</option>
										<option value = "8">8</option>
										<option value = "9">9</option>
										<option value = "10">10</option>
										<option value = "11">11</option>
										<option value = "12">12</option>
										<option value = "13">13</option>
										<option value = "14">14</option>
										<option value = "15">15</option>
										<option value = "16">16</option>
										<option value = "17">17</option>
										<option value = "18">18</option>
										<option value = "19">19</option>
										<option value = "20">20</option>
										<option value = "21">21</option>
										<option value = "22">22</option>
										<option value = "23">23</option>
										<option value = "24">24</option>
										<option value = "25">25</option>
										<option value = "26">26</option>
										<option value = "27">27</option>
										<option value = "28">28</option>
										<option value = "29">29</option>
										<option value = "30">30</option>
										<option value = "31">31</option>
									</SELECT>
								
								</div>
							</div-->
							<br><br>						
										<thead>
											<tr>
												<th>Date</th>
												<th>Day</th>
												<th>Schedule</th>
											</tr>
										</thead>
										<tbody>
											<?php
											//call employeelist_modal.php here



												/*$leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id=$empid");
													if($leavedetails->num_rows > 0){
														while($leave = $leavedetails->fetch_object()){
															echo '<tr>';
															echo '<td>'.$leave->leave_type.'</td>';
															echo '<td>'.$leave->leave_start.'</td>';
															//echo '<td>'.$leave->.'</td>';
															echo '<td>'.$leave->leave_approvedby.'</td>';
															echo '<td>'.$leave->leave_approvaldate.'</td>';
															echo '</tr>';
														}
													}
												*/
											?>
										</tbody>
									</table>
								</div>
							</div>
						</ul>

					<div style= "max-height:100px; min-height:300px; overflow-y:scroll;" id="restdaylog" class="tab-pane" >
								<div class="panel-body">
							<table id="restday_log" class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
										<thead>
											<tr>
												<th>Date</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>Rest Day Schedule</th>
												<th>Created By</th>
											</tr>
										</thead>
										<tbody>
											<?php
											//call employeelist_modal.php here



												/*$leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id=$empid");
													if($leavedetails->num_rows > 0){
														while($leave = $leavedetails->fetch_object()){
															echo '<tr>';
															echo '<td>'.$leave->leave_type.'</td>';
															echo '<td>'.$leave->leave_start.'</td>';
															//echo '<td>'.$leave->.'</td>';
															echo '<td>'.$leave->leave_approvedby.'</td>';
															echo '<td>'.$leave->leave_approvaldate.'</td>';
															echo '</tr>';
														}
													}
												*/
											?>
										</tbody>
									</table>
								</div>
							</div>
						</ul>
					
							</div>
						</div>
						
					</div>
					
				</form>
				
				
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
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
					<h4 class="modal-title">Add New Shift</h4>
				</div>    
        		<div class="modal-body">
					<div class="ibox-content">
						<form id = "uploadForm" method="POST" action = "addshift.php" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label">Shift start</label>
								<div class="col-md-7"><input id = "lastname" type="text" name = "start" class="form-control timepicker1" required="" ></div>
							</div>
							<div class="form-group">	
								<label class="col-sm-4 control-label">Shift end</label>
								<div class="col-md-7"><input type="text" id = "firstname" class="form-control timepicker1" name = "end" required="" ></div>
							</div>	
					</div>
				</div>

				<div class="modal-footer">
					
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php
// if(isset($_POST['edit'])){
// echo "<div class='modal-body'>";
// echo "<input id = 'empid' name = 'empid' type='text' class='form-control'>";
// echo "</div>";
 // $empid = $_GET['empid'];

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
    <!--script type="text/javascript">

			function getFormatDate(d){
			    return d.getMonth()+1 + '/' + d.getDate() + '/' + d.getFullYear()
			}

			$(document).ready(function() {
			    var mTemp = new Date(), minDate = getFormatDate(new Date(mTemp.setDate(mTemp.getDate())));

			    $('#date').daterangepicker(
			    {
			    	startDate: minDate,
			    	minDate: minDate,
			    	maxDate: 0
			    }
			    );
			});
		</script-->
	<script type="text/javascript">

			function getFormatDate(d){
			    return d.getMonth()+1 + '/' + d.getDate() + '/' + d.getFullYear()
			}

			$(document).ready(function() {
			    var mTemp = new Date(), minDate = getFormatDate(new Date(mTemp.setDate(mTemp.getDate()))), maxDate = 0;

			    $('#date').daterangepicker(
			    {
			    	startDate: 0,
			    	minDate: 0,
			    	maxDate: maxDate
			    }
			    );
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


    <script type="text/javascript">

		$('.myModal2').on('shown.bs.modal', function () {
			
			var menuId = $('#empid').val();
			alert(menuId);
	   		/*var menuId = $('#empid').val();
			var request = $.ajax({
			  url: "shift_log_table.php",
			  method: "GET",
			  data: { empid : menuId },
			  dataType: "html"
			});
			 
			request.done(function(msg) {
				//alert(msg);
			  $("#shift_log").html(msg);
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});*/
		});

	</script>

	<script type="text/javascript">	
		$('#myModal2').on('shown.bs.modal', function () {
	   		var menuId = $('#empid').val();
	   		var year=$('#dyear').val();
	   		var month=$('#dmonth').val();
	   		var day=$('#dday').val();
			var request = $.ajax({
			  url: "daily_log_table.php",
			  method: "GET",
			  data: { empid : menuId , year : year , month : month , day : day },
			  dataType: "html"
			});
			 
			request.done(function(msg) {
				//alert(msg);
			  $("#daily_log").html(msg);
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		});
	</script>

	<script type="text/javascript">
		$('#myModal2').on('shown.bs.modal', function () {
	   		var menuId = $('#empid').val();
	   		alert(menuId);
			var request = $.ajax({
			  url: "restday_log_table.php",
			  method: "GET",
			  data: { empid : menuId },
			  dataType: "html"
			});
			 
			request.done(function(msg) {
				//alert(msg);
			  $("#restday_log").html(msg);
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		});

	</script>
    <link href="css/timepicki.css" rel="stylesheet">

		<?php
			include('menufooter.php');
		?>
	</body>
	<script type="text/javascript">
		$('#myModal2').on('shown.bs.modal', function () {
	   		var menuId = $('#empid').val();
			var request = $.ajax({
			  url: "shift_log_table.php",
			  method: "GET",
			  data: { empid : menuId },
			  dataType: "html"
			});
			 
			request.done(function(msg) {
				//alert(msg);
			  $("#shift_log").html(msg);
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		});

	</script>



	<script type="text/javascript">	
		$('#myModal2').on('shown.bs.modal', function () {
	   		var menuId = $('#empid').val();
	   		var year=$('#dyear').val();
	   		var month=$('#dmonth').val();
	   		var day=$('#dday').val();
			var request = $.ajax({
			  url: "daily_log_table.php",
			  method: "GET",
			  data: { empid : menuId , year : year , month : month , day : day },
			  dataType: "html"
			});
			 
			request.done(function(msg) {
				//alert(msg);
			  $("#daily_log").html(msg);
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		});
	</script>

	<script type="text/javascript">
		$('#myModal2').on('shown.bs.modal', function () {
	   		var menuId = $('#empid').val();
			var request = $.ajax({
			  url: "restday_log_table.php",
			  method: "GET",
			  data: { empid : menuId },
			  dataType: "html"
			});
			 
			request.done(function(msg) {
				//alert(msg);
			  $("#restday_log").html(msg);
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		});

	</script>
</html>