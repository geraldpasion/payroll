<?php


$announcement_val=$_POST['ann_val'];
$ann_id=$_POST['ann_id'];
$subject_val=$_POST['sebject_val'];

//$ann_id = 10;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

echo "announcement_val: ".$announcement_val;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE announcement SET announcement_details='$announcement_val', subject='$subject_val' WHERE announcement_id='$ann_id'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

header('location:announcementlist.php');

?>