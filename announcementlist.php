<!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Announcement list</title>
		<script type="text/javascript">
			$(document).on("click", ".answerdialog", function () {
			 var inqid = $(this).data('announcement');
			 
			  $(".modal-body #details").val( inqid );
			 
			 });
		</script>

		<script type="text/javascript">
			$(document).on("click", ".answerdialog", function () {
			 var inqid = $(this).data('announcementid');
			 
			  $(".modal-body #id_tag_ann").val( inqid );
			 
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
			   url: "announcement_delete.php",
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

		<style>
			.announcement-content{
				word-wrap: break-word !important;
			}
			table{
				table-layout: fixed; 
				width: 100%;
			}
			.ann-date{
				width: 300px;
			}

		</style>

	</head>

	<body>


		<!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>
    <script>
        $(document).on("click", ".alert", function(e) {
            bootbox.alert("Hello world!", function() {
                console.log("Alert Callback");
            });
        });
    </script>

		<!--div class="row"-->
		<div>
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Announcement List</h5>
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
                        <form>
                        <input type="text" class="form-control" id="filter"
                                   placeholder="Search in table">
                        </form><br>

							<!--table class="table table-striped table-hover table-responsive table-bordered"-->
							<table class='footable table table-stripped' data-page-size='8' data-filter=#filter>
								<?php
									//generate table headers
									generate_table_header();

									//generate table contents
									generate_table_contents();

								?>
							</table>

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

<!--modal for editing-------------------------------------------------------------------->

		<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<i class="fa fa-exclamation-circle modal-icon"></i>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Announcement details</h4>
					</div>
					<div class="modal-body">
						<div class="ibox-content">
							<form id = "myForm" method="POST" class="form-horizontal" action="announcement_update.php">
								<div class="form-group">
									<div class="col-md-10" id = "quest">
									<input id = "inqid" class="form-control" style="min-width: 100%; display: none;" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Details</label>
									<div class="col-md-10">
									<textarea  id = "details" class="form-control" name="ann_val" style="min-width: 100%"></textarea>
									<textarea  id = "id_tag_ann" class="form-control" name="ann_id" style="min-width: 100%; display: none;" ></textarea>
									
									<input type="submit" value="Update">
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

<?php
//functions

function generate_table_header(){
	echo "<thead>";
		echo "<tr>";
			echo "<th class='ann-date'>Date</th>";
			echo "<th>Announcements</th>";
			echo "<th>Action</th>";
		echo "</tr>";
	echo "</thead>";

}

function generate_table_contents(){
include('dbconfig.php');
	if ($result = $mysqli->query("SELECT * FROM announcement WHERE announcement_archive = 'active' ORDER BY announcement_date DESC")) //get records from db
	{
		if ($result->num_rows > 0) //display records if any
		{
			while ($row = mysqli_fetch_object($result)){
				echo "<tr>";
					echo "<td class='ann-date'>". date("Y-m-d", strtotime($row->announcement_date)) ."</td>";
					echo "<td class='announcement-content'>". $row->announcement_details ."</td>";
					echo "<td>";

					//view
					echo "<a href='#' data-toggle='modal' data-target='#myModal4' data-announcement='$row->announcement_details' 
					class = 'answerdialog btn btn-success'>
										 View
										</a>&nbsp;&nbsp";

					//edit
					echo "<a href='#?id=".$row->announcement_id."' data-toggle='modal' data-target='#myModal5' 
					data-announcement='$row->announcement_details'
					data-announcementid='$row->announcement_id'   
					class = 'answerdialog btn btn-primary'>
										 Edit
										</a>&nbsp;&nbsp";

					//delete
					echo "<a href='announcement_delete.php?ann_id=".$row->announcement_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>&nbsp;&nbsp; ";

					"</td>";
				echo "</tr>";
			}
		}
	}
}



?>

<script>
	function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("details").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "ajax_info.txt", true);
  xhttp.send();

}
</script>