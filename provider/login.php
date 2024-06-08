<?php

include 'autoloader.php';
if (isset($_SESSION['provider'])) {
	header('location: dashboard.php');
}

if (isset($_POST['submit_form'])) {
	
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
                } elseif ($result['role'] !== 'provider') {
                    $alert_msg = "Your are not permitted to login as provider.";
                } else {
                    $_SESSION['provider'] = $result;
                    header('location: dashboard.php');
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
            } elseif ($result['role'] !== 'provider') {
                $alert_msg = "Your are not permitted to login as provider.";
            } else {
                $_SESSION['provider'] = $result;
                header('location: dashboard.php');
            }
        } else {
            $alert_msg = "Login detail is not correct";
        }
    }
    // recaptcha

	
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Provider Panel - <?php echo $setting_statement_results['site_title']; ?></title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/font-awesome/all.min.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                    	<h3 class="text-center font-weight-light mt-4"><?php echo $setting_statement_results['site_title']; ?> - PROVIDER LOGIN</h3>
                                    	<p class="text-center">Hello there, Sign in and start managing your services & bookings</p>
                                        
                                        
                                    </div>
                                    <div class="card-body">

                                    	<!-- <h1>Login File</h1> -->
                                    	
                                        <?php
                                            if (!empty($alert_msg)) {
                                                echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                                            }
                                        ?>
                                        
                                    	<form method="post" action="">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="username" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                            </div>
                                            <?php if ($setting_statement_results['g_recaptcha_status'] == "active") { ?>
                                                <div class="form-group">
                                                    <div class="g-recaptcha" data-sitekey="<?php echo $setting_statement_results['g_recaptcha_site_key'];?>"></div>
                                                </div>
                                            <?php }
                                            ?>
                                            
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!-- <a class="small" href="forget_password.php">Forgot Password?</a> -->
                                            	<input class="btn btn-primary" type="submit" name="submit_form" value="Login Now">
                                            </div>
                                        </form>

                                    	<!-- <form method="post" action="">
                                    		<label>Username:</label><br>
                                    		<input required="true" type="text" name="username" placeholder="provider"><br>
                                    		<label>Passwprd:</label><br>
                                    		<input type="text" name="password" placeholder="******" required="true"><br><br>
                                    		<input type="submit" name="submit_form" value="Login Now">
                                    		<input type="reset" name="reset" value="Reset">
                                    	</form> -->


                                    </div>
                                    <!-- <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"> <?php echo $setting_statement_results['site_footer']; ?></div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
