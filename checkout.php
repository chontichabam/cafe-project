<?php
session_start();
include 'config.php';

$productIds = [];
foreach(($_SESSION['cart'] ?? []) as $cartId => $cartValue) {
    $productIds[] = $cartId;
}

$ids = 0;
if(count($productIds) > 0) {
    $ids = "'" . implode("','", $productIds) . "'";
}

// product all
$query = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");
$rows = mysqli_num_rows($query);

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Checkout</title>

    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
    <?php include 'include/menu.php' ?>
    <div class="container" style="margin-top: 30px;">
        <?php if(!empty($_SESSION['message'])) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h4 class="mb-3">รับออเดอร์</h4>
        <form action="<?php echo $base_url; ?>/checkout-form.php" method="post">
            <div class="row g-5">
                <div class="col-md-6 col-lg-7">                
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label class="form-label">ชื่อลูกค้า</label>
                            <input type="text" name="fullname" class="form-control" placeholder="" value="">                            
                        </div>
    
                        <div class="col-sm-12">
                            <label class="form-label">Note</label>
                            <input type="text" name="note" class="form-control" placeholder="" value="">                            
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery_option" id="inlineRadio1"
                                value="Not-Sweet ">
                            <label class="form-check-label" for="inlineRadio1">ไม่หวาน 0%</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery_option" id="inlineRadio2"
                                value="Less-Sweet">
                            <label class="form-check-label" for="inlineRadio2">หวานน้อย 75%</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery_option" id="inlineRadio2"
                                value="Normal">
                            <label class="form-check-label" for="inlineRadio2">หวานปกติ 100%</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery_option" id="inlineRadio2"
                                value="Very-Sweet">
                            <label class="form-check-label" for="inlineRadio2">หวานมาก 125%</label>
                        </div>
                      
                    </div>
                    
</form>
                    <hr class="my-4">
                    <div class="text-end">
                        <a href="<?php echo $base_url; ?>/product-list.php" class="btn btn-secondary btn-lg" role="button">กลับไปหน้าเมนู</a>
                        <button class="btn btn-primary btn-lg" type="submit">รับออเดอร์</button>
                    </div>   
                             
                </div>
                <div class="col-md-6 col-lg-5 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">รายการ</span>
                        <span class="badge bg-primary rounded-pill"><?php echo $rows; ?></span>
                    </h4>
    
                    <?php if($rows > 0): ?>
                    <ul class="list-group mb-3">
                        <?php $grand_total =  0; ?>
                        <?php while($product = mysqli_fetch_assoc($query)): ?>                        
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?php echo $product['product_name']; ?> (<?php echo $_SESSION['cart'][$product['id']]; ?>)</h6>
                                <small class="text-body-secondary"><?php echo nl2br($product['detail']); ?></small>
                                <input type="hidden" name="product[<?php echo $product['id']; ?>][price]" value="<?php echo $product['price']; ?>">
                                <input type="hidden" name="product[<?php echo $product['id']; ?>][name]" value="<?php echo $product['product_name']; ?>">
                            </div>
                            <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$product['id']] * $product['price'], 2); ?></span>
                        </li>
                        <?php $grand_total += $_SESSION['cart'][$product['id']] * $product['price']; ?>                        
                        <?php endwhile; ?>
                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">ราคารวม</h6>
                                <small>ทั้งหมด</small>
                            </div>
                            <span class="text-success"><strong>฿<?php echo number_format($grand_total, 2); ?></strong></span>
                        </li>
                    </ul>
                    <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
</body>

</html>