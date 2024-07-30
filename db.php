<?php
$host = 'localhost'; // MySQL host
$dbname = 'rachaellys_cataloguedb'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

// Establish database connection
try {
     // Create a new PDO instance and connect to the database
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set an attribute on the database handle to throw exceptions on errors
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If a connection error occurs, display the error message and terminate the script
    die("Database connection failed: " . $e->getMessage());
}
?>
