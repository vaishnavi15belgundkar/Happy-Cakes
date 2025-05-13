<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $email = mysqli_real_escape_string($conn, $filter_email);

   $pass = mysqli_real_escape_string($conn, password_hash($_POST['pass'], PASSWORD_BCRYPT));
   $cpass = $_POST['cpass'];

   $filter_city = filter_var($_POST['hint_city'], FILTER_SANITIZE_STRING);
   $hint_city = mysqli_real_escape_string($conn, $filter_city);

   $filter_movie = filter_var($_POST['hint_movie'], FILTER_SANITIZE_STRING);
   $hint_movie = mysqli_real_escape_string($conn, $filter_movie);

   // Default user type
   $user_type = 'user';  // Automatically set to 'user'

   $select_users = mysqli_prepare($conn, "SELECT email FROM users WHERE email = ?");
   mysqli_stmt_bind_param($select_users, "s", $email);
   mysqli_stmt_execute($select_users);
   mysqli_stmt_store_result($select_users);

   if(mysqli_stmt_num_rows($select_users) > 0){
      $message[] = 'User already exists!';
   } else {
      if(!password_verify($cpass, $pass)){
         $message[] = 'Confirm password does not match!';
      } else {
         $insert_user = mysqli_prepare($conn, "INSERT INTO users(name, email, password, hint_city, hint_movie, user_type) VALUES(?, ?, ?, ?, ?, ?)");
         mysqli_stmt_bind_param($insert_user, "ssssss", $name, $email, $pass, $hint_city, $hint_movie, $user_type);
         mysqli_stmt_execute($insert_user);
         $message[] = 'Registered successfully!';
         header('location:login.php');
         exit();
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
   <title>Register</title>
   <link rel="stylesheet" href="css/style.css">
   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
      body {
         margin: 0;
         padding: 0;
         font-family: Arial, sans-serif;
         background-image: url('background.png');
         background-size: cover;
         background-position: center;
         background-attachment: fixed;
         min-height: 100vh;
      }

      .message-container {
         position: fixed;
         top: 20px;
         left: 50%;
         transform: translateX(-50%);
         width: 100%;
         max-width: 1200px;
         z-index: 10000;
      }

      .message {
         margin: 0 auto 10px;
         padding: 1.5rem;
         display: flex;
         align-items: center;
         justify-content: space-between;
         gap: 1.5rem;
         background-color: var(--light-bg);
         box-shadow: var(--box-shadow);
         border-radius: 0.5rem;
         color: var(--red);
         font-size: 2rem;
      }

      .message i {
         font-size: 2.5rem;
         color: var(--red);
         cursor: pointer;
         transition: all 0.3s ease;
      }

      .message i:hover {
         transform: rotate(90deg);
      }

      .form-container {
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding: 2rem;
      }

      .form-container form {
         width: 100%;
         max-width: 40rem;
         padding: 3rem;
         border-radius: 1rem;
         background-color: rgba(255, 255, 255, 0.8);
         backdrop-filter: blur(10px);
         box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
         text-align: center;
         position: relative;
         overflow: hidden;
      }

      .form-container form::before {
         content: '';
         position: absolute;
         top: -5rem;
         left: -5rem;
         width: 10rem;
         height: 10rem;
         background-color: var(--pink);
         border-radius: 50%;
         opacity: 0.5;
         z-index: -1;
      }

      .form-container form::after {
         content: '';
         position: absolute;
         bottom: -5rem;
         right: -5rem;
         width: 12rem;
         height: 12rem;
         background-color: var(--pink);
         border-radius: 50%;
         opacity: 0.3;
         z-index: -1;
      }

      .form-container form h3 {
         font-size: 3rem;
         color: var(--pink);
         margin-bottom: 2rem;
         text-transform: uppercase;
         letter-spacing: 1px;
      }

      .input-container {
         position: relative;
         margin: 1.5rem 0;
      }

      .input-container i {
         position: absolute;
         left: 2rem;
         top: 50%;
         transform: translateY(-50%);
         font-size: 1.8rem;
         color: var(--light-color);
         z-index: 1;
      }

      .form-container form .box {
         width: 100%;
         margin: 0;
         padding: 1.5rem 2rem 1.5rem 5rem;
         font-size: 1.8rem;
         color: var(--black);
         border: none;
         border-radius: 3rem;
         background-color: var(--light-bg);
         box-shadow: inset 0 0.2rem 0.5rem rgba(0, 0, 0, 0.1);
         transition: all 0.3s ease;
         box-sizing: border-box;
      }

      .form-container form .box:focus {
         box-shadow: inset 0 0.2rem 0.5rem rgba(232, 67, 147, 0.3);
         background-color: white;
         outline: none;
      }

      .form-container form .btn {
         display: inline-block;
         width: 100%;
         margin-top: 2.5rem;
         padding: 1.5rem;
         font-size: 1.8rem;
         color: var(--white);
         background-color: var(--pink);
         border: none;
         border-radius: 3rem;
         cursor: pointer;
         text-transform: uppercase;
         letter-spacing: 1px;
         box-shadow: 0 0.5rem 1rem rgba(232, 67, 147, 0.3);
         transition: all 0.3s ease;
      }

      .form-container form .btn:hover {
         background-color: #d3237c;
         transform: translateY(-3px);
      }

      .form-container form p {
         margin-top: 2rem;
         font-size: 1.7rem;
         color: var(--light-color);
      }

      .form-container form p a {
         color: var(--pink);
         font-weight: bold;
         text-decoration: none;
      }

      .form-container form p a:hover {
         text-decoration: underline;
      }

      @media (max-width: 768px) {
         .form-container form {
            padding: 2rem;
         }

         .form-container form h3 {
            font-size: 2.5rem;
         }

         .form-container form .box,
         .form-container form .btn {
            font-size: 1.6rem;
         }

         .input-container i {
            font-size: 1.6rem;
         }
      }

      @media (max-width: 480px) {
         .form-container {
            padding: 1rem;
         }

         .form-container form h3 {
            font-size: 2rem;
         }

         .form-container form .box,
         .form-container form .btn {
            font-size: 1.4rem;
            padding: 1.2rem 2rem 1.2rem 4.5rem;
         }

         .input-container i {
            font-size: 1.4rem;
            left: 1.5rem;
         }

         .form-container form p {
            font-size: 1.4rem;
         }
      }
   </style>
</head>
<body>

<?php
if(isset($message)){
   echo '<div class="message-container">';
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
   echo '</div>';
}
?>

<section class="form-container">
   <form action="" method="post">
      <h3>Register Now</h3>
      
      <div class="input-container">
         <i class="fas fa-user"></i>
         <input type="text" name="name" class="box" placeholder="Enter your name" required>
      </div>

      <div class="input-container">
   <i class="fas fa-phone"></i>
   <input type="tel" name="phone" class="box" placeholder="Enter your phone number" required>
   </div>

      
      <div class="input-container">
         <i class="fas fa-envelope"></i>
         <input type="email" name="email" class="box" placeholder="Enter your email" required>
      </div>
      
      <div class="input-container">
         <i class="fas fa-lock"></i>
         <input type="password" name="pass" class="box" placeholder="Enter your password" required>
      </div>
      
      <div class="input-container">
         <i class="fas fa-check-circle"></i>
         <input type="password" name="cpass" class="box" placeholder="Confirm your password" required>
      </div>
      
      <!-- <div class="input-container">
         <i class="fas fa-city"></i>
         <input type="text" name="hint_city" class="box" placeholder="What is your city name?" required>
      </div>
      
      <div class="input-container">
         <i class="fas fa-film"></i>
         <input type="text" name="hint_movie" class="box" placeholder="What is your favorite movie?" required>
      </div> -->
      
      <input type="submit" class="btn" name="submit" value="Register Now">
      
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>
</section>

</body>
</html>