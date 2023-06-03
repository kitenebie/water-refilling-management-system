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
    <title>Features</title>

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
        <!-- <a class="logo-text" href="{{ route('HomePage') }}">Jonel Water Refilling station</a> -->

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


    <!-- Header -->
    <header class="bgcolor pt-8 pb-6">
      <div class="container-prim">
        <h1 class="mb-0">Features we love</h1>
      </div> <!-- end of container-prim -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Features Cards-3 -->
    <section class="cards-3 bgcolor pb-12">
      <div class="container-prim grid">
        <div class="card">
          <div class="icon"><i class="fas fa-users-cog"></i></div>
          <h5>User Authentication and Inventory Management</h5>
          <p class="mb-0">With this system, customers can easily create an account and manage their refill requests and deliveries.</p>
        </div> <!-- end of card -->

        <div class="card">
          <div class="icon"><i class="fas fa-cog"></i></div>
          <h5>Manage Refill Requests and Sales Reports</h5>
          <p class="mb-0"> Customers can quickly and easily request refills through the user dashboard, and Jonel Water Refilling Station can manage and process these requests more efficiently. </p>
        </div> <!-- end of card -->

        <div class="card">
          <div class="icon"><i class="fas fa-archive"></i></div>
          <h5>Inventory Report and Automatic Stock Detection</h5>
          <p class="mb-0">Jonel Water Refilling Station also offers an inventory report and automatic stock detection feature. This allows them to monitor their inventory levels and automatically detect when stocks are running low.</p>
        </div> <!-- end of card -->

        <div class="card">
          <div class="icon"><i class="fas fa-address-card"></i></div>
          <h5>Reseller Request Dashboard and User Profile Management</h5>
          <p class="mb-0">This feature allows resellers to create an account and manage their orders and deliveries.</p>
        </div> <!-- end of card -->

        <div class="card">
          <div class="icon"><i class="fas fa-paper-plane"></i></div>
          <h5>Dashboard Delivery</h5>
          <p class="mb-0"> Jonel Water Refilling Station offers a dashboard delivery service.</p>
        </div> <!-- end of card -->
      </div> <!-- end of container-prim -->
    </section> <!-- end of cards-3 -->
    <!-- end of features cards-3 -->

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
