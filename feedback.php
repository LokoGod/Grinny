<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // GET the current URL
    $current_url = urlencode("http://localhost/missaka_repo/feedback.php" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    // Redirect to login
    header("Location: logIn.php?returnUrl=$current_url");
    exit;
}
require_once "db_connection.php";

// Check if the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // GET data
  $username = $_SESSION["username"];
  $feed = htmlspecialchars($_POST["feedback"]);

  // Insert the data into DB
  $stmt = $link->prepare("INSERT INTO feedback (username, feedback) VALUES (?,?)");

  // Binding data
  $stmt->bind_param('ss', $username,$feed);

  // SQL Execution
  if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Feedback received successfully.</div>';
  } else {
    echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
  }

  $stmt->close();
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

    <title>Feedback</title>
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
        <li><a href="feedback.php" class="active">Feedback</a></li>
      </ul>

      <div id="account-container">
        <a href="register.php">Register</a>
        <a href="logIn.php">Login</a>
      </div>
    </nav>

    <br><br>
    <h2 class="text-center">Tell us what you think of our product</h2>
    <p class="text-center">We could use your feedback to make our LLM better for everyone</p>
    <br><br>
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
      echo "<div class='text-center'> Welcome, " . htmlspecialchars($_SESSION["username"]) . "!";
    } else {
      echo "<div class='text-center'>You are not logged in.</div>";
    }
    ?>

    <div class="container text-center">
      <form id="feedback-form" action="feedback.php" method="post">
      <br>
        <textarea class="form-control" id="feedback-text" name="feedback"
          rows="4" cols="50" placeholder="We'd love to hear your feedback!"></textarea><br>
        <input class='btn btn-primary' type="submit" value="Submit">
      </form>

      <style>
        .container {
        display: flex;
        justify-content: center;
      }

      #feedback-form {
        max-width: 400px;
      }

    </style>
    </div>
    <br><br>

    <h3 class="text-center">Our Testimonials</h3><br>
    <style>
        .card-container {
            margin: 10px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .user-icon {
            color: #5A4FDC;
            font-size: 2rem;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <?php
            require_once "db_connection.php";

            // Fetch data from DB
            $sql = "SELECT * FROM feedback";
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $idfeedback = $row['idfeedback'];
                $username = $row['username'];
                $feedback = $row['feedback'];
                ?>
                    <div class="col-sm-4 col-md-3 card-container">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $username; ?></h5>
                                <p class="card-text"><?php echo $feedback; ?></p>
                                <i class="fa-solid fa-user user-icon"></i>
                            </div>
                        </div>
                    </div>
            <?php
              }
            } else {
              echo '<div class="col-12 text-center">No feedback data available.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }

            $link->close();
            ?>
        </div>
    </div>

  </body>
  <br /><br />

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