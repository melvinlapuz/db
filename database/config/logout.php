<?php
// Start the session
session_start();

// Destroy all session variables (log the user out)
session_unset();  // Remove all session variables
session_destroy();  // Destroy the session

// Redirect the user to the home page or login page after logging out
header("Location: ../admin/admin.php");  // or you can redirect to login.php
exit();
?>