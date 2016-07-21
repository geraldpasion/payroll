<!DOCTYPE html>
<html>

	<head>
		<?php
			include('employeemenuheader.php');
		?>
	</head>
	<body>
							<div class="row">
							<div class="col-lg-12">
							<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h5>Gallery</h5>
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

											    <form action = "images3.php" method = "POST" enctype ="multipart/form-data">
												
												<input hidden type="text" name="nam">
												<br/>
												
												<br/>
												<br/>
							
							<?php
							include('uploadgallery3.php');
							?>
												</form>

						



						</div>
						</div>
						</div>
					

												<?php
												include('menufooter.php');
												?>
        				</div>
</body>
</html>