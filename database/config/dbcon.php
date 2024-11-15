<?php
$servername = "localhost";
$Email = "root";
$Password = "";
$dbname = "hardware_items";

// Create connection
$conn = new mysqli($servername, $Email, $Password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
