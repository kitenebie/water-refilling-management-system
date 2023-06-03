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
    <title>Under Review</title>

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
            <div class="access-buttons">
                <a class="btn btn-sm" href="{{ route('HomePage') }}">Home</a>
            </div>
        </div> <!-- end of navbar -->
      </div> <!-- end of container-prim -->
    </nav> <!-- end of nav -->
    <!-- end of navigation -->


    <!-- Header -->
    <header class="bgcolor pt-2 pb-4">
      <div class="container-prim">
        <h1 class="mb-0 tcenter">Under Review</h1>
      </div> <!-- end of container-prim -->
    </header> <!-- end of header -->
    <!-- end of header -->

    <!-- Log In Form-2 -->
    <section class="form-2 mt-2 mb-8">
        <div class="container-ter">
            <div class="text-container bgcolor">
                <p style="text-align:center; font-size: 1.4em">
                    Hello <strong>{{ $applicantData['fullName'] }}</strong>. Your account is under review. Please check your email
                     for an update from our admin.
                     Thank you for your patience.</p>
                    <span style="font-size: .8em; font-weight:600;"><i>User ID: {{ $applicantData['userID'] }}</i></span>
        </div> <!-- end of text-container -->
      </div> <!-- end of container-ter -->
    </section> <!-- end of form-2 -->
    <!-- end of log in form-2 -->

    <!-- Scripts -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->

  </body>
</html>
