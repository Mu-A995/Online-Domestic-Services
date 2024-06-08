<?php include 'header.php'; ?>
<?php

// Update Profile STart

$alert_msg = '';
$alert_msg_upload = '';

if (isset($_POST['form_profile_update'])) {

    $up_fullname = $_POST['u_fullname'];
    $up_email = $_POST['u_email'];
    $up_mobile_no = $_POST['u_mobile_no'];
    $up_gender = $_POST['u_gender'];


    $user_id = $_SESSION['admin']['id'];

    $statements = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? AND id !=?');
    $statements->execute(array($up_email,$user_id));
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
        if ($counts > 0) {

            $alert_msg = "This email is already associated with some account.";
            
        } else {
            
            $statement = $pdo->prepare("UPDATE tbl_users SET fullname=?, email=?, mobile_no=?, gender=? WHERE id=?");
            $statement->execute(array($up_fullname,$up_email,$up_mobile_no,$up_gender,$user_id));

            $alert_msg = "Updated.";
                
            header('location: my_profile_update.php');
        }
    }

    
   
}

// Update Profile End

if(isset($_POST['form_upload_photo'])) {

    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    

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
            if($_SESSION['admin']['photo']!='') {
                unlink('assets/uploads/'.$_SESSION['admin']['photo']);    
            }

            // updating the data
            $final_name = 'admin-'.$_SESSION['admin']['id'].'.'.$ext;
            move_uploaded_file( $path_tmp, 'assets/uploads/'.$final_name );
            $_SESSION['admin']['photo'] = $final_name;

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_users SET photo=? WHERE id=?");
            $statement->execute(array($final_name,$_SESSION['admin']['id']));

            $alert_msg_upload = 'User Photo is updated successfully';
            // header('location: my_profile_update.php');
        }
        
    }
}
?>


<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">My Profile</li>
    </ol>

    <div class="row ">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">My Account</h5>
                </div>
                <div class="card-body">
                
                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>
                

                    <form method="post" action="">
                        <div class="form-group">
                            <label class="small mb-1" for="inputFullname">Full Name</label>
                            <input class="form-control py-4" id="inputFullname" name="u_fullname" value="<?php echo $user_result['fullname']; ?>" type="text" placeholder="Enter Full Name" />
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                    <input class="form-control py-4" id="inputEmailAddress" value="<?php echo $user_result['email']; ?>" name="u_email" type="email" placeholder="Enter email address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputMobileNo">Mobile No.</label>
                                    <input class="form-control py-4" value="<?php echo $user_result['mobile_no']; ?>" name="u_mobile_no" id="inputMobileNo" type="text" placeholder="Mobile No." />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="small mb-1" for="inputGender">Select Gender</label>
                          <select class="form-control" name="u_gender" id="inputGender">
                           

                            <option value="male" <?php if($user_result['gender'] == 'male'){echo 'selected';}?>>Male</option>
                            <option value="female" <?php if($user_result['gender'] == 'female'){echo 'selected';}?>>Female</option>

                              
                          </select>
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
                    <h5 class="font-weight-light">Update Profile Photo</h5>
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
                                <img src="assets/uploads/<?php echo $_SESSION['admin']['photo']; ?>" class="existing-photo" width="140">
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