<?php
// Author: Gerald Dominic Pasion
// email: gerald.pasion@gmail.com


$emp_id=$_GET['emp_id'];

//update employee_status to "finalpay"
include 'dbconfig.php';

$sql = "UPDATE employee SET employee_status='finalpay' WHERE employee_id=$emp_id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


?>