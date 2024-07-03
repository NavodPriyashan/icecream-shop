<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else {
    $user_id = '';
    header('location:login.php');
    exit();
}

if (isset($_POST['place_order'])) {
    $name = filter_var($_POST['name']);
    $number = filter_var($_POST['number']);
    $email = filter_var($_POST['email']);
    $address = filter_var($_POST['flat'] . ',' . $_POST['street'] . ',' . $_POST['city'] . ',' . $_POST['country'] . ',' . $_POST['pin']);
    $address_type = filter_var($_POST['address_type']);
    $method = filter_var($_POST['method']);

    $verify_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $verify_cart->execute([$user_id]);

    if (isset($_GET['get_id'])) {
        $get_product = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
        $get_product->execute([$_GET['get_id']]);

        if ($get_product->rowCount() > 0) {
            while ($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)) {
                $seller_id = $fetch_p['seller_id'];

                $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_order->execute([uniqid(), $user_id, $seller_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);

                header('location:order.php');
                exit();
            }
        } else {
            $warning_msg[] = 'Something went wrong!';
        }
    } elseif ($verify_cart->rowCount() > 0) {
        while ($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)) {
            $s_products = $conn->prepare("SELECT * FROM products WHERE id= ? LIMIT 1");
            $s_products->execute([$f_cart['product_id']]);
            $f_product = $s_products->fetch(PDO::FETCH_ASSOC);

            $seller_id = $f_product['seller_id'];

            $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([uniqid(), $user_id, $seller_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_product['price'], $f_cart['qty']]);
        }

        if ($insert_order) {
            $delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $delete_cart->execute([$user_id]);
            header('location:order.php');
            exit();
        }
    } else {
        $warning_msg[] = 'Something went wrong!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Checkout</h1>
        <p>We are excited to introduce our new and improved registration form! This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Checkout</span>
    </div>
</div>

<div class="checkout">
    <div class="heading">
        <h1>Checkout Summary</h1>
        <img src="image/separator-img.png">
    </div>
    <div class="row">
        <form action="" method="post" class="register">
            <input type="hidden" name="p_id" value="<?= isset($_GET['get_id']) ? $_GET['get_id'] : ''; ?>">
            <h3>Billing Details</h3>
            <div class="flex">
                <div class="box">
                    <div class="input-field">
                        <p>Your Name<span>*</span></p>
                        <input type="text" name="name" required maxlength="50" placeholder="Enter Your Name" class="input">
                    </div>
                    <div class="input-field">
                        <p>Your Number<span>*</span></p>
                        <input type="number" name="number" required maxlength="12" placeholder="Enter Your Number" class="input">
                    </div>
                    <div class="input-field">
                        <p>Your Email<span>*</span></p>
                        <input type="email" name="email" required maxlength="50" placeholder="Enter Your Email" class="input">
                    </div>
                    <div class="input-field">
                        <p>Payment Method<span>*</span></p>
                       <select name="method" class="input">
                        <option value="cash on delivery">Cash On Delivery</option>
                        <option value="credit or debit card">Credit or Debit Card</option>
                        <option value="net banking">Net Banking</option>
                        <option value="binance pay">Binance Pay</option>
                       </select>
                    </div>
                    <div class="input-field">
                        <p>Address Type<span>*</span></p>
                       <select name="address_type" class="input">
                        <option value="home">Home</option>
                        <option value="office">Office</option>
                       </select>
                    </div>
                </div>
                <div class="box">
                    <div class="input-field">
                        <p>Address line 01<span>*</span></p>
                        <input type="text" name="flat" required maxlength="50" placeholder="e.g. Flat or building name" class="input">
                    </div>
                    <div class="input-field">
                        <p>Address line 02<span>*</span></p>
                        <input type="text" name="street" required maxlength="50" placeholder="e.g. Street name" class="input">
                    </div>
                    <div class="input-field">
                        <p>City Name<span>*</span></p>
                        <input type="text" name="city" required maxlength="50" placeholder="Enter Your City" class="input">
                    </div> 
                    <div class="input-field">
                        <p>Country Name<span>*</span></p>
                        <input type="text" name="country" required maxlength="50" placeholder="Enter Your Country" class="input">
                    </div>
                    <div class="input-field">
                        <p>Pin Code<span>*</span></p>
                        <input type="number" name="pin" required maxlength="10" placeholder="e.g. 80800" class="input">
                    </div>
                </div>
            </div>
            <button type="submit" name="place_order" class="btn">Place Order</button>
        </form>
        <div class="summary">
            <h3>My Bag</h3>
            <div class="box-container">
                <?php
                $grand_total = 0;
                if (isset($_GET['get_id'])) {
                    $select_get = $conn->prepare("SELECT * FROM products WHERE id = ?");
                    $select_get->execute([$_GET['get_id']]);
                    while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                        $sub_total = $fetch_get['price'];
                        $grand_total += $sub_total;
                ?>
                <div class="flex">
                    <img src="uploaded_file/<?= $fetch_get['image']; ?>" class="image">
                    <div>
                        <h3 class="name"><?= $fetch_get['name']; ?></h3>
                        <p class="price"><?= $fetch_get['price']; ?></p>
                    </div>
                </div>
                <?php
                    }
                } else {
                    $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                    $select_cart->execute([$user_id]);
                    if ($select_cart->rowCount() > 0) {
                        while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                            $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                            $select_products->execute([$fetch_cart['product_id']]);
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                            $sub_total = ($fetch_cart['qty'] * $fetch_products['price']);
                            $grand_total += $sub_total;
                ?>
                <div class="flex">
                    <img src="uploaded_file/<?= $fetch_products['image']; ?>" class="image">
                    <div>
                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                        <p class="price"><?= $fetch_products['price']; ?> x <?= $fetch_cart['qty']; ?></p>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        echo '<div class="empty"><p>Your Cart is empty!</p></div>';
                    }
                }
                ?>
            </div>
            <div class="grand-total"><span>Total amount payable:</span> Rs<?= $grand_total; ?></div>
        </div>
    </div>
</div>

<?php include 'components/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>

</body>
</html>
