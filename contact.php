<?php

@include 'config.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// };

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');       
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <link rel="stylesheet" href="css/style.css">
<style>
.contact-container {
   max-width: 1200px;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   gap: 3rem;
   padding: 2rem 0;
}

.contact-info {
   display: flex;
   flex-direction: column;
   gap: 2rem;
}

.contact-info .info-item {
   display: flex;
   align-items: flex-start;
   gap: 1.5rem;
   background-color: var(--white);
   padding: 2rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
}

.contact-info .info-item i {
   font-size: 2.5rem;
   color: var(--pink);
   margin-top: 0.5rem;
}

.contact-info .info-item h3 {
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .5rem;
}

.contact-info .info-item p {
   font-size: 1.5rem;
   color: var(--light-color);
   line-height: 1.5;
}

.contact form {
   background-color: var(--white);
   padding: 3rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
}

.contact form h3 {
   text-align: center;
   font-size: 2.5rem;
   color: var(--black);
   margin-bottom: 2rem;
}

.contact form .box {
   width: 100%;
   margin: 1rem 0;
   padding: 1.2rem 1.4rem;
   font-size: 1.6rem;
   color: var(--black);
   border-radius: .5rem;
   background-color: var(--light-bg);
}

.contact form textarea {
   height: 15rem;
   resize: none;
}

</style>
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>contact us</h3>
</section>

<section class="contact" id="contact">

      <div class="contact-container">
         <div class="contact-info">
            <div class="info-item">
               <i class="fas fa-map-marker-alt"></i>
               <div>
                  <h3>Our Location</h3>
                  <p>123 Cake Street, Sweet City, SC 45678</p>
               </div>
            </div>
            
            <div class="info-item">
               <i class="fas fa-envelope"></i>
               <div>
                  <h3>Email Us</h3>
                  <p>info@happycakes.com</p>
               </div>
            </div>
            
            <div class="info-item">
               <i class="fas fa-phone"></i>
               <div>
                  <h3>Call Us</h3>
                  <p>+1 234 567 8900</p>
               </div>
            </div>
            
            <div class="info-item">
               <i class="fas fa-clock"></i>
               <div>
                  <h3>Opening Hours</h3>
                  <p>Monday - Saturday: 9:00 AM - 8:00 PM</p>
                  <p>Sunday: 10:00 AM - 6:00 PM</p>
               </div>
            </div>
         </div>

         <form action="" method="post">
            <h3>Get in Touch</h3>
            <input type="text" name="name" placeholder="Your Name" class="box" required>
            <input type="email" name="email" placeholder="Your Email" class="box" required>
            <input type="tel" name="phone" placeholder="Your Phone" class="box">
            <textarea name="message" class="box" placeholder="Your Message" required></textarea>
            <input type="submit" value="Send Message" class="btn" name="send_message">
         </form>
      </div>
   </section>


<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>