<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login1.php');
   exit();
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   // Added proper input sanitization to prevent SQL injection
   $delete_id = mysqli_real_escape_string($conn, $delete_id);
   $delete_query = mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'");
   
   if($delete_query){
      // Success message can be added here if needed
      header('location:admin_feedback.php');
   } else {
      echo "Delete operation failed: " . mysqli_error($conn);
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Happy Cakes Admin Panel - Feedback Management">
    <meta name="author" content="">

    <title>Happy Cakes Admin - Feedback Management</title>

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
                    <i class="fas fa-laugh-wink"></i>
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
                    <i class="fas fa-fw fa-cog"></i>
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
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Products</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Add Products</a>
                        <a class="collapse-item" href="utilities-border.html">Delete Products</a>
                        <a class="collapse-item" href="utilities-animation.html">Update Products</a>
                        <a class="collapse-item" href="utilities-other.html">View Products</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Users</span></a>
            </li>

            <!-- Nav Item - Feedback -->
            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Customer Feedback</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </a>
                    </div>

                    <!-- Feedback Summary Cards -->
                    <div class="row">
                        <!-- Total Feedback Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Feedback</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    // Added error handling
                                                    $total_feedback = mysqli_query($conn, "SELECT COUNT(*) as total FROM `message`");
                                                    if($total_feedback) {
                                                        $total = mysqli_fetch_assoc($total_feedback);
                                                        echo $total['total'];
                                                    } else {
                                                        echo "0";
                                                        // Log error for debugging
                                                        error_log("Query failed: " . mysqli_error($conn));
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Feedback (Last 7 Days) Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                New Feedback (7 Days)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    // Checking if date_sent column exists in the message table
                                                    $recent_feedback = mysqli_query($conn, "SELECT COUNT(*) as recent FROM `message` WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
                                                    if(!$recent_feedback) {
                                                        // Try alternative column name if date_sent doesn't exist
                                                        $recent_feedback = mysqli_query($conn, "SELECT COUNT(*) as recent FROM `message` WHERE date >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
                                                    }
                                                    
                                                    if($recent_feedback) {
                                                        $recent = mysqli_fetch_assoc($recent_feedback);
                                                        echo $recent['recent'];
                                                    } else {
                                                        echo "0";
                                                        // Log error for debugging
                                                        error_log("Query failed: " . mysqli_error($conn));
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Responses Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Responses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    // Check if status column exists
                                                    $pending_query = "SELECT COUNT(*) as pending FROM `message` WHERE status = 'pending' OR status IS NULL";
                                                    $pending_responses = mysqli_query($conn, $pending_query);
                                                    
                                                    if($pending_responses) {
                                                        $pending = mysqli_fetch_assoc($pending_responses);
                                                        echo $pending['pending'];
                                                    } else {
                                                        echo "0";
                                                        // Log error for debugging
                                                        error_log("Query failed: " . mysqli_error($conn));
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Positive Feedback Percentage Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Response Rate</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php
                                                        // Calculate response rate
                                                        $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM `message`");
                                                        $responded_query = mysqli_query($conn, "SELECT COUNT(*) as responded FROM `message` WHERE status = 'responded'");
                                                        
                                                        if($total_query && $responded_query) {
                                                            $total_count = mysqli_fetch_assoc($total_query)['total'];
                                                            $responded_count = mysqli_fetch_assoc($responded_query)['responded'];
                                                            
                                                            $response_rate = ($total_count > 0) ? round(($responded_count / $total_count) * 100) : 0;
                                                            echo $response_rate . '%';
                                                            
                                                            // Store for progress bar
                                                            $progress_percentage = $response_rate;
                                                        } else {
                                                            echo "0%";
                                                            $progress_percentage = 0;
                                                            // Log error for debugging
                                                            error_log("Query failed: " . mysqli_error($conn));
                                                        }
                                                    ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $progress_percentage; ?>%" aria-valuenow="<?php echo $progress_percentage; ?>" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Feedback Messages -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Customer Messages</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Filter By:</div>
                                    <a class="dropdown-item" href="#">All Messages</a>
                                    <a class="dropdown-item" href="#">Unread</a>
                                    <a class="dropdown-item" href="#">Responded</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Mark All as Read</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            // Check for and display session messages
                            if(isset($_SESSION['success_msg'])) {
                                echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_msg']) . '</div>';
                                unset($_SESSION['success_msg']);
                            }
                            
                            if(isset($_SESSION['error_msg'])) {
                                echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_msg']) . '</div>';
                                unset($_SESSION['error_msg']);
                            }
                            ?>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered" id="feedbackTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $select_message = mysqli_query($conn, "SELECT * FROM `message` ORDER BY id DESC");
                                        if($select_message && mysqli_num_rows($select_message) > 0){
                                            while($fetch_message = mysqli_fetch_assoc($select_message)){
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($fetch_message['user_id']); ?></td>
                                            <td><?php echo htmlspecialchars($fetch_message['name']); ?></td>
                                            <td><?php echo htmlspecialchars($fetch_message['email']); ?></td>
                                            <td><?php echo htmlspecialchars($fetch_message['number']); ?></td>
                                            <td>
                                                <?php 
                                                // Truncate message if it's too long
                                                $message = $fetch_message['message'];
                                                echo htmlspecialchars((strlen($message) > 100) ? substr($message, 0, 100) . '...' : $message);
                                                ?>
                                                <button class="btn btn-sm btn-link" data-toggle="modal" data-target="#viewMessageModal<?php echo $fetch_message['id']; ?>">
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                <span class="badge badge-<?php echo isset($fetch_message['status']) && $fetch_message['status'] == 'responded' ? 'success' : 'warning'; ?>">
                                                    <?php echo isset($fetch_message['status']) ? ucfirst($fetch_message['status']) : 'Pending'; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#replyModal<?php echo $fetch_message['id']; ?>">
                                                        <i class="fas fa-reply"></i>
                                                    </a>
                                                    <a href="admin_feedback.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- View Message Modal -->
                                        <div class="modal fade" id="viewMessageModal<?php echo $fetch_message['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewMessageModalLabel<?php echo $fetch_message['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewMessageModalLabel<?php echo $fetch_message['id']; ?>">Message from <?php echo htmlspecialchars($fetch_message['name']); ?></h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card mb-4">
                                                            <div class="card-header">
                                                                <strong>Contact Details</strong>
                                                            </div>
                                                            <div class="card-body">
                                                                <p><strong>Name:</strong> <?php echo htmlspecialchars($fetch_message['name']); ?></p>
                                                                <p><strong>Email:</strong> <?php echo htmlspecialchars($fetch_message['email']); ?></p>
                                                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($fetch_message['number']); ?></p>
                                                                <p><strong>User ID:</strong> <?php echo htmlspecialchars($fetch_message['user_id']); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <strong>Message Content</strong>
                                                            </div>
                                                            <div class="card-body">
                                                                <p><?php echo nl2br(htmlspecialchars($fetch_message['message'])); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-primary" type="button" data-dismiss="modal" data-toggle="modal" data-target="#replyModal<?php echo $fetch_message['id']; ?>">Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reply Modal -->
                                        <div class="modal fade" id="replyModal<?php echo $fetch_message['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel<?php echo $fetch_message['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="replyModalLabel<?php echo $fetch_message['id']; ?>">Reply to <?php echo htmlspecialchars($fetch_message['name']); ?></h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="send_reply.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="message_id" value="<?php echo $fetch_message['id']; ?>">
                                                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($fetch_message['email']); ?>">
                                                            
                                                            <div class="form-group">
                                                                <label for="subject">Subject</label>
                                                                <input type="text" class="form-control" id="subject" name="subject" value="RE: Customer Feedback - Happy Cakes" required>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="reply_message">Message</label>
                                                                <textarea class="form-control" id="reply_message" name="reply_message" rows="6" required>Dear <?php echo htmlspecialchars($fetch_message['name']); ?>,

Thank you for your feedback. We appreciate you taking the time to share your thoughts with us.

[Your response here]

Best regards,
Happy Cakes Team</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Send Reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        } else {
                                            if(!$select_message) {
                                                echo '<tr><td colspan="7" class="text-center text-danger">Error retrieving feedback: ' . mysqli_error($conn) . '</td></tr>';
                                            } else {
                                                echo '<tr><td colspan="7" class="text-center">No feedback messages found</td></tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
                        <span>Copyright &copy; Happy Cakes 2025</span>
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
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('#feedbackTable').DataTable({
                "order": [[ 0, "desc" ]],
                "pageLength": 10,
                "language": {
                    "search": "Search feedback:",
                    "zeroRecords": "No matching feedback found"
                }
            });
            
            // Mark message as read when viewed
            $('.view-message').on('click', function() {
                var messageId = $(this).data('message-id');
                $.ajax({
                    url: 'mark_as_read.php',
                    type: 'POST',
                    data: {id: messageId},
                    success: function(response) {
                        // Update UI if needed
                    }
                });
            });
        });
    </script>

</body>

</html>
