
<?php 
include("Headeradmin.php");

    $stmt = $conn->prepare("SELECT * FROM orders ");
    $stmt->execute();
  
    $orders = $stmt->get_result();
  
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

        <h2>Orders</h2>

      <?php if(isset($_POST['order_updated'])){ ?>

        <p class="text-center" style="color:green" <?php echo $_POST['order_updated']; ?>></p>

       <?php }?>  

       <?php if(isset($_POST['order_failed'])){ ?>

<p class="text-center" style="color:red" <?php echo $_POST['order_failed']; ?>></p>

<?php }?> 


        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Order_id</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">User Phone</th>
                    <th scope="col">User Address</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($orders as $order){ ?>       
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['user_phone']; ?></td>
                    <td><?php echo $order['user_city']; ?></td>

                    <td>
                    <form action="edit_order.php" method="POST">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <button type="submit" name="order_product" class="btn btn-primary">Edit</button>
                    </form>
                    </td>

                    <td>
                    <form action="delete_order.php" method="POST">
    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
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
