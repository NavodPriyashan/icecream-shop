<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

if (isset($_POST['update'])) {

    $select_seller =$conn->prepare("SELECT * FROM sellers WHERE id = ? LIMIT 1");
    $select_seller->execute([$seller_id]);
    $fetch_seller = $select_seller->fetch(PDO::FETCH_ASSOC);

    $prev_pass = $fetch_seller['password'];
    $prev_image = $fetch_seller['image'];

    $name = $_POST['name'];
    $name = filter_var($name);

    $email = $_POST['email'];
    $email = filter_var($email);

    //update name
    if (!empty($name)) {
        $update_name = $conn->prepare("UPDATE sellers SET name = ? WHERE id = ?");
        $update_name->execute([$name, $seller_id]);
        $success_msg[] = 'username update successfully';
    }

         //update email
    if (!empty($email)) {
        $select_email = $conn->prepare("SELECT * FROM sellers WHERE id = ? AND email = ?");
        $select_email->execute([$seller_id, $email]);

        if ($select_email->rowCount() > 0) {
            $warning_msg[] = 'Email already exist';
        } else {
            $update_email = $conn->prepare("UPDATE sellers SET email = ? WHERE id =? ");
            $update_email->execute([$email, $seller_id]);
            $success_msg[] = 'email update successfully';
        }
    }

    //update image
    $image = $_FILES['image']['name'];
    $image = filter_var($image);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_file/'.$rename;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        }else{
            $update_image = $conn->prepare("UPDATE sellers SET image = ? WHERE id = ?");
            $update_image->execute([$rename, $seller_id]);
            move_uploaded_file($image_tmp_name, $image_folder);

            if ($prev_image != '' AND $prev_image != $rename) {
                unlink('../uploaded_file/'.$prev_image);
            }
            $success_msg[] = 'image updated successfully';
        }
    }

    //update password

    $empty_pass = '';

    $prev_pass = ($_POST['old_pass']);
    $prev_pass = filter_var($prev_pass);

    
    $new_pass = ($_POST['new_pass']);
    $new_pass = filter_var($new_pass);

    
    $cpass = ($_POST['cpass']);
    $cpass = filter_var($cpass);

    if ($prev_pass != $empty_pass) {
        if ($prev_pass != $prev_pass) {
            $warning_msg[] = ' Old password not matched';
        } elseif($new_pass != $cpass) {
            $warning_msg[] = 'password not matched';
        } else {
            
            if ($new_pass != $empty_pass) {
                
                $update_pass = $conn->prepare("UPDATE sellers SET password = ? WHERE id = ?");
                
                $update_pass->execute([$cpass, $seller_id]);
                $success_msg[] = 'password update successfully';
            }else{
                $warning_msg[] = 'please enter a new password';
            }
        }
    }







}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Seller Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
      
<div class="main-container">
    <?php include '../components/admin_header.php'; ?>
    <section class="form-container">
        <div class="heading">
            <h1>Update Profile Details</h1>
            <img src="../image/separator-img.png">
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="img-box">
                <img src="../uploaded_file/<?= $fetch_profile['image']; ?>" >
            </div>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your Name <span>*</span></p>
                        <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Your Email <span>*</span></p>
                        <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Select Picture <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                    </div>
                </div>
                
                <div class="col">
                    <div class="input-field">
                        <p>Old Password <span>*</span></p>
                        <input type="password" name="old_pass" placeholder="Enter Your Old Password" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>New Password <span>*</span></p>
                        <input type="password" name="new_pass" placeholder="Enter Your New Password" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Confirm Password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm Your New Password" class="box" required>
                    </div>
                </div>
            </div>
            <div class="flex-btn">
                <input type="submit" name="update" value="Update Profile" class="btn">
            </div>
        </form>
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