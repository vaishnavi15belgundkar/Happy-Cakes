<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Happy<span>Cakes</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Dashboard</a>
         <a href="admin_products.php">ADD</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Feedbacks</a>
         <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a> <!-- Added Logout Link -->
      </nav>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Logout</a> <!-- This can stay if you want it in both places -->
      </div>

   </div>

</header>
