<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $email);

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $name);

    $hint_city = filter_var($_POST['hint_city'], FILTER_SANITIZE_STRING);
    $hint_city = mysqli_real_escape_string($conn, $hint_city);

    $hint_movie = filter_var($_POST['hint_movie'], FILTER_SANITIZE_STRING);
    $hint_movie = mysqli_real_escape_string($conn, $hint_movie);

    $query = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? AND name = ? AND hint_city = ? AND hint_movie = ?");
    mysqli_stmt_bind_param($query, "ssss", $email, $name, $hint_city, $hint_movie);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if (mysqli_fetch_assoc($result)) {
        $_SESSION['reset_email'] = $email;  // Store email in session for reset.php
        header('location:reset.php');
        exit;
    } else {
        $message[] = 'Hints do not match! Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        * {
            font-family: 'Rubik', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
        }

        body {
            background-color: #f4e6f7;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 40rem;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container h3 {
            font-size: 2.6rem;
            margin-bottom: 2rem;
            color: #333333;
            font-weight: 600;
        }

        .form-container .box {
            width: 100%;
            padding: 1.2rem;
            font-size: 1.6rem;
            margin: 1rem 0;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            background-color: #f9f9f9;
        }

        .form-container .btn {
            width: 100%;
            padding: 1.2rem;
            font-size: 1.6rem;
            background-color: #6f42c1;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .form-container .btn:hover {
            background-color: #5936a3;
        }

        .message {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            padding: 1.2rem 2rem;
            border: 1px solid #f5c6cb;
            border-radius: 0.5rem;
            font-size: 1.6rem;
            color: #721c24;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 30rem;
            z-index: 1000;
        }

        .message i {
            cursor: pointer;
            margin-left: 1rem;
        }

        .message i:hover {
            color: #a71d2a;
        }
    </style>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();">&#10006;</i>
        </div>';
    }
}
?>

<section class="form-container">
    <form action="" method="post" class="form-container">
        <h3>Forgot Password</h3>
        <input type="email" name="email" class="box" placeholder="Enter your email" required>
        <input type="text" name="name" class="box" placeholder="Enter your name" required>
        <input type="text" name="hint_city" class="box" placeholder="Hint - Favorite City" required>
        <input type="text" name="hint_movie" class="box" placeholder="Hint - Favorite Movie" required>
        <input type="submit" class="btn" name="submit" value="Verify Now">
    </form>
</section>

</body>
</html>
