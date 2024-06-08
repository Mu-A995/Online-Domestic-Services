<?php include 'header.php';?>

<?php

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

// Update Profile STart

$alert_msg = '';
$alert_msg_upload = '';

if (isset($_POST['form_profile_update'])) {

    $inputFullname = $_POST['inputFullname'];
    $inputEmailAddress = $_POST['inputEmailAddress'];
    $inputMobileNo = $_POST['inputMobileNo'];
    $inputGender = $_POST['inputGender'];


    $user_id = $_SESSION['user']['id'];

    $statements = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? AND id !=?');
    $statements->execute(array($inputEmailAddress,$user_id));
    $counts = $statements->rowCount();
    $results = $statements->fetch();

    if (empty($inputFullname)) {
         $alert_msg = "Name is missing";
    } elseif (empty($inputEmailAddress)) {
        $alert_msg = "Email is missing";
    } elseif (empty($inputMobileNo)) {
        $alert_msg = "Mobile is missing";
    } elseif (empty($inputGender)) {
        $alert_msg = "Select gender.";
    } else {
        if ($counts > 0) {

            $alert_msg = "This email is already associated with some account.";
            
        } else {
            
            $statement = $pdo->prepare("UPDATE tbl_users SET fullname=?, email=?, mobile_no=?, gender=? WHERE id=?");
            $statement->execute(array($inputFullname,$inputEmailAddress,$inputMobileNo,$inputGender,$user_id));

            $alert_msg = "Profile Updated Successfully.";
                
            header('location: my_profile.php');
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
            if($_SESSION['user']['photo']!='' OR $_SESSION['user']['photo']!='default.png') {
                unlink('admin/assets/uploads/'.$_SESSION['user']['photo']);    
            }

            // updating the data
            $final_name = 'user-'.$_SESSION['user']['id'].'.'.$ext;
            move_uploaded_file( $path_tmp, 'admin/assets/uploads/'.$final_name );
            $_SESSION['user']['photo'] = $final_name;

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_users SET photo=? WHERE id=?");
            $statement->execute(array($final_name,$_SESSION['user']['id']));

            $alert_msg_upload = 'User Photo is updated successfully';
            // header('location: my_profile_update.php');
        }
        
    }
}

?>
<!-- start page-title -->
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <h2>My Profile </h2>
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
<?php
    if (!empty($alert_msg_upload)) {
        echo '<div class="alert alert-danger text-center">'.$alert_msg_upload.'</div>'; 
    }
?>

<!-- start service-single-section -->
<section class="service-single-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                <div class="blog-sidebar">
                    <div class="widget about-widget">
                        <div class="img-holder">
                        <img width="100" src="admin/assets/uploads/<?php echo $_SESSION['user']['photo']; ?>" alt="">
                        </div>
                        <h3><?php echo $user_result['fullname']; ?></h3>
                        <p>Account Type: <span class="badge bg-primary"><?php echo $user_result['role']; ?></span></p>
                        <p>Account Created: <?php echo $user_result['created_at']; ?></p>
                        
                    </div>        
                </div>
            </div>
            <div class="col col-md-8 ">
                <div class="service-single-content">
                    
                    
                    <div class="service-single-tab">
                        <ul class="nav">
                            <li class="active">
                                <a href="#myProfile" data-toggle="tab">Profile Update</a>
                            </li>
                            <li>
                                <a href="#bookings" data-toggle="tab">My Bookings</a>
                            </li>
                            <li>
                                <a href="#profile_photo" data-toggle="tab">Profile Photo</a>
                            </li>
                        </ul>

                        <div class="tab-content ">
                            <div class="tab-pane fade in active" id="myProfile">
                                <form method="post" action="">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFullname">Full Name</label>
                                                <input class="form-control input-lg py-4" id="inputFullname" value="<?php echo $user_result['fullname']; ?>" type="text" name="inputFullname" placeholder="Full Name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <input class="form-control input-lg py-4" id="inputEmailAddress" value="<?php echo $user_result['email']; ?>" type="email" name="inputEmailAddress" placeholder="Enter Email Address" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputMobileNo">Mobile No.</label>
                                                <input class="form-control input-lg py-4" id="inputMobileNo" type="text" value="<?php echo $user_result['mobile_no']; ?>" name="inputMobileNo" placeholder="Enter Mobile No." />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputGender">Gender</label>
                                                <select class="form-control" name="inputGender" id="inputGender">
                                                    <option value="male" <?php if($user_result['gender'] == 'male'){echo 'selected';}?>>Male</option>
                                                    <option value="female" <?php if($user_result['gender'] == 'female'){echo 'selected';}?>>Female</option>
                                              </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <input type="submit" class="theme-btn submit-btn" name="form_profile_update" value="Update Profile">
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="bookings">
                                <p>Bookings</p>
                                <div class="table-responsive">
                                   <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>item_number</th> -->
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Service Id</th>
                            <th>Customer ID</th>
                             <th>Customer Address</th>
                              <th>Time</th>
                               <th>Date</th>
                                <th>Payment Method</th>
                            <th>Status</th>
                            <th>User Email</th>
                            <th>Created at</th>
                    
                            
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        

                         <?php
                                            $statement = $pdo->prepare('SELECT * FROM tbl_payment WHERE user_id = ? ORDER BY id DESC');
                                            $statement->execute(array($_SESSION['user']['id']));
                                            $result = $statement->fetchAll();
                                            $i = 0;
                                            foreach ($result as $key) { 
                                            $i++;
                                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $key['item_name'];?></td>
                            <!-- <td><?php echo $key['payment_amount'];?></td> -->
                            <td>
                                <?php 

                                $basicpricedollar = $key['payment_amount'];
                                $dollar_rate = $setting_statement_results['dollar_exchange_rate']; // Your price in USD

                               
                                $pkr_price = round(($basicpricedollar * $dollar_rate), 2);
                                echo $pkr_price;
                                 ?> PKR 

                                    <br>(<?php echo $key['payment_amount'];?> USD)
                            </td>
                            <td><?php echo $key['item_number'];?></td>
                          
                            <td>

                                <?php
                                $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id = ?');
                                $statement->execute(array($key['user_id']));
                                $result = $statement->fetch();
                                echo $result['id'];
                               
                               ?>
                            </td>
                            <td><?php echo $key['address'];?></td>
                              <td><?php echo $key['inputTime'];?></td>
                                <td><?php echo $key['inputDate'];?></td>
                                  <td><?php echo $key['inputPaymentMethod'];?></td>
                            <td><?php echo $key['payment_status'];?></td>
                            <td>

                                <?php
                                $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id = ?');
                                $statement->execute(array($key['user_id']));
                                $result = $statement->fetch();
                                echo $result['email'];
                                ?>
                            </td>

                            <td><?php echo $key['created_at'];?></td>
                            

                            
                            
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                                
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile_photo">
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                    
                                    <div class="form-group">
                                        <label>Select New Photo</label>
                                        <div  style="padding-top:6px;">
                                            <input type="file" name="photo">
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-5 mb-0">

                                        <input type="submit" class="theme-btn submit-btn" name="form_upload_photo" value="Update Photo">
                                        
                                    </div>
                                        
                                </form>
                            </div>
                            
                        </div>      
                    </div>
                    
                                               
                </div>
            </div>
            
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end service-single-section -->


<?php include 'footer.php'; ?>
