<?php


// Check if form is submitted
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials (hardcoded for admin)
    if($username === 'Admin' && $password === '123'){
        $_SESSION['admin_id'] = '1'; // Set session
        header('location:admin_dashboard.php'); // Redirect to admin page
        exit();
    } else {
        $message[] = 'Invalid username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Rubik', sans-serif;
      }
      body {
         background: #fde4e4; /* Light pink background */
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         padding: 1rem;
         margin: 0;
      }
      .form-container {
         background: #ffffff;
         padding: 2.5rem;
         border-radius: 15px;
         box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
         width: 100%;
         max-width: 400px;
         text-align: center;
         animation: slideIn 0.8s ease;
      }
      .form-container h3 {
         font-size: 2rem;
         color: #d63031;
         margin-bottom: 1.5rem;
         font-weight: bold;
      }
      .form-container .box {
         width: 100%;
         padding: 12px;
         margin: 0.6rem 0;
         border: 1px solid #ccc;
         border-radius: 8px;
         font-size: 1rem;
         transition: border-color 0.3s ease;
      }
      .form-container .box:focus {
         border-color: #ff6b81;
         outline: none;
         box-shadow: 0 0 5px rgba(255, 107, 129, 0.5);
      }
      .btn {
         background: #ff6b81;
         color: #fff;
         padding: 12px;
         border: none;
         border-radius: 8px;
         font-size: 1rem;
         cursor: pointer;
         transition: background 0.3s ease;
         width: 100%;
         margin-top: 1rem;
      }
      .btn:hover {
         background: #ff4757;
      }
      p {
         margin-top: 15px;
         font-size: 0.9rem;
      }
      p a {
         color: #ff4757;
         text-decoration: none;
         font-weight: bold;
      }
      p a:hover {
         text-decoration: underline;
      }
      .message {
         background: #ff6b81;
         color: white;
         padding: 10px;
         border-radius: 5px;
         margin-bottom: 10px;
         font-size: 0.9rem;
         position: relative;
      }
      .message i {
         position: absolute;
         top: 5px;
         right: 10px;
         cursor: pointer;
      }
      @keyframes slideIn {
         from {
            transform: translateY(-30px);
            opacity: 0;
         }
         to {
            transform: translateY(0);
            opacity: 1;
         }
      }
   </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message"> <span>'.$msg.'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
   }
}
?>

<section class="form-container">
   <h3>Admin Login</h3>
   <form action="" method="post">
      <input type="text" name="username" class="box" placeholder="Enter Admin Username" required>
      <input type="password" name="password" class="box" placeholder="Enter Password" required>
      <input type="submit" class="btn" name="submit" value="Login Now">
   </form>
</section>

</body>
</html>
