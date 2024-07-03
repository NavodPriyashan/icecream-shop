<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else {
    $user_id = '';   
}
if(isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:order.php');
    exit();
}

if(isset($_POST['cancel'])) {
    $update_order = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $update_order->execute(['cancled', $get_id]);

    header('location:order.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Order Details</h1>
        <p>We are excited to introduce our new and improved registration form! This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Order Details</span>
    </div>
</div>
<div class="order-detail">
    <div class="heading">
        <h1>My Order Detail</h1>
        <p>We are excited to introduce our new and improved registration form! This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <img src="image/separator-img.png">
    </div>
    <div class="box-container">
        <?php
        $grand_total = 0;
        $select_order = $conn->prepare("SELECT * FROM orders WHERE id = ? LIMIT 1");
        $select_order->execute([$get_id]);

        if ($select_order->rowCount() > 0) {
            while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){
                $select_product = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
                $select_product->execute([$fetch_order['product_id']]);
                if ($select_product->rowCount() > 0){
                    while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                        $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                        $grand_total += $sub_total;
        ?>
        <div class="box">
            <div class="col">
                <p class="title"><i class="bx bxs-calendar-alt"></i><?= ($fetch_order['date']); ?></p>
                <img src="uploaded_file/<?= ($fetch_product['image']); ?>" class="image">
                <p class="price">Rs<?= ($fetch_product['price']); ?>/=</p>
                <h3 class="name"><?= ($fetch_product['name']); ?></h3>
                <p class="grand-total">Total Amount Payable: <span>Rs<?= ($grand_total); ?>/=</span></p>
            </div>
            <div class="col">
                <p class="title">Billing Address</p>
                <p class="user"><i class="bi bi-person-bounding-box"></i><?= ($fetch_order['name']); ?></p>
                <p class="user"><i class="bi bi-envelope"></i><?= ($fetch_order['email']); ?></p>
                <p class="user"><i class="bi bi-pin-map-fill"></i><?= ($fetch_order['address']); ?></p>
                <p class="status" style="color:<?php 
                    if($fetch_order['status'] == 'delivered') {
                        echo "green";
                    } elseif($fetch_order['status'] == 'cancled') {
                        echo "red";
                    } else {
                        echo "orange";
                    }
                ?>"><?= ($fetch_order['status']); ?></p>
                <?php if($fetch_order['status'] == 'cancled'){ ?>
                    <a href="checkout.php?get_id=<?= ($fetch_product['id']); ?>" class="btn" style="line-height: 3">Order Again</a>
                <?php } else { ?>
                    <form action="" method="post">
                        <button type="submit" name="cancel" class="btn" onclick="return confirm('Do you want to cancel this product?')">Cancel</button>
                    </form>
                <?php } ?>
            </div>
        </div>
        <?php
                   }
                }
            }
        } else {
            echo '<p class="empty">No Order placed yet</p>';
        }
        ?>
    </div>
</div>

<?php include 'components/footer.php'; ?>

<!-- SweetAlert CDN link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Custom JS link -->
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>

</body>
</html>