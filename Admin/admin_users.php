<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Happy Cakes Admin Panel - User Management">
    <meta name="author" content="">

    <title>Happy Cakes Admin - User Management</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Orders Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">All Orders</h6>
                        <a class="collapse-item" href="buttons.html">Processing</a>
                        <a class="collapse-item" href="cards.html">Delivered</a>
                        <a class="collapse-item" href="cards.html">Cancelled</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Products Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-cupcake"></i>
                    <span>Products</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Product Management:</h6>
                        <a class="collapse-item" href="utilities-color.html">Add Products</a>
                        <a class="collapse-item" href="utilities-border.html">Delete Products</a>
                        <a class="collapse-item" href="utilities-animation.html">Update Products</a>
                        <a class="collapse-item" href="utilities-other.html">View Products</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Users -->
            <li class="nav-item active">
                <a class="nav-link" href="admin_users.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span></a>
            </li>

            <!-- Nav Item - Feedback -->
            <li class="nav-item">
                <a class="nav-link" href="admin_feedback.php">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Feedback</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">April 12, 2025</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">April 7, 2025</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">April 2, 2025</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Total Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $total_users = mysqli_query($conn, "SELECT COUNT(*) as total FROM `users`") or die('query failed');
                                                    $total = mysqli_fetch_assoc($total_users);
                                                    echo $total['total'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Admin Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $admin_users = mysqli_query($conn, "SELECT COUNT(*) as admin_count FROM `users` WHERE user_type = 'admin'") or die('query failed');
                                                    $admin_count = mysqli_fetch_assoc($admin_users);
                                                    echo $admin_count['admin_count'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Regular Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Regular Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $regular_users = mysqli_query($conn, "SELECT COUNT(*) as user_count FROM `users` WHERE user_type = 'user'") or die('query failed');
                                                    $user_count = mysqli_fetch_assoc($regular_users);
                                                    echo $user_count['user_count'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Users (Last 7 Days) Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                New Users (7 Days)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    // FIXED: Check if registration_date column exists first
                                                    // And use proper date format for MySQL
                                                    $check_column = mysqli_query($conn, "SHOW COLUMNS FROM `users` LIKE 'registration_date'");
                                                    
                                                    if(mysqli_num_rows($check_column) > 0) {
                                                        // Column exists, proceed with query
                                                        $recent_users = mysqli_query($conn, "SELECT COUNT(*) as recent FROM `users` WHERE registration_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)") or die('query failed');
                                                        $recent = mysqli_fetch_assoc($recent_users);
                                                        echo $recent['recent'];
                                                    } else {
                                                        // Column doesn't exist, use creation date if available or show 0
                                                        echo '0';
                                                        // Alternative query if you have another date column:
                                                        // $recent_users = mysqli_query($conn, "SELECT COUNT(*) as recent FROM `users` WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)") or die('query failed');
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">User Accounts</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Filter By:</div>
                                    <a class="dropdown-item" href="#">All Users</a>
                                    <a class="dropdown-item" href="#">Admin Users</a>
                                    <a class="dropdown-item" href="#">Regular Users</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Add New User</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Registration Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Registration Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $select_users = mysqli_query($conn, "SELECT * FROM `users` ORDER BY id DESC") or die('query failed');
                                        if(mysqli_num_rows($select_users) > 0){
                                            while($fetch_users = mysqli_fetch_assoc($select_users)){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch_users['id']; ?></td>
                                            <td><?php echo $fetch_users['name']; ?></td>
                                            <td><?php echo $fetch_users['email']; ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo ($fetch_users['user_type'] == 'admin') ? 'success' : 'primary'; ?>">
                                                    <?php echo ucfirst($fetch_users['user_type']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php 
                                                // Display registration date if it exists in your database
                                                // FIXED: Check if column exists in the row data
                                                echo isset($fetch_users['registration_date']) ? $fetch_users['registration_date'] : 'N/A'; 
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewUserModal<?php echo $fetch_users['id']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal<?php echo $fetch_users['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- View User Modal -->
                                        <div class="modal fade" id="viewUserModal<?php echo $fetch_users['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel<?php echo $fetch_users['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewUserModalLabel<?php echo $fetch_users['id']; ?>">User Details: <?php echo $fetch_users['name']; ?></h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center mb-4">
                                                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg" width="100">
                                                            <h4 class="mt-2"><?php echo $fetch_users['name']; ?></h4>
                                                            <span class="badge badge-<?php echo ($fetch_users['user_type'] == 'admin') ? 'success' : 'primary'; ?>">
                                                                <?php echo ucfirst($fetch_users['user_type']); ?>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="card mb-4">
                                                            <div class="card-header">
                                                                <strong>Account Information</strong>
                                                            </div>
                                                            <div class="card-body">
                                                                <p><strong>User ID:</strong> <?php echo $fetch_users['id']; ?></p>
                                                                <p><strong>Email:</strong> <?php echo $fetch_users['email']; ?></p>
                                                                <p><strong>Registration Date:</strong> <?php echo isset($fetch_users['registration_date']) ? $fetch_users['registration_date'] : 'N/A'; ?></p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <strong>Order Statistics</strong>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php
                                                                // Query to get order statistics for this user
                                                                // FIXED: Added error handling and proper checking
                                                                $user_id = $fetch_users['id'];
                                                                
                                                                // Check if orders table exists
                                                                $check_table = mysqli_query($conn, "SHOW TABLES LIKE 'orders'");
                                                                if(mysqli_num_rows($check_table) > 0) {
                                                                    // Table exists, proceed with query
                                                                    $order_stats = mysqli_query($conn, "SELECT 
                                                                        COUNT(*) as total_orders,
                                                                        SUM(total_price) as total_spent
                                                                        FROM `orders` 
                                                                        WHERE user_id = '$user_id'") or die('query failed');
                                                                    $stats = mysqli_fetch_assoc($order_stats);
                                                                    
                                                                    // Display order statistics
                                                                    echo "<p><strong>Total Orders:</strong> " . $stats['total_orders'] . "</p>";
                                                                    echo "<p><strong>Total Spent:</strong> $" . number_format($stats['total_spent'] ?? 0, 2) . "</p>";
                                                                    
                                                                    // Get last order date
                                                                    $last_order = mysqli_query($conn, "SELECT order_date FROM `orders` WHERE user_id = '$user_id' ORDER BY order_date DESC LIMIT 1");
                                                                    
                                                                    echo "<p><strong>Last Order:</strong> ";
                                                                    if(mysqli_num_rows($last_order) > 0) {
                                                                        $order_date = mysqli_fetch_assoc($last_order);
                                                                        echo $order_date['order_date'];
                                                                    } else {
                                                                        echo 'No orders yet';
                                                                    }
                                                                    echo "</p>";
                                                                } else {
                                                                    // Table doesn't exist or can't be accessed
                                                                    echo "<p>No order data available</p>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                        <a href="#" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#editUserModal<?php echo $fetch_users['id']; ?>">
                                                            <i class="fas fa-edit"></i> Edit User
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit User Modal -->
                                        <div class="modal fade" id="editUserModal<?php echo $fetch_users['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel<?php echo $fetch_users['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserModalLabel<?php echo $fetch_users['id']; ?>">Edit User: <?php echo $fetch_users['name']; ?></h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="update_user.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="user_id" value="<?php echo $fetch_users['id']; ?>">
                                                            
                                                            <div class="form-group">
                                                                <label for="username">Username</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $fetch_users['name']; ?>" required>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $fetch_users['email']; ?>" required>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="user_type">User Type</label>
                                                                <select class="form-control" id="user_type" name="user_type">
                                                                    <option value="user" <?php echo ($fetch_users['user_type'] == 'user') ? 'selected' : ''; ?>>Regular User</option>
                                                                    <option value="admin" <?php echo ($fetch_users['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="password">New Password (leave blank to keep current)</label>
                                                                <input type="password" class="form-control" id="password" name="password">
                                                                <small class="form-text text-muted">Only fill this if you want to change the user's password.</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="6" class="text-center">No users found</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Add New User Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New User</h6>
                        </div>
                        <div class="card-body">
                            <form action="add_user.php" method="post" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="new_username">Username</label>
                                        <input type="text" class="form-control" id="new_username" name="name" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a username.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="new_email">Email</label>
                                        <input type="email" class="form-control" id="new_email" name="email" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid email.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="new_password">Password</label>
                                        <input type="password" class="form-control" id="new_password" name="password" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a password.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                                                                        <label for="new_user_type">User Type</label>
                                        <select class="form-control" id="new_user_type" name="user_type" required>
                                            <option value="">Select Type</option>
                                            <option value="user">Regular User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select a user type.
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="add_user">Add User</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Happy Cakes Admin 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });

        // Form validation script
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</body>

</html>