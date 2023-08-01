<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "db_connection.php";

// Defining variables & initializing with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);

  // Validating username
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
    $username_err = "Username can only contain letters, numbers, and underscores.";
  } else {
    // SQL SELECT Query
    $sql = "SELECT id FROM register WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Binding variables
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Setting up parameters
      $param_username = trim($_POST["username"]);

      // Attempting to execute statements
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $username_err = "This username is already taken.";
        } else {
          $username = trim($_POST["username"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      mysqli_stmt_close($stmt);
    }
  }

  // Validating password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validating confirmation password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }

  // Check input errors
  if (
    empty($username_err) && empty($password_err) &&
    empty($confirm_password_err)
  ) {
    // SQL Insertion statement
    $sql = "INSERT INTO register (username, password) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

      // Setting up parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

      // Attempting to execute statements
      if (mysqli_stmt_execute($stmt)) {
        // Redirecting to login page
        header("location: logIn.php");
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      mysqli_stmt_close($stmt);
    }
  }
  mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS file -->
    <link rel="stylesheet" href="styles/style.css" />

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;700&display=swap"
      rel="stylesheet" />

    <!-- Fontawesome cdn link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />

    <title>Register</title>
  </head>

  <body>
    <nav>
      <label for="name" id="logo-text">
        <a href="index.html">Grinny</a>
      </label>

      <input type="checkbox" id="check" />
      <label for="check" class="toggle">
        <i class="fa-solid fa-bars-staggered"></i>
      </label>

      <ul>
        <li><a href="index.html">Home</a></li>
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

    <br>
    <div class="card text-center container">
      <div class="card-header wrapper text-center">
        <h3><strong>Register</strong></h3>
      </div>
      <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          method="post" class="mx-auto" style="max-width: 400px;">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username"
              class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
              value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"
              class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
              value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password"
              class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
              value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
          </div>
          <br>
          <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
          </div>
          <br>
          <p>Already have an account? <a href="logIn.php">Login here</a>.</p>
        </form>
      </div>
      <div class="card-footer text-body-secondary">
        <p><strong>Please fill this form to create an account.</strong></p>
      </div>
    </div>
    <br>

    <footer>
      <div id="footer-name">
        <h2>Grinny</h2>
        <p>© Copyright NSBM 2023. Designed and Developed by Web Group 55</p>
        <div id="footer-social-icon">
          <i class="fa-brands fa-instagram"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-linkedin"></i>
          <i class="fa-brands fa-facebook"></i>
        </div>
      </div>

      <div class="footer-link"></div>

      <div class="footer-link">
        <h4>About Us</h4>
        <div>
          <a href="aboutUs.html">Projects</a>
          <a href="aboutUs.html">Strategies</a>
          <a href="aboutUs.html">Press</a>
          <a href="aboutUs.html">Mission</a>
        </div>
      </div>
      <div class="footer-link">
        <h4>Support</h4>
        <div>
          <a href="contactUs.php">Developer</a>
          <a href="contactUs.php">Support</a>
          <a href="contactUs.php">Customer Service</a>
          <a href="contactUs.php">Get started</a>
          <a href="contactUs.php">Guide</a>
        </div>
      </div>
    </footer>

</body>
</html>