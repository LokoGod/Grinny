<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file
require_once "db_connection.php";

// Start session
session_start();

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT idregister, username, password FROM register WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_regenerate_id();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: feedback.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
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
            <li><a href="contactUs.php">Contact</a></li>
            <li><a href="aboutUs.html">About</a></li>
            <li><a href="feedback.php">Feedback</a></li>
        </ul>

        <div id="account-container">
            <a href="register.php">Register</a>
            <a href="logIn.php">Login</a>
        </div>
    </nav>

    <br><br>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Log in</h3>
                        <form action="logIn.php" method="post" class="needs-validation" novalidate>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username"
                                    required>
                                <div class="invalid-feedback">
                                    Please enter your username.
                                </div><br>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required>
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>
                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="register.php">Or register with us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    // Bootstrap form validation
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
