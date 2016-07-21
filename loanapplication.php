<!DOCTYPE html>
<html>
	<head>
		<?php
			include('employeemenuheader.php');
		
		?>
		<title>Loan Application</title>
		<style>
			.btn3{
				margin-left:6.5em;
			}
			.btn2{
				margin-left:-10em;
			}
						.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
		</style>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		
		<script type="text/javascript" >//ajax
			$(document).ready(function(){
			$(document).on('submit','#myForm', function() {
			var reason = $("#reason").val();
			var date = $("#date").val();
			var empid = $("#empid").val();
			// Returns successful data submission message when the entered information is stored in database.
			var dataString = '&date1=' + date + '&empid1=' + empid;
			if(reason==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "loanapplicationexe.php",
				data: dataString,
				cache: false,
				success: function(result){
				$('#date').val('');
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
				toastr.success('Successfully applied for loan!');
					}
				});
			}
			return false;
			});
			});
		</script>	

				<script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
						<script>
				function clearThis(target){
        	target.value= "";
    	}
		</script>
	</head>

	<body>

		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Loan Application</h5>
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
					<div class="ibox-content">
					<?php
							include('dbconfig.php');
							$employee_id = $_SESSION['logsession'];
							$result = $mysqli->query("SELECT * FROM employee WHERE employee_id = '$employee_id'")->fetch_array();	
					?>

						<form id = "myForm" method="POST" action = "loanapplicationexe.php" class="form-horizontal">
							<div class="form-group">
								<input type="hidden" id = "empid" name = "empid" class="form-control" value = " <?php echo $_SESSION['logsession'] ?>">
								<div class="col-md-3"></div>
								<label class="col-sm-1 control-label">ID</label>
								<div class="col-md-4"><input name = "employeeid" id = "employeeid" type="text" class="form-control" value = " <?php echo $employee_id ?> "readonly = "readonly"></div>
							</div>
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Name</label>
								<div class="col-md-4"><input type="text" id = "name" class="form-control" disabled = "" value  = "<?php echo $_SESSION['fname'] . " ".  $_SESSION['lname'] ?>"></div>
							</div>
						
							<div class="form-group"><div class="col-md-3"></div>
								<label class="col-sm-1 control-label">Date</label>
								<div class="col-md-4"><input id = "date" type="text" onfocus="clearThis(this)" class="form-control datepicker" name="daterange" required="" onKeyPress="return noneonly(this, event)"/> </div>
							</div>
	
					<?php include("db.php");	
	$query1 = "SELECT * FROM upload LIMIT 5";
	$result = mysql_query($query1);
?>
<div class="text" align="center">
<?php
echo "Download the two PDF form and fill <br>";
echo "up all the information needed<br>";
?>  
</div>
<?php
while($row1=mysql_fetch_array($result))
{
	$name=$row1['name'];
	ECHO "<BR>";
	$type=$row1['type'];
	?>
<div class="rect" align="center">
<img alt="down-icon" src="down-drop-icon.png" align="center" width="20" height="20" />
<a href="download.php?filename=<?php echo $name ;?>" >
<?php echo $name ;?></a>
</div>
<?php }?>



							<br><br>
				
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-5"><button id = "submit" type="submit" class="btn btn3 btn-w-m btn-primary">Submit</button></div>
								<div class="col-md-4"><button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button></div>
							</div>
							</div>		
</div>
</div>
</div>
						</form>



		
		<?php
			include('employeemenufooter.php');
		?>
	</body>
</html>