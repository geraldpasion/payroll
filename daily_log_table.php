

<script>
function filterdailylogs() {

  var input, filter, table, tr, td, i,year,date,day;
   //year = document.getElementById("dyear").value;
  // month = document.getElementById("dmonth").value;
  // day = document.getElementById("dday").value;
 input = document.getElementById("dyear");

 //input = month+" "+day+", "+year
  filter = input.value.toUpperCase();
  table = document.getElementById("dailytable");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
  	
    td = tr[i].getElementsByTagName("td")[0];

    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {

        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
   
  }
}
function filterdailylogs_month() {

  var input, filter, table, tr, td, i,year,date,day;
   //year = document.getElementById("dyear").value;
  // month = document.getElementById("dmonth").value;
  // day = document.getElementById("dday").value;
 input = document.getElementById("dmonth");
 
 //input = month+" "+day+", "+year
  filter = input.value.toUpperCase();
  table = document.getElementById("dailytable");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
  	
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function filterdailylogs_day() {
//var res = str.substring(1, 4);

  var input, filter, table, tr, td, i,year,date,day;
   //year = document.getElementById("dyear").value;
  // month = document.getElementById("dmonth").value;
  // day = document.getElementById("dday").value;
 input = document.getElementById("dday");
 
 //input = month+" "+day+", "+year
  filter = input.value.toUpperCase();
  table = document.getElementById("dailytable");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
  	
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<?php 
include_once 'dbconfig.php';
date_default_timezone_set('asia/manila');
$empid = isset($_GET['empid']) ? $_GET['empid'] : false;
$year=isset($_GET['year'])? $_GET['year'] : false;
$month=isset($_GET['month'])? $_GET['month'] : false;
$days=isset($_GET['day'])? $_GET['day'] : false;

/*if($empid) {
	echo "<table id='leave_type' class='footable table table-stripped' data-page-size='20' data-filter=#filter>						
	<thead>
		<tr>
			<th>Leave Type</th>
			<th>From</th>
			<th>Status</th>
			<!--th>To</th-->
			<!--th>Days</th-->
			<th>Approved By</th>
			<th>Approve Date</th>
		</tr>
	</thead>
	<tbody>";



	$leavedetails = $mysqli->query("SELECT * FROM tbl_leave WHERE employee_id=$empid");
		if($leavedetails->num_rows > 0){
			while($leave = $leavedetails->fetch_object()){
				echo '<tr>';
				echo '<td>'.$leave->leave_type.'</td>';
				echo '<td>'.$leave->leave_start.'</td>';
				echo '<td>'.$leave->leave_status.'</td>';
				//echo '<td>'.$leave->.'</td>';
				echo '<td>'.$leave->leave_approvedby.'</td>';
				echo '<td>'.$leave->leave_approvaldate.'</td>';
				echo '</tr>';
			}
		}
			

	echo "</tbody>
	</table>";
}*/


if ($emp_shiftlog = $mysqli->query("SELECT * FROM shift_logs WHERE employee_id = $empid ORDER BY shiftlog_date DESC")){

								
 
								if($emp_shiftlog->num_rows > 0){

									
								echo '<table id="dailytable" class="footable table table-stripped" data-page-size="10" data-limit-navigation="5" data-filter=#filter>';	
								echo '<thead>';
								echo '<tr>';
								//echo '<th>Date</th>';
								//echo '<th>Start Date</th>';
								//echo '<th>End Date</th>';
								echo '<th>Date</th>';
								echo '<th>Day</th>';
								echo '<th>Schedule</th>';
								//echo '<th>Created By</th>';
								//echo '<th>Status</th>';
								echo '</tr>';
								echo '</thead>';
								echo "<tfoot>";                    
								echo "<tr>";
								echo "<td colspan='7'>";
								echo "<ul class='pagination pull-right'></ul>";
								echo "</td>";
								echo "</tr>";
								echo "</tfoot>";
								while($shiftlog = mysqli_fetch_object($emp_shiftlog)){
									//$shiftlogid = $shiftlog->shiftlog_id;

									$startdate = strtotime($shiftlog->shiftlog_startdate);
									//$enddate = $shiftlog->shiftlog_enddate;
									$star=substr($shiftlog->shiftlog_startdate,7);
									$end=substr($shiftlog->shiftlog_enddate,7);
									$startyear = date("Y", $startdate);
									$startmonth = date("F", $startdate);
									$startday = date("d", $startdate);
									//$ha=2;
									//$day=date("l",$ha);
									
									
									if($shiftlog->shiftlog_enddate!="0000-00-00"){
										$diff=$star-$end;

									

									for($i = 0; $i <= $diff; $i++){
									$d=$i+1;
									$day = date('l', strtotime("$i days")); 
									
									
									//$finaldate = date(" F d, Y", ($startyear. $startmonth. ($startday+$i)) );
									

									echo '<tr>';
									//echo '<td>'.$shiftlog->shiftlog_date.'</td>';
									//echo '<td>'.$shiftlog->shiftlog_startdate.'</td>';
									//echo '<td>'.$shiftlog->shiftlog_enddate.'</td>';
									echo '<td id="mdy">'.$startmonth.' '.($startday+$i).', '.$startyear.'</td>';
									//echo '<td>'.$finaldate.'</td>';
									echo '<td>'.$day.'</td>';
									
									//echo '<td>'.$startyear.'</td>';
									//echo '<td>'.$startmonth.'</td>';
									//echo '<td>'.$startday.'</td>';
									//echo '<td>'.($i+1).'</td>';// -> day (e.g. wednesday, etc.)
									echo '<td>'.$shiftlog->shiftlog_schedule.'</td>';
									//echo '<td>'.$shiftlog->shiftlog_createdby.'</td>';
									//echo '<td>'.$shiftlog->shiftlog_status.'</td>';
									echo '</tr>';
									
									}
									
									}//end if
									
									}
								}
								echo "</table>";
							}



?>

