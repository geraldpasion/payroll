<!DOCTYPE html>
<html>

	<head>
		<?php
			session_start();
		$empLevel = $_SESSION['employee_level'];
		if(isset($_SESSION['logsession']) && $empLevel == '3') {
				include('menuheader.php');

		}else if(isset($_SESSION['logsession']) && $empLevel == '4') {
			include('levelexe.php');
		}
		?>
		<title>Pending Inquiries</title>
		<style>
			.btn3{
				margin-left:26em;
			}
			.btn2{
				margin-left:-10.8em;
			}
		</style>
		<script>
			function myFunction() {
				document.getElementById("myForm").reset();
			}
		</script>
		<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert2.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!--	<script type="text/javascript" >//ajax
			$(document).ready(function(){
			$("#submit").click(function(){
			var answer = $("#answer").val();
			var inqid = $("#inqid").val();

			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'answer1='+ answer + '&inqid1=' + inqid;
			if(answer==''){
			$('#warning').fadeIn(700);
			$('#success').hide();
			}
			else{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "answerinquiry.php",
				data: dataString,
				cache: false,
				success: function(result){
				$('#success').fadeIn(300).delay(3200).fadeOut(300);
				$('#warning').hide();
					}
				});
			}
			return false;
			});
			});
		</script>
	-->
		<script type="text/javascript">
			$(document).on("click", ".answerdialog", function () {
			var inqid = $(this).data('inqid');
			var quest = $(this).data('quest');
			var answer = $(this).data('answer');
			$(".modal-body #inqid").val( inqid );
			$(".modal-body #quest").val( quest );
			$(".modal-body #answer").val( answer );
			  
			});
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
				toastr.success("Successfully answered an inquiry!");
				history.replaceState({}, "Title", "inquiry.php");
		}
		
		
	});
	</script>
	<?php
		if(isset($_GET['answered']))
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
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Pending Inquiries</h5>
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
                        <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">

						<?php
							include('dbconfig.php');
							if ($result = $mysqli->query("SELECT * FROM inquiry RIGHT JOIN employee ON employee.employee_id = inquiry.employee_id WHERE inquiry_status = 'Pending' ORDER BY inquiry_date DESC")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th>Name</th>";
									echo "<th>Date</th>";
									echo "<th>Question</th>";
									echo "<th style='text-align:center'>Action</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tfoot>";                    
									echo "<tr>";
									echo "<td colspan='7'>";
									echo "<ul class='pagination pull-right'></ul>";
									echo "</td>";
									echo "</tr>";
									echo "</tfoot>";
									
									while ($row = mysqli_fetch_object($result))
									{
										echo "<tr class = 'josh'>";
										echo "<td>" .$row->employee_firstname . " " . $row->employee_lastname . "</td>";
										echo "<td >" . date("Y-m-d",strtotime($row->inquiry_date)) . "</td>";
										echo "<td>" . $row->inquiry_question . "</td>";
										$question =htmlentities($row->inquiry_question);
										$answer = htmlentities($row->inquiry_answer);
										echo '<td style="text-align:center"><a href="#" data-toggle="modal" data-target="#myModal4" data-inqid="'.$row->inquiry_id.'" data-quest="'.$question.'" data-answer="'.$answer.'" class = "answerdialog">';
										echo "<button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> Answer</button></a>&nbsp;&nbsp;";
										echo "</td>";
										echo "</tr>";
										
									}
									echo "</table>";
								}
							}
						?>
					</div>
				</div>
			</div>
        </div>
		<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<i class="fa fa-question modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Answer Inquiry</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" action = "answerinquiry.php" class="form-horizontal">
								<div class="form-group">
									<div class="col-md-10" id = "quest">
									<input id = "inqid" class="form-control" type = "hidden">
									</div>
								</div>
								<input id = "inqid" type="hidden" name = "inqid1" class="form-control" required="" onKeyPress="return lettersonly(this, event)">
								<div class="form-group">
									<label class="col-sm-2 control-label">Question</label>
									<div class="col-md-10">
									<textarea id = "quest" class="form-control" style="min-width: 100%" disabled></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Answer</label>
									<div class="col-md-10">
									<textarea  id = "answer" name = "answer1" class="form-control" style="min-width: 100%" required=""></textarea>
									</div>
								</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id = "submit">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>