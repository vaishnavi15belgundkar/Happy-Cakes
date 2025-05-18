<?php
// This file handles updating user information from the admin panel

@include 'config.php';

session_start();

// Check admin session
$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Always exit after header redirect
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Basic validation
    if (empty($user_id) || empty($username) || empty($email) || empty($user_type)) {
        $_SESSION['message'] = 'All required fields must be filled';
        header('location:admin_users.php');
        exit();
    }
    
    // Check if email format is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Invalid email format';
        header('location:admin_users.php');
        exit();
    }
    
    // Build update query - start with basic fields
    $update_query = "UPDATE `users` SET 
                    name = '$username', 
                    email = '$email', 
                    user_type = '$user_type'";
    
    // Add password update if provided
    if (!empty($password)) {
        $hashed_password = md5($password); // Consider using a more secure hashing method
        $update_query .= ", password = '$hashed_password'";
    }
    
    // Complete the query
    $update_query .= " WHERE id = '$user_id'";
    
    // Execute the update
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['message'] = 'User updated successfully!';
    } else {
        $_SESSION['message'] = 'Failed to update user: ' . mysqli_error($conn);
    }
    
    // Redirect back to user management page
    header('location:admin_users.php');
    exit();
} else {
    // If not POST request, redirect to admin users page
    header('location:admin_users.php');
    exit();
}
?>  