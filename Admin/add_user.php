<?php
// This file handles adding new users from the admin panel

@include 'config.php';

session_start();

// Check admin session
$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Always exit after header redirect
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    
    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($user_type)) {
        $_SESSION['message'] = 'All fields are required!';
        header('location:admin_users.php');
        exit();
    }
    
    // Check if email format is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Invalid email format';
        header('location:admin_users.php');
        exit();
    }
    
    // Check if email already exists
    $check_email = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed: ' . mysqli_error($conn));
    
    if (mysqli_num_rows($check_email) > 0) {
        $_SESSION['message'] = 'Email already exists!';
        header('location:admin_users.php');
        exit();
    } else {
        // Hash the password (consider using a more secure method in production)
        $hashed_password = md5($password);
        
        // Get current date for registration_date field
        $registration_date = date('Y-m-d H:i:s');
        
        // Insert new user
        $insert_query = "INSERT INTO `users` (name, email, password, user_type, registration_date) 
                         VALUES ('$name', '$email', '$hashed_password', '$user_type', '$registration_date')";
        
        if (mysqli_query($conn, $insert_query)) {
            $_SESSION['message'] = 'User added successfully!';
        } else {
            $_SESSION['message'] = 'Failed to add user: ' . mysqli_error($conn);
        }
        
        header('location:admin_users.php');
        exit();
    }
} else {
    // If not POST request, redirect to admin users page
    header('location:admin_users.php');
    exit();
}
?>