<?php
session_start();
@include 'config.php'; // Include your database connection file

if(isset($_POST['add_custom_to_cart'])) {

    $user_id = $_SESSION['user_id'];

    $product_name = "Custom Cake";  // Fixed product name
    $product_price = 1000;          // Fixed price
    $product_quantity = 1;          // Fixed quantity

    // Handle image upload
    $image_name = $_FILES['custom_image']['name'];
    $image_tmp_name = $_FILES['custom_image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image_name;

    if(move_uploaded_file($image_tmp_name, $image_folder)){
        $product_image = $image_name;
    } else {
        $product_image = 'default.png'; // Optional fallback
    }

    // Check if the same custom cake is already in the cart
    $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart) > 0) {
        $message[] = 'Custom cake already added to cart!';
    } else {
        // Add to cart
        $insert_query = "INSERT INTO `cart` (user_id, pid, name, price, quantity, image) 
                         VALUES ('$user_id', NULL, '$product_name', '$product_price', '$product_quantity', '$product_image')";

        if(mysqli_query($conn, $insert_query)){
            $message[] = 'Custom cake added to cart!';
        } else {
            $message[] = 'Failed to add custom cake to cart!';
        }
    }
}

// Optional: Show messages
if(!empty($message)){
    foreach($message as $msg){
        echo "<p>$msg</p>";
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
        <li><a href="Design.php">Create Design</a></li>
        <li><a href="shop.php">Products</a></li>
    </ul>
</div>

<section class="heading">
    <h3>All Products</h3>
</section>

<section class="custom-product-upload" style="text-align: center; padding: 50px 20px;">

    <h2 style="font-size: 40px; margin-bottom: 20px;">Create Your Custom Product</h2>

    <form action="" method="POST" enctype="multipart/form-data" style="display: inline-block; text-align: left;">

        <label style="font-size: 18px; margin-bottom: 10px;">Upload Your Image:</label>
        <input type="file" name="custom_image" accept="image/*" required style="margin-bottom: 20px; display: block;">

        <label style="font-size: 18px; margin-bottom: 10px;">Select Flavor:</label>
        <select name="product_flavor" required style="margin-bottom: 20px; padding: 10px; font-size: 16px;">
            <option value="Chocolate">Chocolate</option>
            <option value="Vanilla">Vanilla</option>
            <option value="Strawberry">Strawberry</option>
            <option value="Red Velvet">Red Velvet</option>
            <option value="Custom">Custom (Please specify in notes)</option>
        </select>


        <label style="font-size: 18px; margin-bottom: 10px;">Notes (Optional):</label>
        <textarea name="product_notes" rows="3" placeholder="Any custom request..." style="width: 100%; margin-bottom: 20px; padding: 10px; font-size: 16px;"></textarea>

        <input type="submit" name="add_custom_to_cart" value="Add to Cart" style="background-color: #ff469b; color: white; padding: 12px 25px; font-size: 18px; border: none; cursor: pointer; border-radius: 5px;">
    </form>

</section>



<?php 
if(isset($_POST['add_custom_to_cart'])) {

    // User ID should come from session or login mechanism
    $user_id = $_SESSION['user_id']; // Make sure you have session_start() at the top of your file

    $product_name = "Custom Cake - " . $_POST['flavour'];
    $product_price = 1000;  // Fixed price
    $product_quantity = 1;

    // Handle file upload
    $image_name = $_FILES['custom_image']['name'];
    $image_tmp_name = $_FILES['custom_image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image_name;

    if (move_uploaded_file($image_tmp_name, $image_folder)) {
        $product_image = $image_name;
    } else {
        $product_image = 'default.png'; // Optional fallback image
    }

    // Check if this custom product is already in the cart
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Custom product already added to cart';
    } else {
        // Since 'pid' is required, we can set it to NULL (or 0 if NULL isn't allowed in your schema)
        mysqli_query($conn, "INSERT INTO `cart` (user_id, pid, name, price, quantity, image) VALUES ('$user_id', NULL, '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query failed');

        $message[] = 'Custom product added to cart';
    }
}
?>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html> 