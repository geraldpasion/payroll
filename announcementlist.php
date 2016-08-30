
		<?php
//functions

function generate_table_header(){
	echo "<thead>";
		echo "<tr>";
			echo "<th class='ann-date'>Date</th>";
			echo "<th>Subject</th>";
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
				$announcement_details = $row->announcement_details;
				$subject=$row->subject;
				//$announcement_details = str_replace('"','\"',$announcement_details);
				//$announcement_details = str_replace("'","\'",$announcement_details);

				echo "<tbody><tr>";
					echo "<td class='ann-date'>". date("Y-m-d", strtotime($row->announcement_date)) ."</td>";
					echo "<td class='announcement-content'>". $subject ."</td>";
					echo "<td>";

					//view
					echo "<a href='#' data-toggle='modal' data-target='#myModal4' data-announcement='$row->announcement_details' data-subject = '$row->subject'
					class = 'answerdialog btn btn-success'>
										 View
										</a>&nbsp;&nbsp";

					//edit
					echo "<a href='#?id=".$row->announcement_id."' data-toggle='modal' data-target='#myModal5' 
					data-announcement='$row->announcement_details'
					data-subject = '$row->subject'
					data-announcementid='$row->announcement_id'   
					class = 'answerdialog btn btn-primary'>
										 Edit
										</a>&nbsp;&nbsp";

					//delete
					//echo "<a href='announcement_delete.php?ann_id=".$row->announcement_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>&nbsp;&nbsp; ";
					echo "<a href='#' class='btn btn-danger' onclick='deleteRecord(".$row->announcement_id.")'>Delete</a>&nbsp;&nbsp; ";
					"</td>";
				echo "</tr>
				</tbody>";
				

			}
		}
	}
}



?>
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
		}else if(isset($_SESSION['logsession']) && $empLevel == '2') {
			include('supervisormenuheader.php');
		}
		?>
		<title>Announcement list</title>
		<script type="text/javascript">
			$(document).on("click", ".answerdialog", function () {
			 var inqid = $(this).data('announcement');
			 var subje = $(this).data('subject');
			 
			  $(".modal-body #details").val( inqid );
			  $(".modal-body #subject").val( subje );
			 
			 });
		</script>

		<script type="text/javascript">
			$(document).on("click", ".answerdialog", function () {
			 var inqid = $(this).data('announcementid');
			 var subje = $(this).data('subject');
			  $(".modal-body #id_tag_ann").val( inqid );
			  $(".modal-body #subject1").val( subje );
			 
			 });
		</script>
		

		<script type="text/javascript">//ajax
		/*	$(function() {
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
			});*/

		function deleteRecord(id) {
		swal({
		title: "Are you sure?",
		text: "The action you are about to do cannot be undone!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#dd6b55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
		}, function(isConfirm){   if (isConfirm) { 
			swal("Deleted!", "Your imaginary file has been deleted.", "success");  
			//alert(id);
			
			var id_val = id;
			var request = $.ajax({
			  url: "deleteannouncement.php",
			  async: false,
			  method: "GET",
			  data: { announcement_id : id_val },
			  dataType: "html"
			});
			 
			request.done(function( msg ) {
			  //alert(msg);
			  window.location.replace("http://10.10.1.31/payroll/announcementlist.php");
			});
			 
			// request.fail(function( jqXHR, textStatus ) {
			//   alert( "Request failed: " + textStatus );
			// });

		} else {     
			swal("Cancelled", "Your imaginary file is safe :)", "error");   
		} });
}
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
									<label class="col-sm-1 control-label">Subject</label><br><br>
									<div class="col-md-12">
									<input type="text"  id = "subject" class="form-control" readonly/>
									</div><br><br><br>
									<label class="col-sm-1 control-label">Announcement</label><br><br>
									<div class="col-md-12">
									<textarea  id = "details" class="form-control" style="min-width: 100%; margin: 0px -9px 0px 0px; width: 508px; height: 129px;" readonly></textarea>
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
									<label class="col-sm-1 control-label">Subject</label><br><br>
									<div class="col-md-12">
									<input type="text" name="sebject_val"  id = "subject1" class="form-control" name/>
									</div><br><br><br>
									<label class="col-sm-1 control-label">Details</label><br>
									<div class="col-md-12">
									<textarea  id = "details" class="form-control" name="ann_val" style="min-width: 100%; margin: 0px -9px 0px 0px; width: 508px; height: 129px;"></textarea>
									<input type="text"  id = "id_tag_ann" class="form-control" name="ann_id" style="height:10px; width:10px; display:none" />
									</div>
								</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Update">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</div>
					</form>
				</div>
			</div>
		</div>


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
							<table class='footable table table-stripped' data-page-size='10' data-limit-navigation='5' data-filter=#filter>
								 <thead>
								 	<tr class = 'josh'>
								 	<th class = "col-md-5">Date</th>
								 	<th class = "col-md-5">Subject</th>
								 	<th class = "col-md-3" style='text-align:center'>Action</th>
								 	</tr>
								 </thead>
								<?php
									//generate table headers
								//	generate_table_header();

									//generate table contents
									generate_table_contents();
									
								?>
									<tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right" data-limit-navigation="5">
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "first" href = "#first"><<</a>
                                                    </li>
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "prev" href = "#prev"><</a>
                                                    </li>
                                                    <li class = "footable-page active">
                                                      <a data-page = "0" href = "#">1</a>
                                                    </li>
                                                    <li class = "footable-page">
                                                      <a data-page = "1" href = "#">2</a>
                                                    </li>
                                                    <li class = "footable-page ">
                                                      <a data-page = "2" href = "#">3</a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "next" href = "#next">></a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "last" href = "#last">>></a>
                                                    </li>
                                                  </ul>
                                                </td>
                                              </tr>
                                            </tfoot>
							</table>
						

					</div>
				</div>
			</div>
        </div>
		
		
		<?php
			include('employeemenufooter.php');
		?>


