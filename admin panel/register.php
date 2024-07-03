<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    $cpass = htmlspecialchars($_POST['cpass']);
    
    // File upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_file/';

        // Create the directory if it doesn't exist
        if (!is_dir($image_folder)) {
            mkdir($image_folder, 0777, true);
        }

        $image_path = $image_folder . $image;

        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // File uploaded successfully
        } else {
            $message[] = 'Failed to upload image!';
        }
    } else {
        $image = ''; // Handle case where no image is uploaded
        $message[] = 'Please select an image!';
    }

    if ($pass != $cpass) {
        $message[] = 'Passwords do not match!';
    } else {
        // Check if the user already exists
        $select_sellers = $conn->prepare("SELECT * FROM sellers WHERE email = ?");
        $select_sellers->execute([$email]);
        if ($select_sellers->rowCount() > 0) {
            $message[] = 'User already exists!';
        } else {
            

            // Insert user data into the database
            $insert = $conn->prepare("INSERT INTO sellers(name, email, password, image) VALUES(?, ?, ?, ?)");
            $insert->execute([$name, $email, $pass, $image]);

            if ($insert) {
                $message[] = 'Registration successful!';
            } else {
                $message[] = 'Registration failed!';
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
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="register">
        <h3>Register Now</h3>
        <div class="flex">
            <div class="col">
                <div class="input-field">
                    <p>Your Name<span>*</span></p>
                    <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                    <p>Your Email<span>*</span></p>
                    <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
                </div>
            </div>
            <div class="col">
                <div class="input-field">
                    <p>Your Password<span>*</span></p>
                    <input type="password" name="pass" placeholder="Enter your password" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                    <p>Confirm Your Password<span>*</span></p>
                    <input type="password" name="cpass" placeholder="Confirm your password" maxlength="50" required class="box">
                </div>
            </div>
            <div class="input-field">
                <p>Your Profile<span>*</span></p>
                <input type="file" name="image" accept="image/*" required class="box">
            </div>
        </div>
            <p class="link">Already have an account?<a href="login.php">Login Now</a></p>
            <input type="submit" name="submit" value="Register Now" class="btn">
        
    </form>
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
