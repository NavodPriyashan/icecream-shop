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
        <title>Home Page</title>
        <link rel="stylesheet" type="text/css" href="css/user_style.css">
        <!--font awesome cdn link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

        </head>
        <body>

        <?php include 'components/user_header.php'; ?>

        <!----Slider Section Start----->
        <div class="slider-container">
            <div class="slide">
                <div class="slideBox active">
                    <div class="textBox">
                        <h1>We pride ourself on <br> exceptional flavors</h1>
                        <a herf="menu.php" class="btn">Shop Now</a>
                    </div>
                    <div class="imgBox">
                        <img src="image/slider.jpg">
                    </div>

                </div>
                <div class="slideBox ">
                    <div class="textBox">
                        <h1>Cold trats are my kind <br> of comfort food</h1>
                        <a herf="menu.php" class="btn">Shop Now</a>
                    </div>
                    <div class="imgBox">
                        <img src="image/slider0.jpg">
                    </div>

                </div>
            </div>
            <ul class="controls">
                <li onnclick="nextSlider();" class="next"><i class="bx bx-right-arrow-alt"></i></li>
                <li onnclick="prevSlider();" class="prev"><i class="bx bx-left-arrow-alt"></i></li>
            </ul>
        </div>

         <!----Slider Section End----->

         <div class="service">
            <div class="box-container">
                <!--service item box---->
                <div class="box">
                    <div class="icon">
                        <div class="icone-box">
                            <img src="image/services.png" class="img1">
                            <img src="image/services (1).png" class="img2">
                        </div>
                    </div>
                    <div class="detail">
                        <h4>delivary</h4>
                        <span>100% secure</span>
                    </div>
                </div>
                 <!--service item box---->
                 <!--service item box---->
                <div class="box">
                    <div class="icon">
                        <div class="icone-box">
                            <img src="image/services (2).png" class="img1">
                            <img src="image/services (3).png" class="img2">
                        </div>
                    </div>
                    <div class="detail">
                        <h4>Support</h4>
                        <span>24*7 Service</span>
                    </div>
                </div>
                 <!--service item box---->
                   <!--service item box---->
                <div class="box">
                    <div class="icon">
                        <div class="icone-box">
                            <img src="image/services (5).png" class="img1">
                            <img src="image/services (6).png" class="img2">
                        </div>
                    </div>
                    <div class="detail">
                        <h4>Payment</h4>
                        <span>100% secure</span>
                    </div>
                </div>
                 <!--service item box---->
                   <!--service item box---->
                <div class="box">
                    <div class="icon">
                        <div class="icone-box">
                            <img src="image/services (7).png" class="img1">
                            <img src="image/services (8).png" class="img2">
                        </div>
                    </div>
                    <div class="detail">
                        <h4>Gift</h4>
                        <span> gift service</span>
                    </div>
                </div>
                 <!--service item box---->
                   <!--service item box---->
                <div class="box">
                    <div class="icon">
                        <div class="icone-box">
                            <img src="image/services.png" class="img1">
                            <img src="image/services (1).png" class="img2">
                        </div>
                    </div>
                    <div class="detail">
                        <h4>delivary</h4>
                        <span>100% secure</span>
                    </div>
                </div>
                 <!--service item box---->
            </div>
         </div>

         <!----Service Section End----->
         <div class="categories">
            <div class="heading">
                <h1>Categories Features</h1>
                <img src="image/separator-img.png"></img>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="image/categories.jpg">
                    <a href="menu.php" class="btn">Coconuts</a>
                </div>
                <div class="box">
                    <img src="image/categories2.jpg">
                    <a href="menu.php" class="btn">Strawberry</a>
                </div>
                <div class="box">
                    <img src="image/categories0.jpg">
                    <a href="menu.php" class="btn">Chocalate</a>
                </div>
                <div class="box">
                    <img src="image/categories1.jpg">
                    <a href="menu.php" class="btn">Corn</a>
                </div>
            </div>
         </div>
         <!----categories Section End----->

         <img src="image/menu-banner.jpg" class="menu-banner">
         <div class="taste">
         <div class="heading">
                <span>Taste</span>
                <h1>Buy any ice cream & get one free</h1>
                <img src="image/separator-img.png"></img>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="image/taste.webp">
                    <div class="detail">
                        <h2>Natural Sweetness</h2>
                        <h1>Vanila</h1>
                    </div>
                </div>
                <div class="box">
                    <img src="image/taste0.webp">
                    <div class="detail">
                        <h2>Natural Sweetness</h2>
                        <h1>matcha</h1>
                    </div>
                </div>
                <div class="box">
                    <img src="image/taste1.webp">
                    <div class="detail">
                        <h2>Natural Sweetness</h2>
                        <h1>blueberry</h1>
                    </div>
                </div>
                
            </div>

         </div>

          <!----Taste Section End----->

          <div class="ice-container">
            <div class="overlay"></div>
                <div class="detail">
                    <h1>Ice Cream is Cheaper than <br> therapy for Stress</h1>
                    <p>Oh, ice cream, sweet delight, how you charm our senses, <br>
                        With every scoop, a burst of joy, our mood, you mend and cleanse.<br>
                        In summer's heat or winter's chill, you bring a cooling cheer,
                        A creamy, dreamy treat you are, forever held so dear.</p>

                        <a href="menu.php" class="btn">Shop Now</a>

                </div>
            
          </div>
          <!----Container Section End----->

          <div class="taste2">
            <div class="t-banner">
                <div class="overlay"></div>
                <div class="detail">
                    <h1>Find Your taste of desserts</h1>
                    <p>Treat then a delicious treat and send  then some Luck 'O then Irish tool</p>
                    <a herf="menu.php" class="btn">Shop Now</a>

                </div>
            </div>
                <div class="box-container">
                    <div class="box">
                        <div class="box-overlay"></div>
                        <img src="image/type4.jpg">
                        <div class="box-details fadeIn-bottom">
                            <h1>Strawberry</h1>
                            <p>Find Your taste of desserts</p>
                            <a herf="menu.php" class="btn">Explore more</a>

                        </div>
                    </div>
                    <div class="box">
                        <div class="box-overlay"></div>
                        <img src="image/type.avif">
                        <div class="box-details fadeIn-bottom">
                            <h1>Strawberry</h1>
                            <p>Find Your taste of desserts</p>
                            <a herf="menu.php" class="btn">Explore more</a>

                        </div>
                    </div>
                    <div class="box">
                        <div class="box-overlay"></div>
                        <img src="image/type1.png">
                        <div class="box-details fadeIn-bottom">
                            <h1>Strawberry</h1>
                            <p>Find Your taste of desserts</p>
                            <a herf="menu.php" class="btn">Explore more</a>

                        </div>
                    </div>
                    <div class="box">
                        <div class="box-overlay"></div>
                        <img src="image/type2.png">
                        <div class="box-details fadeIn-bottom">
                            <h1>Strawberry</h1>
                            <p>Find Your taste of desserts</p>
                            <a herf="menu.php" class="btn">Explore more</a>

                        </div>
                    </div>
                    <div class="box">
                        <div class="box-overlay"></div>
                        <img src="image/type0.avif">
                        <div class="box-details fadeIn-bottom">
                            <h1>Strawberry</h1>
                            <p>Find Your taste of desserts</p>
                            <a herf="menu.php" class="btn">Explore more</a>

                        </div>
                    </div>
                    <div class="box">
                        <div class="box-overlay"></div>
                        <img src="image/type4.jpg">
                        <div class="box-details fadeIn-bottom">
                            <h1>Strawberry</h1>
                            <p>Find Your taste of desserts</p>
                            <a herf="menu.php" class="btn">Explore more</a>

                        </div>


                    </div>
                </div>
        
          </div>
          <!----Taste2 Section End----->
          <div class="flavor">
            <div class="box-container">
                <img src="image/left-banner2.webp">
                <div class="detail">
                    <h1>Hot Deal ! Sale Up<span>20% off</span></h1>
                    <p>expired</p>
                    <a href="menu.php" class="btn">Shop Now</a>
                </div>
            </div>
          </div>
          <!----Flavour Section End----->

          <div class="usage">
            <div class="heading">
                <h1>How It Works</h1>
                <img src="image/separator-img.png">
            </div>
            <div class="row">
                <div class="box-container">
                    <div class="box">
                        <img src="image/icon.avif">
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>Ice cream is enjoyed worldwide and often associated 
                            with celebrations, summer, and comfort food. It's available in various forms
                             including cones, cups, sundaes, milkshakes, and ice cream sandwiches.</p>

                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon0.avif">
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>Ice cream is enjoyed worldwide and often associated 
                            with celebrations, summer, and comfort food. It's available in various forms
                             including cones, cups, sundaes, milkshakes, and ice cream sandwiches.</p>

                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon1.avif">
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>Ice cream is enjoyed worldwide and often associated 
                            with celebrations, summer, and comfort food. It's available in various forms
                             including cones, cups, sundaes, milkshakes, and ice cream sandwiches.</p>

                        </div>
                    </div>


                </div>
                <img src="image/sub-banner.png" class="divider">


                <div class="box-container">
                    <div class="box">
                        <img src="image/icon2.avif">
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>Ice cream is enjoyed worldwide and often associated 
                            with celebrations, summer, and comfort food. It's available in various forms
                             including cones, cups, sundaes, milkshakes, and ice cream sandwiches.</p>

                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon3.avif">
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>Ice cream is enjoyed worldwide and often associated 
                            with celebrations, summer, and comfort food. It's available in various forms
                             including cones, cups, sundaes, milkshakes, and ice cream sandwiches.</p>

                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon4.avif">
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>Ice cream is enjoyed worldwide and often associated 
                            with celebrations, summer, and comfort food. It's available in various forms
                             including cones, cups, sundaes, milkshakes, and ice cream sandwiches.</p>

                        </div>
                    </div>


                </div>
            </div>
          </div>

          <!----usage Section End----->
          <div class="pride">
            <div class="detail">
                <h1>We Pride Ourselves On <br> Exeptional Flavours.</h1>
                <p>Our ice cream shop is a cherished gem in the community, renowned for its delightful flavors and warm, welcoming atmosphere. We take immense pride in using only the freshest, locally-sourced ingredients to craft 
                    our unique, mouth-watering creations. Each scoop is a testament to our commitment to quality and passion for spreading joy. From classic favorites to inventive new combinations, we aim to offer a little taste of happiness in every cone and cup.
                     Come visit us and experience the sweet satisfaction that has made us a beloved destination for ice cream enthusiasts of all ages.</p>
                     <a href="menu.php" class="btn">Shop Now</a>
            </div>
          </div>

          <!----pride Section End----->





         <?php include 'components/footer.php'; ?>

        <!--sweetalert cdn link--> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!--custom js link-->
        <script src="js/user_script.js"></script>
        <?php include 'components/alert.php'; ?>
        </body>
    </html>
