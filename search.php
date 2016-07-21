<?php
include("dbconfig.php");
    //database configuration
    $dbHost = 'localhost';
    $dbUsername = $user;
    $dbPassword = $pass;
    $dbName = 'payroll';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT employee_firstname, employee_lastname, employee_middlename, employee_id, employee_status FROM employee WHERE (employee_firstname LIKE '%".$searchTerm."%' OR employee_lastname LIKE '%".$searchTerm."%' OR employee_middlename LIKE '%".$searchTerm."%') AND employee_status = 'active'");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['employee_id'] ." ". $row['employee_firstname'] ." ". $row['employee_middlename'] ." ". $row['employee_lastname'];
		
    }
    
    //return json data
    echo json_encode($data);
?>