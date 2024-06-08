<?php include 'header.php'; ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['u_id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_users WHERE id=?");
    $statement->execute(array($_REQUEST['u_id']));
    $total = $statement->rowCount();
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

if (isset($_REQUEST['u_id'])) {
    $u_r_id = $_REQUEST['u_id'];

    $u_r_statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id =?');
    $u_r_statement->execute(array($u_r_id));
    $u_r_statement_result = $u_r_statement->fetch();
}

// Update Profile STart

$alert_msg = '';
$alert_msg_upload = '';

if (isset($_POST['form_profile_update'])) {

    $u_id = $_POST['u_id'];

    $up_fullname = $_POST['u_fullname'];
    $up_email = $_POST['u_email'];
    $up_mobile_no = $_POST['u_mobile_no'];
    $up_gender = $_POST['u_gender'];
    $up_status = $_POST['inputUStatus'];
    $up_role = $_POST['inputURole'];

    $statements = $pdo->prepare('SELECT * FROM tbl_users WHERE id =?');
    $statements->execute(array($u_id));
    $counts = $statements->rowCount();
    $results = $statements->fetch();

    if (empty($up_fullname)) {
         $alert_msg = "Name is missing";
    } elseif (empty($up_email)) {
        $alert_msg = "Emal is missing";
    } elseif (empty($up_mobile_no)) {
        $alert_msg = "Mobile is missing";
    } elseif (empty($up_gender)) {
        $alert_msg = "Select gender.";
    } else {
       
        $statements = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? AND email != ?');
        $statements->execute(array($up_email,$results['email']));
        $countss = $statements->rowCount();
        
        if ($countss > 0) {
           $alert_msg = "this email already used.";
        } else {
            $statement = $pdo->prepare("UPDATE tbl_users SET fullname=?, email=?, mobile_no=?, gender=?, status=?, role=? WHERE id=?");
            $statement->execute(array($up_fullname,$up_email,$up_mobile_no,$up_gender,$up_status,$up_role,$u_id));

            $alert_msg = "Updated.";
                
            header('location: users.php');
        }
              
    }
   
}

// Update Profile End

if(isset($_POST['form_upload_photo'])) {

    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    $u_id = $_POST['u_id'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $alert_msg_upload .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

        if ($path == "") {
            $valid = 0;
            $alert_msg_upload .= 'Please select a image file';
        } else {
            // removing the existing photo
            if($u_r_statement_result['photo']!='') {
                unlink('assets/uploads/'.$u_r_statement_result['photo']);    
            }

            // updating the data
            $final_name = 'admin-'.$u_id.'.'.$ext;
            move_uploaded_file( $path_tmp, 'assets/uploads/'.$final_name );
            $u_r_statement_result['photo'] = $final_name;

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_users SET photo=? WHERE id=?");
            $statement->execute(array($final_name,$u_id));

            $alert_msg_upload = 'User Photo is updated successfully';
            // header('location: my_profile_update.php');
        }
        
    }
}
?>


<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">Edit User Acoount</li>
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
                        <div class="form-group">

                            <input  name="u_id" value="<?php echo $u_r_statement_result['id']; ?>" type="hidden" />

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
                                    <input class="form-control py-4" value="<?php echo $u_r_statement_result['mobile_no']; ?>" name="u_mobile_no" id="inputMobileNo" type="text" placeholder="Mobile No." />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="small mb-1" for="inputGender">Select Gender</label>
                          <select class="form-control" name="u_gender" id="inputGender">
                           

                            <option value="male" <?php if($u_r_statement_result['gender'] == 'male'){echo 'selected';}?>>Male</option>
                            <option value="female" <?php if($u_r_statement_result['gender'] == 'female'){echo 'selected';}?>>Female</option>

                              
                          </select>
                        </div>

                        <div class="form-group">

                            <label class="radio-inline"><input value="active" type="radio" name="inputUStatus" <?php if($u_r_statement_result['status'] == 'active'){echo 'checked';}?>> Active</label>
                             

                            <label class="radio-inline"><input value="banned" type="radio" name="inputUStatus" <?php if($u_r_statement_result['status'] == 'banned'){echo 'checked';}?>> Banned</label>
                            
                        </div>

                        <div class="form-group">
                            <label class="radio-inline"><input value="user" type="radio" name="inputURole" <?php if($u_r_statement_result['role'] == 'user'){echo 'checked';}?>> User</label>
                            <label class="radio-inline"><input value="provider" type="radio" name="inputURole" <?php if($u_r_statement_result['role'] == 'provider'){echo 'checked';}?>> Provider</label>
                        </div>


                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Update Profile" class="btn btn-primary" name="form_profile_update">
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">Update User Profile Photo</h5>
                </div>
                <div class="card-body">
                    <?php
                        if (!empty($alert_msg_upload)) {
                            echo '<div class="alert alert-danger">'.$alert_msg_upload.'</div>'; 
                        }
                    ?>
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <input  name="u_id" value="<?php echo $u_r_statement_result['id']; ?>" type="hidden" />
                        <div class="form-group">
                            <!-- <label >Existing Photo</label> -->
                            <div style="padding-top:6px;">
                                <img src="assets/uploads/<?php echo $u_r_statement_result['photo']; ?>" class="existing-photo" width="140">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label for=""  control-label">New Photo</label> -->
                            <div  style="padding-top:6px;">
                                <input type="file" name="photo">
                            </div>
                        </div>
                        

                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" value="Update Photo" class="btn btn-primary" name="form_upload_photo">
                        </div>
                            
                    </form>
                </div>
                
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>