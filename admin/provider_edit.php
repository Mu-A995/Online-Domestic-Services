<?php include 'header.php'; ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['p_id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_provider WHERE provider_id=?");
    $statement->execute(array($_REQUEST['p_id']));
    $total = $statement->rowCount();
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

if (isset($_REQUEST['p_id'])) {
    $u_r_id = $_REQUEST['p_id'];

    $u_r_statement = $pdo->prepare('SELECT * FROM tbl_provider WHERE provider_id =?');
    $u_r_statement->execute(array($u_r_id));
    $u_r_statement_result = $u_r_statement->fetch();
}
 
?>


<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">Edit User Acount</li>
    </ol>

    <div class="row ">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">User Account Info</h5>
                </div>
                <div class="card-body">
                
                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>
                

                    <form method="post" action="">

                        <div class="question-tags">
                                <a href="assets/resume/<?php echo $u_r_statement_result['resume'];?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a> 
                          </div>

                        <div class="form-group">

                            
                            <label class="small mb-1" for="inputFullname">Full Name</label>
                            <input class="form-control py-4" id="inputFullname" name="u_fullname" value="<?php echo $u_r_statement_result['fullname']; ?>" type="text" placeholder="Enter Full Name" />
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                    <input class="form-control py-4" id="inputEmailAddress" value="<?php echo $u_r_statement_result['email']; ?>" name="u_email" type="email" placeholder="Enter email address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputMobileNo">Mobile No.</label>
                                    <input class="form-control py-4" value="<?php echo $u_r_statement_result['phone']; ?>" name="u_mobile_no" id="inputMobileNo" type="text" placeholder="Mobile No." />
                                </div>
                            </div>
                        </div>
                        
                         
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Current Status</label>
                                    <input class="form-control py-4" id="inputEmailAddress" value=" <?php echo $u_r_statement_result['status']; ?>" name="u_email" type="email" placeholder="Enter email address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputMobileNo">Current Role.</label>
                                    <input class="form-control py-4" value=" <?php echo $u_r_statement_result['role']; ?>" name="u_mobile_no" id="inputMobileNo" type="text" placeholder="Mobile No." />
                                </div>
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Gender</label>
                                    <input class="form-control py-4" id="inputEmailAddress" value=" <?php echo $u_r_statement_result['gender']; ?>" name="u_email" type="email" placeholder="Enter email address" />
                                </div>
                            </div>
                            
                        </div>

                       
 
                    </form>
                    
                </div>
                
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>