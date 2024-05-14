<?php
session_start();
include 'config.php';

$query_orders = mysqli_query($conn, "SELECT * FROM orders");
$rows = mysqli_num_rows($query_orders);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
    <?php include 'include/menu.php'; ?>
    <div class="container" style="margin-top: 30px;">
        <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h4>รายการที่ขายทั้งหมด</h4>
        <div class="row">
            <div class="col-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>วันที่</th>
                    <th>ชื่อ</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>ราคารวม</th>
                    <th>ชื่อลูกค้า</th>
                </tr>
            </thead>
            <tbody>
                <?php if($rows > 0): ?>
                    <?php while($order = mysqli_fetch_assoc($query_orders)): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                            <td><?php echo $order['product_name']; ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo $order['price']; ?></td>
                            <td><?php echo $order['grand_total']; ?></td>
                            <td><?php echo $order['fullname']; ?></td>
                            
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">ไม่พบรายการออเดอร์</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
</body>
</html>
