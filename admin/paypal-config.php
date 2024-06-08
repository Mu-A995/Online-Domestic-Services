<?php include 'header.php'; ?>

<?php

if (isset($_POST['update_paypal_setting'])) {

   $inputBusinessEmail = $_POST['inputBusinessEmail'];
   $inputCancelUrl = $_POST['inputCancelUrl'];
   $inputSuccessUrl = $_POST['inputSuccessUrl'];
   $inputPaypalSandbox = $_POST['inputPaypalSandbox'];

   $statement = $pdo->prepare("UPDATE tbl_paypal_config SET business_email=?, cancel_url=?, success_url=?, sandbox=? WHERE id=?");
   $statement->execute(array($inputBusinessEmail,$inputCancelUrl,$inputSuccessUrl,$inputPaypalSandbox,1)); 

   header('location: paypal-config.php');
   
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
                <div class="card-header"><h5 class="font-weight-light">Paypal Configuration</h5></div>
                <div class="card-body">

                	<?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>

                    <form method="post" action="">
                        <div class="form-group">
                        	<label class="small mb-1" for="inputBusinessEmail">Paypal Business Email</label>
                        	<input class="form-control py-4" name="inputBusinessEmail" id="inputBusinessEmail" value="<?php echo $paypal_statement_results['business_email']; ?>" type="text" placeholder="Paypal Business Email" />
                        </div>
                        
                        <div class="form-group">
                         	<label class="small mb-1" for="inputCancelUrl">Cancel URL</label>
                         	<input class="form-control py-4" name="inputCancelUrl" value="<?php echo $paypal_statement_results['cancel_url']; ?>" id="inputCancelUrl" type="text" placeholder="Cancel URL" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputSuccessUrl">Success URL</label>
                            <input class="form-control py-4" name="inputSuccessUrl" value="<?php echo $paypal_statement_results['success_url']; ?>" id="inputSuccessUrl" type="text" placeholder="Success URL" />
                        </div>
                       
                        <div class="form-group">
                            <label class="radio-inline"><input value="sandbox" type="radio" name="inputPaypalSandbox" <?php if($paypal_statement_results['sandbox'] == 'sandbox'){echo 'checked';}?>> Sandbox </label>
                            <label class="radio-inline"><input value="live" type="radio" name="inputPaypalSandbox" <?php if($paypal_statement_results['sandbox'] == 'live'){echo 'checked';}?>> Live Payment</label>
                        </div>
                        
                        <div class="form-group mt-4 mb-0">
                            <input class="btn btn-primary " value="Update" type="submit" name="update_paypal_setting">
                        </div>
                    </form>
                </div>
                
            </div>

        </div>
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mb-4">
                <div class="card-header"><h5 class="font-weight-light">Note</h5></div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>