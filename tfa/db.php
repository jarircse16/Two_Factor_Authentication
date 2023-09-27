<?php
$host = "localhost"; // Replace with your MySQL host (e.g., "localhost" or an IP address)
$username = "id21083165_user"; // Replace with your MySQL username
$password = "xD123@xD"; // Replace with your MySQL password
$dbname = "id21083165_user"; // Replace with the name of your MySQL database

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
