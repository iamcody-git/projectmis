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

// for order
if (isset($_SESSION['logged_in'])) {
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
  $stmt->bind_param('i', $user_id);
  $stmt->execute();

  $orders = $stmt->get_result();
}
?>

<!-- navbar -->
<?php include('Backend/Header.php'); ?>

<!-- account page -->

<section class="my-5 py-5">
  <div class="row container mx-auto">
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12 ">
      <p class="text-center" style="color:green;"><?php if (isset($_GET['register_success'])) {
                                                    echo $_GET['register_success'];
                                                  } ?></p>
      <p class="text-center" style="color:green;"><?php if (isset($_GET['login_success'])) {
                                                    echo $_GET['login_success'];
                                                  } ?></p>

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
      <th>Order id</th>
      <th>Order cost</th>
      <th>Order status</th>
      <th>Order Date</th>
      <th>Order Details</th>
    </tr>

    <?php
    while ($row = $orders->fetch_assoc()) { ?>

      <tr>
        <td>
          <div>
            <p class="mt-3"><?php echo $row['order_id']; ?></p>
          </div>
        </td>
        <td>
          <span><?php echo $row['order_cost']; ?></span>
        </td>
        <td>
          <span><?php echo $row['order_status']; ?></span>
        </td>
        <td>
          <span><?php echo $row['order_date']; ?></span>
        </td>

        <td>
          <form method="post" action="order_details.php">
            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
            <input type="submit" name="order_details_btn" class="order-details-btn" id="" value="Details">
          </form>
        </td>
        </td>
      </tr>

    <?php } ?>
    </tr>
  </table>
</section>

<!-- footer -->
<?php include('Backend/Footer.php'); ?>