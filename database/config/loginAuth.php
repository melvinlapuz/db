<?php 
session_start();
require_once "dbcon.php";

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    
        header("Location: ../admin/admin.php");
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["username"];
  }
}else {
    header("Location: ../admin/admin.php");
        $_SESSION["invalid"] = "Invalid username or password";
}

mysqli_close($conn);
?>
