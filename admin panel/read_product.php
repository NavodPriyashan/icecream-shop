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

    $delete_image = $conn->prepare("delete from products where id = ? and seller_id = ? ");
    $delete_image->execute([$p_id, $seller_id]);

    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_delete_image[''] != '') {
        unlink('../uploaded_file/'.$fetch_delete_image['image']);
    }
    $delete_product = $conn->prepare("delete from products where id = ? and seller_id = ?");
    $delete_product->execute([$p_id, $seller_id]);
    header("location:view_product.php");

    
}
$get_id = $_GET['post_id']; 




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Read Products</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
      
   <div class="main-container">
             <?php include '../components/admin_header.php'; ?>
     <section class="read-post">
        <div class="heading">
            <h1>Product Details</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            $select_product = $conn->prepare("select * from products where id = ? and seller_id = ? ");
            $select_product->execute([$get_id, $seller_id]);
            if($select_product->rowCount() > 0){
                while($fetch_products = $select_product->fetch(PDO::FETCH_ASSOC)){

               
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="status" style="color: <?php if($fetch_products['status'] == 'active'){
                        echo "limegreen";}else{echo "coral";}?>"><?= $fetch_products['status']; ?>
                    </div>

                <?php if($fetch_products['image'] != ''){ ?>
                    <img src="../uploaded_file/<?= $fetch_products['image']; ?>" class="image">
                 <?php } ?>
                 <div class="price">Rs.<?= $fetch_products['price']; ?>/=</div>
                 <div class="title"><?= $fetch_products['name']; ?></div>
                 <div class="content"><?= $fetch_products['product_detail']; ?></div>
                 <div class="flex-btn">
                    <a href="edit_product.php?id=<?= $fetch_products['id']; ?>" class="btn">Edit</a>
                    <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">Delete</button>
                    <a href="view_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn">Go Back</a>
                 </div>

            </form>
            <?php 
                }
            } else {
                  echo '
                  <div class="empty">
                    <p>No Product add yet! <br><a href="add_products.php" class="btn" style="margin-top:1.5rem"> Add Products</a></p>
                 </div>'; 
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
