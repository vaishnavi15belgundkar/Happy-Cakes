<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

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

if(isset($_POST['add_to_cart'])){

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   <link rel="stylesheet" href="css/style.css">
    <style>
    .heading{
   display: flex;
   flex-flow: column;
   align-items: center;
   justify-content: center;
   gap:1rem;
   background-color: rgba(255, 255, 255, 0);
   text-align: center;
   min-height: 25vh;
}

.heading h3{
   font-size: 5.5rem;
   color:rgba(253, 64, 237, 0.548);
   text-transform: uppercase;
}

.heading p{
   font-size: 2.5rem;
   color:rgba(253, 64, 237, 0.548);
}

.heading p a{
   color:rgba(253, 64, 237, 0.548);
}

.heading p a:hover{
   text-decoration: underline;
}


@keyframes fadeIn{
   0%{
      transform: translateY(1rem);
   }
}
.products .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 33rem);
   gap:1.5rem;
   align-items: flex-start;
   justify-content: center; 
}

.products .box-container .box{
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
   position: relative;
}

.products .box-container .box .image img{
   height: 35rem;
   width: 100%;
   object-fit: cover;
}
.products .box-container .box .image{
   position: relative;
   text-align: center;
   padding-top: 2rem;
   overflow:hidden;
}

.products .box-container .box .image .icons{
   position: absolute;
   bottom:-7rem; left:0; right:0;
   display: flex;
}

.products .box-container .box:hover .image .icons{
   bottom:0;
}

.products .box-container .box .image .icons a{
   height: 5rem;
   line-height: 5rem;
   font-size: 2rem;
   width:50%;
   background:var(--pink);
   color:#fff;
}

.products .box-container .box .image .icons .cart-btn{
   border-left: .1rem solid #fff7;
   border-right: .1rem solid #fff7;
   width:100%;
}

.products .box-container .box .image .icons a:hover{
   background:#333;
}


.products .box-container .box .price{
   position: absolute;
   top:1rem;
   border-radius: .5rem;
   z-index: 100;
}

.products .box-container .box .price{
   font-size: 2rem;
   padding:1rem;
   background-color: rgb(255, 70, 101);
   color:white;
   left:12rem;
}


.products .box-container .box .name{
   margin:1rem;
   font-size: 2rem;
   color:var(--black);
}

.products .box-container .box .qty{
   width: 100%;
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color:var(--black);
   border:var(--border);
   border-radius: .5rem;
   margin:.5rem 0;
}

.products .box-container .box .btn,
.products .box-container .box .option-btn{
   width: 100%;

}
.small-nav {
    width: 100%;
    background-color: #ff469b;
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.small-nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 3rem;
    padding: 0;
    margin: 0;
}

.small-nav ul li {
    display: inline;
}

.small-nav ul li a {
    text-decoration: none;
    color: white;
    font-size: 1.8rem;
    font-weight: bold;
    padding: 0.8rem 1.5rem;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
    transition: all 0.3s ease;
}

.small-nav ul li a:hover {
    background-color: white;
    color: #ff469b;
}
   
    </style>
</head>
<body>
   
<?php @include 'header.php'; ?>
<div class="small-nav">
    <ul>
        <li><a href="image_upload.php">Image Upload</a></li>
        <li><a href="design.php">Create Design</a></li>
        <li><a href="products.php">Products</a></li>
    </ul>
</div>

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
      }else{
         echo '<p class="empty">No Products Available</p>';
      }
      ?>

   </div>

</section>
<section class="products">
    <?php
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>'; 
   
    echo '<h2 style="font-size: 50px; text-align: center; margin-bottom: 20px;">View Products by Categories</h1>';
    
    // Fetch categories from the database
    $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
    while ($fetch_categories = mysqli_fetch_assoc($select_categories)) {
        echo '<div class="category">';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<h2 style="font-size: 30px; text-align: center; margin-bottom: 20px;">' . $fetch_categories['name'] . '</h2>'; // Inline styles added here
       
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
            echo '<p class="empty">No Products Available</p>';
        }
        echo '</div>'; // Close box-container
        echo '</div>'; // Close category
    }
    ?>
</section>





<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>