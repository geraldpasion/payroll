
<html>
<head>
								<?php
									include('supervisormenuheader.php');
								?>
</head>
	<body>

  											<div class="modal-dialog modal-lg" role="document">
               								<div class="modal-content">
                    						<div class="row">
                       			 			<div class="col-md-8">
											<id class="wrapper">


						<!--images display-->										
											<?php




											include('sqlconnection.php');
											if(isset($_GET['id'])){
											$result = mysqli_query($con, "SELECT * FROM image where p_id=".$_GET['id']);
											while($row = mysqli_fetch_array($result)){	
											echo "<center><a href='#' title='".$row['p_title']."'>"."<img src=".$row['p_img']." &nbsp; ".""."width='570px' height='390px'"."></a></center>";
													}
												}
											?>
										</div>



						<!--body modal-->

					
 						 	<div class="col-md-4">
                     	 		<div class="modal-body inline">
                    	 			<div class="row">
                    	 				<div class="col-md-4"></div></div>
                    	 					


                    	 	<!--close button-->
                     	<button type="button" onClick="parent.location='images2.php'" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						



                     	<!--insert comment-->
						<?php
						require "sqlconnection.php";
						if(isset($_POST['submit'])){
						$comment = $_POST['comment'];
						$aljustine=chr(92);
						$comment1=str_replace($aljustine,$aljustine.$aljustine,$comment);
						$commentNI=$_SESSION['fname'] . " " . $_SESSION['lname'];
						$comment2=str_replace("'","\'",$comment1);
						$comment2=trim($comment2);
						mysqli_query($con,"INSERT INTO comment1 SET com='$comment2', commentNI='$commentNI', pid=".$_POST['id']);
						//$come = "Location: comment.php?id=".$_GET['id'];
						//header($come);
						$comment = $_POST['comment'];
						}
	
						?>
 							

							<!--scrollbar-->
 							<div style="width: 200px; height: 300px; overflow: auto; padding: 3px">
						

 								<!--display image and comment-->
						<?php
						$id2=$_GET['id'];
						$getquery=mysqli_query($con, "SELECT * FROM comment1 where pid =$id2 ORDER BY id DESC");
						while($rows=mysqli_fetch_assoc($getquery))
									{
									$id=$rows['id'];
									$comment=$rows['com'];
									$commentko=$rows['commentNi'];
									$dellink="<a href=\"delete2.php??&id=" . $id . "&id2=".$id2."\">Delete</a>";
										echo "<text style='font-weight: bold;'>".$commentko."</text><br/>".$comment . '<br / >'. $dellink . '<br/>'. '<br/>';
									}

								
									$resultxx = $mysqli->query("SELECT MAX(p_id) as maxzz FROM image")->fetch_array();
										$idzz=$resultxx['maxzz'];	
									$resultzz = $mysqli->query("SELECT MIN(p_id) as minzz FROM image")->fetch_array();
										$minzzx=$resultzz['minzz'];	
										

						?>



				
						</div>
						</div>
						</div>
		
	





						<!--comment box-->
						<form action="comment2.php?id=<?php echo $_GET['id'];?>" method="POST">

	
										<textarea value="comment" name="comment" style="width:30%" required></textarea><br><br>
									<input type="submit" style="margin-left:200px" value="Comment" name="submit" class="btn btn-primary">
									<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></input>

						</form>

						
			<div class="row">	
		
			<div class="col-md-5">

			<div class="col-sm-1">
			</div>
		
				<button onclick="window.location.href='commentprev2.php?id=<?php echo $_GET['id']; ?>'" class="fa fa-chevron-left <?php if ($minzzx == $id2){echo 'hidden';}else{echo '';} ?>" style="position:absolute;top:-250px; left:60px; opacity:0.8; color:black; padding:15px; font-size:'20px'; border-radius:10px; border:none;"></button>
				</div>
		
				<div class="col-md-6">
				<button onclick="window.location.href='commentnext2.php?id=<?php echo $_GET['id']; ?>'" class="fa fa-chevron-right <?php if ($idzz == $id2){echo 'hidden';}else{echo '';} ?>" style="position:absolute;top:-250px; left:160px; opacity:0.8; color:black; font-size:'20px'; padding:15px; border-radius:10px; border:none;  "></button>
				
			</div>
	</div>
			


	
					</div>
				</div>
		
	
			
		
</div>





										<?php
											include('menufooter.php');
										?>
		
				</div>
			</div>
		</div>
</div>

</html>
</body>



