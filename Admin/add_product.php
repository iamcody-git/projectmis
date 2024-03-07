
<?php 
include("Headeradmin.php");
?>



<div class="conatiner_fluid">
    <div class="row" style="min-height: 1000px;">

                                            <!-- side menu elements -->
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

        <h2>Add Products</h2>
        <div class="table-responsive">
            <div class="mx-auto container">
                <form action="create_product.php" id="edit-form" enctype="multipart/form-data" method="POST">

            <div class="form-group checkout-small-element">
                <p style="color:red"> <?php if(isset($_POST['error'])){ echo $_POST['errror'];} ?></p>
                <div class="form-group mt-2">

                    
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                    <label for="">Title :</label><br/>
                    <input type="text" name="title" id="product-desc" placeholder="Title">

                </div>

                <div class="form-group mt-2">
                    <label for="">Description :</label><br/>
                    
                    <input type="text" name="description" id="product-desc" placeholder="Description" >


                </div>

                <div class="form-group mt-2">
                    <label for="">Price : </label><br/>
                    <input type="text" name="price" id="product-desc" placeholder="price" >

                </div>

                <div class="form-group mt-2">
    <p style="color:red"> <?php if(isset($_POST['error'])){ echo $_POST['error'];} ?></p>
    <label for="">Category: </label>
    <select class="form" required name="category">
        <option value="shoes" >Shoes</option>
        <option value="clothes">Clothes</option>
        <option value="watches" > Watches</option>
    </select>
</div>

                <div class="form-group mt-2">
                    <label for="">Color : </label><br/>
                    <input type="text" name="color" id="product-desc" placeholder="Choose color you like">

                    <div class="form-group mt-2">
                        <label for="">Image 1</label>
                        <input type="file" name="image1" id="image1" class="form-control" placeholder="image1" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="">Image 2</label>
                        <input type="file" name="image2" id="image2" class="form-control" placeholder="image2" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="">Image 3</label>
                        <input type="file" name="image3" id="image3" class="form-control" placeholder="image3" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="">Image 4</label>
                        <input type="file" name="image4" id="image4" class="form-control" placeholder="image4" required>
                    </div>
               
                    <div class="form-group mt-2">
                        <input type="submit" name="create_product"  class="btn btn-primary" value="Create"/>
                    </div>
                </div>
        
     
     
      </form>

            </div>

        </div>
        </div> 
    </main>
</div>
