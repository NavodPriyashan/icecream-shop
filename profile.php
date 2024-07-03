<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else {
    header('Location: login.php');
    exit();
}

// Fetch user profile details
$select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Fetch total orders
$select_orders = $conn->prepare("SELECT COUNT(*) FROM orders WHERE id = ?");
$select_orders->execute([$user_id]);
$total_orders = $select_orders->fetchColumn();

// Fetch total messages
$select_message = $conn->prepare("SELECT COUNT(*) FROM message WHERE id = ?");
$select_message->execute([$user_id]);
$total_message = $select_message->fetchColumn();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Profile</h1>
        <p>We are excited to introduce our new and improved registration form!
           This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <span> <a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Profile</span>
    </div>
</div>

<section class="profile">
    <div class="heading">
        <h1>Profile Details</h1>
        <img src="image/separator-img.png">
    </div>
    <div class="details">
        <div class="user">
            <img src="uploaded_file/<?= ($fetch_profile['image']); ?>">
            <h3><?= ($fetch_profile['name']); ?></h3>
            <p>User</p>
            <a href="update.php" class="btn">Update Profile</a>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="flex">
                    <i class=" bx bxs-folder-minus"></i>
                    <h3><?= ($total_orders); ?></h3>
                </div>
                <a href="order.php" class="btn">View Orders</a>
            </div>
            <div class="box">
                <div class="flex">
                    <i class=" bx bxs-chat"></i>
                    <h3><?= ($total_message); ?></h3>
                </div>
                <a href="message.php" class="btn">View Message</a>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>

<!--sweetalert cdn link--> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!--custom js link-->
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>
</body>
</html>
