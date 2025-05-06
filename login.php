<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);

   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];  // Do NOT hash here

   $select_users = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
   mysqli_stmt_bind_param($select_users, "s", $email);
   mysqli_stmt_execute($select_users);
   $result = mysqli_stmt_get_result($select_users);

   if($row = mysqli_fetch_assoc($result)){
      if(password_verify($pass, $row['password'])) {
         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
         } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      } else {
         $message[] = 'Incorrect email or password!';
      }
   } else {
      $message[] = 'Incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <style>
      * { font-family: 'Rubik', sans-serif; margin: 0; padding: 0; box-sizing: border-box; text-decoration: none; transition: all 0.3s ease; }
      html { font-size: 62.5%; overflow-x: hidden; }
      body { background-color: #f4e6f7; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
      .form-container { background-color: #ffffff; padding: 3rem; border-radius: 1rem; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 40rem; text-align: center; }
      h3 { font-size: 2.6rem; margin-bottom: 2rem; }
      .box { width: 100%; padding: 1.2rem; margin: 1rem 0; font-size: 1.6rem; }
      .btn { width: 100%; padding: 1.2rem; background-color: #6f42c1; color: white; border: none; cursor: pointer; }
      .btn:hover { background-color: #5936a3; }
      p, .forgot-password { margin-top: 1rem; font-size: 1.4rem; }
      p a, .forgot-password a { color: #007bff; }
      p a:hover, .forgot-password a:hover { text-decoration: underline; }
      .admin-login { margin-top: 2rem; font-size: 1.4rem; color: #dc3545; cursor: pointer; }
      .admin-login:hover { text-decoration: underline; }
      .message { position: fixed; top: 10px; left: 50%; transform: translateX(-50%); background-color: #f8d7da; padding: 1.2rem 2rem; border-radius: 0.5rem; color: #721c24; z-index: 1000; }
   </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo "<div class='message'>$msg</div>";
   }
}
?>

<section class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <input type="email" name="email" class="box" placeholder="Enter your email" required>
      <input type="password" name="pass" class="box" placeholder="Enter your password" required>
      <input type="submit" class="btn" name="submit" value="Login Now">
      <p>Create New Account? <a href="register.php">Register Now</a></p>
      <div class="forgot-password">
         <a href="forgot_password.php">Forgot Password?</a>
      </div>
      <a href="admin_login.php" class="admin-login">Login as Admin</a>
   </form>
</section>

</body>
</html>
