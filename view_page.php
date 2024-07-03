<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else {
    $user_id = '';   
}

$pid = $_GET['pid'];

include 'components/add_wishlist.php';
include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Product details</h1>
        <p>We are excited to introduce our new and improved registration form! This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Product details</span>
    </div>
</div>

<section class="view_page">
    <div class="heading">
        <h1>Product Details</h1>
        <img src="image/separator-img.png">
    </div>
    <?php
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];

        $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $select_products->execute([$pid]);

        if ($select_products->rowCount() > 0) {
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

     
    ?>
    <form action="" method="post" class="box">
        <div class="img-box">
            <img src="uploaded_file/<?= $fetch_products['image']; ?>">
        </div>
        <div class="detail">
        <?php if($fetch_products['stock'] > 9){ ?>
                <span class="stock" style="color: green;">In Stock</span>
            <?php } elseif($fetch_products['stock'] == 0){ ?>
                <span class="stock" style="color: red;">Out of stock</span>
            <?php } else { ?> 
                <span class="stock" style="color: red;">Hurry, only <?= ($fetch_products['stock']); ?> left</span>
            <?php } ?>

            <p class="price">Rs<?= $fetch_products['price']; ?>/-</p>
            <div class="name"><?= $fetch_products['name']; ?></div>
            <p class="product-detail"><?= $fetch_products['product_detail']; ?></p>
            <input type="hidden" name="product_id" value="<?= $fetch_products['id'];?>">

            <div class="button">
                <button type="submit" name="add_to_wishlist" class="btn">Add to Wishlist<i class="bx bx-heart"></i></button>
                <input type="hidden" name="qty" value="1" min="0" class="quantity">
                <button type="submit" name="add_to_cart" class="btn">Add to Cart<i class="bx bx-cart"></i></button>

            </div>
        </div>

    </form>


    <?php
           }
        }
    }
    
    ?>

</section>
<div class="products">
    <div class="heading">
        <h1>Similar Prodcuts</h1>
        <p>Welcome , where every scoop is a delight! Explore our wide range of delicious ice cream flavors,
             from classic favorites like Vanilla Delight and Chocolate Heaven to gourmet selections such as Salted Caramel Swirl and Pistachio Perfection.
              Indulge in our refreshing fruit sorbets or treat yourself to our unique specialty creations like Cookies & Cream Dream and Rocky Road Adventure. Discover your new favorite flavor today and experience the joy of premium ice cream made with the finest ingredients.
               Come and taste the difference at Ice Cream Paradise!
</p>
<img src="image/separator-img.png">

    </div>
    <?php include 'components/shop.php'; ?>
</div>



<?php include 'components/footer.php'; ?>

<!--sweetalert cdn link--> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!--custom js link-->
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>

</body>
</html>
