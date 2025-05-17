<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Orders</title>
   <link rel="stylesheet" href="css/style.css">
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
    /* Orders Page Styling */
.orders-container {
   max-width: 1200px;
   margin: 0 auto;
   padding: 2rem;
}

.orders-wrapper {
   background-color: rgba(255, 255, 255, 0.8);
   border-radius: 1rem;
   box-shadow: var(--box-shadow);
   padding: 2rem;
   backdrop-filter: blur(5px);
}

.orders-count {
   margin-bottom: 2rem;
   text-align: left;
   padding: 1rem 0;
   border-bottom: 1px solid var(--light-white);
}

.orders-count p {
   font-size: 1.8rem;
   color: var(--black);
}

.orders-count span {
   color: var(--pink);
   font-weight: bold;
}

.orders-list {
   display: flex;
   flex-direction: column;
   gap: 2rem;
}

.order-card {
   background-color: var(--white);
   border-radius: 0.8rem;
   box-shadow: 0 0.3rem 0.5rem rgba(0,0,0,0.1);
   overflow: hidden;
   transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.order-card:hover {
   transform: translateY(-5px);
   box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}

.order-header {
   background-color: var(--pink);
   color: var(--white);
   padding: 1.5rem;
   display: flex;
   justify-content: space-between;
   align-items: center;
}

.order-date {
   display: flex;
   align-items: center;
   gap: 0.8rem;
   font-size: 1.5rem;
}

.order-id {
   font-size: 1.5rem;
   font-weight: 600;
}

.order-body {
   padding: 2rem;
   display: flex;
   flex-direction: column;
   gap: 2rem;
}

.order-items {
   background-color: var(--light-bg);
   padding: 1.5rem;
   border-radius: 0.5rem;
}

.order-items h4 {
   font-size: 1.8rem;
   color: var(--black);
   margin-bottom: 1rem;
}

.order-items p {
   font-size: 1.6rem;
   color: var(--light-color);
}

.order-info {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
   gap: 2rem;
}

.info-col h4 {
   font-size: 1.8rem;
   color: var(--black);
   margin-bottom: 1.5rem;
   padding-bottom: 0.5rem;
   border-bottom: 1px solid var(--light-white);
}

.info-item {
   display: flex;
   gap: 1rem;
   margin-bottom: 1rem;
   align-items: flex-start;
}

.info-item i {
   font-size: 1.6rem;
   color: var(--pink);
   margin-top: 0.3rem;
}

.info-item p {
   font-size: 1.6rem;
   color: var(--light-color);
   line-height: 1.5;
}

.price {
   color: var(--pink);
   font-weight: bold;
}

.status {
   font-weight: bold;
   text-transform: capitalize;
}

.status.completed {
   color: #2ecc71;
}

.status.pending {
   color: #f39c12;
}

.order-footer {
   padding: 1.5rem 2rem;
   display: flex;
   gap: 1rem;
   border-top: 1px solid var(--light-white);
   background-color: var(--light-bg);
}

.track-btn, .support-btn {
   font-size: 1.5rem;
   padding: 1rem 2rem;
}

.empty-orders {
   text-align: center;
   padding: 5rem 2rem;
}

.empty-orders img {
   width: 15rem;
   margin-bottom: 2rem;
   opacity: 0.7;
}

.empty-orders h3 {
   font-size: 2.5rem;
   color: var(--black);
   margin-bottom: 1rem;
}

.empty-orders p {
   font-size: 1.6rem;
   color: var(--light-color);
   margin-bottom: 2rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
   .order-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
   }
   
   .order-footer {
      flex-direction: column;
   }
   
   .info-col {
      padding: 1rem 0;
   }
}
    </style>
</head>
<body>
   
<?php @include 'header2.php'; ?>

<section class="heading">
    <h3>My Orders</h3>
    <p>Track and manage all your purchases</p>
</section>

<section class="orders-container">
    <div class="orders-wrapper">
        <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' ORDER BY placed_on DESC") or die('query failed');
            if(mysqli_num_rows($select_orders) > 0){
        ?>
        <div class="orders-count">
            <p>You have <span><?php echo mysqli_num_rows($select_orders); ?></span> order(s)</p>
        </div>
        
        <div class="orders-list">
            <?php
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <div class="order-card">
                <div class="order-header">
                    <div class="order-date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Ordered on: <?php echo date('d M Y', strtotime($fetch_orders['placed_on'])); ?></span>
                    </div>
                    <div class="order-id">
                        <span>Order #<?php echo substr(md5($fetch_orders['id']), 0, 8); ?></span>
                    </div>
                </div>
                
                <div class="order-body">
                    <div class="order-items">
                        <h4>Items</h4>
                        <?php 
                            $items = array_filter(array_map('trim', explode(',', $fetch_orders['total_products'])));
                            if (!empty($items)) {
                                foreach($items as $item){
                                    echo "<p>" . htmlspecialchars($item) . "</p>";
                                }
                            } else {
                                echo "<p>No items found.</p>";
                            }
                        ?>
                    </div>
                    
                    <div class="order-info">
                        <div class="info-col">
                            <h4>Shipping Details</h4>
                            <div class="info-item">
                                <i class="fas fa-user"></i>
                                <p><?php echo htmlspecialchars($fetch_orders['name']); ?></p>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <p><?php echo htmlspecialchars($fetch_orders['number']); ?></p>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <p><?php echo htmlspecialchars($fetch_orders['email']); ?></p>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <p><?php echo htmlspecialchars($fetch_orders['address']); ?></p>
                            </div>
                        </div>
                        
                        <div class="info-col">
                            <h4>Payment Info</h4>
                            <div class="info-item">
                                <i class="fas fa-wallet"></i>
                                <p>Method: <?php echo htmlspecialchars($fetch_orders['method']); ?></p>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-money-bill-wave"></i>
                                <p>Total: <span class="price">₹<?php echo htmlspecialchars($fetch_orders['total_price']); ?>/-</span></p>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-circle-check"></i>
                                <p>Status: 
                                    <span class="status <?php echo ($fetch_orders['payment_status'] == 'completed') ? 'completed' : 'pending'; ?>">
                                        <?php echo htmlspecialchars($fetch_orders['payment_status']); ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="order-footer">
                    <button class="track-btn btn">Track Order</button>
                    <button class="support-btn option-btn">Need Help?</button>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <div class="empty-orders">
            <img src="images/empty-box.png" alt="No Orders" onerror="this.src='https://via.placeholder.com/150?text=No+Orders'">
            <h3>You haven't placed any orders yet!</h3>
            <p>Explore our products and find something you'll love.</p>
            <a href="shop.php" class="btn">Start Shopping</a>
        </div>
        <?php } ?>
    </div>
</section>

<?php @include 'footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>