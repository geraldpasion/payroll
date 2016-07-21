
<?php
include("dbconfig.php");

$target_path = "img/user/";
$target_path = $target_path.basename($_FILES['blogo']['name']);
move_uploaded_file($_FILES['blogo']['tmp_name'],$target_path);

?>