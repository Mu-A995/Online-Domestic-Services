<?php include 'header.php'; ?>

<?php

// Insert New Category Start

$alert_msg = '';

if(isset($_POST['form_service_insert'])) {

    $valid = 1;

    $inputServiceTitle = $_POST['inputServiceTitle'];
    $inputServiceOverview = $_POST['inputServiceOverview'];
    $inputServicePackage = $_POST['inputServicePackage'];
    $inputServicePrice = $_POST['inputServicePrice'];
    $inputServiceStatus = $_POST['inputServiceStatus'];
    $inputServiceCategory = $_POST['inputServiceCategory'];
    $user_id = $_SESSION['admin']['id'];

    $created_at = date("d/m/Y");

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' ) {
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
            move_uploaded_file( $path_tmp, 'assets/services/'.$final_name );

            $statements = $pdo->prepare('SELECT * FROM tbl_services WHERE srvc_title =?');
            $statements->execute(array($inputServiceTitle));
            $counts = $statements->rowCount();
            // $results = $statements->fetch();

            if (empty($inputServiceTitle)) {
                 $alert_msg = "Service title is missing";
            } elseif (empty($inputServiceOverview)) {
                $alert_msg = "Service Overview is missing";
            } elseif (empty($inputServicePackage)) {
                $alert_msg = "Service Package detail is missing";
            } elseif (empty($inputServicePrice)) {
                $alert_msg = "Service price is missing";
            } elseif (empty($inputServiceStatus)) {
                $alert_msg = "Service status is missing";
            } elseif (empty($inputServiceCategory)) {
                $alert_msg = "Service Category is missing";
            } else {

                if ($counts > 0) {
                    $alert_msg = "Service Title is already exist.";
                } else {

                    $statement = $pdo->prepare("INSERT INTO tbl_services (srvc_title,srvc_overview,srvc_package,user_id,srvc_price,srvc_photo,srvc_status,svrc_category,created_at) VALUES (?,?,?,?,?,?,?,?,?)");
                    $statement->execute(array($inputServiceTitle,$inputServiceOverview,$inputServicePackage,$user_id,$inputServicePrice,$final_name,$inputServiceStatus,$inputServiceCategory,$created_at));

                    $alert_msg = "Inserted.";
                        
                    header('location: services.php');

                }
                      
            }
            
        }
        
    }
}

// Insert New Category End

?>


<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">Services</li>
    </ol>

    <div class="row ">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">Add New Service</h5>
                </div>
                <div class="card-body">
                
                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>
                
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="small mb-1" for="inputServiceTitle">Service Title</label>
                            <input class="form-control py-4" id="inputServiceTitle" name="inputServiceTitle"  type="text" placeholder="Enter Service Title" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputServiceOverview">Service Overview</label>
                            <input class="form-control py-4" id="inputServiceOverview"  name="inputServiceOverview" type="text" placeholder="Enter Service Ovierview" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputServicePackage">Service Package (Offers)</label>
                            <input class="form-control py-4" id="inputServicePackage" name="inputServicePackage"  type="text" placeholder="Enter Service Package Details" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputServicePrice">Service Price</label>
                            <input class="form-control py-4" id="inputServicePrice"  name="inputServicePrice" type="number" placeholder="Enter Enter Service Price" />
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
                            <div  style="padding-top:6px;">
                                <input type="file" name="photo">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="radio-inline"><input value="active" checked type="radio" name="inputServiceStatus"> Active</label>
                            <label class="radio-inline"><input value="inactive" type="radio" name="inputServiceStatus" > Inactive</label>
                            
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Submit" class="btn btn-primary" name="form_service_insert">
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">Note</h5>
                </div>
                <div class="card-body">
                   
                    <p>Icons is available <a target="_blank" href="https://fontawesome.com/v4/icons/">here...</a></p>
                </div>
                
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>