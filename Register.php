<?php
include('server/connection.php');

  // already register user should not able to login again
if(isset($_SESSION['logged_in'])){
  header('location:account.php');
  exit;
}

if (isset($_POST['register'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  // if password dont match
  if ($password !== $cpassword) {
    header('location: register.php?error=password donnot match');
  }
  // check the length 
  else if (strlen($password) < 6) {
    header('location: register.php?error=password must be atleast 6 char');
  }
  // if there is no error
  else {
    // check whether same email or not
    $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    // if there is already reg user
    if ($num_rows != 0) {
      header('location: register.php?error=user with same email already exist');
    } else {

      // create a new user
      $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password) VALUES(?,?,?)");
      $stmt->bind_param('sss', $name, $email, md5($password));

      if ($stmt->execute()) {
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        header('location:account.php?register_success=register successfully');
      } else {
        header('location:register.php?error=couldnt register');
      }
    }
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

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
            <a class="nav-link" href="Contact.php">ContactUs</a>
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

  <!-- register page -->

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">REGISTER</h2>
      <hr class="mx-auto">

    </div>
    <div class="mx-auto container">
      <form action="Register.php" id="register-form" method="POST">
        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                  echo $_GET['error'];
                                } ?></p>
        <div class="form-group">
          <label for="">Username</label>
          <input type="text" class="form-control" id="register-name" name="name" placeholder="Username" required />
        </div>

        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" id="login-email" name="email" placeholder="abc@gmail.com" required />
        </div>


        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required />

        </div>
        <div class="form-group">
          <label for="">Confirm Password</label>
          <input type="password" class="form-control" id="register-confirm-password" name="cpassword" placeholder="Confirm password" required />

        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" name="register" value="REGISTER" />

        </div>

        <div class="form-group">
          <a href="Login.php" id="login-url" class="btn">Do you have an account?Login</a>

        </div>
      </form>
    </div>

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