<?php
include '../components/connect.php';

if(isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
}else{
    $seller_id = '';
    header('location:login.php');
}
 
 //update order from database

 if (isset($_POST['update_order'])) {

    $order_id = $_POST['ordr_id'];
    $order_id = filter_var($order_id);

    $update_payment = $_POST('updaet_payment');
    $update_payment = filter_var($update_payment);

    $update_pay = $conn->prepare("UPDATE orders SET payment status = ? WHERE id = ?");
    $update_pay->execute([$update_payment, $order_id]);
    $success_msg[] = 'order payment status update';
 }
 //delete order 

 if (isset($_POST['delete_order'])) {

    $delete_id = $_POST['order_id'];
    $delete_id = filter_var($delete_id);

    $verify_delete = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $verify_delete->execute[$delete_id];

    if ($verify_delete->rowCount() > 0) {
        $delete_order = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $delete_order->execute([$delete_id]);

        $success_msg[] = 'order deleted';

    }else{
        $warning_msg[] = 'order alredy deleted';
    }
 }
 


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Total Orders</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
      
   <div class="main-container">
             <?php include '../components/admin_header.php'; ?>
     <section class="order-container">
        <div class="heading">
            <h1>Total Orders Placed</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            $select_order = $conn->prepare("SELECT * FROM orders WHERE seller_id = ? ");
            $select_order->execute([$seller_id]);

            if ($select_order->rowCount() > 0) {
                while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){

            ?>
            <div class="box">
                <div class="status" style="color: <?php if($fetch_order['status']=='in progress'){echo "limegreen"; }else{echo "red"; } ?>"> <?= $fetch_order['status']; ?>

                </div>
                <div class="details">
                    <p> user name : <span><?= $fetch_order['name']; ?></span></p>
                    <p> user id : <span><?= $fetch_order['user_id']; ?></span></p>
                    <p> placed on : <span><?= $fetch_order['date']; ?></span></p>
                    <p> user number : <span><?= $fetch_order['number']; ?></span></p>
                    <p> user email : <span><?= $fetch_order['email']; ?></span></p>
                    <p> total price : <span><?= $fetch_order['price']; ?></span></p>
                    <p> payment method : <span><?= $fetch_order['method']; ?></span></p>
                    <p> user address : <span><?= $fetch_order['address']; ?></span></p>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value=" <?= $fetch_order['id']; ?>">
                    <select name="update_payment" class="box" style="width: 90%;" >
                    <option disable selected><?= $fetch_order['payment_status']; ?></option>
                    <option value="pending">Pending</option>
                    <option value="order deliverd">Order Deliverd</option>

                    </select>
                    <div class="flex-btn">
                        <input type="submit" name="update_order" value="update payment" class="btn">
                        <input type="submit" name="delete_order" value="delete payment" class="btn" onclick="return coonfirm('delete this order');">
                    </div>

                </form>
            </div>

            <?php
                 }
                }else{
                    echo '
                    <div class="empty">
                      <p>No order placed !</p>
  
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
