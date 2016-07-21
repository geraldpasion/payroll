<!DOCTYPE html>
<html>

	<head>
		<?php
			include('employeemenuheader.php');
		?>
		<title>Inquiry answers</title>
		<?php
			if(isset($_GET['delete']))
			{
				echo '<script type="text/javascript">'
				   , 'alertFunction();'
				   , '</script>'
				;	
			}
			$empid = $_SESSION['logsession'];
		?>
		<script type="text/javascript">
			$(document).on("click", ".answerdialog", function () {
			 var question = $(this).data('question');
			 var answer = $(this).data('answer');
			 
			  $(".modal-body #quest").val( question );
			  $(".modal-body #answer").val( answer );
			 });
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Results</h5>
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
						<?php
							include('dbconfig.php');
							if ($result = $mysqli->query("SELECT * FROM inquiry WHERE employee_id = $empid ORDER BY inquiry_date DESC")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th>Date</th>";
									echo "<th>Question</th>";
									echo "<th>Answered by</th>";
									echo "<th>Answer</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tfoot>";                    
									echo "<tr>";
									echo "<td colspan='5'>";
									echo "<ul class='pagination pull-right'></ul>";
									echo "</td>";
									echo "</tr>";
									echo "</tfoot>";
									
									while ($row = mysqli_fetch_object($result))
									{
										echo "<tr>";
										echo "<td>" . date("Y-m-d",strtotime($row->inquiry_date)) . "</td>";
										echo "<td>" . $row->inquiry_question . "</td>";
										echo "<td>" . $row->inquiry_answeredby . "</td>";
										$question =htmlentities($row->inquiry_question);
										$answer = htmlentities($row->inquiry_answer);
										echo '<td><a href="#" data-toggle="modal" data-target="#myModal4" data-inqid="'.$row->inquiry_id.'" data-question="'.$question.'" data-answer="'.$answer.'" class = "answerdialog">';
										echo "<button class='btn btn-info' name = 'edit' type='button'> View</button></a>&nbsp;&nbsp;";
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
					<i class="fa fa-check modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Answer</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-2 control-label">Question</label>
									<div class="col-md-10">
									<textarea id = "quest" class="form-control" style="min-width: 100%" disabled></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Answer</label>
									<div class="col-md-10">
									<textarea id = "answer" class="form-control" style="min-width: 100%" disabled></textarea>
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
			include('employeemenufooter.php');
		?>
	</body>
</html>