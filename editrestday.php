<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function setUpdateAction() {
			document.frmUser.action = "editrestdayexe.php";
			document.frmUser.submit();
			}
		</script>
		<?php
			session_start();
		$empLevel = $_SESSION['employee_level'];
		if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');

		}else if(isset($_SESSION['logsession']) && $empLevel == '4') {
			include('levelexe.php');
		}
		?>
		<title>Rest Day Settings</title>
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
					toastr.success("Rest days successfully edited!");
				}
				history.replaceState({}, "Title", "editrestday.php");
			});
		</script>
		<script>
		function change(obj) {
			var index = obj.selectedIndex;
			var val = obj.options[index].value;

			if(val == "without") {
				document.getElementById('date').disabled=true;
				document.getElementById('date').value="";
			} else if(val == "with") {
				document.getElementById('date').disabled=false;
			}
		}
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
		<form name="frmUser" id="frmUser" method="post" action="editrestdayexe.php">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Rest Day</h5>
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
							
							</div>
							<div class="form-group">
								<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="margin-top:5px;">Rest Day 1</label>
								<div class="col-md-4">
									<select id = "restday1" class="form-control" name="rest1" required="">
										<option value="Saturday" selected>Saturday</option>
										<option value="Sunday">Sunday</option>
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
									</SELECT>
								</div>
							</div><br><br><br>

							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="margin-top:5px;">Rest Day 2</label>
								<div class="col-md-4">
									<select id = "restday2" class="form-control" name="rest2" required="">
										<option value="Saturday">Saturday</option>
										<option value="Sunday" selected>Sunday</option>
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
									</SELECT>
								</div>
							</div><br><br><br>

							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="margin-top:5px;">Date Range</label>
								<div class="col-md-4"><select id = 'hasdate' name = 'hasdate' onchange="change(this);" class = 'form-control' data-default-value='without' required=''>
									<option value = 'without' selected>Without Date Range (tomorrow onwards)</option>
									<option value = 'with'>With Specified Date Range</option>
								</select></div>
							</div><br><br>

							<div class="form-group">
							<div class="col-md-3"></div>
								<label class="col-sm-2 control-label" style="margin-top:5px;">Date</label>
								<div class="col-md-4"><input id = "date" type="text" disabled class="form-control" name="daterange" required="" onKeyPress="return noneonly(this, event)"/></div>
							</div>

					<br><br><br><br>
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
										echo "<label><input type='checkbox' id='select_all'/>&nbsp;&nbsp;Check/Uncheck All</label>";
										echo "<table class='footable table table-stripped' data-page-size='20' data-filter=#filter>";								
										echo "<thead>";
										echo "<tr>";
										echo "<th style='text-align:center; width:150px;'></th>";
										echo "<th style='padding-left:100px; width:550px;'>Name</th>";
										echo "<th>Department</th>";
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
											echo "<td align='center'><input type='checkbox'  class='checkbox' name='id[]' value='$empid'></td>";
											echo "<td style='padding-left:100px;'>" . $row1->employee_lastname . "," . " " . $row1->employee_firstname . " " . $row1->employee_middlename . "</td>";
											echo "<td>" . $row1->employee_department. "</td>";
											echo "</tr>";
										}
										
										echo "</table>";
									}
								}
							
						?>
							<div class="form-group">
								<div class="col-md-4"></div>
								<button id = "submit" type="submit" name="sx" class="btn btn3 btn-w-m btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" onClick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
							</div>
						</form>
						</div></div>
						<br>
						</div>
						<br><br>

<?php
// if(isset($_POST['edit'])){
// echo "<div class='modal-body'>";
// echo "<input id = 'employeeid' name = 'employeeid' type='text' class='form-control'>";
// echo "</div>";
 // $employeeid = $_GET['employeeid'];

 // }
 ?>
 <script type="text/javascript">
	function getFormatDate(d){
	    return d.getMonth()+1 + '/' + d.getDate() + '/' + d.getFullYear()
	}

	$(document).ready(function() {
	    var mTemp = new Date(), minDate = getFormatDate(new Date(mTemp.setDate(mTemp.getDate())));

	    $('#date').daterangepicker(
	    {
	    	maxDate: minDate
	    }
	    );
	});
</script>
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

<script src="js/jquery.min.js"></script>
<script src="js/jquery.min.js"></script>
<link href="css/timepicki.css" rel="stylesheet">
<?php
	include('menufooter.php');
?>
</body>

</html>