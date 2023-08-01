<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file
require_once "db_connection.php";

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validate credentials
    if (empty($username)) {
        $username_err = "Please enter your username.";
    }

    if (empty($password)) {
        $password_err = "Please enter your password.";
    }

    // Check input errors before verifying the user
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM register WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css file -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/logIn.css">

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous">
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;700&display=swap"
      rel="stylesheet">

    <!-- Fontawesome cdn link -->
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Log-In</title>
  </head>

  <body class="container">
    <nav>

      <label for="name" id="logo-text">
        <a href="index.html">Grinny</a>
      </label>

      <input type="checkbox" id="check">
      <label for="check" class="toggle">
        <i class="fa-solid fa-bars-staggered"></i>
      </label>

      <ul>
        <li><a href="index.html" class="active">Home</a></li>
        <li><a href="features.html">Features</a></li>
        <li><a href="pricing.html">Pricing</a></li>
        <li><a href="contactUs.html">Contact</a></li>
        <li><a href="aboutUs.html">About</a></li>
        <li><a href="feedback.php">Feedback</a></li>
      </ul>

      <div id="account-container">
        <a href="register.php">Register</a>
        <a href="logIn.php">Login</a>
      </div>
    </nav>

    <div class="panel">
        <div class="state">
            <br>
            <i class="fa fa-unlock-alt"></i>
            <br>
            <h1>Log in</h1>
        </div>
        <div class="form">
            <form action="logIn.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group text-center">
                    <button class="wide-button" type="submit">Login</button>
                </div>
            </form>
        </div>
        <div class="fack"><a href="register.php"><i class="fa fa-question-circle"></i>Or register with us</a></div>
    </div>

    <script>
        // JavaScript to handle form submission (replace the dummy check with actual form submission)
        // For real implementation, the form should be submitted to the login_backend.php file.
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            var username = document.querySelector('input[name="username"]').value;
            var password = document.querySelector('input[name="password"]').value;

            if (false) {
                // If login is successful, redirect the user to the welcome page
                window.location.href = "welcome.php";
            } else {
                // If login fails, show an error message
                var stateDiv = document.querySelector('.state');
                stateDiv.innerHTML = '<br><i class="fa fa-ban"></i><br><h2>Error</h2>The email or password you entered is incorrect, please try again.';
                stateDiv.style.color = '#eb5638';
            }
        });
    </script>

</body>

</html>