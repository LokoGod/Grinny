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
      </ul>

      <div id="account-container">
        <a href="register.php">Register</a>
        <a href="logIn.php">Login</a>
      </div>
    </nav>

    <div class="panel">
      <div class="state"><br><i class="fa fa-unlock-alt"></i><br><h1>Log in</h1></div>
      <div class="form">
        <input placeholder='Email' type="email" required>
        <input placeholder='Password' type="password" required>
        <button class="wide-button" type="submit">Login</button>
      </div>
      <div class="fack"><a href="register.php"><i class="fa fa-question-circle"></i>Or register with us</a></div>
    </div>

    <script>
      $(document).ready(function() {
  return $('.login').click(function(event) {
    if (false) {

    } else {
      return $('.state').html('<br><i class="fa fa-ban"></i><br><h2>Error</h2>The email or password you entered is incorrect, please try again.').css({
        color: '#eb5638'
      });
    }
  });
});
    </script>

  </body>