<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and validate email
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.');</script>";
    exit; // Stop further execution if email is invalid
  }

  // Sanitize description to prevent XSS attacks
  $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8');

  if (empty($email) || empty($description)) {
    echo "<script>alert('Please fill in all fields.');</script>";
  } else {
    // CAPTCHA validation (Assuming you are using reCAPTCHA)
    $captchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = 'SECRET_KEY'; // replace with your secret key
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) { // condition to determine responseKeys sucess
      // If CAPTCHA fails, show an alert to the user
      echo "<script>alert('Please confirm you are not a robot.');</script>";
    } else {
     // If CAPTCHA is successful, show a success message

      echo "<script>alert('Contact sent successfully.');</script>";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="./public/images/t1-logo.png" type="image/png" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="./styles/Navbar.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <!-----NAVBAR-------->
  <nav class="flex  justify-between gap-5 p-5 items-center bg-[#010409]">
    <img
      src="./public/images/t1-logo.png"
      alt="t1-logo.png"
      class="h-10" />
    <div class="flex gap-5">
      <a href="#">Home</a>
      <a href="#">Community</a>
      <a href="#">Shop</a>
      <a href="#">Careers</a>
      <a href="#">T1A</a>
      <a href="#">Membership</a>
      <a href="contact.php" class=" active-links">Contact</a>


      <a href="login.php" class="ml-[150px]">Login</a>
      <a href="#" class="">Register</a>

    </div>




    <div class="social-links flex gap-2">


      <a
        href="https://twitter.com/yourusername"
        target="_blank"
        aria-label="Twitter">
        <i class="fab fa-twitter"></i>
      </a>
      <a
        href="https://tiktok.com/@yourusername"
        target="_blank"
        aria-label="TikTok">
        <i class="fab fa-tiktok"></i>
      </a>
      <a
        href="https://youtube.com/c/yourchannel"
        target="_blank"
        aria-label="YouTube">
        <i class="fab fa-youtube"></i>
      </a>
      <a
        href="https://facebook.com/yourusername"
        target="_blank"
        aria-label="Facebook">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a
        href="https://instagram.com/yourusername"
        target="_blank"
        aria-label="Instagram">
        <i class="fab fa-instagram"></i>
      </a>


    </div>

    <script
      src="https://kit.fontawesome.com/d940da0c72.js"
      crossorigin="anonymous"></script>
    </div>
  </nav>

  <section class="w-full h-full flex  justify-center ">
    <div class="bg-image flex-1 bg-white">
      <img src="./public/images/t1-lol-worlds2-2023.jpg" alt="" class="h-full w-full">
    </div>
    <div class="bg-loginform flex-1 bg-black px-10 p-10 flex flex-col justify-center text-white">
      <h1 class="text-2xl font-bold tracking-wide">Contact Us</h1>
      <p class="pt-5 border-[#E0012C] pb-5 border-b-2">Want to connect or contact the T1?</p>


      <form action="contact.php" method="POST" class="flex gap-3 flex-col mt-5" id="contactForm">
        <label for="email" class="text-md font-bold">Email:</label>
        <input
          type="email"
          class="h-12 w-[300px] text-black p-5 rounded-md focus:border-blue-500 placeholder:text-gray-400"
          id="email"
          name="email"
          placeholder="Enter your email"
          style="outline: none;"
          required />

        <label for="description" class="text-md font-bold">Description:</label>
        <textarea
          id="description"
          class="h-24 w-[300px] text-black p-5 rounded-md focus:border-blue-500 placeholder:text-gray-400"
          placeholder="Enter your message"
          name="description"
          style="outline: none;"
          required></textarea>

        <div class="g-recaptcha" data-sitekey="KEY"></div> <!-- replace with your site key -->

        <button type="submit" class="bg-[#E0012C] cursor-pointer mt-4 p-2 w-[300px] font-bold text-xl rounded-lg">
          Submit
        </button>
      </form>


    </div>


  </section>

  <script>
    document.getElementById('contactForm').onsubmit = function(event) {
      event.preventDefault(); // Prevent default form submission
      this.submit(); // Submit the form via PHP
    };
  </script>

  <script src="https://kit.fontawesome.com/d940da0c72.js" crossorigin="anonymous"></script>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }
  </script>

  <script
    src="https://kit.fontawesome.com/d940da0c72.js"
    crossorigin="anonymous"></script>


</body>


</html>