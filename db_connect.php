<?php
$host = "localhost";
$username = "root";       // Change this if your DB username is different
$password = "";           // Change this if you set a DB password
$database = "enrollment stats"; // Your DB name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
