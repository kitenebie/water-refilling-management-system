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
    <title>Terms</title>

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


    <!-- Header -->
    <header class="bgcolor pt-8 pb-6">
      <div class="container-sec">
        <h1 class="mb-0">Terms and Conditions for Jonel Water Refilling Station</h1>
      </div> <!-- end of container-sec -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Basic -->
    <section class="basic pt-12 pb-14">
      <div class="container-sec">
        <h2>1. Service and Payment Method</h2>
        <p class="mb-4">Welcome to Jonel Water Refilling Station. Please read these terms and conditions carefully before using our services. By using our services, you agree to be bound by these terms and conditions.</p>

        <h3>1.1 Quality of Service</h3>
        <p class="mb-4">Our primary goal is to provide high-quality purified water to our customers. We use advanced technology and equipment to ensure that our water is safe and healthy to drink. However, we do not guarantee that our water is free from all impurities or that it is suitable for all purposes. We recommend that you consult a doctor if you have any health concerns about drinking purified water.</p>

        <h3>1.2 Delivery</h3>
        <p class="mb-4">Jonel Water Refilling Station offers delivery services to its customers. Delivery fees and minimum order quantities may apply, and delivery times are subject to availability.</p>

        <h3>1.3 Payment and Refunds</h3>
        <ul class="list-bullets li-space mb-8">
          <li>
            <i class="fas fa-circle"></i>
            <div>We accept payment through cash or other accepted payment methods. We do not offer refunds on any purchases made. If you have any concerns about a purchase, please contact us immediately.</div>
          </li>
        </ul>

        <h2>2. Customer Responsibility</h2>
        <p class="mb-4">Customers are responsible for ensuring that the containers they provide for water refilling are clean, free from contamination, and are suitable for holding drinking water. Customers must also ensure that they transport the containers safely and securely.</p>

        <h2>3. Liability</h2>
        <p class="mb-4">Jonel Water Refilling Station is not liable for any damages or losses resulting from the use of its water refilling services, including but not limited to personal injury, property damage, or financial loss. Customers use Jonel Water Refilling Station's services at their own risk.</p>

        <h2>4. Termination of Services</h2>
        <p class="mb-4">Jonel Water Refilling Station reserves the right to terminate water refilling services to any customer at any time, for any reason, without prior notice.</p>

        <h2>5. Modification of Terms</h2>
        <p class="mb-4">Jonel Water Refilling Station reserves the right to modify these Terms and Conditions at any time, without prior notice. Customers are responsible for reviewing these Terms and Conditions regularly to ensure that they are aware of any changes.</p>

        <h2>6. Governing Law</h2>
        <p class="mb-4">These Terms and Conditions shall be governed by and construed in accordance with the laws of the jurisdiction in which Jonel Water Refilling Station operates. Any disputes arising from or relating to these Terms and Conditions shall be resolved in the courts of that jurisdiction.</p>

      </div> <!-- end of container-prim -->
    </section> <!-- end of basic -->
    <!-- end of basic -->


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
