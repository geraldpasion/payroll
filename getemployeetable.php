<?php
							include('dbconfig.php');
								if ($result1 = $mysqli->query("SELECT * FROM employee WHERE employee_status = 'active' ORDER BY employee_id")) //get records from db
								{
									if ($result1->num_rows > 0) //display records if any
									{
										echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th>ID</th>";
										echo "<th>Name</th>";
										echo "<th>Department</th>";
										echo "<th>Action</th>";
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
											echo "<td>" . $row1->employee_id . "</td>";
											echo "<td><a href='#' data-toggle='modal'
														data-employee-id='$empid' 

											data-target='#myModal2' class = 'viewempdialog'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</a></td>";
											echo "<td>" . $row1->employee_department . "</td>";
											echo "<td><a href='#' data-toggle='modal' 
													data-employee-id='$empid' 
													data-lastname='$row1->employee_lastname' 
													data-firstname='$row1->employee_firstname' 
													data-middlename='$row1->employee_middlename' 
													data-gender='$row1->employee_gender' 
													data-birthday='$row1->employee_birthday' 
													data-marital='$row1->employee_marital' 
													data-address='$row1->employee_address' 
													data-city='$row1->employee_city' 
													data-zip='$row1->employee_zip' 
													data-email='$row1->employee_email' 
													data-cellnum='$row1->employee_cellnum' 
													data-type='$row1->employee_type' 
													data-department='$row1->employee_department' 
													data-rate='$row1->employee_rate' 
													data-taxcode='$row1->employee_taxcode'  
													data-sss='$row1->employee_sss' 
													data-philhealth='$row1->employee_philhealth' 
													data-pagibig='$row1->employee_pagibig' 
													data-tin='$row1->employee_tin' 
													data-shift='$row1->employee_shift' 
													data-datehired='$row1->employee_datehired' 
													data-restday='$row1->employee_restday' 
													data-jobtitle='$row1->employee_jobtitle' 
													data-password='$row1->employee_password' 
													
													
													data-target='#myModal4' class = 'editempdialog'><button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a>&nbsp;&nbsp;";
											echo "<a href='#' data-toggle='modal'
														data-employee-id='$empid'
														data-lastname='$row1->employee_lastname' 
													data-firstname='$row1->employee_firstname' 
													data-middlename='$row1->employee_middlename'

											data-target='#myModal6' class = 'editempdialog'><button class='btn btn-warning' type='button'><i class='fa fa-warning'></i> Deactivate</button></button></a>
											<a href = 'employeedocument.php?id=$empid'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> Print</button></a>";
											
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>