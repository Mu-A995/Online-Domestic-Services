<?php include 'header.php'; ?>

<?php

if (isset($_POST['update_general_setting'])) {

   $inputSiteTitle = $_POST['inputSiteTitle'];
   $inputSiteFooter = $_POST['inputSiteFooter'];
   $inputMobileNo = $_POST['inputMobileNo'];
   $inputEmailAddress = $_POST['inputEmailAddress'];
   $inputSiteLocAddress = $_POST['inputSiteLocAddress'];
   $inputWebCurrecny = $_POST['inputWebCurrecny'];
   $inputDollarExchange = $_POST['inputDollarExchange'];


   $statement = $pdo->prepare("UPDATE tbl_settings SET site_title=?, site_footer=?, web_phone=?, web_email=?, web_address_location=?, web_currency=?, dollar_exchange_rate = ? WHERE id=?");
   $statement->execute(array($inputSiteTitle,$inputSiteFooter,$inputMobileNo,$inputEmailAddress,$inputSiteLocAddress,$inputWebCurrecny,$inputDollarExchange,1)); 

   header('location: settings.php');
   
}

if (isset($_POST['update_smtp_setting'])) {

   $inputSMTPHost = $_POST['inputSMTPHost'];
   $inputSMTPUsername = $_POST['inputSMTPUsername'];
   $inputSMTPPassword = $_POST['inputSMTPPassword'];
   $inputSMTPPort = $_POST['inputSMTPPort'];
   $inputSMTPSecure = $_POST['inputSMTPSecure'];
   $inputSMTPStatus = $_POST['inputSMTPStatus'];

   $statement = $pdo->prepare("UPDATE tbl_smtp SET smtp_host=?, smtp_username=?, smtp_password=?, smtp_port=?, smtp_secure=?, smtp_status=? WHERE id=?");
   $statement->execute(array($inputSMTPHost,$inputSMTPUsername,$inputSMTPPassword,$inputSMTPPort,$inputSMTPSecure,$inputSMTPStatus,1)); 

   header('location: settings.php');
   
}

if(isset($_POST['form_upload_logo'])) {

    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        // if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
        if($ext!='png') {

            $valid = 0;
            // $alert_msg_upload .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            $alert_msg_upload .= 'You must have to upload png file<br>';

        }
    }

    if($valid == 1) {

        if ($path == "") {
            $valid = 0;
            $alert_msg_upload .= 'Please select a png file.';
        } else {
            // removing the existing photo
            
            if (file_exists($file_name)) {
                unlink($file_name);
                // echo 'File '.$file_name.' has been deleted.';
            }
            
            // updating the data
            $final_name = 'logo'.'.'.$ext;
            move_uploaded_file( $path_tmp, 'assets/logo/'.$final_name );
            
            // updating the database
            // $statement = $pdo->prepare("UPDATE tbl_users SET photo=? WHERE id=?");
            // $statement->execute(array($final_name,$_SESSION['admin']['id']));

            $alert_msg_upload = 'Logo is updated successfully';
            // header('location: my_profile_update.php');
        }
        
    }
}

if (isset($_POST['update_g_recaptcha_setting'])) {

   $inputGCSiteKey = $_POST['inputGCSiteKey'];
   $inputGCSecrtKey = $_POST['inputGCSecrtKey'];
   $inputGCStatus = $_POST['inputGCStatus'];

   $statement = $pdo->prepare("UPDATE tbl_settings SET g_recaptcha_site_key=?, g_recaptcha_secret_key=?, g_recaptcha_status=? WHERE id=?");
   $statement->execute(array($inputGCSiteKey,$inputGCSecrtKey,$inputGCStatus,1)); 

   header('location: settings.php');
   
}

