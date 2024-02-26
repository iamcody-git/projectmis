<?php
 
 include('connection.php');

 $stmt=$conn->prepare("SELECT * FROM products WHERE product_category='shoes' LIMIT 4 ");
$stmt->execute();

$shoes=$stmt->get_result();
?>