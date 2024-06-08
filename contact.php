<?php include 'header.php';?>

<?php

if (isset($_POST['form_contact'])) {
    
    $inputEmailName = $_POST['inputEmailName'];
    $inputEmailAddress = $_POST['inputEmailAddress'];
    $inputPhone = $_POST['inputPhone'];
    $inputSubject = $_POST['inputSubject'];
    $inputNote = $_POST['inputNote'];
    $created_at = date("d/m/Y");

    if (empty($inputEmailName)) {
        $alert_msg = "Name Field is missing.";
    } elseif (empty($inputEmailAddress)) {
        $alert_msg = "Email Address is missing.";
    } elseif (empty($inputPhone)) {
        $alert_msg = "Phone No. Field is missing.";
    } elseif (empty($inputSubject)) {
        $alert_msg = "Subject Field is missing.";
    } elseif (empty($inputNote)) {
        $alert_msg = "Message Field is missing.";
    } else {

        $statement = $pdo->prepare('INSERT INTO tbl_feedback(c_name,c_email,c_phone,c_feedback,c_message,created_at) VALUES(?,?,?,?,?,?)');
        $statement->execute(array($inputEmailName,$inputEmailAddress,$inputPhone,$inputSubject,$inputNote,$created_at));
        $alert_msg = "Successfully Sent.";
    }

        
    
}  

?>


<!-- start page-title -->
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <h2>Contact us</h2>
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
<section class="contact-section contact-section-s2 section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="section-title">
                    <span>Contact</span>
                    <h2>Love to Hear From You!</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-8 col-lg-offset-2">
                <div class="content-area">
                    <p>Your comments / feedbacks are more valueavle for us.</p>
                    <div class="contact-form">
                        <form method="post" action="">
                            <div>
                                <input type="text" class="form-control" name="inputEmailName" placeholder="Name*">
                            </div>
                            <div>
                                <input type="email" class="form-control" name="inputEmailAddress" placeholder="Email*">
                            </div>
                            <div>
                                <input type="text" class="form-control" name="inputPhone" placeholder="Phone*">
                            </div>
                            <div>
                                <select name="inputSubject" class="form-control">
                                    
                                    <option value="Feedback">Feedback</option>
                                    <option value="Bug Report">Bug Report</option>
                                    <option value="Others">Others</option>
                                    
                                </select>
                            </div>
                            <div class="fullwidth">
                                <textarea class="form-control" name="inputNote" placeholder="Case Description..."></textarea>
                            </div>
                            <?php if ($setting_statement_results['g_recaptcha_status'] == "active") { ?>
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="<?php echo $setting_statement_results['g_recaptcha_site_key'];?>"></div>
                                </div>
                            <?php }
                            ?>
                            <div class="submit-area">
                                <!-- <a href="#" class="theme-btn">Get the service</a> -->
                                <input class="theme-btn" type="submit" value="Send Message" name="form_contact">
                            </div>
                            
                        </form>
                    </div>                            
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
<!-- end contact-section -->

<?php include 'footer.php'; ?>