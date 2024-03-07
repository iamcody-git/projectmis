<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

if(isset($_POST['delete_btn'])) {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id']; // Corrected variable name to $order_id
        // Prepare the delete statement
        $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
        if (!$stmt) {
            // Handle prepare error
            header('location: index.php?delete_failure=Error preparing delete statement');
            exit();
        }
        // Bind the order ID parameter
        $stmt->bind_param('i', $order_id);
        // Execute the delete statement
        if($stmt->execute()) {
            // Redirect with success message if deletion is successful
            header('location: index.php?delete_success=Order has been deleted successfully');
            exit();
        } else {
            // Redirect with failure message if deletion fails
            header('location: index.php?delete_failure=Error occurred while deleting the order');
            exit();
        }
    } else {
        // Redirect if order ID is not set
        header('location: index.php?delete_failure=Order ID not provided');
        exit();
    }
} else {
    // Redirect if delete button is not pressed
    header('location: index.php?delete_failure=Delete button is not pressed');
    exit();
}
?>
