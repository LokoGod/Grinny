<?php

// Replace these variables with your actual database credentials
$servername = "localhost:8111";
$username = "root";
$password = "";
$dbname = "missaka";

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Display a message if the connection is successful (optional)
    // echo "Connected successfully";
} catch (PDOException $e) {
    // Display an error message if the connection fails
    die("Connection failed: " . $e->getMessage());
}

?>