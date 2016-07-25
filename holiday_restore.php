<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$holidayid=$_GET['holidayid'];

echo "id: ".$holidayid;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "UPDATE holiday SET holiday_archive = 'active' WHERE holiday_id ='$holidayid'";

if (mysqli_query($conn, $sql)) {
    header("Location: archive.php");
} else {
    header("Location: archive.php");
}

mysqli_close($conn);
?>
