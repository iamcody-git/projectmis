<?php
include('server/connection.php');

// already register user should not able to login again
if (isset($_SESSION['logged_in'])) {
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
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
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

<?php include('Backend/Header.php'); ?>

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

<?php include('Backend/Footer.php'); ?>