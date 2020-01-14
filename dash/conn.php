<?php
$servername = "localhost";
$username = "mica";
$password = "mica@autonomation";
$db="iot_master1";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
?>