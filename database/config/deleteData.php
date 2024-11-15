<?php
require_once 'dbcon.php';

$item_id = $_POST['item_id'];

$sql = "DELETE FROM items WHERE item_id = '$item_id'";

if ($conn->query($sql) === TRUE) {
    
  header('Location: ../index.php');
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>