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
    <title>Register</title>

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
    <header class="bgcolor pt-4 pb-2 mb-2">
      <div class="container-prim">
        <h1 class="mb-0 tcenter">Register</h1>
      </div> <!-- end of container-prim -->
    </header> <!-- end of header -->
    <!-- end of header -->
    <!-- Sign Up Form-2 -->
    <section class="form-2 mt-2 mb-8">
      <div class="container-ter">
        <div class="text-container bgcolor">
          
          <!-- Sign Up Form -->
          <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-div">
                <input hidden readonly id="Reseller_ID" name="Reseller_ID" type="text" required>
                <label for="">First Name</label>
                <input name="firstname" id="firstname" type="text" required>
                <label for="">Last Name</label>
                <input name="lastname" id="lastname" type="text" required>
                <label for="">Address</label>
                <select name="address" required id="">
                    @if(isset($addresses))
                        @foreach($addresses as $address)
                            <option value="{{ $address->Address }}">{{ $address->Address }}</option>
                        @endforeach
                    @endif
                </select>
                <label for="">Birthday</label>
                <input name="Birthday" type="date" required>
                <label for="">Contact Number</label>
                <input name="contact" id="contact" type="text" placeholder="Contact Number" value="09" required>
                <label for="">Email Address</label>
                <input name="username" id="username" type="email" placeholder="e.g., myemail@gmail.com" required>
                <label for="">Password</label> <span style="color: red; font-size: 13px !important" id="passwordError"></span>
                <input  type="password" id="password" required>
                <label for="">Confirm Password</label><span style="color: red; font-size: 13px !important" id="ConfpasswordError"></span>
                <input name="password" id="confirmPassword" type="password" required>
                <div class="cont"><br>
                  <p>Fill out the form to register. Already Registered? Then just <a class="colorprim" href="{{ route('log_in') }}">Log In</a></p>
                </div>
                <button id="btnreg" type="submit" class="btn-submit"><strong>Register</strong></button>
            </div>
          </form>

          <!-- end of sign up form -->
        </div> <!-- end of text-container -->
      </div> <!-- end of container-ter -->
    </section> <!-- end of form-2 -->
    <!-- end of sign up form-2 -->


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
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>

    @if ($errors->any())
        <script>
            toastr.error('Email address is already taken', 'REGISTER FAILED', {
                closeButton: true,
                tapToDismiss: true, // prevent the toast from disappearing when clicked
                newestOnTop: true,
                positionClass: 'toast-top-right', // set the position of the toast
                preventDuplicates: true,
            }, 5000);
        </script>
    @endif
    <!-- Scripts -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script>
        // Create a new jQuery document ready function
        $(document).ready(function() {
            // Create a new Date object
            var currentDate = new Date();
            // Get the month, day, and year
            var month = currentDate.getMonth() + 1; // Month (0-11), add 1 to get 1-12 range
            var day = currentDate.getDate(); // Day of the month
            var year = currentDate.getFullYear(); // 4-digit year
            // Generate a random number between 1 and 100
           var randomNumber = Math.floor(Math.random() * 999)+100;
            // Format the date as MM/DD/YYYY
            var formattedDate = ('0' + month).slice(-2) + '-' + year + '-' + day + ''+randomNumber;
            // Output the formatted date
            $('#Reseller_ID').val(formattedDate);
        });

    </script>

    <!-- Scripts -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>

    @if (session('success'))
    <script>
        toastr.success('Your application request has been sent successfully!', "Application Sent", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
    <script src="{{ asset('js/emailonly.js') }}"></script>
    <script src="{{ asset('js/textonly.js') }}"></script>
    <script src="{{ asset('js/numberonly.js') }}"></script>
    <script src="{{ asset('js/userpwd.js') }}"></script>
  </body>
</html>

