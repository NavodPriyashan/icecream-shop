<?php
include 'components/connect.php';

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];

}else{
    $user_id = '';
}

?>

<DOCTYPE html>
    <html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About-us Page</title>
        <link rel="stylesheet" type="text/css" href="css/user_style.css">
        <!--font awesome cdn link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

        </head>
        <body>

        <?php include 'components/user_header.php'; ?>

        <div class="banner">
            <div class="detail">
                <h1>About Us</h1>
                <p>
                   Welcome to our ice cream shop, where passion and creativity meet to bring you the finest frozen delights. Founded on the belief that ice cream should be a joyous experience, we take pride in crafting each flavor with care and dedication. Our journey began with a simple dream: to create a place where families and friends can gather, indulge, and create sweet memories together.

                   We use only the freshest, locally-sourced ingredients, ensuring that every scoop is a burst of genuine, delightful flavor. From timeless classics to innovative new combinations, our menu is designed to please every palate. Our team is dedicated to providing a warm, welcoming atmosphere where everyone feels at home.

                   At our core, we believe in community, quality, and happiness. We strive to make every visit to our shop a special occasion, filled with smiles and satisfaction. Thank you for being a part of our story. We look forward to serving you and making your day a little sweeter.</p>

                   <span> <a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>About Us</span>
            </div>
        </div>


    <div class="chef">
    <div class="box-container">
        <div class="box">
            <div class="heading">
                <span>Alex Deo</span>
                <h1>Master Chef</h1>
                <img src="image/separator-img.png" >
            </div>
            <p>
                Meet Chef Alex Deo, the culinary genius behind our delectable ice cream creations.
                With over a decade of experience in the world of gourmet desserts, Chef Alex brings a unique blend of creativity and expertise to our kitchen.
                His passion for using fresh, locally-sourced ingredients shines through in every flavor he crafts. Dedicated to delighting our customers, Chef Alex constantly innovates, ensuring that each scoop is a perfect balance of taste and texture.
                Join us in celebrating his talent and savor the extraordinary flavors that make our ice cream truly special.
            </p>
            <div class="flex-btn">
                <a href="#" class="btn">Explore more</a>
                <a href="menu.php" class="btn">Visit Our Shop</a>
            </div>
        </div>
        <div class="box">
            <img src="image/ceaf.png" class="img" >
        </div>
    </div>
