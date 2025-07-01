<?php
$host = "localhost";
$username = "root";
$password = ""; // or your actual password
$database = "heart"; // ✅ make sure this is the correct database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
