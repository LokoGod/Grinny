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

    <title>Features</title>
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
        <li><a href="features.html" class="active">Features</a></li>
        <li><a href="pricing.html">Pricing</a></li>
        <li><a href="contactUs.html">Contact</a></li>
        <li><a href="aboutUs.html">About</a></li>
      </ul>

      <div id="account-container">
        <a href="register.php">Register</a>
        <a href="logIn.php">Login</a>
      </div>
    </nav>

    <div class="container text-center">
      <form id="feedback-form" action="feedback.php" method="post">
      <br><br><br><br>
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
        max-width: 400px; /* Adjust the maximum width to your preference */
      }

    </style>
    </div>

    <?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the textarea
    $feed = $_POST["feed"];

    // Validate and sanitize the data (optional but recommended)
    // htmlspecialchars() helps prevent XSS (Cross-Site Scripting) attacks
    $feed = htmlspecialchars($feed);

    // Include the database connection file
    require_once "db_connection.php";

    // Insert the data into the database
    try {
    // Prepare the SQL statement with a placeholder
    $stmt = $conn->prepare("INSERT INTO feedback (id, feedback) VALUES (:feed)");

    // Bind the data to the placeholder
    $stmt->bindParam(':feed', $feed);

    // Execute the SQL statement
    $stmt->execute();

    // Display a success message
    echo "Feedback recieved successfully.";
    } catch (PDOException $e) {
    // Display an error message if something went wrong
    echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
    }
    ?>

  </body>
</html>