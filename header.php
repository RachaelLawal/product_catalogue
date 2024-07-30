<?php
session_start(); // Start session for user authentication

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect to login if not logged in
if (!isLoggedIn() && basename($_SERVER['PHP_SELF']) !== 'login.php' && basename($_SERVER['PHP_SELF']) !== 'register.php') {
    header("Location:login.php"); //The `header` function sends a raw HTTP header to the browser to redirect to 'login.php'
    exit(); // Used the `exit()` function to stop the execution of the script after sending the redirect header
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rachaellys Accessories Catalogue</title>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
    <header>
        <h1>Rachaellys Accessories Catalogue</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isLoggedIn()): ?>
                    <li><a href="add_product.php">Add Product</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
