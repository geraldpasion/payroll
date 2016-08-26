<!DOCTYPE html>
<html>

	<head>
		<?php
				include('supervisormenuheader.php');
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
				if(!isset($_GET['page'])){
					$num=1;
				}else{
					$num=$_GET['page'];
				}
				$next1=$page-1;
				$num1=$num;
				
				if($num<=1){
					echo " <a class='pagi' id='nexts'> < </a>";
				}else{
					echo " <a class='pagi' id='nexts' href='images2.php?page=$next1'> < </a>";
				}

				// $page1=$page+1;
				// $page2=$page1+1;
				// $page3=$page2+1;
				// $page4=$page3+1;

			//echo "  <a class='pagi' href='images.php?page=$page'> $page </a>";
			//echo "  <a class='pagi' href='images.php?page=$page1'>$page1</a>";
			//echo "  <a class='pagi' href='images.php?page=$page2'>$page2</a>";
			//echo "  <a class='pagi' href='images.php?page=$page3'> $page3 </a>";
			//echo "  <a class='pagi' href='images.php?page=$page4'> $page4 </a>";
				


				
				if($num>=$total_pages-2){

					if($total_pages-$num==2){
						$count=$num-1;
					}else if($total_pages-$num==1){
						$count=$num-2;
					}else if($total_pages-$num==0){
						$count=$num-3;
					}
					for($count;$count<=$total_pages;$count++) {
						//$count=$count-$count+1;
	            	echo "  <a class='pagi' href='images2.php?page=$count'> $count </a>";
					
					}
					
					
					
				}else{
					$max=4;
					if($num>1){
						$num--;
						echo "  <a class='pagi' href='images2.php?page=$num'> $num </a>";
						$num++;
						$max=3;
					}
					
					for($count=1;$count<=$max;$count++) {
						//$num=$num-$num+1;
	            	echo "  <a class='pagi' href='images2.php?page=$num'> $num </a>";
	            	$num++;
					}
				}


			$next=$page+1;

			if($num1>=$total_pages){
				echo " <a class='pagi' id=''> > </a>";
			}else{
				echo " <a class='pagi' id=''  href='images2.php?page=$next'> > </a>";
			}


			 echo "<br><br><br> <b>Total Images: </b>" . $total_records."<br>";
			echo'	</section>';
			/*if($page==1){
				echo"<script>
				document.getElementById('nexts').disabled=true;
				alert();
				</script>";
			}*/
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
<script>

function gettotal(){
var total=<?php echo"$total_pages"?>;
var getpage=<?php echo"$page"?>;
//alert(getpage);

if(getpage==1){
	
 	$("#nexts").attr('disabled',true);

}


}
</script>