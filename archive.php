<!DOCTYPE html>
<html>
	<head>
		<?php
			 include('menuheader.php');
		?>
		<title>Archive</title>
		<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<script src="js/plugins/toastr/toastr.min.js"></script>
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/plugins/iCheck/custom.css" rel="stylesheet">		
				
		<script src="js/keypress.js"></script>
		 <script type="text/javascript">
		// 	$(document).ready(function(){
		// 		 showEdited=function(){
		// 	toastr.options = { 
		// 				"closeButton": true,
		// 			  "debug": false,
		// 			  "progressBar": true,
		// 			  "preventDuplicates": true,
		// 			  "positionClass": "toast-top-right",
		// 			  "onclick": null,
		// 			  "showDuration": "400",
		// 			  "hideDuration": "1000",
		// 			  "timeOut": "7000",
		// 			  "extendedTimeOut": "1000",
		// 			  "showEasing": "swing",
		// 			  "hideEasing": "linear",
		// 			  "showMethod": "fadeIn",
		// 			  "hideMethod": "fadeOut" // 1.5s
		// 				}
		// 				toastr.success("Employee team updated!");
		// 		}
		// 		history.replaceState({}, "Title", "archive.php");
				
		// 	});
		// </script>
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
		<form name="frmUser" method="post" action="">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Archive</h5>
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
							<div class="table-responsive">
                            <div class="col-lg-12">
                                <div class = "col-lg-1 col-md-1 col-sm-5 col-xs-5">
                                    <h4>Search</h4>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <select class = "form-control" id = "selecttype">
                                        <option></option>
                                        <option value = "1">Cutoff</option>
                                        <option value = "2">Earnings</option>
                                        <option value = "3">Deductions</option>
                                        <option value = "4">Announcements</option>
                                        <option value = "5">Holiday</option>
                                      </select>
                                    <br>
                                </div>
                    <br>
					<BR>
					<BR>
					<BR>

 									<div id = "div1" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Cutoff</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='8' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center" class = "col-md-2">ID</th>
                                                    <th style="text-align:center">Date</th>
                                                    <th style="text-align:center" class = "col-md-5">Vendor</th>
                                                    <th style="text-align:center" class = "col-md 3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align:center">
                                                    <td>1</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>2</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                    onMouseOver="this.style.color='blue'"
                                                    onMouseOut="this.style.color='gray'"
                                                    > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>3</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPurchasing"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
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

                                    <div id = "div2" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Earnings</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='8' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center" class = "col-md-2">ID</th>
                                                    <th style="text-align:center">Date</th>
                                                    <th style="text-align:center" class = "col-md-5">Payee</th>
                                                    <th style="text-align:center" class = "col-md-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align:center">
                                                    <td>1</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>2</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                    onMouseOver="this.style.color='blue'"
                                                    onMouseOut="this.style.color='gray'"
                                                    > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>3</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewCashAdvance"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
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

                                    <div id = "div3" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Deductions</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='8' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center" class = "col-md-2">ID</th>
                                                    <th style="text-align:center">Date</th>
                                                    <th style="text-align:center" class = "col-md-5">Name</th>
                                                    <th style="text-align:center" class = "col-md-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align:center">
                                                    <td>1</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>2</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                    onMouseOver="this.style.color='blue'"
                                                    onMouseOut="this.style.color='gray'"
                                                    > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>3</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewLiquidation"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
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

                                    <div id = "div4" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Announcements</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='8' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center" class = "col-md-2">ID</th>
                                                    <th style="text-align:center">Date</th>
                                                    <th style="text-align:center" class = "col-md-5">Name</th>
                                                    <th style="text-align:center" class = "col-md-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align:center">
                                                    <td>1</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>2</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                    onMouseOver="this.style.color='blue'"
                                                    onMouseOut="this.style.color='gray'"
                                                    > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>3</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewReimbursement"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
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

                                    <div id = "div5" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Holidays</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='8' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center" class = "col-md-2">ID</th>
                                                    <th style="text-align:center">Date</th>
                                                    <th style="text-align:center" class = "col-md-5">Payee</th>
                                                    <th style="text-align:center" class = "col-md-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align:center">
                                                    <td>1</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>2</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                    onMouseOver="this.style.color='blue'"
                                                    onMouseOut="this.style.color='gray'"
                                                    > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>3</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                                <tr style="text-align:center">
                                                    <td>4</td>
                                                    <td></td>
                                                    <td><a href = "#.php" data-toggle="modal" data-target = "#myModalViewPayment"
                                                        onMouseOver="this.style.color='blue'"
                                                        onMouseOut="this.style.color='gray'"
                                                        > Vendor </a>
                                                    </td>
                                                    <td><button class='btn btn-success' type='button' data-toggle="modal" data-target="#myModalRestore"><i class='fa fa-warning'></i> Restore</button>&nbsp;&nbsp;<button class='btn btn-warning' type='button' data-toggle="modal" data-target="#myModalDelete"><i class='fa fa-warning'></i> Delete</button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
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

                                   
                                   

                                    <script type="text/javascript">
                                        $(function () {
                                            $('#selecttype').bind('change', function(event) {
                                           var i= $('#selecttype').val();
                                           
                                            if(i=="1")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').show();
                                                 $('#div2').hide();
                                                 $('#div3').hide();
                                                 $('#div4').hide();
                                                 $('#div5').hide();
                                             }
                                           else if(i=="2")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').show();
                                                 $('#div3').hide();
                                                 $('#div4').hide();
                                                 $('#div5').hide();
                                            }
                                            else if(i=="3")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').hide();
                                                 $('#div3').show();
                                                 $('#div4').hide();
                                                 $('#div5').hide();
                                            }
                                            else if(i=="4")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').hide();
                                                 $('#div3').hide();
                                                 $('#div4').show();
                                                 $('#div5').hide();
                                            }
                                            else if(i=="5")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').hide();
                                                 $('#div3').hide();
                                                 $('#div4').hide();
                                                 $('#div5').show();
                                            }
                                            });
                                        });
                                    </script>

            <!--Modal for "Delete" record-->
            <div class="modal inmodal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="glyphicon glyphicon-trash modal-icon"></i>
                    <h4 class="modal-title">Delete Entry</h4>
                  </div><!--/.modal-header-->
                  <div class="modal-body">
                    <div class="alert alert-danger">     
                      Are you sure you want to permanently delete this record?
                    </div>
                  </div><!--/.modal-body-->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-ok-sign"></span>&nbsp;Yes</button>
                    <button type="button" class="btn btn-white" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-remove"></span>&nbsp;No</button>
                  </div><!--/.modal-footer-->
                </div>
              </div>
            </div><!--/#myModalDelete-->

            <!--Modal for "Restore" record-->
            <div class="modal inmodal fade" id="myModalRestore" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="glyphicon glyphicon-check modal-icon"></i>
                    <h4 class="modal-title">Restore Entry</h4>
                  </div><!--/.modal-header-->
                  <div class="modal-body">
                    <div class="alert alert-danger">
                      <span class = "glyphicon glyphicon-warning-primary"></span>      
                      Continue restoring this record?
                    </div>
                  </div><!--/.modal-body-->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-ok-sign"></span>&nbsp;Yes</button>
                    <button type="button" class="btn btn-white" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-remove"></span>&nbsp;No</button>
                  </div><!--/.modal-footer-->
                </div>
              </div>
            </div><!--/#myModalRestore-->           
                
                </div>
        

                                </div>
                            </div>
                        </div>
                    </div>                                
                </div>
            </div>
        </div>

		
	</body>
	<?php
		include('menufooter.php');
	?>

</html>