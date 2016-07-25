<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$ann_id=$_GET['ann_id'];

echo "id: ".$ann_id;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM announcement WHERE announcement_id='$ann_id'";

if (mysqli_query($conn, $sql)) {
    header("Location: archive.php");
} else {
    header("Location: archive.php");
}

mysqli_close($conn);
?>
