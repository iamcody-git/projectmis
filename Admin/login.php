<?php
session_start();
include('../server/connection.php');

if (isset($_SESSION['admin_logged_in'])) {
  header('location:index.php');
  exit;
}

if (isset($_POST['login_btn'])) {

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admin WHERE admin_email=? AND admin_password=? LIMIT 1 ");
  $stmt->bind_param('ss', $email, $password);

  if ($stmt->execute()) {
    $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $stmt->fetch();

      $_SESSION['admin_id'] = $admin_id;
      $_SESSION['admin_name'] = $admin_name;
      $_SESSION['admin_email'] = $admin_email;
      $_SESSION['admin_logged_in'] = true;

      header('location:index.php?login_success=logged in successfully');
    } 
  } else {
    header('location: login.php?login_success=sth went wrong');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- icon link -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <link rel="stylesheet" href="../Frontend/CSS/style.css">
</head>
<body>
    <!-- login page -->

    <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">LOGIN</h2>
      <hr class="mx-auto">

    </div>
    <div class="mx-auto container">
      <form action="Login.php" id="login-form" method="POST">
        <p style="color: red;"><?php if (isset($_GET['error'])) {echo $_GET['error'];} ?></p>
          <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" id="login-email" name="email" placeholder="abc@gmail.com" required />

          </div>

          <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required />

          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" id="login-btn" name="login_btn" value="login" />
          </div>

      </form>
    </div>

  </section>

</body>
</html>



