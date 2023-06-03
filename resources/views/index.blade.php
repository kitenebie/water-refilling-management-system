<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content=""> <!-- website name -->
    <meta property="og:site" content=""> <!-- website link -->
    <meta property="og:title" content=""> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>Home</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="images/header-dashboardx.png">
  </head>
  <body>
    <!-- Navigation -->
    <nav>
      <div class="container-prim">
        <!-- Image Logo -->
        <a class="logo-image" href="{{ route('HomePage') }}"><img src="images/header-dashboard.png" alt="alternative"></a>

        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="logo-text" href="{{ route('HomePage') }}">Name</a> -->

        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div> <!-- end of hamburger -->

        <div class="navbar">
            <ul>
                <li><a href="{{ route('HomePage') }}">Home</a></li>
                <li><a href="{{ route('feature') }}">Features</a></li>
                <li><a href="{{ route('about_us') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <div class="access-buttons">
                <a class="btn btn-outline btn-sm" href="{{ route('log_in') }}">Log in</a>
                <a class="btn btn-sm" href="{{ route('sign_up') }}">Register</a>
            </div>
            </div> <!-- end of navbar -->
        </div> <!-- end of container-prim -->
    </nav> <!-- end of nav -->
    <!-- end of navigation -->


    <!-- Home Hero -->
    <header class="hero bgcolor">
    <div class="container-prim grid">
        <div class="text-container">
            <h1 class="h1-large">Jonel Water Refilling Station</h1>
            <p class="p-large mb-4">"Refreshing lives, one drop at a time - with Jonel Water Refilling Station."</p>
            <a class="btn btn-lg btn-outline" href="{{ route('log_in') }}"><b>Login</b></a>
            <a class="btn btn-lg" href="{{ route('sign_up') }}"><b>Register</b></a>
        </div> <!-- end of text-container -->

        <div class="image-container">
            <img class="main-photo" style="border-radius: 15px;"  src="images/article-image-3.jpg" alt="alternative">
        </div> <!-- end of image-container -->
        </div> <!-- end of container-prim -->
    </header> <!-- end of hero -->
    <!-- end of home hero -->


    <!-- Home Cards-1 -->
    <section class="cards-1 bgcolor pb-14 pt-6">
    <div class="container-prim grid grid-3">
        <div class="card">
            <h4>Water Quality</h4>
            <p class="mb-0">Jonel Water Refilling Station is dedicated to delivering superior quality drinking water to its clients that conforms to government guidelines and regulations for drinking water quality. Nevertheless, the company acknowledges that it cannot provide a complete guarantee that the water will be entirely free of impurities, nor can it ensure that the water will match individual preferences in terms of taste and smell.</p>
        </div> <!-- end of card -->
        <div class="card">
          <h4>Delivery Quality</h4>
          <p class="mb-0">Customers of Jonel Water Refilling Station have the option to have their orders delivered to their desired location. However, delivery charges and a minimum order quantity may apply. Additionally, the delivery times are subject to availability and may vary accordingly.</p>
        </div> <!-- end of card -->
        <div class="card">
          <h4>Refunds and Exchanges</h4>
          <p class="mb-0">Once Jonel Water Refilling Station has provided its water refilling services to customers, it does not allow any refunds or exchanges for the service provided.</p>
        </div> <!-- end of card -->
      </div> <!-- end of container-prim -->
    </section> <!-- end of cards-1 -->
    <!-- end of home cards-1 -->



    <!-- Footer -->
    <footer class="pt-8 pb-6">
      <div class="container-prim grid">
        <div class="about">
          <a href="{{ route('HomePage') }}"><img class="logo-image" src="images/header-dashboard.png" alt="alternative"></a>
          <p class="p-small">"Quench your thirst for pure and safe drinking water, only at Jonel Water Refilling Station."</p>
        </div> <!-- end of about -->
        <div class="contact">
          <h6>Contact</h6>
          <ul class="li-space">
            <li class="p-small"><i class="fas fa-phone-alt"></i>+63 987 456 123</li>
            <li class="p-small"><i class="fas fa-envelope"></i><a class="noline" href="jonelrefillingstation@gmail.com">jonelrefillingstation@gmail.com</a></li>
          </ul>
        </div> <!-- end of contact -->
        <div class="social">
          <h6>Social</h6>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div> <!-- end of social -->
      </div> <!-- end of container-prim -->
      <div class="container-prim">
        <p class="p-small mb-0">Copyright @ Byte Defender | <a class="noline" href="{{ route('terms') }}">Terms Conditions</a> | <a class="noline" href="{{ route('privacy') }}">Privacy Policy</a></p>
      </div> <!-- end of container-prim -->
    </footer> <!-- end of footer -->
    <!-- end of footer -->

    <!-- Scripts -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
  </body>
</html>
