<?php
session_start();
include 'config.php';

if(!empty($_GET['id'])) {
    unset($_SESSION['cart'][$_GET['id']]);
    $_SESSION['message'] = 'ลบรายการออกจากตะกร้าสำเร็จ';
}

header('location: ' . $base_url . '/cart.php');