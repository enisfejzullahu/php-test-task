<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username (default is 'root' in MAMP)
$password = "root"; // Your MySQL password (default is 'root' in MAMP)
$database = "users"; // Your database name
$port = 3307; // MySQL port number (default is 3306)

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

