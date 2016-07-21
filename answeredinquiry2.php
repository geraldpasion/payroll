<!DOCTYPE html>
<html>

	<head>
		<?php
			include('supervisormenuheader.php');
		?>
		<title>Answered Inquiries</title>
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
		<script type="text/javascript" >//ajax
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
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Answered Inquiries</h5>
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
							if ($result = $mysqli->query("SELECT * FROM inquiry INNER JOIN employee ON employee.employee_id = inquiry.employee_id WHERE employee_team = '$team' AND inquiry_status = 'answered' ORDER BY inquiry_date DESC")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='5' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th>Name</th>";
									echo "<th >Date</th>";
									echo "<th>Answer</th>";
									echo "<th>Answered by</th>";
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
									
									while ($row = mysqli_fetch_object($result))
									{
										echo "<tr class = 'josh'>";
										echo "<td>" .$row->employee_firstname . " " . $row->employee_lastname . "</td>";
										echo "<td >" . date("Y-m-d",strtotime($row->inquiry_date)) . "</td>";
										echo "<td>" . $row->inquiry_question . "</td>";
										echo "<td>" . $row->inquiry_answeredby . "</td>";
										$question =htmlentities($row->inquiry_question);
										$answer = htmlentities($row->inquiry_answer);
										echo '<td><a href="#" data-toggle="modal" data-target="#myModal4" data-inqid="'.$row->inquiry_id.'" data-quest="'.$question.'" data-answer="'.$answer.'" class = "answerdialog">';
										echo "<button class='btn btn-info' name = 'edit' type='button'><i class='fa fa-paste'></i> View</button></a>&nbsp;&nbsp;";
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
						<h4 class="modal-title">Answer inquiry</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" class="form-horizontal">
								<div class="form-group">
									<div class="col-md-10" id = "quest">
									<input id = "inqid" class="form-control" type = "hidden">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Question</label>
									<div class="col-md-10">
									<textarea id = "quest" class="form-control" style="min-width: 100%" disabled></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Answer</label>
									<div class="col-md-10">
									<textarea  id = "answer" class="form-control" style="min-width: 100%" disabled></textarea>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<?php
			include('menufooter.php');
		?>
	</body>
</html>