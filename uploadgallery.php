	
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

$level = $_GET['f'];
if($level == 3) {
	header("Location: images.php");
} else if($level == 2) {
	header("Location: images2.php");
}


?>

