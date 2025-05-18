<header class="header">
    <div class="flex">
        <a href="index.php" class="logo">Happy Cakes</a>

        <nav class="navbar">
            <ul>
                <li><a href="index2.php">Home</a></li>
                <li><a href="shop.php">Products</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <!-- <li><a href="orders.php">Orders</a></li> -->
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            
            <!-- User Icon with Dropdown Container -->
            <div class="user-container">
                <div id="user-btn" class="fas fa-user"></div>
                <div class="account-box">
                    <!-- For non-logged in users -->
                    <!-- <a href="login.php" class="btn">Login</a>
                    <a href="register.php" class="option-btn">Sign Up</a> -->
                    
                    <!-- Uncomment when you have user session -->
                    
                    <p>Welcome back! <span><?php echo $_SESSION['user_name']; ?></span> </p>

                    <a href="profile.php" class="btn">My Profile</a>
                    <a href="orders.php" class="btn">My Orders</a>
                    <a href="logout.php" class="delete-btn">Logout</a>
                   
                </div>
            </div>
            
            <!-- Uncomment these when you implement the PHP functionality -->
            
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php" class="icon-link">
                <i class="fas fa-heart"></i>
                <span><?php echo $wishlist_num_rows; ?></span>
            </a>
            
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php" class="icon-link">
                <i class="fas fa-shopping-cart"></i>
                <span><?php echo $cart_num_rows; ?></span>
            </a>
           
        </div>
    </div>
</header>

<script>
// JavaScript to handle the mobile menu and account dropdown
document.addEventListener('DOMContentLoaded', function() {
    const userBtn = document.getElementById('user-btn');
    const accountBox = document.querySelector('.account-box');
    const userContainer = document.querySelector('.user-container');
    const menuBtn = document.getElementById('menu-btn');
    const navbar = document.querySelector('.navbar');

    // Check if device is mobile/touch
    const isMobile = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

    if (isMobile) {
        // For mobile devices, use click instead of hover
        userBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            accountBox.classList.toggle('mobile-active');
            // Close navbar if open
            navbar.classList.remove('active');
        });

        // Close account box when clicking outside
        document.addEventListener('click', function(e) {
            if (!userContainer.contains(e.target)) {
                accountBox.classList.remove('mobile-active');
            }
        });
    }

    // Toggle mobile menu
    menuBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        navbar.classList.toggle('active');
        // Close account box if open
        if (isMobile) {
            accountBox.classList.remove('mobile-active');
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!menuBtn.contains(e.target) && !navbar.contains(e.target)) {
            navbar.classList.remove('active');
        }
    });

    // Close dropdowns when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (isMobile) {
                accountBox.classList.remove('mobile-active');
            }
            navbar.classList.remove('active');
        }
    });

    // Prevent account box from closing when clicking inside it
    accountBox.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>