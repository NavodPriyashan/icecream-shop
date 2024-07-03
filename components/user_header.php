<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"><img src="image/logo.png" width="130px"></a>
        
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about-us.php">About us</a>
            <a href="menu.php">Shop</a>
            <a href="order.php">Order</a>
            <a href="contact.php">Contact</a>
        </nav>
        <form action="search_product.php" method="post" class="search-form">
            <input type="text" name="search_product" placeholder="Search Product..." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" id="search_product_btn"></button>
        </form>
        <div class="icons">
            <div class="bx bx-list-plus" id="menu-btn"></div>
            <div class="bx bx-search-alt-2" id="search-btn"></div>

            <?php if ($user_id): ?>
                <?php
                $count_wishlist_items = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ?");
                $count_wishlist_items->execute([$user_id]);
                $total_wishlist_items = $count_wishlist_items->rowCount();
                ?>
                <a href="wishlist.php"><i class="bx bx-heart"></i><sup><?= $total_wishlist_items; ?></sup></a>

                <?php
                $count_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_items = $count_cart_items->rowCount();
                ?>
                <a href="cart.php"><i class="bx bx-cart"></i><sup><?= $total_cart_items; ?></sup></a>
            <?php else: ?>
                <a href="wishlist.php"><i class="bx bx-heart"></i><sup>0</sup></a>
                <a href="cart.php"><i class="bx bx-cart"></i><sup>0</sup></a>
            <?php endif; ?>

            <div class="bx bxs-user" id="user-btn"></div>
        </div>
        <div class="profile-detail">
            <?php if ($user_id): ?>
                <?php
                $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
                $select_profile->execute([$user_id]);
                if ($select_profile->rowCount() > 0):
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                    <img src="uploaded_file/<?= ($fetch_profile['image']); ?>">
                    <h3 style="margin-bottom: 1rem;"><?= ($fetch_profile['name']); ?></h3>
                    <a href="profile.php" class="btn">View Profile</a>
                    <a href="components/user_logout.php" onclick="return confirm('logout from this website');" class="btn">Logout</a>
                <?php else: ?>
                    <h3 style="margin-bottom: 1rem;">Please login or register</h3>
                    <div class="flex-btn">
                        <a href="login.php" class="btn">Login</a>
                        <a href="register.php" class="btn">Register</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <h3 style="margin-bottom: 1rem;">Please login or register</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn">Login</a>
                    <a href="register.php" class="btn">Register</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</header>