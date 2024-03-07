<?php 
include("Headeradmin.php");

if(isset($_POST['order_id']) && isset($_POST['edit_order'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    if($stmt->execute()) {
        header('location: index.php?order_updated=Order has been updated successfully');
        exit();
    } else {
        header('location: edit_order.php?order_id='.$order_id.'&error=Error occurred');
        exit();
    }
} elseif(isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $order = $stmt->get_result()->fetch_assoc();
} else {
    header('location:index.php');
    exit();
}
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" id="sidebarMenu">
            <!-- Sidebar content -->
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
            </div>

            <h2>Edit Orders</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form action="edit_order.php" id="edit-form" method="POST">
                        <div class="form-group my-3">
                            <label for="">OrderId</label>
                            <p class="my-4"><?php echo $order['order_id']; ?></p>
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        </div>

                        <div class="form-group mt-3">
                            <label for="">OrderPrice</label>
                            <p class="my-4"><?php echo $order['order_cost']; ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label for="">Order Status</label>
                            <select class="form-select" required name="order_status">
                                <option value="not paid" <?php if($order['order_status']=='not paid'){echo "selected";} ?>>Not Paid</option>
                                <option value="paid" <?php if($order['order_status']=='paid'){echo "selected";} ?>>Paid</option>
                                <option value="shipped" <?php if($order['order_status']=='shipped'){echo "selected";} ?>>Shipped</option>
                                <option value="delivered" <?php if($order['order_status']=='delivered'){echo "selected";} ?>>Delivered</option>
                            </select>
                        </div>

                        <div class="form-group my-3">
                            <label for="">OrderDate</label>
                            <p class="my-4"><?php echo $order['order_date']; ?></p>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" name="edit_order" value="Edit" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
