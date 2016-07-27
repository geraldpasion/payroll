<?php
include('dbconfig.php');
$attstatus = $mysqli->query("SELECT * FROM total_comp WHERE employee_id = '55'");
		if ($attstatus->num_rows > 0) {
			$row101 = mysqli_fetch_object($attstatus);
			$comp_id = $row101->comp_id;
			$cutoffdate = $row101->cutoff;
			$cutarray = array();
			$cutarray = split(" - ", $cutoffdate);
			$keydatefrom = $cutarray[0];
			$keydatefrom = date("Y-m-d", strtotime($keydatefrom));
			$keydateto = $cutarray[1];
			$keydateto = date("Y-m-d", strtotime($keydateto));

			if ($earningsett = $mysqli->query("SELECT * FROM emp_earnings WHERE employee_id = '55'")){
				if ($earningsett->num_rows > 0) {
					while($row = $earningsett->fetch_object()){
						$initial = date("Y-m-d", strtotime($row->initial_date));
						$end = $row->end_date;
						$comp_id2 = $row->comp_id;


						/*if(($end != "0000-00-00" && (($initial <= $keydatefrom && $end >= $keydatefrom) || ($initial <= $keydatefrom && $end <= $keydateto) || ($initial >= $keydatefrom && $initial <= $keydateto && $end >= $keydatefrom) || ($initial >= $keydatefrom && $initial <= $keydateto && $end <= $keydateto))) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){
						if(($end != "0000-00-00" && (($initial <= $keydateto && $end >= $keydateto && $end >= $keydatefrom) || ($end >= $keydatefrom && $initial <= $keydatefrom && $end <= $keydateto))) 
							|| ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))) {*/


						if(($end != "0000-00-00" && (($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)) && ($end >= $keydatefrom || $end <= $keydateto))) || ($end == "0000-00-00" && ($initial <= $keydatefrom || ($initial >= $keydatefrom && $initial <= $keydateto)))){
							$mysqli->query("UPDATE emp_earnings SET comp_id = '135' WHERE employee_id = '55'");
							echo '1<br>';
						}
					}
				}
			}

			

		}
			?>