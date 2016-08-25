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
	</head>
	<title>Gallery</title>
	<style>
.pagi{
padding: 5px;
background-color: #E0E0E0;
border-radius: 5px;
border: 2px solid #BDBDBD;
float: left;
margin-left: 2px;

}
	</style>
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

		    <form action = "uploadgallery.php?f=3" method = "POST" enctype ="multipart/form-data">
			
			<input type="file" name ="file" accept="image/*" required>
			<input hidden type="text" name="nam">
			<br/>
			<input type="submit" name="submit"  class="btn btn-primary" required><br><br><br>
		<?php
			include('sqlconnection.php');
			echo'<div class="row">
				<div class="col-lg-12">
				<a class="collapse-link">';


			//////////// PAGINATION ////////////
         	 $page = isset($_GET['page'])? $_GET['page'] : 1;

	        if($page == "" || $page == 1 || $page == 0){
	        	$page1=0;
	        }else {
	        	$page1 = ($page*8)-8;
	        }
        	
        	//////////// PAGINATION ////////////
			echo'<section class="content-header">';
            $qPage = mysqli_query($con, "SELECT * FROM image");
              
              
            $total_records = mysqli_num_rows($qPage);
          //  echo "<b>Total Images: </b>" . $total_records."<br>";
            $per_page = 8;
            $total_pages = ceil($total_records/$per_page);

          // echo"<script>alert($total_records);</script>";

			$result = mysqli_query($con, "SELECT * FROM image ORDER BY p_id DESC LIMIT $page1,8");
			while($row = mysqli_fetch_array($result)) {
				echo "<div class='col-md-3'><a href='comment.php?id=".$row['p_id']."' title='".$row['p_title']."'><img src=".$row['p_img']." &nbsp; "."width='220px' height='200px'"."></a>";

				$id=['id'];

				$dellink="<a href='del.php?id=".$row['p_id']."'>Delete</a>";
				$comment="<a href='comment.php?id=".$row['p_id']."'>Comment</a>";


				echo   $dellink.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'. $comment . '<br/>'. '<br/></div>';
			}
			
			echo'</div>
				</div>
				</div>
				<br><br>';
				$next1=$page-1;

					echo " <a class='pagi' href='images.php?page=$next1'> < </a>";

					echo " <a class='pagi' href='images.php?page=1'> 1 </a>";
					echo " <a class='pagi' href='images.php?page=2'> 2 </a>";
					echo " <a class='pagi' href='images.php?page=3'> 3 </a>";
					echo " <a class='pagi' href='images.php?page=4'> 4 </a>";
					
				for($num=1;$num<=$total_pages;$num++) {
					//$num=$num-$num+1;
				//echo"<script>alert($num);</script>";
            	//echo "  <a class='pagi' href='images.php?page=$num'> $num </a>";
            	
			}
			$next=$page+1;
			echo " <a class='pagi' href='images.php?page=$next'> > </a>";
			 echo "<br><br><br> <b>Total Images: </b>" . $total_records."<br>";
			echo'	</section>';
			?>
			<br><br><br>

			<br/>
			<br/>
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