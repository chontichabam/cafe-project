<?php
session_start();
include 'config.php';

foreach($_SESSION['cart'] as $productId => $productQty) {
    $_SESSION['cart'][$productId] = $_POST['product'][$productId]['quantity'];
}

$_SESSION['message'] = 'เปลี่ยนแปลงเมนูสำเร็จ';
header('location: ' . $base_url . '/cart.php');