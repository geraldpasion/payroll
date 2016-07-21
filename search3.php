<?php
include("dbconfig.php");
    //database configuration
    $dbHost = 'localhost';
    $dbUsername = $user;
    $dbPassword = $pass;
    $dbName = 'payroll';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    session_start();
    //get search term
    $searchTerm = $_GET['term'];
   $team = $_SESSION['employee_team'];

    //get matched data from skills table
    $query = $db->query("SELECT employee_firstname, employee_lastname, employee_middlename, employee_id FROM employee WHERE (employee_firstname LIKE '%".$searchTerm."%' OR employee_lastname LIKE '%".$searchTerm."%') AND employee_team LIKE '$team' AND (employee_level LIKE 1 OR employee_level LIKE 2) AND employee_status = 'active'");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['employee_id'] ." ". $row['employee_firstname'] ." ". $row['employee_middlename']." ". $row['employee_lastname'];
		
    }
    
    //return json data
    echo json_encode($data);
?>

