<?php
include '../components/connect.php';

if(isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
}else{
    $seller_id = '';
    header('location:login.php');
}

//add product in database

if(isset($_POST['publish'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name);

    $price = $_POST['price'];
    $price = filter_var($price);

    $decription = $_POST['decription'];
    $decription = filter_var($decription);

    $stock = $_POST['stock'];
    $stock = filter_var($stock);
    $status = 'active';

    $image = $_FILES ['image']['name'];
    $image = filter_var($image);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_file/' .$image;

    $select_image = $conn->prepare("select * from products where image = ? and seller_id = ? ");

    $select_image->execute([$image,$seller_id]);

    if(isset($image)) {
        if ($select_image->rowCount() > 0) {
           $warning_msg[] = 'image name repeated'; 
        }elseif($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        }else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image = '';
    }
    if ($select_image->rowCount() > 0 and $image != ''){
        $warning_msg[] = 'Please rename Your image';
    }else{
        $insert_product = $conn->prepare("insert into products (id, seller_id, name, price, image, stock, product_detail, status) values (?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $decription, $status]);
        $success_msg[] = 'Product insert successfully';
    }
}

if(isset($_POST['draft'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name);

    $price = $_POST['price'];
    $price = filter_var($price);

    $decription = $_POST['decription'];
    $decription = filter_var($decription);

    $stock = $_POST['stock'];
    $stock = filter_var($stock);
    $status = 'deactive';

    $image = $_FILES ['image']['name'];
    $image = filter_var($image);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_file/' .$image;

    $select_image = $conn->prepare("select * from products where image = ? and seller_id = ? ");

    $select_image->execute([$image,$seller_id]);

    if(isset($image)) {
        if ($select_image->rowCount() > 0) {
           $warning_msg[] = 'image name repeated'; 
        }elseif($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        }else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image = '';
    }
    if ($select_image->rowCount() > 0 and $image != ''){
        $warning_msg[] = 'Please rename Your image';
    }else{
        $insert_product = $conn->prepare("insert into products (id, seller_id, name, price, image, stock, product_detail, status) values (?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $decription, $status]);
        $success_msg[] = 'Product saved as draft successfully';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Products</title>
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
            <h1>Add Products</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="input-field">
                    <p>Product Name<span>*</span></p>
                    <input type="text" name="name" maxlength="100" placeholder="add product name" required class="box">
                </div>
                <div class="input-field">
                    <p>Product Price<span>*</span></p>
                    <input type="number" name="price" maxlength="100" placeholder="add product price" required class="box">
                </div>
                <div class="input-field">
                    <p>Product Details<span>*</span></p>
                    <textarea name="decription" required maxlength="1000" placeholder="add product details" class="box"></textarea>
                </div>
                <div class="input-field">
                    <p>Product Stock<span>*</span></p>
                    <input type="number" name="stock" maxlength="10" min="0" max="999999999" placeholder="add product stock" required class="box">
                </div>
                <div class="input-field">
                    <p>Product Image<span>*</span></p>
                    <input type="file" name="image" accept="image/*" required class="box">
                </div>
                <div class="flex-btn">
                    <input type="submit" name="publish" value="add product" class="btn">
                    <input type="submit" name="draft" value="Save as Draft" class="btn">
                </div>
                

            </form>
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
        echo '<script>swal("'.$msg.'");</script>';
    }
}
?>

</body>
</html>
