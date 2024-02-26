<?php 
 session_start();
?>

<?php include('Backend/Header.php'); ?>

<!-- home section -->
<section id="home">
  <div class="container">
    <h5>NEW ARRIVAL</h5>
    <h1><span>Best PRICE</span> THIS SEASON</h1>
    <p>Lorem ipsum dolor sit amet. affotable price</p>
    <!-- <button>Shop Now</button> -->
    <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>

  </div>
</section>

<!-- brands -->
<section id="brand" class="container">
  <div class="row">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="Frontend/Images/nike.jpg" />
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="Frontend/Images/brand2.webp" />
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="Frontend/Images/brand3.png" />
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="Frontend/Images/brand4.jpg" />
  </div>
</section>

<!-- new section -->
<section id="new" class="w-100">
  <div class="row p-0 m-0">
    <!--one box-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="Frontend/Images/shoe.avif">
      <div class="details">
        <h2>Extremely Awesome Shoes</h2>
        <!-- <button class="text-uppercase">Shop Now</button> -->
        <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>

      </div>
    </div>

    <!--two box-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="Frontend/Images/jacket.webp">
      <div class="details">
        <h2>Extremely Awesome Jacket</h2>
        <!-- <button class="text-uppercase">Shop Now</button> -->
        <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>

      </div>
    </div>

    <!--three box-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="Frontend/Images/watch.webp">
      <div class="details">
        <h2>50% OFF Watch</h2>
        <!-- <button class="text-uppercase">Shop Now</button> -->
        <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>

      </div>
    </div>
  </div>

</section>

<!-- features -->
<section id="featured " class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>our Featured </h3>
    <hr class="mx-auto">
    <p>here you can checked the featured product</p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php include('server/get_featured_pdt.php'); ?>
    <?php while ($row = $featured_pdt->fetch_assoc()) { ?>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="Frontend/Images/<?php echo $row['product_image']; ?>" />

        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name"> <?php echo $row['product_name']; ?></h1>
        <h5 class="p-price"><?php echo $row['product_price']; ?></h5>
        <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>

      </div>

    <?php } ?>
  </div>
</section>

<!-- banner -->
<div id="banner" class="my-5 py-5">
  <div class="container">
    <h4> SEASON'S SALE</h4>
    <h1> Winter Collection <br /> UP to 30% OFF</h1>
    <!-- <button class="text-uppercase"> Shop Now</button> -->
    <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>

  </div>
</div>

<!-- clothes -->
<section id="featured " class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Clothes And Coats Collection </h3>
    <hr class="mx-auto">
    <p>here you can check our collection</p>
  </div>

  <div class="row mx-auto container-fluid">
    <?php include('./server/get_coats.php'); ?>
    <?php while ($row = $coats_pdt->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="Frontend/Images/<?php echo $row['product_image']; ?>" />
        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name"><?php echo $row['product_name']; ?></h1>
        <h5 class="p-price"><?php echo $row['product_price']; ?></h5>
        <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>


      </div>
    <?php } ?>
  </div>
</section>

<!-- shoes -->
<section id="featured " class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>our Shoes Collection</h3>
    <hr class="mx-auto">
    <p>here you can check our shoes collection</p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php include('./server/get_shoes.php'); ?>
    <?php while ($row = $shoes->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="Frontend/Images/<?php echo $row['product_image']; ?>" />
        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name"><?php echo $row['product_name']; ?></h1>
        <h5 class="p-price"><?php echo $row['product_price']; ?></h5>
        <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>


      </div>

    <?php } ?>
  </div>
</section>

<!-- watches -->
<section id="featured " class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>our Watch collection</h3>
    <hr class="mx-auto">
    <p>here you can check our watch collection</p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php include('./server/get_watches.php'); ?>
    <?php while ($row = $watches->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="Frontend/Images/<?php echo $row['product_image']; ?>" />
        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name"><?php echo $row['product_name']; ?></h1>
        <h5 class="p-price"><?php echo $row['product_price']; ?></h5>
        <a href="single_pdt.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Shop Now</button></a>


      </div>
    <?php } ?>

  </div>
</section>

<?php include('Backend/Footer.php'); ?>