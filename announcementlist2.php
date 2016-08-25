<!DOCTYPE html>
<html>

	<head>
		<?php
			include('supervisormenuheader.php');
		?>
		<title>Announcement list</title>
		<script type="text/javascript">
			$(document).on("click", ".answerdialog", function () {
			 var inqid = $(this).data('announcement');
			 
			  $(".modal-body #details").val( inqid );
		
			  
			 });
		</script>
		
		<script type="text/javascript">//ajax
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var announcement_id = element.attr("id");
			var info = 'announcement_id=' + announcement_id;
			 $.ajax({
			   type: "GET",
			   url: "deleteannouncement.php",
			   data: info,
			   success: function(){
			 }
			});
			  $(this).parents(".josh").remove();
			 $('#success').fadeIn(300).delay(3200).fadeOut(300);
			 $(window).scrollTop(0);
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
				toastr.success('Announcement successfully deleted!');
			 
			return false;
			});
			});
		</script>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Announcement list</h5>
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
							if ($result = $mysqli->query("SELECT * FROM announcement ORDER BY announcement_date DESC")) //get records from db
							{
								if ($result->num_rows > 0) //display records if any
								{
									echo "<table class='footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter>";								
									echo "<thead>";
									echo "<tr>";
									echo "<th>Date</th>";
									echo "<th>Announcement</th>";
									echo "<th>Action</th>";
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
										echo "<tr class = 'josh'>";
										echo "<td>" . date("Y-m-d", strtotime($row->announcement_date)) . "</td>";
										echo "<td>" . $row->announcement_details . "</td>";
										echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' data-announcement='$row->announcement_details' class = 'answerdialog'><button class='btn btn-info' name = 'edit' type='button'> View</button></a>&nbsp;&nbsp;";
										echo "<a href='#' class='delete' id='$row->announcement_id'><button class='btn btn-danger' name = 'edit' type='button'> Delete</button></a>&nbsp;&nbsp;";
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
					<i class="fa fa-exclamation-circle modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Announcement details</h4>
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
									<label class="col-sm-2 control-label">Details</label>
									<div class="col-md-10">
									<textarea  id = "details" class="form-control" style="min-width: 100%" readonly></textarea>
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