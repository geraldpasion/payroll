
<html>
<head>

<title></title>
</head>

<div class="ibox-title">		
<?php
$imagesize = 1;
$uploadOk = 1;
include('sqlconnection.php');
if(isset($_POST['submit'])){


if ($_FILES["file"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $imagesize = 0;
}


    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


	$name = $_FILES['file']['name'];
	$tmp_name = $_FILES['file']['tmp_name'];
	

	$location = 'uploads/';
	$target = 'uploads/'.$name;

							if($imagesize == 1)
							{
							if( $uploadOk == 1)
								{
							if(move_uploaded_file($tmp_name,$location.$name)) {


							$nam = $_POST['nam'];
							$query = mysqli_query($con, "INSERT INTO image(p_img,p_title)VALUES('".$target."','$nam')");
							}else{
		


		echo "file not uploaded";

	}
}else
	{
		
		echo "";

	}
}else
	{
		
		echo "";

	}


}

?>




			<div class="row">
			<div class="col-lg-12">
			<a class="collapse-link">


<?php

 							//////////// PAGINATION ////////////
                          $page = isset($_GET['page'])? $_GET['page'] : 1;

                          if($page == "" || $page == 1 || $page == 0){
                            $page1=0;
                          }else {
                            $page1 = ($page*8)-8;
                          }
                        //////////// PAGINATION ////////////
?>
	<section class="content-header">
                    <?php 
                    $qPage = mysqli_query($con, "SELECT * FROM image");
                      
                      
                    $total_records = mysqli_num_rows($qPage);
                    echo "<b>Total Images: </b>" . $total_records."<br>";
                    $per_page = 8;
                    $total_pages = ceil($total_records/$per_page);
                    for($num=1;$num<=$total_pages;$num++) {
                    echo "<a href='images3.php?page=$num'> $num </a>";

                    }
                    ?>
					</section>
					
<!--scrollbar-->
 						<!--<div style="width: 1050px; height: 500px; overflow: auto; padding: 3px">-->
<!--images display-->
<?php



$result = mysqli_query($con, "SELECT * FROM image ORDER BY p_id DESC LIMIT $page1,8");
while($row = mysqli_fetch_array($result)){




	echo "<div class='col-md-3'><a href='comment3.php?id=".$row['p_id']."' title='".$row['p_title']."'><img src=".$row['p_img']." &nbsp; "."width='220px' height='200px'"."></a>";

	$id=['id'];

	$dellink="<a href='del3.php?id=".$row['p_id']."'>Delete</a>";
	$comment="<a href='comment3.php?id=".$row['p_id']."'>Comment</a>";


	echo   $dellink.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'. $comment . '<br/>'. '<br/></div>';


}
?>

				


</div>
</div>
</div>
</body>
</html>

