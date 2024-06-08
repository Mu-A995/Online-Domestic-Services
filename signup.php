<?php include 'autoloader.php';

if (isset($_SESSION['user'])) {
    header('location: index.php');
}
?>

<?php

if (isset($_POST['signup_form'])) {
    
    // filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $inputFullName = $_POST['inputFullName'];
    $inputEmailAddress = $_POST['inputEmailAddress'];
    $inputPhoneNo = $_POST['inputPhoneNo'];
    $inputPassword = $_POST['inputPassword'];
    
    $en_password = md5($inputPassword);

    $created_at = date("d/m/Y");

    if (empty($inputFullName)) {
        $alert_msg = "Full Name is missing";
    } elseif (empty($inputEmailAddress)) {
        $alert_msg = "Email Address is missing";
    } elseif (empty($inputPhoneNo)) {
        $alert_msg = "Phone No. is missing.";
    } elseif (empty($inputPassword)) {
        $alert_msg = "Password is missing.";
    } else {

        $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=?');
        $statement->execute(array($inputEmailAddress));
        $count = $statement->rowCount();
        $result = $statement->fetch();

        if ($count > 0) {
            $alert_msg = "Already registerd account an account associated with this email address.";
        } else {

            // echo "Message has been sent";

                $statement = $pdo->prepare('INSERT INTO tbl_users(fullname,email,mobile_no,password,role,photo,created_at,status) VALUES(?,?,?,?,?,?,?,?)');
                $statement->execute(array($inputFullName,$inputEmailAddress,$inputPhoneNo,$en_password,"user","default.png",$created_at,"active"));
                $alert_msg = "Successfully Registered.";
                
                // header('location: my_profile_update.php');
                // $alert_msg = "Sent password forget link on your email address.";
            }

    }
    
}

?>

<?php include 'top_menu.php'; ?>
<!-- start page-title -->
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <h2>Signup</h2>
                <h4>Create new account from here...</h4>

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
                                    <label class="small mb-1" for="inputFullName">Your Full Name</label>
                                    <input class="form-control input-lg py-4" id="inputFullName" type="text" name="inputFullName" placeholder="Enter Full Name" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                    <input class="form-control input-lg py-4" id="inputEmailAddress" type="text" name="inputEmailAddress" placeholder="Enter email address" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input class="form-control input-lg py-4" id="inputPassword" type="password" name="inputPassword" placeholder="Enter Password" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPhoneNo">Phone No.</label>
                                    <input class="form-control input-lg py-4" id="inputPhoneNo" type="text" name="inputPhoneNo" placeholder="Enter Phone No." />
                                </div>
                                
                                
                                
                                <?php if ($setting_statement_results['g_recaptcha_status'] == "active") { ?>
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="<?php echo $setting_statement_results['g_recaptcha_site_key'];?>"></div>
                                    </div>
                                <?php }
                                ?>
                                
                                
                                <div>
                                    <input type="submit" class="theme-btn submit-btn" name="signup_form" value="Signup">

                                    <a href="login.php">Login here...</a>
                                    
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