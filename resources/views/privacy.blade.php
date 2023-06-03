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
    <title>Privacy</title>

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
        <h1 class="mb-0">Privacy Policy for Jonel Water Refilling Station</h1>
      </div> <!-- end of container-sec -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Basic -->
    <section class="basic pt-12 pb-14">
      <div class="container-sec">
        <p>At Jonel Water Refilling Station, we take the privacy and security of our customers' personal information very seriously. This Privacy Policy explains how we collect, use, and protect your personal information when you use our water refilling services.</p>
        <h2>1. Collection of Personal Information</h2>
        <p class="mb-4"></p>

        <h3>1.1 Conditions for privacy</h3>
        <p class="mb-4">We collect personal information from you when you use our water refilling services, including your name, contact information, and other information necessary to provide our services.</p>

        <h3>1.2 Use of Personal Information</h3>
        <ul class="list-bullets li-space mb-8">
            <div>We use your personal information to provide our water refilling services, and communicate with you about your orders. We may also use your personal information to improve our services and to send you promotional offers and other marketing materials.</div>
        </ul>

        <h2>2. Protection of Information</h2>
        <p class="mb-4"></p>

        <h3>2.1 Personal Information</h3>
        <p>We take reasonable steps to protect your personal information from unauthorized access, use, or disclosure. We use secure servers and encryption technology to protect your personal information.</p>

        <h4>2.2 Sharing of Personal Information</h4>
        <p>We do not share your personal information with third parties, except as necessary to provide our water refilling services, process payments, or comply with legal obligations.</p>

        <h4>2.3 Retention of Personal Information</h4>
        <ul class="list-bullets li-space mb-4">
          <li>
            <i class="fas fa-circle"></i>
            <div>We retain your personal information for as long as necessary to provide our services and for as long as required by law.</div>
          </li>
          <li>
            <i class="fas fa-circle"></i>
            <div>You have the right to access, correct, or delete your personal information that we hold. You may also opt-out of receiving promotional offers and marketing materials from us.</div>
          </li>
          <li>
            <i class="fas fa-circle"></i>
            <div>We may use cookies to collect information about your use of our website and to improve our services. You may disable cookies in your web browser if you prefer.</div>
          </li>
        </ul>

        <h3>2.4 Third-Party Websites</h3>
        <p class="mb-8">Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these websites.</p>

        <h2>3. Children's Privacy</h2>
        <p class="mb-8">Our services are not intended for children under the age of 13. We do not knowingly collect personal information from children under the age of 13.</p>

        <h2>4. Changes to Privacy Policy</h2>
        <p class="mb-8">We may update this Privacy Policy from time to time. Any changes will be posted on our website and will become effective when posted.</p>

        <p>If you have any questions or concerns about our Privacy Policy, please contact us at <strong>jonelrefillingstation@gmail.com</strong>.</p>
        <!-- end of textbox -->
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
