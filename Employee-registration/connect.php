<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employeemanager';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo "<script>console.log('Connection Failed :');</script>";
}
else{
    echo "<script>console.log('Database Connected :');</script>";
};