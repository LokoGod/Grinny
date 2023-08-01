<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file
require_once "db_connection.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = trim($_POST["username"]);
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM register WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
      // Prepare an insert statement
      $sql = "INSERT INTO register (username, password) VALUES (?, ?)";

      if ($stmt = mysqli_prepare($link, $sql)) {
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

          // Set parameters
          $param_username = $username;
          $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

          // Attempt to execute the prepared statement
          if (mysqli_stmt_execute($stmt)) {
              // Redirect to login page
              header("location: logIn.php");
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Css file -->
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

    <title>Feedback</title>
  </head>

  <body>
    <nav>
      <label for="name" id="logo-text">
        <a href="#">Grinny</a>
      </label>

      <input type="checkbox" id="check" />
      <label for="check" class="toggle">
        <i class="fa-solid fa-bars-staggered"></i>
      </label>

      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="features.html">Features</a></li>
        <li><a href="pricing.html">Pricing</a></li>
        <li><a href="contactUs.html">Contact</a></li>
        <li><a href="aboutUs.html">About</a></li>
        <li><a href="feedback.php" class="active">Feedback</a></li>
      </ul>

      <div id="account-container">
        <a href="register.php">Register</a>
        <a href="logIn.php">Login</a>
      </div>
    </nav>

    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    






<footer>
    <div id="footer-name">
      <h2>Grinny</h2>
      <p>
        Your Safety is Our Priority: Discover the Secure World of Our LLM
        Program!
      </p>
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
        <a href="contactUs.html">Developer</a>
        <a href="contactUs.html">Support</a>
        <a href="contactUs.html">Customer Service</a>
        <a href="contactUs.html">Get started</a>
        <a href="contactUs.html">Guide</a>
      </div>
    </div>
  </footer>