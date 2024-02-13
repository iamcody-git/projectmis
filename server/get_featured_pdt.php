<?php
 
 include('connection.php');

 $stmt=$conn->prepare("SELECT * FROM products LIMIT 4");
$stmt->execute();

$featured_pdt=$stmt->get_result();
?>