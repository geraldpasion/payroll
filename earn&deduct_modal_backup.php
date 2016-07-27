//earnings modal [earnings.php]
<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Add new Earnings</h4>
				</div>    
        		<div class="modal-body">
					<div class="ibox-content" style="height:400px;">
						<div class="col-md-6">
							<h3 class="modal-title">Existing Earnings:</h3>
							<br>
							<div class="ibox-content" id = "tableHolderz">
								<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
								<?php
									include('dbconfig.php');
									if ($result1 = $mysqli->query("SELECT * FROM earnings_setting  ORDER BY earnings_id")) //get records from db
									{
										if ($result1->num_rows > 0) //display records if any
										{
											echo "<table class='footable table table-stripped' data-page-size='3' data-filter=#filter>";								
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

						<div class="col-md-6 divider">
							<h3 class="modal-title">Input New Earnings:</h3>
							<br>
							<form id="myForm" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label">Name</label>
									<div class="col-md-7"><input type="text" onfocus="clearThis(this)" id="name" name="name" class="form-control ename"required="" placeholder="Enter Name"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Max Amount</label>
									<div class="col-md-7"><input id = "reason" name = "reason" type="text" class="form-control" required="" placeholder = "Type the max amount here..."></div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Type</label>
									<div class="col-md-7"><select id="earningtype" name="earningtype" class="form-control" data-default-value="z" required=""><option selected="true" disabled="disabled" value="">Select type...</option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
								</div>
								<div class="col-md-4"></div>
								<button id ="reset" type="reset" class="btn btn-w-m btn-warning">Reset</button>
								<input type="submit" class="btn btn-w-m btn-primary" value="Submit">
							</form>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div><br>

	

	//deductions modal [deductions.php]
	<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Add new Deductions</h4>
				</div>    
        		<div class="modal-body">
					<div class="ibox-content" style="height:400px;">
						<div class="col-md-6">
							<h3 class="modal-title">Existing Deductions:</h3>
							<br>
							<div class="ibox-content" id = "tableHolderz">
							<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
								<?php
									include('dbconfig.php');
									if ($result1 = $mysqli->query("SELECT * FROM deduction_settings  ORDER BY deduction_id")) //get records from db
									{
										if ($result1->num_rows > 0) //display records if any
										{
											echo "<table class='footable table table-stripped' data-page-size='3' data-filter=#filter>";								
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
												$empid = $row1->deduction_id;
												echo "<tr class = 'josh'>";
								

												echo "<td><a href='#' data-toggle='modal'			
												data-target='#myModal2' class = 'viewempdialog'>" . $row1->deduction_name . "</a></td>";
												echo "<td>" . $row1->deduction_max_amount . "</td>";
												echo "<td>" . $row1->deduction_type . "</td>";
											
											echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' id='$empid' class = 'delete'><button class='btn btn-warning' name = 'edit' type='button'><i class='fa fa-warning'></i> Delete</button></a></td>";
											
												echo "</tr>";

											}
											
											echo "</table>";
										}
									}
								?>
							</div>
						</div>

						<div class="col-md-6 divider">
							<h3 class="modal-title">Input New Deductions:</h3>
							<br>
							<form id="myForm" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label">Name</label>
									<div class="col-md-7"><input type="text" onfocus="clearThis(this)" id="name" class="form-control ename"required="" placeholder="Enter Name"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Max Amount</label>
									<div class="col-md-7"><input id = "reason" name = "reason" type="text" class="form-control" required="" placeholder = "Type the max amount here..."></div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Type</label>
									<div class="col-md-7"><select id="deducttype" class="form-control" data-default-value="z" required=""><option selected="true" disabled="disabled" value="">Select type...</option><option value = "Taxable">Taxable</option><option value = "Non-Taxable">Non-Taxable</option></select></div>
								</div>
								<div class="col-md-4"></div>
									<button id ="reset" type="reset" class="btn btn-w-m btn-warning">Reset</button>
									<input type="submit" class="btn btn-w-m btn-primary" value="Submit">
								</form>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>