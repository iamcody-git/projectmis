<?php
session_start();
include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
    exit();
}

if(isset($_POST['delete_btn'])) {
    if(isset($_POST['product_id'])){
        $product_id = $_POST['product_id'];
        
        // Prepare the delete statement
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
        
        // Bind the product ID parameter
        $stmt->bind_param('i', $product_id);
        
        // Execute the delete statement
        if($stmt->execute()){
            // Redirect with success message if deletion is successful
            header('location:products.php?delete_successfully=Product has been deleted successfully');
            exit();
        } else {
            // Redirect with failure message if deletion fails
            header('location:products.php?delete_failure=Error occurred while deleting product');
            exit();
        }
    } else {
        // Redirect if product ID is not set
        header('location:products.php?delete_failure=Product ID is not set');
        exit();
    }
} else {
    // Redirect if delete button is not pressed
    header('location:products.php?delete_failure=Delete button is not pressed');
    exit();
}
?>
