<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else {
    $user_id = '';
    header('location:login.php');    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Order</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>My Order</h1>
        <p>We are excited to introduce our new and improved registration form! This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>My Order</span>
    </div>
</div>

<div class="orders">
    <div class="heading">
        <h1>My Order</h1>
        <img src="image/separator-img.png">
    </div>

    <div class="box-container">
        <?php
        $select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC");
        $select_orders->execute([$user_id]);

        if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                $product_id = $fetch_orders['product_id'];

                $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                $select_products->execute([$product_id]);

                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="box" <?php if ($fetch_orders['status'] == 'cancled') echo 'style="border:2px solid red"'; ?>>
            <a href="view_order.php?get_id=<?= ($fetch_orders['id']); ?>">
                <img src="uploaded_file/<?= ($fetch_products['image']); ?>" class="image">
                <p class="date"><i class="bx bxs-calendar-alt"></i><?=($fetch_orders['date']); ?></p>
                <div class="content">
                    <img src="image/shape-19.png" class="shape">
                    
                    <div class="row">
                        <h3 class="name"><?=($fetch_products['name']); ?></h3>
                        <p class="price">Price: Rs<?=($fetch_products['price']); ?></p>
                        <p class="status" style="color:<?php 
                            if($fetch_orders['status'] == 'delivered') {
                                echo "green";
                            } elseif($fetch_orders['status'] == 'cancled') {
                                echo "red";
                            } else {
                                echo "orange";
                            }
                        ?>"><?= ($fetch_orders['status']); ?></p>
                    </div>
                </div>
            </a>
        </div>
        <?php
                    }
                }
            }
        } else {
            echo '<p class="empty">No orders placed yet</p>';
        }
        ?>
    </div>
</div>

<?php include 'components/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>

</body>
</html>
