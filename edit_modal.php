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
				<li class="active"><a data-toggle="tab" href="#newedit">Earning and Deductions</a></li>
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
							<label class="col-sm-3 control-label">New/Edit</label>
								<div class="col-sm-4"><select class = "form-control" id = "actionsel" name = "actionsel" onchange="filter_action(this.value)" required="" ><option value = "New">New</option><option value = "Edit">Edit</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Earnings/Deductions</label>
								<div class="col-sm-4"><select class = "form-control" id = "earndeduct" name = "earndeduct" onchange="filter_ed(this.value)" required="" ><option value = ""></option><option value = "Earnings">Earnings</option><option value = "Deductions">Deductions</option></select></div>
								<br><br><br>
							<label class="col-sm-3 control-label">Type</label>
								<div class="col-sm-4"><select class = "form-control" id = "type" name = "type" onchange="filter_type(this.value)" required="" ><option value = ""></option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
								<br><br><br>
							<!-- <label class="col-sm-3 control-label">Recurrence</label>
								<div class="col-sm-4"><select class = "form-control" id = "recurrence" name = "recurrence" required="" ><option value = ""></option><option value = "Once">Once</option><option value = "Multiple">Multiple</option></select></div>
								<br><br><br> -->
							<label class="col-sm-3 control-label">Particular</label>
								<div class="col-md-4" id="partinp"><input id = "particularsel" name = "particularsel" onkeyup="" type="text" class="form-control" required></div>
								<!-- <div class="col-md-4" id="partsel" style="display:none;"><select id = "particularsel" name = "particularsel" onchange="" type="text" class="form-control" required></select></div> -->
								<br><br><br>								
							<label class="col-sm-3 control-label">Amount</label>
								<div class="col-md-4"><input id = "amount" name = "amount" type="text" class="form-control" onkeyup="filter_amount(this.value)" placeholder="Enter Amount" onKeyPress="return numbersonly(this, event)" required></div>
								<br><br><br>
							<label class="col-sm-3 control-label">From</label>
								<div class="col-md-4" id="frmnew"><input type="date" id = "fromdate" class="form-control" name="daterange" value="<?php echo $initialcut; ?>" readonly></div>
								<!-- <div class="col-md-4" id="frmedit" style="display:none;"><input type="text" id = "fromdate" onpaste="return false" onDrop="return false" class="form-control" name="daterange2" required=""></div> -->
							<br><br><br>
								<label class="col-sm-3 control-label">To</label>
								<div class="col-md-4" id="tonew"><input type="date" id = "todate" onpaste="return false" onDrop="return false" class="form-control" name="daterange3" placeholder="click to pick date (optional)"></div>
								<!-- <div class="col-md-4" id="toedit" style="display:none;"><input type="text" id = "todate" onpaste="return false" onDrop="return false" class="form-control" name="daterange3"></div> -->
						</div>
						</form>
					</div>
				</div>
				
				<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="earn" class="tab-pane" >
					<div class="panel-body">
							<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
								<thead>
									<tr>
										<th>From</th>
										<th>To</th>
										<th>Type</th>
										<th>Particular</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$total_comp_salary = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id='$empid' AND cutoff='".$cutoff."'")->fetch_object();
										$comp_id = $total_comp_salary->comp_id;//->comp_id;
										$emp_earnings = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id='$empid'");
										if($emp_earnings->num_rows > 0){
											while($earn = $emp_earnings->fetch_object()){
												echo '<tr>';
												echo '<td>'.$earn->initial_date.'</td>';
												if($earn->end_date == "0000-00-00") echo '<td> - </td>';
												else echo '<td>'.$earn->end_date.'</td>';
												echo '<td>'.$earn->earn_type.'</td>';
												echo '<td>'.$earn->earn_name.'</td>';
												echo '<td>'.$earn->earn_max.'</td>';
												echo '</tr>';
											}
										}
									?>
								</tbody>
							</table>
					</div>
				</div>
				<div style= "max-height:500px; min-height:100px; overflow-y:scroll;" id="deduct" class="tab-pane" >
					<div class="panel-body">
							<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>						
								<thead>
									<tr>
										<th>From</th>
										<th>To</th>
										<th>Type</th>
										<th>Particular</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$total_comp_salary = $mysqli->query("SELECT * FROM total_comp_salary WHERE employee_id='$empid' AND cutoff='".$cutoff."'")->fetch_object();
										$comp_id = $total_comp_salary->comp_id;//->comp_id;
										$emp_deductions = $mysqli->query("SELECT * FROM emp_deductions WHERE employee_id='$empid'");
										if($emp_deductions->num_rows > 0){
											while($deduct = $emp_deductions->fetch_object()){
												echo '<tr>';
												echo '<td>'.$deduct->initial_date.'</td>';
												if($deduct->end_date == "0000-00-00") echo '<td> - </td>';
												else echo '<td>'.$deduct->end_date.'</td>';
												echo '<td>'.$deduct->deduct_type.'</td>';
												echo '<td>'.$deduct->deduct_name.'</td>';
												echo '<td>'.$deduct->deduct_max.'</td>';								
												echo '</tr>';
											}
										}
									?>
								</tbody>
							</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" id="editsub" name="editsub" class="btn btn-primary" form="editform">Submit</button>
					
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
			$(function() {
				$('input[name="daterange3"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>


<script>
	function filter_action(elem){
		if(elem == 'Edit'){
			var empid = <?php echo $empid; ?>;
			$("#partinp").replaceWith("<div class='col-md-4' id='partinp'><select id = 'particularsel' name = 'particularsel' type='text' class='form-control' onchange='filter_part(this.val)' required></select></div>");
			$("#particularsel").load("filter.php?choice=" + elem + "&empid=" + empid);
			$("#frmnew").replaceWith("<div class='col-md-4' id='frmedit'><input type='date' id = 'fromdate' onpaste='return false' onDrop='return false' class='form-control' name='daterange1' required readonly></div>");
			$("#tonew").replaceWith("<div class='col-md-4' id='toedit'><input type='date' id = 'todate' onpaste='return false' onDrop='return false' class='form-control' name='daterange3'></div>");
		}
		if(elem == 'New'){
			$("#partinp").replaceWith("<div class='col-md-4' id='partinp'><input id = 'particularsel' name = 'particularsel' onkeyup='' type='text' class='form-control' required></div>");
			$("#frmedit").replaceWith("<div class='col-md-4' id='frmnew'><input type='date' id = 'fromdate' class='form-control' name='daterange' value='<?php echo $initialcut; ?>' readonly></div>");
			$("#toedit").replaceWith("<div class='col-md-4' id='tonew'><input type='date' id = 'todate' onpaste='return false' onDrop='return false' class='form-control' name='daterange3' placeholder='click to pick date (optional)'></div>");
		}
	}
	function filter_ed(elem2){
		var elem = $("#actionsel").val();
		var empid = <?php echo $empid; ?>;
		if(elem == 'Edit'){
			$("#particularsel").load("filter.php?choice=" + elem2 + "&empid=" + empid);

		}
	}
	function filter_type(elem3){
		var elem = $("#actionsel").val();
		var elem2 = $("#earndeduct").val();
		var empid = <?php echo $empid; ?>;
		if(elem == 'Edit' || (elem == 'Edit' && elem2 == 'Earnings') || (elem == 'Edit' && elem2 == 'Deductions')){
			$("#particularsel").load("filter.php?choice=" + elem3 + "&empid=" + empid + "&elem2=" + elem2);
		}
	}
	function filter_part(elem4){
		var elem = $("#actionsel").val();
		var elem2 = $("#earndeduct").val();
		var elem3 = $("#type").val();
		var elem4 = $("#particularsel").val();
		var empid = <?php echo $empid; ?>;
		
		var info = "elem4=" + elem4 + "&empid=" + empid + "&elem2=" + elem2 + "&elem3=" + elem3 + "&particularsel";
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
		
	

		