<?php

@include 'config.php';

session_start();
$is_logged_in = isset($_SESSION['user_id']);
$user_id = $is_logged_in ? $_SESSION['user_id'] : null;

if(!isset($user_id)){
   header('location:login.php');
}

// Check if user is logged in


// Handle category filter
$selected_category = isset($_GET['category']) ? $_GET['category'] : '';

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
   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
   <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --pink: #ff469b;
        --light-pink: #e84393;
        --pink-bg: rgba(255, 70, 155, 0.1);
        --pink-hover: rgba(255, 70, 155, 0.2);
        --black: #333;
        --white: #fff;
        --light-color: #666;
        --light-bg: #eee;
        --border: #ddd;
        --box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1);
        --shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #fafafa;
        color: var(--black);
        line-height: 1.6;
        font-size: 16px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }

    /* Shop Layout */
    .shop-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 2rem;
        margin: 2rem auto 4rem;
        position: relative;
    }

    /* Filter Toggle Button for Mobile */
    .filter-toggle {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(135deg, var(--pink), var(--light-pink));
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 15px rgba(232, 67, 147, 0.4);
        z-index: 1000;
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .filter-toggle:hover {
        transform: scale(1.05);
    }

    /* Category Filter Sidebar */
    .filter-sidebar {
        background: var(--white);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: var(--shadow);
        height: fit-content;
        position: sticky;
        top: 2rem;
        transition: all 0.3s ease;
    }

    .filter-sidebar h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--black);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--pink);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .close-filter {
        display: none;
        background: none;
        border: none;
        color: var(--light-color);
        font-size: 1.2rem;
        cursor: pointer;
    }

    .category-list {
        list-style: none;
    }

    .category-item {
        margin-bottom: 0.8rem;
    }

    .category-link {
        display: block;
        padding: 0.8rem 1rem;
        text-decoration: none;
        color: var(--light-color);
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 1rem;
    }

    .category-link:hover,
    .category-link.active {
        background-color: var(--pink-bg);
        color: var(--pink);
        transform: translateX(5px);
    }

    .category-link.active {
        background-color: var(--pink);
        color: white;
    }

    /* Products Section */
    .products-section {
        background: var(--white);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--pink);
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--black);
    }

    .products-count {
        color: var(--light-color);
        font-size: 1rem;
    }

    /* Product Card Styles */
    .product-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .product-card {
        display: flex;
        align-items: center;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 70, 155, 0.2);
        border-color: var(--pink);
    }

    .product-image {
        width: 120px;
        height: 120px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        margin-right: 2rem;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-info {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-details h3 {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--black);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .product-description {
        color: var(--light-color);
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .product-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .product-right {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .product-price {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--black);
    }

    .product-tags {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-end;
    }

    .product-tag {
        background-color: var(--pink-bg);
        color: var(--pink);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255, 70, 155, 0.3);
    }

    .product-tag.new {
        background-color: rgba(255, 70, 155, 0.15);
        color: var(--light-pink);
        border-color: rgba(232, 67, 147, 0.3);
    }

    .product-tag.vegan {
        background-color: rgba(255, 70, 155, 0.1);
        color: var(--pink);
        border-color: rgba(255, 70, 155, 0.3);
    }

    .product-tag.starter {
        background-color: rgba(255, 70, 155, 0.12);
        color: var(--light-pink);
        border-color: rgba(232, 67, 147, 0.3);
    }

    /* Action Buttons */
    .btn-wishlist {
        background: transparent;
        border: 2px solid var(--pink);
        color: var(--pink);
        padding: 0.7rem 1.2rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }

    .btn-wishlist:hover {
        background-color: var(--pink);
        color: white;
    }

    .btn-cart {
        background: linear-gradient(135deg, var(--pink), var(--light-pink));
        color: white;
        border: none;
        padding: 0.9rem 1.6rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .btn-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 70, 155, 0.4);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--light-color);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
        color: var(--pink);
    }

    /* Message Styles */
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
        border-left: 5px solid var(--pink);
        border-radius: 10px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        color: #333;
        font-size: 1.2rem;
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
        color: var(--pink);
        font-size: 3rem;
        display: block;
        margin-bottom: 1.5rem;
    }

    .filter-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
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

    /* Responsive Design */
    @media (max-width: 992px) {
        .product-image {
            width: 100px;
            height: 100px;
        }
        
        .product-details h3 {
            font-size: 1.3rem;
        }
        
        .product-price {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 768px) {
        .filter-toggle {
            display: flex;
        }
        
        .shop-layout {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .filter-sidebar {
            position: fixed;
            top: 0;
            left: -100%;
            height: 100%;
            width: 85%;
            max-width: 320px;
            z-index: 1000;
            border-radius: 0 12px 12px 0;
            padding: 2rem;
            overflow-y: auto;
            transition: left 0.3s ease;
        }
        
        .filter-sidebar.active {
            left: 0;
        }
        
        .close-filter {
            display: block;
        }

        .product-card {
            flex-direction: column;
            text-align: center;
            padding: 1.2rem;
        }

        .product-image {
            margin-right: 0;
            margin-bottom: 1rem;
            width: 150px;
            height: 150px;
        }

        .product-info {
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .product-right {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        
        .product-tags {
            flex-direction: row;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }

        .product-card {
            padding: 1rem;
        }

        .product-details h3 {
            font-size: 1.2rem;
        }

        .product-description {
            font-size: 0.9rem;
        }

        .product-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-wishlist, .btn-cart {
            width: 100%;
            justify-content: center;
            padding: 0.8rem;
        }
        
        .section-title {
            font-size: 1.5rem;
        }
    }
   </style>
</head>
<body>
   
<?php @include 'header2.php'; ?>

<div class="container">
    <div class="shop-layout">
        <!-- Filter Toggle Button for Mobile -->
        <button class="filter-toggle" id="filterToggle">
            <i class="fas fa-filter"></i>
        </button>
        
        <!-- Filter Backdrop -->
        <div class="filter-backdrop" id="filterBackdrop"></div>
        
        <!-- Category Filter Sidebar -->
        <aside class="filter-sidebar" id="filterSidebar">
            <h3>
                <span><i class="fas fa-filter"></i> Categories</span>
                <button class="close-filter" id="closeFilter">
                    <i class="fas fa-times"></i>
                </button>
            </h3>
            <ul class="category-list">
                <li class="category-item">
                    <a href="shop.php" class="category-link <?php echo empty($selected_category) ? 'active' : ''; ?>">
                        <i class="fas fa-th-large"></i> All Products
                    </a>
                </li>
                <?php
                // Fetch categories from database
                $select_categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC") or die('query failed');
                if(mysqli_num_rows($select_categories) > 0){
                    while($fetch_categories = mysqli_fetch_assoc($select_categories)){
                        $active_class = ($selected_category == $fetch_categories['category_id']) ? 'active' : '';
                        echo '<li class="category-item">';
                        echo '<a href="shop.php?category=' . $fetch_categories['category_id'] . '" class="category-link ' . $active_class . '">';
                        echo '<i class="fas fa-cookie-bite"></i> ' . $fetch_categories['name'];
                        echo '</a>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </aside>

        <!-- Products Section -->
        <main class="products-section">
            <?php
            // Build query based on category filter
            if(!empty($selected_category)){
                $products_query = "SELECT p.*, c.name as category_name FROM `products` p 
                                 LEFT JOIN `categories` c ON p.category_id = c.category_id 
                                 WHERE p.category_id = '$selected_category' 
                                 ORDER BY p.name ASC";
                
                // Get category name for title
                $cat_query = mysqli_query($conn, "SELECT name FROM categories WHERE category_id = '$selected_category'");
                $cat_data = mysqli_fetch_assoc($cat_query);
                $section_title = $cat_data['name'] ?? 'Products';
            } else {
                $products_query = "SELECT p.*, c.name as category_name FROM `products` p 
                                 LEFT JOIN `categories` c ON p.category_id = c.category_id 
                                 ORDER BY p.name ASC";
                $section_title = 'All Products';
            }

            $select_products = mysqli_query($conn, $products_query) or die('query failed');
            $product_count = mysqli_num_rows($select_products);
            ?>

            <div class="section-header">
                <h2 class="section-title"><?php echo $section_title; ?></h2>
                <span class="products-count"><?php echo $product_count; ?> items</span>
            </div>

            <div class="product-list">
                <?php
                if($product_count > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                        // Determine product tags based on some criteria
                        $tags = [];
                        if($fetch_products['price'] < 30) $tags[] = 'starter';
                        if(stripos($fetch_products['name'], 'vegan') !== false) $tags[] = 'vegan';
                        // if(rand(1,3) == 1) $tags[] = 'new'; // Random new tag for demo
                ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="<?php echo $fetch_products['name']; ?>">
                            </div>
                            
                            <div class="product-info">
                                <div class="product-details">
                                    <h3><?php echo $fetch_products['name']; ?></h3>
                                    <p class="product-description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Delicious <?php echo strtolower($fetch_products['name']); ?> made with premium ingredients.
                                    </p>
                                    <form action="" method="POST" class="product-actions">
                                        <input type="hidden" name="product_quantity" value="1">
                                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                                        
                                        <button type="submit" name="add_to_wishlist" class="btn-wishlist">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <button type="submit" name="add_to_cart" class="btn-cart">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="product-right">
                                    <div class="product-price">$ <?php echo $fetch_products['price']; ?></div>
                                    <div class="product-tags">
                                        <?php
                                        foreach($tags as $tag){
                                            echo '<span class="product-tag ' . $tag . '">' . strtoupper($tag) . '</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="empty-state">';
                    echo '<i class="fas fa-shopping-basket"></i>';
                    echo '<h3>No Products Available</h3>';
                    echo '<p>We couldn\'t find any products in this category. Please try another category or check back later.</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </main>
    </div>
</div>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const filterToggle = document.getElementById('filterToggle');
    const filterSidebar = document.getElementById('filterSidebar');
    const closeFilter = document.getElementById('closeFilter');
    const filterBackdrop = document.getElementById('filterBackdrop');
    const productCards = document.querySelectorAll('.product-card');
    
    // Toggle filter sidebar for mobile
    filterToggle.addEventListener('click', function() {
        filterSidebar.classList.add('active');
        filterBackdrop.style.display = 'block';
        setTimeout(() => {
            filterBackdrop.style.opacity = '1';
        }, 10);
        document.body.style.overflow = 'hidden';
    });
    
    // Close filter sidebar
    function closeFilterSidebar() {
        filterSidebar.classList.remove('active');
        filterBackdrop.style.opacity = '0';
        setTimeout(() => {
            filterBackdrop.style.display = 'none';
        }, 300);
        document.body.style.overflow = '';
    }
    
    closeFilter.addEventListener('click', closeFilterSidebar);
    filterBackdrop.addEventListener('click', closeFilterSidebar);
    
    // Enhanced product interaction
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            if (window.innerWidth > 768) {
                this.style.transform = 'translateY(-3px)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            if (window.innerWidth > 768) {
                this.style.transform = 'translateY(0)';
            }
        });
    });

    // Smooth scrolling for category links
    const categoryLinks = document.querySelectorAll('.category-link');
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Let the default behavior handle the navigation
            // Add a subtle loading state
            this.style.opacity = '0.7';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 200);
            
            // Close sidebar on mobile when clicking a category
            if (window.innerWidth <= 768) {
                closeFilterSidebar();
            }
        });
    });
    
    // Check window resize to handle filter sidebar visibility
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            filterSidebar.classList.remove('active');
            filterBackdrop.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
});
</script>
</body>
</html>