<?php  
session_start();
include('server/connection.php');
if(isset($_POST['place_order'])){
    
    // get user info and store it in the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = 1;
    $order_date = date('Y-m-d H:i:s');

    // Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES(?,?,?,?,?,?,?);");
    $stmt->bind_param('dsissss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
    $stmt->execute();

    $order_id = $stmt->insert_id;
   
    // Insert into order_items table
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?,?,?,?,?,?,?,?) ");
        $stmt1->bind_param('iisssiss', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }

    // Clear the cart after placing the order
    // unset($_SESSION['cart']);

    // inform user whether everything is fine or not
    header('location:./payment.php?order_status=order placed successfully');
}
?>
