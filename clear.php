<?php
require "sqlconnection.php";

mysqli_query($con,"delete from attendance");
mysqli_query($con,"delete from coaching");
mysqli_query($con,"delete from comment1");
mysqli_query($con,"delete from cutoff");
mysqli_query($con,"delete from emp_data");
mysqli_query($con,"delete from holiday");
mysqli_query($con,"delete from image");
mysqli_query($con,"delete from inquiry");
mysqli_query($con,"delete from loan");
mysqli_query($con,"delete from logedit");
mysqli_query($con,"delete from overtime");
mysqli_query($con,"delete from tbl_leave");
mysqli_query($con,"delete from announcement");











?>