<?php
session_start();
if (!empty($_SESSION['cart'])) {
  // let user in


  // send user to home page


} else {
  // header('location: Main.php');
  echo "not found";
}

?>

<?php include('Backend/Header.php'); ?>

<!-- login page -->

<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">CheckOut</h2>
    <hr class="mx-auto">

  </div>
  <div class="mx-auto container">
    <form action="place_order.php" id="checkout-form" method="post">
      
      <p class="text-center" style="color: red;"><?php if(isset($_GET['message'])){ echo $_GET['message'];}?> 
      <?php if(isset($_GET['message'])){ ?>
        <a href="login.php" class="btn btn-primary">Login</a>
        <?php }; ?>
    </p>

      <div class="form-group checkout-small-element">
        <label for="">Username</label>
        <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Username" required />
      </div>

      <div class="form-group checkout-small-element">
        <label for="">Email</label>
        <input type="text" class="form-control" id="checkout-email" name="email" placeholder="abc@gmail.com" required />
      </div>


      <div class="form-group checkout-small-element">
        <label for="">Phone Number</label>
        <input type="tel" class="form-control" id="checkout-password" name="number" placeholder="checkout-number" required />

      </div>
      <div class="form-group checkout-small-element">
        <label for="">City</label>
        <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required />
      </div>

      <div class="form-group checkout-large-element">
        <label for="">Address</label>
        <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required />
      </div>

      <div class="form-group checkout-btn-container">
        <p>Total amount:Rs <?php echo $_SESSION['total']; ?> </p>
        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="place_order" />

      </div>

  </div>
  </form>
  </div>

</section>

<?php include('Backend/Footer.php'); ?>