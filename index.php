<?php

@include 'config.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if (!isset($user_id)) {
//    header('location:login.php');
// }

if (isset($_POST['add_to_wishlist'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_wishlist_numbers) > 0) {
      $message[] = 'already added to wishlist';
   } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart';
   } else {
      mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
      $message[] = 'product added to wishlist';
   }
}

if (isset($_POST['add_to_cart'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart';
   } else {

      $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if (mysqli_num_rows($check_wishlist_numbers) > 0) {
         mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
      }

      mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Happy Cakes - Delicious Cakes for Every Occasion</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* Additional styles for new sections */
   .header .flex .navbar ul li a{
   font-size: 2rem;
   padding:1rem 1.5rem;
   display: block;
   color:rgb(51 53 53);
   text-transform: capitalize;
}
/* Navbar */

/* Services Section */
.services .box-container {
   max-width: 1200px;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   gap: 2rem;
   padding: 2rem 0;
}

.services .box {
   background-color: var(--white);
   padding: 3rem 2rem;
   text-align: center;
   box-shadow: var(--box-shadow);
   border-radius: .5rem;
   transition: transform 0.3s ease;
}

.services .box:hover {
   transform: translateY(-1rem);
}

.services .box i {
   font-size: 4.5rem;
   color: var(--pink);
   margin-bottom: 1.5rem;
}

.services .box h3 {
   font-size: 2.2rem;
   color: var(--black);
   margin-bottom: 1rem;
}

.services .box p {
   font-size: 1.5rem;
   color: var(--light-color);
   line-height: 1.8;
}

/* Testimonials Section */
.testimonials .box-container {
   max-width: 1200px;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   gap: 2rem;
   padding: 2rem 0;
}

.testimonials .box {
   background-color: var(--white);
   padding: 3rem 2rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   text-align: center;
   position: relative;
}

.testimonials .box::before {
   content: '\201C';
   position: absolute;
   top: -1.5rem;
   left: 1rem;
   font-size: 6rem;
   color: rgba(233, 76, 161, 0.2);
   font-family: sans-serif;
}

.testimonials .box .stars {
   margin-bottom: 1.5rem;
}

.testimonials .box .stars i {
   font-size: 1.7rem;
   color: var(--orange);
   margin: 0 .2rem;
}

.testimonials .box p {
   font-size: 1.6rem;
   color: var(--light-color);
   line-height: 1.8;
   margin-bottom: 2rem;
   min-height: 8rem;
}

.testimonials .box .user {
   display: flex;
   align-items: center;
   justify-content: center;
   gap: 1rem;
}

.testimonials .box .user img {
   height: 6rem;
   width: 6rem;
   border-radius: 50%;
   object-fit: cover;
   border: 3px solid var(--pink);
}

.testimonials .box .user-info h3 {
   font-size: 1.8rem;
   color: var(--black);
   margin-bottom: .5rem;
}

.testimonials .box .user-info span {
   font-size: 1.4rem;
   color: var(--pink);
}

/* Contact Section */
.contact-container {
   max-width: 1200px;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   gap: 3rem;
   padding: 2rem 0;
}

.contact-info {
   display: flex;
   flex-direction: column;
   gap: 2rem;
}

.contact-info .info-item {
   display: flex;
   align-items: flex-start;
   gap: 1.5rem;
   background-color: var(--white);
   padding: 2rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
}

.contact-info .info-item i {
   font-size: 2.5rem;
   color: var(--pink);
   margin-top: 0.5rem;
}

.contact-info .info-item h3 {
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .5rem;
}

.contact-info .info-item p {
   font-size: 1.5rem;
   color: var(--light-color);
   line-height: 1.5;
}

.contact form {
   background-color: var(--white);
   padding: 3rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
}

.contact form h3 {
   text-align: center;
   font-size: 2.5rem;
   color: var(--black);
   margin-bottom: 2rem;
}

.contact form .box {
   width: 100%;
   margin: 1rem 0;
   padding: 1.2rem 1.4rem;
   font-size: 1.6rem;
   color: var(--black);
   border-radius: .5rem;
   background-color: var(--light-bg);
}

.contact form textarea {
   height: 15rem;
   resize: none;
}

/* Newsletter Section */
.newsletter {
   background-color: var(--pink);
   padding: 2rem 2rem;
   text-align: center;
}

.newsletter .content {
   max-width: 70rem;
   margin: 0 auto;
}

.newsletter h3 {
   font-size: 3rem;
   color: var(--white);
   margin-bottom: 1rem;
}

.newsletter p {
   font-size: 1.6rem;
   color: var(--white);
   margin-bottom: 2rem;
}

.newsletter form {
   display: flex;
   flex-wrap: wrap;
   justify-content: center;
   gap: 1rem;
}

.newsletter input[type="email"] {
   flex: 1;
   min-width: 30rem;
   padding: 1.2rem 1.4rem;
   font-size: 1.6rem;
   border-radius: .5rem;
}

.newsletter .btn {
   background-color: var(--black);
   color: var(--white);
}

.newsletter .btn:hover {
   background-color: var(--white);
   color: var(--black);
}

/* Enhanced Google Maps Section Styles */
.map-section {
   max-width: 1200px;
   margin: 4rem auto;
   padding: 2rem;
}

.map-section h3 {
   text-align: center;
   font-size: 2.5rem;
   color: var(--black);
   margin-bottom: 2rem;
}

.map-container {
   position: relative;
   width: 100%;
   height: 0;
   padding-bottom: 45%; /* 16:9 aspect ratio (9/16 = 0.5625 or 56.25%) - adjusted for better height */
   background-color: var(--white);
   border-radius: 1rem;
   box-shadow: var(--box-shadow);
   overflow: hidden;
}

.map-container iframe {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   border: none;
   border-radius: 1rem;
}

 .products .box-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.5rem;
        padding: 2rem 0;
    }

    .products .box-container .box {
        background-color: var(--white);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        border: none;
        display: flex;
        flex-direction: column;
    }

    .products .box-container .box:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(232, 67, 147, 0.2);
    }

    .products .box-container .box .image {
        position: relative;
        overflow: hidden;
        padding: 0;
        height: 220px;
    }

    .products .box-container .box .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .products .box-container .box:hover .image img {
        transform: scale(1.05);
    }

    .products .box-container .box .price {
        position: absolute;
        right: 0;
        top: 1.5rem;
        left: auto;
        background: linear-gradient(135deg, #ff469b, #e84393);
        color: white;
        padding: 0.7rem 1.5rem;
        font-size: 1.6rem;
        font-weight: 600;
        border-radius: 2rem 0 0 2rem;
        box-shadow: 0 4px 10px rgba(232, 67, 147, 0.3);
        z-index: 10;
    }

    .products .box-container .box .content-wrapper {
        padding: 2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .products .box-container .box .name {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--black);
        margin-bottom: 1rem;
        height: 40px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .products .box-container .box .action-buttons {
        margin-top: auto;
        display: grid;
        grid-template-columns: 1fr 4fr;
        gap: 1rem;
    }

    .products .box-container .box .option-btn {
        border-radius: 0.5rem;
        height: 4.5rem;
        font-size: 2rem;
        background-color: rgba(255, 70, 101, 0.15);
        color: var(--pink);
        transition: all 0.3s ease;
    }

    .products .box-container .box .option-btn:hover {
        background-color: rgba(255, 70, 101, 0.3);
    }

    .products .box-container .box .btn {
        border-radius: 0.5rem;
        height: 4.5rem;
        font-size: 1.7rem;
        font-weight: 500;
        background: linear-gradient(135deg, #ff469b, #e84393);
        border: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
    }

    .products .box-container .box .btn:hover {
        background: linear-gradient(135deg, #e84393, #ff469b);
        box-shadow: 0 5px 15px rgba(232, 67, 147, 0.4);
    }

/* Responsive Design */
@media (max-width: 768px) {
   .contact-container {
      grid-template-columns: 1fr;
      padding: 1rem;
      gap: 2rem;
   }
   
   .contact form {
      padding: 2rem;
   }
   
   .map-section {
      padding: 1rem;
      margin: 2rem auto;
   }
   
   .map-container {
      padding-bottom: 60%; /* Slightly taller on mobile for better visibility */
   }
   
   .contact-info .info-item {
      padding: 1.5rem;
   }
   
   .contact-info .info-item h3 {
      font-size: 1.8rem;
   }
   
   .contact-info .info-item p {
      font-size: 1.4rem;
   }
}

@media (max-width: 480px) {
   .map-container {
      padding-bottom: 75%; /* Even taller on very small screens */
   }
   
   .contact form h3,
   .map-section h3 {
      font-size: 2rem;
   }
}
/* Footer Section */
.footer {
   background-color: var(--light-bg);
   padding-top: 3rem;
}

.footer-container {
   max-width: 1200px;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
   gap: 3rem;
   padding: 0 2rem;
}

.footer .box h3 {
   font-size: 2.2rem;
   color: var(--black);
   margin-bottom: 1.5rem;
}

.footer .box a {
   display: block;
   font-size: 1.5rem;
   color: var(--light-color);
   padding: .8rem 0;
}

.footer .box a:hover {
   color: var(--pink);
   transform: translateX(1rem);
}

.footer .box a i {
   margin-right: .5rem;
   color: var(--pink);
}

.footer .box p {
   font-size: 1.6rem;
   color: var(--light-color);
   line-height: 1.5;
   margin-bottom: 1.5rem;
}

.footer .box .payment-methods img {
   max-width: 100%;
   height: 4rem;
   margin-top: 1rem;
}

.footer .credit {
   text-align: center;
   padding: 2rem 0;
   margin-top: 3rem;
   border-top: var(--border);
   font-size: 2rem;
   color: var(--light-color);
}

.footer .credit i {
   color: var(--pink);
}

.footer .credit span {
   color: var(--pink);
}

/* Media Queries */
@media (max-width: 768px) {
   .contact-container {
      grid-template-columns: 1fr;
   }

   .newsletter form {
      flex-direction: column;
   }

   .newsletter input[type="email"] {
      min-width: 100%;
   }
}


   /* Animation Classes */
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-in.active {
    opacity: 1;
    transform: translateY(0);
}

/* Animation Delays */
.delay-100 {
    transition-delay: 0.1s;
}

.delay-200 {
    transition-delay: 0.2s;
}

.delay-300 {
    transition-delay: 0.3s;
}

.delay-400 {
    transition-delay: 0.4s;
}

.delay-500 {
    transition-delay: 0.5s;
}

/* Sequential animation for child elements */
.animate-children > * {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

.animate-children.active > *:nth-child(1) {
    transition-delay: 0.1s;
}

.animate-children.active > *:nth-child(2) {
    transition-delay: 0.2s;
}

.animate-children.active > *:nth-child(3) {
    transition-delay: 0.3s;
}

.animate-children.active > *:nth-child(4) {
    transition-delay: 0.4s;
}

.animate-children.active > *:nth-child(5) {
    transition-delay: 0.5s;
}

.animate-children.active > *:nth-child(6) {
    transition-delay: 0.6s;
}

.animate-children.active > * {
    opacity: 1;
    transform: translateY(0);
}

/* Slide in animations */
.slide-in-left {
    opacity: 0;
    transform: translateX(-30px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.slide-in-right {
    opacity: 0;
    transform: translateX(30px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.slide-in-left.active,
.slide-in-right.active {
    opacity: 1;
    transform: translateX(0);
}

/* Custom animations for specific sections */
.home .content {
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.home .content.active {
    opacity: 1;
    transform: scale(1);
}

/* Subtle zoom animation for product boxes */
.products .box {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.5s ease-out, transform 0.5s ease-out, box-shadow 0.3s ease, transform 0.3s ease;
}

.products .box.active {
    opacity: 1;
    transform: scale(1);
}

/* Icons container animation */
.icons-container .icons {
    opacity: 0;
    transform: translateY(15px);
    transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

.icons-container .icons.active {
    opacity: 1;
    transform: translateY(0);
}

/* Initial state for testimonial boxes */
.testimonials .box {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.testimonials .box.active {
    opacity: 1;
    transform: translateY(0);
}

/* Map animation */
.map-container {
    opacity: 0;
    transform: scale(0.98);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.map-container.active {
    opacity: 1;
    transform: scale(1);
}

/* Disable animations for users who prefer reduced motion */
@media (prefers-reduced-motion: reduce) {
    .fade-in,
    .animate-children > *,
    .slide-in-left,
    .slide-in-right,
    .home .content,
    .products .box,
    .icons-container .icons,
    .testimonials .box,
    .map-container {
        transition: none;
        opacity: 1;
        transform: none;
    }
}
   </style>

</head>

<body>

   <?php @include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>🎂 Welcome to Happy Cakes! 🍰</h3>
         <p>Indulge in sweet moments with our delectable cakes crafted with love and care. 🎉 Elevate every celebration with our irresistible flavors and stunning designs. 🌟 From birthdays to weddings, make memories sweeter with Happy Cakes. Order now and taste the magic! ✨🎈</p>
         <a href="about.php" class="btn">discover more</a>
      </div>

   </section>

   <!-- about section starts  -->

   <section class="aboutus" id="aboutus">

      <h1 class="title"> <span> about </span> us </h1>

      <div class="row">

         <div class="video-container">
            <video src="videos/video.mp4" loop autoplay muted></video>
            <h3>Best Cake Sellers</h3>
         </div>

         <div class="content">
            <h3>Why Choose Us?</h3>
            <p>Whenever you visit a bakery, you will see a selective range of cakes. Since you are obviously buying a cake for an important occasion, you will be visiting many local bakeries before choosing one special cake. If you decide to buy the cake online, you can browse through larger variety of cakes in one e-commerce shop than you would in almost all local bakeries combined.

            <div>
               <a href="about.php" class="btn">learn more</a>
            </div>

         </div>

      </div>

   </section>

   <!-- icons section starts -->
   <section class="icons-container">

      <div class="icons">
         <img src="images/icon-1.png" alt="">
         <div class="info">
            <h3>Free Delivery</h3>
            <span>On All Locations</span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-3.png" alt="">
         <div class="info">
            <h3>Offer & Gifts</h3>
            <span>On All Orders</span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-4.png" alt="">
         <div class="info">
            <h3>Secure Payments</h3>
            <span>Protected Methods</span>
         </div>
      </div>

   </section>
   <!-- icons section ends -->

   <!-- products section starts -->
   <section class="products">
   <h1 class="title"> <span>featured</span> products </h1>

   <div class="box-container">

      <?php
      // LIMIT changed from 9 to 3
      $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 3") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
         while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
            <form action="" method="POST" class="box">
               <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
               <div class="image">
                  <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
               </div>
               <div class="name"><?php echo $fetch_products['name']; ?></div>
               <input type="hidden" name="product_quantity" value="1" min="0" class="qty">
               <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
               <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
               <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
               <input type="submit" value="&#10084;" name="add_to_wishlist" class="option-btn">
               <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">View All</a>
   </div>

</section>

   <!-- products section ends -->

   <!-- services section starts -->
   <section class="services" id="services">
      <h1 class="title"><span>our</span> services</h1>

      <div class="box-container">
         <div class="box">
            <i class="fas fa-birthday-cake"></i>
            <h3>Custom Birthday Cakes</h3>
            <p>Celebrate your special day with our handcrafted birthday cakes. Personalized designs and flavors to make your celebration unforgettable.</p>
         </div>

         <div class="box">
            <i class="fas fa-ring"></i>
            <h3>Wedding Cakes</h3>
            <p>Elegant multi-tiered masterpieces for your perfect day. Our wedding cakes are designed to reflect your unique love story.</p>
         </div>

         <div class="box">
            <i class="fas fa-cookie"></i>
            <h3>Pastries & Desserts</h3>
            <p>From cupcakes to cookies, brownies to pastries - indulge in our selection of freshly baked sweet treats for any occasion.</p>
         </div>

         <div class="box">
            <i class="fas fa-truck"></i>
            <h3>Fast Delivery</h3>
            <p>Our reliable delivery service ensures your order arrives fresh and on time. Same-day delivery available for local orders.</p>
         </div>

         <div class="box">
            <i class="fas fa-calendar-alt"></i>
            <h3>Event Catering</h3>
            <p>Let us sweeten your corporate events, parties, and special gatherings with customized dessert packages tailored to your needs.</p>
         </div>

         <div class="box">
            <i class="fas fa-heart"></i>
            <h3>Special Diet Options</h3>
            <p>We offer gluten-free, vegan, and sugar-free cake options so everyone can enjoy our delicious treats regardless of dietary restrictions.</p>
         </div>
      </div>
   </section>
   <!-- services section ends -->

   <!-- testimonials section starts -->
   <section class="testimonials" id="testimonials">
      <h1 class="title"><span>client</span> testimonials</h1>

      <div class="box-container">
         <div class="box">
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <p>"The birthday cake for my daughter was absolutely stunning! Not only did it look beautiful, but it tasted amazing too. Everyone at the party was impressed!"</p>
            <div class="user">
               <img src="images/Leela.png" alt="">
               <div class="user-info">
                  <h3>Miss Leela</h3>
                  <span>Happy Customer</span>
               </div>
            </div>
         </div>

         <div class="box">
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <p>"Our wedding cake was a dream come true! The team at Happy Cakes truly captured our vision. The cake was not only gorgeous but delicious as well. Thank you! "</p>
            <div class="user">
               <img src="images/Rohit.png" alt="">
               <div class="user-info">
                  <h3>Mr Rohit</h3>
                  <span>Happy Customer</span>
               </div>
            </div>
         </div>

         <div class="box">
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <p>"I ordered cupcakes for our company event and they were a huge hit! The presentation was beautiful and the flavors were outstanding. Will definitely order again for future events."</p>
            <div class="user">
               <img src="images/Basavraj.png" alt="">
               <div class="user-info">
                  <h3>Mr Basavraj</h3>
                  <span>Happy Customer</span>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- testimonials section ends -->

   <!-- contact section starts -->
   <section class="contact" id="contact">
      <h1 class="title"><span>contact</span> us</h1>

      <div class="contact-container">
         <div class="contact-info">
            <div class="info-item">
               <i class="fas fa-map-marker-alt"></i>
               <div>
                  <h3>Our Location</h3>
                  <p>Satwai Road, Nipani - 591237</p>
               </div>
            </div>
            
            <div class="info-item">
               <i class="fas fa-envelope"></i>
               <div>
                  <h3>Email Us</h3>
                  <p>info@happycakes.com</p>
               </div>
            </div>
            
            <div class="info-item">
               <i class="fas fa-phone"></i>
               <div>
                  <h3>Call Us</h3>
                  <p>+91 7947430239</p>
               </div>
            </div>
            
            <div class="info-item">
               <i class="fas fa-clock"></i>
               <div>
                  <h3>Opening Hours</h3>
                  <p>Monday - Saturday: 9:00 AM - 8:00 PM</p>
                  <p>Sunday: 10:00 AM - 6:00 PM</p>
               </div>
            </div>
         </div>

         <form action="" method="post">
            <h3>Get in Touch</h3>
            <input type="text" name="name" placeholder="Your Name" class="box" required>
            <input type="email" name="email" placeholder="Your Email" class="box" required>
            <input type="tel" name="phone" placeholder="Your Phone" class="box">
            <textarea name="message" class="box" placeholder="Your Message" required></textarea>
            <input type="submit" value="Send Message" class="btn" name="send_message">
         </form>
      </div>
   </section>
   <!-- contact section ends -->

   <!-- newsletter section starts -->
   <!-- <section class="newsletter">
      <div class="content"> -->
         <!-- <h3>Subscribe to Our Newsletter</h3> -->
         <!-- <p>Get the latest updates about new flavors, special offers, and upcoming events!</p>
         <form action="" method="post">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="submit" value="Subscribe" class="btn" name="subscribe">
         </form> -->
      <!-- </div>
   </section> -->
   <!-- newsletter section ends -->

   <!-- Enhanced Google Maps Section -->
<section class="map-section">
   <h1 class="title"><span>Find Us</span> on the Map</h1>
   <div class="map-container">
      <iframe 
         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3827.474280948952!2d74.3805555!3d16.4007217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc0f36622dad70f%3A0x7085ab16559588d3!2sHappy%20Cakes!5e0!3m2!1sen!2sin!4v1747467747517!5m2!1sen!2sin"
         allowfullscreen="" 
         loading="lazy" 
         referrerpolicy="no-referrer-when-downgrade"
         title="Happy Cakes Location Map">
      </iframe>
   </div>
</section>

   <!-- footer section starts -->
   <footer class="footer">
      <div class="footer-container">
         <div class="box">
            <h3>Quick Links</h3>
            <a href="index.php"><i class="fas fa-angle-right"></i> Home</a>
            <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
            <a href="#services"><i class="fas fa-angle-right"></i> Services</a>
            <a href="shop.php"><i class="fas fa-angle-right"></i> Products</a>
            <a href="#testimonials"><i class="fas fa-angle-right"></i> Testimonials</a>
            <a href="#contact"><i class="fas fa-angle-right"></i> Contact</a>
         </div>

         <div class="box">
            <h3>Extra Links</h3>
            <a href="login.php"><i class="fas fa-angle-right"></i> My Account</a>
            <a href="login.php"><i class="fas fa-angle-right"></i> My Orders</a>
            <a href="login.php"><i class="fas fa-angle-right"></i> My Wishlist</a>
            <a href="terms_of_service.php"><i class="fas fa-angle-right"></i> Terms of Use</a>
            <a href="privacy.php"><i class="fas fa-angle-right"></i> Privacy Policy</a>
         </div>

         <div class="box">
            <h3>Follow Us</h3>
            <a href="https://www.justdial.com/Nipani/Happy-Cakes-Nipani/9999PX831-X831-200812122125-S1T2_BZDET"><i class="fas fa-phone-alt"></i> Justdial</a>
            <!-- <a href="#"><i class="fab fa-twitter"></i> Twitter</a> -->
            <a href="https://www.instagram.com/happy_company.nipani/"><i class="fab fa-instagram"></i> Instagram</a>
            <!-- <a href="#"><i class="fab fa-pinterest"></i> Pinterest</a> -->
            <!-- <a href="#"><i class="fab fa-youtube"></i> YouTube</a> -->
         </div>

         <div class="box">
            <h3>Happy Cakes</h3>
            <p>Crafting Sweet Memories Since 2010</p>
            <!-- <div class="payment-methods">
               <img src="images/payment.png" alt="Payment Methods">
            </div> -->
         </div>
      </div>

      <div class="credit">Created with <i class="fas fa-heart"></i> by <span>Happy Cakes</span> | All Rights Reserved</div>
   </footer>
   <!-- footer section ends -->

   <script src="js/script.js"></script>

<script>

   document.addEventListener('DOMContentLoaded', function() {
    // Apply animation classes to elements
    setupAnimations();
    
    // Initial check for elements in viewport
    checkAnimations();
    
    // Check for animations on scroll
    window.addEventListener('scroll', checkAnimations);
    
    // Function to setup animation classes
    function setupAnimations() {
        // Add animation classes to section titles
        document.querySelectorAll('.title').forEach(title => {
            title.classList.add('fade-in');
        });
        
        // Home section animation
        if (document.querySelector('.home .content')) {
            document.querySelector('.home .content').classList.add('fade-in');
        }
        
        // About section animations
        if (document.querySelector('.aboutus .video-container')) {
            document.querySelector('.aboutus .video-container').classList.add('slide-in-left');
        }
        if (document.querySelector('.aboutus .content')) {
            document.querySelector('.aboutus .content').classList.add('slide-in-right');
        }
        
        // Icons animations with staggered delay
        document.querySelectorAll('.icons-container .icons').forEach((icon, index) => {
            icon.classList.add('fade-in');
            icon.classList.add(`delay-${(index + 1) * 100}`);
        });
        
        // Product animations
        document.querySelectorAll('.products .box').forEach((box, index) => {
            box.classList.add('fade-in');
            box.classList.add(`delay-${(index % 3 + 1) * 100}`);
        });
        
        // Services animations
        document.querySelectorAll('.services .box').forEach(box => {
            box.classList.add('fade-in');
        });
        
        // Testimonial animations
        document.querySelectorAll('.testimonials .box').forEach((box, index) => {
            box.classList.add('fade-in');
            box.classList.add(`delay-${(index + 1) * 100}`);
        });

        // Contact section animations
        document.querySelectorAll('.contact-info .info-item').forEach((item, index) => {
            item.classList.add('fade-in');
            item.classList.add(`delay-${(index + 1) * 100}`);
        });
        if (document.querySelector('.contact form')) {
            document.querySelector('.contact form').classList.add('fade-in');
            document.querySelector('.contact form').classList.add('delay-300');
        }
        
        // Map animation
        if (document.querySelector('.map-container')) {
            document.querySelector('.map-container').classList.add('fade-in');
        }
        
        // Footer animations
        document.querySelectorAll('.footer .box').forEach(box => {
            box.classList.add('fade-in');
        });
        
        // Add staggered animations to sections with multiple items
        document.querySelectorAll('.services .box-container').forEach(container => {
            container.classList.add('animate-children');
        });
        document.querySelectorAll('.testimonials .box-container').forEach(container => {
            container.classList.add('animate-children');
        });
    }

    // Function to check if element is in viewport and trigger animation
    function checkAnimations() {
        const elements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .animate-children');
        
        elements.forEach(element => {
            const position = element.getBoundingClientRect();
            
            // If element is in viewport
            if (position.top < window.innerHeight * 0.9) {
                element.classList.add('active');
            }
        });
    }
    
    // Trigger initial animations with a slight delay after page load
    setTimeout(checkAnimations, 100);
});
</script>
</body>

</html>