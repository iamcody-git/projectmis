<?php 
include("Headeradmin.php");

if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
else if(isset($_POST['edit_btn'])) {
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_color=?, product_category=? WHERE product_id=?");
    $stmt->bind_param('sssssi', $title, $description, $price, $color, $category, $product_id);

    if($stmt->execute()) {
        header('location: products.php?edit_success_msg=Product has been updated successfully');
        exit(); // Add exit after header redirection to prevent further execution
    } else {
        echo "Error: " . $stmt->error; // Print any errors for debugging
    }
}
else {
    header('location:products.php');
    exit();
}
?>


<div class="conatiner_fluid">
    <div class="row" style="min-height: 1000px;">
    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" id="sidebarMenu">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column"> 
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page" >
                        <span data-feather="home"></span>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php" class="nav-link active" aria-current="page" >
                        <span data-feather="file"></span>orders
                    </a>
                </li>

                <li class="nav-item">
                    <a href="products.php" class="nav-link active" aria-current="page" >
                        <span data-feather="shopping-cart"></span>Products
                    </a>
                </li>
           
                <li class="nav-item">
                    <a href="add_product.php" class="nav-link active" aria-current="page" >
                        <span data-feather="users"></span>Add new Products
                    </a>
                </li>


            </ul>

        </div>

    </nav>


    <main class="col-md-0 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap algin-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">

                </div>
            </div>
        </div>

        <h2>Edit Products</h2>
        <div class="table-responsive">
            <div class="mx-auto container">
                <form action="edit_product.php" id="edit-form" enctype="multipart/form-data" method="post">

            <div class="form-group checkout-small-element">
                <p style="color:red"> <?php if(isset($_POST['error'])){ echo $_POST['error'];} ?></p>
                <div class="form-group mt-2">

                    <?php foreach($products as $product){ ?>
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                    <label for="">Title :</label><br/>
                    <input type="text" name="title" id="product-desc" placeholder="Title" value="<?php echo $product['product_name']; ?>">

                </div>

                <div class="form-group mt-2">
                    <label for="">Description :</label><br/>
                    
                    <input type="text" name="description" id="product-desc" placeholder="Description" value="<?php echo $product['product_description']; ?>">


                </div>

                <div class="form-group mt-2">
                    <label for="">Price : </label><br/>
                    <input type="text" name="price" id="product-desc" placeholder="price" value="<?php echo $product['product_price']; ?>">

                </div>

                <div class="form-group mt-2">
    <p style="color:red"> <?php if(isset($_POST['error'])){ echo $_POST['error'];} ?></p>
    <label for="">Category: </label>
    <select class="form" required name="category">
        <option value="shoes" <?php if($product['product_category'] == 'shoes') echo 'selected'; ?>>Shoes</option>
        <option value="clothes" <?php if($product['product_category'] == 'clothes') echo 'selected'; ?>>Clothes</option>
        <option value="watches" <?php if($product['product_category'] == 'watches') echo 'selected'; ?>>Watches</option>
    </select>
</div>

                <div class="form-group mt-2">
                    <label for="">Color : </label><br/>
                    <input type="text" name="color" id="product-desc" placeholder="Choose color you like" value="<?php echo $product['product_color']; ?>">
               
                <!-- <button type="submit" name="edit_btn" class="btn btn-primary">Edit</button> -->


                <form action="products.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
    <button type="submit" name="edit_btn" class="btn btn-primary">Edit</button>
</form>
                </div>
        
     
      <?php }?>
      </form>

            </div>

        </div>
        </div> 
    </main>
</div>
