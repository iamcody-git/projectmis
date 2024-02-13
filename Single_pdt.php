<?php 
include('server/connection.php'); 
if(isset($_GET['product_id'])){
  $product_id=$_GET['product_id'];
  $stmt=$conn->prepare("SELECT *FROM products WHERE product_id=?");

  $stmt->bind_param("i",$product_id);
  $stmt->execute();

  $product =$stmt->get_result();


}else{
  header('location:Main.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product page</title>

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

  <!-- product site -->
  <section class=" container single-product my-5 pt-5">
    <div class="row mt-5">
      <?php while($row = $product->fetch_assoc()){ ?>
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="Frontend/Images/<?php echo $row['product_image']; ?>" id="mainImg"/>
            <div class="small-img-group">
            <div class="small-img-col">
                <img src="Frontend/Images/<?php echo $row['product_image']; ?>" width="100%" class="small-img" >
            </div>
             <div class="small-img-col">
                <img src="Frontend/Images/<?php echo $row['product_image2']; ?>" width="100%" class="small-img" >
            </div>
            <div class="small-img-col">
                <img src="Frontend/Images/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" >
            </div>
            <div class="small-img-col">
                <img src="Frontend/Images/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" >
            </div> 
        </div>
    </div>

   
<div class="col-lg-6 col-md-12 col-12">
    <h6>Men/Shoes</h6>
    <h2 class="py-3"><?php echo $row['product_name']; ?></h2>
    <h6><?php echo $row['product_price']; ?></h6>
    <form method="POST" action="Cart.php" > 
      <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
          <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
          <input type="hidden" name="product_name" value="<?php echo $row['product_name'];  ?>">
         <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"> 
    <input type="number" name="product_quantity" value="1">

    <button class="buy-btn" type="submit" name="add_to_cart">Add to cart</button>
    </form>
        
    <h6 class="mt-5 mb-5">Product Details</h6>
    <span><?php echo $row['product_description']; ?></span>
</div>
    <?php } ?>
    </div>
  </section>

  <!-- single product -->
   <section id="related product " class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>our Related collection </h3>
      <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
   
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img  class="img-fluid mb-3" src="Frontend/Images/shoe.avif"/>
        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name">jacket</h1>
        <h5 class="p-price">RS2652</h5>
        <button class="buy-btn">Shop Now</button>

      </div>


      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img  class="img-fluid mb-3" src="Frontend/Images/jacket.webp"/>
        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name">Sports shoes</h1>
        <h5 class="p-price">Rs 1200</h5>
        <button class="buy-btn">Shop Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img  class="img-fluid mb-3" src="Frontend/Images/brand2.webp"/>
        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name">Sports shoes</h1>
        <h5 class="p-price">Rs 1200</h5>
        <button class="buy-btn">Shop Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img  class="img-fluid mb-3" src="Frontend/Images/nike.jpg"/>
        <div class="star">
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>
        <h1 class="p-name">Sports shoes</h1>
        <h5 class="p-price">Rs 1200</h5>
        <button class="buy-btn">Shop Now</button>
      </div>
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

    <script>
        let mainImg= document.getElementById("mainImg");
        let smallImg=document.getElementsByClassName("small-img");

        for(let i=0;i<4;i++){
            smallImg[i].onclick=function(){
            mainImg.src=smallImg[i].src;
        }
        }   
    </script>

</body>
</html>