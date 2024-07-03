<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else {
    header('location:login.php');
    exit();
}

include 'components/add_wishlist.php';

// Update qty in cart
if (isset($_POST['update_cart'])) {
    $cart_id = filter_var($_POST['cart_id']);
    $qty = filter_var($_POST['qty']);

    $update_qty = $conn->prepare("UPDATE cart SET qty = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);

    $success_msg[] = 'Cart quantity updated successfully';
}

// Remove product from cart
if (isset($_POST['delete_item'])) {
    $cart_id = filter_var($_POST['cart_id']);

    $verify_delete = $conn->prepare("SELECT * FROM cart WHERE id = ?");
    $verify_delete->execute([$cart_id]);

    if ($verify_delete->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE id = ?");
        $delete_cart_id->execute([$cart_id]);
        $success_msg[] = 'Item removed successfully';
    } else {
        $warning_msg[] = 'Item already removed';
    }
}

// Empty cart
if (isset($_POST['empty_cart'])) {
    $verify_empty_item = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $verify_empty_item->execute([$user_id]);

    if ($verify_empty_item->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $delete_cart_id->execute([$user_id]);

        $success_msg[] = 'Cart emptied successfully';
    } else {
        $warning_msg[] = 'Your cart is already empty';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Cart</h1>
        <p>We are excited to introduce our new and improved registration form! This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Cart</span>
    </div>
</div>

<div class="products">
    <div class="heading">
        <h1>Cart</h1>
        <img src="image/separator-img.png" alt="Separator Image">
    </div>
    <div class="box-container">
        <?php
        $grand_total = 0;

        $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $select_cart->execute([$user_id]);

        if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                $select_products->execute([$fetch_cart['product_id']]);

                if ($select_products->rowCount() > 0) {
                    $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                    $sub_total = $fetch_products['price'] * $fetch_cart['qty'];
                    $grand_total += $sub_total;
                    ?>
                    <form action="" method="post" class="box"<?php if ($fetch_products['stock'] == 0) { echo " disabled"; } ?>>
                        <input type="hidden" name="cart_id" value="<?= ($fetch_cart['id']); ?>">
                        <img src="uploaded_file/<?= ($fetch_products['image']); ?>" class="image">
                        <?php if ($fetch_products['stock'] > 9) { ?>
                            <span class="stock" style="color: green;">In Stock</span>
                        <?php } elseif ($fetch_products['stock'] == 0) { ?>
                            <span class="stock" style="color: red;">Out of stock</span>
                        <?php } else { ?>
                            <span class="stock" style="color: red;">Hurry, only <?= ($fetch_products['stock']); ?> left</span>
                        <?php } ?>
                        <div class="content">
                            <img src="image/shape-19.png" class="shap" alt="Shape">
                            
                            <h3 class="name"><?= ($fetch_products['name']); ?></h3>
                            
                                <button type="submit" name="update_cart" class="bx bxs-edit fa-edit box"></button>
                                <div class="flex-btn">
                            <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty box">
                                <p class="price">Price <?=($fetch_products['price']); ?>/-</p>
                                
                            </div>
                            <div class="flex-btn">
                                <p class="sub-total">Sub Total: <span>$<?= $sub_total; ?></span></p>
                                <button type="submit" name="delete_item" class="btn" onclick="return confirm('Remove from cart?');">Delete</button>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            }
        } else {
            echo '<div class="empty"><p>No products added yet!</p></div>';
        }
        ?>
    </div>
    <?php if($grand_total != 0) { ?> 
        <div class="cart-total">
            <p>Total amount payable: <span>Rs. <?= $grand_total; ?>/-</span></p>
            <div class="button">
                <form action="" method="post">
                    <button type="submit" name="empty_cart" class="btn" onclick="return confirm('Are you sure to empty your cart?');">Empty Cart</button>
                </form>
                <a href="checkout.php" class="btn">Proceed to checkout</a>
            </div>
        </div>
    <?php } ?>
</div>

<?php include 'components/footer.php'; ?>

<!-- SweetAlert CDN Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Custom JS Link -->
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>

</body>
</html>
