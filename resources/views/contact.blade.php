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
    <title>Contact</title>

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
        <h1 class="mb-0">Contact details</h1>
      </div> <!-- end of container-prim -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Contact Form-1 -->
    <section class="form-1 bgcolor pb-12">
      <div class="container-prim grid">
        <div class="text-container">
          <p>Thank you for your interest in Jonel Water Refilling Station! We are dedicated to providing safe and clean drinking water to our customers, and we are always happy to assist you with any questions or concerns you may have.</p>
          <p>You can contact us through various channels, depending on your preference:</p>
          <ul class="list-bullets li-space mb-3">
            <li>
              <i class="fas fa-circle"></i>
              <div>Phone: You can reach us at our hotline at (+63 987 456 123) during our operating hours (8:00am - 8:00pm). Our friendly staff will be happy to assist you with any inquiries you may have.</div>
            </li>
            <li>
              <i class="fas fa-circle"></i>
              <div>Email: If you prefer to contact us through email, you can send us a message at (jonelrefillingstation@gmail.com). We will do our best to respond to your message within 24 hours.</div>
            </li>
            <li>
              <i class="fas fa-circle"></i>
              <div>User Dashboard: If you are an existing customer, you can also contact us through our user dashboard. Simply log in to your account and navigate to the "Contact" page. You can send us a message, request a refill, or manage your orders through this platform.</div>
            </li>
            <li>
              <i class="fas fa-circle"></i>
              <div>Social Media: You can also reach out to us through our social media pages on Facebook and Instagram. Follow us on these platforms to stay updated on our latest promotions and news.</div>
            </li>
          </ul>
          <p class="mb-8">No matter how you choose to contact us, we will do our best to provide you with the assistance you need. We value your feedback and suggestions, and we are always looking for ways to improve our services. Thank you for choosing Jonel Water Refilling Station!</p>
          <div class="social-links">
            <h5 class="mb-4">Social links</h5>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div> <!-- end of social-links -->
        </div> <!-- end of text-container -->

        <div class="form-container">
          <!-- Contact Form -->
          <form>
            <input type="text" placeholder="First name" required>
            <input type="text" placeholder="Last name" required>
            <input type="email" placeholder="Email" required>
            <textarea placeholder="Message" required></textarea>
            <button type="submit" class="btn-submit"><b>Submit Message</b></button>
          </form>
          <!-- end of contact form -->
        </div> <!-- end of form-container -->
      </div> <!-- end of container-prim -->
    </section> <!-- end of form-1 -->
    <!-- end of contact form-1 -->


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
