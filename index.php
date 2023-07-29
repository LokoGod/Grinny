<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Css file -->
  <link rel="stylesheet" href="styles/style.css">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  
  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;700&display=swap" rel="stylesheet">


  <!-- Fontawesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Home</title>
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
      <li><a href="#" class="active">Home</a></li>
      <li><a href="#">Features</a></li>
      <li><a href="#">Pricing</a></li>
      <li><a href="#">Contact US</a></li>
      <li><a href="#">About</a></li>
    </ul>

    <div id="account-container">
      <a href="#">Register</a>
      <a href="#">Login</a>
    </div>
  </nav>

  <header>
    <div id="header-container">
      <div id="header-page-title">
        <h1>Creative landing <br> page</h1>
        <p>A creative & modern landing page with lazer
          <br> Template& we love make this amaging
        </p>
        <div id="header-subscribe-form">
          <input type="email" name="" id="" placeholder="Enter your email">
          <input type="submit" value="Subscribe">
        </div>
      </div>
      <div id="header-page-image">
        <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSxNAKZmyBqAAnvGhwSVyZAOWAYl7D_-kz5xjD-YBVZX-raEA3A" alt="">
      </div>
    </div>
  </header>

  <section class="awesome-feature">
    <div id="feature-text">
      <h1>Awesome Features</h1>
      <p>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Fugiat reprehenderit nesciunt magnam
        dolorem voluptate earum nihil, <br> enim similique libero labore nulla natus repellat esse assumenda.
      </p>
    </div>
  </section>

  <section id="creativity-features">

    <div id="creativity-features-image">
      <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcT4GvoUrEfrFfkPddQvyNU8XDftwZJcPXb30KM_lIxJUO5EyiA1" alt="">
    </div>

    <div id="creativity-features-text">
      <h1>CREATIVE FEATURES</h1>
      <h3>Build community & conversion <br>
        with our suite of social tool</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sed ea eveniet possimus dignissimos
        error harum deleniti minus nostrum tempore, ipsum quas quibusdam! Voluptates fugiat cumque sequi totam
        debitis animi libero iure magnam itaque neque.</p>

      <div class="creative-footer-text">
        <p>Donec pede justo fringilla vel nec. <br>
          cras ultricies li eu turpis hendrerit fringilla.</p>
      </div>
      <div id="creativity-btn">
        <a href="#">Read More</a>
        <a href="#">Buy Now</a>
      </div>
    </div>

  </section>

  <section class="awesome-feature">
    <div id="feature-text">
      <h1>Choose your plan</h1>
      <p>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Fugiat reprehenderit nesciunt magnam
        dolorem voluptate earum nihil, <br> enim similique libero labore nulla natus repellat esse assumenda.
      </p>
    </div>
  </section>

  <section id="plan-container">
    <div class="plan-item">
      <div class="plan-money">
        <i class="fa-solid fa-user"></i>
        <h2>Simple</h2>
        <h1><span>$</span>19</h1>
        <p>user / month</p>
      </div>

      <div class="plan-benifit">
        <p>Bandwith: 1GB</p>
        <p>OnlineSpace: 512MB</p>
        <p>Support: <strong>Yes</strong></p>
        <a href="#">Buy Now</a>
      </div>
    </div>
    <div class="plan-item">
      <div class="plan-money">
        <i class="fa-solid fa-user"></i>
        <h2>Basic</h2>
        <h1><span>$</span>49</h1>
        <p>user / month</p>
      </div>

      <div class="plan-benifit">
        <p>Bandwith: 3GB</p>
        <p>OnlineSpace: 2GB</p>
        <p>Support: <strong>Yes</strong></p>
        <a href="#">Buy Now</a>
      </div>
    </div>
    <div class="plan-item">
      <div class="plan-money">
        <i class="fa-solid fa-user"></i>
        <h2>Pro</h2>
        <h1><span>$</span>89</h1>
        <p>user / month</p>
      </div>

      <div class="plan-benifit">
        <p>Bandwith: 5GB</p>
        <p>OnlineSpace: 4GB</p>
        <p>Support: <strong>Yes</strong></p>
        <a href="#">Buy Now</a>
      </div>
    </div>
  </section>

 


  

  <footer>
    <div id="footer-name">
      <h2>Creative Learner</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
      <div id="footer-social-icon">
        <i class="fa-brands fa-instagram"></i>
        <i class="fa-brands fa-twitter"></i>
        <i class="fa-brands fa-linkedin"></i>
        <i class="fa-brands fa-facebook"></i>
      </div>
    </div>
    <div class="footer-link">
      <h4>ABOUT US</h4>
      <div>
        <a href="#">Works</a>
        <a href="#">Strotragy</a>
        <a href="#">Release</a>
        <a href="#">Press</a>
        <a href="#">mission</a>
      </div>
    </div>
    <div class="footer-link">
      <h4>CUSTOMERS</h4>
      <div>
        <a href="#">Tranding</a>
        <a href="#">Popular</a>
        <a href="#">Customers</a>
        <a href="#">Features</a>
      </div>
    </div>
    <div class="footer-link">
      <h4>SUPPORT</h4>
      <div>
        <a href="#">Developer</a>
        <a href="#">Support</a>
        <a href="#">Customer Service</a>
        <a href="#">Get started</a>
        <a href="#">Guide</a>
      </div>
    </div>
  </footer>

</body>

</html>