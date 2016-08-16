<script>
alert("ok");
</script>

<?php
/*
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
$sql = "UPDATE announcement SET announcement_archive = 'archive' WHERE announcement_id ='$ann_id'";
echo"success";
if (mysqli_query($conn, $sql)) {
    header("Location: announcementlist.php");
} else {
    header("Location: announcementlist.php");
}

mysqli_close($conn);
*/

$ann_id=$_GET['ann_id'];

$conn = new mysqli("localhost", "root", "", "payroll");

if($conn->connect_errno) {
	echo "Failed to connect to MySQL: ".$conn->connect_error;
}

$ann_id = $_GET['ann_id'];

$qryResult = $conn->query("
UPDATE announcement SET announcement_archive = 'archive' WHERE announcement_id ='$ann_id'
");

echo $conn->affected_rows > 0 ? "success" : "error";


?>
