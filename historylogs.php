<?php
include('dbconfig.php');
	$empid = $_REQUEST['empid'];
	if ($result1 = $mysqli->query("SELECT * FROM leave_logs WHERE employee_id = '$empid'")) //get records from db
							{
								if ($result1->num_rows > 0) 
								{
									while ($row1 = mysqli_fetch_object($result1))
									{
										//echo "<label class='control-label'>".$row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</label>";

										echo "<tr class = 'josh'>"; 
											echo "<td>" . $row1->date . "</td>";
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