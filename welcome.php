<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: logIn.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
    <p>You have successfully logged in.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
