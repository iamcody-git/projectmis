<?php
 session_start();
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

if (!isset($_SESSION['total'])) {
  $_SESSION['total'] = 0;
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
    } else {
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
} elseif (isset($_POST['edit_quantity'])) {
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
} else {
  // header('location: Main.php');
  // exit();
}

function calculateTotalCart()
{
  $total_price = 0;
  $total_quantity =0;

  foreach ($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];

    $total_price += ($price * $quantity);
    $total_quantity=$total_quantity + $quantity;
  }
  $_SESSION['total'] = $total_price;
  $_SESSION['quantity']= $total_quantity;
}
?>

<?php include('Backend/Header.php'); ?>

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
    foreach ($_SESSION['cart'] as  $key => $value) {
    ?>

      <tr>
        <td>
          <div class="product-info">
            <img src="Frontend/Images/<?php echo $value['product_image']; ?>" alt="">
            <div>
              <p><?php echo $value['product_name']; ?></p>
              <small><span>Rs</span><?php echo $value['product_price']; ?></small>
              <br>
              <form action="Cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                <input type="submit" name="remove_product" class="remove-btn" value="remove" />

              </form>

            </div>
          </div>
        </td>
        <td>

          <form action="Cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
            <input type="hidden" name="product_name" value="<?php echo $value['product_name']; ?>" />
            <input type="hidden" name="product_price" value="<?php echo $value['product_price']; ?>" />
            <input type="hidden" name="product_image" value="<?php echo $value['product_image']; ?>" />
            <input name="product_quantity" type="number" value="<?php echo $value['product_quantity']; ?>">
            <input type="submit" name="edit_quantity" class="edit-btn" value="Edit" />
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


<?php include('Backend/Footer.php'); ?>