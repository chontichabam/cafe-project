<header class="d-flex justify-content-center py-3 sticky-top bg-light border-bottom shadow-sm">
    <ul class="nav nav-pills">
    <li class="nav-item"><a href="<?php echo $base_url; ?>/order-total.php" class="nav-link">รายการทั้งหมด</a></li>
        <li class="nav-item"><a href="<?php echo $base_url; ?>/index.php" class="nav-link">เพิ่มรายการ</a></li>
        <li class="nav-item"><a href="<?php echo $base_url; ?>/product-list.php" class="nav-link">เมนู</a></li>
        <li class="nav-item"><a href="<?php echo $base_url; ?>/cart.php" class="nav-link">ออเดอร์ (<?php echo count($_SESSION['cart'] ?? []); ?>)</a></li>
    </ul>
</header>