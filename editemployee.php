<?php 
echo var_dump($_POST);
include("dbconfig.php");
$employeeid = $_POST['employeeid'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$gender = $_POST['gender'];
$birthday = date("Y-m-d",strtotime($_POST['daterange']));
$marital = $_POST['marital'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$type = $_POST['employeetype'];
$department = $_POST['department'];
$rate = $_POST['rate'];
$taxcode = $_POST['taxcode'];
$philhealth = $_POST['philhealth'];
$hdmf = $_POST['pagibig'];
$paymentSched = $_POST['cutoff'];
$tin = $_POST['tin'];
$sss = $_POST['sss'];
$shift = $_POST['shift'];
$empstat = $_POST['employeestatus'];
$shift = str_replace(' ', '', $shift);
$shift = substr_replace($shift, '', 5, 1);
$shift = date("H:i", strtotime($shift));
$shift2 = $_POST['shift2'];
$shift2 = str_replace(' ', '', $shift2);
$shift2 = substr_replace($shift2, '', 5, 1);
$shift2 = date("H:i", strtotime($shift2));
$shift = $shift."-".$shift2;
$restday = $_POST['restday']."/".$_POST['restday2'];
$datehired = date("Y-m-d",strtotime($_POST['daterange2']));
$jobtitle = $_POST['jobtitle'];
$password = $_POST['password'];
$level = $_POST['level'];
$team = $_POST['team'];

// $target_Folder = "upload/";
// $uid = $_POST['userID'];
// $target_Path = $target_Folder.basename( $_FILES['picture']['name'] );
// $savepath = $target_Path.basename( $_FILES['picture']['name'] );
// $file_name = $_FILES['picture']['tmp_name'];
// $image = $target_Folder . $file_name;
// $mysqli->query("INSERT INTO image (p_id,p_img) VALUES ('$uid','$image')");


// insert the new record into the database
		if ($stmt = $mysqli->prepare("UPDATE employee SET employee_lastname = '$lastname', employee_firstname = '$firstname', employee_middlename = '$middlename', employee_gender = '$gender', employee_birthday = '$birthday', employee_marital = '$marital', employee_address = '$address', employee_city = '$city', employee_zip = '$zip', employee_email = '$email', employee_cellnum = '$mobile', employee_type = '$type', employee_jobtitle = '$jobtitle', employee_department = '$department', employee_empstatus = '$empstat', employee_taxcode = '$taxcode', employee_sss = '$sss', employee_philhealth = '$philhealth', employee_pagibig = '$hdmf', employee_tin = '$tin', employee_shift = '$shift', employee_datehired = '$datehired', employee_restday = '$restday',employee_password = '$password', employee_level = '$level', employee_team = '$team', cutoff = '$paymentSched' WHERE employee_id = '$employeeid'")){	
			$stmt->execute();
			$stmt->close();
				if(!isset($_POST['picture'])){
					$imagesize = 1;
					$uploadOk = 1;
					include('sqlconnection.php');

					if ($_FILES["picture"]["size"] > 50000000) {
					   // echo "Sorry, your file is too large.";
					    $imagesize = 0;
					}

					$check = getimagesize($_FILES["picture"]["tmp_name"]);
					if($check !== false) {
					  //  echo "";
					    $uploadOk = 1;
					} else {
					  //  echo "File is not an image.";
					    $uploadOk = 0;
					}

					$name = $_FILES['picture']['name'];
					$tmp_name = $_FILES['picture']['tmp_name'];
						
					$location = 'images/';
					$target = 'images/'.$name;

					if($imagesize == 1) {
						if( $uploadOk == 1) {
							if(move_uploaded_file($tmp_name,$location.$name)) {
								$nam = $_POST['userID'];
								//$query = mysqli_query($con, "INSERT INTO image(p_id,p_img)VALUES('$nam','".$target."')");
								$image_name = mysql_real_escape_string($_FILES['picture']['name']);
								$mysqli->query("UPDATE employee SET image = '$image_name' WHERE employee_id = '$employeeid'");
							}else{
								//echo "file not uploaded";
							}
						}else{
							//echo "";
						}
					}else{
						//echo "";
					}
				}
		}
		else{
			echo "ERROR: could not prepare SQL statement.";
		}


// redirec the user
header("Location: employeelist.php?edited");
?>