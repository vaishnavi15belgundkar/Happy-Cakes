<?php
session_start();

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

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Responsive Login Form Sign In Sign Up</title>

    <style>
    /* Message box styling to fit current design */
    .message {
        background-color: var(--first-color);
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        font-size: 0.9rem;
        position: relative;
        text-align: center;
    }
    .message i {
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
    }
    </style>
</head>
<body>

<?php
if(isset($message)){
    foreach($message as $msg){
        echo '<div class="message"><span>'.$msg.'</span>
        <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
        </div>';
    }
}
?>

<div class="login">
    <div class="login__content">
        <div class="login__img">
            <img src="assets/img/img-login.svg" alt="">
        </div>

        <div class="login__forms">
            <form action="" method="post" class="login__registre" id="login-in">
                <h1 class="login__title">Sign In</h1>

                <div class="login__box">
                    <i class='bx bx-user login__icon'></i>
                    <input type="text" placeholder="Username" class="login__input" name="username" required> 
                </div>

                <div class="login__box">
                    <i class='bx bx-lock-alt login__icon'></i>
                    <input type="password" placeholder="Password" class="login__input" name="password" required>
                </div>

                <a href="#" class="login__forgot">Forgot password?</a>

                <button type="submit" class="login__button" name="submit">Sign In</button>
            </form>

            <form action="" class="login__create none" id="login-up">
                <h1 class="login__title">Create Account</h1>

                <div class="login__box">
                    <i class='bx bx-user login__icon'></i>
                    <input type="text" placeholder="Username" class="login__input">
                </div>

                <div class="login__box">
                    <i class='bx bx-at login__icon'></i>
                    <input type="text" placeholder="Email" class="login__input">
                </div>

                <div class="login__box">
                    <i class='bx bx-lock-alt login__icon'></i>
                    <input type="password" placeholder="Password" class="login__input">
                </div>

                <a href="#" class="login__button">Sign Up</a>

                <div>
                    <span class="login__account">Already have an Account ?</span>
                    <span class="login__signup" id="sign-in">Sign In</span>
                </div>

                <div class="login__social">
                    <a href="#" class="login__social-icon"><i class='bx bxl-facebook' ></i></a>
                    <a href="#" class="login__social-icon"><i class='bx bxl-twitter' ></i></a>
                    <a href="#" class="login__social-icon"><i class='bx bxl-google' ></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--===== MAIN JS =====-->
<script src="assets/js/main.js"></script>
</body>
</html>
