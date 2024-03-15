<?php 

session_start();
include('../server/connection.php');

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin header</title>
      <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- icon link -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<link rel="stylesheet" href="../Frontend/CSS/style.css">
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a href="#" class="navbar-brand col-md-3 col-lg-2 me-0 px-3">TheBazar</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse">
        <span class="navbar-toggle-icon"></span>
        </button>

        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
            <div class="nav-item text-nowrap ">
                <?php if(isset($_SESSION['admin_logged_in'])){ ?>
                <a href="../Main.php" class="nav-link px-3">Userpage</a>
                <?php }?>
            </div> 
                
                <?php if(isset($_SESSION['admin_logged_in'])){ ?>
                <a href="login.php" class="nav-link px-3">Sign Out</a>
                <?php }?>
            </div>
        </div>
    </header>
