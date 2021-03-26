<?php
include "../action/itemAction.php";

if(empty($_SESSION)){
  session_unset();
  session_destroy();
}
$item = new Item();
$item_list = $item->displayBuyItem($_SESSION['item_id']);
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
    
    <title>Invoice</title>

    <style>
      body{
        background:rgb(131, 184, 233, 0.8);
      }
    </style>
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

<section>
<div class="container mt-5 pt-5">
<form action="../action/itemAction.php" method="post">
<table class="table bg-transparent border w-75 text-naivy">
<?php
  foreach($item_list as $item){
?>
  
    
    <tbody class="w-75 float-center">
      <tr>
        <td>Item Name</td>
        <td class="text-right"><?php echo $item['item_name'];?></td>
      </tr>
      <tr>
        <td>Item Price</td>
        <td class="text-right"><?php echo number_format($item['item_price']);?>円</td>
      </tr>
      <tr>
        <td>Buy Quantity</td>
        <td class="text-right"><?php echo $_SESSION['buy_quantity'];?></td>
      </tr>
      <tr>
        <td>Total Price</td>
        <td class="text-right" name="totalPrice"><?php echo number_format($_SESSION['totalPrice']);?>円</td>
      </tr>
      <tr>
        <td>Payment method</td>
        <td class="text-right" name="payment_method"><?php echo $_SESSION['payment'];?></td>
      </tr>
      <?php if($_SESSION['payment'] == "cash"){ ?>
      <tr>
        <td>Payment</td>
        <td class="text-right" name="payment"><?php echo number_format($_SESSION['money']);?>円</td>
      </tr>
      <tr>
        <td>Change</td>
        <td class="text-right"><p name="changes"><?php echo number_format($_SESSION['money'] - $_SESSION['totalPrice']);?>円</p></td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <td></td>
        <td class="text-right"><input type="submit" value="buy" name="buy" class="btn btn-outline-white px-4"></td>  
      </tr>
        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">

    </tbody>
  
  
<?php
  }
?>
</table>
</form>
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