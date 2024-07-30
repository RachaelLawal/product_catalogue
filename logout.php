<?php
session_start();
session_destroy(); // Destroy session data

// Redirect to login page after logout
header("Location:login.php");
exit();
?>
