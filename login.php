<?php include 'autoloader.php';

if (isset($_SESSION['user'])) {
    header('location: index.php');
}
?>

<?php

if (isset($_POST['login_form'])) {
    
    // filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $username = $_POST['username'];
    $password = $_POST['password'];

    // recaptcha
    if ($setting_statement_results['g_recaptcha_status'] == "active") {

        $response = $_POST['g-recaptcha-response'];
         
        $secret = $setting_statement_results['g_recaptcha_secret_key'];

        $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
        $captcha_success=json_decode($verify);


        if ($captcha_success->success==false) {
         $alert_msg = "Google recaptcha is not verified.";
        }
        else if ($captcha_success->success==true) {
            $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? && password=?');
            $statement->execute(array($username,md5($password)));
            $count = $statement->rowCount();
            $result = $statement->fetch();

            if ($count > 0) {

                if ($result['status'] !== 'active') {
                    $alert_msg = "Your account is ".$result['status'];
                } elseif ($result['role'] !== 'user') {
                    $alert_msg = "Your are not permitted to login as Admin.";
                } else {
                    $_SESSION['user'] = $result;
                    header('location: index.php');
                }
                
                
            } else {
                $alert_msg = "Login detail is not correct";
            }
        }
    } else {
        // echo "not active";
        $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? && password=?');
        $statement->execute(array($username,md5($password)));
        $count = $statement->rowCount();
        $result = $statement->fetch();

        if ($count > 0) {
            
            if ($result['status'] !== 'active') {
                $alert_msg = "Your account is ".$result['status'];
            } elseif ($result['role'] !== 'user') {
                $alert_msg = "Your are not permitted to login as User.";
            } else {
                $_SESSION['user'] = $result;
                header('location: index.php');
            }
        } else {
            $alert_msg = "Login detail is not correct";
        }
    }
    // recaptcha

    
}

?>
<?php


// // Trace user start
// $u_id = $_SESSION['user']['id'];
// $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id=?');
// $statement->execute(array($u_id));
// // $count = $statement->rowCount();
// $user_result = $statement->fetch();

// if ($user_result['status'] != $_SESSION['user']['status']) {
//     header('location: logout.php');
//     exit();
// }
// Trace user end

// Update Password Start
// $alert_msg = '';
// $alert_msg_upload = '';

// if (isset($_POST['form_password_update'])) {

//     $up_old_password = $_POST['inputOldPassword'];
//     $up_new_password = $_POST['inputPassword'];
//     $up_new_confirm_password = $_POST['inputConfirmPassword'];
    
//     $user_id = $_SESSION['user']['id'];

//     if (empty($up_old_password)) {
//          $alert_msg_pass = "Old Password is missing";
//     } elseif (empty($up_new_password)) {
//         $alert_msg_pass = "New Password is missing";
//     } elseif (empty($up_new_confirm_password)) {
//         $alert_msg_pass = "New Confirm Password is missing";
//     } elseif ($up_new_password != $up_new_confirm_password) {
//         $alert_msg_pass = "New Password & Confirm Password are not matched.";
//     } elseif (md5($up_old_password) != $user_result['password']) {
//         $alert_msg_pass = "Old password is not matched.";
//     } else {
        
        
//         $statement = $pdo->prepare("UPDATE tbl_users SET password=? WHERE id=?");
//         $statement->execute(array(md5($up_new_password),$user_id));

//         $alert_msg_pass = "Updated.";
            
//         header('location: logout.php');
//         exit();
        
//     }

// }

// Update Password Start

?>
<?php include 'top_menu.php'; ?>
<!-- start page-title -->
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <h2>Login</h2>
                <h4>Hello Welcome back, Sign in and start enjoying our service.</h4>

            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>        
<!-- end page-title -->
<?php
    if (!empty($alert_msg)) {
        echo '<div class="alert alert-danger text-center">'.$alert_msg.'</div>'; 
    }
?>

<!-- start contact-section -->
<section class=" section-padding">
    <div class="container">
        <!-- <div class="row">
            <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="section-title">
                    <span>Contact</span>
                    <h2>Love to Here From You!</h2>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col col-lg-4 col-lg-offset-4">
                <div class="content-area">
                    <div class="contact-form">
                        
                            
                        <div class="card-body">

                            
                            
                            
                            <form method="post" action="">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                    <input class="form-control input-lg py-4" id="inputEmailAddress" type="text" name="username" placeholder="Enter email address" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input class="form-control input-lg py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                </div>
                                <?php if ($setting_statement_results['g_recaptcha_status'] == "active") { ?>
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="<?php echo $setting_statement_results['g_recaptcha_site_key'];?>"></div>
                                    </div>
                                <?php }
                                ?>
                                
                                
                                <div>
                                    <input type="submit" class="theme-btn submit-btn" name="login_form" value="Login">

                                    <a href="signup.php">Signup here...</a>
                                    
                                </div>
                            </form>


                        </div>
                                    
                        
                    </div>                            
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
<!-- end contact-section -->

<!-- end contact-info-section -->


<?php include 'footer.php'; ?>