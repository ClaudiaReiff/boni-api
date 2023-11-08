<?php

// Set the database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "boni_app";

try {
    // Create a new PDO instance for the database connection
    $pdo = new PDO("mysql:host=$servername; dbname=$database", $username, $password);

    // Set the error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there is an error, display the error message and exit
    die("Connection failed: " . $e->getMessage());
}
?>