?>
<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Settings</li>
    </ol>

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mb-4">
                <div class="card-header"><h5 class="font-weight-light">General Settings</h5></div>
                <div class="card-body">

                	<?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>

                    <form method="post" action="">
                        <div class="form-group">
                        	<label class="small mb-1" for="inputSiteTitle">Site Title</label>
                        	<input class="form-control py-4" name="inputSiteTitle" id="inputSiteTitle" value="<?php echo $setting_statement_results['site_title']; ?>" type="text" placeholder="Site Title" />
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                	<label class="small mb-1" for="inputEmailAddress">Email address</label>
                                	<input class="form-control py-4" value="<?php echo $setting_statement_results['web_email']; ?>" id="inputEmailAddress" name="inputEmailAddress" type="text" placeholder="Email Address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                	<label class="small mb-1" for="inputMobileNo">Mobile No.</label>
                                	<input class="form-control py-4" name="inputMobileNo" value="<?php echo $setting_statement_results['web_phone']; ?>" id="inputMobileNo" type="text" placeholder="Enter Mobile No." />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                         	<label class="small mb-1" for="inputSiteLocAddress">Site Location Address</label>
                         	<input class="form-control py-4" name="inputSiteLocAddress" value="<?php echo $setting_statement_results['web_address_location']; ?>" id="inputSiteLocAddress" type="text" placeholder="Site Footer Note" />
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputWebCurrecny">Web Currency</label>
                                    <input class="form-control py-4" name="inputWebCurrecny" value="<?php echo $setting_statement_results['web_currency']; ?>" id="inputWebCurrecny" type="text" placeholder="Web Currency i.e: PKR" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputDollarExchange">1 Dollar = ? PKR</label>
                                    <input class="form-control py-4" name="inputDollarExchange" value="<?php echo $setting_statement_results['dollar_exchange_rate']; ?>" id="inputDollarExchange" type="text" placeholder="170" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                         	<label class="small mb-1" for="inputSiteFooter">Site Footer</label>
                         	<input class="form-control py-4" name="inputSiteFooter" value="<?php echo $setting_statement_results['site_footer']; ?>" id="inputSiteFooter" type="text" placeholder="Site Footer Note" />
                        </div>

                        
                        <div class="form-group mt-4 mb-0">
                            <input class="btn btn-primary " value="Update" type="submit" name="update_general_setting">
                        </div>
                    </form>
                </div>
                
            </div>

            <div class="card shadow-lg border-0 rounded-lg mb-4">
                <div class="card-header">
                    <h5 class="font-weight-light">Google Recaptcha Settings</h5></div>
                <div class="card-body">

                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>

                    <form method="post" action="">
                        <div class="form-group">

                            <label class="radio-inline"><input value="active" type="radio" name="inputGCStatus" <?php if($setting_statement_results['g_recaptcha_status'] == 'active'){echo 'checked';}?>> Active</label>
                            <label class="radio-inline"><input value="inactive" type="radio" name="inputGCStatus" <?php if($setting_statement_results['g_recaptcha_status'] == 'inactive'){echo 'checked';}?>> Inactive</label>
                            
                        </div>
                        <p class="alert alert-danger">
                            <small>In case of Google Recaptcha "Inactive" service will not work.</small>
                        </p>
                        <div class="form-group">
                            <label class="small mb-1" for="inputGCSiteKey">Site Key</label>
                            <input class="form-control py-4" name="inputGCSiteKey" id="inputGCSiteKey" value="<?php echo $setting_statement_results['g_recaptcha_site_key']; ?>" type="text" placeholder="Site Key" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputGCSecrtKey">Secret Key</label>
                            <input class="form-control py-4" name="inputGCSecrtKey" value="<?php echo $setting_statement_results['g_recaptcha_secret_key']; ?>" id="inputGCSecrtKey" type="text" placeholder="Secret Key" />
                        </div>
                        
                        <div class="form-group mt-4 mb-0">
                            <input class="btn btn-primary" value="Update" type="submit" name="update_g_recaptcha_setting">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mb-4">
                <div class="card-header">
                    <h5 class="font-weight-light">Website Logo</h5>
                </div>
                <div class="card-body">
                    <?php
                        if (!empty($alert_msg_upload)) {
                            echo '<div class="alert alert-danger">'.$alert_msg_upload.'</div>'; 
                        }
                    ?>
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!-- <label >Existing Photo</label> -->
                            <div style="padding-top:6px;">
                                <img src="assets/logo/logo.png" class="existing-photo" width="140">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label for=""  control-label">New Photo</label> -->
                            <div  style="padding-top:6px;">
                                <input type="file" name="photo">
                            </div>
                        </div>
                        

                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" value="Update Logo" class="btn btn-primary" name="form_upload_logo">
                        </div>
                            
                    </form>
                </div>
                
            </div>

            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header"><h5 class="font-weight-light">SMTP Configuration</h5></div>
                <div class="card-body">
                    <form method="post" action="">
                        
                        <div class="form-group">
                            <label class="radio-inline"><input value="active" type="radio" name="inputSMTPStatus" <?php if($smtp_statement_results['smtp_status'] == 'active'){echo 'checked';}?>> Active</label>
                            <label class="radio-inline"><input value="inactive" type="radio" name="inputSMTPStatus" <?php if($smtp_statement_results['smtp_status'] == 'inactive'){echo 'checked';}?>> Inactive</label>

                          
                        </div>
                        <p class="alert alert-danger">
	                        <small>In case of SMTP "Inactive" FORGET PASSWORD, CONTACT US and SIGNUP form will not work.</small>
	                    </p>
                        
                        <div class="form-row">
                            <div class="col-md-8">
                                <div class="form-group">
		                        	<label class="small mb-1" for="inputSMTPHost">SMTP Host</label>
		                        	<input class="form-control py-4" id="inputSMTPHost" name="inputSMTPHost" type="text" value="<?php echo $smtp_statement_results['smtp_host'];?>" placeholder="SMTP Host i.e: smtp.gmail.com" />
		                        </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                	<label class="small mb-1" for="inputSMTPSecure">SMTP Secure</label>
                                	<input class="form-control py-4" name="inputSMTPSecure" value="<?php echo $smtp_statement_results['smtp_secure']; ?>" id="inputSMTPSecure" type="text" placeholder="TLS/SSL" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label class="small mb-1" for="inputSMTPUsername">SMTP Username</label>
                                	<input class="form-control py-4" name="inputSMTPUsername" id="inputSMTPUsername" type="text" value="<?php echo $smtp_statement_results['smtp_username'];?>" placeholder="SMTP Username" />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                	<label class="small mb-1" for="inputSMTPPassword">SMTP Password</label>
                                	<input class="form-control py-4" name="inputSMTPPassword" id="inputSMTPPassword" value="<?php echo $smtp_statement_results['smtp_password'];?>" type="password" placeholder="SMTP password" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputSMTPPort">SMTP Port</label>
                                    <input class="form-control py-4" name="inputSMTPPort" id="inputSMTPPort" type="text" value="<?php echo $smtp_statement_results['smtp_port'];?>" placeholder="SMTP Port i.e: 465" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2 mb-0">
                        	<input class="btn btn-primary " value="Update" type="submit" name="update_smtp_setting">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php' ?>