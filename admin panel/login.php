<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {
    
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    
    
    

    
        
        $select_sellers = $conn->prepare("SELECT * FROM sellers WHERE email = ? AND password = ? ");
        $select_sellers->execute([$email, $pass]);
        $row = $select_sellers->fetch(PDO::FETCH_ASSOC);

        if ($select_sellers->rowCount() > 0) {
            setcookie('seller_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:dashboard.php');
        }else{
            $warning_msg[] = 'Incorrect Email or Password';
        }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="login">
        <h3>Login Now</h3>

        <div class="input-field">
                <p>Your Email<span>*</span></p>
                <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
        </div>

         <div class="input-field">
                <p>Your Password<span>*</span></p>
                <input type="password" name="pass" placeholder="Enter your password" maxlength="50" required class="box">
        </div>


       
            
            <p class="link">Do not have an account?<a href="register.php">Register Now</a></p>
            <input type="submit" name="submit" value="Login Now" class="btn">
        
    </form>
</div>

<!--sweetalert cdn link--> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!--custom js link-->
<script src="../js/script.js"></script>
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
