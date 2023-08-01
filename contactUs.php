<?php
// Include the database connection file
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Prepare and execute the SQL query
  $sql = "INSERT INTO contact (email, subject, message) VALUES ('$email', '$subject', '$message')";
  if (mysqli_query($link, $sql)) {
    echo '<div class="alert alert-success" role="alert">Message recieved succesfully!</div>';
  } else {
    echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . mysqli_error($link)."</div>";
  }

  // Close the database connection
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

    <title>Contact</title>

    <style>
      /* Add custom CSS for additional styling if needed */
      body {
        padding-top: 20px;
      }
      .image-container {
        max-width: 100%;
      }
      .form-container {
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
      }
    </style>

  </head>

  <body>

    <nav>

      <label for="name" id="logo-text">
        <a href="#">Grinny</a>
      </label>

      <input type="checkbox" id="check">
      <label for="check" class="toggle">
        <i class="fa-solid fa-bars-staggered"></i>
      </label>

      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="features.html">Features</a></li>
        <li><a href="pricing.html">Pricing</a></li>
        <li><a href="contactUs.php" class="active">Contact</a></li>
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
    <div class="row">
      <!-- Image on the left -->
      <div class="col-md-6">
        <div class="image-container">
          <img src="https://www.maga.lk/wp-content/uploads/2018/03/4-NSBM.jpg" class="img-fluid" alt="NSBM">
        </div>
      </div>
      <!-- Form on the right -->
      <div class="col-md-6">
        <div class="form-container">
          <p>Reach us through our <a href="https://www.nsbm.ac.lk/">website</a></p>
          <p><strong>Or</strong></p>
          <p>Send us a message</p>
          <form action="contactUs.php" method="post"> <!-- Update the form action -->
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="E-mail">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="subject" placeholder="Subject">
            </div>
            <div class="mb-3">
              <textarea class="form-control" name="message" placeholder="Message" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
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