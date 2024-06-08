<?php

include 'autoloader.php';
if (isset($_SESSION['provider'])) {
	header('location: dashboard.php');
}

if (isset($_POST['forget_password_form'])) {
	
    // filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$email = $_POST['inputEmailAddress'];
	
	$statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=?');
	$statement->execute(array($email));
	$count = $statement->rowCount();
	$result = $statement->fetch();

    if (empty($email)) {

        $alert_msg = "Email address is missing.";

    }elseif ($smtp_statement_results['smtp_status'] == 'active') {
        
        if ($count > 0) {

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
                    $mail = new PHPMailer(); 
                    $mail->IsSMTP();       // send via SMTP
                    $mail->Host = $smtp_statement_results['smtp_secure']."://".$smtp_statement_results['smtp_host'];
                    $mail->SMTPAuth = true;    // turn on SMTP authentication
                    $mail->Username = $smtp_statement_results['smtp_username']; // SMTP username
                    $mail->Password = $smtp_statement_results['smtp_password'];               // SMTP password
                    $webmaster_email = $smtp_statement_results['smtp_username']; //Reply to this email ID
                    $email= $inputEmailAddress;  // Recipients email ID
                    $name=$setting_statement_results['site_title']; // Recipient's name
                    $mail->From = $webmaster_email;
                    $mail->Port = $smtp_statement_results['smtp_port'];
                    $mail->FromName = $setting_statement_results['site_title'];
                    $mail->AddAddress($email,$name);
                    $mail->AddReplyTo($webmaster_email,$setting_statement_results['site_title']);
                    $mail->WordWrap = 50; // set word wrap
                    $mail->IsHTML(true);  // send as HTML
                    $mail->Subject = "Signup - ".$setting_statement_results['site_title'];

                    $n_password = rand();
                    // $en_password = md5($n_password);

                    // Web URL Generate
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                        $url = "https://"; 
                        } else {
                        $url = "http://";  
                        } 

                        // Append the host(domain name, ip) to the URL.   
                        $url.= $_SERVER['HTTP_HOST'];   
                        
                        // Append the requested resource location to the URL   
                        // $url.= $_SERVER['REQUEST_URI'];    
                          // 
                        // echo $url;

                    // Web URL Generate
                    
                    $mail->Body = "Hi,<br>
                    You have successfully signup. You can login via below web link:<br>".$url.'/login.php<br>You Password is:'.$n_password;                      //HTML Body 
                    $mail->AltBody = "This is the body when user views in plain text format"; //Text Body 

                    if(!$mail->Send())
                    {
                    // echo "Mailer Error: " . $mail->ErrorInfo;
                        $alert_msg = "Mailer Error: SMTP connect() failed.";
                    }
                    else
                    {
                    // echo "Message has been sent";

                        $statement = $pdo->prepare("UPDATE tbl_users SET forget_token=? WHERE email=?");
                        $statement->execute(array($n_password,$result['email']));
                        
                        // header('location: my_profile_update.php');
                        $alert_msg = "Sent password forget link on your email address.";
                    }
                }
            } else {
                // echo "not active";
                $mail = new PHPMailer(); 
                $mail->IsSMTP();                              // send via SMTP
                $mail->Host = $smtp_statement_results['smtp_secure']."://".$smtp_statement_results['smtp_host'];
                $mail->SMTPAuth = true;                       // turn on SMTP authentication
                $mail->Username = $smtp_statement_results['smtp_username'];        // SMTP username
                $mail->Password = $smtp_statement_results['smtp_password'];               // SMTP password
                $webmaster_email = $smtp_statement_results['smtp_username'];       //Reply to this email ID
                $email= $result['email'];                // Recipients email ID
                $name=$setting_statement_results['site_title'];                              // Recipient's name
                $mail->From = $webmaster_email;
                $mail->Port = $smtp_statement_results['smtp_port'];
                $mail->FromName = $setting_statement_results['site_title'];
                $mail->AddAddress($email,$name);
                $mail->AddReplyTo($webmaster_email,$setting_statement_results['site_title']);
                $mail->WordWrap = 50;                         // set word wrap
                $mail->IsHTML(true);                          // send as HTML
                $mail->Subject = "Forget Password - ".$setting_statement_results['site_title'];

                $n_password = rand();
                // $en_password = md5($n_password);

                // Web URL Generate
                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                    $url = "https://"; 
                    } else {
                    $url = "http://";  
                    } 

                    // Append the host(domain name, ip) to the URL.   
                    $url.= $_SERVER['HTTP_HOST'];   
                    
                    // Append the requested resource location to the URL   
                    // $url.= $_SERVER['REQUEST_URI'];    
                      // 
                    // echo $url;

                // Web URL Generate
                
                $mail->Body = "Hi,
             Click this link to update your password:".$url.'/provider/validate.php?token_validation='.$n_password;                      //HTML Body 
                $mail->AltBody = "This is the body when user views in plain text format"; //Text Body 

                if(!$mail->Send())
                {
                // echo "Mailer Error: " . $mail->ErrorInfo;
                    $alert_msg = "Mailer Error: SMTP connect() failed.";
                }
                else
                {
                // echo "Message has been sent";

                    $statement = $pdo->prepare("UPDATE tbl_users SET forget_token=? WHERE email=?");
                    $statement->execute(array($n_password,$result['email']));
                    
                    // header('location: my_profile_update.php');
                    $alert_msg = "Sent password forget link on your email address.";
                }
            }
            // recaptcha

            
            
        } else {
            $alert_msg = "This email is not associated with any account.";
        }
    } else {
        $alert_msg = "Opps ! SMTP service is not active.";
    }

	
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
        <title>provider Panel - <?php echo $setting_statement_results['site_title']; ?></title>
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
                                        <h3 class="text-center font-weight-light mt-4">FORGET PASSWORD</h3>
                                        <p class="text-center">Hello there, here you can rest you password</p>
                                    </div>
                                    <div class="card-body">

                                        
                                        <?php
                                            if (!empty($alert_msg)) {
                                                echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                                            }
                                        ?>
                                        
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" name="inputEmailAddress" placeholder="Enter email address" />
                                                <div class="small mb-3 mt-2 text-danger">We will send you a link to reset your password.</div>
                                            </div>
                                            <?php if ($setting_statement_results['g_recaptcha_status'] == "active") { ?>
                                                <div class="form-group">
                                                    <div class="g-recaptcha" data-sitekey="<?php echo $setting_statement_results['g_recaptcha_site_key'];?>"></div>
                                                </div>
                                            <?php }
                                            ?>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="login.php">Return to login</a>
                                                <!-- <a class="btn btn-primary" href="login.html">Reset Password</a> -->

                                                <input class="btn btn-primary" type="submit" name="forget_password_form" value="Reset Password">

                                            </div>
                                        </form>
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

