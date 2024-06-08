<?php include 'autoloader.php';


if (!isset($_SESSION['user'])) {
    header('location: signup.php');
}
?>

<?php

// Insert New Category Start

$alert_msg = '';

if(isset($_POST['form_service_insert'])) {

    $valid = 1;

    $inputName = $_POST['inputName'];
    $inputEmail = $_POST['inputEmail'];
    $inputPhone = $_POST['inputPhone'];
    $inputAddress = $_POST['inputAddress'];
    $inputPrice = $_POST['inputPrice'];
    $inputServiceCategory = $_POST['inputServiceCategory'];
    $inputGender = $_POST['inputGender'];
    $user_id = $_SESSION['user']['id'];
    

    $created_at = date("d/m/Y");

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='pdf' ) {
        // if($ext!='png') {

            $valid = 0;
            $alert_msg .= 'You must have to upload jpg, jpeg or png file<br>';
            // $alert_msg .= 'You must have to upload png file<br>';

        }
    }

    if($valid == 1) {

        if ($path == "") {
            $valid = 0;
            $alert_msg .= 'Please select an image file.';
        } else {
            // removing the existing photo
            
            // if (file_exists($file_name)) {
            //     unlink($file_name);
            // }
            
            // getting auto increment id for photo renaming
            $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_services'");
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row) {
                $ai_id=$row[10];
            }

            // updating the data
            $final_name = 'service-'.$ai_id.'.'.$ext;
            move_uploaded_file( $path_tmp, 'admin/assets/resume/'.$final_name );

            $statements = $pdo->prepare('SELECT * FROM tbl_requests WHERE email =?');
            $statements->execute(array($inputEmail));
            $counts = $statements->rowCount();
            // $results = $statements->fetch();
 
            if (empty($inputName)) {
                 $alert_msg = "inputName title is missing";
            } elseif (empty($inputEmail)) {
                $alert_msg = "Email is missing";
            } elseif (empty($inputPhone)) {
                $alert_msg = "inputPhone Overview is missing";
            } elseif (empty($inputAddress)) {
                $alert_msg = "inputAddress Package detail is missing";
            } elseif (empty($inputPrice)) {
                $alert_msg = "inputPrice price is missing";
            } elseif (empty($inputGender)) {
                $alert_msg = "inputGender status is missing";
            } elseif (empty($inputServiceCategory)) {
                $alert_msg = "inputServiceCategory Category is missing";
            } else {

                if ($counts > 0) {
                    $alert_msg = "Email is already exist.";
                } else {

                    $statement = $pdo->prepare("INSERT INTO tbl_requests (user_id,fullname,email,phone,address,price,resume,gender,category,role,status,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
                    $statement->execute(array($user_id,$inputName,$inputEmail,$inputPhone,$inputAddress,$inputPrice,$final_name,$inputGender,$inputServiceCategory,'user','pending',$created_at));

                    $alert_msg = "Inserted.";
                        
                    header('location: my_profile.php');

                }
                      
            }
            
        }
        
    }
}

// Insert New Category End

?>

 

<?php include 'top_menu.php'; ?>
<!-- start page-title -->
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <h2>Become a Provider</h2>
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

                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="small mb-1" for="inputName">Full Name</label>
                            <input class="form-control py-4" id="inputName" name="inputName"  type="text" placeholder="Enter Your Name.." />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputEmail">Email</label>
                            <input class="form-control py-4" id="inputEmail" name="inputEmail"  type="email" placeholder="Enter Email.." />
                        </div>

                        <div class="form-group">
                            <label class="small mb-1" for="inputPhone">Phone Number (+92)</label>
                            <input class="form-control py-4" id="inputPhone" name="inputPhone"  type="text" placeholder="Enter Phone Number" />
                        </div>

                        <div class="form-group">
                            <label class="small mb-1" for="inputAddress">Address</label>
                            <input class="form-control py-4" id="inputAddress"  name="inputAddress" type="text" placeholder="Enter Complete Address" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputPrice">Service Price (Hourly)</label>
                            <input class="form-control py-4" id="inputPrice"  name="inputPrice" type="number" placeholder="Enter Service Price" />
                        </div>

                        <div class="form-group">
                          <label class="small mb-1" for="inputServiceCategory">Select Category</label>
                          <select class="form-control" name="inputServiceCategory" id="inputServiceCategory">
                            <?php
                            $statements = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_status =?');
                            $statements->execute(array('active'));
                            $counts = $statements->rowCount();
                            $results = $statements->fetchAll();

                            foreach ($results as $key) { ?>
                               
                            <option value="<?php echo $key['cat_id'];?>"><?php echo $key['cat_name'];?></option>

                            <?php } ?>
                          </select>
                        </div>
                           
                        <div class="form-group">
                            <!-- <label for=""  control-label">New Photo</label> -->
                            <b >Upload Resume</b>
                            <div  style="padding-top:6px;">
                                <input type="file" name="photo">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="radio-inline"><input value="male" checked type="radio" name="inputGender"> Male</label>
                            <label class="radio-inline"><input value="female" type="radio" name="inputGender" > Female</label>
                            
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Submit" class="btn btn-primary" name="form_service_insert">
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