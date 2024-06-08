<?php

include 'autoloader.php';

if (!isset($_SESSION['admin'])) {
    header('location: login.php');
    exit();
}


if (isset($_POST['insert_form'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $pdo->prepare('INSERT INTO tbl_users(email,password) VALUES(?,?)');
    $statement->execute(array($email,$password));

}

// Trace user start
$u_id = $_SESSION['admin']['id'];
$statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id=?');
$statement->execute(array($u_id));
// $count = $statement->rowCount();
$user_result = $statement->fetch();

if ($user_result['status'] != $_SESSION['admin']['status']) {
    header('location: logout.php');
    exit();
}
// Trace user end

// Update Password Start
$alert_msg = '';
$alert_msg_upload = '';

if (isset($_POST['form_password_update'])) {

    $up_old_password = $_POST['inputOldPassword'];
    $up_new_password = $_POST['inputPassword'];
    $up_new_confirm_password = $_POST['inputConfirmPassword'];
    
    $user_id = $_SESSION['admin']['id'];

    if (empty($up_old_password)) {
         $alert_msg_pass = "Old Password is missing";
    } elseif (empty($up_new_password)) {
        $alert_msg_pass = "New Password is missing";
    } elseif (empty($up_new_confirm_password)) {
        $alert_msg_pass = "New Confirm Password is missing";
    } elseif ($up_new_password != $up_new_confirm_password) {
        $alert_msg_pass = "New Password & Confirm Password are not matched.";
    } elseif (md5($up_old_password) != $user_result['password']) {
        $alert_msg_pass = "Old password is not matched.";
    } else {
        
        
        $statement = $pdo->prepare("UPDATE tbl_users SET password=? WHERE id=?");
        $statement->execute(array(md5($up_new_password),$user_id));

        $alert_msg_pass = "Updated.";
            
        header('location: logout.php');
        exit();
        
    }

}

// Update Password Start

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard - <?php echo $setting_statement_results['site_title']; ?></title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="js/font-awesome/all.min.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php">
                <img src="assets/logo/logo.png" class="existing-photo" width="100">
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button
            ><!-- Navbar Search-->
            <a href="/" target="_blank" class="btn btn-dark" type="button">
                <i class="fas fa-globe"></i>
            </a>
            <div class=" ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div> -->
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="my_profile_update.php">My Profile</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#myModal" href="#">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage Contents</div>
                            <!-- <a class="nav-link" href="services.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                All Services
                            </a> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices" aria-expanded="false" aria-controls="collapseServices">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                    Manage Services
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div
                            ></a>
                            <div class="collapse" id="collapseServices" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="services.php">All Services</a>
                                    <a class="nav-link" href="add_new_service.php">Add New Service</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-list"></i>
                                </div>
                                    Categories
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="categories.php">All Categories</a>
                                    <a class="nav-link" href="add_new_category.php">Add New Category</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFaqs" aria-expanded="false" aria-controls="collapseFaqs">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                    FAQs
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div
                            ></a>
                            <div class="collapse" id="collapseFaqs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="faqs.php">All FAQs</a>
                                    <a class="nav-link" href="add_new_faq.php">Add New FAQ</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                    Pages
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div
                            ></a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#">Terms & Condtiond</a>
                                    <a class="nav-link" href="#">Privacy Policy</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Orders & Settings</div>
                            <a class="nav-link" href="bookings.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                Bookings</a>
                            <a class="nav-link" href="users.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                Manage Users</a>
                             <a class="nav-link" href="subscribers.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                Manage Subscribers</a>
                                

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="false" aria-controls="collapseSetting"
                                ><div class="sb-nav-link-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                Settings
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                    </div
                            ></a>
                            <div class="collapse" id="collapseSetting" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="settings.php">General Setting</a>
                                    <a class="nav-link" href="settings.php">SMTP Setting</a>
                                    <a class="nav-link" href="paypal-config.php">Paypal Configuration</a>

                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $user_result['fullname']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <main>