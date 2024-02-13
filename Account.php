<?php
session_start();
include('server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header('location:login.php');
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);

    header('location:login.php');
    exit;
  }
}
if (isset($_POST['change_password'])) {
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $user_email = $_SESSION['user_email'];

  // if password dont match
  if ($password !== $cpassword) {
    header('location: Account.php?error=password donnot match');
  }
  // check the length 
  else if (strlen($password) < 6) {
    header('location: Account.php?error=password must be atleast 6 char');
  } else {
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=? ");
    $stmt->bind_param('ss', md5($password), $user_email);
    if ($stmt->execute()) {
      header('location:Account.php?message=password updated successfully');
    } else {
      header('location:Account.php?error=could not update');
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>

  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- icon link -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <link rel="stylesheet" href="Frontend/CSS/style.css">

</head>

<body>

  <!-- navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary py-4 fixed-top">
    <div class="container">
      <img class="logo" src="Frontend/Images/logobazar.jpg" />
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="Main.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contact.php ">ContactUs</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <a href="Cart.php"><ion-icon class="fas" name="cart-outline"></ion-icon></a>
              <a href="Account.php"><ion-icon class="fas" name="person-circle-outline"></ion-icon></a>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- account page -->

  <section class="my-5 py-5">
    <div class="row container mx-auto">
      <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12 ">
      <p class="text-center" style="color:green;"><?php if (isset($_GET['register_success'])) {echo $_GET['register_success'];} ?></p>
      <p class="text-center" style="color:green;"><?php if (isset($_GET['login_success'])) {echo $_GET['login_success'];} ?></p>
                                                      
        <h3 class="font-weight-bold">Account info</h3>
        <hr class="mx-auto" />
        <div class="account-info">
          <p>Name: <span><?php if (isset($_SESSION['user_name'])) {
                            echo $_SESSION['user_name'];
                          } ?></span></p>
          <p>Email: <span><?php if (isset($_SESSION['user_email'])) {
                            echo $_SESSION['user_email'];
                          } ?></span></p>
          <p><a href="" id="orders-btn">Your order</a></p>
          <p><a href="Account.php?logout=1" id="logout-btn">Logout</a></p>
        </div>
      </div>

      <div class="col-lg-6 col-md-12 col-sm-12">
        <form action="Account.php" id="account-form" method="POST">
          <p class="text-center" style="color: red;"><?php if (isset($_GET['error'])) {
                                                        echo $_GET['error'];
                                                      } ?></p>
          <p class="text-center" style="color: green;"><?php if (isset($_GET['message'])) {
                                                          echo $_GET['message'];
                                                        } ?></p>
          <h3>change password</h3>
          <hr class="mx-auto" />
          <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" id="account-password" class="form-control" placeholder="password" required />
          </div>
          <div class="form-group">
            <label for="">confirm Password</label>
            <input type="password" name="cpassword" id="account-password-confirm" class="form-control" placeholder="confirm password" required />
          </div>
          <div class="form-group">
            <input type="submit" value="change password" name="change_password" class="btn" id="change-pass-btn">
          </div>
        </form>
      </div>
    </div>

  </section>

  <!-- orders -->
  <section id=orders class="orders container my-5 py-3">
    <div class="container mt-2">
      <h2 class="font-weight-bolde text-center">Your Order</h2>
      <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
      <tr>
        <th>Product</th>
        <th>Date</th>
      </tr>
      <tr>
        <td>
          <div class="product-info">
            <img src="Frontend/Images/fotimg2.jpeg" alt="">
          </div>
          <p class="mt-3">Blue coats</p>
        </td>
        <td>
          <span>2036-12-12</span>
        </td>
        </td>
      </tr>
      </tr>
    </table>
  </section>

  <!-- footer -->
  <footer class="mt-5 py-5">
    <div class="row container mx-auto mt-5">
      <div class=" footer-one col-lg-3 col-md-6 col-sm-12">
        <img class="logo" src="Frontend/Images/logobazar.jpg" />
        <p class="pt-3"> we provide the product in most affordable price</p>
      </div>

      <div class=" footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2"> Featured</h5>
        <ul class="text-uppercase">
          <li><a href="#">Men</a></li>
          <li><a href="#">Women</a></li>
          <li><a href="#">Kids</a></li>
          <li><a href="#">New Arrival</a></li>
          <li><a href="#">Clothes</a></li>
        </ul>
      </div>
      <div class=" footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class=" text-uppercase pb-2">ContactUs</h5>
        <div>
          <h6 class="text-uppercase">Address</h6>
          <p>123 Street Name, city</p>
        </div>

        <div>
          <h6 class="text-uppercase">Phone</h6>
          <p>1326532123</p>
        </div>
        <div>
          <h6 class="text-uppercase">Email</h6>
          <p>cody@gmail.com</p>
        </div>
      </div>

      <div class=" footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Instagram</h5>
        <div class="row">
          <img src="Frontend/Images/fotimg4.jpeg" class="img-fluid w-25 h-100 m-2">
          <img src="Frontend/Images/fotimg7.jpeg" class="img-fluid w-25 h-100 m-2">
          <img src="Frontend/Images/fotimg3.jpeg" class="img-fluid w-25 h-100 m-2">
        </div>
      </div>

    </div>

    <div class="copyright mt-5 ">
      <div class="row container mx-auto">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
          <img src="Frontend/Images/khalti2.png">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap mb-2">
          <p>eCommerce @2025 All Rights are Reserved</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>