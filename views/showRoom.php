<?php
include "../action/itemAction.php";

if(empty($_SESSION)){
  session_unset();
  session_destroy();
}
$room = $_GET['room'];
$item = new Item();
  //number of items in cart
  if(isset($_SESSION['username'])){
    $cart_num = $item->countCart($_SESSION['username']);
  }
  $cart_num = 0;
  $num_format = 10101;

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

<!-- ======= Mobile Menu ======= -->
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <!-- ======= Header ======= -->
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
              <li>
              <?php
                if(!isset($_SESSION['username'])){
              ?>
                  <a href="login.php" class="nav-link">login</a>
              <?php                   
                }else{
                  if($_SESSION['status'] == 'A'){
              ?>
                    <a href="addItem.php" class="nav-link">addItem</a></li>
              <?php 
                  }
                  ?>
                  <a href="logout.php" class="nav-link">logout</a></li>
                  <li><a href="cart.php" class="nav-link">cart <?php if($cart_num > 0){ echo '&#'. ($num_format + $cart_num); }; ?></a></li>
              <?php
                } ?> 
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
    <?php
      $room_items = $item->displayRoomItem($room);

      if(!$room_items){
    ?>
      <div class="col-md-12">
        <p>No Records Found</p>
      </div>
    <?php
      }else{
        foreach($room_items as $item){

    ?>

    </div>

    <section class="section">
      <div class="container">
        <div class="row align-items-center feature-2">
          <div class="col-md-6 ml-auto order-2">
          <form action="../action/itemAction.php" method="post">
          <div class="form-row text-center">
            <div class="form-group col-md-12">
              <h2 class="text-white"><?php echo $item['item_name']; ?></h2>
            </div>
          </div>

          <div class="form-row text-center">
            <div class="form-group col-md-12">
              <h2 class="text-white pt-2"><?php echo number_format($item['item_price']) . "円"; ?></h2>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-5 text-right">
                <h2 class="text-white pt-2">個数:</h2>
            </div>
            <div class="form-group col-md-4">
                <input type="number" name="buy_quantity" class="form-control form-control-lg text-center border-0 font-weight-bold" min="1" max="<?php echo $item['item_stocks']; ?>" required="required">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="submit" value="cart" name="cart" class="form-control btn btn-outline-white">
            </div>
            <div class="form-group col-md-6">
              <input type="submit" value="buy" name="choose" class="form-control btn btn-outline-white">
            </div>
            <input type="hidden" value="<?php echo $_GET['room']; ?>" name="room">
            <input type="hidden" value="<?php echo $item['item_id']; ?>" name="item_id">
          </div>
    </form>
          </div>
          <div class="col-md-6" data-aos="fade-right">
            <img src="../assets/img/<?php echo $item['item_picture']; ?>" alt="Image" class="img-fluid" onclick="location.href='./showRoom.php?room=2'">
          </div>
        </div>
      </div>
    </section>


    <?php


        }
      }

    ?>

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