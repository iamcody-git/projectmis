<?php
include('server/connection.php');
session_start();
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop site</title>
  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- icon link -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <link rel="stylesheet" href="Frontend/CSS/style.css">
  <style>
    .pagination a {
      color: green;
    }

    .pagination li:hover {
      color: coral;
      background-color: green;

    }
  </style>
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
            <a class="nav-link" href="Single_pdt.php">
              <a href="Cart.php"><ion-icon class="fas" name="cart-outline"></ion-icon>
              <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] !=0) { ?>
                <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
               <?php } ?></a>
              <a href="Account.php"><ion-icon class="fas" name="person-circle-outline"></ion-icon></a>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- shop -->

  <section id="featured " class="my-5 py-5">
    <div class="container  mt-5 py-5">
      <h3>Our Product </h3>
      <hr>
      <p>here you can check our product collection</p>
    </div>
    <div class="row mx-auto container">

      <?php while ($row = $products->fetch_assoc()) { ?>
        <div onclick="window.location.href='single_pdt.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="Frontend/Images/<?php echo $row['product_image']; ?>" />
          <div class="star">
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
          </div>
          <h1 class="p-name"><?php echo $row['product_name']; ?></h1>
          <h5 class="p-price">Rs<?php echo $row['product_price']; ?></h5>
          <a class=" btn buy-btn" href="<?php echo "Single_pdt.php?product_id=" . $row['product_id']; ?>">Shop Now</a>

        </div>
      <?php } ?>


      <nav aria-label="Page navigation example">
        <ul class="pagination mt-5">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
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