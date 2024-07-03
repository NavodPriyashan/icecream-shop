<?php
include '../components/connect.php';

if(isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
}else{
    $seller_id = '';
    header('location:login.php');
}
//delete product
if(isset($_POST['delete'])){
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id);

    $delete_product = $conn->prepare("delete from products where id = ?");
    $delete_product->execute([$p_id]);

    $success_msg[] = 'product deleted successfully!';
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
    <title>View Products</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
      
   <div class="main-container">
             <?php include '../components/admin_header.php'; ?>
     <section class="show-post">
        <div class="heading">
            <h1>Add Products</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            $select_products = $conn->prepare("select * from products where seller_id = ?");
            $select_products->execute([$seller_id]);
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                 
                 
                 
                 
                 
            
             

            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <?php if($fetch_products['image'] !=''){ ?>
                    <img src="../uploaded_file/<?= $fetch_products['image']; ?>" class="image">
                    <?php } ?>
                    <div class="status" style="color: <?php if($fetch_products['status'] == 'active'){
                        echo "limegreen";}else{echo "red";}?>"><?= $fetch_products['status']; ?>
                    </div>
                    <div class="price">Rs.<?= $fetch_products['price']; ?>/=</div>
                    <div class="post-content">
                        <img src="../image/shape-19.png" class="shap">
                        <div class="title"><?= $fetch_products['name']; ?></div>
                        <div class="flex-btn">
                            <a href="edit_product.php?id=<?= $fetch_products['id']; ?>" class="btn">Edit</a>
                            <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this Product');">Delete</button>
                            <a href="read_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn">Read</a>
                        </div>
                    </div>


            </form>
            
            <?php 
                }
            }else{
                  echo '
                  <div class="empty">
                    <p>No Product add yet! <br><a href="add_products.php" class="btn" style="margin-top:1.5rem"> Add Products</a></p>

                 </div>
                  
                  '; 
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
        echo '<script>swal("'.$msg.'");</script>';
    }
}
?>

</body>
</html>
