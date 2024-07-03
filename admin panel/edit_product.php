<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
    exit();
}

if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id);

    $name = $_POST['name'];
    $name = filter_var($name);

    $price = $_POST['price'];
    $price = filter_var($price);

    $description = $_POST['description']; 
    $description = filter_var($description);

    $stock = $_POST['stock'];
    $stock = filter_var($stock);
    $status = $_POST['status'];
    $status = filter_var($status);

    $update_product = $conn->prepare("UPDATE products SET name = ?, price = ?, product_detail = ?, stock = ?, status = ? WHERE id = ?");
    $update_product->execute([$name, $price, $description, $stock, $status, $product_id]);

    $success_msg[] = 'Product updated';

    $old_image = $_POST['old_image'];

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_file/' . $image;

    $select_image = $conn->prepare("SELECT * FROM products WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'Image size is too large';
        } elseif ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Please rename your image';
        } else {
            $update_image = $conn->prepare("UPDATE products SET image = ? WHERE id = ?");
            $update_image->execute([$image, $product_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            if ($old_image != $image && $old_image != '') {
                unlink('../uploaded_file/' . $old_image);
            }
            $success_msg[] = 'Image updated!';
        }
    }
}

//delete image
if (isset($_POST['delete_image'])) {
    $empty_image = '';

    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id);

    $delete_image = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $delete_image->execute([$product_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image['image'] != '') {
        unlink('../uploaded_file/' .$fetch_delete_image['image']);
    }
    $unset_image = $conn->prepare("UPDATE products SET image = ? WHERE id = ?");
    $unset_image->execute([$empty_image, $product_id]);
    $success_msg[] = 'image delete successfully';
}

//delete Product
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id);

    $delete_image = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $delete_image->execute([$product_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image['image'] != '') {
        unlink('../uploaded_file/'.$fetch_delete_image['image']);
    }
    $delete_product = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delete_product->execute([$product_id]);
    $success_msg[] = 'Product delete successfully';
    header('location:view_product.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
   <div class="main-container">
       <?php include '../components/admin_header.php'; ?>
       <section class="post-editor">
            <div class="heading">
                <h1>Edit Product</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                $product_id = $_GET['id'];
                $select_products = $conn->prepare("SELECT * FROM products WHERE id = ? AND seller_id = ?");
                $select_products->execute([$product_id, $seller_id]);
                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="form-container">
                        <form action="" method="post" enctype="multipart/form-data" class="register">
                            <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                            <div class="input-field">
                                <p>Product status<span>*</span></p>
                                <select name="status" class="box">
                                    <option value="<?= $fetch_product['status']; ?>" selected><?= $fetch_product['status']; ?></option>
                                    <option value="active">active</option>
                                    <option value="deactive">deactive</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <p>Product Name<span>*</span></p>
                                <input type="text" name="name" value="<?= $fetch_product['name']; ?>" class="box">   
                            </div>
                            <div class="input-field">
                                <p>Product Price<span>*</span></p>
                                <input type="number" name="price" value="<?= $fetch_product['price']; ?>" class="box">   
                            </div>
                            <div class="input-field">
                                <p>Product description<span>*</span></p>
                                <textarea name="description" class="box"><?= $fetch_product['product_detail']; ?></textarea>  
                            </div>
                            <div class="input-field">
                                <p>Product stock<span>*</span></p>
                                <input type="number" name="stock" value="<?= $fetch_product['stock']; ?>" class="box" min="0" max="999999999" maxlength="10">   
                            </div>
                            <div class="input-field">
                                <p>Product image<span>*</span></p>
                                <input type="file" name="image" accept="image/*" class="box"> 
                                <?php if ($fetch_product['image'] != '') { ?>  
                                    <img src="../uploaded_file/<?= $fetch_product['image']; ?>" class="image">
                                    <div class="flex-btn">
                                        <input type="submit" name="delete_image" class="btn" value="delete image">
                                        <a href="view_product.php" class="btn" style="width: 49%; text-align: center; height: 3rem; margin-top: .7rem">Go back</a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="flex-btn">
                                <input type="submit" name="update" value="Update Product" class="btn">
                                <input type="submit" name="delete_product" value="Delete Product" class="btn">
                            </div>
                        </form> 
                    </div>
                <?php
                    }
                } else {
                    echo '<div class="empty"><p>No Product added yet!</p></div>';
                }
                ?>
                
            </div>
        </section>
    </div>

    <!--sweetalert cdn link--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!--custom js link-->
    <script src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>

    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<script>swal("' . $msg . '");</script>';
        }
    }
    ?>
</body>
</html>
