<html>
<head>
	<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert.css">
<script src="sweetalert2-master/dist/sweetalert.min.js"></script> 

</head>

<body bgcolor=black>

<?php


include ("functions.php");
include 'dbconfig.php';
$sched = $_POST['cutoffsched'];
$cutoff = $_GET['cutoff'];

echo 'yyyy: '.$cutoff;

$sched = urldecode($cutoff);
$submitdate = date("Y-m-d");
$schedArray = array();
$schedArray = split(" - ", $sched);

$emp_count=count_employees_within_cutoff($sched);
$timer=$emp_count*1000*2;
$seconds=$timer/1000;


//generate loading screen

echo '<script>
swal({
  title: "Calculating!",
  text: "Please wait... '.$seconds.' secs",
  imageUrl: "images/loading.gif",
  allowEscapeKey: false,
  showConfirmButton: false,
  allowOutsideClick: false,
  timer: '.$timer.'
});
</script>';

//from functions.php
compute($sched,0,0,0);

$sql = "UPDATE cutoff SET cutoff_status='Inactive', cutoff_submission='Submitted' WHERE cutoff_initial='$schedArray[0]' AND cutoff_end='$schedArray[1]'";

          if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
          } else {
              echo "Error updating record: " . $conn->error;
          }


echo '<script>
window.location = "processing2.php";
</script>';

?>


</body>
</html>