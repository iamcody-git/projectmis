
<?php 
include("Headeradmin.php");



// Assuming $conn is defined in Headeradmin.php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM products");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Get the result set
$products = $stmt->get_result();
if (!$products) {
    die("Getting result set failed: " . $stmt->error);
}
?>

<div class="container_fluid">
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

        <h2>Products</h2>

        <?php if(isset($_GET['edit_success_msg'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_msg']; ?></p>
           <?php } ?>

           <?php if(isset($_GET['edit_failure_msg'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_msg']; ?></p>
           <?php } ?>

           <?php if(isset($_GET['delete_successfully'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['delete_successfully']; ?></p>
           <?php } ?>

           <?php if(isset($_GET['delete_failure'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['delete_failure']; ?></p>
           <?php } ?>

           <?php if(isset($_GET['product_created'])){ ?>
            <p class="text-center" style="color:green;"><?php echo $_GET['product_created']; ?></p>
           <?php } ?>

           <?php if(isset($_GET['product_failed'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></p>
           <?php } ?>

           <?php if(isset($_GET['images_updated'])){ ?>
            <p class="text-center" style="color:green;"><?php echo $_GET['images_updated']; ?></p>
           <?php } ?>

           <?php if(isset($_GET['images_failed'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['images_failed']; ?></p>
           <?php } ?>




        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Product Id</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($products as $product){ ?>       
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><img src="<?php echo "../Frontend/Images/". $product["product_image"]; ?>" style="width: 70px; height:70px;"></img></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_category']; ?></td>
                    <td><?php echo $product['product_price']; ?></td>

                    <td>
                    <form action="edit_product.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" name="edit_product" class="btn btn-primary">Edit</button>
                    </form>
                    </td>

                    <td>
                    <form action="delete_product.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                    </form>
                    </td>

                </tr>
                <?php } ?>

            </tbody>
            </table>
        </div> 

    </main>

    </div>

</div>
