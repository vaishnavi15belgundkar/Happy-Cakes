<?php

@include 'config.php';

session_start();

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$user_id = $is_logged_in ? $_SESSION['user_id'] : null;

if(isset($_POST['add_to_wishlist'])){
    // Check if user is logged in
    if(!$is_logged_in){
        echo '<div class="message-container">
                <div class="message">Please login to add items to your wishlist</div>
              </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "login.php";
            }, 3000);
        </script>';
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            $message[] = 'already added to wishlist';
        }elseif(mysqli_num_rows($check_cart_numbers) > 0){
            $message[] = 'already added to cart';
        }else{
            mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
            $message[] = 'product added to wishlist';
        }
    }
}

if(isset($_POST['add_to_cart'])){
    // Check if user is logged in
    if(!$is_logged_in){
        echo '<div class="message-container">
                <div class="message">Please login to add items to your cart</div>
              </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "login.php";
            }, 3000);
        </script>';
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_cart_numbers) > 0){
            $message[] = 'already added to cart';
        }else{

            $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

            if(mysqli_num_rows($check_wishlist_numbers) > 0){
                mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
            }

            mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'product added to cart';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop | Browse Our Products</title>
   <link rel="stylesheet" href="css/style.css">
   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <!-- Custom CSS -->
   <style>
    /* Custom styles for modern product layout */
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

    /* Category section styling */
    .category {
        margin: 6rem 0;
        position: relative;
    }

    .category h2 {
        font-size: 3rem;
        color: var(--black);
        position: relative;
        display: inline-block;
        margin-bottom: 3rem;
        padding-bottom: 1rem;
    }

    .category h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #ff469b, #e84393);
        border-radius: 2px;
    }

    /* Heading section update */
    .heading {
        padding: 5rem 0 3rem;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 1rem;
        margin-bottom: 3rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .heading h3 {
        background: linear-gradient(135deg, #ff469b, #e84393);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Login message styling */
    .message-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease-out;
    }

    .message {
        background: linear-gradient(135deg, #fff, #f8f8f8);
        border-left: 5px solid #e84393;
        border-radius: 10px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        color: #333;
        font-size: 1.8rem;
        font-weight: 500;
        max-width: 90%;
        width: 400px;
        padding: 2.5rem;
        text-align: center;
        position: relative;
        animation: messagePopIn 0.4s ease-out;
    }

    .message::before {
        content: '\f023';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #e84393;
        font-size: 3rem;
        display: block;
        margin-bottom: 1.5rem;
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes messagePopIn {
        0% { opacity: 0; transform: scale(0.8); }
        70% { transform: scale(1.05); }
        100% { opacity: 1; transform: scale(1); }
    }

    @media (max-width: 768px) {
        .products .box-container {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }
        
        .products .box-container .box .image {
            height: 180px;
        }
    }

    @media (max-width: 480px) {
        .products .box-container {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .products .box-container .box .price {
            font-size: 1.4rem;
            padding: 0.5rem 1.2rem;
        }
        
        .products .box-container .box .name {
            font-size: 1.6rem;
        }
    }
   </style>
</head>
<body>
   
<?php @include 'header2.php'; ?>

<!-- No need for message display code here anymore -->

<section class="heading">
    <h3>All Products</h3>
</section>

<section class="products">
   <div class="box-container">
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
                  <form action="" method="POST" class="box">
                     <div class="price">Rs.<?php echo $fetch_products['price']; ?>.00</div>
                     <div class="image">
                        <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="<?php echo $fetch_products['name']; ?>">
                     </div>
                     <div class="content-wrapper">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="action-buttons">
                           <input type="hidden" name="product_quantity" value="1" min="0" class="qty">
                           <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                           <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                           <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                           <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                           <button type="submit" name="add_to_wishlist" class="option-btn">
                              <i class="fas fa-heart"></i>
                           </button>
                           <button type="submit" name="add_to_cart" class="btn">
                              <i class="fas fa-shopping-cart"></i> Cart
                           </button>
                        </div>
                     </div>
                  </form>
      <?php
            }
         } else {
            echo '<p class="empty">No Products Available</p>';
         }
      ?>
   </div>
</section>

<section class="products">
   <!-- Category Based Products -->
   <div class="categories-wrapper">
      <h2 style="font-size: 4rem; text-align: center; margin: 4rem 0;">Browse Products By Category</h2>
      
      <?php
      // Fetch categories from the database
      $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
      while ($fetch_categories = mysqli_fetch_assoc($select_categories)) {
         echo '<div class="category">';
         echo '<h2>' . $fetch_categories['name'] . '</h2>';
         echo '<div class="box-container">';
         
         // Fetch products based on category
         $category_id = $fetch_categories['category_id'];
         $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id") or die('query failed');
         
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
               <form action="" method="POST" class="box">
                  <div class="price">Rs.<?php echo $fetch_products['price']; ?>.00</div>
                  <div class="image">
                     <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="<?php echo $fetch_products['name']; ?>">
                  </div>
                  <div class="content-wrapper">
                     <div class="name"><?php echo $fetch_products['name']; ?></div>
                     <div class="action-buttons">
                        <input type="hidden" name="product_quantity" value="1" min="0" class="qty">
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <button type="submit" name="add_to_wishlist" class="option-btn">
                           <i class="fas fa-heart"></i>
                        </button>
                        <button type="submit" name="add_to_cart" class="btn">
                           <i class="fas fa-shopping-cart"></i> Add to cart
                        </button>
                     </div>
                  </div>
               </form>
      <?php
            }
         } else {
            echo '<p class="empty">No Products Available in this Category</p>';
         }
         
         echo '</div>'; // Close box-container
         echo '</div>'; // Close category
      }
      ?>
   </div>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>
<!-- Additional JavaScript for enhanced interactivity -->
<script>
   // Add a small animation for product cards
   document.addEventListener('DOMContentLoaded', function() {
      const productCards = document.querySelectorAll('.box');
      
      productCards.forEach(card => {
         card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
         });
         
         card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
         });
      });
   });
</script>
</body>
</html>