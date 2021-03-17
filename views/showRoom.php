<?php

    $room = $_GET['room'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <title>show room</title>
</head>
<body>
<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-lg-2">
          <h1 class="mb-0 site-logo"><a href="index.php" class="mb-0">Tomato Store</a></h1>
        </div>

        <div class="col-12 col-md-10 d-none d-lg-block">
          <nav class="site-navigation position-relative text-right" role="navigation">

            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
              <li class="active"><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="login.php" class="nav-link">login</a></li>
            </ul>
          </nav>
        </div>

        <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">

          <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>
        </div>

      </div>
    </div>

  </header>
<section class="hero-section2" id="hero">
    <div class="container text-center my-5 pt-5">
    <img src="../assets/img/room<?php echo $room; ?>.jpg" alt="Image" class="img-fluid rounded w-75">
    </div>
</section>

<!-- Vendor JS Files -->
 <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <!-- <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <!-- <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script> -->
  <!-- <script src="../assets/vendor/php-email-form/validate.js"></script> -->
  <!-- <script src="../assets/vendor/aos/aos.js"></script> -->
  <!-- <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script> -->
  <script src="../assets/vendor/jquery-sticky/jquery.sticky.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>
</html>