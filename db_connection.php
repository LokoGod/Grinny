<?php

// Replace these variables with your actual database credentials
$servername = "localhost:8111";
$username = "root";
$password = "";
$dbname = "missaka";

$link = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>