</div>

 <!--Story section start-->

 <div class="story">
    <div class="heading">
           <h1>Our Story</h1>
           <img src="image/separator-img.png">        
    </div>
            <p>Founded on a passion for crafting exceptional ice cream experiences,<br> our journey began with a commitment to using locally-sourced ingredients and creating flavors that inspire.<br> From our humble beginnings to becoming a beloved community spot, we invite you to taste the love and dedication in every scoop.<br>
             Join us as we continue to create moments of joy,<br> one delicious flavor at a time.</p>
            <a href="menu.php" class="btn">Our Services</a>
    </div>
    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png">
            </div>
      
    
    <div class="box">
        <div class="heading">
            <h1>Taking Ice Cream To New Hights</h1>
            <img src="image/separator-img.png">
        </div>
        <p> we're redefining the ice cream experience. With a dedication to innovation and flavor, we elevate every scoop to new heights of indulgence. 
            From unique creations that blend local ingredients with global inspirations to classic favorites made with uncompromising quality, we invite you to savor the extraordinary.
             Join us on a journey where every bite reaches new levels of delight and deliciousness.</p>
             <a herf="" class="btn">Learn more.. </a>
        </div>
       </div>
    </div>

    <!--Story section end-->
    <div class="team">
        <div class="heading">
            <span>Our Team</span>
            <h1>Quality & Passion with our services</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
           <div class="box">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                     <img src="image/shape-19.png" class="shap">
                    <h2>Ralph Johnson</h2>
                    <p>Cofee Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                     <img src="image/shape-19.png" class="shap">
                    <h2>Fiona Johnson</h2>
                    <p>Pastry Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                     <img src="image/shape-19.png" class="shap">
                    <h2>Tom Knelltonns</h2>
                    <p>Cofee Chef</p>
                </div>
            </div>
        </div>
    </div>
    <!--team section end-->

    <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>Our Standerts</h1>
                <img src="image/separator-img.png">

            </div>
            <p><b>Quality Ingredients:</b> We use only the freshest, locally-sourced ingredients to create our ice cream. Supporting local farmers and producers ensures that our flavors are not only delicious but also sustainable.</p>
            <i class="bx bxs-heart"></i>
            <p><b>Craftsmanship:</b>  Each batch of ice cream is meticulously crafted with care and precision. Our dedicated team of artisans brings creativity and expertise to every flavor, ensuring the perfect balance of taste and texture.</p>
            <i class="bx bxs-heart"></i>
            <p><b>Innovation:</b> We continuously explore new flavor combinations and techniques to keep our menu exciting. From seasonal specials to unique creations, we strive to surprise and delight our customers.</p>
            <i class="bx bxs-heart"></i>
            <p><b>Customer Experience:</b> Your satisfaction is our top priority. We aim to provide a warm, welcoming atmosphere where you can enjoy your favorite treats and create lasting memories.</p>
            <i class="bx bxs-heart"></i>
            <p><b>Sustainability:</b>We are committed to environmentally friendly practices, from sourcing ingredients to packaging. Our goal is to minimize our ecological footprint while delivering exceptional quality.</p>
            <i class="bx bxs-heart"></i>
        </div>
    </div>
     <!--standers section end-->

     <div class="categories">
            <div class="heading">
                <h1>testimonial</h1>
                <img src="image/separator-img.png"></img>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="image/testimonial (1).jpg">
                    <h1>Zen Author</h1>
                    <p>Zen is the business anlalist,enterproner and media proprieter, and investor </p>
                    
                </div>
                <div class="box">
                    <img src="image/testimonial (2).jpg">
                    <h1>Zen Author</h1>
                    <p>Zen is the business anlalist,enterproner and media proprieter, and investor </p>
                    
                    
                </div>
                <div class="box">
                    <img src="image/testimonial (3).jpg">
                    <h1>Zen Author</h1>
                    <p>Zen is the business anlalist,enterproner and media proprieter, and investor </p>
                    
                   
                </div>
                <div class="box">
                    <img src="image/testimonial (4).jpg">
                    <h1>Zen Author</h1>
                    <p>Zen is the business anlalist,enterproner and media proprieter, and investor </p>
                    
                   
                </div>
            </div>
         </div>

       <!--testimonial section end-->

       <div class="mission">
        <div class="box-container">
            <div class="box">
            <div class="heading">
                <h1>Our mission</h1>
                <img src="image/separator-img.png">
            </div>
            <div class="detail">
                <div class="img-box">
                    <img src="image/mission.webp">
                </div>
                <div>
                    <h2>Mexicon Chocolate</h2>
                    <p>Mexicon Chocolate is a premium artisanal brand that celebrates the rich traditions of Mexican cacao. Crafted with the finest, sustainably sourced Mexican cacao beans,
                         each bar offers a unique blend of deep, earthy flavors and subtle hints of local spices and fruits. Mexicon Chocolate prides itself on using natural ingredients and ethical practices, resulting in a pure and delightful chocolate experience.
                          From classic dark chocolate to spiced and nut-infused varieties,
                         every bite transports you to the heart of Mexico’s vibrant chocolate-making heritage.</p>
                </div>
            </div>
            <div class="detail">
                <div class="img-box">
                    <img src="image/mission1.webp">
                </div>
                <div>
                    <h2>Vanila with Honey</h2>
                    <p>Mexicon Chocolate is a premium artisanal brand that celebrates the rich traditions of Mexican cacao. Crafted with the finest, sustainably sourced Mexican cacao beans,
                         each bar offers a unique blend of deep, earthy flavors and subtle hints of local spices and fruits. Mexicon Chocolate prides itself on using natural ingredients and ethical practices, resulting in a pure and delightful chocolate experience.
                          From classic dark chocolate to spiced and nut-infused varieties,
                         every bite transports you to the heart of Mexico’s vibrant chocolate-making heritage.</p>
                </div>
            </div>
            <div class="detail">
                <div class="img-box">
                    <img src="image/mission0.jpg">
                </div>
                <div>
                    <h2>Peparamint Chip</h2>
                    <p>Mexicon Chocolate is a premium artisanal brand that celebrates the rich traditions of Mexican cacao. Crafted with the finest, sustainably sourced Mexican cacao beans,
                         each bar offers a unique blend of deep, earthy flavors and subtle hints of local spices and fruits. Mexicon Chocolate prides itself on using natural ingredients and ethical practices, resulting in a pure and delightful chocolate experience.
                          From classic dark chocolate to spiced and nut-infused varieties,
                         every bite transports you to the heart of Mexico’s vibrant chocolate-making heritage.</p>
                </div>
            </div>
            <div class="detail">
                <div class="img-box">
                    <img src="image/mission2.webp">
                </div>
                <div>
                    <h2>Raspbearry Sarbat</h2>
                    <p>Mexicon Chocolate is a premium artisanal brand that celebrates the rich traditions of Mexican cacao. Crafted with the finest, sustainably sourced Mexican cacao beans,
                         each bar offers a unique blend of deep, earthy flavors and subtle hints of local spices and fruits. Mexicon Chocolate prides itself on using natural ingredients and ethical practices, resulting in a pure and delightful chocolate experience.
                          From classic dark chocolate to spiced and nut-infused varieties,
                         every bite transports you to the heart of Mexico’s vibrant chocolate-making heritage.</p>
                </div>
            </div>
        </div>
        <div class="box">
            <img src="image/form.png" alt="" class="img">
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
