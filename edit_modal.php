<?php
include("dbconfig.php");

$empid = $_REQUEST['empid'];
$cutoff = $_REQUEST['cutoff'];
$submit = $_REQUEST['submit'];

$cutarray = array();
$cutarray = split(" - ", $cutoff);
$initialcut = $cutarray[0];
$endcut = $cutarray[1];
?>

<script type="text/javascript">//ajax
	$(function() {
		$(".deletededuct").click(function(){
			var element = $(this);
			var deduction_id = element.attr("id");
			var info = 'deduction_id1=' + deduction_id + '&type=process';
			 $.ajax({
			   type: "POST",
			   url: "deletedeductions.php",
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
			toastr.success('Successfully Deleted!');
			 
			return false;
		});
	});
</script>

<script type="text/javascript">//ajax
	$(function() {
		$(".deleteearn").click(function(){
			var element = $(this);
			var earnings_id = element.attr("id");
			var info = 'earnings_id1=' + earnings_id  + '&type=process';
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
			toastr.success('Successfully Deleted!');
			 
			return false;
		});
	});
</script>

<div class="modal-header">				
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<i class="fa fa-edit modal-icon"></i>
	<h4 class="modal-title">Edit information</h4>
</div>
<div class="modal-body">
	<div class="ibox-content">
		
		<div class="tabs-container">
			<ul id="mytab" class="nav nav-tabs">
				<!-- <li class="active"><a data-toggle="tab" href="#editinfo">Information</a></li> -->
				<li class="active"><a data-toggle="tab" href="#newedit">Earnings and Deductions</a></li>
				<li class=""><a data-toggle="tab" href="#earn">Earnings Summary</a></li>
				<li class=""><a data-toggle="tab" href="#deduct">Deductions Summary</a></li>
			</ul>
			<div class="tab-content">
				<div id="newedit" class="tab-pane fade active in" >
					<div class="panel-body">
						<form method="POST" action = "editprocessing.php"  class="form-horizontal" id="editform">
						<input type="hidden" value="<?php echo $empid; ?>" name="empid" id="empid"/>
						<input type="hidden" value="<?php echo $cutoff;?>" name="cutsel" id="cutsel">
						<div class="form-group">
							<div class="col-sm-3"></div>
							<label class="col-sm-3 control-label">New/Edit</label>
								<div class="col-sm-4"><select class = "form-control" id = "actionsel" name = "actionsel" onchange="filter_action(this.value)" required="" ><option value = "New">New</option><option value = "Edit">Edit</option></select></div>
								<br><br><br>
							<div class="col-sm-3"></div>
							<label class="col-sm-3 control-label">Earnings/Deductions</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" onchange="filter_ed(this.value)" required="" ><option value = ""></option><option value = "Earnings">Earnings</option><option value = "Deductions">Deductions</option></select></div>
								<br><br><br>
							<div class="col-sm-3"></div>
							<label class="col-sm-3 control-label">Type</label>
								<div class="col-sm-4"><select class = "form-control" id = "type" name = "type" onchange="filter_type(this.value)" required="" ><option value = ""></option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
								<br><br><br>
							<!-- <label class="col-sm-3 control-label">Recurrence</label>
								<div class="col-sm-4"><select class = "form-control" id = "recurrence" name = "recurrence" required="" ><option value = ""></option><option value = "Once">Once</option><option value = "Multiple">Multiple</option></select></div>
								<br><br><br> -->
							<div class="col-sm-3"></div>
							<label class="col-sm-3 control-label">Particular</label>
								<div class="col-md-4" id="partinp"><select id = 'particularsel' name = 'particularsel' type='text' class='form-control' required>
									<option value=''></option>
									<?php
									if($stmt = $mysqli->query("SELECT * FROM earnings_setting")){
										if($stmt->num_rows > 0){
											while($row = $stmt->fetch_object()){
												echo "<option>" . $row->earnings_name . "</option>";
											}
										}
									}
									if($stmt = $mysqli->query("SELECT * FROM deduction_settings")){
										if($stmt->num_rows > 0){
											while($row = $stmt->fetch_object()){
												echo "<option>" . $row->deduction_name . "</option>";
											}
										}
									}
									?>
								</select></div>
								<!-- <div class="col-md-4" id="partsel" style="display:none;"><select id = "particularsel" name = "particularsel" onchange="" type="text" class="form-control" required></select></div> -->
								<br><br><br>								
							<div class="col-sm-3"></div>
							<label class="col-sm-3 control-label">Amount</label>
								<div class="col-md-4"><input id = "amount" name = "amount" type="text" class="form-control" onkeyup="filter_amount(this.value)" placeholder="Enter Amount" onKeyPress="return numbersonly(this, event)" required></div>
								<br><br><br>
							<div class="col-sm-3"></div>
							<label class="col-sm-3 control-label">From</label>
								<div class="col-md-4" id="frmnew"><input type="date" id = "fromdate" class="form-control" name="daterange" value="<?php echo $initialcut; ?>" readonly></div>
								<!-- <div class="col-md-4" id="frmedit" style="display:none;"><input type="text" id = "fromdate" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required=""></div> -->
							<br><br><br>
								<div class="col-sm-3"></div>
								<label class="col-sm-3 control-label">To</label>
								<div class="col-md-4" id="tonew"><input type="date" id = "todate" onpaste="return false" onDrop="return false" class="form-control" name="daterange3" placeholder="click to pick date (optional)">
								<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
								<script src="js/dcalendar.picker.js"></script>
								<script>
									$('#demo').dcalendarpicker();
									$('#calendar-demo').dcalendar(); //creates the calendar
								</script>
								</div>
								<!-- <div class="col-sm-1" style="font-size:18px;"><a class="right" data-placement="right" data-toggle="tooltip" href="#" title="If no end date is specified, the earning/deduction will be effective on all cutoffs after the start date."><span class="glyphicon glyphicon-info-sign" ></span></a></div> -->
								<!-- <div class="col-md-4" id="toedit" style="display:none;"><input type="text" id = "todate" onpaste="return false" onDrop="return false" class="form-control" name="daterange3"></div> -->
						</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						<button type="submit" id="editsub" name="editsub" class="btn btn-primary" form="editform">Submit</button>					
					</div>
				</div>
				
				<div style= "max-height:500px; min-height:300px; overflow-y:scroll;" id="earn" class="tab-pane" >
					<div class="panel-body">
							<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
								<thead>
									<tr>
										<th>From</th>
										<th>To</th>
										<th>Type</th>
										<th>Particular</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$total_comp_salary = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id='$empid' AND cutoff='".$cutoff."'")->fetch_object();
										$comp_id = $total_comp_salary->comp_id;//->comp_id;
										$emp_earnings = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id='$empid' ORDER BY earn_id");
										if($emp_earnings->num_rows > 0){
											while($earn = mysqli_fetch_object($emp_earnings)){
												$earnid = $earn->earn_id;
												echo '<tr>';
												echo '<td>'.$earn->initial_date.'</td>';
												if($earn->end_date == "0000-00-00") echo '<td> - </td>';
												else echo '<td>'.$earn->end_date.'</td>';
												echo '<td>'.$earn->earn_type.'</td>';
												echo '<td>'.$earn->earn_name.'</td>';
												echo '<td>'.$earn->earn_max.'</td>';
												echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' id='$earnid' class = 'deleteearn'><button class='btn btn-warning' name = 'edit' type='button' disabled><i class='fa fa-warning'></i> Delete</button></a></td>";
												echo '</tr>';
											}
										}
									?>
								</tbody>
							</table>
					</div>
				</div>
				<div style= "max-height:500px; min-height:300px; overflow-y:scroll;" id="deduct" class="tab-pane" >
					<div class="panel-body">
							<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
								<thead>
									<tr>
										<th>From</th>
										<th>To</th>
										<th>Type</th>
										<th>Particular</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$total_comp_salary = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id='$empid' AND cutoff='".$cutoff."'")->fetch_object();
										$comp_id = $total_comp_salary->comp_id;//->comp_id;
										$emp_deductions = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id='$empid' ORDER BY deduct_id");
										if($emp_deductions->num_rows > 0){
											while($deduct = mysqli_fetch_object($emp_deductions)){
												$deductid = $deduct->deduct_id;
												echo '<tr>';
												echo '<td>'.$deduct->initial_date.'</td>';
												if($deduct->end_date == "0000-00-00") echo '<td> - </td>';
												else echo '<td>'.$deduct->end_date.'</td>';
												echo '<td>'.$deduct->deduct_type.'</td>';
												echo '<td>'.$deduct->deduct_name.'</td>';
												echo '<td>'.$deduct->deduct_max.'</td>';
												echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' id='$deductid' class = 'deletededuct'><button class='btn btn-warning' name = 'edit' type='button' disabled><i class='fa fa-warning'></i> Delete</button></a></td>";							
												echo '</tr>';
											}
										}
									?>
								</tbody>
							</table>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

		<script type="text/javascript">

			$(function() {
				$('input[name="daterange2"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
		<script type="text/javascript">
			function getFormatDate(d){
			    return d.getMonth()+1 + '/' + d.getDate() + '/' + d.getFullYear()
			}

			$(document).ready(function() {
			    var mTemp = new Date(), minDate = getFormatDate(new Date(mTemp.setDate(mTemp.getDate() + 1)));
				$('input[name="daterange3"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true,
					startDate: minDate,
			    	minDate: minDate,
			    	maxDate: 0
				});
			});
		</script>
<script type="text/javascript">
    $(function() {
        $('#particularsel').keyup(function() {
            if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
            }
        });
    });
</script>

<script>
	function filter_action(elem){
		if(elem == 'Edit'){
			var empid = <?php echo $empid; ?>;
			$("#partinp").replaceWith("<div class='col-md-4' id='partinp'><select id = 'particularsel' name = 'particularsel' type='text' class='form-control' onchange='filter_part(this.val)' required></select></div>");
			$("#particularsel").load("filter.php?choice=" + elem + "&empid=" + empid);
			$("#type").val("");
			$("#amount").val("");
			$("#earndeduct").val("");
			$("#frmnew").replaceWith("<div class='col-md-4' id='frmedit'><input type='date' id = 'fromdate' onpaste='return false' onDrop='return false' class='form-control' name='daterange1' required readonly></div>");
			$("#tonew").replaceWith("<div class='col-md-4' id='toedit'><input type='date' id = 'todate' onpaste='return false' onDrop='return false' class='form-control' name='daterange3'></div>");
			$("#toedit").val("");
		}
		if(elem == 'New'){
			$("#type").val("");
			$("#amount").val("");
			$("#earndeduct").val("");
			$("#partinp").replaceWith("<div class='col-md-4' id='partinp'><select id = 'particularsel' name = 'particularsel' type='text' class='form-control' required></select></div>");
			$("#particularsel").load("filter.php?choice=" + elem);
			$("#frmedit").replaceWith("<div class='col-md-4' id='frmnew'><input type='date' id = 'fromdate' class='form-control' name='daterange' value='<?php echo $initialcut; ?>' readonly></div>");
			$("#toedit").replaceWith("<div class='col-md-4' id='tonew'><input type='date' id = 'todate' onpaste='return false' onDrop='return false' class='form-control' name='daterange3' placeholder='click to pick date (optional)'></div>");
			$("#tonew").val("");
		}
	}
	function filter_ed(elem2){
		var elem = $("#actionsel").val();
		var empid = <?php echo $empid; ?>;
			$("#particularsel").load("filter.php?choice=" + elem2 + "&empid=" + empid + "&elem=" + elem);
	}
	function filter_type(elem3){
		var elem = $("#actionsel").val();
		var elem2 = $("#earndeduct").val();
		var empid = <?php echo $empid; ?>;
		$("#particularsel").load("filter.php?choice=" + elem3 + "&empid=" + empid + "&elem2=" + elem2 + "&elem=" + elem);
		
	}
	function filter_part(elem4){
		var elem = $("#actionsel").val();
		var elem2 = $("#earndeduct").val();
		var elem3 = $("#type").val();
		var elem4 = $("#particularsel").val();
		var empid = <?php echo $empid; ?>;
		
		var info = "elem4=" + elem4 + "&empid=" + empid + "&elem2=" + elem2 + "&elem3=" + elem3 + "&elem=" + elem + "&particularsel";
             $.ajax({

                    url: "filter2.php",
                    type: "POST",
                    data:info,
                    success: function(data) {
                        eval(data);
                    }
                });
	}

</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

		
	

		