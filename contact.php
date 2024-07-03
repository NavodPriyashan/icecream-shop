<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else {
    $user_id = '';

    
}
if (isset($_POST['send_message'])) {
    if ($user_id != '') {

        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name);

        $email = $_POST['email'];
        $email = filter_var($email);

        $subject = $_POST['subject'];
        $subject = filter_var($subject);

        $message = $_POST['message'];
        $message = filter_var($message);

        $verify_message = $conn->prepare("SELECT * FROM message WHERE user_id = ? AND email = ? AND subject = ? AND message = ?");
        $verify_message->execute([$user_id, $email, $subject, $message]);

        if ($verify_message->rowCount() > 0) {
            $warning_msg[] = 'Message already exists';
        } else {
            $insert_message = $conn->prepare("INSERT INTO message (id, user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);

            $success_msg[] = 'Comment inserted successfully';
        }
    } else {
        $warning_msg[] = 'Please log in first';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Contact</h1>
        <p>We are excited to introduce our new and improved registration form! This update is designed to make your sign-up process quicker, easier, and more secure.</p>
        <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Contact</span>
    </div>
</div>
<div class="services">
    <div class="heading">
        <h1>Our Services</h1>
        <p>Just A Few CLick To Make The Reservation Online For Saving Your Time And Money</p>
        <img src="image/separator-img.png">
    </div>
    <div class="box-container">
        <div class="box">
            <img src="image/0.png">
                <div>
                    <h1>Free Shiping Fast</h1>
                    <p>Indulge in your favorite ice cream flavors and have them delivered straight to your door without any extra cost. we offer free shipping on all orders, 
                        making it easier than ever to enjoy our delicious treats. 
                        Order now and experience the convenience of free delivery!</p>
                </div>
        </div>

        <div class="box">
            <img src="image/1.png">
                <div>
                    <h1>Money Back & Guarantee</h1>
                    <p>Indulge in your favorite ice cream flavors with confidence.  we offer free shipping on all orders, ensuring your treats arrive at your doorstep without any extra cost.
                         Plus, our money-back guarantee means if you're not completely satisfied, we'll make it right.
                         Order now and experience the ultimate peace of mind with our premium ice cream and exceptional service!</p>
                </div>
        </div>

        <div class="box">
            <img src="image/2.png">
                <div>
                    <h1>Online Support 24/7</h1>
                    <p>Indulge in your favorite ice cream flavors with complete peace of mind.  we offer free shipping on all orders, ensuring your treats arrive at your doorstep without any extra cost.
                         Our money-back guarantee means if you're not completely satisfied, we'll make it right. Plus, with our 24/7 online support, we're here to assist you anytime, day or night. 
                        Order now and experience the best in premium ice cream and exceptional service!</p>
                </div>
        </div>
    </div>
</div>

<div class="form-container">
    <div class="heading">
        <h1>Drop us a Line</h1>
        <p>Just a Few Click To Make The Reservation Online For Saving Your Time And Money</p>
        <img src="image/separator-img.png">

    </div>
    <form action="" method="post" class="register">
        <div class="input-field">
            <label>Name<sup>*</sup></label>
            <input type="text" name="name" required placeholder="Enter your Name" class="box">
        </div>

        <div class="input-field">
            <label>Email<sup>*</sup></label>
            <input type="email" name="email" required placeholder="Enter your Email" class="box">
        </div>

        <div class="input-field">
            <label>Subject<sup>*</sup></label>
            <input type="text" name="subject" required placeholder="Reason..." class="box">
        </div>

        <div class="input-field">
            <label>Comment<sup>*</sup></label>
            <textarea name="message" cols="30" rows="10" required placeholder="" class="box"></textarea>
        </div>

        <button type="submit" name="send_message" class="btn">Send Message</button>

    </form>
</div>
<div class="address">
    <div class="heading">
        <h1>Our Contact Details</h1>
        <p>Just a Few Click To Make The Reservation Online For Saving Your Time And Money</p>
        <img src="image/separator-img.png">
    </div>

    <div class="box-container">

        <div class="box">
            <i class="bx bxs-map-alt"></i>
            <div>
                <h4>Address</h4>
                <p>Palamagoda,Rathgama, <br> Galle,Sri-lanka</p>
            </div>
        </div>

        <div class="box">
            <i class="bx bxs-phone-incoming"></i>
            <div>
                <h4>Phone Number</h4>
                <p>078-26 86 176</p>
            </div>
        </div>

        <div class="box">
            <i class="bx bxs-envelope"></i>
            <div>
                <h4>Email</h4>
                <p>navodpriyashan14@gmail.com</p>
            </div>
        </div>

    </div>
</div>



 

<?php include 'components/footer.php'; ?>

<!--sweetalert cdn link--> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!--custom js link-->
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>

</body>
</html>
