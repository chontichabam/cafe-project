<?php
session_start();
include 'config.php';

// Sanitize user inputs
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$note = mysqli_real_escape_string($conn, $_POST['note']);
$delivery_option = mysqli_real_escape_string($conn, $_POST['delivery_option']);
$grand_total = mysqli_real_escape_string($conn, $_POST['grand_total']);
$last_id = mysqli_insert_id($conn);
foreach($_SESSION['cart'] as $productId => $productQty) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product'][$productId]['name']);
    $price = mysqli_real_escape_string($conn, $_POST['product'][$productId]['price']);
    $total = $price * $productQty;
}

$now = date('Y-m-d H:i:s');
$query = mysqli_query($conn, "INSERT INTO orders (order_date, fullname, note, delivery_option,product_name,price,quantity, grand_total) VALUES ('$now', '$fullname', '$note', '$delivery_option','$product_name','$price','$productQty', '$grand_total')") or die('query failed');

if($query) {
  
    unset($_SESSION['cart']);
    $_SESSION['message'] = 'รับรายการออเดอร์สำเร็จ!';
    header('location: ' . $base_url . '/checkout-success.php');
} else {
    $_SESSION['message'] = 'ไม่สามารถรับรายการได้!!!';
    header('location: ' . $base_url . '/checkout-success.php');
}
?>