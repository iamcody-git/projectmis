<?php
session_start();
if(!isset($_SESSION['cart'])){
  $_SESSION['cart']= array();
};

if(!isset($_SESSION['total'])){
  $_SESSION['total']=0;
}

if (isset($_POST['add_to_cart'])) {
  var_dump($_POST);

  // if the user has already added pdt in the cart

  if (isset($_SESSION['cart'])) {
    $product_array_ids = array_column($_SESSION['cart'], "product_id");

    if (!in_array($_POST['product_id'], $product_array_ids)) {

      $product_id = $_POST['product_id'];

      $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image' => $_POST['product_image'],
        'product_quantity' => $_POST['product_quantity'],
      );
      $_SESSION['cart'][$_POST['product_id']] = $product_array;

    }else {
      echo '<script>alert("Product was already added to the cart");</script>';
    }

    // pdt has been added successfully

  } else {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = array(
      'product_id' => $product_id,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'product_image' => $product_image,
      'product_quantity' => $product_quantity,
    );
    $_SESSION['cart'][$product_id] = $product_array;
  }

    // calculate total
    calculateTotalCart();

// remove pdt from cart

} elseif (isset($_POST['remove_product'])) {
  
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  // calculate total
  calculateTotalCart();

}elseif (isset($_POST['edit_quantity'])) {
  // get id and quantity from the form
  $product_id = $_POST['product_id'];
  $product_quantity = intval($_POST['product_quantity']); // Ensure it's an integer

  // get product from session
  if (isset($_SESSION['cart'][$product_id])) {
      $product_array = $_SESSION['cart'][$product_id];

      // update product quantity only if it's greater than 0
      if ($product_quantity > 0) {
          $product_array['product_quantity'] = $product_quantity;

          // return array back to its place
          $_SESSION['cart'][$product_id] = $product_array;
      } else {
          // If quantity is 0 or less, you may want to remove the product from the cart
          unset($_SESSION['cart'][$product_id]);
      }
      // calculate total
    calculateTotalCart();
  }

}else {
  // header('location: Main.php');
  // exit();
}

function calculateTotalCart() {
    $total = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total += ($price * $quantity);
    }
    $_SESSION['total'] = $total;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>

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
     <img class="logo" src="Frontend/Images/logobazar.jpg"/>
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

      <!-- cart --> 
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">CART collection</h2>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php 
            foreach($_SESSION['cart'] as  $key => $value){
            ?>

            <tr>
                <td>
                <div class="product-info">
                    <img src="Frontend/Images/<?php echo $value['product_image'];?>" alt="">
                    <div>
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span>Rs</span><?php echo $value['product_price']; ?></small>
                        <br>
                        <form action="Cart.php" method="post">
                          <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                        <input type="submit" name="remove_product" class="remove-btn" value="remove" />

                        </form>
                        
                    </div>
                </div>
            </td>
                <td>
                  
                <form action="Cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                        <input type="hidden" name="product_name" value="<?php echo $value['product_name']; ?>"/>
                        <input type="hidden" name="product_price" value="<?php echo $value['product_price']; ?>"/>
                        <input type="hidden" name="product_image" value="<?php echo $value['product_image']; ?>"/>
                        <input name="product_quantity" type="number" value="<?php echo $value['product_quantity']; ?>">
                        <input type="submit" name="edit_quantity" class="edit-btn" value="Edit"/>
                </form>
                </td>
                <td>
                    <span>Rs</span>
                    <span class="product-price"><?php echo intval($value['product_quantity']) * intval($value['product_price']); ?></span>

                </td>
            </tr>

            <?php } ?>
        </table>

        <div class="cart-total">
          <table>
            
            <tr>
              <td>Total </td>
              <td>RS <?php echo $_SESSION['total']; ?></td>
            </tr>
          </table>
        </div>

        <div class="checkout-container">
          <form action="Checkout.php" method="post">
          <input type="submit" class="btn checkout-btn" value="checkout" name="checkout"></input>
          </form>
        </div>
      </section>


  <!-- footer -->
            <footer class="mt-5 py-5">
                <div class="row container mx-auto mt-5">
                  <div class=" footer-one col-lg-3 col-md-6 col-sm-12">
                    <img class="logo" src="Frontend/Images/logobazar.jpg"/>
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
                      <img src="Frontend/Images/fotimg4.jpeg" class="img-fluid w-25 h-100 m-2" >
                      <img src="Frontend/Images/fotimg7.jpeg" class="img-fluid w-25 h-100 m-2" >
                      <img src="Frontend/Images/fotimg3.jpeg" class="img-fluid w-25 h-100 m-2" >
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